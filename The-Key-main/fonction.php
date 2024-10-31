<?php
include "connexion.php";
include "header.php";
?>

<section class="main">
    <div class="flex-container">
        <div class="content-container">
            <div class="form-container">
                <form action="fonction.php" method="POST">
                    <h1>Renseigner les postes</h1>
                    <br><br>
                    <span class="subtitle">Nom de la fonction :</span>
                    <br>
                    <input type="text" id="fonction" name="fonction" required>
                    <br><br>
                    <input type="submit" value="Ajouter" class="button-flex" name="btnValider">
                    <br>
                    <?php if ($isLoggedIn): ?>
                    <a href="affichage-fonction.php" class="voir">Voir toutes les entrées</a>
          <?php endif; ?>
                </form>
            </div>
        </div>
    </div>
</section>

<?php
if (isset($_POST['btnValider'])) {
    $fonction = $_POST['fonction'];

    // Vérifier si une fonction avec le même nom existe déjà
    $check_duplicate = $bdd->prepare("SELECT * FROM fonction WHERE fonction = :fonction");
    $check_duplicate->bindParam(':fonction', $fonction);
    $check_duplicate->execute();

    // Si aucun doublon n'est trouvé, insérer les données
    if ($check_duplicate->rowCount() == 0) {
        $fonction_insertion = $bdd->prepare("INSERT INTO fonction (fonction) VALUES (:fonction)");
        $fonction_insertion->bindParam(':fonction', $fonction);
        $fonction_insertion->execute();
        header("Location: affichage-fonction.php");
    } else {
        echo "<p class='register failed'>Cette fonction existe déjà dans la base de données.</p>";
    }
}
?>

<?php include "footer.php"; ?>
