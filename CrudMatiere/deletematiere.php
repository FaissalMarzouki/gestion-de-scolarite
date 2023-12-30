<?php
include 'C:/wamp64/www/PHPPROJECT/connection_db.php';

if (isset($_GET['ID_MATIERE'])) {
    $id_matiere = $_GET['ID_MATIERE'];

    try {
        $stmt = $connection->prepare("DELETE FROM matiere WHERE ID_MATIERE = ?");
        $stmt->execute([$id_matiere]);

        header("location:/PHPPROJECT/CrudMatiere/indexmatiere.php");
        exit;
    } catch (PDOException $e) {
        die('Erreur : ' . $e->getMessage());
    }
} else {
    header("location:/PHPPROJECT/CrudMatiere/indexmatiere.php");
    exit;
}
?>
