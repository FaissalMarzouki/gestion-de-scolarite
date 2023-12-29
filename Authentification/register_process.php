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
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check if the username is already taken
    $stmt = $connection->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $existingUser = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($existingUser) {
        $registrationError = "Username is already taken. Please choose a different one.";
        include "register.php"; // Redirect back to the registration page with an error message
        exit();
    }

    // Hash the password before storing it in the database
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Insert user information into the database
    $stmt = $connection->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    $result = $stmt->execute([$username, $email, $hashedPassword]);

    if ($result) {
        $registrationMessage = "Registration successful. You can now login.";
        include "register.php"; // Redirect back to the registration page with a success message
        exit();
    } else {
        $registrationError = "Registration failed. Please try again.";
        include "register.php"; // Redirect back to the registration page with an error message
        exit();
    }
}
?>
