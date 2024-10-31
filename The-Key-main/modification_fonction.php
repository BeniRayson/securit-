<?php 
include "connexion.php";
include "header.php";

// Vérification de l'ID de la fonction pour la modification
if (isset($_GET['mod'])) {
    $id_fonction = intval($_GET['mod']);
    $modifFonction = $bdd->prepare("SELECT * FROM fonction WHERE id_fonction = ?");
    $modifFonction->execute([$id_fonction]);
    $recupdata = $modifFonction->fetch();

    if (!$recupdata) {
        echo "<p class='register'>Fonction non trouvée.</p>";
        exit;
    }
} else {
    echo "<p class='register'>Aucun ID de fonction fourni.</p>";
    exit;
}
?>

<section class="main">
    <div class="flex-container">
        <div class="content-container">
            <div class="form-container">
                <form action="modification_fonction.php?mod=<?php echo $id_fonction; ?>" method="POST">
                    <h1>Modifier Fonction</h1>
                    <br>
                    <span class="subtitle">Fonction :</span>
                    <br>
                    <input type="text" id="fonction" name="fonction" required value="<?php echo htmlspecialchars($recupdata['fonction']); ?>">
                    <br><br>
                    <input type="submit" value="Modifier" class="button-flex btnValider" name="btnValider">
                    <br>
                    <?php if ($isLoggedIn): ?>
                        <a href="affichage-fonction.php" class="voir">Voir toutes les entrées</a>
                    <?php endif; ?>
                </form>
            </div>
        </div>
    </div>

    <?php 
    if (isset($_POST['btnValider'])) {
        $fonction = trim($_POST['fonction']);

        // Mise à jour de la fonction
        $update_fonction = $bdd->prepare("UPDATE fonction SET fonction = :fonction WHERE id_fonction = :id_fonction");
        $update_fonction->bindParam(':fonction', $fonction);
        $update_fonction->bindParam(':id_fonction', $id_fonction);
        $update_fonction->execute();

        header("Location: affichage-fonction.php?message=modification");
        exit();
    }
    ?>
</section>

<?php include "footer.php"; ?>
