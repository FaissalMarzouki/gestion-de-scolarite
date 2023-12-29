<?php
try {
    $connection = new PDO("mysql:host=localhost;dbname=gestion de scolarite", 'fayssal', '1447');
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Erreur : ' . $e->getMessage());
}

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['ID_ETUDIANT'])) {
    $id_etudiant = $_GET['ID_ETUDIANT'];

    try {
        $stmt = $connection->prepare("DELETE FROM etudiant WHERE ID_ETUDIANT = ?");
        $result = $stmt->execute([$id_etudiant]);

        if ($result) {
            header("location:indexetudiant.php");
            exit();
        }
    } catch (PDOException $e) {
        die('Erreur : ' . $e->getMessage());
    }
}
?>
