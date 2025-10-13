<?php
// signup.php
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Créer un compte | LogeStay</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="LS.png">
    <style>
        body {
            background: #14213d url('assets/img/bg-leaves.png') no-repeat center center fixed;
            background-size: cover;
            color: #fff;
            font-family: 'Segoe UI', Arial, sans-serif;
            margin: 0;
        }
        .container {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
        .signup-box {
            background: rgba(26, 31, 60, 0.95);
            border-radius: 20px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.18);
            padding: 2.5rem 2rem;
            max-width: 400px;
            width: 100%;
            margin: 2rem 0;
        }
        .signup-box h2 {
            text-align: center;
            color: #2974fa;
            margin-bottom: 2rem;
            font-size: 2rem;
        }
        .form-group {
            margin-bottom: 1rem;
            display: flex;
            gap: 1rem;
        }
        .form-group input {
            width: 100%;
        }
        input, select {
            width: 100%;
            padding: 0.8rem;
            border-radius: 10px;
            border: none;
            margin-bottom: 0.5rem;
            font-size: 1rem;
            background: #fff;
            color: #14213d;
        }
        input:focus {
            outline: 2px solid #2974fa;
        }
        .btn-primary {
            width: 100%;
            padding: 1rem;
            background: #2974fa;
            color: #fff;
            border: none;
            border-radius: 10px;
            font-size: 1.1rem;
            font-weight: bold;
            cursor: pointer;
            margin-top: 1rem;
            transition: background 0.2s;
        }
        .btn-primary:hover {
            background: #fca311;
            color: #14213d;
        }
        .login-link {
            text-align: center;
            margin-top: 1rem;
            color: #e5e5e5;
            font-size: 0.98rem;
        }
        .login-link a {
            color: #2974fa;
            text-decoration: none;
            font-weight: 500;
        }
        .login-link a:hover {
            text-decoration: underline;
        }
        @media (max-width: 500px) {
            .signup-box {
                padding: 1.2rem 0.5rem;
            }
        }
    </style>
</head>
<body>
    <div style="margin: 2rem;">
        <button onclick="window.history.back()" style="background:#fca311;color:#14213d;border:none;padding:0.7rem 1.5rem;border-radius:8px;font-weight:bold;cursor:pointer;">
            ← Retour
        </button>
    </div>
    <div class="container">
        <form class="signup-box" method="POST" action="signup_process.php">
            <h2>Créer un compte</h2>
            <input type="text" name="fullname" placeholder="Nom complet" required>
            <input type="email" name="email" placeholder="Adresse email" required>
            <div class="form-group">
                <input type="password" name="password" placeholder="Mot de passe (min 6 caractères)" minlength="6" required>
                <input type="password" name="confirm_password" placeholder="Confirmer le mot de passe" minlength="6" required>
            </div>
            <div class="form-group">
                <input type="text" name="phone" placeholder="Numéro de téléphone" required>
                <input type="date" name="birthdate" placeholder="Date de naissance" required>
            </div>
            <input type="text" name="address" placeholder="Adresse principale" required>
            <input type="text" name="address2" placeholder="Complément d'adresse (optionnel)">
            <div class="form-group">
                <input type="text" name="zipcode" placeholder="Code postal" required>
                <input type="text" name="city" placeholder="Ville" required>
            </div>
            <input type="text" name="country" placeholder="Pays" required>
            <button type="submit" class="btn-primary">S'INSCRIRE</button>
            <div class="login-link">
                Déjà un compte ? <a href="login.php">Se connecter</a>
            </div>
        </form>
    </div>
</body>
</html>