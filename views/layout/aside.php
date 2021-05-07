<?php 
if(isset($_SESSION['identity'])){
  $identity = $_SESSION['identity'];
}
?>

<?php if(isset($_SESSION['identity'])):?>
<div id="sidebar" class="active bg-dark">
    <div id="side-container">
      <div class="toggle-btn">
        <span>&#9776</span>
      </div>
      <ul>
      <?php if(isset($_SESSION['identity']) && $identity->ID_PERFIL_FK=="1"):?>
        <li><img src="<?=base_url?>images/escudo_linares.png" class="logo"></li>
        <!--<li><img src="img/logo.jpg" alt="Logo Fazt" class="logo"></li>-->
        <li><a href="<?=base_url?>campeonatos/index"><i class="fas fa-trophy"></i>Campeonatos</a></li>
        <li><a href="<?=base_url?>serie/index"><i class="fas fa-trophy"></i>Series</a></li>
        <li><a href="<?=base_url?>clubes/index"><i class="fas fa-shield-alt"></i>Clubes</a></li>
        <li><a href="<?=base_url?>partidos/index"><i class="fas fa-futbol"></i>Partidos</a></li>
        <li><a href="<?=base_url?>persona/index"><i class="fas fa-male"></i>Personas</a></li>
        <li><a href="<?=base_url?>jugadores/index"><i class="fas fa-users"></i>Jugadores</a></li>
        <li><a href="<?=base_url?>persona/arbitros"><i class="fas fa-gavel"></i>Arbitros</a></li>
        <li><a href="<?=base_url?>tecnico/index"><i class="fas fa-gavel"></i>Tecnicos</a></li>       
        <li><a href="<?=base_url?>usuarios/index"><i class="fas fa-user"></i>Usuarios</a></li>
      <?php elseif(isset($_SESSION['identity']) && $identity->ID_PERFIL_FK=="2"):?>
        <li><img src="<?=base_url?>images/escudo_linares.png" class="logo"></li>
        <li><a href="<?=base_url?>tecnico/inicioTecnico"><i class="fas fa-futbol"></i>Partidos</a></li>
      <?php elseif(isset($_SESSION['identity']) && $identity->ID_PERFIL_FK=="3"):?>
        <li><img src="<?=base_url?>images/escudo_linares.png" class="logo"></li>
        <li><a href="<?=base_url?>turno/index"><i class="fas fa-futbol"></i>Partidos</a></li>
      <?php endif;?>

      </ul>
    </div>
</div>
<?php else:?>
<?php endif; ?>