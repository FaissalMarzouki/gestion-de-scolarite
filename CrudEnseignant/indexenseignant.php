<?php
try {
    $connection = new PDO("mysql:host=localhost;dbname=gestion de scolarite", 'fayssal', '1447');
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Erreur : ' . $e->getMessage());
}
$successMessage = '';

$sql = "SELECT * FROM enseignant";
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
    <title>Liste des Enseignants</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container my-5">
        <h2>Liste des Enseignants</h2>
        <a class="btn btn-primary btn-sm" href="createenseignant.php" role="button">Ajouter un nouvel enseignant</a>

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
                    <th>ID Enseignant</th>
                    <th>ID Département</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Spécialité</th>
                    <th>Opérations</th>
                </thead>
            </tr>

            <tbody>
                <?php
                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                    echo "
                    <tr>
                        <td>{$row['ID_ENSEIGNANT']}</td>
                        <td>{$row['ID_DEPARTEMENT']}</td>
                        <td>{$row['NOM']}</td>
                        <td>{$row['PRENOM']}</td>
                        <td>{$row['SPECIALITE']}</td>
                        <td>
                            <a class='btn btn-primary btn-sm' href='editenseignant.php?ID_ENSEIGNANT={$row['ID_ENSEIGNANT']}'>Modifier</a>
                            <a class='btn btn-danger btn-sm' href='deleteenseignant.php?ID_ENSEIGNANT={$row['ID_ENSEIGNANT']}'>Supprimer</a>
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
