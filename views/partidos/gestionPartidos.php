<div class="container mt-3">
    <div class="container mt-5 col-6">

        <?php if(isset($campeonatoSeleccionado) && isset($_GET['in'])):?>
        <form action="<?=base_url?>campeonatos/editar&id=<?=$_GET['id']?>&in=<?=$_GET['in']?>" method="POST" class="border p-5 needs-validation" novalidate>

        <?php elseif(isset($campeonatoSeleccionado)):?>
        <form action="<?=base_url?>campeonatos/editar&id=<?=$_GET['id']?>" method="POST"  class="border p-5 needs-validation" novalidate>

        <?php elseif(isset($_GET['in'])):?>
        <form action="<?=base_url?>partidos/crear&in=<?=$_GET['in']?>&campeonato=<?=$_GET['campeonato']?>" method="POST"  class="border p-5 needs-validation" novalidate>

        <?php else:?>
        <form action="<?=base_url?>partidos/crear&campeonato=<?=$_GET['campeonato']?>" method="POST"  class="border p-5 needs-validation" novalidate>
        <?php endif; ?>

            <?php if(isset($campeonatoSeleccionado)):?>
            <h1 class="pb-3">Editar campeonato</h1>
            <p id="mensajealerta" class="alert alert-success ">Verificar los datos.</p>
            <?php else:?>
            <h1 class="pb-3">Crear Partido</h1>
            <div id="mensajealerta" class="alert alert-success">Ingrese los Datos.</div>
            <?php endif; ?>
            
            <?php if(isset($_GET['error']) && $_GET['error']=="fechacampeonato"):?>
            <p class="alert alert-danger">Debe seleccionar una fecha de campeonato.</p>
            <?php endif;?>

            <?php if(isset($_GET['error']) && $_GET['error']=="clublocal"):?>
            <p class="alert alert-danger">Debe seleccionar un club local.</p>
            <?php endif;?>

            <?php if(isset($_GET['error']) && $_GET['error']=="clubvisita"):?>
            <p class="alert alert-danger">Debe seleccionar un club visitante.</p>
            <?php endif;?>

            <?php if(isset($_GET['error']) && $_GET['error']=="rutturno"):?>
            <p class="alert alert-danger">Debe seleccionar un turno.</p>
            <?php endif;?>

            <?php if(isset($_GET['error']) && $_GET['error']=="arbitroprincipal"):?>
            <p class="alert alert-danger">Debe seleccionar un arbitro principal.</p>
            <?php endif;?>

            <div class="row">
                <div class="col-6">
                    <label for="" class="form-label ">FECHA (*)</label>
                    <input type="date" class="form-control" name="fechapartido" required>
                    <div class="valid-feedback">Correcto.</div>
                    <div class="invalid-feedback">Por favor ingrese una fecha del partido.</div>
                </div>
                <div class="col-6">
                    <label for="a" class="form-label">FECHA CAMPEONATO (*)</label>
                    <select name="fechacampeonato" class="form-select" id="" required>
                        <option disabled value="" selected>Seleccionar Fecha</option>
                        <option value="Primera">Primera</option>
                        <option value="Segunda">Segunda</option>
                        <option value="Tercera">Tercera</option>
                        <option value="Cuarta">Cuarta</option>
                        <option value="Quinta">Quinta</option>
                        <option value="Sexta">Sexta</option>
                        <option value="Septima">Septima</option>
                        <option value="Octava">Octava</option>
                        <option value="Novena">Novena</option>
                        <option value="Decima">Decima</option>
                        <option value="Decima">Decima</option>
                        <option value="Decimaprimera">Decimoprimera</option>
                        <option value="Decimatercera">Decimotercera</option>
                        <option value="Decimacuarta">Decimocuarta</option>
                        <option value="Decimaquinta">Decimoquinta</option>
                        <option value="Decimasexta">Decimosexta</option>
                        <option value="Decimaseptima">Decimoseptima</option>
                        <option value="Decimactava">Decimoctava</option>
                        <option value="Decimanovena">Decimonovena</option>
                        <option value="Vigesima">Vigesima</option>
                        <option value="Vigesimaprimera">Vigesimaprimera</option>
                        <option value="Vigesimasegunda">Vigesimasegunda</option>
                        <option value="Vigesimatercera">Vigesimatercera</option>
                        <option value="Vigesimacuarta">Vigesimacuarta</option>
                        <option value="Vigesimaquinta">Vigesimaquinta</option>
                        <option value="Vigesimasexta">Vigesimasexta</option>
                        <option value="Vigesimaseptima">Vigesimaseptima</option>
                        <option value="Vigesimaoctava">Vigesimaoctava</option>
                        <option value="Vigesimanovena">Vigesimanovena</option>
                        <option value="Trigesima">Trigesima</option>
                        <option value="Trigesimaprimera">Trigesimaprimera</option>
                        <option value="Trigesimasegunda">Trigesimasegunda</option>
                        <option value="Trigesimatercera">Trigesimatercera</option>
                        <option value="Trigesimacuarta">Trigesimacuarta</option>
                        <option value="Trigesimaquinta">Trigesimaquinta</option>
                        <option value="Trigesimasexta">Trigesimasexta</option>
                        <option value="Trigesimaseptima">Trigesimaseptima</option>
                        <option value="Trigesimaoctava">Trigesimaoctava</option>
                    </select>
                    <div class="valid-feedback">Correcto.</div>
                    <div class="invalid-feedback">Por favor seleccione una fecha del campeonato.</div>
                </div>
            </div>

            <div class="row">
                <div class="col-6">
                <label for="a" class="form-label">CLUB LOCAL (*)</label>
                    <select name="clublocal" class="form-select" id="selectClubLocales" required>
                        <option  value="">Seleccionar Local</option>
                    </select>
                    <div class="valid-feedback">Correcto.</div>
                    <div class="invalid-feedback">Por favor seleccione un club de local.</div>                    
                </div>
                <div class="col-6">
                    <label for="a" class="form-label">CLUB VISITA (*)</label>
                    <select name="clubvisita" class="form-select" id="selectClubVisita" required>
                    <option  value="">Seleccionar Visita</option>
                    </select>
                    <div class="valid-feedback">Correcto.</div>
                    <div class="invalid-feedback">Por favor seleccione un club de visita.</div> 
                </div>
            </div>
             
            <div>
                <label for="" class="form-label">TURNO (*)</label>
                <select name="turnopartido" class="form-select" id="" required>
                <option disabled value="" selected>Seleccionar un Turno</option>
                <?php while($turnos = mysqli_fetch_assoc($todosLosTurnos)){?>
                    <option value="<?php echo $turnos['RUT_PERSONA'] ?>" ><?php echo $turnos['NOMBRE_1'].' '.$turnos['NOMBRE_2'].' '.$turnos['APELLIDO_1'].' '.$turnos['APELLIDO_2'] ?></option>
                <?php } mysqli_free_result($todosLosTurnos)?>
                </select>
                <div class="valid-feedback">Correcto.</div>
                <div class="invalid-feedback">Por favor seleccione un turno para el partido.</div> 
            </div>
         
            <div>
                <label for="" class="form-label">ÁRBITRO PRINCIPAL (*)</label>
                <select name="arbitroprincipal" class="form-select" id="arbitroprincipal" required>
                <option value="" selected>Seleccionar arbitros</option>
                <?php while($arbitros = mysqli_fetch_assoc($todosLosArbitros)){?>
                    <option value="<?php echo $arbitros['RUT_PERSONA'] ?>" ><?php echo $arbitros['NOMBRE_1'].' '.$arbitros['NOMBRE_2'].' '.$arbitros['APELLIDO_1'].' '.$arbitros['APELLIDO_2'] ?></option>
                <?php } mysqli_free_result($todosLosArbitros)?>
                </select>
                <div class="valid-feedback">Correcto.</div>
                <div class="invalid-feedback">Por favor seleccione un arbitro principal.</div> 
            </div>
                    
            <div>
                <label for="" class="form-label">PRIMER ÁRBITRO LINEA</label>
                <select name="segundoarbitro" class="form-select" id="segundoarbitro" required>
                <option value="0" selected>Seleccionar arbitros</option>
                </select>
                <div class="valid-feedback">Puede no seleccionar.</div>
                <div class="invalid-feedback">Por favor seleccione primer arbitro linea.</div> 
            </div>

            <div>
                <label for="" class="form-label">SEGUNDO ÁRBITRO LINEA</label>
                <select name="tercerarbitro" class="form-select" id="tercerarbitro" required>
                <option value="0" selected>Seleccionar arbitros</option>
                </select>
                <div class="valid-feedback">Puede no seleccionar.</div>
                <div class="invalid-feedback">Por favor seleccione segundo arbitro linea.</div> 
            </div>

            <div class="mt-5 d-flex justify-content-end">
                <a href="<?=base_url?>partidos/partidos&campeonato=<?=$_GET['campeonato']?>" class="btn btn-danger mr-2">Cancelar</a>
                <?php if(isset($campeonatoSeleccionado)):?>
                <input class="btn btn-success" type="submit" value="Actualizar Campeonato">
                <?php else:?>
                <input class="btn btn-success" type="submit" value="Crear Campeonato">
                <?php endif; ?>
            </div>
        </form>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.5.4/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="<?=base_url?>javascript/main.js"></script>
<script src="<?=base_url?>ajax/javascript/obtenerClubes.js"></script>
<script src="<?=base_url?>ajax/javascript/partidosArbitros.js"></script>

<script>
// Disable form submissions if there are invalid fields
(function() {
  'use strict';
  window.addEventListener('load', function() {
    // Get the forms we want to add validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
          $('#mensajealerta').removeClass('alert-success').addClass('alert-danger');
          $('#mensajealerta').empty();
          $('#mensajealerta').append('Los campos en rojo son obligatorios');
        }
        form.classList.add('was-validated');
      }, false);
    });
  }, false);
})();
</script>

<script>
$(document).ready(function(){
    $.ajax({
        url: "../ajax/php/obtenerClubes.php",
        type: "POST",
        data: {campeonato: <?=$_GET['campeonato']?>},
        dataType: "json",
        success: function(respuesta){
            respuesta.forEach( club => {
                let opcion = document.createElement("option");
                opcion.value = club.ID_CLUB;
                opcion.text = club.NOMBRE_CLUB;
                document.getElementById("selectClubLocales").appendChild(opcion);
            });
        },
        error: function(){
            console.log("No funciona local");
        }
    })
})


$("#selectClubLocales").change(function(){
    let IdCLub = $(this).val();
    $("#selectClubVisita").html("");
    let opcionDefault = document.createElement("option");
    opcionDefault.value = "0";
    opcionDefault.text = "Seleccionar Visita";
    document.getElementById("selectClubVisita").appendChild(opcionDefault);

    $.ajax({
        url: "../ajax/php/obtenerClubRestante.php",
        type: "POST",
        data: {id: IdCLub,idcampeonato: <?=$_GET['campeonato']?>},
        dataType: "json",
        success: function(respuesta){
            respuesta.forEach( clubRestante => {
                let opcion = document.createElement("option");
                opcion.value = clubRestante.ID_CLUB;
                opcion.text = clubRestante.NOMBRE_CLUB;
                document.getElementById("selectClubVisita").appendChild(opcion);
            });
        },
        error: function(){
            console.log("No funciona visita");
        }
    })


});


</script>