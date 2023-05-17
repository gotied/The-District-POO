<?php
include("header.php");
require("db.php");
require("DAO.php");
$myPlat = afficher_plat_par_categorie();
?>

<div class="d-flex flex-wrap justify-content-center">

<?php foreach ($myPlat as $plat): ?>

<div class="card text-bg-dark my-5 pt-3 px-2 mx-5 col-3" style="width: 18rem;" id="card-body">
  <img src="images_the_district/food/<?= $plat->image ?>" class="card-img-top" alt="<?= $plat->libelle ?>" height="70%">
  <div class="card-body">
    <h5 class="card-title" id="card-text"><?= $plat->libelle ?></h5>
    <p class="card-text" id="card-text"><?= $plat->description ?><br><br>Prix : <?= $plat->prix ?>€</p>
    <a href="commande.php?id=<?= $plat->id ?>" id="btn-style" class="btn btn-primary">Commander</a>
  </div>
</div>
<?php endforeach; ?>
</div>
<ul class="nav nav-pills justify-content-center">
    <li class="nav-item">
    <a class="nav-link active" id="btn-style" href="categories.php">Retour aux catégories</a>
    </li>
</ul> 
<?php include("footer.php"); ?>