<?php 
session_start();

if (!isset($_SESSION['user']) || empty($_SESSION['user'])) {
    header('Location: connexion.php');
    exit();
}

$actif = (isset($_POST['active']) && $_POST['active'] != "") ? $_POST['active'] : Null;
$id_plat = (isset($_POST['id_plat']) && $_POST['id_plat'] != "") ? $_POST['id_plat'] : Null;

require_once("DAO.php");
modif_etat_plat($id_plat, $actif);

echo '<script>alert("Modification confirmé !"); window.location.href="page_admin.php";</script>'; 
exit;
?>