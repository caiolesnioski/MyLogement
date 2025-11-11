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

// Processar upload de imagem
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['image'])) {
    $upload_dir = 'uploads/logements/';
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0755, true);
    }
    
    $file = $_FILES['image'];
    $allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
    $filename = $file['name'];
    $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
    
    if (in_array($ext, $allowed) && $file['error'] === 0) {
        $new_filename = uniqid() . '_' . time() . '.' . $ext;
        $destination = $upload_dir . $new_filename;
        
        if (move_uploaded_file($file['tmp_name'], $destination)) {
            $stmt = $pdo->prepare("INSERT INTO logement_images (logement_id, image_path, uploaded_at) VALUES (?, ?, NOW())");
            $stmt->execute([$logement_id, $destination]);
            $message = "Image ajoutée avec succès";
        } else {
            $message = "Erreur lors de l'upload";
        }
    } else {
        $message = "Format d'image non autorisé";
    }
}

// Processar exclusão de imagem
if (isset($_GET['delete_img'])) {
    $img_id = intval($_GET['delete_img']);
    $stmt = $pdo->prepare("SELECT * FROM logement_images WHERE id = ? AND logement_id = ?");
    $stmt->execute([$img_id, $logement_id]);
    $img = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($img) {
        if (file_exists($img['image_path'])) {
            unlink($img['image_path']);
        }
        $stmt = $pdo->prepare("DELETE FROM logement_images WHERE id = ?");
        $stmt->execute([$img_id]);
        $message = "Image supprimée";
    }
    header('Location: logement_img.php?id=' . $logement_id);
    exit;
}

// Buscar imagens do logement
$stmt = $pdo->prepare("SELECT * FROM logement_images WHERE logement_id = ? ORDER BY uploaded_at DESC");
$stmt->execute([$logement_id]);
$images = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Buscar email
$user_stmt = $pdo->prepare("SELECT email FROM users WHERE id = ?");
$user_stmt->execute([$_SESSION['user_id']]);
$user_email = $user_stmt->fetchColumn();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Photos - <?php echo htmlspecialchars($logement['title']); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Segoe UI', Roboto, Arial, sans-serif;
            background: #f8f9fa;
            color: #1a202c;
        }
        .header {
            background: #fff;
            padding: 1rem 2rem;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
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
        .menu a { color: #4a5568; text-decoration: none; transition: color 0.3s; }
        .menu a:hover { color: #1e90ff; }
        .user { color: #718096; font-size: 0.9rem; }
        
        .container { max-width: 1000px; margin: 2rem auto; padding: 0 2rem; }
        
        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }
        h1 { font-size: 1.8rem; color: #1a202c; }
        .btn-back {
            background: #1e90ff;
            color: #fff;
            padding: 0.6rem 1.2rem;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
        }
        
        .upload-section {
            background: #fff;
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            margin-bottom: 2rem;
        }
        .upload-section h2 {
            margin-bottom: 1.5rem;
            font-size: 1.3rem;
        }
        .upload-form { display: flex; gap: 1rem; align-items: flex-end; }
        input[type="file"] {
            flex: 1;
            padding: 0.7rem;
            border: 2px dashed #cbd5e0;
            border-radius: 8px;
            background: #f7fafc;
        }
        .btn-upload {
            background: #1e90ff;
            color: #fff;
            padding: 0.7rem 1.5rem;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
        }
        
        .message {
            background: #d4edda;
            color: #155724;
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1rem;
        }
        
        .images-section {
            background: #fff;
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }
        .images-section h2 {
            margin-bottom: 1.5rem;
            font-size: 1.3rem;
        }
        
        .images-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 1.5rem;
        }
        .image-card {
            position: relative;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        .image-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
        .image-card .actions {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: rgba(0,0,0,0.7);
            padding: 0.5rem;
            display: flex;
            justify-content: center;
        }
        .btn-delete-img {
            background: #ef4444;
            color: #fff;
            border: none;
            padding: 0.4rem 1rem;
            border-radius: 6px;
            cursor: pointer;
            font-size: 0.85rem;
        }
        
        .empty-state {
            text-align: center;
            padding: 3rem;
            color: #718096;
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
            <h1>Photos - <?php echo htmlspecialchars($logement['title']); ?></h1>
            <a href="create_logement.php" class="btn-back">← Retour</a>
        </div>

        <?php if ($message): ?>
            <div class="message"><?php echo htmlspecialchars($message); ?></div>
        <?php endif; ?>

        <div class="upload-section">
            <h2>Ajouter des photos</h2>
            <form method="POST" enctype="multipart/form-data" class="upload-form">
                <input type="file" name="image" accept="image/*" required>
                <button type="submit" class="btn-upload">Uploader</button>
            </form>
        </div>

        <div class="images-section">
            <h2>Photos (glisser-déposer pour réordonner)</h2>
            
            <?php if (empty($images)): ?>
                <div class="empty-state">
                    <p>Aucune photo.</p>
                </div>
            <?php else: ?>
                <div class="images-grid">
                    <?php foreach ($images as $img): ?>
                        <div class="image-card">
                            <img src="<?php echo htmlspecialchars($img['image_path']); ?>" alt="Photo">
                            <div class="actions">
                                <button class="btn-delete-img" 
                                        onclick="if(confirm('Supprimer cette image?')) window.location.href='?id=<?php echo $logement_id; ?>&delete_img=<?php echo $img['id']; ?>'">
                                    Supprimer
                                </button>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>