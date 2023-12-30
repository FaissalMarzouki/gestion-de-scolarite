<?php
include 'C:/wamp64/www/PHPPROJECT/connection_db.php';

$successMessage = $errorMessage = '';

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['ID_ETUDIANT'])) {
    $id_etudiant = $_GET['ID_ETUDIANT'];

    $stmt = $connection->prepare("SELECT * FROM etudiant WHERE ID_ETUDIANT = ?");
    $stmt->execute([$id_etudiant]);

    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$row) {
        header("location:indexetudiant.php");
        exit;
    }

    // Récupérez les données nécessaires pour le formulaire d'édition
    $id_etudiant = $row["ID_ETUDIANT"];
    $id_salle = $row["ID_SALLE"];
    $id_classe = $row["ID_CLASSE"];
    $nom = $row["NOM"];
    $prenom = $row["PRENOM"];
    $date_de_naissance = $row["DATE_DE_NAISSANCE"];
    $adresse = $row["ADRESSE"];
    $date_presence = $row["DATE_PRESENCE"];

} elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_etudiant = $_POST["id_etudiant"];
    $id_salle = $_POST["id_salle"];
    $id_classe = $_POST["id_classe"];
    $nom = $_POST["nom"];
    $prenom = $_POST["prenom"];
    $date_de_naissance = $_POST["date_de_naissance"];
    $adresse = $_POST["adresse"];
    $date_presence = $_POST["date_presence"];

    try {
        $stmt = $connection->prepare("UPDATE etudiant SET ID_SALLE=?, ID_CLASSE=?, NOM=?, PRENOM=?, DATE_DE_NAISSANCE=?, ADRESSE=?, DATE_PRESENCE=? WHERE ID_ETUDIANT=?");
        $result = $stmt->execute([$id_salle, $id_classe, $nom, $prenom, $date_de_naissance, $adresse, $date_presence, $id_etudiant]);

        if ($result) {
            $successMessage = "Enregistrement mis à jour avec succès!";
            header("location:indexetudiant.php");

        } else {
            $errorMessage = "Erreur lors de la mise à jour de l'enregistrement : " . $stmt->errorInfo()[2];
        }
    } catch (PDOException $e) {
        $errorMessage = "Erreur lors de la mise à jour de l'enregistrement : " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Etudiant</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container my-5">
        <h2>Modifier Etudiant</h2>

        <?php
        if (!empty($errorMessage)) {
            echo "
            <div class='alert alert-danger alert-dismissible fade show' role='alert'>
                <strong>$errorMessage</strong>
                <button type='button' class='button-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
            ";
        } elseif (!empty($successMessage)) {
            echo "
            <div class='alert alert-success alert-dismissible fade show' role='alert'>
                <strong>$successMessage</strong>
                <button type='button' class='button-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
            ";
        }
        ?>

        <form method="post">
            <input type="hidden" name="id_etudiant" value="<?php echo $id_etudiant ?>">
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">ID Salle</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="id_salle" value="<?php echo $id_salle ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">ID Classe</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="id_classe" value="<?php echo $id_classe ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Nom</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="nom" value="<?php echo $nom ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Prénom</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="prenom" value="<?php echo $prenom ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Date de Naissance</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="date_de_naissance" value="<?php echo $date_de_naissance ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Adresse</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="adresse" value="<?php echo $adresse ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Date de Présence</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="date_presence" value="<?php echo $date_presence ?>">
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
