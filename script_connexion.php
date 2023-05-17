<?php
session_start();

$email = $_POST['email'];
$password = $_POST['password'];

require_once("DAO.php");
$user = connexion($email, $password);

$_SESSION['user'] = $user;

header('Location: page_admin.php');
exit();
?>