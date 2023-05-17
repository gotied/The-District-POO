<?php
require_once("db.php");

// Page index / accueil //

function categorie_les_plus_populaires(){
    $db = connexionBase();
    $requete = $db->query("SELECT COALESCE(total_ventes, 0) AS nbr_vente, categorie.libelle, categorie.image, categorie.id
                        FROM categorie
                        LEFT JOIN (SELECT COUNT(*) AS total_ventes, plat.id_categorie
                                    FROM commande
                                    JOIN plat ON plat.id = commande.id_plat
                                    GROUP BY plat.id_categorie
                                    ) AS ventes_par_categorie
                        ON categorie.id = ventes_par_categorie.id_categorie
                        WHERE categorie.active = 'yes'
                        ORDER BY nbr_vente DESC LIMIT 6");
    $myCategorie = $requete->fetchAll(PDO::FETCH_OBJ);
    $requete->closeCursor();
    return $myCategorie;
}

function plats_les_plus_vendu(){
    $db = connexionBase();
    $requete = $db->query("SELECT COUNT(*) AS nbr_vente, plat.libelle, plat.image, plat.id 
    FROM commande 
    JOIN plat ON plat.id = commande.id_plat 
    WHERE commande.etat = 'livrée'
    GROUP BY plat.libelle 
    ORDER BY nbr_vente 
    DESC LIMIT 3");
    $myPlat = $requete->fetchAll(PDO::FETCH_OBJ);
    $requete->closeCursor(); 
    return $myPlat; 
}

// Page catégories //

function afficher_les_categories(){
    $db = connexionBase();
    $requete = $db->query("SELECT * FROM categorie");
    //WHERE categorie.active = 'yes'
    $myCategorie = $requete->fetchAll(PDO::FETCH_OBJ);
    $requete->closeCursor();
    return $myCategorie;
}

function afficher_nombre_de_plats(){
    $db = connexionBase();
    $requete = $db->query("SELECT * FROM plat JOIN categorie ON plat.id_categorie = categorie.id");
    $myPlat = $requete->fetchAll(PDO::FETCH_OBJ);
    $requete->closeCursor();
    return $myPlat;
}

// Page plats par catégorie //

function afficher_plat_par_categorie(){
    $db = connexionBase();
    $requete = $db->prepare("SELECT DISTINCT plat.* 
                                FROM plat 
                                JOIN categorie ON plat.id_categorie = categorie.id 
                                WHERE plat.id_categorie = ?");
    $requete->execute(array($_GET["id"]));
    $myPlat = $requete->fetchAll(PDO::FETCH_OBJ);
    $requete->closeCursor();
    return $myPlat;
}

// Page tout les plats //

function afficher_tout_les_plats(){
    $db = connexionBase();
    $requete = $db->query("SELECT * FROM plat");
    //WHERE plat.active = 'yes'
    $myPlat = $requete->fetchAll(PDO::FETCH_OBJ);
    $requete->closeCursor();
    return $myPlat;
}

// Page de commande //

function commande_de_plat(){
    $db = connexionBase();
    $requete = $db->prepare("SELECT * FROM plat WHERE plat.id = ?");
    $requete->execute(array($_GET["id"]));
    $myPlat = $requete->fetch(PDO::FETCH_OBJ);
    $requete->closeCursor();
    return $myPlat;
}

// Page admin //

function liste_des_commandes(){
    $db = connexionBase();
    $requete = $db->query("SELECT * FROM commande");
    $myCommande = $requete->fetchAll(PDO::FETCH_OBJ);
    $requete->closeCursor();
    return $myCommande;
}

function liste_des_plats(){
    $db = connexionBase();
    $requete = $db->query("SELECT * FROM plat");
    $myPlat = $requete->fetchAll(PDO::FETCH_OBJ);
    $requete->closeCursor();
    return $myPlat;
}

function liste_des_categories(){
    $db = connexionBase();
    $requete = $db->query("SELECT * FROM categorie");
    $myCategorie = $requete->fetchAll(PDO::FETCH_OBJ);
    $requete->closeCursor();
    return $myCategorie;
}

function liste_des_clients(){
    $db = connexionBase();
    $requete = $db->query("SELECT nom_client, sum(quantite * plat.prix) AS 'chiffre_daffaire'
                                FROM commande 
                                JOIN plat ON commande.id_plat = plat.id 
                                WHERE commande.etat = 'Livrée'
                                GROUP BY nom_client 
                                ORDER BY chiffre_daffaire DESC;");
    $myClient = $requete->fetchAll(PDO::FETCH_OBJ);
    $requete->closeCursor();
    return $myClient;
}

// Page recherche //

function recherche_de_plat($search){
    $db = connexionBase();
    $requete = $db->prepare('SELECT * FROM plat WHERE libelle LIKE "%"?"%";');
    $requete->execute(array($search));
    $myplat = $requete->fetchAll(PDO::FETCH_OBJ);
    $requete->closeCursor();
    return $myplat;
}

// script plat // 

function new_plat($libelle, $description, $prix, $image, $categorie_id, $active){
    $db = connexionBase();
    $requete = $db->prepare("INSERT INTO plat (libelle, description, prix, image, id_categorie, active) VALUES (:libelle, :description, :prix, :image, :id_categorie, :active);");
    $requete->bindValue(":libelle", $libelle, PDO::PARAM_STR);
    $requete->bindValue(":description", $description, PDO::PARAM_STR);
    $requete->bindValue(":prix", $prix, PDO::PARAM_STR);
    $requete->bindValue(":image", $image, PDO::PARAM_STR);
    $requete->bindValue(":id_categorie", $categorie_id, PDO::PARAM_INT);
    $requete->bindValue(":active", $active, PDO::PARAM_STR);
    $requete->execute();
    $requete->closeCursor();
}

function modif_etat_plat($id_plat, $actif){
    $db = connexionBase();
    $requete = $db->prepare("UPDATE plat SET active = :active WHERE id = :id ");
    $requete->bindValue(":id", $id_plat, PDO::PARAM_INT);
    $requete->bindValue(":active", $actif, PDO::PARAM_STR);
    $requete->execute();
    $requete->closeCursor();
}

function delete_plat($id_plat){
    $db = connexionBase();
    $requete = $db->prepare("DELETE FROM plat WHERE id = ?;");
    $requete->execute(array($id_plat));
    $requete->closeCursor();
}

// script categorie // 

function new_categorie($libelle, $image, $active){
    $db = connexionBase();
    $requete = $db->prepare("INSERT INTO categorie (libelle, image, active) VALUES (:libelle, :image, :active);");
    $requete->bindValue(":libelle", $libelle, PDO::PARAM_STR);
    $requete->bindValue(":image", $image, PDO::PARAM_STR);
    $requete->bindValue(":active", $active, PDO::PARAM_STR);
    $requete->execute();
    $requete->closeCursor();
}

function modif_categorie($active, $categorie_id, $pourcentage){
    $db = connexionBase();
    if($active !== false){
        $requete = $db->prepare("UPDATE categorie SET active = :active WHERE id = :id_categorie;");
        $requete->bindValue(":active", $active, PDO::PARAM_STR);
        $requete->bindValue(":id_categorie", $categorie_id, PDO::PARAM_INT);
        $requete->execute();
        $requete->closeCursor();
    }

    if($pourcentage !== false){
        $requete = $db->prepare("UPDATE plat SET prix = prix * (1 + :pourcentage/100) WHERE id_categorie = :id_categorie;");
        $requete->bindValue(":pourcentage", $pourcentage, PDO::PARAM_STR);
        $requete->bindValue(":id_categorie", $categorie_id, PDO::PARAM_INT);
        $requete->execute();
        $requete->closeCursor();
    }
}

function delete_categorie($id_categorie){
    $db = connexionBase();
    $requete = $db->prepare("DELETE FROM categorie WHERE id = ?;");
    $requete->execute(array($id_categorie));
    $requete->closeCursor();
}

// script commande // 

function new_commande($id_plat, $quantite, $total, $date, $etat, $nom, $tel, $email, $adresse){
    $db = connexionBase();
    $requete = $db->prepare("INSERT INTO commande (id_plat, quantite, total, date_commande, etat, nom_client, telephone_client, email_client, adresse_client) VALUES (:idplat, :quantite, :total, :date, :etat, :nom, :tel, :email, :adresse);");
    $requete->bindValue(":idplat", $id_plat, PDO::PARAM_INT);
    $requete->bindValue(":quantite", $quantite, PDO::PARAM_INT);
    $requete->bindValue(":total", $total, PDO::PARAM_STR);
    $requete->bindValue(":date", $date, PDO::PARAM_STR);
    $requete->bindValue(":etat", $etat, PDO::PARAM_STR);
    $requete->bindValue(":nom", $nom, PDO::PARAM_STR);
    $requete->bindValue(":tel", $tel, PDO::PARAM_STR);
    $requete->bindValue(":email", $email, PDO::PARAM_STR);
    $requete->bindValue(":adresse", $adresse, PDO::PARAM_STR);
    $requete->execute();
    $requete->closeCursor();
}

function modif_commande($id_commande, $etat){
    $db = connexionBase();
    $requete = $db->prepare("UPDATE commande SET etat = :etat WHERE id = :id;");
    $requete->bindValue(":id", $id_commande, PDO::PARAM_INT);
    $requete->bindValue(":etat", $etat, PDO::PARAM_STR);
    $requete->execute();
    $requete->closeCursor();
}

function delete_commande($id_commande){
    $db = connexionBase();
    $requete = $db->prepare("DELETE FROM commande WHERE id = ?");
    $requete->execute(array($id_commande));
    $requete->closeCursor();
}

// script connexion / inscription //

function connexion($email, $password){
    $db = connexionBase();
    $requete = $db->prepare('SELECT * FROM utilisateur WHERE email = ?');
    $requete->execute([$email]);
    $user = $requete->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
    echo '<script>alert("Adresse mail inconnu !"); window.location.href="connexion.php";</script>';
    exit();
    }

    if (!password_verify($password, $user['password'])) {
    echo '<script>alert("Mot de passe incorrect !"); window.location.href="connexion.php";</script>';
    exit();
    }
    return $user;
}

function inscription($nom_prenom, $email, $password){
    $db = connexionBase();
    $requete = $db->prepare('SELECT COUNT(*) AS count FROM utilisateur WHERE email = ?');
    $requete->execute([$email]);
    $resultat = $requete->fetch(PDO::FETCH_ASSOC);
    
    if ($resultat['count'] > 0) {
	echo '<script>alert("Erreur ! L\'adresse mail déjà utilisé"); window.location.href="inscription.php";</script>';
	exit;
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $requete2 = $db->prepare('INSERT INTO utilisateur (nom_prenom, email, password) VALUES (?, ?, ?)');
    $requete2->execute([$nom_prenom, $email, $hashed_password]);
    $requete2->closeCursor();
}
?>