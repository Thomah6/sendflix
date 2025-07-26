anime({
  targets: '.nav .icon i',
  translateX: [100, 0],
  duration: 1200,
  opacity: [0, 1],
  delay: (el, i) => {
    return 300 + 100 * i;
  },
})

anime({
  targets: '.nav .icon p',
  duration: 1200,
  opacity: [0, 1],
  delay: 700
})

anime({
  targets: '.live .person',
  translateY: [100, 0],
  duration: 1200,
  delay: (el, i) => {
    return 1000 + 100 * i;
  },
})

anime({
  targets: '.like i',
  easing: 'easeOutExpo',
  scale: [2, 1],
  opacity: [0, 1],
  delay: 1200
})

anime({
  targets: '.comment i',
  easing: 'easeOutExpo',
  scale: [2, 1],
  opacity: [0, 1],
  delay: 1300
})

anime({
  targets: '.share i',
  easing: 'easeOutExpo',
  scale: [2, 1],
  opacity: [0, 1],
  delay: 1400
})

anime({
  targets: '.rainbow-icon',
  easing: 'easeOutExpo',
  scale: [2, 1],
  opacity: [0, 1],
  delay: 1500
})

anime({
  targets: '.newsfeed .card',
  translateY: [300, 0],
  easing: 'easeOutExpo',
  opacity: [0, 1],
  delay: (el, i) => 700 + 300 * i
})

document.addEventListener('DOMContentLoaded', (event) => {

      const preloader = document.querySelector("#preloader");
      preloader.style.display='none'; 
  });


  function toggleCheckbox(catId) {
    var checkbox = document.getElementById('cat-'+ catId);
    const int= document.querySelector('.int[data-id="'+catId +'"]');
  
    if(checkbox.checked){
      checkbox.checked=false;
      int.classList.remove('active');
  
    }else {
      var checkedCheckboxes = document.querySelectorAll('.category-checkbox:checked');
      if(checkedCheckboxes.length<4){
        checkbox.checked=true;
        int.classList.add('active');
  
      }
    }
  }

  function add(prec) {
    const inf = document.querySelector("#movie");
    const form = document.querySelector("#movie-form1");
    inf.click();
  
    inf.addEventListener('change', (event) => {
      const file = event.target.files[0];
      const maxSizeInBytes = 4000 * 1024 * 1024;
  
      if (file) {
        // Vérifier si le fichier est de type vidéo et non un fichier AVI
        if (file.type.startsWith('video/')) {
          if (file.name.toLowerCase().endsWith('.avi')) {
            alert('The selected file is an AVI file. Please upload a file in MP4 or another supported format.');
            return; // Arrêter l'exécution si le fichier est un AVI
          }
  
          if (file.size <= maxSizeInBytes) {
            const formData = new FormData(form);
  
            // Afficher la barre de progression circulaire
            const progressCircle = document.getElementById('progress-circle');
            const progressCircle1 = document.getElementById('progress-circle1');
            const progressBar = document.getElementById('progress-bar');
            const progressBar1 = document.getElementById('progress-bar1');
            const uploadc = document.getElementById('upc');
            uploadc.style.fontSize = '20px';
            progressCircle.style.display = 'block';
            progressCircle1.style.display = 'block';
  
            // Créer un objet XMLHttpRequest
            const xhr = new XMLHttpRequest();
  
            xhr.open('POST', 'brouillon.php', true);
  
            // Mettre à jour la barre de progression circulaire
            xhr.upload.addEventListener('progress', (event) => {
              if (event.lengthComputable) {
                const percentComplete = (event.loaded / event.total) * 100;
                const dashoffset = 283 - (283 * percentComplete) / 100;
                progressBar.style.strokeDashoffset = dashoffset;
                progressBar1.style.strokeDashoffset = dashoffset;
              }
            });
  
            // Écouter les événements de fin de requête
            xhr.onload = function() {
              if (xhr.status === 200) {
                const result = JSON.parse(xhr.responseText);
                if (result[0].message.trim() === "Upload confirmed") {
                  var encodedPath = encodeURIComponent(result[0].path);
                  window.location.href = 'add.php?brou=' + encodedPath + '&prec=' + encodeURIComponent(prec);
                } else if (result[0].message.trim() === "An error occured") {
                  alert('An error occured!');
                }
              } else {
                console.error('Erreur:', xhr.statusText);
                alert('Une erreur s\'est produite.');
              }
              // Masquer la barre de progression après la fin du téléchargement
              progressCircle.style.display = 'none';
              progressCircle1.style.display = 'none';
              uploadc.style.fontSize = '50px';
            };
  
            xhr.onerror = function() {
              console.error('Erreur:', xhr.statusText);
              alert('Une erreur s\'est produite.');
              // Masquer la barre de progression en cas d'erreur
              progressCircle.style.display = 'none';
              progressCircle1.style.display = 'none';
              uploadc.style.fontSize = '50px';
            };
  
            // Envoyer les données du formulaire
            xhr.send(formData);
          } else {
            alert('The movie shouldn\'t exceed 4GB!');
          }
        } else {
          alert('Please select a valid video file!');
        }
      }
    });
  }


 const sidebar = document.querySelector('nav');
 const toggle = document.querySelector(".toggle");
 const searchBtn = document.querySelector(".search-box");
  toggle.addEventListener("click" , () =>{
    sidebar.classList.toggle("close");
})

searchBtn.addEventListener("click" , () =>{
    sidebar.classList.remove("close");
})