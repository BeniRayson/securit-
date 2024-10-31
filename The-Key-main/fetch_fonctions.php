<?php
include 'connexion.php';

$query = $_GET['q'];
$fonctions = [];

if ($query) {
    $stmt = $bdd->prepare("SELECT DISTINCT fonction FROM fonction WHERE fonction LIKE :query");
    $stmt->execute(['query' => '%' . $query . '%']);
    $fonctions = $stmt->fetchAll(PDO::FETCH_COLUMN);
}

header('Content-Type: application/json');
echo json_encode($fonctions);
?>
