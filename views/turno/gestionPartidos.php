<div class="container">
    <div class="max-container mt-3">
    <div class="c-body">
        <div class="menu-container">
            <button class="btn btn-primary" id="btnModalGoles" data-bs-toggle="modal" data-bs-target="#modalGoles">Goles</button>
            <button class="btn btn-primary" id="btnModalAmonestaciones" data-bs-toggle="modal" data-bs-target="#modalAmonestaciones">Amonestaciones</button>
            <button class="btn btn-danger" id="btnTerminarPartido">Terminar Partido</button>
            <button class="btn btn-primary" id="btnModalSubstituciones" data-bs-toggle="modal" data-bs-target="#modalSubstituciones">Substituciónes</button>
            <button class="btn btn-primary" id="btnModalObservaciones" data-bs-toggle="modal" data-bs-target="#modalObserciones">Observaciones</button>
        </div>

        <div class="body-container">

            <div class="izq">
                <div class="arriba">
                    <div class="datos">
                        <h4 id=""><?=$datosClubTecnico->CLUB_LOCAL?> (LOCAL)</h4> <!--Agregar un id local-->
                        <p>Director Técnico: <?=$datosClubTecnico->NOMBRE_TECNICO_LOCAL?></p>
                        <input type="hidden" name="" id="idClubLocal" value="<?=$datosClubTecnico->ID_CLUB_LOCAL?>">
                    </div>
                    <div class="jugadores">
                        <ul class="list-group">
                          <?php while($jugadorLocal = mysqli_fetch_assoc($jugadoresLocal)){?>
                              <li class="list-group-item"><?php echo '('.$jugadorLocal['NUMERO_JUGADOR'].') '.$jugadorLocal['NOMBRE_1'].' '.$jugadorLocal['APELLIDO_1'].' '.$jugadorLocal['APELLIDO_2'];?></li>
                          <?php }?>    
                        </ul>
                    </div>
                </div>
                <div class="abajo">
                    <div class="sucesos" id="sucesoLocal">

                    </div>
                </div>
            </div>

            <div class="der">
                <div class="arriba">
                    <div class="datos">
                      <h4 id=""><?=$datosClubTecnico->CLUB_VISITA?> (VISITA)</h4> <!--Agregar un id Visita-->
                      <p>Director Técnico: <?=$datosClubTecnico->NOMBRE_TECNICO_VISITA?></p>
                       <input type="hidden" name="" id="idClubVisita" value="<?=$datosClubTecnico->ID_CLUB_VISITA?>">
                    </div>
                    <div class="jugadores">
                        <ul class="list-group">
                          <?php while($jugadorVisita = mysqli_fetch_assoc($jugadoresVisita)){?>
                              <li class="list-group-item"><?php echo $jugadorVisita['NOMBRE_1'].' '.$jugadorVisita['APELLIDO_1'].' '.$jugadorVisita['APELLIDO_2'];?></li>
                          <?php }?>    
                        </ul>
                    </div>
                </div>
                <div class="abajo">
                    <div class="sucesos" id="sucesoVisita">
                    
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

   <!-- Modals -->

<!-- Modal Goles -->
<div class="modal fade" id="modalGoles" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Goles del Partido</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

          <div class="row">
            <div class="col-6">
                <label for="">CLUB</label>
                <select name="selectIdClub" id="selectClub" class="form-select">
                    <option value="0">Seleccionar Club</option>
                    <option value="<?=$datosPartido->ID_CLUB_LOCAL_FK?>"><?=$datosClubTecnico->CLUB_LOCAL?></option>                     
                    <option value="<?=$datosPartido->ID_CLUB_VISITA_FK?>"><?=$datosClubTecnico->CLUB_VISITA?></option> 
                </select>
            </div>
            <div class="col-6">
                <label for="">JUGADOR</label>
                <select name="" id="selectJugadores" class="form-select" >
                    <option value="0">Seleccionar Jugador</option>
                </select>
            </div>            
          </div>

          <div class="row mt-2">
            <div class="col-6">
                <label for="">TIPO GOL</label>
                <select name="" id="selectGol" class="form-select">                  
                    <option value="0">Seleccionar Tipo</option>
                    <?php while($goles = mysqli_fetch_assoc($todosLosTiposGoles)){?>
                    <option value="<?php echo $goles['ID_TIPO_GOL'];?>"><?php echo $goles['NOMBRE_TIPO_GOL'];?></option>
                    <?php } mysqli_free_result($todosLosTiposGoles);?>
                    <?php ?>
                </select>
            </div>            
            <div class="col-6">
              <label for="">TIEMPO</label>
              <select name="" id="selecttiempo" class="form-select">
                <option value="0">Seleccionar Tiempo</option>
                <option value="Primero">Primer Tiempo</option>
                <option value="Segundo">Segundo Tiempo</option>
              </select>
            </div>
          </div>

         <div class="row mt-2">
            <div class="col-12">
              <label for="" class="form-label">MINUTO</label>
              <input type="text" class="form-control" id="minutoGol" placeholder="1-45">
            </div>
         </div>
          
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button type="button" id="btn-GenerarGol" class="btn btn-primary">Generar Gol</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal Amonestaciones -->
<div class="modal fade" id="modalAmonestaciones" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Amonestaciones del Partido</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-5">
                <label for="">CLUB</label>
                <select name="" id="selectClubAmonestaciones" class="form-select">
                    <option value="0">Seleccionar Club</option>
                    <option value="<?=$datosPartido->ID_CLUB_LOCAL_FK?>"><?=$datosClubTecnico->CLUB_LOCAL?></option>                     
                    <option value="<?=$datosPartido->ID_CLUB_VISITA_FK?>"><?=$datosClubTecnico->CLUB_VISITA?></option> 
                </select>
            </div>
            <div class="col-7">
                <label for="">JUGADOR</label> 
                <select name="" id="selectJugadoresAmonestaciones" class="form-select" >
                    <option value="0">Seleccionar Jugador</option>
                </select>
            </div>
          </div>
          <div class="row mt-2">
            <div class="col-3">
                <label for="">TIPO TARJETA</label>
                <select name="" id="selectIdTarjeta" class="form-select">
                    <option value="0">Seleccionar Tarjeta</option>
                  <?php while($tarjeta = mysqli_fetch_assoc($todosLosTiposTarjeta)){?>                
                    <option value="<?php echo $tarjeta['ID_TIPO_TARJETA'];?>"><?php echo $tarjeta['NOMBRE_TIPO_TARJETA'];?></option>
                  <?php } mysqli_free_result($todosLosTiposTarjeta);?>
                </select>
            </div>
            <div class="col-3">
                <label for="">TIPO FALTA</label>
                <select name="" id="selectIdFalta" class="form-select">
                    <option value="0">Seleccionar Falta</option>
                    <?php while($falta = mysqli_fetch_assoc($todosLosTiposFalta)){?>                
                    <option value="<?php echo $falta['ID_TIPO_FALTA'];?>"><?php echo $falta['NOMBRE_TIPO_FALTA'];?></option>
                  <?php } mysqli_free_result($todosLosTiposFalta);?>
                </select>
            </div> 
            <div class="col-3">
              <label for="">TIEMPO</label>
              <select name="" id="selecttiempoAmonestaciones" class="form-select">
                <option value="0">Seleccionar Tiempo</option>
                <option value="Primero">Primer Tiempo</option>
                <option value="Segundo">Segundo Tiempo</option>
              </select>
            </div>
            <div class="col-3">
              <label for="" class="form-label">MINUTO</label>
              <input type="text" class="form-control" id="minutoAmonestacion" placeholder="1-45">
            </div>      
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" id="btn-GenerarAmonestacion" class="btn btn-primary">Generar Amonestacion</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal Substituciones -->
<div class="modal fade" id="modalSubstituciones" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Substituciones del Partido</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

       <div class="row">  
         <div class="col-12">
            <label for="">CLUB</label>
            <select name="" id="selectclubsustituciones" class="form-select">
              <option value="0">Seleccionar Club</option>
              <option value="<?=$datosPartido->ID_CLUB_LOCAL_FK?>"><?=$datosClubTecnico->CLUB_LOCAL?></option>                     
              <option value="<?=$datosPartido->ID_CLUB_VISITA_FK?>"><?=$datosClubTecnico->CLUB_VISITA?></option> 
            </select>
          </div>
        </div>

        <div class="row">               
          <div class="col-6">
            <label for="">JUGADOR SALIENTE</label> 
            <select name="0" id="selectjugadorSale" class="form-select" >
              <option value="">Seleccionar Jugador Salienete</option>
            </select>
          </div>
          <div class="col-6">
           <label for="0">JUGADOR ENTRANTE</label> 
            <select name="" id="selectjugadorEntra" class="form-select" >
             <option value="">Seleccionar Jugador Entrante</option>
           </select>
          </div>          
        </div>
        <div class="row">
          <div class="col-6">
            <label for="">TIEMPO</label>
            <select name="" id="selecttiempoSubtituciones" class="form-select">
              <option value="0">Seleccionar Tiempo</option>
              <option value="Primero">Primer Tiempo</option>
              <option value="Segundo">Segundo Tiempo</option>
            </select>
          </div>
          <div class="col-6">
              <label for="" class="form-label">MINUTO</label>
              <input type="text" class="form-control" id="minutoSubstitucion" placeholder="1-45">
            </div>    
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" id="btn-GenerarSubtitucion" class="btn btn-primary">Generar Subtitucion</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal Observaciones -->
<div class="modal fade" id="modalObserciones" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Observaciones del Partido</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
       <div class="col-12">
          <label for="" class="form-label">OBSERVACION</label>
          <textarea class="form-control" id="Text-area-observacion" rows="5"  maxlength="255"></textarea>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" id="btn-GenerarObservacion" class="btn btn-primary">Generar Observacion</button>
      </div>
    </div>
  </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.5.4/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="<?=base_url?>easytimer/dist/easytimer.min.js"></script>

<script>
    $(document).ready(function() {
        $('#partidosTurno').DataTable();
    } );
</script>

<script src="<?=base_url?>javascript/main.js"></script>
<script src="<?=base_url?>datatables/datatables.min.js"></script>

<!--script para cargar datos-->
<script>

/*Ajax Insertar Datos*/
$('#btn-GenerarGol').click(function(){
  let minuto = $('#minutoGol').val();
  let selectIdClub = $('#selectClub').val();
  let selectRutJugador = $('#selectJugadores').val();
  let selectIdGol = $('#selectGol').val();
  let selectTiempo = $('#selecttiempo').val();
  
  let idclublocal = $('#idClubLocal').val();
  let idclubvisita = $('#idClubVisita').val();  
  let numeroJugadorG = $('#selectJugadores option:selected').text()  
   
  $.ajax({
    url: "../ajax/php/insertarGolesPartidos.php",
    type: "POST",
    data: {
    idpartidofk: <?=$_GET['partido']?>,
    rutGoleador: selectRutJugador,
    idtipogol: selectIdGol,
    min: minuto,
    tiempo: selectTiempo},
    dataType: "json",
    success: function(respuesta){
      $('#selectClub').val(0);
      $('#selectJugadores').val(0);
      $('#selectGol').val(0);
      $('#selecttiempo').val(0);
      $('#minutoGol').val("");
      
      if(selectIdClub == idclublocal){
        $( "#sucesoLocal" ).append( "<p>El Jugador con numero "+numeroJugadorG+" hizo un gol en el minuto "+minuto+"</p>" );
      }else if(selectIdClub == idclubvisita){ 
        $( "#sucesoVisita" ).append( "<p>El Jugador con numero "+numeroJugadorG+" hizo un gol en el minuto "+minuto+"</p>" );
      }

    $("#modalGoles").modal('hide');//ocultamos el modal
    $('body').removeClass('modal-open');//eliminamos la clase del body para poder hacer scroll
    //$('.modal-backdrop').remove();//eliminamos el backdrop del modal
      
    },
    error: function(){
      console.log("No funciona ");
    }
  })
})

$('#btn-GenerarAmonestacion').click(function(){
  let clubseleccionado = $('#selectClubAmonestaciones').val();
  let jugadorAmonestado = $('#selectJugadoresAmonestaciones').val()
  let IdTarjeta = $('#selectIdTarjeta').val()
  let IdFalta = $('#selectIdFalta').val()
  let Tiempo = $('#selecttiempoAmonestaciones').val()
  let minuto = $('#minutoAmonestacion').val();
  let idclublocal = $('#idClubLocal').val();
  let idclubvisita = $('#idClubVisita').val(); 
  let numeroJugadorA = $('#selectJugadoresAmonestaciones option:selected').text()
  let tipoTarjetaA = $('#selectIdTarjeta option:selected').text()

  $.ajax({
    url: "../ajax/php/insertarAmonestacionesPartidos.php",
    type: "POST",
    data: {
    idpartidofk: <?=$_GET['partido']?>,
    rutamonestado: jugadorAmonestado,
    idtipotarjeta: IdTarjeta,
    idtipofalta: IdFalta,
    min: minuto,
    tiempo: Tiempo},
    dataType: "json",
    success: function(respuesta){
      $('#selectClubAmonestaciones').val(0);
      $('#selectJugadoresAmonestaciones').val(0)
      $('#selectIdTarjeta').val(0)
      $('#selectIdFalta').val(0)
      $('#selecttiempoAmonestaciones').val(0);
      $('#minutoAmonestacion').val("");
         
      if(clubseleccionado == idclublocal){
        $( "#sucesoLocal" ).append( "<p>El Jugador con numero "+numeroJugadorA+" se le puso tarjeta "+tipoTarjetaA+"</p>" );
      }else if(clubseleccionado == idclubvisita){ 
        $( "#sucesoVisita" ).append( "<p>El Jugador con numero "+numeroJugadorA+" se le puso tarjeta "+tipoTarjetaA+"</p>" );
      }else{
        alert("No funca");
      }
        
    },
    error: function(){
      console.log("No funciona ");
    }
  })
})


$('#btn-GenerarSubtitucion').click(function(){
  let clubseleccionaSubtitucion = $('#selectclubsustituciones').val();
  let jugadorSale = $('#selectjugadorSale').val();
  let jugadorEntra = $('#selectjugadorEntra').val();
  let Tiempo = $('#selecttiempoSubtituciones').val();
  let minuto = $('#minutoSubstitucion').val();
  let idclublocal = $('#idClubLocal').val();
  let idclubvisita = $('#idClubVisita').val();
  let numeroSale = $('#selectjugadorSale option:selected').text();
  let numeroEntra = $('#selectjugadorEntra option:selected').text();


  $.ajax({
    url: "../ajax/php/insertSubtitucionPartido.php",
    type: "POST",
    data: {
    idpartidofk: <?=$_GET['partido']?>,
    rutjugadorEntra: jugadorEntra,
    rutjugadorSale: jugadorSale,
    min: minuto,
    tiempo: Tiempo},
    dataType: "json",
    success: function(respuesta){
      $('#selectclubsustituciones').val(0);
      $('#selectjugadorSale').val(0)
      $('#selectjugadorEntra').val(0)
      $('#selecttiempoSubtituciones').val(0)    
      $('#minutoSubstitucion').val("");
    
   
      if(clubseleccionaSubtitucion == idclublocal){
        $( "#sucesoLocal" ).append( "<p>El Jugador con numero "+numeroEntra+" subtituye al jugador con nuemro "+numeroSale+"</p>" );
      }else if(clubseleccionaSubtitucion == idclubvisita){ 
        $( "#sucesoVisita" ).append( "<p>El Jugador con numero "+numeroEntra+" subtituye al jugador con nuemro "+numeroSale+"</p>" );
      }else{
        alert("No funca");
      }
    },
    error: function(){
      console.log("No funciona ");
    }
  }) 
})

$('#btn-GenerarObservacion').click(function(){
   let observacion = $('#Text-area-observacion').val();
   let rut_Turno = <?php echo $_SESSION['RutUsuario'] ?>;
   
   $.ajax({
    url: "../ajax/php/insertarObservacionPartidos.php",
    type: "POST",
    data: {
    idpartidofk: <?=$_GET['partido']?>,
    observacion: observacion,
    rutturno: rut_Turno},
    dataType: "json",
    success: function(respuesta){
      $('#Text-area-observacion').val("");     
    },
    error: function(){
      console.log("No funciona ");
    }
  }) 

})
/*=======================================*/
/*CARGAR JUGADORES A MODAL GOLES*/
$("#selectClub").change(function(){
    let IdCLub = $(this).val();
    $("#selectJugadores").html("");
    let opcionDefault = document.createElement("option");
    opcionDefault.value = "0";
    opcionDefault.text = "Seleccionar Jugador";
    document.getElementById("selectJugadores").appendChild(opcionDefault);

    $.ajax({
        url: "../ajax/php/obtenerJugadoresPorClub.php",
        type: "POST",
        data: {idClubphp: IdCLub,idpartido: <?=$_GET['partido']?>},
        dataType: "json",
        success: function(respuesta){
            respuesta.forEach( jugadoresClub => {
                let opcion = document.createElement("option");
                opcion.value = jugadoresClub.RUT_PERSONA_FK;
                opcion.text = jugadoresClub.NUMERO_JUGADOR;
                document.getElementById("selectJugadores").appendChild(opcion);
            });
        },
        error: function(){
            console.log("No funciona cargar jugadores");
        }
    })
});
/*===================================================================================*/
/*CARGAR JUGADORES A MODAL AMONESTACIONES*/
$("#selectClubAmonestaciones").change(function(){
    let IdCLub = $(this).val();
    $("#selectJugadoresAmonestaciones").html("");
    let opcionDefault = document.createElement("option");
    opcionDefault.value = "0";
    opcionDefault.text = "Seleccionar Jugador";
    document.getElementById("selectJugadoresAmonestaciones").appendChild(opcionDefault);

    $.ajax({
        url: "../ajax/php/obtenerJugadoresPorClub.php",
        type: "POST",
        data: {idClubphp: IdCLub,idpartido: <?=$_GET['partido']?>},
        dataType: "json",
        success: function(respuesta){
            respuesta.forEach( jugadoresClub => {
                let opcion = document.createElement("option");
                opcion.value = jugadoresClub.RUT_PERSONA_FK;
                opcion.text = jugadoresClub.NUMERO_JUGADOR;
                document.getElementById("selectJugadoresAmonestaciones").appendChild(opcion);
            });
        },
        error: function(){
            console.log("No funciona cargar jugadores");
        }
    })
});
/*===================================================================================*/
/*CARGAR JUGADOR ENTRANTES Y SALIENTES A MODAL SUBTITUCIONES*/
$("#selectclubsustituciones").change(function(){
    let IdCLub = $(this).val();

    $("#selectjugadorSale").html("");
    let opcionDefault = document.createElement("option");
    opcionDefault.value = "0";
    opcionDefault.text = "Seleccionar Jugador Saliente";
    document.getElementById("selectjugadorSale").appendChild(opcionDefault);

    $.ajax({
        url: "../ajax/php/obtenerJugadoresPorClub.php",
        type: "POST",
        data: {idClubphp: IdCLub,idpartido: <?=$_GET['partido']?>},
        dataType: "json",
        success: function(respuesta){
            respuesta.forEach( jugadoresClub => {
                let opcion = document.createElement("option");
                opcion.value = jugadoresClub.RUT_PERSONA_FK;
                opcion.text = jugadoresClub.NUMERO_JUGADOR;
                document.getElementById("selectjugadorSale").appendChild(opcion);
            });
        },
        error: function(){
            console.log("No funciona cargar jugadores");
        }
    }) 
});
$('#selectjugadorSale').change(function(){
  let IdCLub = $('#selectclubsustituciones').val();
  let RutJugadorS = $(this).val();
  
  $("#selectjugadorEntra").html("");
  let opcionDefault = document.createElement("option");
  opcionDefault.value = "0";
  opcionDefault.text = "Seleccionar Jugador Entrante";
  document.getElementById("selectjugadorEntra").appendChild(opcionDefault);
  
  $.ajax({
      url: "../ajax/php/obtenerJugadoresNoSeleccionado.php",
      type: "POST",
      data: {idClubphp: IdCLub,idpartido: <?=$_GET['partido']?>,rutpersona: RutJugadorS},
      dataType: "json",
      success: function(respuesta){
        respuesta.forEach( jugadoresClub => {
          let opcion = document.createElement("option");
            opcion.value = jugadoresClub.RUT_PERSONA_FK;
            opcion.text = jugadoresClub.NUMERO_JUGADOR;
            document.getElementById("selectjugadorEntra").appendChild(opcion);
        });
      },
      error: function(){
        console.log("No funciona cargar jugadores");
      }
  }) 
  
});
/*===================================================================================*/

$('#btnTerminarPartido').click(function(){
  $.ajax({
      url: "../ajax/php/terminarPartido.php",
      type: "POST",
      data: {partido:<?=$_GET['partido']?>},
      dataType: "json",
      success: function(respuesta){
        let golesLocal = respuesta.golesLocal.length;
        let golesVisita = respuesta.golesVisita.length;
        if(golesLocal>golesVisita){
          console.log("Gano el equipo Local");
          document.location.href='<?=base_url?>turno/terminarPartido&partido=<?=$_GET['partido']?>&ganador=<?=$datosPartido->ID_CLUB_LOCAL_FK?>&perdedor=<?=$datosPartido->ID_CLUB_VISITA_FK?>&gg='+golesLocal+'&gp='+golesVisita+'';
        }else if(golesLocal<golesVisita){
          console.log("Gano el equipo Visitante");
          document.location.href='<?=base_url?>turno/terminarPartido&partido=<?=$_GET['partido']?>&ganador=<?=$datosPartido->ID_CLUB_VISITA_FK?>&perdedor=<?=$datosPartido->ID_CLUB_LOCAL_FK?>&gg='+golesVisita+'&gp='+golesLocal+'';
        }else{
          console.log("Han empatado");
          document.location.href='<?=base_url?>turno/terminarPartido&partido=<?=$_GET['partido']?>&empate=1';
        }
      },
      error: function(){
        console.log("No funciona cargar jugadores");
      }
  }) 
})
</script>