<div class="container">
    <div class="w-100 d-flex justify-content-between mt-4 menu-btns">
        <?php while ($serie = mysqli_fetch_assoc($todasLasSeries)) { ?>

            <button class="btn btn-secondary" style="min-width: 150px;" onclick="document.location.href='<?= base_url ?>publico/programacion&serie=<?= $serie['ID_SERIE'] ?>'"> <?php echo $serie['NOMBRE_SERIE'] ?></button>

        <?php } ?>
    </div>
    <?php

    while ($Serie02 = mysqli_fetch_assoc($todasLasSeries02)) {

        $hora = substr($Serie02['HORARIO_PARTIDO'], 0, -3);
        if ($Serie02['ID_SERIE'] == $_GET['serie']) {

            echo '<h2 class="text-center">Todos los partidos de la ' . $Serie02['NOMBRE_SERIE'] . ' son a las ' . $hora . ' </h2>';
        }
    }
    ?>
    <div class="contenedor-partidos pt-5">
        <?php while ($datosPartido = mysqli_fetch_assoc($partidos)) { ?>
            <div class="partido-programacion">
                <div class="partido-contenedor">
                    <div class="izquierdaa">
                        <h3><?= $datosPartido['CLUB_LOCAL'] ?></h3>
                    </div>
                    <h1>vs</h1>
                    <div class="derechaa">
                        <h3><?= $datosPartido['CLUB_VISITA'] ?></h3>
                    </div>
                </div>
                <div class="hora-fecha">
                    <div class="estadio">
                        <?= $datosPartido['ESTADIO_LOCAL'] ?>
                    </div>
                    <div class="fecha">
                        <?= $datosPartido['FECHA_PARTIDO'] ?>
                    </div>
                </div>
            </div>
        <?php } ?>

    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.5.4/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="<?= base_url ?>javascript/main.js"></script>