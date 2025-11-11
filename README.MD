# LogeStay

## Description
LogeStay est une application de gestion de réservations d'appartements qui permet aux utilisateurs de rechercher, réserver et gérer leurs logements préférés. L'application offre également des fonctionnalités de contact pour les utilisateurs souhaitant poser des questions ou obtenir de l'aide.

## Fonctionnalités
- **Inscription et Connexion** : Les utilisateurs peuvent créer un compte et se connecter pour accéder à leurs réservations et favoris.
- **Recherche de Logements** : Les utilisateurs peuvent rechercher des logements disponibles en fonction de leurs critères.
- **Gestion des Réservations** : Les utilisateurs peuvent créer, consulter et gérer leurs réservations.
- **Favoris** : Les utilisateurs peuvent ajouter des logements à leurs favoris pour un accès rapide.
- **Contact** : Les utilisateurs peuvent envoyer des messages via un formulaire de contact.

## Structure du Projet
```
MyLogement
├── assets
│   ├── css
│   │   └── style.css
│   └── img
├── database
│   └── location_appartements.sql
├── src
│   ├── controllers
│   │   ├── ContactController.php
│   │   ├── FavorisController.php
│   │   ├── ReservationController.php
│   │   └── ProfilController.php
│   ├── models
│   │   ├── User.php
│   │   ├── Reservation.php
│   │   ├── Favoris.php
│   │   └── Contact.php
│   └── views
│       ├── contact.php
│       ├── favoris.php
│       ├── reservation.php
│       ├── profil.php
│       ├── login.php
│       ├── signup.php
│       └── home.php
├── index.php
├── login.php
├── signup.php
├── signup_process.php
├── home.php
├── contact.php
├── favoris.php
├── reservation.php
├── profil.php
└── README.md
```

## Installation
1. Clone le dépôt ou téléchargez les fichiers du projet.
2. Importez le fichier `location_appartements.sql` dans votre base de données MySQL.
3. Configurez les informations de connexion à la base de données dans les fichiers PHP si nécessaire.
4. Lancez le serveur local (par exemple, XAMPP) et accédez à `http://localhost/MyLogement/index.php` dans votre navigateur.

## Technologies Utilisées
- PHP
- MySQL
- HTML/CSS
- JavaScript (si nécessaire)

## Auteurs
- [Votre Nom] - Développeur principal

## License
Ce projet est sous licence MIT.