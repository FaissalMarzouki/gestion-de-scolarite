<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: /PHPPROJECT/Authentification/login.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container my-5">
        <h2>Welcome, <?php echo $_SESSION['username']; ?>!</h2>
        <a class="btn btn-danger" href="logout.php">Logout</a>
        <a class="btn btn-primary" href="/PHPPROJECT/CrudDepartement/index.php">Go to Department Page</a>
        <a class="btn btn-primary" href="/PHPPROJECT/CrudFiliere/indexfiliere.php">Go to filiere Page</a>
        <a class="btn btn-primary" href="/PHPPROJECT/CrudEnseignant/indexenseignant.php">Go to Enseignant Page</a>
        <a class="btn btn-primary" href="/PHPPROJECT/CrudEtudiant/indexetudiant.php">Go to Etudiant Page</a>
        <a class="btn btn-primary" href="/PHPPROJECT/CrudMatiere/indexmatiere.php">Go to Matiere Page</a>
        <a class="btn btn-primary" href="/PHPPROJECT/CrudSalle/indexsalle.php">Go to Salle Page</a>
    </div>
</body>
</html>
