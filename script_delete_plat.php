<?php
session_start();

if (!isset($_SESSION['user']) || empty($_SESSION['user'])) {
    header('Location: connexion.php');
    exit();
}

$id_plat = (isset($_GET['id']) && $_GET['id'] != "") ? $_GET['id'] : Null;

require_once("DAO.php");
delete_plat($id_plat);

echo '<script>alert("Plat supprimé !"); window.location.href="page_admin.php";</script>';
exit;
?>