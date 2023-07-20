<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Garage V.Parrot</title>
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="style/style-form-sale.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <style>
        /* FILTRE */
/* Style pour le conteneur du filtrage */
.filter-btn{
    display: flex;
    align-items: center;
    text-align: center;
    justify-content: center;
}
.filter-btn button {
    padding: 10px 20px;
    margin: 10px;
    background-color: #000;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-weight: bold;
}
.filter-btn button:hover{
    background-color: #ea1f33;
}
.filter-container {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    align-items: center;
    justify-content: space-between;
    padding: 20px 20px 0 20px;
    background-color: #fff;
    width: 90%;
    margin: auto;
  }
  
  /* Style pour chaque élément de filtrage */
  .filter-item {
    flex-basis: 100%;
    max-width: 300px;
    text-align: center;
  }
  
  /* Style pour les titres indicatifs */
  h3 {
    margin: 5px 0;
    font-size: 16px;
    font-weight: bold;
    text-align: center;
  }
  
  /* Style pour les barres de filtre */
  input[type="range"] {
    width: 100%;
  }
  
  /* Style pour les informations supplémentaires des voitures (optionnel) */
  .image-info {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    padding: 10px;
    background-color: rgba(0, 0, 0, 0.7);
    color: #fff;
    border-bottom-left-radius: 5px;
    border-bottom-right-radius: 5px;
    font-size: 14px;
  }
  
  /* Ajoutez d'autres styles selon vos besoins */
  
  /* Style pour les médias query pour la réactivité */
  
  /* Pour les écrans de taille moyenne */
  @media screen and (max-width: 768px) {
    .filter-container {
      flex-direction: column;
      align-items: stretch;
    }
  
    .filter-item {
      flex-basis: auto;
      max-width: none;
    }
  }
  
  /* Pour les petits écrans */
  @media screen and (max-width: 480px) {
    .gallery {
      grid-template-columns: 1fr;
    }
  }


</style>
</head>
<body>
    <div class="all-content">
     <!--HEADER-->
    <?php include 'components/header.php'; ?>

            <!-- Conteneur du filtrage -->
    <div class="filter-container">
        <div class="filter-item">
            <h3>Prix (min-max)</h3>
            <input class="filter-input" type="range" min="0" max="100000" step="100" value="0" id="minPrice" data-price="0">
            <input class="filter-input" type="range" min="0" max="100000" step="100" value="100000" id="maxPrice" data-price="100000">
        </div>
        <div class="filter-item">
            <h3>Kilométrage (min-max)</h3>
            <input class="filter-input" type="range" min="0" max="300000" step="5000" value="0" id="minKm" data-km="0">
            <input class="filter-input" type="range" min="0" max="300000" step="5000" value="300000" id="maxKm" data-km="300000">
        </div>
        <div class="filter-item">
            <h3>Année (min-max)</h3>
            <input class="filter-input" type="range" min="1990" max="2023" step="1" value="1990" id="minYear" data-year="1990">
            <input class="filter-input" type="range" min="1990" max="2023" step="1" value="2023" id="maxYear" data-year="2023">
        </div>
    </div>
    <div class="filter-btn">
        <button onclick="filterCars()">Filtrer</button>
        <button onclick="resetFilters()">Réinitialiser</button>
    </div>


        <!-- Formulaire pour enploye -->
        <?php
        session_start();
        // Vérifiez si l'enployé est connecté
        if (isset($_SESSION['worker']) && $_SESSION['worker'] === true) {
            echo '
                <section id="new-car">
                    <h2>Ajouter une voiture</h2>
                    <form id="formulaire" action="ajouter_voiture.php" method="post" enctype="multipart/form-data">
                        <div class="required">
                            <input type="text" name="marque" placeholder="Marque" required>
                            <input type="text" name="prix" placeholder="Prix" required>
                            <input type="text" name="annee" placeholder="Année" required>
                            <input type="text" name="kilometrage" placeholder="Kilométrage" required>
                            <input type="file" name="image" required>
                        </div>
                        <div class="new-car-btn">
                            <button type="submit">Ajouter</button>
                        </div>
                    </form>
                </section>';
        }
        ?>
        <!-- Affichage des voitures -->
        <div class="title-wrapper">
            <h1 class="main-title">Nos voitures</h1>
        </div>        
        <div class="gallery">
            <?php
            // Connexion à la base de données
            $pdo = new PDO('mysql:host=localhost;dbname=projet-garage', 'root', '');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Récupérer toutes les voitures de la table "voitures"
            $requete = $pdo->prepare("SELECT * FROM voitures");
            $requete->execute();
            $voitures = $requete->fetchAll(PDO::FETCH_ASSOC);

            // Afficher les voitures
            foreach ($voitures as $voiture) {
                echo '<div class="car" data-price="' . $voiture['prix'] . '" data-km="' . $voiture['kilometrage'] . '" data-year="' . $voiture['annee'] . '">';
                echo '<img src="image/' . $voiture["image"] . '" alt="Photo de la voiture" onclick="showPopup(' . htmlspecialchars(json_encode($voiture)) . ')">';
                echo '</div>';
            }
            ?>
        </div>
    </div>

    <!-- Popup -->
    <div class="popup" id="carPopup">
        <span class="close" onclick="closePopup()">&times;</span>
        <img src="" alt="Photo de la voiture" id="popupImage">
        <p id="popupMarque"></p>
        <p id="popupPrix"></p>
        <p id="popupAnnee"></p>
        <p id="popupKilometrage"></p>
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
    <!--Footer-->
    <?php include 'components/footer.php'; ?>

    <!-- Link to JS -->
    <script>
    // Fonction pour filtrer les voitures
    function filterCars() {
        // Récupérer les valeurs des filtres
        var minPrice = parseInt(document.getElementById('minPrice').value);
        var maxPrice = parseInt(document.getElementById('maxPrice').value);
        var minKm = parseInt(document.getElementById('minKm').value);
        var maxKm = parseInt(document.getElementById('maxKm').value);
        var minYear = parseInt(document.getElementById('minYear').value);
        var maxYear = parseInt(document.getElementById('maxYear').value);

        // Récupérer toutes les voitures affichées
        var cars = document.getElementsByClassName('car');

        // Parcourir les voitures et les afficher ou les masquer en fonction des critères de filtrage
        for (var i = 0; i < cars.length; i++) {
            var car = cars[i];
            var carPrice = parseInt(car.getAttribute('data-price'));
            var carKm = parseInt(car.getAttribute('data-km'));
            var carYear = parseInt(car.getAttribute('data-year'));

            if (
                carPrice >= minPrice && carPrice <= maxPrice &&
                carKm >= minKm && carKm <= maxKm &&
                carYear >= minYear && carYear <= maxYear
            ) {
                car.style.display = 'block'; // Afficher la voiture
            } else {
                car.style.display = 'none'; // Masquer la voiture
            }
        }
    }

    // Fonction pour réinitialiser les filtres
    function resetFilters() {
        // Rétablir les valeurs par défaut des filtres
        document.getElementById('minPrice').value = 0;
        document.getElementById('maxPrice').value = 100000;
        document.getElementById('minKm').value = 0;
        document.getElementById('maxKm').value = 300000;
        document.getElementById('minYear').value = 1990;
        document.getElementById('maxYear').value = 2023;

        // Afficher toutes les voitures
        var cars = document.getElementsByClassName('car');
        for (var i = 0; i < cars.length; i++) {
            cars[i].style.display = 'block';
        }
    }
</script>
    <script src="js/jquery-3.6.4.min.js"></script>
    <script src="js/scripts.js"> </script>
</body>
</html>