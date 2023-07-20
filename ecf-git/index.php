<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Garage V.Parrot</title>
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
</head>
<body>
    <!--HEADER-->
    <?php include 'components/header.php'; ?>
    <!-- Section Home -->
    <section id="home">
        <div class="left">
            <div class="logo-home">
                <img class="img-logo2" src="image/garage-logo.png">
            </div>
            <h1> Achetez, Vendez ou <br> encore réparer votre voiture. </h1>
            <p> Bienvenue au Garage V.Parrot, votre partenaire de confiance pour tous vos besoins automobiles. Nous offrons des services de réparation et d'entretien de qualité supérieure, avec une équipe d'experts qualifiés et passionnés par l'automobile, nous nous engageons à vous fournir un service exceptionnel.</p>
        </div>
        <div class="right">
            <img src="image/car-home.png"></img>
        </div>
    </section>

    <!--Section Services-->
    <section id="services">
        <div class="title-wrapper">
            <h1 class="main-title">Nos services</h1>
        </div>
        <div class="list_services">
            <div class="service">
                <span class="material-symbols-outlined">
                    handyman
                </span>
                <h3> Entretien </h3>
                <p> Donnez à votre voiture l'attention qu'elle mérite avec nos services d'entretien de qualité supérieure. Notre équipe de techniciens qualifiés veillera à ce que votre véhicule fonctionne de manière optimale et en toute sécurité. Des vidanges d'huile régulières aux révisions approfondies, nous offrons une gamme complète de services d'entretien pour tous les types de voitures. Avec des équipements de pointe et une expertise inégalée, nous sommes en mesure de détecter et de résoudre les problèmes potentiels avant qu'ils ne deviennent plus graves. Confiez-nous votre voiture et profitez d'un service d'entretien fiable et efficace.  </p>
            </div>
            <div class="service">
                <span class="material-symbols-outlined">
                    handyman
                </span>
                <h3> Ventes </h3>
                <p> Trouvez la voiture de vos rêves chez V.Parrot. Nous proposons une sélection soigneusement choisie de véhicules d'occasion de haute qualité. Que vous recherchiez une berline élégante, un SUV robuste ou une voiture compacte, notre équipe experte est là pour vous guider dans votre choix. Toutes nos voitures sont rigoureusement inspectées pour garantir leur fiabilité et leur performance. Faites confiance à notre expérience et à notre engagement envers la satisfaction de nos clients. </p>
            </div>
            <div class="service">
                <span class="material-symbols-outlined">
                    handyman
                </span>
                <h3> Carrosserrie </h3>
                <p>Redonnez à votre voiture son éclat d'origine, que ce soit une éraflure légère, une bosse ou un accident majeur, notre équipe de spécialistes de la carrosserie est là pour restaurer l'apparence de votre véhicule. Nous utilisons des techniques avancées de réparation et des peintures de haute qualité pour obtenir des résultats impeccables. Notre engagement envers la précision et l'attention aux détails garantit que chaque réparation est effectuée avec soin. Confiez-nous votre voiture et laissez notre équipe de carrossiers lui redonner son apparence d'origine.  </p>
            </div> 
            <?php
            session_start();
            // Vérifiez si l'administrateur est connecté
            if (isset($_SESSION['admin']) && $_SESSION['admin'] === true) {
            // Afficher le formulaire d'ajout d'article
            echo '
                <div class="service">
                    <h3>Ajouter un article</h3>
                    <form id="add-article-form" method="POST" action="add-services.php">
                        <input type="text" name="title" placeholder="Titre" required>
                        <textarea name="content" placeholder="Contenu" required></textarea>
                        <button type="submit">Ajouter</button>
                    </form>
                </div>';
            }
            ?>
            <?php
            // Connexion à la base de données avec PDO
            $servername = "localhost";
            $dbusername = "root";
            $dbpassword = ""; 
            $dbname = "projet-garage"; 
            try {
                $conn = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $dbpassword);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                // Récupérer les articles depuis la base de données
                $stmt = $conn->query("SELECT * FROM services");
                while ($row = $stmt->fetch()) {
                    echo '<div class="service">';
                    echo ' <span class="material-symbols-outlined">handyman</span>';
                    echo '<h3>' . $row['title'] . '</h3>';
                    echo '<p>' . $row['content'] . '</p>';
                    echo '</div>';
                }
            } catch (PDOException $e) {
                die("Erreur de connexion à la base de données : " . $e->getMessage());
            }
            ?>
        </div>
    </section>

    <!--Section contact-->
    <section id="contact">
        <div class="title-wrapper">
            <h1 class="main-title">Retrouvez-nous</h1>
        </div>
        <div class="localisation_contact_div">
            <div class="localisation">
                <h3>Notre adresse</h3>
                <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d2159.7163371967595!2d1.429193269916464!3d43.59521920467914!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x12aebb7129937b55%3A0x729c3338722d0b7b!2s134%20Rue%20des%20Arcs%20Saint-Cyprien%2C%2031300%20Toulouse!5e0!3m2!1sfr!2sfr!4v1689329594441!5m2!1sfr!2sfr" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
            <div class="form_contact">
                <h3>Contactez-nous</h3>
                <form action="form-contact.php" method="post">
                    <input type="text" id="nom" name="nom" placeholder="Nom" required>
                    <input type="text" id="prenom" name="prenom" placeholder="Prenom" required>
                    <input type="email" id="email" name="email" placeholder="Adresse Mail" required>
                    <input type="text" id="telephone" name="telephone" placeholder="Telephone" required>
                    <textarea id="message" name="message" cols="30" rows="10" placeholder="Message"></textarea>
                    <button type="submit">Envoyer</button>
                </form>
            </div>
        </div>
    </section>

    <!-- Section Opinion-->
    <section id='avis'>
        <div class="title-wrapper">
            <h1 class="main-title">Vos avis</h1>
        </div>
        <div id="commentaires-container">
            <div id="commentaires">
                <!-- Les avis seront affichés ici -->
                <?php include 'fetch_reviews.php'; ?>
            </div>
        </div>
        <h2>AJOUTER UN AVIS</h2>
        <form id="avis-container" action="post_review.php" method="post">
            <input type="text" name="prenom" placeholder="Votre nom" required>
            <textarea name="commentaire" placeholder="Votre commentaire" required></textarea>
            <select name="rating" required>
                <option value="" disabled selected>Choisissez une note</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
            </select>
            <button type="submit">Ajouter</button>
        </form>
    </section>
    <!--Footer-->
    <?php include 'components/footer.php'; ?>

    <!-- Link to JS -->
    <script src="js/jquery-3.6.4.min.js"></script>
    <script src="js/scripts.js"> </script>
</body>
</html>