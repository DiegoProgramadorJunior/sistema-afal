<div class="container-xl mt-3 border-top border-bottom p-4">
    <div class="row">
        <div class="col-lg-12">
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered" style="width:100%;">
                    <thead>
                        <tr>
                            <th>NOMBRE</th>
                            <th>RUT</th>
                            <th>NOMBRE PERSONA</th>
                            <th>ESTADO</th>
                            <th class="text-center">ACCIONES</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php while($usuarios = mysqli_fetch_assoc($todosLosUsuarios)){?>
                        <tr>
                            <td><?php echo $usuarios['NOMBRE_USUARIO']; ?></td>
                            <td><?php echo $usuarios['RUT_PERSONA_FK']; ?></td>
                            <td><?php echo $usuarios['NOMBRE_1'].' '.$usuarios['NOMBRE_2'].' '.$usuarios['APELLIDO_1'].' '.$usuarios['APELLIDO_2']; ?></td>
                            <td><?php echo $usuarios['NOMBRE_TIPO_ESTADO']; ?></td>
                            <td class="text-center">
                                <button class="btn btn-success" onclick="document.location.href='<?=base_url?>usuarios/gestionEditar&id=<?=$usuarios['ID_USUARIO'];?>&in=1'">Editar</button>                                    
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.5.4/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="<?=base_url?>javascript/main.js"></script>
<script src="<?=base_url?>datatables/datatables.min.js"></script>

<script>
    $(document).ready(function() {
        $('#example').DataTable();
    });
</script>

<!-- Modal Deshabilitar Usuario -->
<div class="modal fade" id="terminarUsuario" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <div class="d-flex justify-content-center">
          <h5 class="modal-title d-flex justify-content-center" id="exampleModalLabel">Deshabilitar Usuario Registrado</h5>
        </div>
        <input type="hidden" value="" id="eliminarEscondido">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        ¿Está seguro de deshabilitar ha este usuario?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button id="btnDarTermino" type="button" onclick="document.location.href='<?=base_url?>usuarios/index'" class="btn btn-danger">Dar termino</button>
      </div>
    </div>
  </div>
</div>


<script>
    $('.btn-eliminar').click(function(){
        let boton = document.getElementById("btnDarTermino");
        let id = $(this).val();
        boton.removeAttribute("onclick");
        boton.setAttribute("onclick","document.location.href='<?=base_url?>usuarios/eliminar&idUsuario="+id+"&estado=2&user=<?php echo $_SESSION['NombreUsuario'];?>&rutuser=<?php echo $_SESSION['RutUsuario'];?>'");        
    });
</script>