<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// Connexion à la base de données
$pdo = new PDO('mysql:host=localhost;dbname=location_appartements;charset=utf8mb4', 'root', '');

// Récupérer les 6 premiers appartements publiés
$stmt = $pdo->query("SELECT a.*, p.file_name FROM apartments a
LEFT JOIN apartment_photos ap ON ap.apartment_id = a.id AND ap.is_cover = 1
LEFT JOIN photos p ON p.id = ap.photo_id
WHERE a.published = 1
ORDER BY a.created_at DESC
LIMIT 6");
$apartments = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Récupérer le nom et l’email de l’utilisateur
$user_name = $_SESSION['user_name'] ?? '';
$user_email = '';
$user_stmt = $pdo->prepare("SELECT email FROM users WHERE id = ?");
$user_stmt->execute([$_SESSION['user_id']]);
$user_email = $user_stmt->fetchColumn();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>ReserveLog - Accueil</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/main.css">
</head>
<body>
    <header class="header">
        <div class="nav">
            <span class="logo">ReserveLog</span>
            <nav class="menu">
                <a href="home.php">Accueil</a>
                <a href="#">Contact</a>
                <a href="#">Favoris</a>
                <a href="#">Réservations</a>
                <a href="#">Profil</a>
                <a href="logout.php">Déconnexion</a>
            </nav>
            <span class="user"><?= htmlspecialchars($user_email) ?></span>
        </div>
    </header>
    <section class="hero">
        <h1>Plateforme de réservation</h1>
        <p>Explorez des logements de qualité et réservez en toute simplicité.</p>
        <div>
            <button class="annonce-btn">Devenir propriétaire</button>
            <button class="annonce-btn" onclick="location.href='logout.php'">Déconnexion</button>
        </div>
        <div style="margin-top:1rem;">
            <span>Connecté en tant que <?= htmlspecialchars($user_email) ?> (client)</span>
        </div>
    </section>
    <section>
        <h2 style="text-align:center;margin-top:2rem;">Annonces récentes</h2>
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
</body>
</html>