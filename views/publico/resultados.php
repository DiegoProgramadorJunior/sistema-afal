<div class="container">
    <div class="w-100 d-flex justify-content-between mt-4 menu-btns">
    <?php while($serie = mysqli_fetch_assoc($todasLasSeries)){?>
        <button class="btn btn-secondary" style="min-width: 150px;" onclick="document.location.href='<?=base_url?>publico/resultados&serie=<?=$serie['ID_SERIE']?>'"> <?php echo $serie['NOMBRE_SERIE']?></button>
    <?php }?>   
    </div>
        <?php

            if((isset($_GET['serie'])) && ((int)$_GET['serie']==1)){
                echo '<h2 class="text-center">Resultados del campeonato de serie de 50</h2>';
            }elseif((isset($_GET['serie'])) && ((int)$_GET['serie']==2)){
                echo '<h2 class="text-center">Resultados del campeonato de serie de 45</h2>';
            }elseif((isset($_GET['serie'])) && ((int)$_GET['serie']==3)){
                echo '<h2 class="text-center">Resultados del campeonato de serie de 35</h2>';
            }elseif((isset($_GET['serie'])) && ((int)$_GET['serie']==4)){
                echo '<h2 class="text-center">Resultados del campeonato de serie de segunda</h2>';
            }elseif((isset($_GET['serie'])) && ((int)$_GET['serie']==5)){
                echo '<h2 class="text-center">Resultados del campeonato de serie de honor</h2>';
            }
        ?>
    <div class="contenedor-partidos pt-5">
        <?php while($datosPartido = mysqli_fetch_assoc($partidos)){?>
            <?php 
                $local = new Partido();
                $visita = new Partido();
                $golesLocal = $local->obtenerGoles($datosPartido['ID_CLUB_LOCAL'],$datosPartido['ID_PARTIDO']);
                $golesVisita = $visita->obtenerGoles($datosPartido['ID_CLUB_VISITA'],$datosPartido['ID_PARTIDO']);
            ?>
            <div class="partido-programacion">
                <div class="partido-contenedor">
                    <div class="izquierdaa">
                        <h3><?=$datosPartido['CLUB_LOCAL']?></h3>
                    </div>
                    <h2><?=sizeof($golesLocal)?></h2>
                    <h1>vs</h1>
                    <h2><?=sizeof($golesVisita)?></h2>
                    <div class="derechaa">
                        <h3><?=$datosPartido['CLUB_VISITA']?></h3>
                    </div>
                </div>
                <div class="hora-fecha">
                    <div class="estadio">
                        <?=$datosPartido['ESTADIO_LOCAL']?>
                    </div>
                    <div class="fecha">
                        <?=$datosPartido['FECHA_PARTIDO']?>
                    </div>
                </div>
            </div>
        <?php }?>  

    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.5.4/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="<?=base_url?>javascript/main.js"></script>