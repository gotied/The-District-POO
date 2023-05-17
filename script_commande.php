<?php
date_default_timezone_set('Europe/Paris');
$date = date("Y-m-d H:i:s");
$etat = "En préparation";
$id_plat = (isset($_POST['id_plat']) && $_POST['id_plat'] != "") ? $_POST['id_plat'] : Null;
$nom = (isset($_POST['nom']) && $_POST['nom'] != "") ? $_POST['nom'] : Null;
$tel = (isset($_POST['tel']) && $_POST['tel'] != "") ? $_POST['tel'] : Null;
$email = (isset($_POST['email']) && $_POST['email'] != "") ? $_POST['email'] : Null;
$adresse = (isset($_POST['adresse']) && $_POST['adresse'] != "") ? $_POST['adresse'] : Null;
$quantite = (isset($_POST['quantite']) && $_POST['quantite'] != "") ? $_POST['quantite'] : Null;
$total = (isset($_POST['Prix']) && $_POST['Prix'] != "") ? $_POST['Prix'] : Null;
$libelle = (isset($_POST['libelle']) && $_POST['libelle'] != "") ? $_POST['libelle'] : Null;

require_once("DAO.php");
$new_commande = new_commande($id_plat, $quantite, $total, $date, $etat, $nom, $tel, $email, $adresse);

if($new_commande !== false){
$to = $email;
$subject = 'Votre commande The District '.$nom;
$message = "Votre commande est en préparation. \n\nRésumé de votre commande :\n"."plat : ".$libelle."\n"."Quantité : ".$quantite."\n"."Prix : ".$total."€";
$headers = 'From: admin@the_district.fr';

mail($to, $subject, $message, $headers);
}

echo '<script>window.location.href="accueil.php";</script>'; 
exit;
?>