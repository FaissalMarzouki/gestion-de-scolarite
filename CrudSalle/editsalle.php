<?php
try {
    $connection = new PDO("mysql:host=localhost;dbname=gestion de scolarite", 'fayssal', '1447');
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Erreur : ' . $e->getMessage());
}
$successMessage = $errorMessage = '';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (!isset($_GET['ID_SALLE'])) {
        header("location:index.php");
        exit;
    }

    $id_salle = $_GET['ID_SALLE'];
    $sql = "SELECT * FROM salle WHERE ID_SALLE=?";
    $stmt = $connection->prepare($sql);
    $stmt->execute([$id_salle]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$row) {
        header("location:indexsalle.php");
        exit;
    }

    $id_salle = $row["ID_SALLE"];
    $numero = $row["NUMERO"];
    $capacite = $row["CAPPACITE"];
} elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_salle = $_POST["id_salle"];
    $numero = $_POST["numero"];
    $capacite = $_POST["capacite"];

    try {
        $stmt = $connection->prepare("UPDATE salle SET NUMERO=?, CAPPACITE=? WHERE ID_SALLE=?");
        $result = $stmt->execute([$numero, $capacite, $id_salle]);

        if ($result) {
            $successMessage = "La mise à jour a été effectuée avec succès!";
            header("location:indexsalle.php");
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
    <title>Modification d'une Salle</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container my-5">
        <h2>Modification d'une Salle</h2>

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
            <input type="hidden" name="id_salle" value="<?php echo $id_salle; ?>">
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Numéro</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="numero" value="<?php echo $numero; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Capacité</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="capacite" value="<?php echo $capacite; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a class="btn btn-outline-primary" href="indexsalle.php" role="button">Annuler</a>
                </div>
            </div>
        </form>
    </div>
</body>
</html>
