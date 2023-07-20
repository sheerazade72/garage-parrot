<?php
$pdo = new PDO('mysql:host=localhost;dbname=projet-garage', 'root', '');
$image = $_FILES['image']['name'];
$prix = $_POST['prix'];
$annee = $_POST['annee'];
$kilometrage = $_POST['kilometrage'];
$marque = $_POST['marque'];

$requete = $pdo->prepare("INSERT INTO voitures (image, prix, annee, kilometrage, marque) VALUES (?, ?, ?, ?, ?)");
$requete->execute([$image, $prix, $annee, $kilometrage, $marque]);

move_uploaded_file($_FILES['image']['tmp_name'], 'image/' . $image);

header('Location: sale.php');




