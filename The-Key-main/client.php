<?php 
include "connexion.php";
include "header.php";
?>

    <section class="main">

        <div class="flex-container">
            <div class="content-container">
              <div class="form-container">
                <form action="client.php" method="POST">
                  <h1>
                    Nous Engager
                  </h1>
                  <br>
                  <br>
                  <span class="subtitle">Nom du client Ou Entreprise:</span>
                  <br>
                  <input type="text" id="nom" name="nom" pattern="[a-zA-Z\s]+"
                  required>
                  <br>
                  <span class="subtitle">Adresse :</span>
                  <br>
                  <input type="text" id="adresse" name="adresse" pattern="[a-zA-Z0-9\s]+" required>
                  <br>
                  <span class="subtitle">Nombre d'Employeés :</span>
                  <br>
                  <input type="number" id="numero-employe" name="num-employe" required>
                  <br><br>
                  <input type="submit" value="Nous Engager" class="button-flex btnValider" name="btnValider">
                  <br>
                  <?php if ($isLoggedIn): ?>
                    <a href="affichage-client.php" class="voir">Voir toutes les entrées</a>
                    <?php endif; ?>
                </form>
              </div>
            </div>
          </div>

          <?php 
    
            if(isset($_POST['btnValider'])){
                $nom = ucfirst($_POST["nom"]);
                $adresse = $_POST['adresse'];
                $employe = $_POST['num-employe'];

                // Vérifier si le client existe déjà dans la base de données avec nom, adresse et num-employe
                $check_duplicate = $bdd->prepare("SELECT * FROM client WHERE nom_client = :nom AND adresse = :adresse AND nombre_agent = :employe");
                $check_duplicate->bindParam(':nom', $nom);
                $check_duplicate->bindParam(':adresse', $adresse);
                $check_duplicate->bindParam(':employe', $employe);
                $check_duplicate->execute();

                // Si le client n'existe pas, on procède à l'insertion
                if ($check_duplicate->rowCount() == 0) {
                    $client_insertion = "INSERT INTO `client` (`id_client`, `nom_client`, `nombre_agent`, `adresse`) VALUES (NULL, '$nom', '$employe', '$adresse');";      
                    $bdd->exec($client_insertion );
                    header("location:affichage-client.php");
                    
                } else {
                    echo "<p class='register'>Cet Client existe déjà dans la base de données.</p>";
                }

               
            }
        
        ?>


    </section>

    
<?php include "footer.php" ?>
