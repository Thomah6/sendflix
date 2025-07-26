
function videocli(clickedVideo){
    const short = document.querySelectorAll('.short');
for(var i=0;i< short.length;i++){
    if(short[i]!==clickedVideo){
        short[i].pause();
        short[i].src="";

    }
}
if(clickedVideo.paused){
  clickedVideo.src = clickedVideo.dataset.src;

    clickedVideo.play();
    clickedVideo.parentElement.querySelector('.play').style.display='none';

}else{
  clickedVideo.pause();
  clickedVideo.src="";
  clickedVideo.parentElement.querySelector('.play').style.display='block';
    
}
}

const plays = document.querySelectorAll('.play');
plays.forEach(play=>{
play.addEventListener('click', function(){
  const shortt = document.querySelectorAll('.short');
for(var i=0;i< shortt.length;i++){ 
        shortt[i].pause();
}
play.style.display='none';

play.parentElement.querySelector('.short').src = play.parentElement.querySelector('.short').dataset.src;
play.parentElement.querySelector('.short').play();

});

});
document.addEventListener('DOMContentLoaded', (event) => {
    const cardsContainer = document.querySelector('.cards-container'); // Sélectionne le conteneur des cartes
    const cards = document.querySelectorAll('.card'); // Sélectionne toutes les cartes individuelles
    let currentIndex = 0; // Indice de la carte actuellement centrée
    let startX; // Position de départ du toucher
    let isDragging = false; // Indicateur pour suivre l'état du glissement
  
    // Fonction pour afficher la carte à l'index spécifié
    function showCard(index) {
      const offset = -index * 100; // Calcule le décalage en pourcentage pour centrer la carte
      cardsContainer.style.transform = `translateX(${offset}%)`; // Applique la transformation de translation au conteneur des cartes
  
      // Ajoute la classe 'shake' à la carte actuellement centrée pour une animation
      cards[currentIndex].classList.add('shake');
  
      // Supprime la classe 'shake' après la fin de l'animation (0.5s)
      setTimeout(() => {
        cards[currentIndex].classList.remove('shake');
      }, 500);
    }
  
    // Gestionnaire pour le début du toucher
    function handleTouchStart(event) {
      startX = event.touches[0].clientX; // Enregistre la position X du premier toucher
      isDragging = true; // Active l'état de glissement
    }
  
    // Gestionnaire pour le mouvement du toucher
    function handleTouchMove(event) {
      if (!isDragging) return; // Si le glissement n'est pas actif, quitte la fonction
  
      const moveX = event.touches[0].clientX; // Position X actuelle du toucher
      const diffX = startX - moveX; // Calcul de la différence de position depuis le début du toucher
  
      // Détermine la direction du glissement et ajuste l'indice de la carte actuellement centrée
      if (diffX > 50 && currentIndex < cards.length - 1) {
        currentIndex++; // Déplace vers la carte suivante si le glissement est vers la gauche
        showCard(currentIndex); // Affiche la nouvelle carte centrée
        startX = moveX; // Met à jour la position de départ du toucher
      } else if (diffX < -50 && currentIndex > 0) {
        currentIndex--; // Déplace vers la carte précédente si le glissement est vers la droite
        showCard(currentIndex); // Affiche la nouvelle carte centrée
        startX = moveX; // Met à jour la position de départ du toucher
      }
    }
  
    // Gestionnaire pour la fin du toucher
    function handleTouchEnd() {
      isDragging = false; // Désactive l'état de glissement à la fin du toucher
    }
  
    // Ajoute les écouteurs d'événements pour le glissement tactile
    cardsContainer.addEventListener('touchstart', handleTouchStart);
    cardsContainer.addEventListener('touchmove', handleTouchMove);
    cardsContainer.addEventListener('touchend', handleTouchEnd);
  
    // Gestionnaire pour les touches du clavier (navigation avec les flèches gauche et droite)
    document.addEventListener('keydown', (event) => {
      if (event.key === 'ArrowRight' && currentIndex < cards.length - 1 && window.innerWidth<901) {
        currentIndex++; // Déplace vers la carte suivante si la touche de droite est pressée
        showCard(currentIndex); // Affiche la nouvelle carte centrée
      } else if (event.key === 'ArrowLeft' && currentIndex > 0 && window.innerWidth<901) {
        currentIndex--; // Déplace vers la carte précédente si la touche de gauche est pressée
        showCard(currentIndex); // Affiche la nouvelle carte centrée
      }
    });
  
  
    // Initialisation de la variable pour la gestion de la première vidéo
let firstVideo = true;

// Sélection de toutes les vidéos avec la classe "short"
let videos = document.querySelectorAll(".short");

// Convertir NodeList en tableau
videos = Array.from(videos);

// Fonction pour mettre en pause toutes les vidéos
function pauseAllVideos() {
    videos.forEach(video => {
        video.pause();
        video.src = "";

    });
}

// Création d'un observateur d'intersection pour chaque vidéo
let observer = new IntersectionObserver(entries => {
    let visibleVideos = entries.filter(entry => entry.isIntersecting).map(entry => entry.target);
    
    // Si plus d'une vidéo est visible, mettre toutes les vidéos en pause
    if (visibleVideos.length > 1) {
        pauseAllVideos();
    } else if (visibleVideos.length === 1) {
        // Sinon, lire la vidéo visible
        let visibleVideo = visibleVideos[0];
        visibleVideo.src = visibleVideo.dataset.src;
        visibleVideo.play();
        visibleVideo.muted = false;
        visibleVideo.parentElement.querySelector('.play').style.display = 'none';
        
    } else {
        // Si aucune vidéo n'est visible, mettre toutes les vidéos en pause
        pauseAllVideos();
    }
}, { threshold: 0.85 });

// Observation de chaque vidéo
videos.forEach(video => {
    observer.observe(video);
});

    
        const preloader = document.querySelector("#preloader");
        preloader.style.display='none'; 
    });
    
    // script.js
document.addEventListener('DOMContentLoaded', function() {
  const buttons = document.querySelectorAll('#tooltipButton');

  buttons.forEach(button=>{
    button.addEventListener('click', function() {
      const tooltip = button.parentElement.querySelector('#tooltip');

      // Toggle the visibility of the tooltip
      if (tooltip.style.display === 'flex') {
        tooltip.style.animation='close-tooltip 1s ease-in-out ';
        setTimeout(() => {
          tooltip.style.display = 'none';
        }, 1000);
      } else {

          tooltip.style.display = 'flex';
          tooltip.style.animation='open-tooltip 1s ease-in-out ';
      }
  });
  });
  

  // Hide the tooltip if clicking outside
  document.addEventListener('click', function(event) {
    buttons.forEach(button=>{
      const tooltip = button.parentElement.querySelector('#tooltip');

      if (!button.contains(event.target) && !tooltip.contains(event.target)) {
        tooltip.style.animation='close-tooltip 1s ease-in-out ';
        setTimeout(() => {
          tooltip.style.display = 'none';
        }, 1000);
      }
    });
  });


});

// script.js
document.querySelectorAll('.svg-icon.icon-heart').forEach(button => {
  button.addEventListener('click', function() {
    const hbruit = document.querySelector("#hbruitage");

      // Ajoute la classe 'clicked' au bouton cliqué

      if(button.querySelector('.ici').classList.contains('bi-heart')){
        hbruit.play();
        button.querySelector('.ici').classList.remove('bi-heart');
        button.querySelector('.ici').classList.add('bi-heart-fill');
      }else if(button.querySelector('.ici').classList.contains('bi-heart-fill')){
        
        button.querySelector('.ici').classList.remove('bi-heart-fill');
        button.querySelector('.ici').classList.add('bi-heart');
      }
  });
});

document.addEventListener('DOMContentLoaded', function () {
  const starIcons = document.querySelectorAll('.svg-icon.icon-star');

  starIcons.forEach(starIcon => {
    starIcon.addEventListener('click', (event) => {
      // Trouver l'élément <i> à l'intérieur du conteneur cliqué
      const iconElement = starIcon.querySelector('i');

      // Vérifiez si l'élément <i> a la classe 'active'
      if (!iconElement.classList.contains('active')) {
        return;
      }

      // Enlever la classe 'active' après avoir vérifié
      iconElement.classList.remove('active');

      // Trouver la carte la plus proche
      const card = starIcon.closest('.card');
      let starContainer = card.querySelector('.star-container');

      // Si le conteneur des étoiles n'existe pas encore, le créer
      if (!starContainer) {
        starContainer = document.createElement('div');
        starContainer.classList.add('star-container');
        starContainer.style.position = 'absolute';
        starContainer.style.top = '0';
        starContainer.style.left = '0';
        starContainer.style.width = '100%';
        starContainer.style.height = '100%';
        starContainer.style.pointerEvents = 'none'; // Éviter les interférences avec les clics
        card.appendChild(starContainer);
      }

      const starCount = 30; // Nombre d'étoiles à créer

      for (let i = 0; i < starCount; i++) {
        const star = document.createElement('i');
        star.classList.add('bi', 'bi-star-fill', 'star');

        // Positionner l'étoile aléatoirement dans le conteneur
        const containerWidth = starContainer.offsetWidth;
        const containerHeight = starContainer.offsetHeight;
        const randomX = Math.random() * containerWidth;
        const randomY = Math.random() * containerHeight;

        star.style.position = 'absolute';
        star.style.left = `${randomX}px`;
        star.style.top = `${randomY}px`;

        // Ajouter l'étoile au conteneur
        starContainer.appendChild(star);

        // Animer l'étoile
        setTimeout(() => {
          star.classList.add('animate'); // Applique l'animation
          console.log(`Star ${i} animation added`);
        }, 0);

        // Supprimer l'étoile après l'animation
        setTimeout(() => {
          star.remove();
          console.log(`Star ${i} removed`);
        }, 10000); // Doit correspondre à la durée de l'animation
      }
    });
  });
});
document.addEventListener('DOMContentLoaded', () => {
  const fire = document.querySelector('.fire');

  fire.addEventListener('click', () => {
    // Sélectionne les éléments enfants
    const fireLeft = fire.querySelector('.fire-left');
    const fireCenter = fire.querySelector('.fire-center');
    const fireRight = fire.querySelector('.fire-right');
    const fireBottom = fire.querySelector('.fire-bottom');
    
    // Vérifie si tous les éléments enfants ont la classe 'active'
    const allActive = [fireLeft, fireCenter, fireRight, fireBottom].every(el => el.classList.contains('active'));

    if (allActive) {
      // Si tous les éléments ont la classe 'active', retire la classe 'active' de tous les éléments
      fireLeft.classList.remove('active');
      fireCenter.classList.remove('active');
      fireRight.classList.remove('active');
      fireBottom.classList.remove('active');
    } else {
      // Sinon, fait quelque chose ou vous pouvez également ajouter la classe 'active' si nécessaire
      console.log('Not all elements have the class "active".');
    }
  });
});
