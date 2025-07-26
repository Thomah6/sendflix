<?php
require('conn.php');

if(isset($_GET['prec']) && !empty($_GET['prec'])){
$precPage=$_GET['prec'];
}else{
$precPage="index.php";
}

if(isset($_GET['brou']) && !empty($_GET['brou'])){
$path=urldecode(htmlspecialchars($_GET['brou']));
}else{
  
  header ('Location:'.$precPage);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="auth/images/favicon.ico" type="image/x-icon">

  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="style.css">
  <link href="font.css" rel="stylesheet">
  <link href="fontawesome/css/all.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
     <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
     <link rel="stylesheet" href="./loader.css">
     <link rel="stylesheet" href="./add.css">
  <script src="9f37ddf547.js"></script>
  <title>Sendflix- Social Movie Networking App</title>
</head>

<body>
<section   style="background: NONE;height:100vh;width:100%;">
    <div >
      
    <section class="video">
      
    <div class="prevV" style="background:none;position: relative;"><video src="<?=$path?>" autoplay muted></video></div>
      <div class="" style="width:100%;font-size:20px;padding:10px;position:absolute;top:0;left:0;height:100vh;background-color: rgba(0, 0, 0, 0.577);backdrop-filter:blur(3px);">
          <div>
            <a href="<?= $precPage ?>" style="text-decoration: none;color:white;"><i style="cursor:pointer;" id="retour" class="ri ri-arrow-left-line"></i></a>
          <button id="submit-btn" style="float:right;background: #00D4FF;outline:none;border-radius:7px;padding:10px 20px; color:white;border:none;"><span id="sn">Share Now</span> <span id="loading" style="display:none;">Processing...</span></button>
          </div>
          <div style="width:100%;margin-top:30px;background-color: none;">
            <form  method="post">
            <input type="hidden" id="movie_path" name="path" value="<?=$path?>">
            <center>
            <div role="tablist" aria-labelledby="channel-name">
              <span id="tab-1" role="tab" aria-controls="tabPanel-1" aria-selected="true" tabindex="0">Film
</span>
              <span id="tab-2" role="tab" aria-controls="tabPanel-2" aria-selected="false" tabindex="-1">Anime
</span>
            </div>
          </center>

          <div class="tab-panels">
            <div class="cat active" id="tabPanel-1" role="tabpanel" tabindex="0" aria-labelledby="tab-1">
            <?php
              $ji=$pdo->query("SELECT * FROM categories WHERE type='film' ");
              while($jii=$ji->fetch()){
                $catid=$jii['id'];
                $cattitre=$jii['titre'];
                ?>
                <button class="int" type="button" data-id="<?=$catid?>" onclick="toggleCheckbox(<?=$catid?>)"  type="submit" name="go" class=""><?=$cattitre?></button><input type="checkbox" name="category[]" value="<?=$cattitre?>" id="cat-<?=$catid?>" style="display:none;" class="film-checkbox category-checkbox">

             <?php
              }
            ?>
              
            </div>
            <div class="cat" id="tabPanel-2" role="tabpanel" tabindex="0" aria-labelledby="tab-2">
            <?php
              $ji=$pdo->query("SELECT * FROM categories WHERE type='anime' ");
              while($jii=$ji->fetch()){
                $catid=$jii['id'];
                $cattitre=$jii['titre'];
                ?>
                <button class="int" type="button" data-id="<?=$catid?>" onclick="toggleCheckbox(<?=$catid?>)"  type="submit" name="go" class=""><?=$cattitre?></button><input type="checkbox" name="category[]" value="<?=$cattitre?>" id="cat-<?=$catid?>" style="display:none;" class="anime-checkbox category-checkbox">

             <?php
              }
            ?>            </div>
          </div>
           
          
          

          <div  class="commentaire" id="share">
          <textarea type="text" placeholder="Enter comment here..." class="comm"></textarea>

          </div>
          </form>
        </div>
      </div>
      
    
    </section>
      
    </div>
  </section>

  

  <section id="preloader">
    <div class="loader">
      <div class="inner one"></div>
      <div class="inner two"></div>
      <div class="inner three"></div>
    </div>
  </section>

  
  <section class="nav">
    <div class="nav1"></div>
    <div class="div">
      <a  style="text-decoration: none;">

        <div class="icon active">
          <i class="ri ri-fire-fill"></i>
        </div>
     </a>

      <div class="icon">
        <i  class="ri ri-search-eye-fill"></i>
      </div>

        <div class="icon">
          <i data-pec="index.php" onclick="add(this)" style="font-size:50px;color: #ffffff;" class="bx bxs-plus-square"></i>
        
        </div>
      

      <div class="icon">
        <i class="bx bxs-message-square-dots"></i>
      </div>
      <a href="profil.php" style="text-decoration: none;">
      <div class="icon">
        <i>
          <img src="images/profile2.jpg" style="border-radius: 50%; width: 25px;height:25px;border:1px solid #8E919A;">
        </i>        
      </div>
    </a>

    </div>
    
  </section>
  

<script>
document.addEventListener('DOMContentLoaded', function() {
  const submitButton = document.getElementById('submit-btn');
  const sn = document.getElementById('sn');
  const form = document.querySelector('form');
    const pathInput = document.getElementById('movie_path');
    const filmCheckboxes = document.querySelectorAll('#tabPanel-1 .film-checkbox');
    const animeCheckboxes = document.querySelectorAll('#tabPanel-2 .anime-checkbox');
    const textarea = document.querySelector('.commentaire textarea');
    const loadingIndicator = document.getElementById('loading');

    submitButton.addEventListener('click', async function(event) {
        // Empêche le comportement par défaut du bouton
        event.preventDefault();

        // Désactiver le bouton et afficher l'indicateur de chargement
        submitButton.disabled = true;
        sn.style.display = 'none';
        loadingIndicator.style.display = 'inline';

        // Vérifie si le champ path est présent
        if (!pathInput.value) {
            alert('Le chemin du fichier est requis.');
            submitButton.disabled = false;
            sn.style.display = 'inline';
            loadingIndicator.style.display = 'none';
            return;
        }

        // Vérifie si au moins une checkbox est sélectionnée dans tabPanel-1 ou tabPanel-2
        const isFilmChecked = Array.from(filmCheckboxes).some(checkbox => checkbox.checked);
        const isAnimeChecked = Array.from(animeCheckboxes).some(checkbox => checkbox.checked);

        if (!isFilmChecked && !isAnimeChecked) {
            alert('Vous devez sélectionner au moins une catégorie dans les films ou les animes.');
            submitButton.disabled = false;
            sn.style.display = 'inline';
            loadingIndicator.style.display = 'none';
            return;
        }

        // Préparer les données à envoyer
        const categories = [];
        if (isFilmChecked) {
            categories.push(...Array.from(filmCheckboxes).filter(checkbox => checkbox.checked).map(checkbox => checkbox.value));
        }
        if (isAnimeChecked) {
            categories.push(...Array.from(animeCheckboxes).filter(checkbox => checkbox.checked).map(checkbox => checkbox.value));
        }

        const formData = new FormData();
        formData.append('path', pathInput.value);
        formData.append('description', textarea.value || '');
        formData.append('categories', categories.join(','));
        formData.append('type', isFilmChecked ? 'film' : 'anime');

        // Récupérer le paramètre `prec` de l'URL
        const urlParams = new URLSearchParams(window.location.search);
            const prec = urlParams.get('prec');
        try {
            const response = await fetch('makeshort.php', {
                method: 'POST',
                body: formData
            });

            if (response.ok) {
                const result = await response.text();
                alert(result);
                      // Redirection en fonction de la présence de `prec`
              if (prec) {
                window.location.href = decodeURIComponent(prec);
              } else {
                window.location.href = 'index.php';
              }

            } else {
                alert('Erreur lors de l\'envoi des données.');
            }
        } catch (error) {
            console.error('Erreur:', error);
            alert('Erreur lors de l\'envoi des données.');
        } finally {
            // Réactiver le bouton et cacher l'indicateur de chargement
            submitButton.disabled = false;
            sn.style.display = 'inline';
            loadingIndicator.style.display = 'none';
        }
    });
});





function isAnyCheckboxCheckedInTabPanels() {
    // Sélectionne toutes les checkboxes dans tabPanel-1
    const checkboxesfilm = document.querySelectorAll('#tabPanel-1 .film-checkbox');
    const checkboxesanime = document.querySelectorAll('#tabPanel-2 .anime-checkbox');

    // Vérifie si au moins une checkbox est sélectionnée dans tabPanel-1
    const isCheckedf = Array.from(checkboxesfilm).some(checkbox => checkbox.checked);

    // Vérifie si au moins une checkbox est sélectionnée dans tabPanel-2
    const isCheckeda = Array.from(checkboxesanime).some(checkbox => checkbox.checked);
    
    // Retourne un objet avec les deux résultats
    return {
        isFilmChecked: isCheckedf,
        isAnimeChecked: isCheckeda
    };
}


    const tabsContainer = document.querySelector("[role=tablist]");
const tabButtons = tabsContainer.querySelectorAll("[role=tab]");
const tabPanels = document.querySelectorAll("[role=tabpanel]");
const tab_Panels = document.querySelector(".tab-panels");

tabsContainer.addEventListener("click", (e) => {
  const clickedTab = e.target.closest("span");
  const currentTab = tabsContainer.querySelector('[aria-selected="true"]');

  if (!clickedTab || clickedTab === currentTab) return;

  
   // Utilisation de la fonction
const { isFilmChecked, isAnimeChecked } = isAnyCheckboxCheckedInTabPanels();
if (isFilmChecked) {

} else if (isAnimeChecked) {

} else {
  switchTab(clickedTab);
}
    
});

tabsContainer.addEventListener("keydown", (e) => {
  switch (e.key) {
    case "ArrowLeft":
      moveLeft();
      break;
    case "ArrowRight":
      moveRight();
      break;
    case "Home":
      e.preventDefault();
      switchTab(tabButtons[0]);
      break;
    case "End":
      e.preventDefault();
      switchTab(tabButtons[tabButtons.length - 1]);
      break;
  }
});

function moveLeft() {
  const currentTab = document.activeElement;

  if (!currentTab.previousElementSibling) {
    tabButtons.item(tabButtons.length - 1).focus();
  } else {
    currentTab.previousElementSibling.focus();
  }
}

function moveRight() {
  const currentTab = document.activeElement;
  if (!currentTab.nextElementSibling) {
    tabButtons.item(0).focus();
  } else {
    currentTab.nextElementSibling.focus();
  }
}

function switchTab(newTab) {
  const oldTab = tabsContainer.querySelector('[aria-selected="true"]');
  const activePanelId = newTab.getAttribute("aria-controls");
  const activePanel = tab_Panels.querySelector('[id='+activePanelId+']');
  tabButtons.forEach((button) => {
    button.setAttribute("aria-selected", false);
    button.setAttribute("tabindex", "-1");
  });

  // Utilisation de la fonction
  tabPanels.forEach((panel) => {
    panel.style.display='none';
  });
    activePanel.style.display='block';





  
  newTab.setAttribute("aria-selected", true);
  newTab.setAttribute("tabindex", "0");
  
  
  moveIndicator(oldTab, newTab);
}

// move underline indicator
function moveIndicator(oldTab, newTab) {
  const newTabPosition = oldTab.compareDocumentPosition(newTab);
  const newTabWidth = newTab.offsetWidth / tabsContainer.offsetWidth;
  let transitionWidth;

  // if the new tab is to the right
  if (newTabPosition === 4) {
    transitionWidth =
      newTab.offsetLeft + newTab.offsetWidth - oldTab.offsetLeft;
  } else {
    // if the tab is to the left
    transitionWidth =
      oldTab.offsetLeft + oldTab.offsetWidth - newTab.offsetLeft;
    tabsContainer.style.setProperty("--_left", newTab.offsetLeft + "px");
  }

  tabsContainer.style.setProperty(
    "--_width",
    transitionWidth / tabsContainer.offsetWidth
  );

  setTimeout(() => {
    tabsContainer.style.setProperty("--_left", newTab.offsetLeft + "px");
    tabsContainer.style.setProperty("--_width", newTabWidth);
  }, 220);
}
</script>
  <script src="anime.js"></script>
  <script src="main.js"></script>
</body>

</html>