<?php
session_start();

if (!isset($_SESSION['user']) || empty($_SESSION['user'])) {
    header('Location: connexion.php');
    exit();
}

$id_categorie = (isset($_GET['id']) && $_GET['id'] != "") ? $_GET['id'] : Null;

require_once("DAO.php");
delete_categorie($id_categorie);

echo '<script>alert("Catégorie supprimé !"); window.location.href="page_admin.php";</script>';
exit;
?>