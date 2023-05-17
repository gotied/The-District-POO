<?php 
session_start();

if (!isset($_SESSION['user']) || empty($_SESSION['user'])) {
    header('Location: connexion.php');
    exit();
}

$id_commande = (isset($_GET['id']) && $_GET['id'] != "") ? $_GET['id'] : Null;

require_once("DAO.php");
delete_commande($id_commande);

echo '<script>alert("Commande supprimé !"); window.location.href="page_admin.php";</script>';
exit;
?>