<?php
// index.php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>LogeStay - Gestion de Réservations d'Appartements</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="LS.png">
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        body {
            background: #14213d; /* Bleu marine */
            color: #fff;
            font-family: 'Segoe UI', Arial, sans-serif;
            margin: 0;
        }
        .header {
            background: #1a1f3c;
            padding: 1rem 0;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }
        .nav-container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            max-width: 1100px;
            margin: 0 auto;
            padding: 0 2rem;
        }
        .logo {
            font-size: 1.6rem;
            font-weight: bold;
            color: #fca311;
            text-decoration: none;
        }
        nav ul {
            display: flex;
            gap: 2rem;
            list-style: none;
            margin: 0;
            padding: 0;
        }
        nav a {
            color: #e5e5e5;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.2s;
        }
        nav a:hover {
            color: #fca311;
        }
        .login-buttons a {
            margin-left: 1rem;
            padding: 0.5rem 1.2rem;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 600;
            background: #fca311;
            color: #14213d;
            transition: background 0.2s;
        }
        .login-buttons a.primary {
            background: #fff;
            color: #14213d;
        }
        .hero {
            background: linear-gradient(120deg, #14213d 80%, #1a1f3c 100%);
            padding: 3rem 0 2rem 0;
            text-align: center;
        }
        .hero-content h1 {
            font-size: 2.5rem;
            margin-bottom: 1rem;
            color: #fff;
        }
        .hero-content p {
            font-size: 1.2rem;
            color: #e5e5e5;
            margin-bottom: 2rem;
        }
        .search-container {
            display: flex;
            justify-content: center;
        }
        .search-form {
            background: #1a1f3c;
            padding: 2rem;
            border-radius: 16px;
            box-shadow: 0 4px 24px rgba(0,0,0,0.12);
            display: flex;
            gap: 1.5rem;
            align-items: flex-end;
        }
        .form-group {
            display: flex;
            flex-direction: column;
        }
        .form-group label {
            color: #fca311;
            margin-bottom: 0.5rem;
            font-weight: 500;
        }
        .form-group input,
        .form-group select {
            padding: 0.6rem;
            border-radius: 6px;
            border: none;
            background: #e5e5e5;
            color: #14213d;
            font-size: 1rem;
        }
        .search-btn {
            background: #fca311;
            color: #14213d;
            border: none;
            border-radius: 6px;
            padding: 0.8rem 1.5rem;
            font-weight: bold;
            cursor: pointer;
            font-size: 1rem;
        }
        .search-btn:hover {
            background: #fff;
            color: #14213d;
        }
        /* Ajoute le reste du style selon tes besoins */
    </style>
</head>
<body>
    <header class="header">
        <div class="nav-container">
            <a href="#" class="logo">🏠 LogeStay</a>
            <nav>
                <ul>
                    <li><a href="proprietaires.php">Propriétaires</a></li>
                    <li><a href="locataires.php">Locataires</a></li>
                    <li><a href="apropos.php">À propos</a></li>
                    <li><a href="contact.php">Contact</a></li>
                </ul>
            </nav>
            <div class="login-buttons">
                <a href="login.php">Se connecter</a>
                <a href="signup.php" class="primary">S'inscrire</a>
            </div>
        </div>
    </header>
    <section class="hero">
        <div class="hero-content">
            <h1>Plateforme de réservation</h1>
            <p>Explorez des logements de qualité et réservez en toute simplicité.</p>
            <div class="search-container">
                <form class="search-form" method="POST" action="recherche.php">
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
    <!-- Ajoute ici tes autres sections/features si besoin -->
</body>
</html>