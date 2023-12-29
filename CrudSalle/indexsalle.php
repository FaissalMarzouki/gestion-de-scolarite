<?php
try {
    $connection = new PDO("mysql:host=localhost;dbname=gestion de scolarite", 'fayssal', '1447');
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Erreur : ' . $e->getMessage());
}
$sql = "SELECT * FROM salle";
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
    <title>Liste des Salles</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container my-5">
        <h2>Liste des Salles</h2>
        <a class="btn btn-primary btn-sm" href="createsalle.php" role="button">Ajouter une nouvelle salle</a>
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
                <th>Numéro</th>
                <th>Capacité</th>
                <th>Opération</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch(PDO::FETCH_ASSOC)) : ?>
                <tr>
                    <td><?php echo $row['NUMERO']; ?></td>
                    <td><?php echo $row['CAPPACITE']; ?></td>
                    <td>
                        <a class="btn btn-primary btn-sm" href="editsalle.php?ID_SALLE=<?php echo $row['ID_SALLE']; ?>">Modifier</a>
                        <a class="btn btn-danger btn-sm" href="deletesalle.php?ID_SALLE=<?php echo $row['ID_SALLE']; ?>">Supprimer</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>
