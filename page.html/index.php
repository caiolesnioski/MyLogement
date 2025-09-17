<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="assets/css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LogeStay - Gestion de Réservations d'Appartements</title>
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
                <a href="login.php" class="login-btn">Se connecter</a>
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
    </script>
    <script src="script.4js"></script>
</body>
</html>