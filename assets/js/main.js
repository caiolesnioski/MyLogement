
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