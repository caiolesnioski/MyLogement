<?php
session_start();

// Se não estiver logado ou não for admin, redireciona para login
if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'admin') {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin</title>
</head>
<body>
    <h1>Bienvenue, Admin !</h1>
    <p>Você está conectado como administrador.</p>
    <a href="logout.php">Se déconnecter</a>
</body>
</html>
