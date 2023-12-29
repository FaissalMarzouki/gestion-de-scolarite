<?php
session_start();

// Vérifier si l'utilisateur est authentifié
if (!isset($_SESSION['user_id'])) {
    // Rediriger vers la page de connexion
    header("Location: login.php");
    exit();
}

// Traitement du formulaire d'ajout
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        $connection = new PDO("mysql:host=localhost;dbname=gestion de scolarite", 'fayssal', '1447');
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $id_salle = $_POST['id_salle'];
        $numero = $_POST['numero'];
        $capacite = $_POST['capacite'];

        // Insertion des données dans la table salle
        $stmt = $connection->prepare("INSERT INTO salle (ID_SALLE, NUMERO, CAPPACITE) VALUES (?, ?, ?)");
        $stmt->execute([$id_salle, $numero, $capacite]);

        $successMessage = "La salle a été ajoutée avec succès!";
        header("Location: indexsalle.php");
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
    <title>Ajouter une salle</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container my-5">
        <h2>Ajouter une salle</h2>

        <?php
        if (!empty($errorMessage)) {
            echo "
            <div class='alert alert-danger alert-dismissible fade show' role='alert'>
                <strong>$errorMessage</strong>
                <button type='button' class='button-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
            ";
        }

        if (!empty($successMessage)) {
            echo "
            <div class='alert alert-success alert-dismissible fade show' role='alert'>
                <strong>$successMessage</strong>
                <button type='button' class='button-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
            ";
        }
        ?>

        <form method="post">
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">ID de la salle</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="id_salle" required>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Numéro de la salle</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="numero" required>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Capacité de la salle</label>
                <div class="col-sm-6">
                    <input type="number" class="form-control" name="capacite" required>
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
