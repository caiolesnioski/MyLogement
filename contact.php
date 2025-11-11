
<?php
// contact.php
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
    <title>Contactez-nous | LogeStay</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="LS.png">
    <style>
        body {
            background: #14213d url('assets/img/bg-leaves.png') no-repeat center center fixed;
            background-size: cover;
            color: #fff;
            font-family: 'Segoe UI', Arial, sans-serif;
            margin: 0;
        }
        .container {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
        .contact-box {
            background: rgba(26, 31, 60, 0.95);
            border-radius: 20px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.18);
            padding: 2.5rem 2rem;
            max-width: 420px;
            width: 100%;
            margin: 2rem 0;
        }
        .contact-box h2 {
            text-align: center;
            color: #fff;
            margin-bottom: 2rem;
            font-size: 2rem;
        }
        input, textarea {
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
        .error, .success {
            text-align: center;
            margin-bottom: 1rem;
            font-weight: bold;
        }
        .error { color: #fca311; }
        .success { color: #4bb543; }
    </style>
</head>
<body>
    <div class="container">
        <form class="contact-box" method="POST" action="">
            <h2>Contactez-nous</h2>
            <?php if ($error): ?>
                <div class="error"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>
            <?php if ($success): ?>
                <div class="success"><?= htmlspecialchars($success) ?></div>
            <?php endif; ?>
            <input type="text" name="name" placeholder="Votre nom complet" required>
            <input type="email" name="email" placeholder="Votre email" required>
            <input type="text" name="subject" placeholder="Objet de votre message">
            <textarea name="message" placeholder="Décrivez votre demande en détail..." required></textarea>
            <button type="submit" class="btn-primary">ENVOYER LE MESSAGE</button>
        </form>
    </div>
</body>
</html>