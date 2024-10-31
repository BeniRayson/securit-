<?php 
include "connexion.php";
include "header.php";

// Vérification de l'ID de la publication pour la modification
if (isset($_GET['mod'])) {
    $id_pub = intval($_GET['mod']);
    $modifPublication = $bdd->prepare("SELECT * FROM publication WHERE id_pub = ?");
    $modifPublication->execute([$id_pub]);
    $recupdata = $modifPublication->fetch();

    if (!$recupdata) {
        echo "<p class='register'>Publication non trouvée.</p>";
        exit;
    }
} else {
    echo "<p class='register'>Aucun ID de publication fourni.</p>";
    exit;
}
?>

<section class="main">
    <div class="flex-container">
        <div class="content-container">
            <div class="form-container">
                <form action="modification_pub.php?mod=<?php echo $id_pub; ?>" method="POST">
                    <h1>Modifier Publication</h1>
                    <br>
                    <span class="subtitle">Date de Publication :</span>
                    <br>
                    <input type="date" id="date_pub" name="date_pub" required value="<?php echo htmlspecialchars($recupdata['date_pub']); ?>">
                    <br>
                    <span class="subtitle">Titre :</span>
                    <br>
                    <input type="text" id="titre" name="titre" required value="<?php echo htmlspecialchars($recupdata['titre']); ?>">
                    <br>
                    <span class="subtitle">Article :</span>
                    <br>
                    <textarea id="article" name="article" required><?php echo htmlspecialchars($recupdata['article']); ?></textarea>
                    <br><br>
                    <input type="submit" value="Modifier" class="button-flex btnValider" name="btnValider">
                    <br>
                    <?php if ($isLoggedIn): ?>
                        <a href="affichage-pub.php" class="voir">Voir toutes les entrées</a>
                    <?php endif; ?>
                </form>
            </div>
        </div>
    </div>

    <?php 
    if (isset($_POST['btnValider'])) {
        $date_pub = $_POST['date_pub'];
        $titre = trim($_POST['titre']);
        $article = trim($_POST['article']);

        // Mise à jour de la publication
        $update_pub = $bdd->prepare("UPDATE publication SET date_pub = :date_pub, titre = :titre, article = :article WHERE id_pub = :id_pub");
        $update_pub->bindParam(':date_pub', $date_pub);
        $update_pub->bindParam(':titre', $titre);
        $update_pub->bindParam(':article', $article);
        $update_pub->bindParam(':id_pub', $id_pub);
        $update_pub->execute();

        header("Location: affichage-pub.php?message=modification");
        exit();
    }
    ?>
</section>

<?php include "footer.php"; ?>
s