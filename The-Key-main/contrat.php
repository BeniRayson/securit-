<?php include "connexion.php"; include "header.php"; ?>

<section class="main">
    <div class="flex-container">
        <div class="content-container">
            <div class="form-container">
                <form action="contrat.php" method="POST">
                    <h1>Demande de Contrats</h1>
                    <br><br>

                    <span class="subtitle">La date de signature :</span>
                    <br>
                    <input type="date" id="date_signature" name="date_signature" required>
                    <br>

                    <span class="subtitle">La date de fin de contrat :</span>
                    <br>
                    <input type="date" id="date_expiration" name="date_expiration" required>
                    <br>

                    <span class="subtitle">Client :</span>
                    <br>
                    <input type="text" id="client" name="client" list="client-list" oninput="fetchClients(this.value)" required>
                    <datalist id="client-list"></datalist>
                    <br><br>

                    <input type="submit" value="Envoyer" class="button-flex">
                    <br>
                    <?php if ($isLoggedIn): ?>
                    <a href="affichage-contrat.php" class="voir">Voir toutes les entrées</a>
                    <?php endif; ?>
                </form>
            </div>
        </div>
    </div>

    <?php 
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $Recupdate = $_POST['date_signature'];
        $Recupdate2 = $_POST['date_expiration'];
        $Recuclient = $_POST['client'];

        // Fetch the client ID from the client name
        $stmt = $bdd->prepare("SELECT id_client FROM client WHERE nom_client = :nom_client");
        $stmt->execute(['nom_client' => $Recuclient]);
        $client = $stmt->fetch();
        $client_id = $client['id_client'];

        // Check for duplicates
        $check_duplicate = $bdd->prepare("SELECT * FROM contrat WHERE date_signature = :date_signature AND date_expiration = :date_expiration AND client_id = :client_id");
        $check_duplicate->bindParam(':date_signature', $Recupdate);
        $check_duplicate->bindParam(':date_expiration', $Recupdate2);
        $check_duplicate->bindParam(':client_id', $client_id);
        $check_duplicate->execute();

        // Insert if no duplicate
        if ($check_duplicate->rowCount() == 0) {
            $contrat_insertion = $bdd->prepare("INSERT INTO contrat (date_signature, date_expiration, client_id) VALUES (:date_signature, :date_expiration, :client_id)");
            $contrat_insertion->bindParam(':date_signature', $Recupdate);
            $contrat_insertion->bindParam(':date_expiration', $Recupdate2);
            $contrat_insertion->bindParam(':client_id', $client_id);
            $contrat_insertion->execute();

            header("Location: affichage-contrat.php");
        } else {
            echo "<p class='register'>Un contrat avec les mêmes informations existe déjà dans la base de données.</p>";
        }
    }
    ?>

<?php include "footer.php"; ?>

<script>
function fetchClients(query) {
    fetch('fetch_clients.php?q=' + query)
    .then(response => response.json())
    .then(data => {
        const clientList = document.getElementById('client-list');
        clientList.innerHTML = '';
        data.forEach(client => {
            const option = document.createElement('option');
            option.value = client.nom_client;
            clientList.appendChild(option);
        });
    })
    .catch(error => console.error('Error fetching clients:', error));
}

document.addEventListener('DOMContentLoaded', function() {
    const clientInput = document.getElementById('client');
    clientInput.addEventListener('input', function() {
        fetchClients(this.value);
    });
});
</script>
