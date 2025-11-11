<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$logement_id = intval($_GET['id'] ?? 0);
if (!$logement_id) {
    header('Location: create_logement.php');
    exit;
}

$pdo = new PDO('mysql:host=localhost;dbname=location_appartements;charset=utf8mb4', 'root', '');

// Verificar se o logement pertence ao usuário
$stmt = $pdo->prepare("SELECT * FROM logements WHERE id = ? AND user_id = ?");
$stmt->execute([$logement_id, $_SESSION['user_id']]);
$logement = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$logement) {
    header('Location: create_logement.php');
    exit;
}

$message = '';

// Processar criação/edição de saison
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    $name = $_POST['name'] ?? '';
    $niveau = $_POST['niveau'] ?? '';
    $type_sejour = $_POST['type_sejour'] ?? '';
    $debut = $_POST['debut'] ?? '';
    $fin = $_POST['fin'] ?? '';
    $tarif = floatval($_POST['tarif'] ?? 0);
    
    if ($_POST['action'] === 'create') {
        $stmt = $pdo->prepare("INSERT INTO logement_saisons (logement_id, name, niveau, type_sejour, debut, fin, tarif, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, NOW())");
        $stmt->execute([$logement_id, $name, $niveau, $type_sejour, $debut, $fin, $tarif]);
        $message = "Saison créée avec succès";
    } elseif ($_POST['action'] === 'update') {
        $saison_id = intval($_POST['saison_id']);
        $stmt = $pdo->prepare("UPDATE logement_saisons SET name=?, niveau=?, type_sejour=?, debut=?, fin=?, tarif=? WHERE id=? AND logement_id=?");
        $stmt->execute([$name, $niveau, $type_sejour, $debut, $fin, $tarif, $saison_id, $logement_id]);
        $message = "Saison modifiée";
    }
}

// Processar exclusão
if (isset($_GET['delete_saison'])) {
    $saison_id = intval($_GET['delete_saison']);
    $stmt = $pdo->prepare("DELETE FROM logement_saisons WHERE id = ? AND logement_id = ?");
    $stmt->execute([$saison_id, $logement_id]);
    $message = "Saison supprimée";
    header('Location: logement_saison.php?id=' . $logement_id);
    exit;
}

// Carregar dados para edição
$edit_saison = null;
if (isset($_GET['edit_saison'])) {
    $saison_id = intval($_GET['edit_saison']);
    $stmt = $pdo->prepare("SELECT * FROM logement_saisons WHERE id = ? AND logement_id = ?");
    $stmt->execute([$saison_id, $logement_id]);
    $edit_saison = $stmt->fetch(PDO::FETCH_ASSOC);
}

// Buscar todas as saisons
$stmt = $pdo->prepare("SELECT * FROM logement_saisons WHERE logement_id = ? ORDER BY debut DESC");
$stmt->execute([$logement_id]);
$saisons = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Buscar email
$user_stmt = $pdo->prepare("SELECT email FROM users WHERE id = ?");
$user_stmt->execute([$_SESSION['user_id']]);
$user_email = $user_stmt->fetchColumn();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Saisons - <?php echo htmlspecialchars($logement['title']); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Segoe UI', Roboto, Arial, sans-serif;
            color: #fff;
            background: linear-gradient(180deg, rgba(3,37,65,0.9) 0%, rgba(10,24,37,0.95) 100%), 
                        url('assets/img/miami.jpg') center/cover no-repeat fixed;
            min-height: 100vh;
        }
        .header {
            background: rgba(4,20,37,0.85);
            padding: 1rem 2rem;
            backdrop-filter: blur(10px);
        }
        .nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1400px;
            margin: 0 auto;
        }
        .logo { font-size: 1.4rem; font-weight: 700; color: #1e90ff; }
        .menu { display: flex; gap: 1.5rem; }
        .menu a { color: #cbd8e6; text-decoration: none; transition: color 0.3s; }
        .menu a:hover { color: #1e90ff; }
        .user { color: #8fa3ba; font-size: 0.9rem; }
        
        .container { max-width: 1100px; margin: 2rem auto; padding: 0 2rem; }
        
        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }
        h1 { font-size: 1.8rem; }
        .btn-back {
            background: #1e90ff;
            color: #fff;
            padding: 0.6rem 1.2rem;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
        }
        
        .card {
            background: rgba(255,255,255,0.06);
            border-radius: 12px;
            padding: 2rem;
            backdrop-filter: blur(8px) saturate(140%);
            box-shadow: 0 10px 30px rgba(2,6,23,0.6);
            border: 1px solid rgba(255,255,255,0.06);
            margin-bottom: 2rem;
        }
        
        .message {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            padding: 1rem 1.5rem;
            border-radius: 10px;
            margin-bottom: 1.5rem;
        }
        
        h2 { margin-bottom: 1.5rem; font-size: 1.5rem; }
        
        .form-row { display: flex; gap: 1rem; margin-bottom: 1rem; }
        .form-row .field { flex: 1; }
        label { display: block; font-size: 0.85rem; margin-bottom: 0.4rem; color: #d7e3f0; }
        input[type=text], input[type=date], input[type=number], select {
            width: 100%;
            padding: 0.7rem 0.9rem;
            border-radius: 8px;
            border: 1px solid rgba(255,255,255,0.1);
            background: rgba(0,0,0,0.25);
            color: #fff;
            outline: none;
        }
        
        .btn-group { display: flex; gap: 1rem; margin-top: 1.5rem; }
        .btn-primary {
            background: #1e90ff;
            color: #fff;
            padding: 0.7rem 1.5rem;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            font-weight: 600;
        }
        .btn-secondary {
            background: transparent;
            border: 1px solid rgba(255,255,255,0.1);
            color: #cbd8e6;
            padding: 0.7rem 1.5rem;
            border-radius: 8px;
            cursor: pointer;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1rem;
        }
        th {
            background: rgba(30,144,255,0.15);
            padding: 0.8rem;
            text-align: left;
            font-weight: 600;
            border-bottom: 2px solid rgba(255,255,255,0.1);
        }
        td {
            padding: 0.8rem;
            border-bottom: 1px solid rgba(255,255,255,0.05);
        }
        tr:hover {
            background: rgba(255,255,255,0.03);
        }
        
        .btn-table {
            padding: 0.4rem 0.8rem;
            border-radius: 6px;
            border: none;
            cursor: pointer;
            font-size: 0.85rem;
            margin-right: 0.5rem;
        }
        .btn-edit-table {
            background: #1e90ff;
            color: #fff;
        }
        .btn-delete-table {
            background: #ef4444;
            color: #fff;
        }
        
        .empty-state {
            text-align: center;
            padding: 2rem;
            color: #8fa3ba;
        }
        
        @media (max-width: 768px) {
            .form-row { flex-direction: column; }
            table { font-size: 0.85rem; }
        }
    </style>
</head>
<body>
    <header class="header">
        <div class="nav">
            <span class="logo">ReserveLog</span>
            <nav class="menu">
                <a href="index.php">Accueil</a>
                <a href="contact.php">Contact</a>
                <a href="favoris.php">Favoris</a>
                <a href="reservation.php">Réservations</a>
                <a href="profil.php">Profil</a>
                <a href="create_logement.php">Logements</a>
                <a href="logout.php">Déconnexion</a>
            </nav>
            <span class="user"><?php echo htmlspecialchars($user_email); ?></span>
        </div>
    </header>

    <div class="container">
        <div class="page-header">
            <h1>Saisons - <?php echo htmlspecialchars($logement['title']); ?></h1>
            <a href="create_logement.php" class="btn-back">← Retour</a>
        </div>

        <?php if ($message): ?>
            <div class="message"><?php echo htmlspecialchars($message); ?></div>
        <?php endif; ?>

        <div class="card">
            <h2><?php echo $edit_saison ? 'Modifier une saison' : 'Créer/Modifier une saison'; ?></h2>
            <form method="POST">
                <input type="hidden" name="action" value="<?php echo $edit_saison ? 'update' : 'create'; ?>">
                <?php if ($edit_saison): ?>
                    <input type="hidden" name="saison_id" value="<?php echo $edit_saison['id']; ?>">
                <?php endif; ?>
                
                <div class="form-row">
                    <div class="field">
                        <label for="name">Nom</label>
                        <input type="text" id="name" name="name" placeholder="Haute saison" 
                               value="<?php echo $edit_saison ? htmlspecialchars($edit_saison['name']) : ''; ?>" required>
                    </div>
                    <div class="field">
                        <label for="niveau">Niveau</label>
                        <select id="niveau" name="niveau" required>
                            <option value="basse" <?php echo ($edit_saison && $edit_saison['niveau'] === 'basse') ? 'selected' : ''; ?>>Basse</option>
                            <option value="moyenne" <?php echo ($edit_saison && $edit_saison['niveau'] === 'moyenne') ? 'selected' : ''; ?>>Moyenne</option>
                            <option value="haute" <?php echo ($edit_saison && $edit_saison['niveau'] === 'haute') ? 'selected' : ''; ?>>Haute</option>
                        </select>
                    </div>
                    <div class="field">
                        <label for="type_sejour">Type de séjour</label>
                        <select id="type_sejour" name="type_sejour" required>
                            <option value="tous" <?php echo ($edit_saison && $edit_saison['type_sejour'] === 'tous') ? 'selected' : ''; ?>>Tous</option>
                            <option value="weekend" <?php echo ($edit_saison && $edit_saison['type_sejour'] === 'weekend') ? 'selected' : ''; ?>>Weekend</option>
                            <option value="semaine" <?php echo ($edit_saison && $edit_saison['type_sejour'] === 'semaine') ? 'selected' : ''; ?>>Semaine</option>
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="field">
                        <label for="debut">Début</label>
                        <input type="date" id="debut" name="debut" 
                               value="<?php echo $edit_saison ? $edit_saison['debut'] : ''; ?>" required>
                    </div>
                    <div class="field">
                        <label for="fin">Fin</label>
                        <input type="date" id="fin" name="fin" 
                               value="<?php echo $edit_saison ? $edit_saison['fin'] : ''; ?>" required>
                    </div>
                    <div class="field">
                        <label for="tarif">Tarif (€)</label>
                        <input type="number" id="tarif" name="tarif" step="0.01" 
                               value="<?php echo $edit_saison ? $edit_saison['tarif'] : ''; ?>" required>
                    </div>
                </div>

                <div class="btn-group">
                    <button type="submit" class="btn-primary">
                        <?php echo $edit_saison ? 'Mettre à jour' : 'Ajouter'; ?>
                    </button>
                    <?php if ($edit_saison): ?>
                        <button type="button" class="btn-secondary" onclick="window.location.href='logement_saisons.php?id=<?php echo $logement_id; ?>'">Annuler</button>
                    <?php endif; ?>
                </div>
            </form>
        </div>

        <div class="card">
            <h2>Liste des saisons</h2>
            
            <?php if (empty($saisons)): ?>
                <div class="empty-state">
                    <p>Aucune saison.</p>
                </div>
            <?php else: ?>
                <table>
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Niveau</th>
                            <th>Type</th>
                            <th>Début</th>
                            <th>Fin</th>
                            <th>Tarif</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($saisons as $saison): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($saison['name']); ?></td>
                                <td><?php echo htmlspecialchars($saison['niveau']); ?></td>
                                <td><?php echo htmlspecialchars($saison['type_sejour']); ?></td>
                                <td><?php echo date('d/m/Y', strtotime($saison['debut'])); ?></td>
                                <td><?php echo date('d/m/Y', strtotime($saison['fin'])); ?></td>
                                <td><?php echo number_format($saison['tarif'], 2); ?> €</td>
                                <td>
                                    <button class="btn-table btn-edit-table" 
                                            onclick="window.location.href='?id=<?php echo $logement_id; ?>&edit_saison=<?php echo $saison['id']; ?>'">
                                        Éditer
                                    </button>
                                    <button class="btn-table btn-delete-table" 
                                            onclick="if(confirm('Supprimer cette saison?')) window.location.href='?id=<?php echo $logement_id; ?>&delete_saison=<?php echo $saison['id']; ?>'">
                                        Supprimer
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>