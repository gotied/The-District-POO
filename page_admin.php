<?php 
include("header.php");
require("db.php");
require("DAO.php");
session_start();

if (!isset($_SESSION['user']) || empty($_SESSION['user'])) {
    header('Location: accueil.php');
    exit();
}
$myCommande = liste_des_commandes();
$myPlat = liste_des_plats();
$myCategorie = liste_des_categories();
$myClient = liste_des_clients();
?> 

<button id="liste-commande">Liste des commandes</button>
    <table id="table-commande" style="display:none; background-color:white; border-style:solid;">
        <thead>
            <tr>
                <th>Date</th>
                <th>Plat</th>
                <th>Client</th>
                <th>Téléphone</th>
                <th>Email</th>
                <th>Adresse</th>
                <th>Total</th>
                <th>Quantité</th>
                <th>État</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($myCommande as $commande) : ?>
            <tr>
                <td><?= $commande->date_commande ?></td>
                <td>
                    <?php foreach($myPlat as $plat) : ?> 
                    <?php if ($plat->id == $commande->id_plat) : ?>
                    <?= $plat->libelle ?>
                    <?php endif; ?>
                    <?php endforeach; ?>
                </td>
                <td><?= $commande->nom_client ?></td>
                <td><?= $commande->telephone_client ?></td>
                <td><?= $commande->email_client ?></td>
                <td><?= $commande->adresse_client ?></td>
                <td><?= $commande->total ?>€</td>
                <td><?= $commande->quantite ?></td>
                <td><?= $commande->etat ?></td>
                <td style="border: none;">
                    <button id="btn-style-3" class="btn-modifier">Modifier</button>
                    <div class="div-modifier" style="display:none;">
                        
                            <form action ="script_modif_etat_commande.php" method="post" >
                                <div class="form-check">
                                    <input type="hidden" name="id_commande" value="<?= $commande->id ?>">
                                    <input class="form-check-input" type="checkbox" value="En cours de livraison" id="flexCheckDefault" name="etat">
                                    <label class="form-check-label" for="flexCheckDefault">En cours de livraison</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Livrée" id="flexCheckDefault" name="etat">
                                    <label class="form-check-label" for="flexCheckDefault">Livrée</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Annulée" id="flexCheckDefault" name="etat">
                                    <label class="form-check-label" for="flexCheckDefault">Annulé</label>
                                </div>
                                <input class="btn" type="submit" value="Valider la modification" id="btn-style-5">
                            </form>
                        
                    </div>
                </td>
                <td style="border: none;">
                    <?php if($commande->etat == 'Livrée' || $commande->etat == 'Annulée'): ?>
                    <a href="script_delete_commande.php?id=<?= $commande->id ?>" id="btn-style-4" class="list-group-item list-group-item-action list-group-item-primary">Supprimer</a>
                    <?php endif; ?>
                </td>
                <?php endforeach; ?>
                </div>
      </table>
<script>
  $('#liste-commande').click(function() {
                        $('#table-commande').toggle();
                    });
                </script>
                <script>
                    $(document).ready(function() {
                        $('.btn-modifier').click(function() {
                            $(this).siblings('.div-modifier').toggle();
                         });
                    });
                </script>

<button id="liste-plat">Liste des plats</button>
    <table id="table-plat" style="display:none; background-color:white; border-style:solid;">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Prix</th>
                    <th>Catégorie</th>
                    <th>Actif</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($myPlat as $plat): ?>
                <tr>
                    <td><?= $plat->libelle ?></td>
                    <td><?= $plat->prix ?>€</td>
                    <?php foreach($myCategorie as $categorie): ?>
                        <?php if($categorie->id == $plat->id_categorie): ?>
                            <td><?= $categorie->libelle ?></td>
                        <?php endif; ?>
                    <?php endforeach; ?>
                    <td><?= $plat->active ?></td>
                    <td style="border: none;">
                        <button id="btn-style-6" class="btn-modifier-plat">Modifier</button>
                            <div class="div-modifier-plat" style="display:none;">
                                <p>
                                    Actif : <br>
                                    <form action="script_modif_etat_plat.php" method="post">
                                    <input type="hidden" name="id_plat" value="<?= $plat->id ?>">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" value="Yes" id="flexRadioDefault1" name="active">
                                        <label class="form-check-label" for="flexRadioDefault1">Oui</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" value="No" id="flexRadioDefault1" name="active">
                                        <label class="form-check-label" for="flexRadioDefault1">Non</label>
                                    </div>
                                    <input class="btn" type="submit" value="Valider la modification" id="btn-style-5">
                                    </form> 
                                </p>
                            </div>
                    </td>
                    <td style="border: none;">
                        <?php if($plat->active == 'No') : ?>
                            <a href="script_delete_plat.php?id=<?= $plat->id ?>" id="btn-style-7">Supprimer</a>
                        <?php endif; ?>
                    </td>
            <?php endforeach; ?>
    </table>

<script>
  $('#liste-plat').click(function() {
    $('#table-plat').toggle();
  });
</script>
<script>
    $(document).ready(function() {
        $('.btn-modifier-plat').click(function() {
            $(this).siblings('.div-modifier-plat').toggle();
        });
    });
</script> 

<button id="liste-categorie">Liste des catégories</button>
  <div id="div-categorie" style="display:none;">
    <p><br>
    <button id="new-categorie">Ajouter une nouvelle catégorie</button>
    <div id="div-new-categorie" style="display:none;">
      <p>
      <div class="d-flex flex-wrap justify-content-start">
      <form action="script_new_categorie.php" method="post" enctype="multipart/form-data">
        <div>
          <label for="nom">Nom :</label><br>
          <input type="text" name="nom" id="nom" style="max-width: 150px;" required>
        </div><br>
         <div class="custom-control custom-radio custom-control-inline">
          <label>Actif :</label><br>
          <input name="active" id="radio_0" type="radio" class="custom-control-input" value="Yes" required> 
          <label for="radio_0" class="custom-control-label">Oui</label>
        </div>
        <div class="custom-control custom-radio custom-control-inline">
          <input name="active" id="radio_1" type="radio" class="custom-control-input" value="No" required> 
          <label for="radio_1" class="custom-control-label">Non</label>
        </div> <br>
        <div>
          <label for="image">Image :</label><br>
          <input type="file" name="image" id="image" required>
        </div><br>
        <div>
          <input class="btn btn-primary" type="submit" value="Ajouter">
        </div>
      </form>
      </div>
      </p>
    </div>
        <?php foreach($myCategorie as $categorie) : ?>
        <div class="d-flex flex-wrap justify-content-start">
          <ul class="list-group">
          <li class="list-group-item">Nom</li>
          <li class="list-group-item">Actif</li>
          </ul>
          <ul class="list-group">
          <li class="list-group-item"><?= $categorie->libelle ?></li>
          <li class="list-group-item"><?= $categorie->active ?></li>
          </ul>
          <ul class="list-group" style="list-style-type:none;">
          <li>
            <button class="btn-ajout-plat" id="btn-style-8">Ajouter un plat</button>
              <div class="div-ajout-plat" style="display:none;">
                  <p>
                      <form action ="script_new_plat.php" method="post" enctype="multipart/form-data">
                          <input type="hidden" name="categorie_id" value="<?= $categorie->id ?>">    
                          <label for="libelle">Nom : </label><br>
                          <input type="text" name="libelle" id="libelle" style="max-width: 150px;" required>
                          <br>
                          <label for="description">Description : </label><br>
                          <textarea name="description" id="description" rows="3" style="max-width: 200px;"></textarea>
                          <br>   
                          <label for="prix">Prix : </label><br>
                          <input type="text" name="prix" id="prix" style="max-width: 150px;" required>
                          <br>
                          <label for="active">Actif :</label><br>
                          <div class="form-check">
                              <input class="form-check-input" type="radio" value="Yes" name="active" id="flexRadioDefault1" required>
                              <label class="form-check-label" for="flexRadioDefault1">Oui</label>
                          </div>
                          <div class="form-check">
                              <input class="form-check-input" type="radio" value="No" name="active" id="flexRadioDefault1" required>
                              <label class="form-check-label" for="flexRadioDefault1">Non</label>
                          </div>
                          <br>
                          <label for="image">Image :</label><br>
                          <input type="file" name="image" id="image" required>
                          <br><br>
                          <input class="btn btn-primary" type="submit" value="Ajouter">
                      </form>
                  </p>
              </div> 
          </li>  
          <li>
          <button class="btn-modifier-plat" id="btn-style-8">Modifier</button>
            <div class="div-modifier-categorie" style="display:none;">
            <p>
            <form action ="script_modif_categorie.php" method="post">
            <input type="hidden" name="categorie_id" value="<?= $categorie->id ?>"> 
            <label for="active">Actif</label><br>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="active" value="Yes" id="flexRadioDefault1">
              <label class="form-check-label" for="flexRadioDefault1">Oui</label>
            </div>  <div class="form-check">
              <input class="form-check-input" type="radio" name="active" value="No" id="flexRadioDefault1">
              <label class="form-check-label" for="flexRadioDefault1">Non</label>
            </div><br>
            <label for="active">Augmenter le prix</label><br>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="prix" value="5" id="flexRadioDefault1">
              <label class="form-check-label" for="flexRadioDefault1">5%</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="prix" value="10" id="flexRadioDefault1">
              <label class="form-check-label" for="flexRadioDefault1">10%</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="prix" value="15" id="flexRadioDefault1">
              <label class="form-check-label" for="flexRadioDefault1">15%</label>
            </div>
            <input class="btn btn-primary" type="submit" value="Modifier"> 
            </form>
            </p>
            </div>
          </li>
          <li>
            <?php if($categorie->active == 'No'): ?><a href="script_delete_categorie.php?id=<?= $categorie->id ?>" id="btn-style-9">Supprimer</a><?php endif; ?>
          </li>
          </ul>
        </div>
        <br>
        <?php endforeach; ?>
    </p>
  </div>
<script>
  $('#liste-categorie').click(function() {
    $('#div-categorie').toggle();
  });
</script>
<script>
  $('#new-categorie').click(function() {
    $('#div-new-categorie').toggle();
  });
</script>
<script>
    $(document).ready(function() {
        $('.btn-ajout-plat').click(function() {
            $(this).siblings('.div-ajout-plat').toggle();
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('.btn-modifier-plat').click(function() {
            $(this).siblings('.div-modifier-categorie').toggle();
        });
    });
</script>

<button id="liste-client">Liste des clients</button>
    <div id="div-client" style="display:none;"><br>
    <?php foreach($myClient as $client) : ?>
    <div class="d-flex flex-wrap justify-content-start">
    <ul class="list-group">
    <li class="list-group-item">Nom</li>
    <li class="list-group-item">Chiffre d'affaire</li>
    </ul>

    
    <ul class="list-group">
    <li class="list-group-item"><?= $client->nom_client ?></li>
    <li class="list-group-item"><?= $client->chiffre_daffaire ?>€</li>
    </ul>
    </div><br>
    <?php endforeach; ?>
    </div>
    
    <script>
  $('#liste-client').click(function() {
    $('#div-client').toggle();
  });
</script>
<?php include("footer.php") ?>