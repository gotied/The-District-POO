<?php
include("header.php");
require("db.php");
require("DAO.php");

$myPlat = afficher_tout_les_plats();
?>
<div class="d-flex flex-wrap justify-content-center">
<?php if (count($myPlat) > 6 ): ?>    
<?php $myPlat = array_slice($myPlat, 6, 12); ?>
<?php endif; ?>
<?php foreach ($myPlat as $plat): ?>

<div class="card text-bg-dark my-5 pt-3 px-2 mx-5 col-3" style="width: 25rem; " id="card-body">
  <img src="images_the_district/food/<?= $plat->image ?>" class="card-img-top" alt="<?= $plat->libelle ?>">
  <div class="card-body">
    <h5 class="card-title" id="card-text"><?= $plat->libelle ?></h5>
    <p class="card-text" id="card-text"><?= $plat->description ?><br><br>Prix : <?= $plat->prix ?>€</p>
    <a href="commande.php?id=<?= $plat->id ?>" id="btn-style" class="btn btn-primary">Commander</a>
  </div>
</div>
<?php endforeach; ?>
</div>
<div style="margin-top : 50px;">
<ul class="nav nav-pills justify-content-center">
<li class="nav-item">
    <a class="nav-link active" id="btn-style" href="tout_les_plats.php">Précédent</a>
  </li>
  <!--<li class="nav-item">
    <a class="nav-link active" id="btn-style" href="#">Suivant</a>
  </li>-->
</ul> 
</div>
<?php include("footer.php"); ?>