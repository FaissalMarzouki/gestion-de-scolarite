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
$description = "";
$departement = "";
$identifiant = "";
try {
    $connection = new PDO("mysql:host=$servername;dbname=$databasename", $username, $password);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Erreur : ' . $e->getMessage());
}

$succes = $errorMessage = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $identifiant = $_POST['identifiant'];
    $departement = $_POST['departement'];
    $description = $_POST['description'];

    try {
        $stmt = $connection->prepare("INSERT INTO departement (ID_DEPARTEMENT, NOM_DEPARTEMENT, DESCRIPTION_D) VALUES (:id_departement, :nom_departement, :description_d)");
        $stmt->bindParam(':id_departement', $identifiant, PDO::PARAM_INT);
        $stmt->bindParam(':nom_departement', $departement, PDO::PARAM_STR);
        $stmt->bindParam(':description_d', $description, PDO::PARAM_STR);

        $stmt->execute();

        $rowCount = $stmt->rowCount();
        if ($rowCount > 0) {
            $succes = "Record added successfully";
            header("Location: index.php");
            exit();
        } else {
            $errorMessage = "Aucun enregistrement ajouté.";
        }
    } catch (PDOException $e) {
        $errorMessage = "Erreur d'insertion : " . $e->getMessage();
    }
}

$connection = null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion d'ecole</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container my-5"> 
        <h2>Ajout d'un nouveau departement</h2>

        <?php
        if (!empty($errorMessage)) {
            echo "
                <div class='alert alert-warning alert-dismissible fade show' role='alert'> 
                    <strong>$errorMessage</strong>
                    <button type='button' class='buton-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>
            ";
        }
        ?>
        
        <div class="container mt-5">
            <div class="alert alert-success" role="alert">
                <?=$succes?>
            </div>
        </div>
        
        <form method="post"> 
            <div class="row mb-3"> 
                <label class="col-sm-3 col-form-label">identifiant du departement</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="identifiant" value="<?php echo $identifiant?>">        
                </div>
            </div>
            <div class="row mb-3"> 
                <label class="col-sm-3 col-form-label">departement</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="departement" value="<?php echo $departement?>">        
                </div>
            </div>
            <div class="row mb-3"> 
                <label class="col-sm-3 col-form-label">description</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="description" value="<?php echo $description?>">  
                </div>
            </div>

            <!--  display succes message-->
            <?php
            if (!empty($sucessMessage)) {
                echo "
                    <div class='alert alert-warning alert-dismissible fade show' role='alert'> 
                        <strong>$sucessMessage</strong>
                        <button type='button' class='buton-close' data-bs-dismiss='alert' aria-label='close'></button>
                    </div>
                ";
            }
            ?>

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
