 
        // Éléments du DOM
        const body = document.body;
        const loginContainer = document.getElementById('loginContainer');
        const loginLeft = document.getElementById('loginLeft');
        const loginRight = document.getElementById('loginRight');
        const logo = document.getElementById('logo');
        const welcomeText = document.getElementById('welcomeText');
        const welcomeSubtitle = document.getElementById('welcomeSubtitle');
        const featuresPreview = document.getElementById('featuresPreview');
        const loginTitle = document.getElementById('loginTitle');
        const loginSubtitle = document.getElementById('loginSubtitle');
        const userTypeSelector = document.getElementById('userTypeSelector');
        const locataireBtn = document.getElementById('locataireBtn');
        const proprietaireBtn = document.getElementById('proprietaireBtn');
        const userTypeInput = document.getElementById('userTypeInput');
        const themeIndicator = document.getElementById('themeIndicator');
        const signupLink = document.getElementById('signupLink');

        // Tous les éléments qui changent avec le thème
        const themeElements = [
            body, loginContainer, loginLeft, loginRight, logo, welcomeText, welcomeSubtitle,
            document.getElementById('feature1'), document.getElementById('feature2'),
            document.getElementById('feature3'), document.getElementById('feature4'),
            document.getElementById('loginTitle'), document.getElementById('loginSubtitle'),
            userTypeSelector, document.getElementById('emailLabel'), document.getElementById('passwordLabel'),
            document.getElementById('email'), document.getElementById('password'),
            document.getElementById('emailIcon'), document.getElementById('togglePassword'),
            document.getElementById('rememberLabel'), document.getElementById('forgotLink'),
            document.getElementById('submitBtn'), document.getElementById('divider'),
            document.getElementById('dividerText'), document.getElementById('signupLinkContainer'),
            signupLink
        ];

        // État du thème
        let isDarkMode = false;

        // Gestion des boutons de type d'utilisateur
        function switchUserType(type) {
            const isProprietaire = type === 'proprietaire';
            
            // Mise à jour des boutons
            locataireBtn.classList.toggle('active', !isProprietaire);
            proprietaireBtn.classList.toggle('active', isProprietaire);
            
            // Mise à jour de l'input hidden
            userTypeInput.value = type;
            
            // Mise à jour du lien d'inscription
            signupLink.href = isProprietaire ? 'signup-proprietaire.php' : 'signup-locataire.php';
            
            // Animation de transition
            if (isProprietaire && !isDarkMode) {
                activateDarkMode();
            } else if (!isProprietaire && isDarkMode) {
                deactivateDarkMode();
            }
        }

        // Activation du mode sombre
        function activateDarkMode() {
            isDarkMode = true;
            
            // Ajouter les classes theme-transition pour une animation fluide
            themeElements.forEach(el => {
                if (el) el.classList.add('theme-transition');
            });
            
            // Ajouter les classes dark-mode après un petit délai
            setTimeout(() => {
                themeElements.forEach(el => {
                    if (el) el.classList.add('dark-mode');
                });
                
                // Afficher l'indicateur de thème
                themeIndicator.classList.add('show');
                setTimeout(() => {
                    themeIndicator.classList.remove('show');
                }, 2000);
                
                // Mise à jour du contenu pour le mode propriétaire
                updateContentForProprietaire();
            }, 50);
        }

        // Désactivation du mode sombre
        function deactivateDarkMode() {
            isDarkMode = false;
            
            themeElements.forEach(el => {
                if (el) {
                    el.classList.add('theme-transition');
                    el.classList.remove('dark-mode');
                }
            });
            
            // Mise à jour du contenu pour le mode locataire
            updateContentForLocataire();
        }

        // Mise à jour du contenu pour propriétaire
        function updateContentForProprietaire() {
            welcomeText.textContent = 'Espace Propriétaire';
            welcomeSubtitle.textContent = 'Connectez-vous à votre tableau de bord propriétaire et gérez vos biens immobiliers efficacement.';
            
            // Mise à jour des fonctionnalités
            document.getElementById('featureText1').textContent = 'Gestion multi-propriétés';
            document.getElementById('featureText2').textContent = 'Optimisation des revenus';
            document.getElementById('featureText3').textContent = 'Analyses avancées';
            document.getElementById('featureText4').textContent = 'Protection maximale';
            
            // Mise à jour des icônes
            document.getElementById('feature1').querySelector('.icon').textContent = '🏢';
            document.getElementById('feature2').querySelector('.icon').textContent = '📈';
            document.getElementById('feature3').querySelector('.icon').textContent = '📊';
            document.getElementById('feature4').querySelector('.icon').textContent = '🛡️';
        }

        // Mise à jour du contenu pour locataire
        function updateContentForLocataire() {
            welcomeText.textContent = 'Bienvenue !';
            welcomeSubtitle.textContent = 'Connectez-vous pour accéder à votre espace personnel et gérer vos réservations en toute simplicité.';
            
            // Remise des fonctionnalités originales
            document.getElementById('featureText1').textContent = 'Gestion complète des réservations';
            document.getElementById('featureText2').textContent = 'Tarification flexible et automatisée';
            document.getElementById('featureText3').textContent = 'Tableau de bord intuitif';
            document.getElementById('featureText4').textContent = 'Sécurité maximale des données';
            
            // Remise des icônes originales
            document.getElementById('feature1').querySelector('.icon').textContent = '📅';
            document.getElementById('feature2').querySelector('.icon').textContent = '💰';
            document.getElementById('feature3').querySelector('.icon').textContent = '📊';
            document.getElementById('feature4').querySelector('.icon').textContent = '🔒';
        }

        // Event listeners pour les boutons
        locataireBtn.addEventListener('click', () => switchUserType('locataire'));
        proprietaireBtn.addEventListener('click', () => switchUserType('proprietaire'));

        // Gestion de l'affichage/masquage du mot de passe
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');

        togglePassword.addEventListener('click', function() {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            this.textContent = type === 'password' ? '👁️' : '🙈';
        });

        // Validation du formulaire
        const form = document.getElementById('loginForm');
        const submitBtn = document.getElementById('submitBtn');
        const alertContainer = document.getElementById('alertContainer');

        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Clear previous alerts
            alertContainer.innerHTML = '';
            
            const formData = new FormData(form);
            const email = formData.get('email');
            const password = formData.get('password');
            
            // Validations simples
            let errors = [];
            
            if (!email || !email.includes('@')) {
                errors.push('Veuillez entrer une adresse e-mail valide.');
            }
            
            if (password.length < 6) {
                errors.push('Le mot de passe doit contenir au moins 6 caractères.');
            }
            
            if (errors.length > 0) {
                showAlert(errors.join(' '), 'error');
                return;
            }
            
            // Simulation de connexion
            submitBtn.disabled = true;
            submitBtn.textContent = 'Connexion...';
            
            setTimeout(() => {
                const userType = userTypeInput.value;
                showAlert(`Connexion réussie ! Redirection vers le tableau de bord ${userType}...`, 'success');
                
                setTimeout(() => {
                    window.location.href = `/dashboard-${userType}.php`;
                }, 1500);
            }, 2000);
        });

        function showAlert(message, type) {
            const alertDiv = document.createElement('div');
            alertDiv.className = `alert ${type}${isDarkMode ? ' dark-mode' : ''}`;
            alertDiv.textContent = message;
            alertContainer.appendChild(alertDiv);
            
            // Animation d'apparition
            alertDiv.style.opacity = '0';
            alertDiv.style.transform = 'translateY(-10px)';
            
            setTimeout(() => {
                alertDiv.style.opacity = '1';
                alertDiv.style.transform = 'translateY(0)';
            }, 100);
        }

        // Animation d'entrée au chargement
        window.addEventListener('load', function() {
            setTimeout(() => {
                document.body.style.opacity = '1';
            }, 100);
        });

        // Nettoyage des classes de transition après les animations
        setTimeout(() => {
            themeElements.forEach(el => {
                if (el) el.classList.remove('theme-transition');
            });
        }, 1000);