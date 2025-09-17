

<?php
session_start();



if (!isset($_SESSION['id'])){
    header("location: seconnecter.php");
exit(); 
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ma Coloc</title>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Lora:wght@700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Galada&family=Paytone+One&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Galada&family=Hurricane&family=Paytone+One&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Galada&family=Hurricane&family=Luxurious+Script&family=Paytone+One&display=swap" rel="stylesheet">
    <link href="../CSS/compte.css" rel="stylesheet">


</head>

<body>

    <header>
        <h1>Ma-Coloc</h1>
        <a href="php/deconnexion.php"><p>Déconnexion</p> </a>
        
    </header>

    <nav class="navheader">
        <a href="../index.php"> acceuille </a>
        <a href="service-intro.html">Services</a>
        <a href="pagehtml/chat.html"> chat support </a>
    </nav>
    <h1> mes annonces</h1>
    
    <aside> 
    <div class="menu">
    <div class="menu-item"><a href="compte.php"><img src="../image/iconecompte.png" alt="compte"> compte</a></div>
    <div class="menu-item"><a href="chattxt.php"><img src="../image/chatlogo.png" alt="chat">chat</a></div>
    <div class="menu-item"><a href="colloc.php"><img src="../image/iconemaison.png" alt="colloc">ma colloc</a></div>
    <div class="menu-item"><a href="annonces.php"><img src="../image/annonce.png" alt="annonce">mes annonces </a></div>


    </div>
    </aside> 



    <footer>
        <p>&copy; 2024 Ma Coloc. Le meilleur site pour organiser votre colocation.</p>
        <a href="https://www.cnil.fr/fr/cookies-et-autres-traceurs/regles/cookies"> politique de cookie</a>
    </footer>

</body>

</html>
