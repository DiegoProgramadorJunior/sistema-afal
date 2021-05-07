<?php $todoslosClubes?>
<div class="container-xl mt-3">
<a class="btn btn-info" href="<?=base_url?>tecnico/tecnicoClub" >Ver Tecnico Club</a>
</div>
<div class="container-xl mt-3 
 border-bottom p-4">
    <div class="row">
        <div class="col-lg-12">
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered" style="width:100%;">
                    <thead>
                        <tr>
                            <th>RUT</th>
                            <th>NOMBRE</th>
                            <th>NUMERO TELEFONO</th>
                            <th>CORREO ELECTRONICO</th>
                            <th>DIRECCION</th>
                            <th>ASOCIACION</th>
                            <th class="text-center">ACCIONES</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                      while($tecnico=mysqli_fetch_assoc($todosLosTecnico)){
                    ?>
                       <tr>
                         <td><?php echo $tecnico['RUT_PERSONA'].'-'.$tecnico['DV'] ?></td>
                         <td><?php echo $tecnico['NOMBRE_1'].' '.$tecnico['NOMBRE_2'].' '.$tecnico['APELLIDO_1'].' '.$tecnico['APELLIDO_2'] ?></td>
                         <td><?php echo $tecnico['NUMERO_TELEFONO_PERSONA'] ?></td>
                         <td><?php echo $tecnico['CORREO_ELECTRONICO'] ?></td>
                         <td><?php echo $tecnico['NOMBRE_COMUNA'].', '.$tecnico['CALLE_PASAJE'] ?></td>                    
                         <td><?php echo $tecnico['NOMBRE_ASOCIACION'] ?></td>
                         <td class="text-center">
                                <button class="btn btn-success" onclick="document.location.href='<?=base_url?>persona/gestionEditar&id=<?=$tecnico['RUT_PERSONA'];?>&tec=tecnico'">Editar</button>
                                <button class="btn btn-danger btn-eliminar" data-bs-toggle="modal" data-bs-target="#eliminarTecnico" value="<?=$tecnico['RUT_PERSONA'];?>">Deshabilitar</button>                                       
                                <button class="btn btn-primary btn-valueT" value="<?php echo $tecnico['RUT_PERSONA']?>" data-bs-toggle="modal" data-bs-target="#aderirTecnico" data-toggle="tooltip" data-placement="top" title="ADERIR A UN CLUB">Aderir</button>
                         </td>
                       </tr>
                    <?php }?>    
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div> 

<!-- Modal Deshabilitar Tecnico -->
<div class="modal fade" id="eliminarTecnico" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <div class="d-flex justify-content-center">
          <h5 class="modal-title d-flex justify-content-center" id="exampleModalLabel">Eliminar Tecnico</h5>
        </div>
        <input type="hidden" value="" id="eliminarEscondido">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        ¿Está seguro de deshabilitar al tecnico?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>       
        <button id="EliminarPersona" type="button" onclick="document.location.href='<?=base_url?>persona/eliminar'" class="btn btn-danger">Eliminar</button>
      </div>
    </div>
  </div>
</div>

<!--Modal Aderir Tecnico a Club-->
<!-- Modal -->
<div class="modal fade" id="aderirTecnico" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Seleccionar Club</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="<?=base_url?>tecnico/AgregarTecnicoClub" method="post">
        <div class="form-group">
          <label for="a" class="form-label">CLUBES</label>
          <input type="hidden" value="" name="rutTecnico" id="TecnicoRut">
          <select name="clublocal" class="form-select" id="selectClubLocal">
          <option value="0">Seleccionar Club</option>
         <?php while($club=mysqli_fetch_assoc($todoslosClubes)){ ?>
          <option value="<?php echo $club['ID_CLUB'];?>"><?php echo $club['NOMBRE_CLUB'];?></option> 
        <?php }?>
        </select> 
        </div>
        <div class="form-group">
          <label for="a" class="form-label">SERIES</label>
          <select name="Serie" class="form-select" id="selectSerie">
            <option value="0">Seleccionar Serie</option>
             <?php while($serie=mysqli_fetch_assoc($todasLasSeries)){ ?>
            <option value="<?php echo $serie['ID_SERIE'];?>"><?php echo $serie['NOMBRE_SERIE'];?></option> 
            <?php }?>
          </select> 
        
        </div>

        <button type="submite" class="btn btn-primary">Agregar</button>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
     
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
        $('#tablaHistorial').DataTable();
    } );
</script>
<script src="<?=base_url?>javascript/main.js"></script>
<script src="<?=base_url?>datatables/datatables.min.js"></script>

<script>
    $('.btn-eliminar').click(function(){
        let boton = document.getElementById("EliminarPersona");
        let id = $(this).val();
        boton.removeAttribute("onclick");
        boton.setAttribute("onclick","document.location.href='<?=base_url?>tecnico/eliminartecnico&rut="+id+"'");        
    });

    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl)
})
</script>   

<script>
  $('.btn-valueT').click(function(){  
    let id = $(this).val();
    console.log(id);
    $('#TecnicoRut').val(id);
         
  });
</script>