<div class="container-xl">
<div class="d-flex justify-content-between ">
    <a href="<?=base_url?>serie/crearserie&in=crear" class="btn btn-secondary mt-5">Crear Serie</a>
</div>
</div>


<?php $todoslosClubes?>
<div class="container-xl mt-3 border-top border-bottom p-4">
<?php if(isset($_GET['errordelete'])):?>
<p class="alert alert-danger">No se ha podido eliminar la serie debido a que hay campeonatos que corresponden a esta serie.</p>
<?php endif;?>
    <div class="row">
        <div class="col-lg-12">
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered" style="width:100%;">
                    <thead>
                        <tr>
                            <th>ID SERIE</th>
                            <th>NOMBRE SERIE</th>
                            <th class="text-center">ACCIONES</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                      while($serie=mysqli_fetch_assoc($todasLasSeries)){
                    ?>
                       <tr>
                         <td><?php echo $serie['ID_SERIE'];?></td>
                         <td><?php echo $serie['NOMBRE_SERIE'];?></td>
                         <td class="text-center">
                                <button class="btn btn-success" onclick="document.location.href='<?=base_url?>serie/editarserie&idserie=<?=$serie['ID_SERIE'];?>&in=editar'">Editar</button>
                                <button class="btn btn-danger btn-eliminar" data-bs-toggle="modal" data-bs-target="#eliminarPersona" value="<?=$serie['ID_SERIE'];?>">Deshabilitar</button>                                       
                         </td>
                       </tr>
                    <?php }?>    
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div> 

<!-- Modal Deshabilitar Usuario -->
<div class="modal fade" id="eliminarPersona" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <div class="d-flex justify-content-center">
          <h5 class="modal-title d-flex justify-content-center" id="exampleModalLabel">Eliminar Persona</h5>
        </div>
        <input type="hidden" value="" id="eliminarEscondido">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        ¿Está seguro de eliminar ésta serie?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>       
        <button id="EliminarPersona" type="button" onclick="document.location.href='<?=base_url?>persona/eliminar'" class="btn btn-danger">Eliminar</button>
      </div>
    </div>
  </div>
</div>




<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.5.4/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="<?=base_url?>ajax/javascript/obtenerPersonaDeshabilitada.js"></script>
<script>
    $(document).ready(function() {
        $('#example').DataTable({
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
        $('#tablaHistorial').DataTable({
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
    $('.btn-eliminar').click(function(){
        let boton = document.getElementById("EliminarPersona");
        let id = $(this).val();
        boton.removeAttribute("onclick");
        boton.setAttribute("onclick","document.location.href='<?=base_url?>serie/eliminar&idserie="+id+"&user=<?php echo $_SESSION['NombreUsuario'];?>&rutuser=<?php echo $_SESSION['RutUsuario'];?>'");        
    });
</script>