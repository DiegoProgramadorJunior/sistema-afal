<div class="container mt-3">
    <div class="container mt-5 col-6">

        <?php if(isset($usuarioSeleccionado) && isset($_GET['in'])):?>
        <form action="<?=base_url?>usuarios/editar&id=<?=$_GET['id']?>&in=<?=$_GET['in']?>" method="POST" class="border p-5">

        <?php elseif(isset($usuarioSeleccionado)):?>
        <form action="<?=base_url?>usuarios/editar&id=<?=$_GET['id']?>" method="POST" class="border p-5">

        <?php elseif(isset($_GET['in'])):?>
        <form action="<?=base_url?>usuarios/crear&in=<?=$_GET['in']?>" method="POST" class="border p-5">

        <?php else:?>
        <form action="<?=base_url?>usuarios/crear" method="POST" class="border p-5">
        <?php endif; ?>

            <?php if(isset($usuarioSeleccionado)):?>
            <h1 class="pb-3">Editar Usuario</h1>
            <?php else:?>
            <h1 class="pb-3">Crear Usuario</h1>
            <?php endif; ?>
            
            <?php if(isset($_SESSION['mensajeError'])):?>
                <p class="alert alert-danger">La acción no se ha podido llevar a cabo. Vuelva a intentarlo por favor.</p>
            <?php endif; ?>

            <?php if(isset($usuarioSeleccionado)):?>
            <div class="">
                <input class="form-control" id="idUsuarios" name="idUsuario" type="hidden" value="">
            </div>
            <?php endif; ?>
            <input class="form-control" id="usuario" name="NombreUsuario" type="hidden" value="<?php echo $_SESSION['NombreUsuario']?>">

            <input class="form-control" id="rut" name="rutUsuario" type="hidden" value="<?php echo $_SESSION['RutUsuario']?>">

            <div class="">
                <label for="nombreUsuario" class="form-label">NOMBRE USUARIO</label>
                <input class="form-control" id="nombreUsuarios" name="nombreUsuario" type="text" value="" required>
            </div>

            <div class="mt-3">
                <label for="claveUsuario" class="form-label">CLAVE USUARIO</label>
                <input id="claveUsuarios" type="Password" name="claveUsuario" class="form-control" required>
            </div>

            <div class="form-grop mt-3">
                <label for="" class="form-label">NOMBRE PERSONA</label>
                <input id="rutpersona" type="text" disabled  name="rutpersona" class="form-control" value="<?php echo $nombrePersona ?>"/>
            </div>
            
            <div class="form-grop mt-3" style="display: none;">
                <label for="" class="form-label">PERSONAS</label>
                <select id="selectRuts" class="form-select" name="rutPersona" aria-label="Default select example" required>
                    <option value="0" selected>Seleccionar Persona</option>
                    <?php while($personas = mysqli_fetch_assoc($todasLasPersonas)){?>
                    <option value="<?php echo $personas['RUT_PERSONA'];?>"><?php echo $personas['NOMBRE_1'].' '.$personas['NOMBRE_2'].' '.$personas['APELLIDO_1'].' '.$personas['APELLIDO_2'];?></option>
                    <?php } mysqli_free_result($todasLasPersonas);?>
                </select> 
            </div>

            <div class="mt-5 d-flex justify-content-end">
                <a href="<?=base_url?>usuarios/index" class="btn btn-danger mr-2">Cancelar</a>
                <?php if(isset($usuarioSeleccionado)):?>
                <input class="btn btn-success" type="submit" value="Actualizar Usuario">
                <?php else:?>
                <input class="btn btn-success" type="submit" value="Crear Usuario">
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


<?php
if(isset($usuarioSeleccionado)){
    echo "<script>seleccionarOpcion('#idUsuarios','".$usuarioSeleccionado['ID_USUARIO']."');</script>"; 
    echo "<script>seleccionarOpcion('#nombreUsuarios','".$usuarioSeleccionado['NOMBRE_USUARIO']."');</script>"; 
    echo "<script>seleccionarOpcion('#claveUsuarios','".$usuarioSeleccionado['CLAVE_USUARIO']."');</script>"; 
    echo "<script>seleccionarOpcion('#selectRuts',".$usuarioSeleccionado['RUT_PERSONA_FK'].");</script>";
    echo "<script>seleccionarOpcion('#selectEstado',".$usuarioSeleccionado['ID_TIPO_ESTADO'].");</script>";
    
}
?>