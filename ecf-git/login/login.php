<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $servername = "localhost";
    $dbusername = "root";
    $dbpassword = ""; 
    $dbname = "projet-garage"; 
    try {
        // Connexion à la base de données avec PDO
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $dbpassword);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //verification table administators
        // Requête préparée pour vérifier les informations d'identification de l'administrateur
        $stmt = $conn->prepare("SELECT * FROM administrators WHERE username = :username AND password = :password");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        $stmt->execute();
        if ($stmt->rowCount() == 1) {
            // Les informations d'identification sont correctes, l'administrateur est connecté
            $_SESSION['admin'] = true;
            header("Location: ../index.php"); // Redirige vers la page d'accueil
            exit();
        } 
        else {
            // Les informations d'identification sont incorrectes, affiche un message d'erreur
            $error_message = "Identifiants invalides";
            header("Location: form.php");
        }
        //Verification table
        $stmt = $conn->prepare("SELECT * FROM workers WHERE email = :email AND password = :password");
        $stmt->bindParam(':email', $username);
        $stmt->bindParam(':password', $password);
        $stmt->execute();
        if ($stmt->rowCount() == 1) {
            // Les informations d'identification sont correctes, l'administrateur est connecté
            $_SESSION['worker'] = true;
            header("Location: ../index.php"); // Redirige vers la page d'accueil
            exit();
        } 
        else {
            // Les informations d'identification sont incorrectes, affiche un message d'erreur
            $error_message = "Identifiants invalides";
            header("Location: form.php");

        }
    } catch (PDOException $e) {
        die("Erreur de connexion à la base de données : " . $e->getMessage());
    }
}
?>
