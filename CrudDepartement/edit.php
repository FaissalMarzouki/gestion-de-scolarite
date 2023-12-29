<?php
session_start();

// Vérifier si l'utilisateur est authentifié
if (!isset($_SESSION['user_id'])) {
    // Rediriger vers la page de connexion
    header("Location: /PHPPROJECT/Authentification/login.php");
    exit();
}
$servername = "localhost";
$username = "fayssal";
$password = "1447";
$databasename = "gestion de scolarite";

try {
    $connection = new PDO("mysql:host=$servername;dbname=$databasename", $username, $password);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Erreur : ' . $e->getMessage());
}

$identifiant = "";
$departement = "";
$description = "";

$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (!isset($_GET['ID_DEPARTEMENT'])) {
        header("location:index.php");
        exit;
    }
    $identifiant = $_GET['ID_DEPARTEMENT'];
    $sql = "SELECT * FROM departement WHERE ID_DEPARTEMENT=?";
    $stmt = $connection->prepare($sql);
    $stmt->execute([$identifiant]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$row) {
        header("location:index.php");
        exit;
    }

    $identifiant = $row["ID_DEPARTEMENT"];
    $departement = $row["NOM_DEPARTEMENT"];
    $description = $row["DESCRIPTION_D"];
} elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $identifiant = $_POST["identifiant"];
    $departement = $_POST["departement"];
    $description = $_POST["description"];

    do {
        if (empty($identifiant) || empty($departement) || empty($description)) {
            $errorMessage = "Tous les champs sont obligatoires";
            break;
        }

        $sql = "UPDATE departement SET NOM_DEPARTEMENT=?, DESCRIPTION_D=? WHERE ID_DEPARTEMENT=?";
        $stmt = $connection->prepare($sql);
        $result = $stmt->execute([$departement, $description, $identifiant]);

        if (!$result) {
            $errorMessage = "Erreur lors de la mise à jour : " . $stmt->errorInfo()[2];
            break;
        }

        $successMessage = "La mise à jour a été effectuée avec succès!";
        header("location:index.php");
        exit();

    } while (false);
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion d'école</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container my-5">
        <h2>Mise à jour d'un département</h2>

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
            <input type="hidden" name="identifiant" value="<?php echo $identifiant ?>">
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Département</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="departement" value="<?php echo $departement ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Description</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="description" value="<?php echo $description ?>">
                </div>
            </div>
            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a class="btn btn-outline-primary" href="/PHPPROJECT/CrudDepartement/index.php" role="button">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</body>
</html>
