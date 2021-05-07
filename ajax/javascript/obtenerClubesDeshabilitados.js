$(document).ready(function(){

    $("#btnCargardatosModal").click(function(){
        $('#tablaHistorial').html("");
        $.ajax({
            url: "../ajax/php/obtenerClubesDeshabilitado.php",
            type: "POST",
            data: {accion: ""},
            dataType: "json",
            success: function(respuesta){
                console.log(respuesta);
               respuesta.forEach(club => {
                var fila =`<tr id="">             
                <td>${club.RUT_CLUB +'-'+ club.DV_CLUB}</td>
                <td>${club.NOMBRE_CLUB}</td>
                <td>${club.NOMBRE_ESTADIO}</td>
                <td>
                <button class="btn btn-info" onclick="document.location.href='http://localhost/sistema_afal/club/habilitarUnClub&idClub=${club.ID_CLUB}'">Restaurar</button>
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

