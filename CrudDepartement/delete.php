<?php

session_start();

// Vérifier si l'utilisateur est authentifié
if (!isset($_SESSION['user_id'])) {
    // Rediriger vers la page de connexion
    header("Location: /PHPPROJECT/Authentification/login.php");
    exit();
}


$servername = "localhost";
$username = "fayssal";
$password = "1447";
$databasename = "gestion de scolarite";

// Vérifier si l'ID_DEPARTEMENT est défini dans l'URL
if (isset($_GET['ID_DEPARTEMENT'])) {
    $identifiant = $_GET['ID_DEPARTEMENT'];

    try {
        $connection = new PDO("mysql:host=$servername;dbname=$databasename", $username, $password);
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die('Erreur : ' . $e->getMessage());
    }

    // Utiliser une requête préparée pour éviter les injections SQL
    $stmt = $connection->prepare("DELETE FROM departement WHERE ID_DEPARTEMENT = :identifiant");
    $stmt->bindParam(':identifiant', $identifiant, PDO::PARAM_INT);

    try {
        // Exécuter la requête
        $stmt->execute();

        // Redirection vers la page d'index après la suppression réussie
        header("location:index.php");
        exit;
    } catch (PDOException $e) {
        die('Erreur : ' . $e->getMessage());
    }
}

// Si l'ID_DEPARTEMENT n'est pas défini dans l'URL, rediriger vers la page d'index
header("location: /PHPPROJECT/CrudDepartement/index.php");
exit;
?>
