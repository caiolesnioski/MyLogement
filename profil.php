<?php
// profil.php
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// Connexion à la base de données
$pdo = new PDO('mysql:host=localhost;dbname=location_appartements;charset=utf8mb4', 'root', '');

// Récupérer les informations de l'utilisateur
$stmt = $pdo->prepare('SELECT * FROM users WHERE id = ?');
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    // Si l'utilisateur n'existe pas, déconnexion
    session_destroy();
    header('Location: login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Profil | LogeStay</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="LS.png">
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        body {
            background: #14213d;
            color: #fff;
            font-family: 'Segoe UI', Arial, sans-serif;
            margin: 0;
        }
        .container {
            max-width: 800px;
            margin: 2rem auto;
            padding: 2rem;
            background: rgba(26, 31, 60, 0.95);
            border-radius: 10px;
            box-shadow: 0 4px 24px rgba(0,0,0,0.12);
        }
        h2 {
            text-align: center;
            color: #fca311;
        }
        .form-group {
            margin-bottom: 1rem;
        }
        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
        }
        .form-group input {
            width: 100%;
            padding: 0.6rem;
            border-radius: 6px;
            border: none;
            background: #e5e5e5;
            color: #14213d;
        }
        .btn-primary {
            background: #fca311;
            color: #14213d;
            border: none;
            border-radius: 6px;
            padding: 0.8rem 1.5rem;
            font-weight: bold;
            cursor: pointer;
            font-size: 1rem;
            display: block;
            margin: 1rem auto;
        }
        .btn-primary:hover {
            background: #fff;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Mon Profil</h2>
        <form method="POST" action="profil_update.php">
            <div class="form-group">
                <label for="fullname">Nom complet</label>
                <input type="text" id="fullname" name="fullname" value="<?= htmlspecialchars($user['name']) ?>" required>
            </div>
            <div class="form-group">
                <label for="email">Adresse email</label>
                <input type="email" id="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required>
            </div>
            <div class="form-group">
                <label for="phone">Numéro de téléphone</label>
                <input type="text" id="phone" name="phone" value="<?= htmlspecialchars($user['phone']) ?>" required>
            </div>
            <button type="submit" class="btn-primary">Mettre à jour</button>
        </form>
    </div>
</body>
</html>