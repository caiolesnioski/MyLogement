<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mes Favoris | LogeStay</title>
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
        .container {
            max-width: 1100px;
            margin: 2rem auto;
            padding: 1rem;
            background: rgba(26, 31, 60, 0.95);
            border-radius: 16px;
            box-shadow: 0 4px 24px rgba(0,0,0,0.12);
        }
        h1 {
            text-align: center;
            color: #fca311;
        }
        .favoris-list {
            list-style: none;
            padding: 0;
        }
        .favoris-item {
            background: #1a1f3c;
            margin: 1rem 0;
            padding: 1rem;
            border-radius: 8px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .favoris-item h2 {
            margin: 0;
            color: #fff;
        }
        .remove-btn {
            background: #fca311;
            color: #14213d;
            border: none;
            border-radius: 6px;
            padding: 0.5rem 1rem;
            cursor: pointer;
            transition: background 0.2s;
        }
        .remove-btn:hover {
            background: #fff;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Mes Favoris</h1>
        <ul class="favoris-list">
            <!-- Exemple d'éléments de favoris -->
            <li class="favoris-item">
                <h2>Nouvelle villa</h2>
                <button class="remove-btn">Retirer</button>
            </li>
            <li class="favoris-item">
                <h2>Villa avec Plage et Golf</h2>
                <button class="remove-btn">Retirer</button>
            </li>
            <!-- Ajoutez ici d'autres éléments de favoris -->
        </ul>
    </div>
</body>
</html>