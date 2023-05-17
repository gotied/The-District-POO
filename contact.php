<?php include("header.php");?>
<div class="d-flex flex-wrap justify-content-center">
<div class="card my-5 pt-3 px-2 mx-5 col-3" style="width: 30rem;" id="card-inscription">
<img src="images_the_district/pin-angle-fill.svg" class="card-img-top" alt="..." id="svg-pin">
<div class="card-body">
    <h5 class="card-title" id="card-text">Contactez-nous :</h5>
    <p class="card-text" id="">
	<form method="post" action="script_contact.php">
        <label for="nom_prenom">Nom & Prénom :</label>
		<input type="text" name="nom_prenom" id="nom_prenom" required><br><br>

		<label for="email">Adresse email :</label>
		<input type="text" name="email" id="email" required><br><br>

		<label for="sujet">Sujet :</label>
		<input type="text" name="sujet" id="sujet" required><br><br>

        <label for="demande">Votre demande :</label>

        <textarea name="demande" rows="4" cols="40" required></textarea><br><br>

        <input type="reset" value="Annuler" id="btn-style-2">
		<input type="submit" value="Envoyer" id="btn-style">
	</form></p>
  </div>
</div>
</div>
<?php include("footer.php"); ?>