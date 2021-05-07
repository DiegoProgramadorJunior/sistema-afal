$('#arbitroprincipal').change(function(){
    let rutArbitroPrincipal = $("#arbitroprincipal option:selected").val();
    $('#segundoarbitro').html("");
    $('#tercerarbitro').html("");
    let opcionDefault = document.createElement("option");
    opcionDefault.value = 0;
    opcionDefault.text = "Seleccionar Árbitro";
    let opcionDefaultDos = document.createElement("option");
    opcionDefaultDos.value = 0;
    opcionDefaultDos.text = "Seleccionar Árbitro";
    document.getElementById("segundoarbitro").appendChild(opcionDefault);
    document.getElementById("tercerarbitro").appendChild(opcionDefaultDos);
    $.ajax({
        url: "../ajax/php/partidosArbitros.php",
        type: "POST",
        data: {arbitroprincipal: rutArbitroPrincipal},
        dataType: "json",
        success: function(respuesta){
            respuesta.forEach( arbitro => {
                let opcion = document.createElement("option");
                opcion.value = arbitro.RUT_PERSONA;
                opcion.text = arbitro.NOMBRE_1+" "+arbitro.NOMBRE_2+" "+arbitro.APELLIDO_1;
                document.getElementById("segundoarbitro").appendChild(opcion);
            });
        },
        error: function(){
            console.log("No funciona");
        }
    })
})

$('#segundoarbitro').change(function(){
    let rutArbitroPrincipal = $("#arbitroprincipal option:selected").val();
    let rutSegundoArbitro = $("#segundoarbitro option:selected").val();
    $('#tercerarbitro').html("");
    let opcionDefault = document.createElement("option");
    opcionDefault.value = 0;
    opcionDefault.text = "Seleccionar Árbitro";
    document.getElementById("tercerarbitro").appendChild(opcionDefault);
    $.ajax({
        url: "../ajax/php/partidosArbitros.php",
        type: "POST",
        data: {arbitroprincipal: rutArbitroPrincipal,segundoarbitro: rutSegundoArbitro},
        dataType: "json",
        success: function(respuesta){
            respuesta.forEach( arbitro => {
                let opcion = document.createElement("option");
                opcion.value = arbitro.RUT_PERSONA;
                opcion.text = arbitro.NOMBRE_1+" "+arbitro.NOMBRE_2+" "+arbitro.APELLIDO_1;
                document.getElementById("tercerarbitro").appendChild(opcion);
            });
        },
        error: function(){
            console.log("No funciona");
        }
    })
})