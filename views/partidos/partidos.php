<div class="container-xl">
    <div class="row mt-5">
        <div class="col-9" id="titulo">
        <div class="table-responsive">
                <table id="partidosProximos" class="table table-striped table-bordered" style="width:100%;">
                    <thead>
                        <tr>
                            <th>FECHA CAMPEONATO</th>
                            <th>FECHA PARTIDO</th>
                            <th>LOCAL</th>
                            <th>VISITANTE</th>
                            <th>ARBITRO</th>
                            <th>TURNO</th>
                        </tr>
                    </thead>
                    <tbody id="cuerpoPartidosProximos">
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-3 border-left">
        <?php while($campeonatos = mysqli_fetch_assoc($todosLosCampeonatos)){?>
            <div class="campeonato" onclick="document.location.href='<?=base_url?>partidos/partidos&campeonato=<?=$campeonatos['ID_CAMPEONATO']?>'" style="cursor: pointer;">
                <h5><?=$campeonatos['NOMBRE_CAMPEONATO']?></h5>
                <p><?=$campeonatos['NOMBRE_SERIE']?></p>
            </div>
        <?php } mysqli_free_result($todosLosCampeonatos);?> 
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.5.4/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="<?=base_url?>datatables/datatables.min.js"></script>
<script src="<?=base_url?>javascript/main.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script src="<?=base_url?>ajax/javascript/obtenerCampeonatos.js"></script>