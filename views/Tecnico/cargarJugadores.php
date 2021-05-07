<style>

table {
    display: flex;
    flex-flow: column;
    height: 505px;
    width: 100%;
}
table thead {
    /* head takes the height it requires, 
    and it's not scaled when table is resized */
    flex: 0 0 auto;
    width: calc(100% - 0.9em);
}
table tbody {
    /* body takes all the remaining available space */
    flex: 1 1 auto;
    display: block;
    overflow-y: scroll;
}
table tbody tr {
    width: 100%;
}
table thead, table tbody tr {
    display: table;
    table-layout: fixed;
}

table tbody::-webkit-scrollbar{
    height: 8px;
    width: 4px;
}

table tbody::-webkit-scrollbar-thumb {
    background: black;
    border-radius: 4px;
}

table tbody::-webkit-scrollbar-thumb:hover {
    background: #b3b3b3;
    box-shadow: 0 0 2px 1px rgba(0, 0, 0, 0.2);
}

table tbody::-webkit-scrollbar-thumb:active {
    background-color: #999999;
}

</style>

<div class="container">
    <div class="row mt-5">
        <div class="cdf">
            <div class="table-responsive">
                <table id="tablaJugadores" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>RUT</th>
                            <th>NOMBRE</th>
                            <th>DORSAL</th>
                            <TH class="text-center">CONVOCATORIA</TH>
                        </tr>
                    </thead>
                    <tbody id="jugadores">
                    <?php
                        while($jugador=mysqli_fetch_assoc($jugadores)){
                            $edad = $tecnico->calculaEdad($jugador['FECHA_NACIMIENTO']);
                    ?>
                    
                    <?php if(((int)$_GET['serie']==1) && ($edad>=50)):?>
                        <tr>
                            <td><?php echo $jugador['RUT_PERSONA'].'-'.$jugador['DV']?></td>
                            <td><?php echo $jugador['NOMBRE_1'].' '.$jugador['APELLIDO_1'].' '.$jugador['APELLIDO_2']?></td>
                            <td><input type="text" class="form-control" disabled></td>
                            <td><input type="checkbox" id="<?=$jugador['RUT_PERSONA_FK']?>" value="<?=$jugador['ID_PERSONA_JUGADOR']?>" class="input-group radiobtn"></td>
                        </tr>
                    <?php elseif(((int)$_GET['serie']==2) && ($edad>=45)):?>
                        <tr>
                            <td><?php echo $jugador['RUT_PERSONA'].'-'.$jugador['DV']?></td>
                            <td><?php echo $jugador['NOMBRE_1'].' '.$jugador['APELLIDO_1'].' '.$jugador['APELLIDO_2']?></td>
                            <td><input type="text" class="form-control"></td>
                            <td><input type="checkbox" id="<?=$jugador['RUT_PERSONA_FK']?>" value="<?=$jugador['ID_PERSONA_JUGADOR']?>" class="input-group radiobtn"></td>
                        </tr>
                    <?php elseif(((int)$_GET['serie']==3) && ($edad>=35)):?>
                        <tr>
                            <td><?php echo $jugador['RUT_PERSONA'].'-'.$jugador['DV']?></td>
                            <td><?php echo $jugador['NOMBRE_1'].' '.$jugador['APELLIDO_1'].' '.$jugador['APELLIDO_2']?></td>
                            <td><input type="text" class="form-control"></td>
                            <td><input type="checkbox" id="<?=$jugador['RUT_PERSONA_FK']?>" value="<?=$jugador['ID_PERSONA_JUGADOR']?>" class="input-group radiobtn"></td>
                        </tr>
                    <?php elseif(((int)$_GET['serie']==4) || ((int)$_GET['serie']==5) && ($edad>=16)):?>
                        <tr>
                            <td><?php echo $jugador['RUT_PERSONA'].'-'.$jugador['DV']?></td>
                            <td><?php echo $jugador['NOMBRE_1'].' '.$jugador['APELLIDO_1'].' '.$jugador['APELLIDO_2']?></td>
                            <td><input type="text" class="form-control" disabled></td>
                            <td><input type="checkbox" id="<?=$jugador['RUT_PERSONA_FK']?>" value="<?=$jugador['ID_PERSONA_JUGADOR']?>" class="input-group radiobtn"></td>
                        </tr>
                    <?php endif;?>

                    <?php }?>  
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div id="mensajeError" class="w-100 d-flex justify-content-center">
    </div>

    <div class="container-boton d-flex justify-content-center ">
        <button class="btn btn-success" id="enviarNomina">Enviar Nómina</button>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.5.4/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>



<script src="<?=base_url?>javascript/main.js"></script>
<script src="<?=base_url?>datatables/datatables.min.js"></script>

<script>
    $('.btn-eliminar').click(function(){
        let boton = document.getElementById("btnDarTermino");
        let id = $(this).val();
        boton.removeAttribute("onclick");
        boton.setAttribute("onclick","document.location.href='<?=base_url?>campeonatos/eliminar&idcampeonato="+id+"&estadocampeonato=3&user=<?php echo $_SESSION['NombreUsuario'];?>&rutuser=<?php echo $_SESSION['RutUsuario'];?>'");
    });
</script>

<script>
    $(document).ready(function() {
        $('#tablaJugadores').DataTable( {
            language: {
                "decimal": "",
                "emptyTable": "No hay información",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
                "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
                "infoFiltered": "(Filtrado de _MAX_ total entradas)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ Entradas",
                "loadingRecords": "Cargando...",
                "processing": "Procesando...",
                "search": "Buscar:",
                "zeroRecords": "Sin resultados encontrados",
                "paginate": {
                    "first": "Primero",
                    "last": "Ultimo",
                    "next": "Siguiente",
                    "previous": "Anterior"
                }
            },
            paging: false
        });
    });
</script>

<script>
    var listaDeJugadores = [];
    var listaDeDorsales = [];
    var listaDeJugadoresFinal = [];
    var verificacion = true;

    $('.radiobtn').click(function(){
        let tdPadre = $(this).parent(); //Se captura el TD del checkbox
        let tdHermanos = $(tdPadre).siblings(); //Se capturan los hermanos del TD anteriormente capturado
        let tdInput = tdHermanos[2];// De los hermanos capturados, seleccionamos el hermano en la posicion 2
        let objetoInput = $(tdInput).children(); //Al TD hermano, le extraemos su hijo, esto devuelve un array de una sola posicion, que es el input
        let input = objetoInput[0]; //Y por ultimo, sacamos el input del array y lo guardamos en una variable para trabajarlo

        if($(this).prop('checked') == true){
            $(input).prop("disabled",false);
            let jugador = {
                rut: parseInt($(this).val())
            }
            listaDeJugadores.push(jugador);
            if(listaDeJugadores.length>=18){
                $('#tablaJugadores > tbody  > tr > td > .radiobtn').each(function(index, checkbox) { 
                    if(checkbox.checked == false){
                        checkbox.setAttribute("disabled",true);
                    }
                });
            }
        }else{
            $(input).prop("disabled",true);
            listaDeJugadores.forEach( (jugador,i) =>{
                if(jugador.rut==$(this).val()){
                    listaDeJugadores.splice(i,1);
                }
            })
            if(listaDeJugadores.length<=18){
                $('#tablaJugadores > tbody  > tr > td > .radiobtn').each(function(index, checkbox) { 
                    if(checkbox.checked == false){
                        checkbox.removeAttribute("disabled");
                    }
                });
            }
        }
    })

    $('#enviarNomina').click(function(){
        if(listaDeJugadores.length<7){
            $('#mensajeError').html("");
            let mensajeError = "<p class='alert alert-danger'>Debe ingresar al menos 7 jugadores para presentarse</p>";
            $('#mensajeError').append(mensajeError);
        }else{
            $('#mensajeError').html("");
            listaDeDorsales = [];
            $('#tablaJugadores > tbody  > tr').each(function(index, tr) { 
                let hijosTr = $(tr).children();

                let tdInput = hijosTr[2];
                let hijoTd = $(tdInput).children();
                let imput = hijoTd[0];
                let dorsal = parseInt($(imput).val());

                let tdCheck = hijosTr[3];
                let hijoTdCheck = $(tdCheck).children();
                let check = hijoTdCheck[0];

                if(($(check).prop('checked')) && (!isNaN(dorsal))){
                    listaDeDorsales.push(parseInt($(imput).val()));
                }else{
                    $('#mensajeError').html("");
                    let mensajeError = "<p class='alert alert-danger'>Debe ingresar número de dorsal para todos los jugadores</p>";
                    $('#mensajeError').append(mensajeError);
                    return false;
                }
            })

            if(listaDeJugadores.length==listaDeDorsales.length){
                $('#tablaJugadores > tbody  > tr').each(function(index, tr) { 
                    let hijosTr = $(tr).children();
                    let tdInput = hijosTr[2];
                    let hijoTd = $(tdInput).children();;
                    let imput = hijoTd[0];

                    let dorsal = parseInt($(imput).val());

                    if(!isNaN(dorsal)){
                        const result = listaDeDorsales.filter(numero => numero==dorsal);
                        if(result.length>1){
                            verificacion = false;
                            $('#mensajeError').html("");
                            let mensajeError = "<p class='alert alert-danger'>Hay números de dorsal que se repiten</p>";
                            $('#mensajeError').append(mensajeError);
                            return false;
                        }else{
                            verificacion = true;
                        }
                    }else{
                        $('#mensajeError').html("");
                        let mensajeError = "<p class='alert alert-danger'>Debe ingresar número de dorsal para todos los jugadores</p>";
                        $('#mensajeError').append(mensajeError);
                        return false;
                    }
                })

                if(verificacion){
                    //recorro tabla y creo objeto con rut y dorsal para ser enviado
                    $('#tablaJugadores > tbody  > tr').each(function(index, tr) { 
                        let hijosTr = $(tr).children();

                        let tdInput = hijosTr[2];
                        let hijoTd = $(tdInput).children();
                        let imput = hijoTd[0];

                        let tdCheck = hijosTr[3];
                        let hijoTdCheck = $(tdCheck).children();
                        let check = hijoTdCheck[0];

                        let dorsal = parseInt($(imput).val());
                        let idJugador = parseInt($(check).val());

                        if(($(check).prop('checked'))){
                            let jugador = {
                                rut: idJugador,
                                dorsal: dorsal
                            }
                            listaDeJugadoresFinal.push(jugador);
                        }
                    });
                    $('#mensajeError').html("");
                    $.ajax({
                        url: "../ajax/php/cargarJugadoresPartido.php",
                        type: "POST",
                        data: {partido: <?=$_GET['partido']?>,jugadores: JSON.stringify(listaDeJugadoresFinal)},
                        dataType: "json",
                        success: function(respuesta){  
                            if(respuesta==1){
                                document.location.href='<?=base_url?>tecnico/inicioTecnico';
                            }
                        },
                        error: function(){

                        }
                    })
                }
            }   
        }
    })
</script>

