<?php
include 'C:/wamp64/www/PHPPROJECT/connection_db.php';


$successMessage = $errorMessage = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_etudiant = $_POST['id_etudiant'];
    $id_salle = $_POST['id_salle'];
    $id_classe = $_POST['id_classe'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $date_naissance = $_POST['date_naissance'];
    $adresse = $_POST['adresse'];
    $date_presence = $_POST['date_presence'];

    try {
        $stmt = $connection->prepare("INSERT INTO etudiant (ID_ETUDIANT, ID_SALLE, ID_CLASSE, NOM, PRENOM, DATE_DE_NAISSANCE, ADRESSE, DATE_PRESENCE) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $result = $stmt->execute([$id_etudiant, $id_salle, $id_classe, $nom, $prenom, $date_naissance, $adresse, $date_presence]);

        if ($result) {
            $successMessage = "Enregistrement ajouté avec succès!";
            header("location:indexetudiant.php");

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
    <title>Ajouter Étudiant</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container my-5">
        <h2>Ajouter Étudiant</h2>

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
                <label class="col-sm-3 col-form-label">ID Étudiant</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="id_etudiant" required>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">ID Salle</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="id_salle" required>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">ID Classe</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="id_classe" required>
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
                <label class="col-sm-3 col-form-label">Date de Naissance</label>
                <div class="col-sm-6">
                    <input type="date" class="form-control" name="date_naissance" required>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Adresse</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="adresse">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Date de Présence</label>
                <div class="col-sm-6">
                    <input type="date" class="form-control" name="date_presence">
                </div>
            </div>
            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a class="btn btn-outline-primary" href="indexetudiant.php" role="button">Annuler</a>
                </div>
            </div>
        </form>
    </div>
</body>
</html>
