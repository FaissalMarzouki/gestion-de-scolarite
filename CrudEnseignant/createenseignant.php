<?php
try {
    $connection = new PDO("mysql:host=localhost;dbname=gestion de scolarite", 'fayssal', '1447');
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Erreur : ' . $e->getMessage());
}
$successMessage = $errorMessage = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_enseignant = $_POST['id_enseignant'];
    $id_departement = $_POST['id_departement'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $specialite = $_POST['specialite'];

    try {
        $stmt = $connection->prepare("INSERT INTO enseignant (ID_ENSEIGNANT, ID_DEPARTEMENT, NOM, PRENOM, SPECIALITE) VALUES (?, ?, ?, ?, ?)");
        $result = $stmt->execute([$id_enseignant, $id_departement, $nom, $prenom, $specialite]);

        if ($result) {
            $successMessage = "Enregistrement ajouté avec succès!";
            header("location:indexenseignant.php");

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
    <title>Ajouter Enseignant</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container my-5">
        <h2>Ajouter Enseignant</h2>

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
                <label class="col-sm-3 col-form-label">ID Enseignant</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="id_enseignant" required>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">ID Département</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="id_departement" required>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Nom</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="nom" required>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Prénom</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="prenom" required>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Spécialité</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="specialite" required>
                </div>
            </div>
            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a class="btn btn-outline-primary" href="indexenseignant.php" role="button">Annuler</a>
                </div>
            </div>
        </form>
    </div>
</body>
</html>
