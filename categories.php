<?php
include("header.php");
require("db.php");
require("DAO.php");

$myCategorie = afficher_les_categories();
$myPlat = afficher_nombre_de_plats();
?>
<div class="d-flex flex-wrap justify-content-center">

<?php if (count($myCategorie) > 6 ): ?>   
<?php $myCategorie = array_slice($myCategorie, 0, 6); ?>
<?php endif; ?>
<?php foreach ($myCategorie as $categorie): ?>
<?php
$count = 0; 
foreach ($myPlat as $plat) {
      if ($plat->id_categorie == $categorie->id) {
        $count++;
      }
    }
?>
<div class="card text-bg-dark mt-5 pt-3 px-2 mx-5 col-3" style="width: 24rem; height: 29rem;" id="card-body">
    <img src="images_the_district/category/<?= $categorie->image ?>" class="card-img-top" alt="<?= $categorie->libelle ?>" height="80%">
    <div class="card-body">
      <h5 class="card-title" id="card-text"><?= $categorie->libelle ?></h5>
      <a href="plats_par_categorie.php?id=<?= $categorie->id ?>" id="btn-style" class="btn"><?= $count == 0 ? "Aucun plat (bientôt disponible !)" : "Voir " . ($count == 1 ? "le plat" : "les " . $count . " plat") . ($count > 1 ? "s" : "") ?></a>
    </div>
</div>
<?php endforeach; ?>
</div>
<div style="margin-top : 50px;">
<ul class="nav nav-pills justify-content-center">
  <li class="nav-item">
    <a class="nav-link active" id="btn-style" href="categories2.php">Suivant</a>
  </li>
</ul> 
</div>
<?php include("footer.php"); ?>