<div class="container-xl border-bottom border-2 mt-5 border-dark mt-3">
<h1>Listado de clubes</h1>
</div>

<div class="container-xl d-flex flex-nowrap mt-4 border-bottom border-start border-end  border-dark">
<?php while($clubes = mysqli_fetch_assoc($todoslosClubes)){?>
   <div class="m-1"> 
   <a href="<?=base_url?>tecnico/gestiontecnico&id=<?php echo $clubes['ID_CLUB']?>"  class="btn btn-danger"><?php echo $clubes['NOMBRE_CLUB'];?></a>
   </div>
<?php } mysqli_free_result($todoslosClubes);?>
</div>




<script src="<?=base_url?>javascript/main.js"></script>