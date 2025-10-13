<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fullname = $_POST['fullname'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $birthdate = $_POST['birthdate'] ?? '';
    $address = $_POST['address'] ?? '';
    $address2 = $_POST['address2'] ?? '';
    $zipcode = $_POST['zipcode'] ?? '';
    $city = $_POST['city'] ?? '';
    $country = $_POST['country'] ?? '';

    // Vérification basique
    if ($password !== $confirm_password) {
        header('Location: signup.php?error=mdp');
        exit;
    }

    // Hash du mot de passe
    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    // Connexion à la base de données
    $pdo = new PDO('mysql:host=localhost;dbname=location_appartements;charset=utf8mb4', 'root', '');

    // Vérifier si l’email existe déjà
    $stmt = $pdo->prepare('SELECT id FROM users WHERE email = ?');
    $stmt->execute([$email]);
    if ($stmt->fetch()) {
        header('Location: signup.php?error=email');
        exit;
    }

    // Insérer le nouvel utilisateur
    $stmt = $pdo->prepare('INSERT INTO users (name, email, password_hash, phone, birthdate, address, address2, zipcode, city, country) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
    $stmt->execute([$fullname, $email, $password_hash, $phone, $birthdate, $address, $address2, $zipcode, $city, $country]);

    // Récupérer l’ID de l’utilisateur
    $user_id = $pdo->lastInsertId();

    // Connecter l’utilisateur
    $_SESSION['user_id'] = $user_id;
    $_SESSION['user_name'] = $fullname;

    // Rediriger vers la page d’accueil
    header('Location: home.php');
    exit;
}
?>