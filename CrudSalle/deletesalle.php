<?php
try {
    $connection = new PDO("mysql:host=localhost;dbname=gestion de scolarite", 'fayssal', '1447');
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Erreur : ' . $e->getMessage());
}
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
