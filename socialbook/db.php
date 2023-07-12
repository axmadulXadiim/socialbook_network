<?php
$servername = "localhost"; // Nom du serveur MySQL (généralement "localhost")
$username = "root"; // Nom d'utilisateur MySQL
$password = ""; // Mot de passe MySQL
$dbname = "socialbook"; // Nom de la base de données

// Établir la connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Échec de la connexion à la base de données : " . $conn->connect_error);
}


?>
