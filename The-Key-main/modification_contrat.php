<?php 
include "connexion.php";
include "header.php";

// Vérification de l'ID du contrat pour la modification
if (isset($_GET['id'])) {
    $id_contrat = intval($_GET['id']);
    $modifContrat = $bdd->prepare("SELECT contrat.id_contrat, contrat.date_signature, contrat.date_expiration, client.nom_client FROM contrat JOIN client ON contrat.client_id = client.id_client WHERE contrat.id_contrat = ?");
    $modifContrat->execute([$id_contrat]);
    $recupdata = $modifContrat->fetch();

    if (!$recupdata) {
        echo "<p class='register'>Contrat non trouvé.</p>";
        exit;
    }
} else {
    echo "<p class='register'>Aucun ID de contrat fourni.</p>";
    exit;
}
?>

<section class="main">
    <div class="flex-container">
        <div class="content-container">
            <div class="form-container">
                <form action="modification_contrat.php?id=<?php echo $id_contrat; ?>" method="POST">
                    <h1>Modifier Contrat</h1>
                    <br>
                    <span class="subtitle">Date de Signature :</span>
                    <br>
                    <input type="date" id="date_signature" name="date_signature" required value="<?php echo htmlspecialchars($recupdata['date_signature']); ?>">
                    <br>
                    <span class="subtitle">Date d'Expiration :</span>
                    <br>
                    <input type="date" id="date_expiration" name="date_expiration" required value="<?php echo htmlspecialchars($recupdata['date_expiration']); ?>">
                    <br>
                    <span class="subtitle">Client :</span>
                    <br>
                    <input type="text" id="client" name="client" required value="<?php echo htmlspecialchars($recupdata['nom_client']); ?>">
                    <br><br>
                    <input type="submit" value="Modifier" class="button-flex btnValider" name="btnValider">
                    <br>
                    <?php if ($isLoggedIn): ?>
                        <a href="affichage-contrat.php" class="voir">Voir toutes les entrées</a>
                    <?php endif; ?>
                </form>
            </div>
        </div>
    </div>

    <?php 
    if (isset($_POST['btnValider'])) {
        $date_signature = $_POST['date_signature'];
        $date_expiration = $_POST['date_expiration'];
        $client_nom = trim($_POST['client']);

        // Fetch le client ID basé sur le nom du client
        $stmt = $bdd->prepare("SELECT id_client FROM client WHERE nom_client = :nom_client");
        $stmt->execute(['nom_client' => $client_nom]);
        $client = $stmt->fetch();
        $client_id = $client['id_client'];

        // Mise à jour du contrat
        $update_contrat = $bdd->prepare("UPDATE contrat SET date_signature = :date_signature, date_expiration = :date_expiration, client_id = :client_id WHERE id_contrat = :id_contrat");
        $update_contrat->bindParam(':date_signature', $date_signature);
        $update_contrat->bindParam(':date_expiration', $date_expiration);
        $update_contrat->bindParam(':client_id', $client_id);
        $update_contrat->bindParam(':id_contrat', $id_contrat);
        $update_contrat->execute();

        header("Location: affichage-contrat.php?message=modification");
        exit();
    }
    ?>
</section>

<?php include "footer.php"; ?>
