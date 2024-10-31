<?php 
include "connexion.php";
include "header.php";

// Gestion de l'insertion d'un nouveau post
if (isset($_POST['btnAjouter'])) {
    $nom_agent = trim($_POST['nom_agent']);
    $matricule = trim($_POST['numero_matricule']);
    $adresse = trim($_POST['adresse_mission']);

    // Insertion dans la base de données
    $stmt = $bdd->prepare("INSERT INTO post (nom_agent, numero_matricule, adresse_mission) VALUES (?, ?, ?)");
    $stmt->execute([$nom_agent, $matricule, $adresse]);
    header("Location: affichage-post.php?message=insertion");
    exit();
}

// Affichage des posts
$affichagePost = $bdd->query("SELECT * FROM post");
?>

<main class="main">
    <section>
        <h2>Ajouter un nouveau post</h2>
        <form action="affichage-post.php" method="POST">
            <input type="text" name="nom_agent" placeholder="Nom de l'agent" required>
            <input type="text" name="numero_matricule" placeholder="numero_matricule" required>
            <input type="text" name="adresse_mission" placeholder="adresse_mission" required>
            <input type="submit" name="btnAjouter" value="Ajouter" class="btn btn-add">
        </form>
    </section>

    <section class="table__body">
        <table>
            <thead>
                <tr>
                    <th>Numero Post</th>
                    <th>Nom Agent</th>
                    <th>Matricule</th>
                    <th>Adresse</th>
                    <th colspan="2">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                while ($dataRecup = $affichagePost->fetch()) {         
                ?>
                <tr>
                    <td><?php echo htmlspecialchars($dataRecup["id_post"]); ?></td>
                    <td><?php echo htmlspecialchars($dataRecup["nom_agent"]); ?></td>
                    <td><?php echo htmlspecialchars($dataRecup["numero_matricule"]); ?></td>
                    <td><?php echo htmlspecialchars($dataRecup["adresse_mission"]); ?></td>
                    
                    <?php if ($isLoggedIn): ?>
                    <td>
                        <a href="?delete=<?php echo $dataRecup['id_post']; ?>" class="btn btn-delete" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce post ?');">Supprimer</a>
                    </td>
                    <td>
                         <a href="modification_post.php?mod=<?php echo $dataRecup['id_post']; ?>" class="btn btn-edit">Modifier</a>
                    </td>

                    <?php endif; ?>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </section>
</main>

<?php 
// Gestion de la suppression
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    try {
        $stmt = $bdd->prepare("DELETE FROM post WHERE id_post = ?");
        $stmt->execute([$id]);
        header("Location: affichage-post.php?message=suppression");
        exit();
    } catch (PDOException $e) {
        echo "Erreur lors de la suppression : " . htmlspecialchars($e->getMessage());
    }
}
?>

<?php include "footer.php"; ?>
