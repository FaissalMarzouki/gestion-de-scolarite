<?php
include 'C:/wamp64/www/PHPPROJECT/connection_db.php';

$successMessage = '';

$sql = "SELECT * FROM filiere";
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
    <title>Liste des Filières</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container my-5">
        <h2>Liste des Filières</h2>
        <a class="btn btn-primary btn-sm" href="createfiliere.php" role="button">Ajouter une nouvelle filière</a>
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
            <tr>
                <thead>
                    <th>ID Classe</th>
                    <th>ID Département</th>
                    <th>Nom Filière</th>
                    <th>Niveau</th>
                    <th>Opérations</th>
                </thead>
            </tr>

            <tbody>
                <?php
                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                    echo "
                    <tr>
                        <td>{$row['ID_CLASSE']}</td>
                        <td>{$row['ID_DEPARTEMENT']}</td>
                        <td>{$row['NOM_FILIERE']}</td>
                        <td>{$row['NIVEAU']}</td>
                        <td>
                            <a class='btn btn-primary btn-sm' href='editfiliere.php?ID_CLASSE={$row['ID_CLASSE']}'>Modifier</a>
                            <a class='btn btn-danger btn-sm' href='deletefiliere.php?ID_CLASSE={$row['ID_CLASSE']}'>Supprimer</a>
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
