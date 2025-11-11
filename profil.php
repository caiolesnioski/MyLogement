<?php
// profil.php
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// Connexion à la base de données
$pdo = new PDO('mysql:host=localhost;dbname=location_appartements;charset=utf8mb4', 'root', '');

// Récupérer les informations de l'utilisateur
$stmt = $pdo->prepare('SELECT * FROM users WHERE id = ?');
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    // Si l'utilisateur n'existe pas, déconnexion
    session_destroy();
    header('Location: login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mon profil | MyLogement</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="LS.png">
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        /* Page profil : style inspiré de l'image fournie */
        body {
            margin: 0;
            font-family: 'Segoe UI', Arial, sans-serif;
            color: #fff;
            background: linear-gradient(180deg, rgba(3,37,65,0.85), rgba(10,24,37,0.95)), url('assets/img/bg-leaves.png') center/cover no-repeat fixed;
        }
        .header-space { height: 80px; }
        .center-wrap { max-width: 640px; margin: 2.5rem auto; padding: 0 1rem; }
        .card {
            background: rgba(255,255,255,0.05);
            border-radius: 12px;
            padding: 1.6rem 1.8rem;
            box-shadow: 0 12px 40px rgba(2,6,23,0.6);
            border: 1px solid rgba(255,255,255,0.06);
            backdrop-filter: blur(8px) saturate(140%);
        }
        .title { text-align:center; font-size:1.6rem; font-weight:700; margin:0 0 1rem; }
        .verify-bar { display:flex; gap:0.6rem; align-items:center; justify-content:center; background:rgba(255,255,255,0.03); padding:0.6rem; border-radius:8px; margin-bottom:1rem; }
        .verify-status { background:#fca311; color:#14213d; padding:0.35rem 0.6rem; border-radius:6px; font-weight:700; }
        .verify-action { background:transparent; color:#cfe8ff; border:1px solid rgba(255,255,255,0.06); padding:0.35rem 0.6rem; border-radius:6px; cursor:pointer; }
        form .row { display:flex; gap:0.8rem; }
        form .col { flex:1; }
        label { display:block; font-size:0.85rem; color:#d7e3f0; margin-bottom:0.35rem; }
        input[type=text], input[type=email], input[type=date], textarea {
            width:100%; padding:0.7rem; border-radius:8px; border:1px solid rgba(255,255,255,0.06);
            background: rgba(0,0,0,0.25); color:#fff; outline:none; box-sizing:border-box;
        }
        textarea { min-height:90px; resize:vertical }
        .submit-row { text-align:center; margin-top:1rem; }
        .btn-primary { background:#2974fa; color:#fff; padding:0.6rem 1rem; border-radius:8px; border:none; cursor:pointer; font-weight:700; }
        .btn-secondary { background:transparent; color:#cfe8ff; border:1px solid rgba(255,255,255,0.06); padding:0.5rem 0.8rem; border-radius:8px; cursor:pointer; }
        @media (max-width:720px) { .row { flex-direction:column; } .center-wrap { margin:1.5rem auto; } }
    </style>
</head>
<body>
    <div class="header-space"></div>
    <div class="center-wrap">
        <div class="card">
            <div class="title">Mon profil</div>

            <div class="verify-bar">
                <div style="font-size:0.95rem;color:#cfe8ff;">Statut de vérification :</div>
                <div class="verify-status">NON VÉRIFIÉ</div>
                <button class="verify-action" onclick="alert('Processus de vérification à implémenter')">VÉRIFIER L'IDENTITÉ</button>
            </div>

            <form method="POST" action="profil_update.php">
                <div style="margin-bottom:1rem;">
                    <label for="fullname">Nom complet</label>
                    <input type="text" id="fullname" name="fullname" value="<?= htmlspecialchars($user['name']) ?>" required>
                </div>

                <div class="row" style="margin-bottom:1rem;">
                    <div class="col">
                        <label for="phone">Téléphone</label>
                        <input type="text" id="phone" name="phone" value="<?= htmlspecialchars($user['phone']) ?>">
                    </div>
                    <div class="col">
                        <label for="birthdate">Date de naissance</label>
                        <input type="date" id="birthdate" name="birthdate" value="<?= htmlspecialchars($user['birthdate'] ?? '') ?>">
                    </div>
                </div>

                <div style="margin-bottom:1rem;">
                    <label for="address">Adresse (ligne 1)</label>
                    <input type="text" id="address" name="address" value="<?= htmlspecialchars($user['address_line1'] ?? '') ?>">
                </div>

                <div style="margin-bottom:1rem;">
                    <label for="address2">Adresse (ligne 2) <small style="color:#9fb7d9">(optionnel)</small></label>
                    <input type="text" id="address2" name="address2" value="<?= htmlspecialchars($user['address_line2'] ?? '') ?>">
                </div>

                <div class="row" style="margin-bottom:1rem;">
                    <div class="col">
                        <label for="zipcode">Code postal</label>
                        <input type="text" id="zipcode" name="zipcode" value="<?= htmlspecialchars($user['postal_code'] ?? '') ?>">
                    </div>
                    <div class="col">
                        <label for="city">Ville</label>
                        <input type="text" id="city" name="city" value="<?= htmlspecialchars($user['city'] ?? '') ?>">
                    </div>
                </div>

                <div style="margin-bottom:0.6rem;">
                    <label for="country">Pays</label>
                    <input type="text" id="country" name="country" value="<?= htmlspecialchars($user['country'] ?? '') ?>">
                </div>

                <div class="submit-row">
                    <button type="submit" class="btn-primary">Enregistrer les modifications</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>