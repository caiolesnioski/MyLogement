<?php
$host = "localhost:8889"; // geralmente localhost
$dbname = "gestion_reservations"; // nome do seu banco de dados
$user = "root"; // usuário padrão do MAMP
$pass = "root"; // senha padrão do MAMP no Mac

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro de conexão: " . $e->getMessage());
}
?>