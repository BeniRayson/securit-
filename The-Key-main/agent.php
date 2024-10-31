<?php
ob_start(); // Start output buffering
include "connexion.php";
include "header.php";

// Fetch available fonctions
$fonctions = $bdd->query("SELECT id_fonction, fonction FROM fonction")->fetchAll(PDO::FETCH_ASSOC);
?>

<section class="main">
    <div class="flex-container">
        <div class="content-container">
            <div class="form-container">
                <form action="agent.php" method="POST" enctype="multipart/form-data">
                    <h1>Enregistrer un nouvel agent</h1>
                    <br><br>
                    <div class="form-card">
                        <div class="form-inputs">
                            <span class="subtitle">Nom :</span>
                            <br>
                            <input type="text" id="nom" name="nom" pattern="[a-zA-Z0-9]+" required>
                            <br>
                            <span class="subtitle">Prenom :</span>
                            <br>
                            <input type="text" id="prenom" name="prenom" pattern="[a-zA-Z0-9]+" required>
                            <br>
                            <span class="subtitle">Telephone :</span>
                            <br>
                            <input type="text" id="tel" name="tel" pattern="[0-9]+" required>
                            <br>
                            <span class="subtitle">Adresse :</span>
                            <br>
                            <input type="text" id="adresse" name="adresse" pattern="[a-zA-Z0-9]+" required>
                            <br>
                            <span class="subtitle">Fonction :</span>
                            <br>
                            <select id="fonction" name="fonction" required>
                                <?php foreach ($fonctions as $fonction): ?>
                                    <option value="<?php echo $fonction['id_fonction']; ?>"><?php echo $fonction['fonction']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="image-upload-container">
                            <span class="subtitle">Photo de l'employé :</span>
                            <label class="image-upload">
                                <input type="file" class="image-input" name="image" accept="image/*">
                                <span>+</span>
                                <img class="image-preview" src="#" alt="Image Preview" style="display: none;">
                            </label>
                        </div>
                    </div>
                    <br><br>
                    <input type="submit" value="Enregistrer" class="button-flex submit-btn-full-width" name="btnValider">
                    <?php if ($isLoggedIn): ?>
                    <a href="affichage-agent.php" class="voir">Voir toutes les entrées</a>
                    <?php endif; ?>
                </form>
                <?php
                if (isset($_POST['btnValider'])) {
                    $nom = ucfirst($_POST["nom"]);
                    $prenom = ucfirst($_POST["prenom"]);
                    $telephone = $_POST['tel'];
                    $adresse = $_POST['adresse'];
                    $fonction_id = $_POST['fonction'];
                    
                    // Handle image upload
                    $image = $_FILES['image']['name'];
                    $target = "images/" . basename($image);

                    // Check for duplicate agent
                    $check_duplicate = $bdd->prepare("SELECT * FROM agent WHERE nom_agent = :nom AND prenom_agent = :prenom AND tel = :telephone AND adr = :adresse");
                    $check_duplicate->bindParam(':nom', $nom);
                    $check_duplicate->bindParam(':prenom', $prenom);
                    $check_duplicate->bindParam(':telephone', $telephone);
                    $check_duplicate->bindParam(':adresse', $adresse);
                    $check_duplicate->execute();

                    if ($check_duplicate->rowCount() == 0) {
                        $agent_insertion = $bdd->prepare("INSERT INTO agent (nom_agent, prenom_agent, tel, adr, fonction_id, image) VALUES (:nom, :prenom, :telephone, :adresse, :fonction_id, :image)");
                        $agent_insertion->bindParam(':nom', $nom);
                        $agent_insertion->bindParam(':prenom', $prenom);
                        $agent_insertion->bindParam(':telephone', $telephone);
                        $agent_insertion->bindParam(':adresse', $adresse);
                        $agent_insertion->bindParam(':fonction_id', $fonction_id);
                        $agent_insertion->bindParam(':image', $image);
                        $agent_insertion->execute();
                        
                        // Move the uploaded image to the target directory
                        if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
                            echo "<p class='register'>Image uploaded successfully.</p>";
                        } else {
                            echo "<p class='register'>Failed to upload image.</p>";
                        }

                        header("Location: affichage-agent.php");
                        ob_end_flush(); // End output buffering and flush output
                    } else {
                        echo "<p class='register'>Cet agent existe déjà dans la base de données.</p>";
                    }
                }
                ?>
            </div>
        </div>
    </div>
</section>

<?php include "footer.php"; ?>
