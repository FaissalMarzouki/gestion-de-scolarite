<?php
include 'C:/wamp64/www/PHPPROJECT/connection_db.php';

$sql = "SELECT * FROM matiere";
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
    <title>Liste des Matières</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container my-5">
        <h2>Liste des Matières</h2>
        <a class="btn btn-primary btn-sm" href="creatematiere.php" role="button">Ajouter une nouvelle matière</a>
        <a class="btn btn-danger" href="/PHPPROJECT/Authentification/dashboard.php">dashboard</a>

    </div>

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
                <th>ID Matière</th>
                <th>Nom Matière</th>
                <th>Credits</th>
                <th>Opération</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch(PDO::FETCH_ASSOC)) : ?>
                <tr>
                    <td><?php echo $row['ID_MATIERE']; ?></td>
                    <td><?php echo $row['NOM_MATIERE']; ?></td>
                    <td><?php echo $row['CREDITS']; ?></td>
                    <td>
                        <a class="btn btn-primary btn-sm" href="editmatiere.php?ID_MATIERE=<?php echo $row['ID_MATIERE']; ?>">Modifier</a>
                        <a class="btn btn-danger btn-sm" href="deletematiere.php?ID_MATIERE=<?php echo $row['ID_MATIERE']; ?>">Supprimer</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>
