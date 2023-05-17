<?php 
include("header.php");
require("db.php");
?>
<div class="d-flex flex-wrap justify-content-center">
<div class="card my-5 pt-3 px-2 mx-5 col-3" style="width: 18rem;" id="card-connexion">
<img src="images_the_district/pin-angle-fill.svg" class="card-img-top" alt="..." id="svg-pin">
  <div class="card-body">
    <h5 class="card-title" id="card-text">Connexion :</h5>
    <p class="card-text" id="">
    <form method="POST" action="script_connexion.php">
        <label for="email">Adresse mail : </label>
        <input type="text" name="email" required>
        <br><br>
        <label for="password">Mot de passe : </label>
        <input type="password" name="password" required>
        <br><br>
        <input type="submit" value="Se connecter" id="btn-style">
    </form></p>
  </div>
</div>
</div>
<?php include("footer.php") ?>