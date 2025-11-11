<?php
// index.php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Connexion à la base de données
$pdo = new PDO('mysql:host=localhost;dbname=location_appartements;charset=utf8mb4', 'root', '');

// Récupérer les 6 premiers appartements publiés (remplacer par des exemples fixes)
$apartments = [
    [
        'id' => 1,
        'title' => 'Villa de luxe à Rio de Janeiro',
        'city' => 'Rio de Janeiro',
        'country' => 'Brésil',
        'base_price' => 950.00,
        'file_name' => 'rio.jpg', // imagem enviada
    ],
    [
        'id' => 2,
        'title' => 'Maison moderne à São Paulo',
        'city' => 'São Paulo',
        'country' => 'Brésil',
        'base_price' => 780.00,
        'file_name' => 'saopaulo.jpg', // imagem enviada
    ],
    [
        'id' => 3,
        'title' => 'Luxury Villa in Miami',
        'city' => 'Miami',
        'country' => 'États-Unis',
        'base_price' => 1200.00,
        'file_name' => 'miami.jpg', // imagem enviada
    ],
    [
        'id' => 4,
        'title' => 'Beach House in California',
        'city' => 'Los Angeles',
        'country' => 'États-Unis',
        'base_price' => 1100.00,
        'file_name' => 'hollywood.jpg', // imagem enviada
    ],
    [
        'id' => 5,
        'title' => 'Villa traditionnelle à Kyoto',
        'city' => 'Kyoto',
        'country' => 'Japon',
        'base_price' => 990.00,
        'file_name' => 'kyoto.jpg', // imagem enviada
    ],
    [
        'id' => 6,
        'title' => 'Appartement moderne à Tokyo',
        'city' => 'Tokyo',
        'country' => 'Japon',
        'base_price' => 850.00,
        'file_name' => 'tokyo.jpg', // imagem enviada
    ],
];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>MyLogement - Gestion de Réservations d'Appartements</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="LS.png">
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        body {
            background: #14213d;
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
        /* Section annonces */
        .annonces-section {
            max-width: 1200px;
            margin: 3rem auto 0 auto;
        }
        .annonces-section h2 {
            color: #fff;
            font-size: 1.5rem;
            margin-bottom: 2rem;
            margin-left: 1rem;
        }
        .annonces {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 2rem;
        }
        .annonce {
            background: rgba(26, 31, 60, 0.95);
            border-radius: 18px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.18);
            overflow: hidden;
            display: flex;
            flex-direction: column;
            transition: transform 0.15s;
        }
        .annonce:hover {
            transform: translateY(-6px) scale(1.03);
        }
        .annonce img {
            width: 100%;
            height: 180px;
            object-fit: cover;
            border-top-left-radius: 18px;
            border-top-right-radius: 18px;
        }
        .annonce-content {
            padding: 1.2rem 1rem 1rem 1rem;
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .annonce-title {
            font-size: 1.15rem;
            font-weight: bold;
            color: #fff;
            margin-bottom: 0.5rem;
        }
        .annonce-city {
            color: #e5e5e5;
            font-size: 1rem;
            margin-bottom: 0.5rem;
        }
        .annonce-price {
            color: #fca311;
            font-size: 1.1rem;
            font-weight: bold;
            margin-bottom: 0.7rem;
        }
        .annonce-btn {
            background: #fca311;
            color: #14213d;
            border: none;
            border-radius: 8px;
            padding: 0.7rem 1.2rem;
            font-weight: bold;
            cursor: pointer;
            font-size: 1rem;
            margin-top: 0.5rem;
            transition: background 0.2s;
        }
        .annonce-btn:hover {
            background: #2974fa;
            color: #fff;
        }
        @media (max-width: 900px) {
            .annonces {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <header class="header">
        <div class="nav-container">
            <a href="#" class="logo">🏠 MyLogement</a>
            <nav>
                <ul>
                    <li><a href="index.php">Accueil</a></li>
                    <li><a href="contact.php">Contact</a></li>
                    <li><a href="login.php">Connexion</a></li>
                    <li><a href="signup.php">Inscription</a></li>
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

    <!-- Section annonces récentes -->
    <section class="annonces-section">
        <h2>— Annonces récentes</h2>
        <div class="annonces">
            <?php foreach ($apartments as $ap): ?>
                <div class="annonce">
                    <img src="<?= !empty($ap['file_name']) ? 'assets/img/' . htmlspecialchars($ap['file_name']) : 'assets/img/default.jpg' ?>" alt="Photo logement">
                    <div class="annonce-content">
                        <div class="annonce-title"><?= htmlspecialchars($ap['title']) ?></div>
                        <div class="annonce-city"><?= htmlspecialchars($ap['city']) ?> <?= htmlspecialchars($ap['country']) ?></div>
                        <div class="annonce-price">€ <?= number_format($ap['base_price'], 2, ',', ' ') ?>/nuit</div>
                        <button class="annonce-btn" onclick="window.location.href='annonce.php?id=<?= $ap['id'] ?>'">Voir</button>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

    <footer style="background:rgba(20,33,61,0.98);margin-top:3rem;padding:2.5rem 0 1.5rem 0;">
        <div style="display:flex;justify-content:center;gap:6rem;flex-wrap:wrap;max-width:900px;margin:0 auto;">
            <div>
                <h3 style="color:#fca311;margin-bottom:0.7rem;">ReserveLog</h3>
                <p style="color:#e5e5e5;">Réservez sereinement des logements.</p>
            </div>
            <div>
                <h3 style="color:#fca311;margin-bottom:0.7rem;">Navigation</h3>
                <ul style="list-style:none;padding:0;">
                    <li><a href="index.php" style="color:#e5e5e5;text-decoration:none;">Accueil</a></li>
                    <li><a href="contact.php" style="color:#e5e5e5;text-decoration:none;">Contact</a></li>
                </ul>
            </div>
            <div>
                <h3 style="color:#fca311;margin-bottom:0.7rem;">Compte</h3>
                <ul style="list-style:none;padding:0;">
                    <li><a href="login.php" style="color:#e5e5e5;text-decoration:none;">Connexion</a></li>
                    <li><a href="signup.php" style="color:#e5e5e5;text-decoration:none;">Inscription</a></li>
                </ul>
            </div>
        </div>
        <div style="text-align:center;color:#e5e5e5;margin-top:2rem;font-size:0.95rem;">
            © 2025 ReserveLog — Tous droits réservés
        </div>
    </footer>
</body>
</html>