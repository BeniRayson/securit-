<?php
include "connexion.php"; // Assurez-vous que ce chemin est correct
include "header.php";
?>

<section class="main">

  <div class="flex-container">
    <div class="content-container">
      <div class="form-container">
        <form action="" method="POST">
          <h1>Affecter un employé</h1>
          <br><br>
          <span class="subtitle">Nom de l'employé :</span>
          <br>
          <input type="text" id="nom" name="nom" pattern="[a-zA-Z0-9 ]+" required>
          <br>
          <span class="subtitle">Numero-matricule :</span>
          <br>
          <input type="number" id="numero-matricule" name="numero" required>
          <br>
          <span class="subtitle">Adresse de la mission :</span>
          <br>
          <input type="text" id="adresse" name="adresse" pattern="[a-zA-Z0-9 ]+" required>
          <br><br>
          <input type="submit" value="Affecter" class="button-flex" name="btnValider">
          <?php if ($isLoggedIn): ?>
            <a href="affichage-post.php" class="voir">Voir toutes les entrées</a>
          <?php endif; ?>
        </form>
      </div>
    </div>
  </div>

  <?php
  if (isset($_POST['btnValider'])) {
    $nom_agent = ucfirst(trim($_POST['nom']));
    $numero_matricule = trim($_POST['numero']);
    $adresse_mission = trim($_POST['adresse']);

    // Vérifier si un post avec le même numéro matricule et adresse de mission existe déjà
    $check_duplicate = $bdd->prepare("SELECT * FROM post WHERE numero_matricule = :numero_matricule AND adresse_mission = :adresse_mission");
    $check_duplicate->bindParam(':numero_matricule', $numero_matricule);
    $check_duplicate->bindParam(':adresse_mission', $adresse_mission);
    $check_duplicate->execute();

    // Si aucun doublon n'est trouvé, insérer les données
    if ($check_duplicate->rowCount() == 0) {
      // Utiliser une requête préparée pour éviter les injections SQL
      $post_insertion = $bdd->prepare("INSERT INTO post (nom_agent, numero_matricule, adresse_mission) VALUES (:nom_agent, :numero_matricule, :adresse_mission)");
      $post_insertion->bindParam(':nom_agent', $nom_agent);
      $post_insertion->bindParam(':numero_matricule', $numero_matricule);
      $post_insertion->bindParam(':adresse_mission', $adresse_mission);
      $post_insertion->execute();

      header("location:affichage-post.php");
      exit();
    } else {
      echo "<p class='register failed'>Ce post avec ce numéro matricule et cette adresse existe déjà dans la base de données.</p>";
    }
  }
  ?>

</section>

<?php include "footer.php"; ?>
