<div class="container mt-3">
    <div class="container mt-5 col-6">

        <?php if(isset($datosdeunaPersona) && isset($_GET['in']) && $_GET['in']=="arbitro"):?>
        <form action="<?=base_url?>persona/editar&in=<?=$_GET['in'];?>" method="POST" class="border p-5 needs-validation" novalidate>
        <?php elseif(isset($datosdeunaPersona) && isset($_GET['tec']) && $_GET['tec']=="tecnico"):?>
        <form action="<?=base_url?>persona/editar&tec=<?=$_GET['tec'];?>" method="POST" class="border p-5 needs-validation" novalidate>
        <?php elseif(isset($datosdeunaPersona)):?>
        <form action="<?=base_url?>persona/editar" method="POST" class="border p-5 needs-validation" novalidate>
        <?php else:?>
        <form action="<?=base_url?>persona/crear&in=crear" method="POST" class="border p-5 needs-validation" novalidate>
        <?php endif; ?>
        
            <?php if(isset($_GET['in']) && $_GET['in']=="arbitro"):?>
            <h1 class="pb-3">Editar Arbitro</h1>
            <p id="mensajealerta" class="alert alert-success ">Verificar los datos.</p>
            <?php elseif(isset($_GET['tec']) && $_GET['tec']=="tecnico"):?>
            <h1 class="pb-3">Editar Tecnico</h1>
            <p id="mensajealerta" class="alert alert-success">Verificar los datos.</p>
            <?php elseif(isset($datosdeunaPersona)):?>
            <h1 class="pb-3">Editar Persona</h1>
            <p id="mensajealerta" class="alert alert-success">Verificar los datos.</p>
            <?php else: ?>
                <h1 class="pb-3">Crear Persona</h1>
                <p id="mensajealerta" class="alert alert-success">Todos Los campos son obligatorios.</p>
            <?php endif; ?>
            
            <?php if(isset($_SESSION[' '])):?>
                <p class="alert alert-danger">La acción no se ha podido llevar a cabo. Vuelva a intentarlo por favor.</p>
            <?php endif; ?>          

            <?php if(isset($datosdeunaPersona)):?>
            <div class="">
                <input class="form-control" id="idPersona" name="idPersona" type="hidden" value="">
            </div>
            <?php endif; ?>
            
            <input class="form-control" id="usuario" name="NombreUsuario" type="hidden" value="<?php echo $_SESSION['NombreUsuario']?>">
            <input class="form-control" id="rut" name="rutUsuario" type="hidden" value="<?php echo $_SESSION['RutUsuario']?>">
                       
            <div class=" form-group mt-3">
                <label for="rutPersona" class="form-label">RUT</label>
                <input class="form-control" type="text" id="rutPersona" name="rut" placeholder="Ingrese un RUT" maxlength="12" minlength="12" onkeypress="return isNumber(event)" oninput="checkRut(this)" required />      
                <div id="alerta" class="fade show " >
                    <span id="mensaje">
            
                    </span>
                </div>  
                <div class="valid-feedback">Correcto.</div>
                <div class="invalid-feedback">Por favor ingrese su rut.</div>                
            </div>
      
            
            <div class="row mt-3">
             <div class="col-6">
                <label for="nombrePersona1" class="form-label">PRIMER NOMBRE</label>
                <input class="form-control" id="nombrePersona1" name="nombrePersona1" type="text" required>
                <div class="valid-feedback">Correcto.</div>
                <div class="invalid-feedback">Por favor ingrese su primer nombre.</div>
             </div>
             <div class="col-6">
                <label for="nombrePersona2" class="form-label">SEGUNDO NOMBRE</label>
                <input class="form-control" id="nombrePersona2" name="nombrePersona2" type="text" required>
                <div class="valid-feedback">Correcto.</div>
                <div class="invalid-feedback">Por favor ingrese su segundo nombre.</div>
             </div>
            </div>
            
            <div class="row mt-3">
             <div class="col-6">
                <label for="apellidoPersona1" class="form-label">PRIMER APELLIDO</label>
                <input class="form-control" id="apellidoPersona1" name="apellidoPersona1" type="text" required>
                <div class="valid-feedback">Correcto.</div>
                <div class="invalid-feedback">Por favor ingrese su primer apellido.</div>
             </div>
             <div class="col-6">
                <label for="apellidoPersona2" class="form-label">SEGUNDO APELLIDO</label>
                <input class="form-control" id="apellidoPersona2" name="apellidoPersona2" type="text" required>
                <div class="valid-feedback">Correcto.</div>
                <div class="invalid-feedback">Por favor ingrese su segundo apellido.</div>
             </div>
            </div>

            <div class="mt-3">
                <label for="fechaNacimiento" class="form-label">FECHA NACIMIENTO</label>
                <input class="form-control" id="fechaNacimiento" name="fechaNacimiento" type="date" max="<?php echo date("Y-m-d",strtotime("now -16 year"));?>" required>
                <div class="valid-feedback">Correcto.</div>
                <div class="invalid-feedback">Por favor ingrese su fecha de nacimiento.</div>
            </div>

            <div class="mt-3">
                <label for="numeroTelefono" class="form-label">NUMERO TELEFONO</label>
                <input id="numeroTelefono" type="text" name="numeroTelefono" class="form-control" minlength="9" maxlength="9" required>
                <div class="valid-feedback">Correcto.</div>
                <div class="invalid-feedback">Por favor ingrese su numero telefonico.</div>
            </div>
            
            <div class="mt-3">
                <label for="correoElectronico" class="form-label">CORREO ELECTRONICO</label>
                <input id="correoElectronico" type="email" name="correoElectronico" class="form-control" required>
                <div class="valid-feedback">Correcto.</div>
                <div class="invalid-feedback">Por favor ingrese su correo electronico.</div>
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
                    <label for="" class="form-label">PROVINCIA(*)</label>
                    <select id="selectProvincia" class="form-select" name="provincia" aria-label="Default select example" required>
                        <option disabled value="" selected>Seleccionar Provincia</option>
                        <?php while($provincia = mysqli_fetch_assoc($todasLasProvincias)){?>
                            <option value="<?php echo $provincia['ID_PROVINCIA'];?>"><?php echo $provincia['NOMBRE_PROVINCIA'];?></option>
                        <?php } mysqli_free_result($todasLasProvincias);?>
                    </select>
                <?php else:?>
                    <label for="" class="form-label">PROVINCIA(*)</label>
                    <select id="selectProvincia" class="form-select" name="provincia" aria-label="Default select example" required>
                        <option disabled value="" selected>Seleccionar Provincia</option>
                    </select>
                <?php endif; ?>    
                  <div class="valid-feedback">Correcto.</div>
                  <div class="invalid-feedback">Por favor seleccione una provincia.</div>    
                </div>

                <div class="mt-3 col-4">
                <?php if(isset($todasLasProvincias)):?>
                    <label for="" class="form-label">COMUNA(*)</label>
                    <select id="selectComuna" class="form-select" name="comuna" aria-label="Default select example" required>
                        <option disabled value="" selected>Seleccionar Comuna</option>
                        <?php while($comuna = mysqli_fetch_assoc($todasLasComunas)){?>
                            <option value="<?php echo $comuna['ID_COMUNA'];?>"><?php echo $comuna['NOMBRE_COMUNA'];?></option>
                        <?php } mysqli_free_result($todasLasComunas);?>
                    </select>
                <?php else:?>
                    <label for="" class="form-label">COMUNA(*)</label>
                    <select id="selectComuna" class="form-select" name="comuna" aria-label="Default select example" required>
                        <option disabled value="" selected>Seleccionar Comuna</option>
                    </select>
                <?php endif; ?>   
                    <div class="valid-feedback">Correcto.</div>
                    <div class="invalid-feedback">Por favor seleccione una comuna.</div>    
                </div>
                
            </div>

            <div class="mt-3">
                <label for="callePasaje" class="form-label">CALLE O PASAJE(*)</label>
                <input id="callePasaje" type="text" name="callePasaje" class="form-control" required>
                <div class="valid-feedback">Correcto.</div>
                <div class="invalid-feedback">Por favor ingrese una direccion.</div>   
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

            <div class="form-grop mt-3">
                <label for="" class="form-label">PERFILES</label>
                <select id="selectPerfil" class="form-select" name="perfilPersona" aria-label="Default select example" required>
                    <option disabled value="" selected>Seleccionar Perfil</option>
                    <?php while($perfil = mysqli_fetch_assoc($todosLosPerfiles)){?>
                    <option value="<?php echo $perfil['ID_PERFIL'];?>"><?php echo $perfil['NOMBRE_PERFIL'];?></option>
                    <?php } mysqli_free_result($todosLosPerfiles);?>
                </select> 
                <div class="valid-feedback">Correcto.</div>
                <div class="invalid-feedback">Por favor seleccione un perfil.</div>   
            </div>

            <?php if(isset($datosdeunaPersona)):?>
            <div class="mt-3">
                <label for="" class="form-label">ESTADO PERSONA</label>
                <select id="selectEstado" class="form-select" name="tipoestado" aria-label="Default select example" required>
                    <option disabled value="" selected>Seleccionar Estado</option>
                    <?php while($estado = mysqli_fetch_assoc($todosLosEstados)){?>
                        <option value="<?php echo $estado['ID_TIPO_ESTADO'];?>"><?php echo $estado['NOMBRE_TIPO_ESTADO'];?></option>
                    <?php } mysqli_free_result($todosLosEstados);?>
                </select>
            </div>
            <?php endif; ?>
            <div class="mt-5 d-flex justify-content-end">
                <a href="<?=base_url?>persona/index" class="btn btn-danger mr-2">Cancelar</a>
                <?php if(isset($datosdeunaPersona)):?>
                <input class="btn btn-success" type="submit" value="Actualizar Persona">
                <?php else:?>
                <input class="btn btn-success" type="submit" value="Crear Persona" id="btn-crear">
                <?php endif; ?>
            </div>

        </form>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.5.4/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="<?=base_url?>javascript/main.js"></script>
<script src="<?=base_url?>javascript/cargarInfo.js"></script>
<script src="<?=base_url?>javascript/validarRut.js"></script>
<script src="<?=base_url?>javascript/toastr.js"></script>
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
          $('#mensaje').empty();
        }
        form.classList.add('was-validated');
      }, false);
    });
  }, false);
})();
</script>

<?php 
    if (isset($_GET['errorExiste'])){
        echo '<script>
        toastr.error("El rut ingresado, se encuentra registrado")                    
        </script>';
    }elseif(isset($_GET['errorRut'])){
        echo '<script>
        toastr.error("El rut ingresado no es correcto.")                    
        </script>';
    }else{

    }
?>


<?php if(isset($datosdeunaPersona)){
    echo '<script>';
    echo '$(document).ready(function(){';
    echo "cargarInfo('#rutPersona','".$datosdeunaPersona['RUT_PERSONA']."".$datosdeunaPersona['DV']."');";
    //echo "cargarInfo('#dvPersona','".$datosdeunaPersona['DV']."');";
    echo "cargarInfo('#nombrePersona1','".$datosdeunaPersona['NOMBRE_1']."');";
    echo "cargarInfo('#nombrePersona2','".$datosdeunaPersona['NOMBRE_2']."');";
    echo "cargarInfo('#apellidoPersona1','".$datosdeunaPersona['APELLIDO_1']."');";
    echo "cargarInfo('#apellidoPersona2','".$datosdeunaPersona['APELLIDO_2']."');";    
    echo "cargarInfo('#fechaNacimiento','".$datosdeunaPersona['FECHA_NACIMIENTO']."');";
    echo "cargarInfo('#numeroTelefono','".$datosdeunaPersona['NUMERO_TELEFONO_PERSONA']."');";    
    echo "cargarInfo('#correoElectronico','".$datosdeunaPersona['CORREO_ELECTRONICO']."');";
    echo "cargarInfo('#selectRegion',".$datosdeunaPersona['ID_REGION_FK'].");";
    echo "cargarInfo('#selectProvincia','".$datosdeunaPersona['ID_PROVINCIA_FK']."');";
    echo "cargarInfo('#selectComuna','".$datosdeunaPersona['ID_COMUNA_FK']."');";
    echo "cargarInfo('#callePasaje','".$datosdeunaPersona['CALLE_PASAJE']."');";
    echo "cargarInfo('#selectAsociacion','".$datosdeunaPersona['ID_ASOCIACION_FK']."');";
    echo "cargarInfo('#selectPerfil','".$datosdeunaPersona['ID_PERFIL_FK']."');";
    echo "cargarInfo('#selectEstado','".$datosdeunaPersona['ID_TIPO_ESTADO_FK_PERSONA']."');";
    echo '});';
    echo '</script>';
}
?>
  