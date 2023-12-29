<?php
session_start();


try {
    $connection = new PDO("mysql:host=localhost;dbname=gestion de scolarite", 'fayssal', '1447');
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Erreur : ' . $e->getMessage());
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Retrieve user information from the database
    $stmt = $connection->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        // Login successful, store user information in the session
        $_SESSION['user_id'] = $user['Id_user'];
        $_SESSION['username'] = $user['username'];
        header("Location: dashboard.php"); // Redirect to the dashboard or another secured page
        exit();
    } else {
        // Login failed
        $loginError = "Invalid username or password";
        include "login.php"; // Redirect back to the login page with an error message
        exit();
    }
}
?>
