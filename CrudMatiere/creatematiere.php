<?php
include 'C:/wamp64/www/PHPPROJECT/connection_db.php';

$successMessage = $errorMessage = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_matiere = $_POST['id_matiere'];
    $nom_matiere = $_POST['nom_matiere'];
    $credits = $_POST['credits'];

    try {
        $stmt = $connection->prepare("INSERT INTO matiere (ID_MATIERE, NOM_MATIERE, CREDITS) VALUES (?, ?, ?)");
        $stmt->execute([$id_matiere, $nom_matiere, $credits]);

        $rowCount = $stmt->rowCount();
        if ($rowCount > 0) {
            $successMessage = "Enregistrement ajouté avec succès";
            // Rediriger vers la liste des matières après l'ajout réussi
            header("Location: indexmatiere.php");
            exit();
        } else {
            $errorMessage = "Aucun enregistrement ajouté.";
        }
    } catch (PDOException $e) {
        $errorMessage = "Erreur d'insertion : " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une nouvelle Matière</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container my-5">
        <h2>Ajouter une nouvelle Matière</h2>

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
                <label class="col-sm-3 col-form-label">ID Matière</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="id_matiere" required>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Nom Matière</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="nom_matiere" required>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Crédits</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="credits" required>
                </div>
            </div>
            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-6 d-grid">
                    <button type="submit" class="btn btn-primary">Ajouter</button>
                </div>
            </div>
        </form>
    </div>
</body>
</html>
