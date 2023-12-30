<?php
include 'C:/wamp64/www/PHPPROJECT/connection_db.php';

$successMessage = $errorMessage = '';

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['ID_ENSEIGNANT'])) {
    $id_enseignant = $_GET['ID_ENSEIGNANT'];

    $stmt = $connection->prepare("SELECT * FROM enseignant WHERE ID_ENSEIGNANT = ?");
    $stmt->execute([$id_enseignant]);

    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$row) {
        header("location:indexenseignant.php");
        exit;
    }

    $id_enseignant = $row["ID_ENSEIGNANT"];
    $id_departement = $row["ID_DEPARTEMENT"];
    $nom = $row["NOM"];
    $prenom = $row["PRENOM"];
    $specialite = $row["SPECIALITE"];
} elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_enseignant = $_POST["id_enseignant"];
    $id_departement = $_POST["id_departement"];
    $nom = $_POST["nom"];
    $prenom = $_POST["prenom"];
    $specialite = $_POST["specialite"];

    try {
        $stmt = $connection->prepare("UPDATE enseignant SET ID_DEPARTEMENT=?, NOM=?, PRENOM=?, SPECIALITE=? WHERE ID_ENSEIGNANT=?");
        $result = $stmt->execute([$id_departement, $nom, $prenom, $specialite, $id_enseignant]);

        if ($result) {
            $successMessage = "La mise à jour a été effectuée avec succès!";
            header("location:indexenseignant.php");
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
    <title>Modifier Enseignant</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container my-5">
        <h2>Modifier Enseignant</h2>

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
            <input type="hidden" name="id_enseignant" value="<?php echo $id_enseignant ?>">
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">ID Département</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="id_departement" value="<?php echo $id_departement ?>" required>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Nom</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="nom" value="<?php echo $nom ?>" required>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Prénom</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="prenom" value="<?php echo $prenom ?>" required>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Spécialité</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="specialite" value="<?php echo $specialite ?>" required>
                </div>
            </div>
            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a class="btn btn-outline-primary" href="index.php" role="button">Annuler</a>
                </div>
            </div>
        </form>
    </div>
</body>
</html>
