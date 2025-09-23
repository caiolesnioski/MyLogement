<?php
session_start();
require 'db.php'; // Arquivo com conexão PDO em $pdo

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $user_type = $_POST['user_type']; // locataire, proprietaire ou admin

    // Determina tabela e campo de id conforme tipo de usuário
    if ($user_type === 'proprietaire') {
        $table = 'proprietaires';
        $id_field = 'id_proprio';
    } elseif ($user_type === 'admin') {
        $table = 'admins';
        $id_field = 'id_admin';
    } else {
        $table = 'clients';
        $id_field = 'id_client';
    }

    // Busca usuário pelo e-mail
    $stmt = $pdo->prepare("SELECT * FROM $table WHERE email = :email LIMIT 1");
    $stmt->execute(['email' => $email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // Atenção: senha em texto simples! (Para produção, use password_hash)
        if ($password === $user['password']) {
            $_SESSION['user_id'] = $user[$id_field];
            $_SESSION['user_type'] = $user_type;
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Mot de passe incorrect']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Utilisateur non trouvé']);
    }
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LogeStay - Connexion</title>
    <link href="LS.png" rel="icon">
    <link href="LS.png" rel="apple-touch-icon">
    <link rel="stylesheet" href="assets/css/styles.css">
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
            <div id="alertContainer" class="hidden">
                <div class="alert error">Message d'erreur apparaîtra ici</div>
            </div>
            <div class="user-type-selector">
                <button type="button" class="user-type-btn active" data-type="locataire">
                    👤 Locataire
                </button>
                <button type="button" class="user-type-btn" data-type="proprietaire">
                    🏠 Propriétaire
                </button>
                <button type="button" class="user-type-btn" data-type="admin">
                    🛡️ Admin
                </button>   
            </div>
            <form class="login-form" id="loginForm" method="POST" action="login.php">
                <input type="hidden" name="user_type" id="userTypeInput" value="locataire">
                <div class="form-group">
                    <label for="email">Adresse e-mail</label>
                    <input type="email" id="email" name="email" required>
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
                    <a href="#" class="forgot-password">Mot de passe oublié ?</a>
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
                <a href="signup.html" id="signupLink">Créer un compte</a>
            </div>
        </div>
    </div>
    <script>
    // ===== Seletor de tipo de usuário =====
    const userTypeBtns = document.querySelectorAll('.user-type-btn');
    const userTypeInput = document.getElementById('userTypeInput');
    userTypeBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            userTypeBtns.forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            userTypeInput.value = btn.getAttribute('data-type');
        });
    });

    // ===== Função para exibir alertas =====
    function showAlert(message, type) {
        const alertContainer = document.getElementById('alertContainer');
        const alert = alertContainer.querySelector('.alert');
        alert.textContent = message;
        alert.className = `alert ${type}`;
        alertContainer.classList.remove('hidden');
        setTimeout(() => {alertContainer.classList.add('hidden');}, 5000);
    }

    // ===== Formulário de login =====
    const loginForm = document.getElementById('loginForm');
    loginForm.addEventListener('submit', (e) => {
        e.preventDefault();
        const formData = new FormData(loginForm);
        fetch('login.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showAlert('Connexion réussie! Redirection...', 'success');
                setTimeout(() => {
                    window.location.href = `dashboard-${formData.get('user_type')}.php`;
                }, 1000);
            } else {
                showAlert(data.message, 'error');
            }
        })
        .catch(error => {
            console.error('Erreur serveur:', error);
            showAlert('Erreur serveur. Veuillez réessayer.', 'error');
        });
    });
    </script>
</body>
</html>