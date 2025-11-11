<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// Connexion à la base de données
$pdo = new PDO('mysql:host=localhost;dbname=location_appartements;charset=utf8mb4', 'root', '');

// Récupérer tous les appartements publiés
$stmt = $pdo->query("SELECT a.*, p.file_name FROM apartments a
LEFT JOIN apartment_photos ap ON ap.apartment_id = a.id AND ap.is_cover = 1
LEFT JOIN photos p ON p.id = ap.photo_id
WHERE a.published = 1
ORDER BY a.created_at DESC");
$apartments = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Récupérer le nom et l’email de l’utilisateur
$user_name = $_SESSION['user_name'] ?? '';
$user_email = '';
$user_stmt = $pdo->prepare("SELECT email FROM users WHERE id = ?");
$user_stmt->execute([$_SESSION['user_id']]);
$user_email = $user_stmt->fetchColumn();

// Array de imagens customizadas (ordem corresponde aos anúncios)
$custom_images = [
    'miami.jpg',
    'tokyo.jpg',
    'kyoto.jpg',
    'rio.jpg',
    'saopaulo.jpg',
    'hollywood.jpg'
];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>MyLogement - Accueil</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/main.css">
</head>
<body>
    <header class="header">
        <div class="nav">
            <span class="logo">MyLogement</span>
            <nav class="menu">
                <a href="index.php">Accueil</a>
                <a href="contact.php">Contact</a>
                <a href="favoris.php">Favoris</a>
                <a href="reservation.php">Réservations</a>
                <a href="profil.php">Profil</a>
                <a href="logout.php">Déconnexion</a>
            </nav>
            <span class="user"><?= htmlspecialchars($user_email) ?></span>
        </div>
    </header>
    <section class="hero">
        <h1>Plateforme de réservation</h1>
        <p>Explorez des logements de qualité et réservez en toute simplicité.</p>
        <div>
            <?php
            // Verifica se o usuário já tem anúncios
            $stmt_log = $pdo->prepare("SELECT COUNT(*) FROM logements WHERE user_id = ?");
            $stmt_log->execute([$_SESSION['user_id']]);
            $has_logements = $stmt_log->fetchColumn() > 0;
            ?>
            <?php if ($has_logements): ?>
                <button class="annonce-btn" onclick="location.href='create_logement.php'">Mes logements</button>
            <?php else: ?>
                <button class="annonce-btn" onclick="location.href='create_logement.php'">Devenir propriétaire</button>
            <?php endif; ?>
            <button class="annonce-btn" onclick="location.href='logout.php'">Déconnexion</button>
        </div>
        <div style="margin-top:1rem;">
            <span>Connecté en tant que <?= htmlspecialchars($user_email) ?> (client)</span>
        </div>
    </section>
    <section class="annonces-section" style="max-width:1200px;margin:3rem auto 0 auto;">
        <h2 style="color:#fff;font-size:1.5rem;margin-bottom:2rem;margin-left:1rem;">— Annonces récentes</h2>
        <div class="annonces" style="display:grid;grid-template-columns:repeat(auto-fit,minmax(320px,1fr));gap:2rem;">
            <?php foreach ($apartments as $ap): ?>
                <div class="annonce" style="background:rgba(26,31,60,0.95);border-radius:18px;box-shadow:0 8px 32px rgba(0,0,0,0.18);overflow:hidden;display:flex;flex-direction:column;transition:transform 0.15s;">
                    <img src="<?= !empty($ap['file_name']) ? 'assets/img/' . htmlspecialchars($ap['file_name']) : 'assets/img/default.jpg' ?>" alt="Photo logement" style="width:100%;height:180px;object-fit:cover;border-top-left-radius:18px;border-top-right-radius:18px;">
                    <div class="annonce-content" style="padding:1.2rem 1rem 1rem 1rem;flex:1;display:flex;flex-direction:column;justify-content:space-between;">
                        <div class="annonce-title" style="font-size:1.15rem;font-weight:bold;color:#fff;margin-bottom:0.5rem;"><?= htmlspecialchars($ap['title']) ?></div>
                        <div class="annonce-city" style="color:#e5e5e5;font-size:1rem;margin-bottom:0.5rem;"><?= htmlspecialchars($ap['city']) ?> <?= htmlspecialchars($ap['country']) ?></div>
                        <div class="annonce-price" style="color:#fca311;font-size:1.1rem;font-weight:bold;margin-bottom:0.7rem;">€ <?= number_format($ap['base_price'], 2, ',', ' ') ?>/nuit</div>
                        <button class="annonce-btn" style="background:#fca311;color:#14213d;border:none;border-radius:8px;padding:0.7rem 1.2rem;font-weight:bold;cursor:pointer;font-size:1rem;margin-top:0.5rem;transition:background 0.2s;" onclick="window.location.href='annonce.php?id=<?= $ap['id'] ?>'">Voir</button>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
</body>
</html>