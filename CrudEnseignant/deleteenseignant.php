<?php
include 'C:/wamp64/www/PHPPROJECT/connection_db.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['ID_ENSEIGNANT'])) {
    $id_enseignant = $_GET['ID_ENSEIGNANT'];

    try {
        $stmt = $connection->prepare("DELETE FROM enseignant WHERE ID_ENSEIGNANT = ?");
        $result = $stmt->execute([$id_enseignant]);

        if ($result) {
            header("location:indexenseignant.php");
            exit();
        }
    } catch (PDOException $e) {
        die('Erreur : ' . $e->getMessage());
    }
}
?>
