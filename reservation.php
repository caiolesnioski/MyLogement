<?php
// reservation.php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// Connexion à la base de données
$pdo = new PDO('mysql:host=localhost;dbname=location_appartements;charset=utf8mb4', 'root', '');

// Récupération des réservations de l'utilisateur
$stmt = $pdo->prepare('SELECT * FROM reservations WHERE user_id = ?');
$stmt->execute([$_SESSION['user_id']]);
$reservations = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mes Réservations | LogeStay</title>
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
        .container {
            max-width: 1100px;
            margin: 2rem auto;
            padding: 1rem;
            background: rgba(26, 31, 60, 0.95);
            border-radius: 16px;
            box-shadow: 0 4px 24px rgba(0,0,0,0.12);
        }
        h2 {
            text-align: center;
            color: #fca311;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1rem;
        }
        th, td {
            padding: 1rem;
            text-align: left;
            border-bottom: 1px solid #e5e5e5;
        }
        th {
            background: #1a1f3c;
        }
        tr:hover {
            background: #fca311;
            color: #14213d;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Mes Réservations</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Logement</th>
                    <th>Date d'Arrivée</th>
                    <th>Date de Départ</th>
                    <th>Statut</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($reservations) > 0): ?>
                    <?php foreach ($reservations as $reservation): ?>
                        <tr>
                            <td><?= htmlspecialchars($reservation['id']) ?></td>
                            <td><?= htmlspecialchars($reservation['apartment_title']) ?></td>
                            <td><?= htmlspecialchars($reservation['checkin_date']) ?></td>
                            <td><?= htmlspecialchars($reservation['checkout_date']) ?></td>
                            <td><?= htmlspecialchars($reservation['status']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" style="text-align: center;">Aucune réservation trouvée.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>