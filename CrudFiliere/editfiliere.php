<?php
include 'C:/wamp64/www/PHPPROJECT/connection_db.php';

$successMessage = $errorMessage = '';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (!isset($_GET['ID_CLASSE'])) {
        header("location:indexfiliere.php");
        exit;
    }

    $id_classe = $_GET['ID_CLASSE'];
    $sql = "SELECT * FROM filiere WHERE ID_CLASSE=?";
    $stmt = $connection->prepare($sql);
    $stmt->execute([$id_classe]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$row) {
        header("location:indexfiliere.php");
        exit;
    }

    $id_classe = $row["ID_CLASSE"];
    $id_departement = $row["ID_DEPARTEMENT"];
    $nom_filiere = $row["NOM_FILIERE"];
    $niveau = $row["NIVEAU"];
} elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_classe = $_POST["id_classe"];
    $id_departement = $_POST["id_departement"];
    $nom_filiere = $_POST["nom_filiere"];
    $niveau = $_POST["niveau"];

    try {
        $stmt = $connection->prepare("UPDATE filiere SET ID_DEPARTEMENT=?, NOM_FILIERE=?, NIVEAU=? WHERE ID_CLASSE=?");
        $result = $stmt->execute([$id_departement, $nom_filiere, $niveau, $id_classe]);

        if ($result) {
            $successMessage = "La mise à jour a été effectuée avec succès!";
            header("location:indexfiliere.php");
            exit();
        } else {
            $errorMessage = "Erreur lors de la mise à jour : " . $stmt->errorInfo()[2];
        }
    } catch (PDOException $e) {
        $errorMessage = "Erreur lors de la mise à jour : " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Filière</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container my-5">
        <h2>Modifier Filière</h2>

        <?php
        if (!empty($errorMessage)) {
            echo "
            <div class='alert alert-danger alert-dismissible fade show' role='alert'>
                <strong>$errorMessage</strong>
                <button type='button' class='button-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
            ";
        }
        ?>

        <form method="post">
            <input type="hidden" name="id_classe" value="<?php echo $id_classe ?>">
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">ID Département</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="id_departement" value="<?php echo $id_departement ?>" required>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Nom Filière</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="nom_filiere" value="<?php echo $nom_filiere ?>" required>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Niveau</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="niveau" value="<?php echo $niveau ?>" required>
                </div>
            </div>
            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a class="btn btn-outline-primary" href="indexfiliere.php" role="button">Annuler</a>
                </div>
            </div>
        </form>
    </div>
</body>
</html>
