<?php
include("header.php");
require("db.php");
require("DAO.php");

$myCategorie = categorie_les_plus_populaires();
$myPlat = plats_les_plus_vendu();

session_start();
?>
<?php if (isset($_SESSION['user']) && !empty($_SESSION['user'])) : ?>
  <div class="d-flex flex-wrap justify-content-end">
        <p id="titre_h1-2"><?php echo $_SESSION['user']['nom_prenom']; ?> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-check" viewBox="0 0 16 16">
  <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7Zm1.679-4.493-1.335 2.226a.75.75 0 0 1-1.174.144l-.774-.773a.5.5 0 0 1 .708-.708l.547.548 1.17-1.951a.5.5 0 1 1 .858.514ZM11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0ZM8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4Z"/>
  <path d="M8.256 14a4.474 4.474 0 0 1-.229-1.004H3c.001-.246.154-.986.832-1.664C4.484 10.68 5.711 10 8 10c.26 0 .507.009.74.025.226-.341.496-.65.804-.918C9.077 9.038 8.564 9 8 9c-5 0-6 3-6 4s1 1 1 1h5.256Z"/>
</svg></p>
  </div>
<div class="d-flex flex-wrap justify-content-between">
<a id="btn-gestion" href="page_admin.php">Gestion</a>
        <form method="POST" action="deco.php">
            <input type="submit" name="logout" value="Se déconnecter" id="btn-disconnect">
        </form>
</div>
    <?php else : ?>
        <a href="connexion.php" style="text-decoration: none;" id="btn-style">Connexion <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-add" viewBox="0 0 16 16">
  <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7Zm.5-5v1h1a.5.5 0 0 1 0 1h-1v1a.5.5 0 0 1-1 0v-1h-1a.5.5 0 0 1 0-1h1v-1a.5.5 0 0 1 1 0Zm-2-6a3 3 0 1 1-6 0 3 3 0 0 1 6 0ZM8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4Z"/>
  <path d="M8.256 14a4.474 4.474 0 0 1-.229-1.004H3c.001-.246.154-.986.832-1.664C4.484 10.68 5.711 10 8 10c.26 0 .507.009.74.025.226-.341.496-.65.804-.918C9.077 9.038 8.564 9 8 9c-5 0-6 3-6 4s1 1 1 1h5.256Z"/>
</svg></a>
    <?php endif; ?>

<div class="d-flex flex-wrap justify-content-center" id="div-bar">
  <form method="get" class="d-flex" role="search" id="search-bar" action="page_recherche.php">
    <input class="form-control me-2" type="search" placeholder="Rechercher" aria-label="Search" id="search-bar-style" name="search">
    <button class="btn" id="btn-search-style" type="submit"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
    </svg></button>
  </form>
</div>

<div class="d-flex flex-wrap justify-content-center" style="margin-top: 80px;">
<h1 id="titre_h1">Catégorie les plus populaires</h1>
</div>
<div class="d-flex flex-wrap justify-content-center">

<?php foreach ($myCategorie as $categorie): ?>
<div class="card text-bg-dark mt-5 pt-3 px-2 mx-5 col-3" style="width: 24rem; height: 30rem;" id="card-body">
  <img src="images_the_district/category/<?= $categorie->image ?>" class="card-img-top" alt="<?= $categorie->libelle ?>" height="80%">
  <div class="card-body">
    <h5 class="card-title" id="card-text"><?= $categorie->libelle ?></h5>
    <a href="plats_par_categorie.php?id=<?= $categorie->id ?>" id="btn-style" class="btn">Voir les plats</a>
  </div>
</div>
<?php endforeach; ?>
</div>

<div class="d-flex flex-wrap justify-content-center" style="margin-top: 100px;">
<h1 id="titre_h1">Plats les plus vendus</h1>
</div>
<div class="d-flex flex-wrap justify-content-center">

<?php foreach ($myPlat as $plat): ?>
<div class="card text-bg-dark my-5 pt-3 px-2 mx-5 col-3" style="width: 18rem; height: 20rem;" id="card-body">
  <img src="images_the_district/food/<?= $plat->image ?>" class="card-img-top" alt="<?= $plat->libelle ?>" height="70%">
  <div class="card-body">
    <h5 class="card-title" id="card-text"><?= $plat->libelle ?></h5>
    <a href="commande.php?id=<?= $plat->id ?>" id="btn-style" class="btn">Commander</a>
  </div>
</div>
<?php endforeach; ?>
</div>
<?php include("footer.php"); ?>