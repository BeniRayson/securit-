<?php 
include "connexion.php"; 
include "header.php";

// Vérification de l'ID du post pour la modification
if (isset($_GET['mod'])) {
    $id_post = intval($_GET['mod']);
    $modifPost = $bdd->prepare("SELECT * FROM post WHERE id_post = ?");
    $modifPost->execute([$id_post]);
    $recupdata = $modifPost->fetch();

    if (!$recupdata) {
        echo "<p class='register'>Post non trouvé.</p>";
        exit;
    }
} else {
    echo "<p class='register'>Aucun ID de post fourni.</p>";
    exit;
}
?>

<section class="main">
    <div class="flex-container">
        <div class="content-container">
            <div class="form-container">
                <form action="modification_post.php?mod=<?php echo $id_post; ?>" method="POST">
                    <h1>Modifier le Post</h1>
                    <br>
                    <span class="subtitle">Nom de l'agent :</span>
                    <br>
                    <input type="text" id="nom_agent" name="nom_agent" required value="<?php echo htmlspecialchars($recupdata['nom_agent']); ?>">
                    <br>
                    <span class="subtitle">Numéro Matricule :</span>
                    <br>
                    <input type="text" id="numero_matricule" name="numero_matricule" required value="<?php echo htmlspecialchars($recupdata['numero_matricule']); ?>">
                    <br>
                    <span class="subtitle">Adresse de Mission :</span>
                    <br>
                    <input type="text" id="adresse_mission" name="adresse_mission" required value="<?php echo htmlspecialchars($recupdata['adresse_mission']); ?>">
                    <br><br>
                    <input type="submit" value="Modifier" class="button-flex btnValider" name="btnValider">
                    <br>
                    <?php if ($isLoggedIn): ?>
                        <a href="affichage-post.php" class="voir">Voir toutes les entrées</a>
                    <?php endif; ?>
                </form>
            </div>
        </div>
    </div>

    <?php 
    if (isset($_POST['btnValider'])) {
        $nom_agent = trim($_POST['nom_agent']);
        $numero_matricule = trim($_POST['numero_matricule']);
        $adresse_mission = trim($_POST['adresse_mission']);

        // Mise à jour du post
        $update_post = $bdd->prepare("UPDATE post SET nom_agent = ?, numero_matricule = ?, adresse_mission = ? WHERE id_post = ?");
        $update_post->execute([$nom_agent, $numero_matricule, $adresse_mission, $id_post]);

        header("Location: affichage-post.php?message=modification");
        exit();
    }
    ?>
</section>

<?php include "footer.php"; ?>
