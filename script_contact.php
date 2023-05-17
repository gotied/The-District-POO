<?php
$name = $_POST['nom_prenom'];
$from = $_POST['email'];
$subject = $_POST['sujet'];
$message = $_POST['demande'];

$to = 'admin@the_district.fr';
$subject = $subject;
$message = $message;
$headers = 'From: '.$from;
    
mail($to, $subject, $message, $headers);

echo '<script>window.location.href="accueil.php";</script>';
exit;
?>