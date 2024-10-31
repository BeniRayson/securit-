<?php 

include "connexion.php" ;
$affichageFonction = $bdd->query("Select * from fonction");
include "header.php";
?>
    <main class="main">
        <section class="table__body">
            <table>
                <thead>
                <tr>
        <th>id</th>
        <th>Fonctions</th>
        <th colspan="2" >Action</th>
      </tr>
                </thead>
                <tbody>
    <?php 
        while ( $dataRecup = $affichageFonction->fetch()) {         
    ?>
        <tr>
            <td ><?php echo $dataRecup["id_fonction"]; ?></td>
            <td><?php echo $dataRecup["fonction"]; ?></td>
            <?php if ($isLoggedIn): ?>
            <td><a href="?delete=<?php echo $dataRecup['id_post']; ?>" class="btn btn-delete" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette Client ?');">supprimer</a></td>
            <td><a href="modification_fonction.php?mod=<?php echo $dataRecup['id_fonction']; ?>" class="btn btn-edit">Modifier</a></td>
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
          $stmt = $bdd->prepare("DELETE FROM fonction WHERE id_fonction = ?");
          $stmt->execute([$id]);
          $message = "Fonction supprimé avec succès !";
          header("location:affichage-fonction.php");
      } catch (PDOException $e) {
          $message = "Erreur lors de la suppression : " . $e->getMessage();
      }
}

?>

<?php include "footer.php" ?>
