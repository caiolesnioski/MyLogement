<?php
// login.php
session_start();
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    // Connexion à la base de données
    $pdo = new PDO('mysql:host=localhost;dbname=location_appartements;charset=utf8mb4', 'root', '');
    $stmt = $pdo->prepare('SELECT * FROM users WHERE email = ?');
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password_hash'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];
        header('Location: home.php');
        exit;
    } else {
        $error = "Email ou mot de passe incorrect.";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion | MyLogement</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="LS.png">
    <style>
        body { background: #14213d; color: #fff; font-family: 'Segoe UI', Arial, sans-serif; margin: 0; }
        .container { min-height: 100vh; display: flex; flex-direction: column; justify-content: center; align-items: center; }
        .login-box { background: rgba(26, 31, 60, 0.95); border-radius: 20px; box-shadow: 0 8px 32px rgba(0,0,0,0.18); padding: 2.5rem 2rem; max-width: 400px; width: 100%; margin: 2rem 0; }
        .login-box h2 { text-align: center; color: #2974fa; margin-bottom: 2rem; font-size: 2rem; }
        input { width: 100%; padding: 0.8rem; border-radius: 10px; border: none; margin-bottom: 1rem; font-size: 1rem; background: #fff; color: #14213d; }
        input:focus { outline: 2px solid #2974fa; }
        .btn-primary { width: 100%; padding: 1rem; background: #2974fa; color: #fff; border: none; border-radius: 10px; font-size: 1.1rem; font-weight: bold; cursor: pointer; margin-top: 1rem; transition: background 0.2s; }
        .btn-primary:hover { background: #fca311; color: #14213d; }
        .error { color: #fca311; text-align: center; margin-bottom: 1rem; }
        .signup-link { text-align: center; margin-top: 1rem; color: #e5e5e5; font-size: 0.98rem; }
        .signup-link a { color: #2974fa; text-decoration: none; font-weight: 500; }
        .signup-link a:hover { text-decoration: underline; }
    </style>
</head>
<body>
    <div style="margin: 2rem;">
        <button onclick="window.history.back()" style="background:#fca311;color:#14213d;border:none;padding:0.7rem 1.5rem;border-radius:8px;font-weight:bold;cursor:pointer;">
            ← Retour
        </button>
    </div>
    <div class="container">
        <form class="login-box" method="POST" action="">
            <h2>Connexion</h2>
            <?php if ($error): ?>
                <div class="error"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>
            <input type="email" name="email" placeholder="Adresse email" required>
            <input type="password" name="password" placeholder="Mot de passe" required>
            <button type="submit" class="btn-primary">SE CONNECTER</button>
            <div class="signup-link">
                Pas encore de compte ? <a href="signup.php">S'inscrire</a>
            </div>
        </form>
    </div>
</body>
</html>