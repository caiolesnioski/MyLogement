<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// Conexão com banco
$pdo = new PDO('mysql:host=localhost;dbname=location_appartements;charset=utf8mb4', 'root', '');

// Buscar email do usuário
$user_stmt = $pdo->prepare("SELECT email FROM users WHERE id = ?");
$user_stmt->execute([$_SESSION['user_id']]);
$user_email = $user_stmt->fetchColumn();

// Variáveis para mensagem de sucesso
$success_message = '';
$logement_id_edit = null;

// Processar criação/edição de logement
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    if ($_POST['action'] === 'create' || $_POST['action'] === 'update') {
        $title = $_POST['title'] ?? '';
        $city = $_POST['city'] ?? '';
        $country = $_POST['country'] ?? 'France';
        $capacity = intval($_POST['capacity'] ?? 1);
        $price = floatval($_POST['price'] ?? 0);
        $description = $_POST['description'] ?? '';
        $equipements = $_POST['equipements'] ?? '';
        
        if ($_POST['action'] === 'create') {
            // Criar novo logement
            $stmt = $pdo->prepare("INSERT INTO logements (user_id, title, city, country, capacity, price, description, equipements, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW())");
            $stmt->execute([$_SESSION['user_id'], $title, $city, $country, $capacity, $price, $description, $equipements]);
            $success_message = "Logement créé (#rf" . $pdo->lastInsertId() . ")";
        } else {
            // Atualizar logement existente
            $logement_id = intval($_POST['logement_id']);
            $stmt = $pdo->prepare("UPDATE logements SET title=?, city=?, country=?, capacity=?, price=?, description=?, equipements=? WHERE id=? AND user_id=?");
            $stmt->execute([$title, $city, $country, $capacity, $price, $description, $equipements, $logement_id, $_SESSION['user_id']]);
            $success_message = "Logement modifié (#rf" . $logement_id . ")";
        }
    }
}

// Processar exclusão
if (isset($_GET['delete'])) {
    $delete_id = intval($_GET['delete']);
    $stmt = $pdo->prepare("DELETE FROM logements WHERE id = ? AND user_id = ?");
    $stmt->execute([$delete_id, $_SESSION['user_id']]);
    $success_message = "Logement supprimé avec succès";
    header('Location: create_logement.php');
    exit;
}

// Carregar dados para edição
$edit_data = null;
if (isset($_GET['edit'])) {
    $logement_id_edit = intval($_GET['edit']);
    $stmt = $pdo->prepare("SELECT * FROM logements WHERE id = ? AND user_id = ?");
    $stmt->execute([$logement_id_edit, $_SESSION['user_id']]);
    $edit_data = $stmt->fetch(PDO::FETCH_ASSOC);
}

// Buscar todos os logements do usuário
$stmt = $pdo->prepare("SELECT l.*, (SELECT image_path FROM logement_images WHERE logement_id = l.id ORDER BY uploaded_at ASC LIMIT 1) as cover_image FROM logements l WHERE user_id = ? ORDER BY created_at DESC");
$stmt->execute([$_SESSION['user_id']]);
$logements = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Buscar reservations
$stmt_reserv = $pdo->prepare("SELECT r.*, l.title as logement_title FROM reservations r INNER JOIN logements l ON r.apartment_id = l.id WHERE l.user_id = ? ORDER BY r.created_at DESC");
$stmt_reserv->execute([$_SESSION['user_id']]);
$reservations = $stmt_reserv->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>MyLogement - Créer un logement</title>
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
        
        .container-center { max-width: 1200px; margin: 2rem auto; padding: 0 2rem; }
        
        .success-banner {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            padding: 1rem 1.5rem;
            border-radius: 10px;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.8rem;
            box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3);
        }
        .success-banner::before { content: "✓"; font-size: 1.5rem; font-weight: bold; }
        
        .card {
            background: rgba(255,255,255,0.06);
            border-radius: 12px;
            padding: 2rem;
            backdrop-filter: blur(8px) saturate(140%);
            box-shadow: 0 10px 30px rgba(2,6,23,0.6);
            border: 1px solid rgba(255,255,255,0.06);
            margin-bottom: 2rem;
        }
        h2 { margin-bottom: 1.5rem; font-size: 1.8rem; }
        
        .form-row { display: flex; gap: 1rem; margin-bottom: 1rem; }
        .form-row .field { flex: 1; }
        label { display: block; font-size: 0.85rem; margin-bottom: 0.4rem; color: #d7e3f0; }
        input[type=text], input[type=number], select, textarea {
            width: 100%;
            padding: 0.7rem 0.9rem;
            border-radius: 8px;
            border: 1px solid rgba(255,255,255,0.1);
            background: rgba(0,0,0,0.25);
            color: #fff;
            outline: none;
            transition: border 0.3s;
        }
        input:focus, select:focus, textarea:focus { border-color: #1e90ff; }
        textarea { min-height: 110px; resize: vertical; }
        
        details { margin: 1rem 0; color: #cbd8e6; }
        summary { cursor: pointer; padding: 0.5rem; }
        
        .btn-group { display: flex; gap: 1rem; margin-top: 1.5rem; }
        .btn-primary {
            background: #1e90ff;
            color: #fff;
            padding: 0.7rem 1.5rem;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            font-weight: 600;
            transition: background 0.3s;
        }
        .btn-primary:hover { background: #1c7ed6; }
        .btn-secondary {
            background: transparent;
            border: 1px solid rgba(255,255,255,0.1);
            color: #cbd8e6;
            padding: 0.7rem 1.5rem;
            border-radius: 8px;
            cursor: pointer;
        }
        
        .section-title {
            font-size: 1.8rem;
            margin: 3rem 0 1.5rem;
            font-weight: 700;
        }
        
        .logements-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(450px, 1fr));
            gap: 1.5rem;
            margin-top: 1rem;
        }
        .logement-card {
            background: rgba(255,255,255,0.05);
            border-radius: 12px;
            padding: 1.5rem;
            border: 1px solid rgba(255,255,255,0.08);
        }
        .logement-image {
            width: 100%;
            height: 200px;
            background: rgba(100,120,150,0.2);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #8fa3ba;
            margin-bottom: 1rem;
        }
        .logement-title { font-size: 1.4rem; font-weight: 600; margin-bottom: 0.5rem; }
        .logement-location { color: #8fa3ba; margin-bottom: 0.8rem; }
        .logement-capacity {
            display: inline-block;
            background: rgba(100,120,150,0.3);
            padding: 0.3rem 0.8rem;
            border-radius: 20px;
            font-size: 0.85rem;
            margin-bottom: 1rem;
        }
        .logement-price {
            background: rgba(16,185,129,0.15);
            padding: 0.8rem;
            border-radius: 8px;
            margin: 1rem 0;
            font-size: 1.3rem;
            color: #10b981;
            font-weight: 700;
        }
        .logement-actions {
            display: flex;
            gap: 0.8rem;
            margin-top: 1rem;
        }
        .btn-edit, .btn-images, .btn-saisons {
            flex: 1;
            padding: 0.6rem;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s;
        }
        .btn-edit {
            background: #1e90ff;
            color: #fff;
        }
        .btn-edit:hover { background: #1c7ed6; }
        .btn-images {
            background: rgba(100,120,150,0.3);
            color: #fff;
        }
        .btn-images:hover { background: rgba(100,120,150,0.5); }
        .btn-saisons {
            background: transparent;
            border: 1px solid #1e90ff;
            color: #1e90ff;
        }
        .btn-saisons:hover { background: rgba(30,144,255,0.1); }
        .btn-delete {
            background: #ef4444;
            color: #fff;
            padding: 0.6rem 1rem;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            font-weight: 600;
        }
        .btn-delete:hover { background: #dc2626; }
        
        .empty-state {
            text-align: center;
            padding: 3rem;
            color: #8fa3ba;
        }
        
        @media (max-width: 768px) {
            .form-row { flex-direction: column; }
            .logements-grid { grid-template-columns: 1fr; }
            .menu { flex-wrap: wrap; gap: 0.8rem; }
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
                <a href="create_logement.php" style="color: #1e90ff;">Logements</a>
                <a href="logout.php">Déconnexion</a>
            </nav>
            <span class="user"><?php echo htmlspecialchars($user_email); ?></span>
        </div>
    </header>

    <div class="container-center">
        <?php if ($success_message): ?>
            <div class="success-banner"><?php echo htmlspecialchars($success_message); ?></div>
        <?php endif; ?>

        <div class="card">
            <h2><?php echo $edit_data ? 'Modifier le logement' : 'Créer un logement'; ?></h2>
            <form method="POST" action="">
                <input type="hidden" name="action" value="<?php echo $edit_data ? 'update' : 'create'; ?>">
                <?php if ($edit_data): ?>
                    <input type="hidden" name="logement_id" value="<?php echo $edit_data['id']; ?>">
                <?php endif; ?>
                
                <div class="form-row">
                    <div class="field">
                        <label for="title">Nom du logement</label>
                        <input type="text" id="title" name="title" placeholder="Nom du logement" 
                               value="<?php echo $edit_data ? htmlspecialchars($edit_data['title']) : ''; ?>" required>
                    </div>
                    <div class="field">
                        <label for="city">Ville</label>
                        <input type="text" id="city" name="city" placeholder="Ville" 
                               value="<?php echo $edit_data ? htmlspecialchars($edit_data['city']) : ''; ?>" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="field">
                        <label for="country">Pays</label>
                        <select id="country" name="country" required>
                            <option value="France" <?php echo ($edit_data && $edit_data['country'] === 'France') ? 'selected' : ''; ?>>France</option>
                            <option value="Portugal" <?php echo ($edit_data && $edit_data['country'] === 'Portugal') ? 'selected' : ''; ?>>Portugal</option>
                            <option value="Espagne" <?php echo ($edit_data && $edit_data['country'] === 'Espagne') ? 'selected' : ''; ?>>Espagne</option>
                        </select>
                    </div>
                    <div class="field">
                        <label for="capacity">Voyageurs max</label>
                        <input type="number" id="capacity" name="capacity" min="1" 
                               value="<?php echo $edit_data ? $edit_data['capacity'] : '1'; ?>" required>
                    </div>
                    <div class="field">
                        <label for="price">Prix par nuit (€)</label>
                        <input type="number" id="price" name="price" step="0.01" placeholder="Prix par nuit" 
                               value="<?php echo $edit_data ? $edit_data['price'] : ''; ?>" required>
                    </div>
                </div>

                <div style="margin-bottom: 1rem;">
                    <label for="description">Description</label>
                    <textarea id="description" name="description" placeholder="Décrivez votre logement..." required><?php echo $edit_data ? htmlspecialchars($edit_data['description']) : ''; ?></textarea>
                </div>

                <details>
                    <summary>Options avancées</summary>
                    <div style="margin-top: 1rem;">
                        <label>Équipements (ex: Wifi, Cuisine)</label>
                        <input type="text" name="equipements" placeholder="Séparez par des virgules" 
                               value="<?php echo $edit_data ? htmlspecialchars($edit_data['equipements']) : ''; ?>">
                    </div>
                </details>

                <div class="btn-group">
                    <button type="submit" class="btn-primary">
                        <?php echo $edit_data ? 'Mettre à jour' : 'Créer le logement'; ?>
                    </button>
                    <?php if ($edit_data): ?>
                        <button type="button" class="btn-secondary" onclick="window.location.href='create_logement.php'">Annuler</button>
                    <?php endif; ?>
                </div>
            </form>
        </div>

        <div class="section-title">Vos appartements</div>
        
        <?php if (empty($logements)): ?>
            <div class="card empty-state">
                <p><strong>Aucun logement</strong></p>
                <p>Vous n'avez pas encore créé de logement. Utilisez le formulaire ci-dessus pour ajouter votre premier logement.</p>
            </div>
        <?php else: ?>
            <div class="logements-grid">
                <?php foreach ($logements as $logement): ?>
                    <div class="logement-card">
                        <div class="logement-image">
                            <?php if (!empty($logement['cover_image'])): ?>
                                <img src="<?php echo htmlspecialchars($logement['cover_image']); ?>" alt="Image logement" style="width:100%;height:100%;object-fit:cover;border-radius:8px;" />
                            <?php else: ?>
                                Pas d'image
                            <?php endif; ?>
                        </div>
                        <div class="logement-title"><?php echo htmlspecialchars($logement['title']); ?></div>
                        <div class="logement-location"><?php echo htmlspecialchars($logement['city']); ?></div>
                        <div class="logement-capacity">👥 <?php echo $logement['capacity']; ?> voyageurs</div>
                        <div class="logement-price"><?php echo number_format($logement['price'], 0); ?> € <span style="font-size:0.7em">/nuit</span></div>
                        
                        <div class="logement-actions">
                            <button class="btn-edit" onclick="window.location.href='?edit=<?php echo $logement['id']; ?>'">Éditer</button>
                            <button class="btn-images" onclick="window.location.href='logement_img.php?id=<?php echo $logement['id']; ?>'">Images</button>
                            <button class="btn-saisons" onclick="window.location.href='logement_saison.php?id=<?php echo $logement['id']; ?>'">Saisons</button>
                        </div>
                        <button class="btn-delete" style="width:100%; margin-top:0.8rem;" 
                                onclick="if(confirm('Êtes-vous sûr de vouloir supprimer ce logement?')) window.location.href='?delete=<?php echo $logement['id']; ?>'">
                            > Supprimer
                        </button>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <div class="section-title">Réservations</div>
        <div class="card">
            <?php if (empty($reservations)): ?>
                <p>Aucune réservation pour le moment.</p>
            <?php else: ?>
                <?php foreach ($reservations as $res): ?>
                    
                    <div style="padding: 1rem; border-bottom: 1px solid rgba(255,255,255,0.1);">
                        <strong><?php echo htmlspecialchars($res['logement_title']); ?></strong> - 
                        <?php echo htmlspecialchars($res['customer_name']); ?> 
                        (<?php echo $res['start_date']; ?> → <?php echo $res['end_date']; ?>)
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>