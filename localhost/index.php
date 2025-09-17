<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LogeStay - Gestion de Réservations d'Appartements</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
        }

        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 1rem 0;
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .nav-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 1.8rem;
            font-weight: bold;
            color: white;
            text-decoration: none;
        }

        .nav-links {
            display: flex;
            gap: 2rem;
            list-style: none;
        }

        .nav-links a {
            color: white;
            text-decoration: none;
            transition: opacity 0.3s;
        }

        .nav-links a:hover {
            opacity: 0.8;
        }

        .hero {
            background: linear-gradient(rgba(102, 126, 234, 0.8), rgba(118, 75, 162, 0.8)),
                        url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 600"><rect fill="%23f0f2f5" width="1200" height="600"/><circle fill="%23e0e6ed" cx="200" cy="150" r="80"/><circle fill="%23d0d8e0" cx="800" cy="200" r="60"/><circle fill="%23c0cdd6" cx="400" cy="350" r="100"/><circle fill="%23b0c2cc" cx="1000" cy="400" r="70"/></svg>');
            background-size: cover;
            background-position: center;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: white;
            padding-top: 80px;
        }

        .hero-content {
            max-width: 800px;
            margin: 0 auto;
            padding: 0 1rem;
        }

        .hero h1 {
            font-size: 3.5rem;
            margin-bottom: 1rem;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        }

        .hero p {
            font-size: 1.3rem;
            margin-bottom: 2rem;
            opacity: 0.9;
        }

        .search-container {
            background: white;
            border-radius: 15px;
            padding: 2rem;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
            margin-top: 2rem;
        }

        .search-form {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr auto;
            gap: 1rem;
            align-items: end;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .form-group label {
            color: #333;
            font-weight: 600;
            margin-bottom: 0.5rem;
            font-size: 0.9rem;
        }

        .form-group input, .form-group select {
            padding: 0.8rem;
            border: 2px solid #e0e6ed;
            border-radius: 8px;
            font-size: 1rem;
            transition: border-color 0.3s;
        }

        .form-group input:focus, .form-group select:focus {
            outline: none;
            border-color: #667eea;
        }

        .search-btn {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            padding: 0.8rem 2rem;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: transform 0.3s;
        }

        .search-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3);
        }

        .features {
            padding: 5rem 0;
            background: #f8fafc;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1rem;
        }

        .section-title {
            text-align: center;
            font-size: 2.5rem;
            margin-bottom: 3rem;
            color: #333;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin-top: 2rem;
        }

        .feature-card {
            background: white;
            padding: 2rem;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            text-align: center;
            transition: transform 0.3s;
        }

        .feature-card:hover {
            transform: translateY(-5px);
        }

        .feature-icon {
            width: 60px;
            height: 60px;
            margin: 0 auto 1rem;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: white;
        }

        .feature-card h3 {
            font-size: 1.5rem;
            margin-bottom: 1rem;
            color: #333;
        }

        .feature-card p {
            color: #666;
            line-height: 1.6;
        }

        .property-types {
            padding: 5rem 0;
            background: white;
        }

        .types-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-top: 2rem;
        }

        .type-card {
            position: relative;
            border-radius: 15px;
            overflow: hidden;
            height: 200px;
            background: linear-gradient(45deg, #667eea, #764ba2);
            cursor: pointer;
            transition: transform 0.3s;
        }

        .type-card:hover {
            transform: scale(1.05);
        }

        .type-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(45deg, rgba(102, 126, 234, 0.8), rgba(118, 75, 162, 0.8));
        }

        .type-content {
            position: relative;
            z-index: 2;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            color: white;
            text-align: center;
        }

        .type-icon {
            font-size: 2rem;
            margin-bottom: 0.5rem;
        }

        .type-title {
            font-size: 1.3rem;
            font-weight: 600;
        }

        .footer {
            background: #2d3748;
            color: white;
            padding: 3rem 0 1rem;
            text-align: center;
        }

        .footer-content {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            margin-bottom: 2rem;
        }

        .footer-section h4 {
            margin-bottom: 1rem;
            color: #667eea;
        }

        .footer-section ul {
            list-style: none;
        }

        .footer-section ul li {
            margin-bottom: 0.5rem;
        }

        .footer-section ul li a {
            color: #cbd5e0;
            text-decoration: none;
            transition: color 0.3s;
        }

        .footer-section ul li a:hover {
            color: #667eea;
        }

        .login-buttons {
            display: flex;
            gap: 1rem;
        }

        .login-btn {
            padding: 0.5rem 1rem;
            border: 2px solid white;
            background: transparent;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: all 0.3s;
        }

        .login-btn:hover {
            background: white;
            color: #667eea;
        }

        .login-btn.primary {
            background: white;
            color: #667eea;
        }

        .login-btn.primary:hover {
            background: transparent;
            color: white;
        }

        @media (max-width: 768px) {
            .search-form {
                grid-template-columns: 1fr;
            }
            
            .hero h1 {
                font-size: 2.5rem;
            }
            
            .nav-links {
                display: none;
            }
        }
    </style>
</head>
<body>
    <header class="header">
        <div class="nav-container">
            <a href="#" class="logo">🏠 LogeStay</a>
            <nav>
                <ul class="nav-links">
                    <li><a href="#proprietaires">Propriétaires</a></li>
                    <li><a href="#locataires">Locataires</a></li>
                    <li><a href="#apropos">À propos</a></li>
                    <li><a href="#contact">Contact</a></li>
                </ul>
            </nav>
            <div class="login-buttons">
                <a href="#" class="login-btn">Se connecter</a>
                <a href="#" class="login-btn primary">S'inscrire</a>
            </div>
        </div>
    </header>

    <section class="hero">
        <div class="hero-content">
            <h1>Trouvez l'Appartement Parfait</h1>
            <p>Gestion intelligente des réservations pour locations courtes, moyennes et longues durées</p>
            
            <div class="search-container">
                <form class="search-form" id="searchForm">
                    <div class="form-group">
                        <label for="checkin">Arrivée</label>
                        <input type="date" id="checkin" name="checkin" required>
                    </div>
                    <div class="form-group">
                        <label for="checkout">Départ</label>
                        <input type="date" id="checkout" name="checkout" required>
                    </div>
                    <div class="form-group">
                        <label for="guests">Occupants</label>
                        <select id="guests" name="guests">
                            <option value="1">1 personne</option>
                            <option value="2">2 personnes</option>
                            <option value="3">3 personnes</option>
                            <option value="4">4 personnes</option>
                            <option value="5">5+ personnes</option>
                        </select>
                    </div>
                    <button type="submit" class="search-btn">🔍 Rechercher</button>
                </form>
            </div>
        </div>
    </section>

    <section class="features">
        <div class="container">
            <h2 class="section-title">Pourquoi choisir LogeStay ?</h2>
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">📅</div>
                    <h3>Gestion de Calendrier</h3>
                    <p>Interface intuitive pour gérer les disponibilités, réservations et tarifications saisonnières de façon simple et efficace.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">💰</div>
                    <h3>Tarification Flexible</h3>
                    <p>Configurez des tarifs personnalisés pour différents types de séjour : touristique, cure, longue durée avec prix saisonniers.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">🏠</div>
                    <h3>Double Interface</h3>
                    <p>Panneaux dédiés pour propriétaires et locataires, chacun avec les fonctionnalités spécifiques nécessaires.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">📱</div>
                    <h3>Entièrement Responsif</h3>
                    <p>Accédez et gérez vos propriétés depuis n'importe quel appareil, à tout moment et en tout lieu.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">🔒</div>
                    <h3>Sécurisé et Fiable</h3>
                    <p>Données protégées, transactions sécurisées et documentation complète pour toutes les réservations effectuées.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">⚡</div>
                    <h3>Gestion Automatisée</h3>
                    <p>Automatisez les processus de réservation, calcul des prix et gestion des documents pour économiser du temps.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="property-types">
        <div class="container">
            <h2 class="section-title">Types de Séjour</h2>
            <div class="types-grid">
                <div class="type-card" onclick="filterByType('touristique')">
                    <div class="type-content">
                        <div class="type-icon">🏖️</div>
                        <div class="type-title">Séjour Touristique</div>
                        <p>Jusqu'à 5 jours - Tarification journalière</p>
                    </div>
                </div>
                <div class="type-card" onclick="filterByType('cure')">
                    <div class="type-content">
                        <div class="type-icon">🏥</div>
                        <div class="type-title">Séjour de Cure</div>
                        <p>21 jours - Tarif spécial</p>
                    </div>
                </div>
                <div class="type-card" onclick="filterByType('longue')">
                    <div class="type-content">
                        <div class="type-icon">🏡</div>
                        <div class="type-title">Séjour Long</div>
                        <p>Plus de 5 jours - Tarification hebdomadaire/mensuelle</p>
                    </div>
                </div>
                <div class="type-card" onclick="filterByType('saisonnier')">
                    <div class="type-content">
                        <div class="type-icon">🌅</div>
                        <div class="type-title">Tarification Saisonnière</div>
                        <p>Prix adaptatifs selon la période</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-section">
                    <h4>Propriétaires</h4>
                    <ul>
                        <li><a href="#">Enregistrer une Propriété</a></li>
                        <li><a href="#">Panneau de Gestion</a></li>
                        <li><a href="#">Configurer les Tarifs</a></li>
                        <li><a href="#">Rapports</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h4>Locataires</h4>
                    <ul>
                        <li><a href="#">Rechercher des Appartements</a></li>
                        <li><a href="#">Mes Réservations</a></li>
                        <li><a href="#">Documents</a></li>
                        <li><a href="#">Support</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h4>Support</h4>
                    <ul>
                        <li><a href="#">Centre d'Aide</a></li>
                        <li><a href="#">Comment ça Marche</a></li>
                        <li><a href="#">Politiques</a></li>
                        <li><a href="#">Contact</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h4>LogeStay</h4>
                    <ul>
                        <li><a href="#">À Propos</a></li>
                        <li><a href="#">Carrières</a></li>
                        <li><a href="#">Presse</a></li>
                        <li><a href="#">Investisseurs</a></li>
                    </ul>
                </div>
            </div>
            <div style="border-top: 1px solid #4a5568; padding-top: 2rem; margin-top: 2rem;">
                <p>&copy; 2024 LogeStay. Tous droits réservés. | Système de Gestion de Réservations d'Appartements</p>
            </div>
        </div>
    </footer>

    <script>
        // Définir dates minimales pour les champs de date
        const today = new Date().toISOString().split('T')[0];
        document.getElementById('checkin').min = today;
        
        document.getElementById('checkin').addEventListener('change', function() {
            const checkinDate = new Date(this.value);
            const minCheckout = new Date(checkinDate.getTime() + 24 * 60 * 60 * 1000);
            document.getElementById('checkout').min = minCheckout.toISOString().split('T')[0];
        });

        // Fonction pour filtrer par type de séjour
        function filterByType(type) {
            const checkin = document.getElementById('checkin');
            const checkout = document.getElementById('checkout');
            
            // Suggestions de dates basées sur le type
            if (type === 'touristique') {
                // 1-5 jours
                const start = new Date();
                const end = new Date();
                end.setDate(start.getDate() + 3);
                
                checkin.value = start.toISOString().split('T')[0];
                checkout.value = end.toISOString().split('T')[0];
                
                alert('Séjour Touristique sélectionné ! Durée suggérée : 3 jours avec tarification journalière.');
            } else if (type === 'cure') {
                // 21 jours
                const start = new Date();
                const end = new Date();
                end.setDate(start.getDate() + 21);
                
                checkin.value = start.toISOString().split('T')[0];
                checkout.value = end.toISOString().split('T')[0];
                
                alert('Séjour de Cure sélectionné ! Durée : 21 jours avec tarif spécial.');
            } else if (type === 'longue') {
                // Plus de 5 jours
                const start = new Date();
                const end = new Date();
                end.setDate(start.getDate() + 14);
                
                checkin.value = start.toISOString().split('T')[0];
                checkout.value = end.toISOString().split('T')[0];
                
                alert('Séjour Long sélectionné ! Durée suggérée : 2 semaines avec tarification hebdomadaire.');
            } else if (type === 'saisonnier') {
                alert('Tarification Saisonnière : Les prix varient selon la période de l\'année (haute, moyenne, basse saison).');
            }
        }

        // Fonction pour traiter la recherche
        document.getElementById('searchForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const checkin = document.getElementById('checkin').value;
            const checkout = document.getElementById('checkout').value;
            const guests = document.getElementById('guests').value;
            
            if (!checkin || !checkout) {
                alert('Veuillez sélectionner les dates d\'arrivée et de départ.');
                return;
            }
            
            // Calculer la durée du séjour
            const start = new Date(checkin);
            const end = new Date(checkout);
            const duration = Math.ceil((end - start) / (1000 * 60 * 60 * 24));
            
            let stayType = '';
            if (duration <= 5) {
                stayType = 'Touristique (tarification journalière)';
            } else if (duration === 21) {
                stayType = 'Cure (tarif spécial)';
            } else if (duration > 5) {
                stayType = 'Longue durée (tarification hebdomadaire/mensuelle)';
            }
            
            alert(`Recherche effectuée !\n\nArrivée : ${checkin}\nDépart : ${checkout}\nDurée : ${duration} jours\nOccupants : ${guests}\nType de séjour : ${stayType}\n\nRedirection vers la page de résultats...`);
            
            // Ici vous redirigeriez vers la page des résultats
            // window.location.href = `/search?checkin=${checkin}&checkout=${checkout}&guests=${guests}`;
        });

        // Animations fluides au scroll
        window.addEventListener('scroll', function() {
            const header = document.querySelector('.header');
            if (window.scrollY > 100) {
                header.style.background = 'rgba(102, 126, 234, 0.95)';
                header.style.backdropFilter = 'blur(10px)';
            } else {
                header.style.background = 'linear-gradient(135deg, #667eea 0%, #764ba2 100%)';
                header.style.backdropFilter = 'none';
            }
        });
    </script>
</body>
</html>