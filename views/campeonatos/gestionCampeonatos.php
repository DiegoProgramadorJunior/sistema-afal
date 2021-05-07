<div class="container mt-3">
    <div class="container mt-5 col-6">

        <?php if(isset($campeonatoSeleccionado) && isset($_GET['in'])):?>
        <form action="<?=base_url?>campeonatos/editar&id=<?=$_GET['id']?>&in=<?=$_GET['in']?>" method="POST" class="border p-5 needs-validation" novalidate>

        <?php elseif(isset($campeonatoSeleccionado)):?>
        <form action="<?=base_url?>campeonatos/editar&id=<?=$_GET['id']?>" method="POST" class="border p-5 needs-validation" novalidate>

        <?php elseif(isset($_GET['in'])):?>
        <form action="<?=base_url?>campeonatos/crear&in=<?=$_GET['in']?>" method="POST" class="border p-5 needs-validation" novalidate>

        <?php else:?>
        <form action="<?=base_url?>campeonatos/crear" method="POST" class="border p-5 needs-validation" novalidate>
        <?php endif; ?>

            <?php if(isset($campeonatoSeleccionado)):?>
            <h1 class="pb-3">Editar campeonato</h1>
            <p id="mensajealerta" class="alert alert-success ">Verificar los datos.</p>
            <?php else:?>
            <h1 class="pb-3">Crear campeonato</h1>
            <p id="mensajealerta" class="alert alert-success">Todos Los campos son obligatorios.</p>
            <?php endif; ?>
            
            <?php if(isset($_SESSION['mensajeError'])):?>
                <p class="alert alert-danger">La acción no se ha podido llevar a cabo. Vuelva a intentarlo por favor.</p>
            <?php endif; ?>
            <?php if(isset($_GET['error']) && $_GET['error']=="fechainiciocampeonato"):?>
                <p class="alert alert-danger">La acción no se ha podido llevar a cabo. Verifique que la fecha sea mayor o igual a la actual.</p>
            <?php endif; ?>
            
            <?php if(isset($campeonatoSeleccionado)):?>
            <div class="">
                <input class="form-control" id="idCampeonato" name="idCampeonato" type="hidden" value="">
            </div>
            <?php endif; ?>
            <input class="form-control" id="usuario" name="NombreUsuario" type="hidden" value="<?php echo $_SESSION['NombreUsuario']?>">

            <input class="form-control" id="rut" name="rutUsuario" type="hidden" value="<?php echo $_SESSION['RutUsuario']?>">

            <div class="mt-3">
                <label for="nombreAsociacion" class="form-label">NOMBRE CAMPEONATO</label>
                <input class="form-control" id="nombreAsociacion" name="nombreCampeonato" type="text" value="" placeholder="Campeonato AFAL 202X" required>
                <div class="valid-feedback">Correcto.</div>
                <div class="invalid-feedback">Por favor ingrese un nombre para el campeonato.</div>
            </div>

            <div class="mt-3">
                <label for="" class="form-label">FECHA DE INICIO</label>
                <input id="dateFechaInicio" type="date" name="fechaInicioCampeonato" class="form-control" required>
                <div class="valid-feedback">Correcto.</div>
                <div class="invalid-feedback">Por favor ingrese una fecha de inicio de campeonato.</div>
            </div>

            <div class="mt-3">
                <label for="" class="form-label">ASOCIACIÓN</label>
                <select id="selectAsociacion" class="form-select" name="nombreAsociacion" aria-label="Default select example" required>
                    <option disabled value="" selected>Seleccionar Asociación</option>
                    <?php while($asociacion = mysqli_fetch_assoc($todasLasAsociaciones)){?>
                    <option value="<?php echo $asociacion['ID_ASOCIACION'];?>"><?php echo $asociacion['NOMBRE_ASOCIACION'];?></option>
                    <?php } mysqli_free_result($todasLasAsociaciones);?>
                </select>
                <div class="valid-feedback">Correcto.</div>
                <div class="invalid-feedback">Por favor seleccione una asociacion.</div>
            </div>

            <div class="mt-3">
                <label for="" class="form-label">SERIE</label>
                <select id="selectSerie" class="form-select" name="nombreSerie" aria-label="Default select example" required>
                    <option disabled value=""selected>Seleccionar Serie</option>
                    <?php while($serie = mysqli_fetch_assoc($todasLasSeries)){?>
                        <option value="<?php echo $serie['ID_SERIE'];?>"><?php echo $serie['NOMBRE_SERIE'];?></option>
                    <?php } mysqli_free_result($todasLasSeries);?>
                </select>
                <div class="valid-feedback">Correcto.</div>
                <div class="invalid-feedback">Por favor seleccione una serie.</div>
            </div>

            <?php if(isset($campeonatoSeleccionado)):?>
            <div class="mt-3">
                <label for="" class="form-label">ESTADO CAMPEONATO</label>
                <select id="selectEstado" class="form-select" name="estadoCampeonato" aria-label="Default select example" required>
                    <option value="0" selected>Seleccionar Estado</option>
                    <?php while($estado = mysqli_fetch_assoc($todosLosEstados)){?>
                        <option value="<?php echo $estado['ID_ESTADO_CAMPEONATO'];?>"><?php echo $estado['NOMBRE_ESTADO_CAMPEONATO'];?></option>
                    <?php } mysqli_free_result($todosLosEstados);?>
                </select>
            </div>
            <?php endif; ?>

            <div class="mt-5 d-flex justify-content-end">
                <a href="<?=base_url?>campeonatos/index" class="btn btn-danger mr-2">Cancelar</a>
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

<script>
    function seleccionarOpcion(select,valor){
        $(select).val(valor);
    }
</script>

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
        }
        form.classList.add('was-validated');
      }, false);
    });
  }, false);
})();
</script>

<?php
if(isset($campeonatoSeleccionado)){
    echo "<script>seleccionarOpcion('#idCampeonato','".$campeonatoSeleccionado['ID_CAMPEONATO']."');</script>"; 
    echo "<script>seleccionarOpcion('#nombreAsociacion','".$campeonatoSeleccionado['NOMBRE_CAMPEONATO']."');</script>"; 
    echo "<script>seleccionarOpcion('#dateFechaInicio','".$campeonatoSeleccionado['FECHA_INICIO']."');</script>"; 
    echo "<script>seleccionarOpcion('#selectAsociacion',".$campeonatoSeleccionado['ID_ASOCIACION'].");</script>";
    echo "<script>seleccionarOpcion('#selectSerie',".$campeonatoSeleccionado['ID_SERIE'].");</script>";
    echo "<script>seleccionarOpcion('#selectEstado',".$campeonatoSeleccionado['ID_ESTADO_CAMPEONATO'].");</script>";
}
?>