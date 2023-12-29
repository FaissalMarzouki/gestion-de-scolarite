<?php
try {
    $connection = new PDO("mysql:host=localhost;dbname=gestion de scolarite", 'fayssal', '1447');
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Erreur : ' . $e->getMessage());
}
if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['ID_CLASSE'])) {
    $id_classe = $_GET['ID_CLASSE'];

    try {
        $stmt = $connection->prepare("DELETE FROM filiere WHERE ID_CLASSE = ?");
        $result = $stmt->execute([$id_classe]);

        if ($result) {
            header("location:indexfiliere.php");
            exit();
        }
    } catch (PDOException $e) {
        die('Erreur : ' . $e->getMessage());
    }
}
?>
