<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LogeStay - Créer un Compte Locataire</title>
    <link href="LS.png" rel="icon">
    <link href="LS.png" rel="apple-touch-icon">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .back-home {
            position: fixed;
            top: 20px;
            left: 20px;
            background: rgba(255, 255, 255, 0.1);
            color: white;
            text-decoration: none;
            padding: 12px 20px;
            border-radius: 25px;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: all 0.3s ease;
            font-weight: 500;
            z-index: 1000;
        }

        .back-home:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateY(-2px);
        }

        .signup-container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            max-width: 1200px;
            width: 100%;
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            min-height: 700px;
        }

        .signup-left {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 60px 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .logo {
            font-size: 2rem;
            font-weight: bold;
            margin-bottom: 30px;
            text-align: center;
        }

        .welcome-text {
            font-size: 2.5rem;
            font-weight: bold;
            margin-bottom: 20px;
            text-align: center;
        }

        .welcome-subtitle {
            font-size: 1.1rem;
            opacity: 0.9;
            line-height: 1.6;
            text-align: center;
            margin-bottom: 40px;
        }

        .features-preview {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .feature-item {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 15px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            backdrop-filter: blur(10px);
        }

        .feature-item .icon {
            font-size: 1.5rem;
        }

        .signup-right {
            padding: 60px 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .signup-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .signup-header h2 {
            font-size: 2rem;
            color: #2d3748;
            margin-bottom: 10px;
        }

        .signup-header p {
            color: #718096;
            font-size: 1.1rem;
        }

        .user-type-badge {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 15px 30px;
            border-radius: 50px;
            text-align: center;
            margin-bottom: 30px;
            font-weight: 600;
            font-size: 1.1rem;
        }

        .signup-form {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .form-group {
            position: relative;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #4a5568;
            font-weight: 500;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 15px 20px;
            border: 2px solid #e2e8f0;
            border-radius: 10px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: #f7fafc;
        }

        .form-group input:focus,
        .form-group select:focus {
            outline: none;
            border-color: #667eea;
            background: white;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .password-strength {
            margin-top: 8px;
            font-size: 0.9rem;
        }

        .strength-indicator {
            height: 4px;
            background: #e2e8f0;
            border-radius: 2px;
            margin: 5px 0;
            overflow: hidden;
        }

        .strength-fill {
            height: 100%;
            transition: all 0.3s ease;
            width: 0%;
        }

        .strength-weak { background: #e53e3e; width: 33%; }
        .strength-medium { background: #dd6b20; width: 66%; }
        .strength-strong { background: #38a169; width: 100%; }

        .terms-checkbox {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            margin: 20px 0;
        }

        .terms-checkbox input[type="checkbox"] {
            margin-top: 4px;
            transform: scale(1.2);
        }

        .terms-checkbox label {
            color: #4a5568;
            line-height: 1.5;
            font-size: 0.95rem;
        }

        .terms-checkbox a {
            color: #667eea;
            text-decoration: none;
        }

        .terms-checkbox a:hover {
            text-decoration: underline;
        }

        .signup-btn {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            padding: 18px 30px;
            border-radius: 10px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 10px;
        }

        .signup-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.3);
        }

        .signup-btn:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
        }

        .divider {
            text-align: center;
            position: relative;
            margin: 30px 0 20px;
        }

        .divider:before {
            content: '';
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 1px;
            background: #e2e8f0;
        }

        .divider span {
            background: white;
            color: #718096;
            padding: 0 20px;
            font-size: 0.9rem;
        }

        .login-link {
            text-align: center;
            color: #718096;
        }

        .login-link a {
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
        }

        .login-link a:hover {
            text-decoration: underline;
        }

        .alert {
            padding: 15px 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            font-weight: 500;
        }

        .alert.error {
            background: #fed7d7;
            color: #c53030;
            border: 1px solid #feb2b2;
        }

        .alert.success {
            background: #c6f6d5;
            color: #2f855a;
            border: 1px solid #9ae6b4;
        }

        @media (max-width: 768px) {
            .signup-container {
                grid-template-columns: 1fr;
                margin: 10px;
            }

            .signup-left {
                padding: 40px 20px;
            }

            .signup-right {
                padding: 40px 20px;
            }

            .form-row {
                grid-template-columns: 1fr;
            }

            .welcome-text {
                font-size: 2rem;
            }

            .back-home {
                position: relative;
                top: 0;
                left: 0;
                margin-bottom: 20px;
                display: inline-block;
            }
        }
    </style>
</head>
<body>
    <a href="index.html" class="back-home">← Retour à l'accueil</a>
    
    <div class="signup-container">
        <div class="signup-left">
            <div class="logo">🏠 LogeStay</div>
            <h1 class="welcome-text">Rejoignez-nous !</h1>
            <p class="welcome-subtitle">Créez votre compte locataire et découvrez des appartements parfaits pour vos séjours.</p>
            
            <div class="features-preview">
                <div class="feature-item">
                    <span class="icon">🔍</span>
                    <span>Recherche avancée d'appartements</span>
                </div>
                <div class="feature-item">
                    <span class="icon">📅</span>
                    <span>Réservations simplifiées</span>
                </div>
                <div class="feature-item">
                    <span class="icon">💬</span>
                    <span>Communication directe avec les propriétaires</span>
                </div>
                <div class="feature-item">
                    <span class="icon">📱</span>
                    <span>Gestion mobile de vos séjours</span>
                </div>
            </div>
        </div>
        
        <div class="signup-right">
            <div class="signup-header">
                <h2>Créer un Compte</h2>
                <p>Rejoignez LogeStay en tant que locataire</p>
            </div>

            <div class="user-type-badge">
                👤 Compte Locataire
            </div>

            <div id="alertContainer"></div>
            
            <form class="signup-form" id="signupForm">
                <div class="form-row">
                    <div class="form-group">
                        <label for="prenom">Prénom *</label>
                        <input type="text" id="prenom" name="prenom" required>
                    </div>
                    <div class="form-group">
                        <label for="nom">Nom *</label>
                        <input type="text" id="nom" name="nom" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="email">Adresse e-mail *</label>
                    <input type="email" id="email" name="email" required>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="telephone">Téléphone *</label>
                        <input type="tel" id="telephone" name="telephone" required>
                    </div>
                    <div class="form-group">
                        <label for="dateNaissance">Date de naissance *</label>
                        <input type="date" id="dateNaissance" name="dateNaissance" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="adresse">Adresse *</label>
                    <input type="text" id="adresse" name="adresse" required>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="ville">Ville *</label>
                        <input type="text" id="ville" name="ville" required>
                    </div>
                    <div class="form-group">
                        <label for="codePostal">Code postal *</label>
                        <input type="text" id="codePostal" name="codePostal" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="password">Mot de passe *</label>
                    <input type="password" id="password" name="password" required>
                    <div class="password-strength" id="passwordStrength" style="display: none;">
                        <div class="strength-indicator">
                            <div class="strength-fill" id="strengthFill"></div>
                        </div>
                        <span id="strengthText"></span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="confirmPassword">Confirmer le mot de passe *</label>
                    <input type="password" id="confirmPassword" name="confirmPassword" required>
                </div>

                <div class="terms-checkbox">
                    <input type="checkbox" id="terms" name="terms" required>
                    <label for="terms">
                        J'accepte les <a href="#" target="_blank">conditions d'utilisation</a> et 
                        la <a href="#" target="_blank">politique de confidentialité</a> de LogeStay
                    </label>
                </div>

                <div class="terms-checkbox">
                    <input type="checkbox" id="newsletter" name="newsletter">
                    <label for="newsletter">
                        Je souhaite recevoir les offres spéciales et actualités de LogeStay
                    </label>
                </div>

                <button type="submit" class="signup-btn" id="submitBtn">
                    Créer mon compte
                </button>
            </form>

            <div class="divider">
                <span>ou</span>
            </div>

            <div class="login-link">
                Déjà un compte ? 
                <a href="login.php">Se connecter</a>
            </div>
        </div>
    </div>

    <script>
        // Gestion de la force du mot de passe
        const passwordInput = document.getElementById('password');
        const strengthIndicator = document.getElementById('passwordStrength');
        const strengthFill = document.getElementById('strengthFill');
        const strengthText = document.getElementById('strengthText');

        passwordInput.addEventListener('input', function() {
            const password = this.value;
            const strength = calculatePasswordStrength(password);
            
            if (password.length > 0) {
                strengthIndicator.style.display = 'block';
                
                strengthFill.className = 'strength-fill';
                switch(strength.level) {
                    case 1:
                        strengthFill.classList.add('strength-weak');
                        strengthText.textContent = 'Faible';
                        break;
                    case 2:
                        strengthFill.classList.add('strength-medium');
                        strengthText.textContent = 'Moyen';
                        break;
                    case 3:
                        strengthFill.classList.add('strength-strong');
                        strengthText.textContent = 'Fort';
                        break;
                }
            } else {
                strengthIndicator.style.display = 'none';
            }
        });

        function calculatePasswordStrength(password) {
            let strength = 0;
            
            if (password.length >= 8) strength++;
            if (/[a-z]/.test(password)) strength++;
            if (/[A-Z]/.test(password)) strength++;
            if (/[0-9]/.test(password)) strength++;
            if (/[^A-Za-z0-9]/.test(password)) strength++;
            
            return {
                level: Math.min(Math.floor(strength / 2) + 1, 3),
                score: strength
            };
        }

        // Validation du formulaire
        const form = document.getElementById('signupForm');
        const submitBtn = document.getElementById('submitBtn');
        const alertContainer = document.getElementById('alertContainer');

        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Clear previous alerts
            alertContainer.innerHTML = '';
            
            const formData = new FormData(form);
            const password = formData.get('password');
            const confirmPassword = formData.get('confirmPassword');
            
            // Validations
            let errors = [];
            
            if (password !== confirmPassword) {
                errors.push('Les mots de passe ne correspondent pas.');
            }
            
            if (password.length < 8) {
                errors.push('Le mot de passe doit contenir au moins 8 caractères.');
            }
            
            if (!formData.get('terms')) {
                errors.push('Vous devez accepter les conditions d\'utilisation.');
            }
            
            // Validation email simple
            const email = formData.get('email');
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email)) {
                errors.push('Veuillez entrer une adresse e-mail valide.');
            }
            
            if (errors.length > 0) {
                showAlert(errors.join(' '), 'error');
                return;
            }
            
            // Simulation d'envoi
            submitBtn.disabled = true;
            submitBtn.textContent = 'Création en cours...';
            
            setTimeout(() => {
                showAlert('Compte créé avec succès ! Redirection...', 'success');
                setTimeout(() => {
                    window.location.href = 'login.php';
                }, 2000);
            }, 2000);
        });

        function showAlert(message, type) {
            const alertDiv = document.createElement('div');
            alertDiv.className = `alert ${type}`;
            alertDiv.textContent = message;
            alertContainer.appendChild(alertDiv);
            
            // Scroll to alert
            alertDiv.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }

        // Validation en temps réel
        const requiredFields = form.querySelectorAll('input[required]');
        requiredFields.forEach(field => {
            field.addEventListener('blur', validateField);
            field.addEventListener('input', clearFieldError);
        });

        function validateField(e) {
            const field = e.target;
            const value = field.value.trim();
            
            if (!value) {
                field.style.borderColor = '#e53e3e';
            } else {
                field.style.borderColor = '#38a169';
            }
        }

        function clearFieldError(e) {
            const field = e.target;
            if (field.style.borderColor === 'rgb(229, 62, 62)') {
                field.style.borderColor = '#e2e8f0';
            }
        }
    </script>
</body>
</html>