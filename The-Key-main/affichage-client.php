<?php

include "connexion.php";
$affichageClient = $bdd->query("Select * from client");
include "header.php";
?>

<main class="main">
<section>
<h2 style="text-align: center; padding: 20px;">Liste des clients</h2>
</section>
<section class="posts" style=" padding-top:0;">
    <h2 style="text-align: center; z-index: 1111;">Liste des clients</h2>
</section>
    <section class="allTable">

        
        <div class="table__body">
            <table>
                <thead>
                    <tr>
                        <th>numero client</th>
                        <th>Nom</th>
                        <th>nombre d'agents</th>
                        <th>adresse</th>
                        <th colspan="2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($dataRecup = $affichageClient->fetch()) {
                        ?>
                        <tr>
                            <td><?php echo $dataRecup["id_client"]; ?></td>
                            <td><?php echo $dataRecup["nom_client"]; ?></td>
                            <td><?php echo $dataRecup["nombre_agent"]; ?></td>
                            <td><?php echo $dataRecup["adresse"]; ?></td>
                            <?php if ($isLoggedIn): ?>
                            <td><a href="?delete=<?php echo $dataRecup['id_client']; ?>" class="btn btn-delete"
                                    onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette Client ?');">supprimer</a>
                            </td>
                            <td>
                                <a href="modification_client.php?mod=<?php echo $dataRecup['id_client']; ?>" class="btn btn-edit">modifier</a>
                                
                             </td>

                             <?php endif; ?>

                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

    </section>
</main>

<?php
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    try {
        $stmt = $bdd->prepare("DELETE FROM client WHERE id_client = ?");
        $stmt->execute([$id]);
        $message = "Client supprimé avec succès !";
        header("location:affichage-client.php");
    } catch (PDOException $e) {
        $message = "Erreur lors de la suppression : " . $e->getMessage();
    }
}

?>

<?php include "footer.php" ?>