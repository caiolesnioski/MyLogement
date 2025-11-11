<?php
session_start();
if (!isset($_GET['id'])) {
    header('Location: home.php');
    exit;
}
$apartment_id = intval($_GET['id']);
$pdo = new PDO('mysql:host=localhost;dbname=location_appartements;charset=utf8mb4', 'root', '');

// Récupérer les infos du logement
$stmt = $pdo->prepare("SELECT a.*, p.file_name FROM apartments a
LEFT JOIN apartment_photos ap ON ap.apartment_id = a.id AND ap.is_cover = 1
LEFT JOIN photos p ON p.id = ap.photo_id
WHERE a.id = ?");
$stmt->execute([$apartment_id]);
$ap = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$ap) {
    echo "Annonce introuvable.";
    exit;
}

// Récupérer toutes les photos du logement
$photos_stmt = $pdo->prepare("SELECT p.file_name FROM apartment_photos ap
LEFT JOIN photos p ON p.id = ap.photo_id
WHERE ap.apartment_id = ?");
$photos_stmt->execute([$apartment_id]);
$photos = $photos_stmt->fetchAll(PDO::FETCH_COLUMN);

// Récupérer les équipements
$equip_stmt = $pdo->prepare("SELECT e.name FROM apartment_equipements ae
LEFT JOIN equipements e ON e.id = ae.equipement_id
WHERE ae.apartment_id = ?");
$equip_stmt->execute([$apartment_id]);
$equipements = $equip_stmt->fetchAll(PDO::FETCH_COLUMN);

// Image principale
$main_img = !empty($ap['file_name']) ? 'assets/img/' . htmlspecialchars($ap['file_name']) : 'assets/img/default.jpg';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($ap['title']) ?> | MyLogement</title>
    <link rel="stylesheet" href="assets/css/main.css">
    <style>
        body { background: #14213d; color: #fff; font-family: 'Segoe UI', Arial, sans-serif; margin: 0; }
        .container { max-width: 1100px; margin: 2rem auto; background: rgba(26,31,60,0.95); border-radius: 18px; box-shadow: 0 4px 24px rgba(0,0,0,0.12); padding: 2rem; }
        .annonce-img { width: 100%; max-height: 400px; object-fit: cover; border-radius: 12px; }
        .title { font-size: 2rem; font-weight: bold; margin-bottom: 1rem; }
        .desc { margin: 1.5rem 0; background: #1a1f3c; padding: 1rem; border-radius: 10px; }
        .infos { margin-bottom: 1rem; }
        .price { color: #fca311; font-weight: bold; font-size: 1.2rem; }
        .back-btn { background:#fca311;color:#14213d;border:none;padding:0.7rem 1.5rem;border-radius:8px;font-weight:bold;cursor:pointer;margin-bottom:1rem; }
        .detail-gallery { display: flex; gap: 0.5rem; margin-top: 1rem; }
        .detail-gallery img { width: 80px; height: 80px; object-fit: cover; border-radius: 8px; cursor: pointer; opacity: 0.7; transition: opacity 0.3s; }
        .detail-gallery img:hover { opacity: 1; }
        .detail-gallery img.active { border: 2px solid #fca311; }
        .equipements { margin-top: 1rem; padding: 1rem; background: #1a1f3c; border-radius: 10px; display: flex; flex-wrap: wrap; gap: 0.5rem; }
        .equipement { background: #fca311; color: #14213d; padding: 0.5rem 1rem; border-radius: 5px; font-weight: bold; }
    </style>
</head>
<body>
    <div class="container">
        <button class="back-btn" onclick="window.history.back()">← Retour</button>
        <div class="title"><?= htmlspecialchars($ap['title']) ?></div>
        <img class="annonce-img" src="<?= $main_img ?>" alt="Photo logement">
        <div class="detail-gallery">
            <?php
            if (empty($photos)) {
                echo '<img src="assets/img/default.jpg" alt="Miniature" class="active">';
            } else {
                foreach ($photos as $i => $photo) {
                    $img_src = !empty($photo) ? 'assets/img/' . htmlspecialchars($photo) : 'assets/img/default.jpg';
                    echo '<img src="' . $img_src . '" alt="Miniature" ' . ($i === 0 ? 'class="active"' : '') . '>';
                }
            }
            ?>
        </div>
        <div class="infos">
            <span class="price">€ <?= number_format($ap['base_price'], 2, ',', ' ') ?>/nuit</span> |
            Capacité: <?= htmlspecialchars($ap['capacity']) ?> personnes |
            Localisation: <?= htmlspecialchars($ap['city']) ?>, <?= htmlspecialchars($ap['country']) ?>
        </div>
        <div class="desc"><?= nl2br(htmlspecialchars($ap['description'])) ?></div>
        <div class="equipements">
            <?php
            if (empty($equipements)) {
                echo '<span class="equipement">Aucun équipement</span>';
            } else {
                foreach ($equipements as $eq) {
                    echo '<span class="equipement">' . htmlspecialchars($eq) . '</span>';
                }
            }
            ?>
        </div>
    </div>
    <script src="assets/js/annonce.js"></script>
</body>
</html>