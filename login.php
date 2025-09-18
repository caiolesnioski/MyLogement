<?php
session_start();

// Rediriger si déjà connecté
if (isset($_SESSION['user_id'])) {
    $userType = $_SESSION['user_type'];
    header("Location: /dashboard-" . $userType . ".php");
    exit();
}

$error = '';
$success = '';

// Traitement du formulaire de connexion
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $password = $_POST['password'] ?? '';
    $userType = $_POST['user_type'] ?? 'locataire';
    $remember = isset($_POST['remember']);
    
    if (!$email) {
        $error = 'Veuillez entrer une adresse e-mail valide.';
    } elseif (strlen($password) < 6) {
        $error = 'Le mot de passe doit contenir au moins 6 caractères.';
    } else {
        // Ici vous intégreriez la vérification avec votre base de données
        // Simulation pour l'exemple
        if (verifyUser($email, $password, $userType)) {
            $_SESSION['user_id'] = getUserId($email);
            $_SESSION['user_type'] = $userType;
            $_SESSION['user_email'] = $email;
            
            if ($remember) {
                // Cookie pour 30 jours
                setcookie('remember_user', base64_encode($email . '|' . $userType), time() + (30 * 24 * 60 * 60), '/');
            }
            
            header("Location: /dashboard-" . $userType . ".php");
            exit();
        } else {
            $error = 'E-mail ou mot de passe incorrect.';
        }
    }
}

// Fonctions de simulation (à remplacer par votre logique DB)
function verifyUser($email, $password, $userType) {
    // Simulation - remplacer par votre logique de vérification
    return true; // Pour l'exemple
}

function getUserId($email) {
    // Simulation - retourner l'ID de l'utilisateur depuis la DB
    return 1;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LogeStay - Connexion</title>
     <!-- Favicons -->
    <link href="LS.png" rel="icon">
    <link href="LS.png" rel="apple-touch-icon">

    <link rel="stylesheet" href="assets/css/login.css">
</head>
<body>
    <a href="index.html" class="back-home">← Retour à l'accueil</a>
    
    <div class="login-container">
        <div class="login-left">
            <div class="logo">🏠 LogeStay</div>
            <h1 class="welcome-text">Bienvenue !</h1>
            <p class="welcome-subtitle">Connectez-vous pour accéder à votre espace personnel et gérer vos réservations en toute simplicité.</p>
            
            <div class="features-preview">
                <div class="feature-item">
                    <span class="icon">📅</span>
                    <span>Gestion complète des réservations</span>
                </div>
                <div class="feature-item">
                    <span class="icon">💰</span>
                    <span>Tarification flexible et automatisée</span>
                </div>
                <div class="feature-item">
                    <span class="icon">📊</span>
                    <span>Tableau de bord intuitif</span>
                </div>
                <div class="feature-item">
                    <span class="icon">🔒</span>
                    <span>Sécurité maximale des données</span>
                </div>
            </div>
        </div>
        
        <div class="login-right">
            <div class="login-header">
                <h2>Connexion</h2>
                <p>Accédez à votre compte LogeStay</p>
            </div>

            <div id="alertContainer">
                <?php if ($error): ?>
                    <div class="alert error"><?= htmlspecialchars($error) ?></div>
                <?php endif; ?>
                <?php if ($success): ?>
                    <div class="alert success"><?= htmlspecialchars($success) ?></div>
                <?php endif; ?>
            </div>
            
            <div class="user-type-selector">
                <button type="button" class="user-type-btn active" data-type="locataire">
                    👤 Locataire
                </button>
                <button href="login-proprietaire.php" class="user-type-btn"data-type="proprietaire">🏠 Propriétaire  
                </button>
            </div>

            <form class="login-form" id="loginForm" method="POST" action="">
                <input type="hidden" name="user_type" id="userTypeInput" value="locataire">
                
                <div class="form-group">
                    <label for="email">Adresse e-mail</label>
                    <input type="email" id="email" name="email" required value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
                </div>

                <div class="form-group">
                    <label for="password">Mot de passe</label>
                    <input type="password" id="password" name="password" required>
                </div>

                <div class="form-options">
                    <label class="remember-me">
                        <input type="checkbox" id="remember" name="remember">
                        Se souvenir de moi
                    </label>
                    <a href="forgot-password.php" class="forgot-password">Mot de passe oublié ?</a>
                </div>

                <button type="submit" class="login-btn" id="submitBtn">
                    Se connecter
                </button>
            </form>

            <div class="divider">
                <span>ou</span>
            </div>

            <div class="signup-link">
                Pas encore de compte ? 
                <a href="new.compte.php" id="signupLink">Créer un compte</a>
            </div>
        </div>
    </div>

    <script src="assets/js/login.js"></script>
</body>
</html>