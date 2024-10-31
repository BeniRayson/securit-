<?php 

include "connexion.php" ;
$affichageContact = $bdd->query("Select * from contact");
include "header.php";
?>

    <main class="main">
        <section class="table__body">
            <table>
                <thead>
                <tr>
        <th> contact num</th>
        <th>Nom</th>
        <th>Email</th>
        <th>Telephone</th>
        <th colspan="2">Action</th>
      </tr>
                </thead>
                <tbody>
    <?php 
        while ( $dataRecup = $affichageContact->fetch()) {         
    ?>
        <tr>
            <td ><?php echo $dataRecup["id_contact"]; ?></td>
            <td><?php echo $dataRecup["nom"]; ?></td>
            <td><?php echo $dataRecup["email"]; ?></td>
            <td><?php echo $dataRecup["telephone"]; ?></td>
            <td><a href="?delete=<?php echo $dataRecup['id_contact']; ?>" class="btn btn-delete" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette contact ?');">supprimer</a></td>
            <td><a href="modification-contact.php?mod=<?php echo $dataRecup['id_contact']; ?>" class="btn btn-edit">Modifier</a></td>
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
          $stmt = $bdd->prepare("DELETE FROM contact WHERE id_contact = ?");
          $stmt->execute([$id]);
          $message = "Contact supprimé avec succès !";
          header("location:affichage-contact.php");

      } catch (PDOException $e) {
          $message = "Erreur lors de la suppression : " . $e->getMessage();
      }
}

?>

<?php include "footer.php" ?>
