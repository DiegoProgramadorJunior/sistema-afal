<div class="container mt-3">
    <div class="container mt-5 col-6">

        <?php if($_GET['in']=="editar"):?>
        <form action="<?=base_url?>serie/editar&idserie=<?=$_GET['idserie']?>&in=<?=$_GET['in']?>" method="POST"  class="border p-5 needs-validation" novalidate>

        <?php elseif($_GET['in']=="crear"):?>
        <form action="<?=base_url?>serie/crear&in=<?=$_GET['in']?>" method="POST"  class="border p-5 needs-validation" novalidate>
        <?php endif; ?>

            <?php if(isset($serieSeleccionada)):?>
            <h1 class="pb-3">Editar Serie</h1>
            <p id="mensajealerta" class="alert alert-success ">Verificar los datos.</p>
            <?php else:?>
            <h1 class="pb-3">Crear Serie</h1>
            <p id="mensajealerta" class="alert alert-success">El campo es obligatorio.</p>
            <?php endif; ?>
            
            <?php if(isset($_GET['error']) && $_GET['error']=="crear"):?>
            <p class="alert alert-danger">Ha ocurrido un error al crear la serie. Vuelva a intentarlo por favor.</p>
            <?php endif; ?>
            
            <?php if(isset($serieSeleccionada)):?>
            <div class="">
                <input class="form-control" id="idCampeonato" name="idSerie" type="hidden" value="<?=$serieSeleccionada['ID_SERIE'];?>">
            </div>
            <?php endif; ?>
            <input class="form-control" id="usuario" name="NombreUsuario" type="hidden" value="<?php echo $_SESSION['NombreUsuario']?>">

            <input class="form-control" id="rut" name="rutUsuario" type="hidden" value="<?php echo $_SESSION['RutUsuario']?>">

            <?php if(isset($serieSeleccionada)):?>
            <div class="">
                <label for="nombreAsociacion" class="form-label">NOMBRE SERIE</label>
                <input class="form-control" id="nombreAsociacion" name="nombreSerie" type="text" value="<?=$serieSeleccionada['NOMBRE_SERIE']?>" required>
            </div>
            <?php else: ?>
            <div class="">
                <label for="nombreAsociacion" class="form-label">NOMBRE SERIE</label>
                <input class="form-control" id="nombreAsociacion" name="nombreSerie" type="text" value="" placeholder="Serie" required>
                <div class="valid-feedback">Correcto.</div>
                <div class="invalid-feedback">Por favor ingrese un nombre para la serie.</div>
            </div>
            <?php endif; ?>


            <div class="mt-5 d-flex justify-content-end">
                <a href="<?=base_url?>serie/index" class="btn btn-danger mr-2">Cancelar</a>
                <?php if(isset($serieSeleccionada)):?>
                <input class="btn btn-success" type="submit" value="Actualizar Serie">
                <?php else:?>
                <input class="btn btn-success" type="submit" value="Crear serie">
                <?php endif; ?>
            </div>

        </form>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.5.4/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="<?=base_url?>javascript/main.js"></script>

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