<?php
include 'C:/wamp64/www/PHPPROJECT/connection_db.php';

if (isset($_GET['ID_SALLE'])) {
    $id_salle = $_GET['ID_SALLE'];

    try {
        $stmt = $connection->prepare("DELETE FROM salle WHERE ID_SALLE = ?");
        $stmt->execute([$id_salle]);

        header("location:indexsalle.php");
        exit;
    } catch (PDOException $e) {
        die('Erreur : ' . $e->getMessage());
    }
} else {
    header("location:indexsalle.php");
    exit;
}
?>
