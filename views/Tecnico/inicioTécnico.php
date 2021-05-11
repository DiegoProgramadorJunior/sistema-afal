<div class="container">
    <div class="row mt-5">
        <div class="table-responsive">
            <table id="partidosTurno" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>FECHA CAMPEONATO</th>
                        <th>FECHA PARTIDO</th>
                        <th>LOCAL</th>
                        <th>VISITANTE</th>
                        <th>ARBITRO PRINCIPAL</th>
                        <th>GESTION</th>
                    </tr>
                </thead>
                <tbody>
                <?php while($partido=mysqli_fetch_assoc($partidos)){?>
                       <tr>
                       <td><?php echo $partido['FECHA_STRING']?></td>
                       <td><?php echo $partido['FECHA_DATE'] ?></td>
                       <td><?php echo $partido['CLUB_LOCAL'] ?></td>
                       <td><?php echo $partido['CLUB_VISITA'] ?></td>
                       <td><?php echo $partido['NOMBRE_ARBITRO'] ?></td>
                       <td>
                       <button class="btn btn-primary btn-partido" value="<?php echo $partido['ID_PARTIDO']?>" data-bs-toggle="modal" data-bs-target="#modali">Cargar Jugadores</button>                
                       </td>
                       </tr>
                    <?php }?>    
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Gestion Turno -->
<div class="modal fade" id="modali" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <div class="d-flex justify-content-center">
          <h5 class="modal-title d-flex justify-content-center" id="exampleModalLabel">INICIAR PARTIDO</h5>
        </div>
        <input type="hidden" value="" id="eliminarEscondido">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        ¿Está seguro de comenzar el partido?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>       
        <button id="comenzarPartido" type="button" onclick="document.location.href='<?=base_url?>persona/eliminar'" class="btn btn-danger">Comenzar</button>
      </div>
    </div>
  </div>
</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.5.4/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $('#partidosTurno').DataTable({
            "language": {
                "paginate": {
                    "first":      "Primero",
                    "last":       "Último",
                    "next":       "Siguiente",
                    "previous":   "Anterior"
                },
                "search":         "Buscar:",
                "infoEmpty":      "Mostrando 0 a 0 de 0 registros",
                "info":           "Mostrando _START_ a _END_ de _TOTAL_ entradas",
                "emptyTable":     "No se encontraron registros",
                "lengthMenu":     "Mostrar _MENU_ registros",
            }
        });
    } );
</script>
<script src="<?=base_url?>javascript/main.js"></script>
<script src="<?=base_url?>datatables/datatables.min.js"></script>

<script>
    $('.btn-partido').click(function(){
        let boton = document.getElementById("comenzarPartido");
        let id = $(this).val();
        boton.removeAttribute("onclick");
        boton.setAttribute("onclick","document.location.href='<?=base_url?>tecnico/cargarJugadores&partido="+id+"&club=<?=$datos->ID_CLUB_FK?>&serie=<?=$serie->ID_SERIE_FK?>'");        
    });
</script>


