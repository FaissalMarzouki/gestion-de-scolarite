<?php
include 'C:/wamp64/www/PHPPROJECT/connection_db.php';

$successMessage = $errorMessage = '';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (!isset($_GET['ID_MATIERE'])) {
        header("location:indexmaietere.php");
        exit;
    }

    $id_matiere = $_GET['ID_MATIERE'];
    $sql = "SELECT * FROM matiere WHERE ID_MATIERE=?";
    $stmt = $connection->prepare($sql);
    $stmt->execute([$id_matiere]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$row) {
        header("location:indexmatiere.php");
        exit;
    }

    $id_matiere = $row["ID_MATIERE"];
    $nom_matiere = $row["NOM_MATIERE"];
    $credits = $row["CREDITS"];
} elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_matiere = $_POST["id_matiere"];
    $nom_matiere = $_POST["nom_matiere"];
    $credits = $_POST["credits"];

    try {
        $stmt = $connection->prepare("UPDATE matiere SET NOM_MATIERE=?, CREDITS=? WHERE ID_MATIERE=?");
        $result = $stmt->execute([$nom_matiere, $credits, $id_matiere]);

        if ($result) {
            $successMessage = "La mise à jour a été effectuée avec succès!";
            header("location:indexmatiere.php");
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
    <title>Modifier Matière</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container my-5">
        <h2>Modifier Matière</h2>

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
            <input type="hidden" name="id_matiere" value="<?php echo $id_matiere ?>">
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Nom Matière</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="nom_matiere" value="<?php echo $nom_matiere ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Crédits</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="credits" value="<?php echo $credits ?>">
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
