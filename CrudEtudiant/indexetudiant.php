<?php
include 'C:/wamp64/www/PHPPROJECT/connection_db.php';

$successMessage = '';

$sql = "SELECT * FROM etudiant";
$result = $connection->query($sql);

if (!$result) {
    die("Invalid query: " . $connection->errorInfo()[2]);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Étudiants</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container my-5">
        <h2>Liste des Étudiants</h2>
        <a class="btn btn-primary btn-sm" href="createetudiant.php" role="button">Ajouter un nouvel étudiant</a>
        <a class="btn btn-danger" href="/PHPPROJECT/Authentification/dashboard.php">dashboard</a>

        <?php
        if (!empty($successMessage)) {
            echo "
            <div class='alert alert-success alert-dismissible fade show' role='alert'>
                <strong>$successMessage</strong>
                <button type='button' class='button-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
            ";
        }
        ?>

        <table class="table">
            <thead>
                <tr>
                    <th>ID Étudiant</th>
                    <th>ID Salle</th>
                    <th>ID Classe</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Date de Naissance</th>
                    <th>Adresse</th>
                    <th>Date de Présence</th>
                    <th>Opération</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                    echo "
                    <tr>
                        <td>{$row['ID_ETUDIANT']}</td>
                        <td>{$row['ID_SALLE']}</td>
                        <td>{$row['ID_CLASSE']}</td>
                        <td>{$row['NOM']}</td>
                        <td>{$row['PRENOM']}</td>
                        <td>{$row['DATE_DE_NAISSANCE']}</td>
                        <td>{$row['ADRESSE']}</td>
                        <td>{$row['DATE_PRESENCE']}</td>
                        <td>
                            <a class='btn btn-primary btn-sm' href='editetudiant.php?ID_ETUDIANT={$row['ID_ETUDIANT']}'>Modifier</a>
                            <a class='btn btn-danger btn-sm' href='deleteetudiant.php?ID_ETUDIANT={$row['ID_ETUDIANT']}'>Supprimer</a>
                        </td>
                    </tr>
                    ";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
