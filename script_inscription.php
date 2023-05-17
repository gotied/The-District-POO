<?php
$nom_prenom = (isset($_POST['nom_prenom']) && $_POST['nom_prenom'] != "") ? $_POST['nom_prenom'] : Null;
$email = (isset($_POST['email']) && $_POST['email'] != "") ? $_POST['email'] : Null;
$password = (isset($_POST['password']) && $_POST['password'] != "") ? $_POST['password'] : Null;

require_once("DAO.php");
$inscription = inscription($nom_prenom, $email, $password);

if($inscription !== false){
    $to = $email;
    $subject = 'Votre inscription '.$nom;
    $message = 'Vous êtes maintenant incrits !';
    $headers = 'From: admin@the_district.fr';
    
    mail($to, $subject, $message, $headers);
    }

echo '<script>window.location.href="connexion.php";</script>';
exit;
?>