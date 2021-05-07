$(document).ready(function(){

    $("#btnCargardatosModal").click(function(){
        $('#tablaHistorial').html("");
        $.ajax({
            url: "../ajax/php/obtenerPersonaDeshabilitada.php",
            type: "POST",
            data: {accion: ""},
            dataType: "json",
            success: function(respuesta){
                console.log(respuesta);
               respuesta.forEach(persona => {
                var fila =`<tr id="">             
                <td>${persona.RUT_PERSONA}</td>
                <td>${persona.NOMBRE_1} ${persona.NOMBRE_2} ${persona.APELLIDO_1} ${persona.APELLIDO_2}</td>
                <td>${persona.NOMBRE_ASOCIACION}</td>
                <td>
                <button class="btn btn-info" onclick="document.location.href='http://localhost/sistema_afal/persona/habilitarunapersona&rutHabilitar=${persona.RUT_PERSONA}'">Restaurar</button>
                </td>
                </tr>`
                $('#tablaHistorial').append(fila);
                //$('#tablaHistorial').DataTable();           
               }); 
            },
            error: function(){
                console.log("No funciona");
            }
        })

    });


   
});

