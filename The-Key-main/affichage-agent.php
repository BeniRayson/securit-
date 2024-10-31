<?php

include "connexion.php";
$affichageAgent = $bdd->query("Select * from agent");
include "header.php";

?>
<main class="main">
    <section class="table__body">
        <table>
            <thead>
                <tr>
                    
                    <th>  </th>
                    <th> Photo </th>
                    <th> Nom </th>
                    <th> Prenom </th>
                    <th> Telephone </th>
                    <th> Adresse </th>
                    <th colspan="2"> Action </th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($dataRecup = $affichageAgent->fetch()) {
                    ?>
                    <tr>
                        
                        <td><?php echo $dataRecup["id_agent"]; ?></td>
                        <td> <img src="images/<?php echo $dataRecup['image']; ?>" alt="Image de l'agent"></td>
                        <td><?php echo $dataRecup["nom_agent"]; ?></td>
                        <td><?php echo $dataRecup["prenom_agent"]; ?></td>
                        <td><?php echo $dataRecup["tel"]; ?></td>
                        <td><?php echo $dataRecup["adr"]; ?></td>
                        <?php if ($isLoggedIn): ?>
                        <td><a href="?delete=<?php echo $dataRecup['id_agent']; ?>" class="btn btn-delete"
                                onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette agent ?');">supprimer</a>
                        </td>
                        <td><a href="modification_agent.php?mod=<?php echo $dataRecup['id_agent']; ?>"
                                class="btn btn-edit">Modifier</a></td>
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
        $stmt = $bdd->prepare("DELETE FROM agent WHERE id_agent = ?");
        $stmt->execute([$id]);
        $message = "Agent supprimé avec succès !";
        // header("location:affichage-agent.php");
        header("location:affichage-agent.php");

    } catch (PDOException $e) {
        $message = "Erreur lors de la suppression : " . $e->getMessage();
    }
}

?>


<?php include "footer.php" ?>