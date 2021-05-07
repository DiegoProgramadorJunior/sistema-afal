<div class="container">
    <div class="w-100 d-flex justify-content-between mt-4 menu-btns">
    <?php while($campeonato = mysqli_fetch_assoc($campeonatos)){?>
        <button class="btn btn-secondary" style="min-width: 150px;" onclick="document.location.href='<?=base_url?>publico/posiciones&campeonato=<?=$campeonato['ID_CAMPEONATO']?>'"> <?php echo $campeonato['NOMBRE_SERIE']?></button>
    <?php }?>   
    </div>

    <div class="contenedor-posiciones pt-5">
        <table class="table">
            <thead>
                <tr>
                    <th>EQUIPO</th>
                    <th>PTS</th>
                    <th>PJ</th>
                    <th>PG</th>
                    <th>PE</th>
                    <th>PP</th>
                    <th>GF</th>
                    <th>GC</th>
                    <th>DIF</th>
                </tr>
            </thead>
            <tbody>
            <?php while($equipo = mysqli_fetch_assoc($tablaPosiciones)){?>
                <tr>
                    <td><?php echo $equipo['NOMBRE_CLUB']?></td>
                    <td><?php echo $equipo['PTS']?></td>
                    <td><?php echo $equipo['PJ']?></td>
                    <td><?php echo $equipo['PG']?></td>
                    <td><?php echo $equipo['PE']?></td>
                    <td><?php echo $equipo['PP']?></td>
                    <td><?php echo $equipo['GF']?></td>
                    <td><?php echo $equipo['GC']?></td>
                    <td><?php echo $equipo['DIF']?></td>
                </tr>
            <?php }?>  
            </tbody>
        </table>

    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.5.4/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="<?=base_url?>javascript/main.js"></script>