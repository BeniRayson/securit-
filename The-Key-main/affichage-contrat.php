<?php 
include "connexion.php";
$affichageContrat = $bdd->query("SELECT contrat.id_contrat, contrat.date_signature, contrat.date_expiration, client.nom_client FROM contrat JOIN client ON contrat.client_id = client.id_client");

include "header.php";
?>

<main class="main">
    <section class="table__body">
        <table>
            <thead>
                <tr>
                    <th>Numéro Contrat</th>
                    <th>Date de Signature</th>
                    <th>Date d'Expiration</th>
                    <th>Client</th>
                    <th colspan="2">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($dataRecup = $affichageContrat->fetch()) { ?>
                    <tr>
                        <td><?php echo $dataRecup["id_contrat"]; ?></td>z
                        <td><?php echo $dataRecup["date_signature"]; ?></td>
                        <td><?php echo $dataRecup["date_expiration"]; ?></td>
                        <td><?php echo $dataRecup["nom_client"]; ?></td>
                        <?php if ($isLoggedIn): ?>
                        <td><a href="?delete=<?php echo $dataRecup['id_contrat']; ?>" class="btn btn-delete" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce contrat ?');">Supprimer</a></td>
                        <td><a href="modification_contrat.php?id=<?php echo $dataRecup['id_contrat']; ?>" class="btn btn-edit">Modifier</a></td>
                        <?php endif; ?>
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
        $stmt = $bdd->prepare("DELETE FROM contrat WHERE id_contrat = ?");
        $stmt->execute([$id]);
        $message = "Contrat supprimé avec succès !";
        header("location:affichage-contrat.php");
    } catch (PDOException $e) {
        $message = "Erreur lors de la suppression : " . $e->getMessage();
    }
}
include "footer.php";
?>
