<?php 
include("header.php");
require("db.php");
?>
<div class="d-flex flex-wrap justify-content-center">
<div class="card my-5 pt-3 px-2 mx-5 col-3" style="width: 18rem;" id="card-inscription">
<img src="images_the_district/pin-angle-fill.svg" class="card-img-top" alt="..." id="svg-pin">
<div class="card-body">
    <h5 class="card-title" id="card-text">Inscription :</h5>
    <p class="card-text" id="">
	<form method="post" action="script_inscription.php">
        <label for="nom_prenom">Nom & Prénom :</label>
		<input type="text" name="nom_prenom" id="nom_prenom" required><br><br>

		<label for="email">Adresse email :</label>
		<input type="email" name="email" id="email" required><br><br>

		<label for="password">Mot de passe :</label>
		<input type="password" name="password" id="password" required><br><br>

		<input type="submit" value="S'inscrire" id="btn-style">
	</form></p>
  </div>
</div>
</div>
<?php include("footer.php") ?>