<div class="container mt-5 border-top border-bottom p-4 pt-5">
    
    <h1><?php echo $unClub['NOMBRE_CLUB'] ?></h1>                   
    
    <div class="row">
        <div class="">
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered text-center">
                    <thead>
                        <tr>
                            <th>RUT</th>
                            <th>TECNICO</th>
                            <th>FECHA NACIMIENTO</th>
                            <th>SERIE</th>
                            <th class="text-center">DESINSCRIBIR</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php while($tecnicos = mysqli_fetch_assoc($todosLosTecnico)){?>
                        <tr>
                            <td><?php echo $tecnicos['RUT_PERSONA'] ?></td>
                            <td><?php  echo $tecnicos['NOMBRE_1'].' '.$tecnicos['NOMBRE_2'].' '.$tecnicos['APELLIDO_1'].' '.$tecnicos['APELLIDO_2'] ?></td>
                            <td><?php echo $tecnicos['FECHA_NACIMIENTO'] ?></td>
                            <td><?php echo $tecnicos['NOMBRE_SERIE'] ?></td>
                            <td><button class="btn btn-danger btn-eliminar" data-bs-toggle="modal" data-bs-target="#eliminarTecnico" value="<?=$tecnicos['RUT_PERSONA'];?>">Desinscribir</button></td>
                        </tr>
                    <?php } mysqli_free_result($todosLosTecnico);?>                                 
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.5.4/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="<?=base_url?>javascript/main.js"></script>

<!-- Modal Eliminar Tecnico -->
<div class="modal fade" id="eliminarTecnico" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <div class="d-flex justify-content-center">
          <h5 class="modal-title d-flex justify-content-center" id="exampleModalLabel">Desinscribir Jugador</h5>
        </div>
        <input type="hidden" value="" id="eliminarEscondido">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        ¿Está seguro de desinscribir a este Tecnico?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>       
        <button id="EliminarTecnico" type="button" onclick="document.location.href='<?=base_url?>jugadores/desincribirJugador'" class="btn btn-danger">Desinscribir</button>
      </div>
    </div>
  </div>
</div>

<script>
    $('.btn-eliminar').click(function(){
        let boton = document.getElementById("EliminarTecnico");
        let id = $(this).val();
        boton.removeAttribute("onclick");
        boton.setAttribute("onclick","document.location.href='<?=base_url?>tecnico/eliminartecnico&rut="+id+"&idclub=<?php echo $unClub['ID_CLUB']?>'");        
    });
</script>