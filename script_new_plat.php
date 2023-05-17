<?php 
session_start();

if (!isset($_SESSION['user']) || empty($_SESSION['user'])) {
    header('Location: connexion.php');
    exit();
}

$categorie_id = (isset($_POST['categorie_id']) && $_POST['categorie_id'] != "") ? $_POST['categorie_id'] : Null;
$libelle = (isset($_POST['libelle']) && $_POST['libelle'] != "") ? $_POST['libelle'] : Null;
$description = (isset($_POST['description']) && $_POST['description'] != "") ? $_POST['description'] : Null;
$prix = (isset($_POST['prix']) && $_POST['prix'] != "") ? $_POST['prix'] : Null;
$active = (isset($_POST['active']) && $_POST['active'] != "") ? $_POST['active'] : Null;

if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
    if ($_FILES['image']['size'] <= 5000000) {
        $allowed_extensions = array('jpg', 'jpeg', 'png');
        $file_info = pathinfo($_FILES['image']['name']);
        $file_extension = strtolower($file_info['extension']);
        
        if (in_array($file_extension, $allowed_extensions)) {
            $file_name = uniqid('', true) . '.' . $file_extension;
            move_uploaded_file($_FILES['image']['tmp_name'], 'images_the_district/food/' . $file_name);
            $image = $file_name; 
        } 
        else {
            echo '<script>alert("Le type de fichier n\'est pas autorisé (jpg, jpeg, png)"); window.location.href="page_admin.php";</script>';
            exit;
        }
    } 
    else {
        echo '<script>alert("Le fichier est trop volumineux (max. 5 Mo)"); window.location.href="page_admin.php";</script>';
        exit;
    }
} 
else {
    $image = Null;
}

require_once("DAO.php");
new_plat($libelle, $description, $prix, $image, $categorie_id, $active);

echo '<script>alert("Ajout du plat confirmé !"); window.location.href="page_admin.php";</script>'; 
exit;
?>