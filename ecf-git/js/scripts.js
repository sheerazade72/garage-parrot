// Menu responsive
var menu_toggle = document.querySelector('.menu_toggle');
var menu = document.querySelector('.menu');
var menu_toggle_span = document.querySelector('.menu_toggle span');
menu_toggle.onclick = function(){
    menu_toggle.classList.toggle('active');
    menu_toggle_span.classList.toggle('active');
    menu.classList.toggle('responsive')
}

//AVIS
// Fonction pour afficher les avis
function displayReviews(reviews) {
  const reviewsContainer = document.getElementById('commentaires');
  reviewsContainer.innerHTML = '';
  reviews.forEach(function(review) {
    const reviewElement = document.createElement('div');
    reviewElement.innerHTML = `<p><strong>Prénom:</strong> ${review.firstname}</p>
                               <p><strong>Note:</strong> ${review.rating}</p>
                               <p><strong>Commentaire:</strong> ${review.comment}</p>`;
    reviewsContainer.appendChild(reviewElement);
  });
}

// Fonction pour charger les avis depuis le serveur
function loadReviews() {
  fetch('get_reviews.php')
    .then(function(response) {
      return response.json();
    })
    .then(function(data) {
      displayReviews(data.reviews);
    });
}

// Charger les avis au chargement de la page
loadReviews();

// Ajout de l'écouteur d'événement sur la soumission du formulaire
const reviewForm = document.getElementById('review-form');
reviewForm.addEventListener('submit', function(event) {
  event.preventDefault();
  
  const formData = new FormData(reviewForm);
  const reviewData = Object.fromEntries(formData.entries());

  // Envoi des données du formulaire au serveur
  fetch('post_review.php', {
    method: 'POST',
    body: JSON.stringify(reviewData),
    headers: {
      'Content-Type': 'application/json'
    }
  })
    .then(function(response) {
      return response.json();
    })
    .then(function(data) {
      if (data.success) {
        reviewForm.reset();
        loadReviews(); // Recharger les avis après l'ajout d'un nouvel avis
      } else {
        alert(data.message);
      }
    });
});



// Formulaire Voiture enployer
window.addEventListener('DOMContentLoaded', () => {
  const articles = document.getElementsByClassName('article');
  for (let i = 0; i < articles.length; i++) {
    articles[i].addEventListener('click', () => {
      const articleId = articles[i].getAttribute('data-id');
      window.location.href = 'article.php?id=' + articleId;
    });
  }
});

// Validation form
function validateEmail(email) {
  const emailRegex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
  return emailRegex.test(email);
}
function securePassword(password) {
  const passwordRegex = /^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{7,}$/;
  return passwordRegex.test(password);
}
// Récupération des éléments du formulaire
const form = document.getElementById('register-form');
const emailInput = document.getElementById('email');
const passwordInput = document.getElementById('password');
// Ajout de l'écouteur d'événement sur la soumission du formulaire
form.addEventListener('submit', function(event) {
  const email = emailInput.value;
  const password = passwordInput.value;
  if (!validateEmail(email)) {
    event.preventDefault();
    alert('Veuillez entrer une adresse e-mail valide.');
  } else if (!securePassword(password)) {
    event.preventDefault();
    alert('Veuillez entrer un mot de passe sécurisé avec un min de 7 caractères comprenant au moins un caractère spécial et un chiffre.');
  }
});

// Fonction pour afficher la popup avec les informations de la voiture sélectionnée
function showPopup(voiture) {
  document.getElementById("popupImage").src = "image/" + voiture.image;
  document.getElementById("popupMarque").innerText = "Marque : " + voiture.marque;
  document.getElementById("popupPrix").innerText = "Prix : " + voiture.prix + '€';
  document.getElementById("popupAnnee").innerText = "Année : " + voiture.annee;
  document.getElementById("popupKilometrage").innerText = "Kilométrage : " + voiture.kilometrage + 'Km';

  document.getElementById("carPopup").style.display = "block";
}

// Fonction pour fermer la popup
function closePopup() {
  document.getElementById("carPopup").style.display = "none";
}

// Variable pour stocker toutes les voitures
let allCars = [];


// Fonction pour charger les voitures depuis le fichier "afficher_voitures.php"
function loadCars() {
  const xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
      if (this.readyState === 4 && this.status === 200) {
          const cars = JSON.parse(this.responseText);
          displayCars(cars);
          addCarClickListeners();
      }
  };
  xhttp.open('GET', 'afficher_voitures.php', true);
  xhttp.send();
}

// Fonction pour afficher le contenu de la popup avec les informations personnalisées
function showCarPopup(car) {
  const popupContent = document.getElementById('carPopupContent');
  popupContent.innerHTML = `
      <img src="image/${car.image}" alt="Photo de la voiture">
      <h2>${car.marque}</h2>
      <p>Prix: ${car.prix} €</p>
      <p>Année: ${car.annee}</p>
      <p>Kilométrage: ${car.kilometrage} km</p>
  `;

  const carPopup = document.getElementById('carPopup');
  carPopup.style.display = 'block';
}

// Fonction pour fermer la popup
function closeCarPopup() {
  const carPopup = document.getElementById('carPopup');
  carPopup.style.display = 'none';
}

// Fonction pour ajouter un gestionnaire d'événement à chaque image de voiture
function addCarClickListeners() {
  const carImages = document.getElementsByClassName('car');
  for (const carImage of carImages) {
      carImage.addEventListener('click', function() {
          const marque = this.getAttribute('data-marque');
          const prix = this.getAttribute('data-prix');
          const annee = this.getAttribute('data-annee');
          const kilometrage = this.getAttribute('data-kilometrage');

          const car = {
              marque: marque,
              prix: prix,
              annee: annee,
              kilometrage: kilometrage
              // Ajoutez d'autres propriétés de voiture ici si nécessaire
          };

          showCarPopup(car);
      });
  }
}

// Fonction pour afficher les voitures dans la galerie
function displayCars(cars) {
  const carGallery = document.getElementById('carGallery');
  carGallery.innerHTML = '';

  cars.forEach(car => {
      const carLi = document.createElement('li');
      carLi.classList.add('car');
      carLi.setAttribute('data-marque', car.marque);
      carLi.setAttribute('data-prix', car.prix);
      carLi.setAttribute('data-annee', car.annee);
      carLi.setAttribute('data-kilometrage', car.kilometrage);

      const carImage = document.createElement('img');
      carImage.src = 'image/' + car.image;
      carImage.alt = 'Photo de la voiture';

      carLi.appendChild(carImage);
      carGallery.appendChild(carLi);
  });
}

// Appeler la fonction pour charger toutes les voitures au chargement de la page
loadCars();
