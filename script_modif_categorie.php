<?php   
session_start();

if (!isset($_SESSION['user']) || empty($_SESSION['user'])) {
    header('Location: connexion.php');
    exit();
}

$categorie_id = (isset($_POST['categorie_id']) && $_POST['categorie_id'] != "") ? $_POST['categorie_id'] : Null;
$active = (isset($_POST['active']) && $_POST['active'] != "") ? $_POST['active'] : Null;
$pourcentage = (isset($_POST['prix']) && $_POST['prix'] != "") ? $_POST['prix'] : Null;

require_once("DAO.php");
modif_categorie($active, $categorie_id, $pourcentage);

echo '<script>alert("Modification confirmé !"); window.location.href="page_admin.php";</script>'; 
exit; 
?>