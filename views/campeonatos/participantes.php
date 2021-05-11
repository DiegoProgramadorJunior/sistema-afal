<div class="container-xl mt-5 border-top border-bottom p-4 pt-5">
    <div class="row d-flex">
        <div class="col-lg-8">
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered text-center">
                    <thead>
                        <tr>
                            <th>NOMBRE</th>
                            <th>FECHA INSCRIPCIÓN</th>
                            <th class="text-center">ELIMINAR</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php while($participante = mysqli_fetch_assoc($participantes)){?>
                        <tr>
                            <td><?php echo $participante['NOMBRE_CLUB']; ?></td>
                            <td><?php echo $participante['FECHA_INSCRIPCION']; ?></td>
                            <td><button class="btn btn-danger btn-eliminar" data-bs-toggle="modal" data-bs-target="#terminarCampeonato" value="<?=$participante['ID_CAMPEONATO_EQUIPOS'];?>">Eliminar</button></td>
                        </tr>
                    <?php } mysqli_free_result($participantes);?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="col-lg-3 ml-5 border-left border-right pl-4 pr-4 text-center" style="max-height: 200px;">
            <h4 class="text-center pb-3">Agregar Participante</h4><!-- Debo rescatar los valores y setearlos aquí-->
            <form id="inscribirClub" action="<?=base_url?>campeonatos/agregarParticipante&idcampeonato=<?=$_GET['idcampeonato'];?>&idclub=Y" method="POST">
                <div class="row d-flex justify-content-center">
                    <label for="" class="form-label mr-2">Clubes</label>
                    <?php if(isset($campeonatoSeleccionado) && $campeonatoSeleccionado['NOMBRE_ESTADO_CAMPEONATO']=="Creación"): ?>
                    <select name="" id="clubesNoInscritos" class="col-8">
                    <?php elseif(isset($campeonatoSeleccionado) && $campeonatoSeleccionado['NOMBRE_ESTADO_CAMPEONATO']=="Vigente") :?>
                    <select name="" id="clubesNoInscritos" class="col-8" disabled>
                    <?php endif; ?>
                    <option value="0" selected>Seleccionar Club</option>
                    <?php while($clubes = mysqli_fetch_assoc($clubesNoInscritos)){?>
                        <option value="<?php echo $clubes['ID_CLUB'];?>"><?php echo $clubes['NOMBRE_CLUB'];?></option>
                    <?php } mysqli_free_result($clubesNoInscritos);?>
                    </select>
                </div>
                <div class="row d-flex justify-content-center">
                    <?php if(isset($campeonatoSeleccionado) && $campeonatoSeleccionado['NOMBRE_ESTADO_CAMPEONATO']=="Creación"): ?>
                    <input type="submit" class="btn btn-success col-6 mt-3" value="Inscribir Club"> 
                    <?php elseif(isset($campeonatoSeleccionado) && $campeonatoSeleccionado['NOMBRE_ESTADO_CAMPEONATO']=="Vigente") :?>
                    <input type="submit" class="btn btn-success col-6 mt-3" value="Inscribir Club" disabled> 
                    <?php endif; ?>    
                </div>
            </form>          
        </div>
    </div>
</div>

<!-- Modal Deshabilitar Registro -->
<div class="modal fade" id="terminarCampeonato" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <div class="d-flex justify-content-center">
          <h5 class="modal-title d-flex justify-content-center" id="exampleModalLabel">Eliminar inscripción</h5>
        </div>
        <input type="hidden" value="" id="eliminarEscondido">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        ¿Está seguro de eliminar la inscripción?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button id="btnDarTermino" type="button" onclick="document.location.href='<?=base_url?>inicio/cerrarsesion'" class="btn btn-danger">Eliminar</button>
      </div>
    </div>
  </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.5.4/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

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
    });
</script>

<script src="<?=base_url?>javascript/main.js"></script>
<script src="<?=base_url?>datatables/datatables.min.js"></script>

<script>
    $('.btn-eliminar').click(function(){
        let boton = document.getElementById("btnDarTermino");
        let id = $(this).val();
        boton.removeAttribute("onclick");
        boton.setAttribute("onclick","document.location.href='<?=base_url?>campeonatos/eliminarInscripcion&id="+id+"&idcampeonato=<?=$_GET['idcampeonato'];?>'");
    });
</script>

<script>
    $('#clubesNoInscritos').change(function(){
        $('#inscribirClub').removeAttr("action");
        let idClub = $("#clubesNoInscritos option:selected").val();
        $('#inscribirClub').attr("action","<?=base_url?>campeonatos/agregarParticipante&idcampeonato=<?=$_GET['idcampeonato'];?>&idclub="+idClub);
    });
</script>