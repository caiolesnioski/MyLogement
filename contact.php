<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

$error = '';
$success = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $subject = trim($_POST['subject'] ?? '');
    $message = trim($_POST['message'] ?? '');

    if (!$name || !$email || !$message) {
        $error = "Veuillez remplir tous les champs obligatoires.";
    } else {
        try {
            $pdo = new PDO('mysql:host=localhost;dbname=location_appartements;charset=utf8mb4', 'root', '');
            $stmt = $pdo->prepare("INSERT INTO contact_messages (name, email, subject, message) VALUES (?, ?, ?, ?)");
            $stmt->execute([$name, $email, $subject, $message]);
            $success = "Votre message a bien été envoyé !";
        } catch (Exception $e) {
            $error = "Erreur lors de l'envoi du message.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>MyLogement - Contact</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="LS.png">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            background: #14213d url('assets/img/bg-leaves.png') no-repeat center center fixed;
            background-size: cover;
            color: #fff;
            font-family: 'Segoe UI', Arial, sans-serif;
            min-height: 100vh;
        }
        .header {
            background: rgba(26, 31, 60, 0.98);
            padding: 1.2rem 0 1.2rem 0;
            box-shadow: 0 2px 16px rgba(0,0,0,0.10);
        }
        .nav {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 2rem;
        }
        .logo { font-size: 1.4rem; font-weight: 700; color: #1e90ff; }
        .menu { display: flex; gap: 1.5rem; }
        .menu a { color: #cbd8e6; text-decoration: none; transition: color 0.3s; }
        .menu a:hover { color: #1e90ff; }
        .user { color: #8fa3ba; font-size: 0.9rem; }

        .container-center { max-width: 1200px; margin: 2rem auto; padding: 0 2rem; }

        .card {
            background: rgba(26, 31, 60, 0.95);
            border-radius: 20px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.18);
            padding: 2.5rem 2rem;
            max-width: 480px;
            width: 100%;
            margin: 2rem auto;
        }
        h2 { margin-bottom: 1.5rem; font-size: 1.8rem; color: #2974fa; text-align: center; }
        label { display: block; font-size: 0.85rem; margin-bottom: 0.4rem; color: #d7e3f0; }
        input[type=text], input[type=email], textarea {
            width: 100%;
            padding: 0.8rem;
            border-radius: 10px;
            border: none;
            margin-bottom: 1rem;
            font-size: 1rem;
            background: #fff;
            color: #14213d;
        }
        textarea {
            min-height: 100px;
            resize: vertical;
        }
        input:focus, textarea:focus {
            outline: 2px solid #2974fa;
        }
        .btn-primary {
            width: 100%;
            padding: 1rem;
            background: #2974fa;
            color: #fff;
            border: none;
            border-radius: 10px;
            font-size: 1.1rem;
            font-weight: bold;
            cursor: pointer;
            margin-top: 1rem;
            transition: background 0.2s;
        }
        .btn-primary:hover {
            background: #fca311;
            color: #14213d;
        }
        .btn-secondary {
            width: 100%;
            padding: 1rem;
            background: #fca311;
            color: #14213d;
            border: none;
            border-radius: 10px;
            font-size: 1.1rem;
            font-weight: bold;
            cursor: pointer;
            margin-top: 0.7rem;
            transition: background 0.2s;
        }
        .btn-secondary:hover {
            background: #fff;
            color: #14213d;
        }
        .error, .success {
            text-align: center;
            margin-bottom: 1rem;
            font-weight: bold;
        }
        .error { color: #fca311; }
        .success { color: #4bb543; }
        @media (max-width: 600px) {
            .container-center { padding: 0 0.5rem; }
            .card { padding: 1.2rem 0.5rem; }
            .nav { flex-direction: column; gap: 1rem; }
        }
    </style>
</head>
<body>
    <header class="header">
        <div class="nav">
            <span class="logo">MyLogement</span>
            <nav class="menu">
                <a href="index.php">Accueil</a>
                <a href="contact.php">Contact</a>
                <a href="favoris.php">Favoris</a>
                <a href="reservation.php">Réservations</a>
                <a href="profil.php">Profil</a>
                <a href="create_logement.php">Logements</a>
                <a href="logout.php">Déconnexion</a>
            </nav>
            <span class="user">
                <?php if (isset($_SESSION['user_email'])): ?>
                    <?= htmlspecialchars($_SESSION['user_email']) ?>
                <?php endif; ?>
            </span>
        </div>
    </header>

    <div class="container-center">
        <form class="card" method="POST" action="">
            <h2>Contactez-nous</h2>
            <?php if ($error): ?>
                <div class="error"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>
            <?php if ($success): ?>
                <div class="success"><?= htmlspecialchars($success) ?></div>
            <?php endif; ?>
            <label for="name">Votre nom complet</label>
            <input type="text" name="name" id="name" placeholder="Votre nom complet" required>
            <label for="email">Votre email</label>
            <input type="email" name="email" id="email" placeholder="Votre email" required>
            <label for="subject">Objet de votre message</label>
            <input type="text" name="subject" id="subject" placeholder="Objet de votre message">
            <label for="message">Message</label>
            <textarea name="message" id="message" placeholder="Décrivez votre demande en détail..." required></textarea>
            <button type="submit" class="btn-primary">ENVOYER LE MESSAGE</button>
            <button type="button" class="btn-secondary" onclick="window.location.href='home.php'">
                ← Retour à l'accueil
            </button>
        </form>
    </div>
</body>
</html>