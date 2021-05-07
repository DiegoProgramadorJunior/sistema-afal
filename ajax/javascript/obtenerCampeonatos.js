$(document).ready(function(){
    $('#cuerpoPartidosProximos').html("");
    let fecha = moment();
    let fechadesde = fecha.format('YYYY-MM-DD');
    let fechahasta = fecha.add(7, 'days').format('YYYY-MM-DD');
    $.ajax({
        url: "../ajax/php/obtenerCampeonatos.php",
        type: "POST",
        data: {fechadesde: fechadesde,fechahasta:fechahasta},
        dataType: "json",
        success: function(respuesta){  
           respuesta.forEach(partido => {
                var fila =`<tr id="">             
                <td>${partido.FECHA_STRING}</td>
                <td>${partido.FECHA_DATE}</td>
                <td>${partido.CLUB_LOCAL}</td>
                <td>${partido.CLUB_VISITA}</td>
                <td>${partido.NOMBRE_ARBITRO}</td>
                <td>${partido.NOMBRE_TURNO}</td>
                </tr>`;
                $('#partidosProximos').append(fila);
           });
        },
        error: function(){

        }
    })
    .then(res=>($('#partidosProximos').DataTable()))
})