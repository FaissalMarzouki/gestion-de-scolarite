<?php
include 'C:/wamp64/www/PHPPROJECT/connection_db.php';


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
