<?php
try {
    $connection = new PDO("mysql:host=localhost;dbname=gestion de scolarite", 'fayssal', '1447');
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Erreur : ' . $e->getMessage());
}
$successMessage = $errorMessage = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_classe = $_POST['id_classe'];
    $id_departement = $_POST['id_departement'];
    $nom_filiere = $_POST['nom_filiere'];
    $niveau = $_POST['niveau'];

    try {
        $stmt = $connection->prepare("INSERT INTO filiere (ID_CLASSE, ID_DEPARTEMENT, NOM_FILIERE, NIVEAU) VALUES (?, ?, ?, ?)");
        $result = $stmt->execute([$id_classe, $id_departement, $nom_filiere, $niveau]);

        if ($result) {
            $successMessage = "Enregistrement ajouté avec succès!";
            header("location:indexfiliere.php");

        } else {
            $errorMessage = "Erreur lors de l'ajout de l'enregistrement : " . $stmt->errorInfo()[2];
        }
    } catch (PDOException $e) {
        $errorMessage = "Erreur lors de l'ajout de l'enregistrement : " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter Filière</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container my-5">
        <h2>Ajouter Filière</h2>

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
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">ID Classe</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="id_classe" required>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">ID Département</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="id_departement" required>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Nom Filière</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="nom_filiere" required>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Niveau</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="niveau" required>
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
