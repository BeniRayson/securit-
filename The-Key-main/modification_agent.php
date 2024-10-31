<?php 
include "connexion.php";
include "header.php";

// Vérification de l'ID de l'agent pour la modification
if (isset($_GET['mod'])) {
    $id_agent = intval($_GET['mod']);
    $modifAgent = $bdd->prepare("SELECT * FROM agent WHERE id_agent = ?");
    $modifAgent->execute([$id_agent]);
    $recupdata = $modifAgent->fetch();

    if (!$recupdata) {
        echo "<p class='register'>Agent non trouvé.</p>";
        exit;
    }
} else {
    echo "<p class='register'>Aucun ID d'agent fourni.</p>";
    exit;
}
?>

<section class="main">
    <div class="flex-container">
        <div class="content-container">
            <div class="form-container">
                <form action="modification_agent.php?mod=<?php echo $id_agent; ?>" method="POST" enctype="multipart/form-data">
                    <h1>Modifier Agent</h1>
                    <br>
                    <span class="subtitle">Nom :</span>
                    <br>
                    <input type="text" id="nom" name="nom" pattern="[a-zA-Z\s]+" required value="<?php echo htmlspecialchars($recupdata['nom_agent']); ?>">
                    <br>
                    <span class="subtitle">Prénom :</span>
                    <br>
                    <input type="text" id="prenom" name="prenom" pattern="[a-zA-Z\s]+" required value="<?php echo htmlspecialchars($recupdata['prenom_agent']); ?>">
                    <br>
                    <span class="subtitle">Téléphone :</span>
                    <br>
                    <input type="text" id="telephone" name="telephone" required value="<?php echo htmlspecialchars($recupdata['tel']); ?>">
                    <br>
                    <span class="subtitle">Adresse :</span>
                    <br>
                    <input type="text" id="adresse" name="adresse" required value="<?php echo htmlspecialchars($recupdata['adr']); ?>">
                    <br>
                    <span class="subtitle">Photo :</span>
                    <br>
                    <input type="file" id="image" name="image">
                    <br><br>
                    <input type="submit" value="Modifier" class="button-flex btnValider" name="btnValider">
                    <br>
                    <?php if ($isLoggedIn): ?>
                        <a href="affichage-agent.php" class="voir">Voir toutes les entrées</a>
                    <?php endif; ?>
                </form>
            </div>
        </div>
    </div>

    <?php 
    if (isset($_POST['btnValider'])) {
        $nom = ucfirst(trim($_POST["nom"]));
        $prenom = ucfirst(trim($_POST["prenom"]));
        $telephone = trim($_POST['telephone']);
        $adresse = trim($_POST['adresse']);
        
        // Gestion de la mise à jour de l'image
        $image = $_FILES['image']['name'];
        if ($image) {
            $target_dir = "images/";
            $target_file = $target_dir . basename($image);
            move_uploaded_file($_FILES['image']['tmp_name'], $target_file);
        } else {
            // Si aucune nouvelle image, conserver l'ancienne
            $image = $recupdata['image'];
        }

        // Mise à jour de l'agent
        $update_agent = $bdd->prepare("UPDATE agent SET nom_agent = :nom, prenom_agent = :prenom, tel = :telephone, adr = :adresse, image = :image WHERE id_agent = :id_agent");
        $update_agent->bindParam(':nom', $nom);
        $update_agent->bindParam(':prenom', $prenom);
        $update_agent->bindParam(':telephone', $telephone);
        $update_agent->bindParam(':adresse', $adresse);
        $update_agent->bindParam(':image', $image);
        $update_agent->bindParam(':id_agent', $id_agent);
        $update_agent->execute();

        header("Location: affichage-agent.php?message=modification");
        exit();
    }
    ?>
</section>

<?php include "footer.php"; ?>
