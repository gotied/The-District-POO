<?php
require("db.php");
require("DAO.php");

$search = $_GET['search'];

$myplat = recherche_de_plat($search);

include("header.php");
?>
<?php foreach ($myplat as $plat): ?>

<div class="d-flex flex-wrap justify-content-center">
    <div class="card text-bg-dark my-5 pt-3 px-2 mx-5 col-3" style="width: 18rem; " id="card-body">
        <img src="images_the_district/food/<?= $plat->image ?>" class="card-img-top" alt="<?= $plat->libelle ?>">
        <div class="card-body">
            <h5 class="card-title" id="card-text"><?= $plat->libelle ?></h5>
            <p class="card-text" id="card-text"><?= $plat->description ?><br><br>Prix : <?= $plat->prix ?>€</p>
            <a href="test5.php?id=<?= $plat->id ?>" id="btn-style" class="btn btn-primary">Commander</a>
        </div>
    </div>
<?php endforeach; ?>
</div>
</div>
<?php include("footer.php"); ?>