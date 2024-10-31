<?php
include 'connexion.php';

$query = $_GET['q'];
$clients = [];

if ($query) {
    $stmt = $bdd->prepare("SELECT nom_client FROM client WHERE nom_client LIKE :query");
    $stmt->execute(['query' => '%' . $query . '%']);
    $clients = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

echo json_encode($clients);
?>
