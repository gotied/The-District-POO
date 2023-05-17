<?php
session_start();

if (!isset($_SESSION['user']) || empty($_SESSION['user'])) {
    header('Location: connexion.php');
    exit();
}

$etat = (isset($_POST['etat']) && $_POST['etat'] != "") ? $_POST['etat'] : Null;
$id_commande = (isset($_POST['id_commande']) && $_POST['id_commande'] != "") ? $_POST['id_commande'] : Null;

require_once("DAO.php");
$modif_commande = modif_commande($id_commande, $etat);

require_once("db.php");
$db = connexionBase();

$requete = $db->query("SELECT * FROM commande WHERE id = $id_commande");
$commande = $requete->fetchAll(PDO::FETCH_OBJ);
$requete->closeCursor();

foreach($commande as $info_client){
    $nom = $info_client->nom_client;
    $email = $info_client->email_client;
}

if($modif_commande !== false){
    if($etat === "En cours de livraison"){
        $to = $email;
        $subject = 'Votre commande arrive !';
        $message = 'Votre commande '.$nom.' passée sur The District est en cours de livraison.';
        $headers = 'From: admin@the_district.fr';
        mail($to, $subject, $message, $headers);
    }
    if($etat === "Livrée"){
        $to = $email;
        $subject = 'Votre commande est livrée !';
        $message = 'Votre commande '.$nom.' passée sur The District a bien été livrée à votre domicile.';
        $headers = 'From: admin@the_district.fr';
        mail($to, $subject, $message, $headers);
    }
    if($etat === "Annulée"){
        $to = $email;
        $subject = 'Votre commande est annulé';
        $message = 'Votre commande '.$nom.' passée sur The District a été annulé.';
        $headers = 'From: admin@the_district.fr';
        mail($to, $subject, $message, $headers);
    }
}

echo '<script>alert("Modification confirmé !"); window.location.href="page_admin.php";</script>'; 
exit; 
?>