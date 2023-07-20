<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style/style-admin.css">
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
</head>
<body>
    <!--HEADER-->
    <?php include 'components/header.php'; ?>

    <section id="admin-msg">
        <h2>Messagerie</h2>
        <?php
        $pdo = new PDO('mysql:host=localhost;dbname=projet-garage', 'root', '');
        $requete = $pdo->prepare("SELECT * FROM messages ORDER BY id DESC");
        $requete->execute();
        $messages = $requete->fetchAll(PDO::FETCH_ASSOC);
        if (count($messages) > 0) {
        echo "<table>";
        echo "<tr><th>Nom</th><th>Prénom</th><th>Adresse e-mail</th><th>Numéro de téléphone</th><th>Message</th></tr>";
        foreach ($messages as $message) {
            echo "<tr>";
            echo "<td>" . $message['nom'] . "</td>";
            echo "<td>" . $message['prenom'] . "</td>";
            echo "<td>" . $message['email'] . "</td>";
            echo "<td>" . $message['telephone'] . "</td>";
            echo "<td>" . $message['message'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
        } else {
        echo "Aucun message reçu.";
        }
        ?>
    </section>

    <section class="hor">
        <h2>MODIFIER LES HORAIRES</h2>
        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $pdo = new PDO('mysql:host=localhost;dbname=projet-garage', 'root', '');
            $requete = $pdo->prepare("UPDATE horaires SET lundi = :lundi, mardi = :mardi, mercredi = :mercredi, jeudi = :jeudi, vendredi = :vendredi, samedi = :samedi, dimanche = :dimanche WHERE id = 1");
            $requete->execute([
                'lundi' => $_POST['lundi'],
                'mardi' => $_POST['mardi'],
                'mercredi' => $_POST['mercredi'],
                'jeudi' => $_POST['jeudi'],
                'vendredi' => $_POST['vendredi'],
                'samedi' => $_POST['samedi'],
                'dimanche' => $_POST['dimanche']
            ]);
            echo "Les horaires ont été mis à jour avec succès.";
        }
        ?>
        <form action="admin.php" method="post">
            <div>
                <label for="lundi">Lundi :</label>
                <input type="text" id="lundi" name="lundi" value="<?php echo $horaires['lundi']; ?>">
                <label for="mardi">Mardi :</label>
                <input type="text" id="mardi" name="mardi" value="<?php echo $horaires['mardi']; ?>">
            </div>
            <div>
                <label for="mercredi">Mercredi :</label>
                <input type="text" id="mercredi" name="mercredi" value="<?php echo $horaires['mercredi']; ?>">
                <label for="jeudi">Jeudi :</label>
                <input type="text" id="jeudi" name="jeudi" value="<?php echo $horaires['jeudi']; ?>">
                <label for="vendredi">Vendredi :</label>
                <input type="text" id="vendredi" name="vendredi" value="<?php echo $horaires['vendredi']; ?>">
            </div>
            <div>
                <label for="samedi">Samedi :</label>
                <input type="text" id="samedi" name="samedi" value="<?php echo $horaires['samedi']; ?>">
                <label for="dimanche">Dimanche :</label>
                <input type="text" id="dimanche" name="dimanche" value="<?php echo $horaires['dimanche']; ?>">
                <div class="btn-hor">
                    <button type="submit">ENREGISTRER</button>
                </div>
            </div>
        </form>
    </section>
    <!-- Link to JS -->
    <script src="js/jquery-3.6.4.min.js"></script>
    <script src="js/scripts.js"> </script>
</body>
</html>
</body>
</html>