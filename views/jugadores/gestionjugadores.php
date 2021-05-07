<div class="container-xl mt-5 border-top border-bottom p-4 pt-5">
    
    <h1><?php echo $unClub['NOMBRE_CLUB'] ?></h1>                   
    
    <div class="row d-flex">
        <div class="col-lg-8">
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered text-center">
                    <thead>
                        <tr>
                            <th>RUT</th>
                            <th>JUGADOR</th>
                            <th>FECHA NACIMIENTO</th>
                            <th class="text-center">DESINSCRIBIR</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php while($jugadores = mysqli_fetch_assoc($todosLosJugadoresPorClub)){?>
                        <tr>
                            <td><?php echo $jugadores['RUT_PERSONA'] ?></td>
                            <td><?php  echo $jugadores['NOMBRE_1'].' '.$jugadores['NOMBRE_2'].' '.$jugadores['APELLIDO_1'].' '.$jugadores['APELLIDO_2'] ?></td>
                            <td><?php echo $jugadores['FECHA_NACIMIENTO'] ?></td>
                            <td><button class="btn btn-danger btn-eliminar" data-bs-toggle="modal" data-bs-target="#eliminarJugador" value="<?=$jugadores['RUT_PERSONA'];?>">Desinscribir</button></td>
                        </tr>
                    <?php } mysqli_free_result($todosLosJugadoresPorClub);?>                                 
                    </tbody>
                </table>
            </div>
        </div>

        <div class="col-lg-3 ml-5 border-left border-right pl-4 pr-4 text-center" style="max-height: 200px;">
            <h4 class="text-center pb-3">Agregar Jugador</h4><!-- Debo rescatar los valores y setearlos aquí-->
            <form id="inscribirClub" action="<?=base_url?>jugadores/aderirJugadorClub" method="POST">
                <div>
                    <input type="hidden" name="id" value="<?php echo $unClub['ID_CLUB']?>"/>
                    <input class="form-control" id="usuario" name="NombreUsuario" type="hidden" value="<?php echo $_SESSION['NombreUsuario']?>">
                    <input class="form-control" id="rut" name="rutUsuario" type="hidden" value="<?php echo $_SESSION['RutUsuario']?>">
                </div>
                <div class="row d-flex justify-content-center">                
                    <label for="" class="form-label mr-2">Jugadores</label>
                    <select name="jugador" id="" class="col-8">
                    <option value="0" selected>Seleccionar Jugador</option>
                    <?php while($jugadores = mysqli_fetch_assoc($jugadorNoAderido)){?>
                        <option value="<?php echo $jugadores['RUT_PERSONA'];?>"><?php echo $jugadores['NOMBRE_1'].' '.$jugadores['NOMBRE_2'].' '.$jugadores['APELLIDO_1'].' '.$jugadores['APELLIDO_2'] ?></option>
                    <?php } mysqli_free_result($jugadorNoAderido);?>
                    </select>
                </div>
                <div class="row d-flex justify-content-center">
                    <input type="submit" class="btn btn-success col-6 mt-3" value="Agregar Jugador">      
                </div>
            </form>          
        </div>
    </div>
</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.5.4/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="<?=base_url?>javascript/main.js"></script>

<!-- Modal Deshabilitar Usuario -->
<div class="modal fade" id="eliminarJugador" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
        ¿Está seguro de desinscribir a este jugador?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>       
        <button id="EliminarJugador" type="button" onclick="document.location.href='<?=base_url?>jugadores/desincribirJugador'" class="btn btn-danger">Desinscribir</button>
      </div>
    </div>
  </div>
</div>

<script>
    $('.btn-eliminar').click(function(){
        let boton = document.getElementById("EliminarJugador");
        let id = $(this).val();
        boton.removeAttribute("onclick");
        boton.setAttribute("onclick","document.location.href='<?=base_url?>jugadores/desincribirJugador&rut="+id+"&idclub=<?php echo $unClub['ID_CLUB']?>&user=<?php echo $_SESSION['NombreUsuario'];?>&rutuser=<?php echo $_SESSION['RutUsuario'];?>'");        
    });
</script>