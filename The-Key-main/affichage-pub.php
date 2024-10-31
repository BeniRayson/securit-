<?php

include "connexion.php";
$affichagePublication = $bdd->query("Select * from publication");
include "header.php";
?>
<main class="main">
    <section class="table__body">
        <table>
            <thead>
                <tr>
                    <th>numero publication</th>
                    <th>date de publication</th>
                    <th>Titre</th>
                    <th>article</th>
                    <th colspan="2">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($dataRecup = $affichagePublication->fetch()) {
                    ?>
                    <tr>
                        <td><?php echo $dataRecup["id_pub"]; ?></td>
                        <td><?php echo $dataRecup["date_pub"]; ?></td>
                        <td><?php echo $dataRecup["titre"]; ?></td>
                        <td><?php echo $dataRecup["article"]; ?></td>
                        <?php if ($isLoggedIn): ?>
                        <td><a href="?delete=<?php echo $dataRecup['id_pub']; ?>" class="btn btn-delete"
                                onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette Publication ?');">supprimer</a>
                        </td>
                        <td><a href="modification_pub.php?mod=<?php echo $dataRecup['id_pub']; ?>"
                                class="btn btn-edit">Modifier</a></td> <?php endif; ?>

                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </section>
</main>

<?php
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    try {
        $stmt = $bdd->prepare("DELETE FROM publication WHERE id_pub = ?");
        $stmt->execute([$id]);
        $message = "Publication supprimé avec succès !";
        header("location:affichage-pub.php");
    } catch (PDOException $e) {
        $message = "Erreur lors de la suppression : " . $e->getMessage();
    }
}

?>

<?php include "footer.php" ?>

