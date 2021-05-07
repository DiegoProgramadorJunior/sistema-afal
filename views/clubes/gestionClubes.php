<div class="container mt-3">
    <div class="container mt-5 col-6">

        <?php if(isset($clubSeleccionado)):?>
        <form action="<?=base_url?>clubes/editar" method="POST"  class="border p-5 needs-validation" novalidate>
        <?php else:?>
        <form action="<?=base_url?>clubes/crear" method="POST"  class="border p-5 needs-validation" novalidate>
        <?php endif; ?>

            <?php if(isset($clubSeleccionado)):?>
            <h1 class="pb-3">Editar Club</h1>
            <p id="mensajealerta" class="alert alert-success ">Verificar los datos.</p>
            <?php else:?>
            <h1 class="pb-3">Crear Club</h1>
            <p id="mensajealerta" class="alert alert-success">Todos Los campos son obligatorios.</p>
            <?php endif; ?>

            <?php if(isset($_GET['errorcreate'])):?>
            <p class="alert alert-danger">No se ha podido crear correctamente el club. Intente nuevamente por favor.</p>
            <?php elseif(isset($_GET['erroredit'])):?>
            <p class="alert alert-danger">No se ha podido actualizar correctamente el club. Intente nuevamente por favor.</p>
            <?php endif; ?>

            <?php if(isset($clubSeleccionado)):?>
            <div class="">
                <input class="form-control" id="idClub" name="idClub" type="hidden" value="<?=$clubSeleccionado['ID_CLUB']?>">
            </div>
            <?php endif; ?>
            <input class="form-control" id="usuario" name="NombreUsuario" type="hidden" value="<?php echo $_SESSION['NombreUsuario']?>">

            <input class="form-control" id="rut" name="rutUsuario" type="hidden" value="<?php echo $_SESSION['RutUsuario']?>">
            <div class="row">
             <div class="col-8">
                <label for="rutClub" class="form-label">RUT</label>
                <input ID="rutClub" class="form-control" name="rutClub" type="numeric" placeholder="12345678" required>
                <div class="valid-feedback">Correcto.</div>
                <div class="invalid-feedback">Por favor ingrese su rut sin Dv.</div>
             </div>
             <div class="col-4">
                <label for="dvClub" class="form-label">DV</label>
                <input id="dvClub" class="form-control" name="dvClub" type="text" placeholder="k o 1-9" required>
                <div class="valid-feedback">Correcto.</div>
                <div class="invalid-feedback">Por favor ingrese su dv.</div>
             </div>
            </div>

            <div class="mt-3">
                <label for="" class="form-label">NOMBRE CLUB</label>
                <input id="nombreClub" type="text" name="nombreClub" class="form-control" required>
                <div class="valid-feedback">Correcto.</div>
                <div class="invalid-feedback">Por favor ingrese el nombre del club.</div>
            </div>
            
            <div class="mt-3">
                <label for="" class="form-label">FUNDACION</label>
                <input id="fechaFundacion" type="date" name="fechaFundacion" class="form-control" required>
                <div class="valid-feedback">Correcto.</div>
                <div class="invalid-feedback">Por favor ingrese fecha de fundacion de club.</div>
            </div>
            
            <div class="mt-3">
                <label for="" class="form-label">NOMBRE ESTADIO</label>
                <input id="nombreEstadio" type="text" name="nombreEstadio" class="form-control" required>
                <div class="valid-feedback">Correcto.</div>
                <div class="invalid-feedback">Por favor ingrese el nombre del estadio del club.</div>
            </div>

            <div class="row">
                <div class="form-group mt-3 col-4">
                    <label for="" class="form-label">REGION(*)</label>
                    <select id="selectRegion" class="form-select" name="region" aria-label="Default select example" required>
                        <option disabled value="" selected>Seleccionar Region</option>
                    </select>
                    <div class="valid-feedback">Correcto.</div>
                    <div class="invalid-feedback">Por favor seleccione una region.</div>   
                </div>

                <div class="mt-3 col-4">

                <?php if(isset($todasLasProvincias)):?>
                    <label for="" class="form-label">PROVINCIA</label>
                    <select id="selectProvincia" class="form-select" name="provincia" aria-label="Default select example" required>
                        <option disabled value="" selected>Seleccionar Provincia</option>
                        <?php while($provincia = mysqli_fetch_assoc($todasLasProvincias)){?>
                            <option value="<?php echo $provincia['ID_PROVINCIA'];?>"><?php echo $provincia['NOMBRE_PROVINCIA'];?></option>
                        <?php } mysqli_free_result($todasLasProvincias);?>
                    </select>
                <?php else:?>
                    <label for="" class="form-label">PROVINCIA</label>
                    <select id="selectProvincia" class="form-select" name="provincia" aria-label="Default select example" required>
                        <option disabled value="" selected>Seleccionar Provincia</option>
                    </select>
                <?php endif; ?>   
                <div class="valid-feedback">Correcto.</div>
                <div class="invalid-feedback">Por favor seleccione una provincia.</div>                               
                </div>

                <div class="mt-3 col-4">
                <?php if(isset($todasLasComunas)):?>
                    <label for="" class="form-label">COMUNA</label>
                    <select id="selectComuna" class="form-select" name="comuna" aria-label="Default select example" required>
                        <option disabled value="" selected>Seleccionar Comuna</option>
                        <?php while($comuna = mysqli_fetch_assoc($todasLasComunas)){?>
                            <option value="<?php echo $comuna['ID_COMUNA'];?>"><?php echo $comuna['NOMBRE_COMUNA'];?></option>
                        <?php } mysqli_free_result($todasLasComunas);?>
                    </select>
                <?php else:?>
                    <label for="" class="form-label">COMUNA</label>
                    <select id="selectComuna" class="form-select" name="comuna" aria-label="Default select example" required>
                        <option disabled value="" selected>Seleccionar Comuna</option>
                    </select>
                <?php endif; ?>
                <div class="valid-feedback">Correcto.</div>
                <div class="invalid-feedback">Por favor seleccione una comuna.</div>      
                </div>
            </div>
   
            <div class="mt-3">
                <label for="rutClub" class="form-label">CALLE</label>
                <input id="calle" class="form-control" name="calle" type="numeric" placeholder="" required>
                <div class="valid-feedback">Correcto.</div>
                <div class="invalid-feedback">Por favor ingrese una direccion.</div> 
            </div>

            <div class="mt-3">
                <label for="rutClub" class="form-label">CORREO</label>
                <input id="correoClub" class="form-control" name="correoClub" type="numeric" placeholder="ejemplo@eje.com" required>
                <div class="valid-feedback">Correcto.</div>
                <div class="invalid-feedback">Por favor ingrese su correo electronico.</div>
            </div>

            <div class="mt-3">
                <label for="" class="form-label">ASOCIACIÓN</label>
                <select id="selectAsociacion" class="form-select" name="nombreAsociacion" aria-label="Default select example" required>
                    <option value="" selected>Seleccionar Asociación</option>
                    <?php while($asociacion = mysqli_fetch_assoc($todasLasAsociaciones)){?>
                    <option value="<?php echo $asociacion['ID_ASOCIACION'];?>"><?php echo $asociacion['NOMBRE_ASOCIACION'];?></option>
                    <?php } mysqli_free_result($todasLasAsociaciones);?>
                </select>
                <div class="valid-feedback">Correcto.</div>
                <div class="invalid-feedback">Por favor seleccione una asociacion.</div>  
            </div>

            <div class="mt-5 d-flex justify-content-end">
                <a href="<?=base_url?>clubes/index" class="btn btn-danger mr-2">Cancelar</a>
                <?php if(isset($clubSeleccionado)):?>
                <input class="btn btn-success" type="submit" value="Actualizar Club">
                <?php else:?>
                <input class="btn btn-success" type="submit" value="Crear Club">
                <?php endif; ?>
            </div>

        </form>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.5.4/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="<?=base_url?>javascript/main.js"></script>
<script src="<?=base_url?>javascript/cargarInfo.js"></script>
<script src="<?=base_url?>ajax/javascript/obtenerRegiones.js"></script>

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
if(isset($clubSeleccionado)){
    echo '<script>';
    echo '$(document).ready(function(){';
    echo "cargarInfo('#rutClub','".$clubSeleccionado['RUT_CLUB']."');";
    echo "cargarInfo('#dvClub','".$clubSeleccionado['DV_CLUB']."');";
    echo "cargarInfo('#nombreClub','".$clubSeleccionado['NOMBRE_CLUB']."');";
    echo "cargarInfo('#fechaFundacion','".$clubSeleccionado['FECHA_FUNDACION_CLUB']."');";
    echo "cargarInfo('#nombreEstadio','".$clubSeleccionado['NOMBRE_ESTADIO']."');";
    echo "cargarInfo('#selectRegion',".$clubSeleccionado['ID_REGION_FK'].");";
    echo "cargarInfo('#selectProvincia','".$clubSeleccionado['ID_PROVINCIA_FK']."');";
    echo "cargarInfo('#selectComuna','".$clubSeleccionado['ID_COMUNA_FK']."');";
    echo "cargarInfo('#calle','".$clubSeleccionado['CALLE_PASAJE']."');";
    echo "cargarInfo('#correoClub','".$clubSeleccionado['CORREO_ELECTRONICO']."');";
    echo "cargarInfo('#selectAsociacion','".$clubSeleccionado['ID_ASOCIACION_FK']."');";
    echo '});';
    echo '</script>';
}
?>
