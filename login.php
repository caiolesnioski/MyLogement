<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LogeStay - Connexion</title>
    <link href="LS.png" rel="icon">
    <link href="LS.png" rel="apple-touch-icon">
    <link rel="stylesheet" href="assets/css/login.css">
</head>
<body>
    <a href="index.html" class="back-home">← Retour à l'accueil</a>
    
    <div class="theme-indicator" id="themeIndicator">
        🌙 Mode Propriétaire Activé
    </div>
    
    <div class="login-container fade-in" id="loginContainer">
        <div class="login-left" id="loginLeft">
            <div class="logo" id="logo">🏠 LogeStay</div>
            <h1 class="welcome-text" id="welcomeText">Bienvenue !</h1>
            <p class="welcome-subtitle" id="welcomeSubtitle">Connectez-vous pour accéder à votre espace personnel et gérer vos réservations en toute simplicité.</p>
            
            <div class="features-preview" id="featuresPreview">
                <div class="feature-item" id="feature1">
                    <span class="icon">📅</span>
                    <span id="featureText1">Gestion complète des réservations</span>
                </div>
                <div class="feature-item" id="feature2">
                    <span class="icon">💰</span>
                    <span id="featureText2">Tarification flexible et automatisée</span>
                </div>
                <div class="feature-item" id="feature3">
                    <span class="icon">📊</span>
                    <span id="featureText3">Tableau de bord intuitif</span>
                </div>
                <div class="feature-item" id="feature4">
                    <span class="icon">🔒</span>
                    <span id="featureText4">Sécurité maximale des données</span>
                </div>
            </div>
        </div>
        
        <div class="login-right" id="loginRight">
            <div class="login-header">
                <h2 id="loginTitle">Connexion</h2>
                <p id="loginSubtitle">Accédez à votre compte LogeStay</p>
            </div>

            <div id="alertContainer"></div>
            
            <div class="user-type-selector" id="userTypeSelector">
                <button type="button" class="user-type-btn active" id="locataireBtn" data-type="locataire">
                    👤 Locataire
                </button>
                <button type="button" class="user-type-btn" id="proprietaireBtn" data-type="proprietaire">
                    🏠 Propriétaire  
                </button>
            </div>

            <form class="login-form" id="loginForm" method="POST" action="">
                <input type="hidden" name="user_type" id="userTypeInput" value="locataire">
                
                <div class="form-group">
                    <label for="email" id="emailLabel">Adresse e-mail</label>
                    <input type="email" id="email" name="email" required>
                    <span class="icon" id="emailIcon">📧</span>
                </div>

                <div class="form-group">
                    <label for="password" id="passwordLabel">Mot de passe</label>
                    <input type="password" id="password" name="password" required>
                    <span class="icon" id="togglePassword">👁️</span>
                </div>

                <div class="form-options">
                    <label class="remember-me" id="rememberLabel">
                        <input type="checkbox" id="remember" name="remember">
                        Se souvenir de moi
                    </label>
                    <a href="forgot-password.php" class="forgot-password" id="forgotLink">Mot de passe oublié ?</a>
                </div>

                <button type="submit" class="login-btn" id="submitBtn">
                    Se connecter
                </button>
            </form>

            <div class="divider" id="divider">
                <span id="dividerText">ou</span>
            </div>

            <div class="signup-link" id="signupLinkContainer">
                Pas encore de compte ? 
                <a href="new.compte.php" id="signupLink">Créer un compte</a>
            </div>
        </div>
    </div>
    <script src="assets/js/login.js"></script>
</body>
</html>