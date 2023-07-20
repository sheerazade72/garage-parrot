<?php
$pdo = new PDO('mysql:host=localhost;dbname=projet-garage', 'root', '');

$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$email = $_POST['email'];
$telephone = $_POST['telephone'];
$message = $_POST['message'];

$requete = $pdo->prepare("INSERT INTO messages (nom, prenom, email, telephone, message) VALUES (?, ?, ?, ?, ?)");
$requete->execute([$nom, $prenom, $email, $telephone, $message]);

header('Location: index.php');
