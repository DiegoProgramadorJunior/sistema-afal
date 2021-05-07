$(document).ready(function(){
    $.ajax({
        url: "../ajax/php/obtenerRegiones.php",
        type: "POST",
        data: {accion: ""},
        dataType: "json",
        success: function(respuesta){
            respuesta.forEach( region => {
                let opcion = document.createElement("option");
                opcion.value = region.ID_REGION;
                opcion.text = region.NOMBRE_REGION;
                document.getElementById("selectRegion").appendChild(opcion);
            });
        },
        error: function(){
            console.log("No funciona");
        }
    })
})

$('#selectRegion').change(function(){
    const idRegion = $("#selectRegion option:selected").val();
    $('#selectProvincia').html("");
    $('#selectComuna').html("");
    let opcionDefaultProvincia = document.createElement("option");
    opcionDefaultProvincia.text = "Seleccionar Provincia";
    opcionDefaultProvincia.value = 0;
    let opcionDefaultComuna = document.createElement("option");
    opcionDefaultComuna.text = "Seleccionar Comuna";
    opcionDefaultComuna.value = 0;
    $('#selectProvincia').append(opcionDefaultProvincia);
    $('#selectComuna').append(opcionDefaultComuna);
    $.ajax({
        url: "../ajax/php/obtenerProvincias.php",
        type: "POST",
        data: {region: idRegion},
        dataType: "json",
        success: function(respuesta){
            respuesta.forEach( provincia => {
                let opcion = document.createElement("option");
                opcion.value = provincia.ID_PROVINCIA;
                opcion.text = provincia.NOMBRE_PROVINCIA;
                document.getElementById("selectProvincia").appendChild(opcion);
            });
        },
        error: function(){
            console.log("No funciona");
        }
    })
})

$('#selectProvincia').change(function(){
    const idProvincia = $("#selectProvincia option:selected").val();
    $('#selectComuna').html("");
    let opcionDefault = document.createElement("option");
    opcionDefault.value = 0;
    opcionDefault.text = "Seleccionar Provincia";
    $('#selectComuna').append(opcionDefault);
    $.ajax({
        url: "../ajax/php/obtenerComunas.php",
        type: "POST",
        data: {provincia: idProvincia},
        dataType: "json",
        success: function(respuesta){
            respuesta.forEach( provincia => {
                let opcion = document.createElement("option");
                opcion.value = provincia.ID_COMUNA;
                opcion.text = provincia.NOMBRE_COMUNA;
                document.getElementById("selectComuna").appendChild(opcion);
            });
        },
        error: function(){
            console.log("No funciona");
        }
    })
})