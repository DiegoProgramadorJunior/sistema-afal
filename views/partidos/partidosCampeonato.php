<div class="container-xl">
<div class="d-flex justify-content-between ">
    <a href="<?=base_url?>partidos/gestionCrear&in=crear&campeonato=<?=$_GET['campeonato']?>" class="btn btn-secondary mt-5"> Crear Partido </a>
    <button type="button" class="btn btn-danger mt-5 justify-content-end" id="btnCargardatosModal" data-bs-toggle="modal" data-bs-target="#historialPersona">Historial</button>
</div>
</div>


<?php $todoslosClubes?>
<div class="container-xl mt-3 border-top border-bottom p-4">
<?php
  if(isset($_GET['error'])){
    echo '<p class="alert alert-danger text-center">No se puede eliminar un partido en el que ya hay jugadores cargados</p>';
  }
?>
    <div class="row">
        <div class="col-lg-12">
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered" style="width:100%;">
                    <thead>
                        <tr>
                            <th>FECHA CAMPEONATO</th>
                            <th>FECHA PARTIDO</th>
                            <th>LOCAL</th>
                            <th>VISITANTE</th>
                            <th>ARBITRO</th>
                            <th>TURNO</th>
                            <th>GESTIÓN</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                      while($partido=mysqli_fetch_assoc($todosLosPartidos)){
                    ?>
                       <tr>
                        <td><?php echo $partido['FECHA_STRING'];?></td>
                        <td><?php echo $partido['FECHA_DATE'];?></td>
                        <td><?php echo $partido['CLUB_LOCAL'];?></td>
                        <td><?php echo $partido['CLUB_VISITA'];?></td>
                        <td><?php echo $partido['NOMBRE_ARBITRO'];?></td>
                        <td><?php echo $partido['NOMBRE_TURNO'];?></td>
                        <td>
                          <button class="btn btn-success" onclick="document.location.href='<?=base_url?>partidos/editar&partido=<?=$partido['ID_PARTIDO']?>&campeonato=<?=$_GET['campeonato']?>'">Editar</button>
                          <button class="btn btn-danger btn-eliminar" value="<?=$partido['ID_PARTIDO']?>" data-bs-toggle="modal" data-bs-target="#eliminarPartido">Eliminar</button>
                        </td>
                       </tr>
                    <?php } mysqli_free_result($todosLosPartidos);?> 
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div> 

<!-- Modal Deshabilitar Usuario -->
<div class="modal fade" id="eliminarPartido" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <div class="d-flex justify-content-center">
          <h5 class="modal-title d-flex justify-content-center" id="exampleModalLabel">Eliminar Partido</h5>
        </div>
        <input type="hidden" value="" id="eliminarEscondido">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        ¿Está seguro de eliminar este partido?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>       
        <button id="eliminarPartido" type="button" onclick="" class="btn btn-danger">Eliminar</button>
      </div>
    </div>
  </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.5.4/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="<?=base_url?>ajax/javascript/obtenerPersonaDeshabilitada.js"></script>
<script>
    $(document).ready(function() {
        $('#example').DataTable();
        $('#tableHistorial').DataTable();
    } );
</script>
<script src="<?=base_url?>javascript/main.js"></script>
<script src="<?=base_url?>datatables/datatables.min.js"></script>

<script>
    $('.btn-eliminar').click(function(){
        let boton = document.getElementById("eliminarPartido");
        let id = $(this).val();
        boton.removeAttribute("onclick");
        boton.setAttribute("onclick","document.location.href='<?=base_url?>partidos/eliminar&partido="+id+"&campeonato=<?=$_GET['campeonato']?>'");        
    });
</script>