<?php
session_start();

// Vérifier si l'utilisateur est authentifié
if (!isset($_SESSION['user_id'])) {
    // Rediriger vers la page de connexion
    header("Location: /PHPPROJECT/Authentification/login.php");
    exit();
}

// Gestion de la déconnexion
if (isset($_GET['logout'])) {
    // Détruire la session et rediriger vers la page de connexion
    session_destroy();
    header("Location: /PHPPROJECT/Authentification/login.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ecole</title>
    <link rel="Stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="Container my -5">
     <h2> La liste des  departements</h2>
     <a class="btn btn-primary btn-sm" href="/PHPPROJECT/CrudDepartement/create.php" role="button">Ajouter un nouveau departement </a>
     <a class="btn btn-danger" href="/PHPPROJECT/Authentification/dashboard.php">dashboard</a>
     </div>
     <br>
     <?php
     if (!empty($successMessage)) {
        echo "
        <div class='alert alert-success alert-dismissible fade show' role='alert'>
            <strong>$successMessage</strong>
            <button type='button' class='button-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>
        ";
    }
     ?>
     <table class="table"> 
        <tr>
        <thead>
         <th> le nom du departement</th>
         <th> la description du Departement</th>
         <th> Operation</th>
</tr>
       </thead>

       <tbody>
       <?php
include 'C:/wamp64/www/PHPPROJECT/connection_db.php';


$sql = "SELECT * FROM departement";
$result = $connection->query($sql);

if (!$result) {
    die("Invalid query: " . $connection->errorInfo()[2]);
}

while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
    echo "
    <tr>
        <td>{$row['NOM_DEPARTEMENT']}</td>
        <td>{$row['DESCRIPTION_D']}</td>
        <td>
            <a class='btn btn-primary btn-sm' href='/PHPPROJECT/CrudDepartement/edit.php?ID_DEPARTEMENT={$row['ID_DEPARTEMENT']}'>Modifier</a>
            <a class='btn btn-danger btn-sm' href='/PHPPROJECT/CrudDepartement/delete.php?ID_DEPARTEMENT={$row['ID_DEPARTEMENT']}'>Supprimer</a>
        </td>  
    </tr>
    ";
}

?>

         </tbody>
     </table>
</body>
</html>
