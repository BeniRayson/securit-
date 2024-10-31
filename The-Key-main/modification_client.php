<?php 
include "connexion.php";
include "header.php";

// Vérification de l'ID du client pour la modification
if (isset($_GET['mod'])) {
    $id_client = intval($_GET['mod']);
    $modifclient = $bdd->prepare("SELECT * FROM client WHERE id_client = ?");
    $modifclient->execute([$id_client]);
    $recupdata = $modifclient->fetch();

    if (!$recupdata) {
        echo "<p class='register'>Client non trouvé.</p>";
        exit;
    }
} else {
    echo "<p class='register'>Aucun ID de client fourni.</p>";
    exit;
}
?>

<section class="main">
    <div class="flex-container">
        <div class="content-container">
            <div class="form-container">
                <form action="modification_client.php?mod=<?php echo $id_client; ?>" method="POST">
                    <h1>Modifier Client</h1>
                    <br>
                    <span class="subtitle">Nom du client Ou Entreprise:</span>
                    <br>
                    <input type="text" id="nom" name="nom" pattern="[a-zA-Z\s]+" required value="<?php echo htmlspecialchars($recupdata['nom_client']); ?>">
                    <br>
                    <span class="subtitle">Adresse :</span>
                    <br>
                    <input type="text" id="adresse" name="adresse" pattern="[a-zA-Z0-9\s]+" required value="<?php echo htmlspecialchars($recupdata['adresse']); ?>">
                    <br>
                    <span class="subtitle">Nombre d'Employés :</span>
                    <br>
                    <input type="number" id="numero-employe" name="num-employe" required value="<?php echo htmlspecialchars($recupdata['nombre_agent']); ?>">
                    <br><br>
                    <input type="submit" value="Modifier" class="button-flex btnValider" name="btnValider">
                    <br>
                    <?php if ($isLoggedIn): ?>
                        <a href="affichage-client.php" class="voir">Voir toutes les entrées</a>
                    <?php endif; ?>
                </form>
            </div>
        </div>
    </div>

    <?php 
    if (isset($_POST['btnValider'])) {
        $nom = ucfirst(trim($_POST["nom"]));
        $adresse = trim($_POST['adresse']);
        $employe = intval($_POST['num-employe']);

        // Vérifier si le client existe déjà
        $check_duplicate = $bdd->prepare("SELECT * FROM client WHERE nom_client = :nom AND adresse = :adresse AND nombre_agent = :employe AND id_client != :id_client");
        $check_duplicate->bindParam(':nom', $nom);
        $check_duplicate->bindParam(':adresse', $adresse);
        $check_duplicate->bindParam(':employe', $employe);
        $check_duplicate->bindParam(':id_client', $id_client);
        $check_duplicate->execute();

        if ($check_duplicate->rowCount() == 0) {
            // Mise à jour du client
            $update_client = $bdd->prepare("UPDATE client SET nom_client = :nom, adresse = :adresse, nombre_agent = :employe WHERE id_client = :id_client");
            $update_client->bindParam(':nom', $nom);
            $update_client->bindParam(':adresse', $adresse);
            $update_client->bindParam(':employe', $employe);
            $update_client->bindParam(':id_client', $id_client);
            $update_client->execute();
            header("Location: affichage-client.php?message=modification");
            exit();
        } else {
            echo "<p class='register'>Ce client existe déjà dans la base de données.</p>";
        }
    }
    ?>
</section>

<?php include "footer.php"; ?>
