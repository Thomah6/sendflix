<?php
require('conn.php');
session_start();
if(isset($_SESSION['id'])){
  $userid=$_SESSION['id'];
  $username=$_SESSION['username'];
  $profil=$_SESSION['profil'];

}else{
  header('Location:auth/step1.php');
}?>
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
  <script src="9f37ddf547.js"></script>
  <title>Sendflix- Social Movie Networking App</title>
  <style>
    
[role=tablist] {
  position: relative;
  display: flex;
  width: -webkit-fit-content;
  width: -moz-fit-content;
  width: 100%;
  border-bottom: 1px solid #4d4d4d;
  margin-block: 1rem;
}



[role=tab] {
  color: #fff;
  background: rgb(219, 38, 38);
  background: transparent;
  width:90px;padding: 20px 0px;
  border: 0;
  font: inherit;text-align: center;
  font-weight: 500;
  opacity: 0.7;
  cursor: pointer;
}

[role=tab]:hover {
  opacity: 1;transition: all .4s;border-bottom: 4px;

}

[role=tab][aria-selected=true] {
  opacity: 1;border-bottom: 4px solid white;transition: all .4s;
}
  </style>
</head>

<body>
<nav class="sidebar close">
        <header>
            <div class="image-text">
                <span class="image">
                    <img src="auth/images/logo.jpg" alt="">
                </span>

                <div class="text logo-text">
                    <span class="name">SendFlix</span>
                </div>
            </div>

            <i class='ri ri-arrow-right-s-line toggle'></i>
        </header>

        <div class="menu-bar">
            <div class="menu">

                <li class="search-box">
                    <i class='ri ri-search-eye-line icon'></i>
                    <input type="text" placeholder="Search...">
                </li>

                <ul class="menu-links">
                    <li class="nav-link" >
                        <a href="index.php" >
                            <i class='ri ri-fire-line icon' ></i>
                            <span class="text nav-text">Explore</span>
                        </a>
                    </li>

                    <li class="nav-link " >
                        <a href="#" data-pec="profil.php" onclick="add(this.getAttribute('data-pec'))" style="position: relative;">
                            <i class='ri ri-add-circle-line icon' ></i>
                            <svg id="progress-circle1" width="40" height="40">
        <circle cx="30" cy="30" r="20" stroke="#ccc" stroke-width="3" fill="none"/>
        <circle id="progress-bar1" cx="25" cy="30" r="20" stroke="#00D4FF" stroke-width="3" fill="none" stroke-dasharray="169.65" stroke-dashoffset="169.65"/>
    </svg>
                            <span class="text nav-text">Share</span>
                        </a>
                    </li>

                    <li class="nav-link " >
                        <a href="#" >
                            <i class='bx bx-message-square-dots icon' ></i>
                            <span class="text nav-text">Share</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="#">
                            <i class='bx bx-bell icon'></i>
                            <span class="text nav-text">Notifications</span>
                        </a>
                    </li>

                    

                    <li class="nav-link">
                        <a href="profil.php" class="active">
                            <i class=' icon' >
                            
                            <img src="auth/<?=$profil?>" style="border-radius: 50%; width: 25px;height:25px;border:1px solid #8E919A;">
        
                            </i>
                            <span class="text nav-text">Profil</span>
                        </a>
                    </li>

                </ul>
            </div>

            <div class="bottom-content">
                <li class="">
                    <a href="#">
                        <i class='bx bx-log-out icon' ></i>
                        <span class="text nav-text">Logout</span>
                    </a>
                </li>

                
                
            </div>
        </div>

    </nav>

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
        <a href="index.php" style="text-decoration: none;color:white;">
            <div class="icon ">
              <i class="ri ri-fire-fill"></i>
            </div>
         </a>
      
      <div class="icon">
        <i style="font-size:25px;" class="ri ri-search-eye-fill"></i>
      </div>

      <div class="icon" id="upload-container">
    <i data-pec="profil.php" onclick="add(this.getAttribute('data-pec'))" id="upc" style="font-size:50px;color: #ffffff;" class="bx bxs-plus-square"></i>
    <svg id="progress-circle" width="60" height="60">
        <circle cx="30" cy="30" r="25" stroke="#ccc" stroke-width="3" fill="none"/>
        <circle id="progress-bar" cx="30" cy="30" r="25" stroke="#00D4FF" stroke-width="3" fill="none" stroke-dasharray="169.65" stroke-dashoffset="169.65"/>
    </svg>
</div>
      

      <div class="icon">
        <i class="bx bxs-message-square-dots"></i>
      </div>

      <a href="profil.php" style="text-decoration: none;">
      <div class="icon active">
        <i>
          <img src="images/profile2.jpg" style="border-radius: 50%; width: 25px;height:25px;border:1px solid #8E919A;">
        </i>        
      </div>
    </a>

    </div>
    
  </section>
<section class="corps_profil">

  <section class="head">
    
    <div style="position: relative;height:270px;">
        <div style="background:url('images/-5911275789994690585_1109.jpg');backdrop-filter:blur(4px);height:200px;border-radius:0px;padding-top:10px;">
          
        </div>
        <div style="background: rgba(255, 255, 255, 0.2);backdrop-filter: blur(2.5px);border-radius:0px;width:100%;height:200PX;position: absolute;top:0;">
          <div style="display:flex;position: absolute;bottom:-70px;left:10%;">
            <div style="width:100px;height:100px;border-radius:50%;border:4px solid #242C39;">
              <div style=" width:100%;height:100%;border-radius:50%;overflow: hidden;border:4px solid #ffffff;"><img style="width: 100%;height:100%;object-fit: cover;" src="auth/<?=$profil?>"></div>
            </div>
            <div style="line-height:80px;overflow:hidden;text-overflow:ellipsis;align-items: center;justify-content: center; width:200px;background-color: none;padding:10px;color:white;font-family:'Quesha';font-size:40px;"><span>@<?=$username?></span></div>

          </div>
        </div>

    </div>

    <div class="gy">
      <div class="gt">

        <ul style="font-family:'Quesha';font-size:20px;justify-items: center;width:100%;list-style: none;display: flex;">
              <li style="border-right:1px solid rgba(79, 79, 82, 0.4);text-align: center; width:25%;">
                  <h5 class="stat">15</h5>
                  <span class="titl">Posts</span>
              </li>
              <li style="text-align: center; width:25%;border-right:1px solid rgba(79, 79, 82, 0.4);">
                  <h5 class="stat">115</h5>
                  <span class="titl">Following</span>
              </li>
              <li style="text-align: center; width:25%;border-right:1px solid rgba(79, 79, 82, 0.4);">
                  <h5 class="stat">3.6M</h5>
                  <span class="titl">Followers</span>
              </li>
              <li style="text-align: center; width:25%">
                  <h5 class="stat">9.7M</h5>
                  <span class="titl">Likes</span>
              </li>
        </ul>
      </div>
     
        <div class="cta">
          <button style="cursor:pointer;width:calc(100% - 65px);border-radius:10px;padding:10px 20px;background-color:#a418f554 ;color:rgb(255, 255, 255);outline:none;border:1px solid #a418f5;font-size:17px;">Edit profil</button>
          <button style="cursor:pointer;border-radius:10px;padding:10px 20px;background-color:white ;color:black;outline:none;border:none;font-size:17px;"><i class="ri ri-user-add-line"></i></button>
        </div>
      
    </div>

    
    <div class="bio">Developper & graphic designer </div>

  </section>

  
  <section class="bod">
    <div role="tablist" aria-labelledby="channel-name">
      <button id="tab-1" role="tab" aria-controls="tabPanel-1" aria-selected="true" tabindex="0">Shorts
      </button>
      <button id="tab-2" role="tab" aria-controls="tabPanel-2" aria-selected="false" tabindex="-1">Full videos
      </button>
      <button id="tab-3" role="tab" aria-controls="tabPanel-3" aria-selected="false" tabindex="-1">Watchlist
      </button>
      <button id="tab-4" role="tab" aria-controls="tabPanel-4" aria-selected="false" tabindex="-1">About
      </button>
      
    </div>
    <div class="tab-panels">
      <div class="fen active" id="tabPanel-1" role="tabpanel" tabindex="0" aria-labelledby="tab-1">

        <?php
        $fr=$pdo->query("SELECT * FROM solo WHERE user_id='$userid' ORDER BY id DESC");
        while($frr=$fr->fetch()){
          

          }
        ?>
        <div class="ele">
          <div class="elv" style="position: relative;"><video onclick="videocli(this)" class="short"  src="videos/_@MangaFilmCrunchyroll_WIND_BREAKER_E13_S1_VOSTFR_🔚🔚🔚.mp4"  loop></video>
            <div class="content">
              
              <span  class="desc">
                "Actually, the best gift you could have given her was a lifetime or adventures" Alice in Wonderland - I've always loved this quote. what's your favourite quote?
              </span>
              <div class="tags">
                <span>#party</span>
                <span>#colorful</span>
              </div>
              <div class="footer">
                <div class="like">
                  <i class="bx bxs-heart"></i>
                  <span>12k</span>
                </div>
                <div class="comment">
                  <i class="bx bxs-message-rounded-dots"></i>
                  <span>12k</span>
                </div>
                <div class="share">
                  <i class="bx bxs-share-alt"></i>
                  <span>12k</span>
                </div>
                
              </div>
            </div>
          </div>
        </div>
  
        <!-----element-->
  
        <div class="ele">
          <div class="elv" style="position: relative;"><video onclick="videocli(this)" class="short" src="videos/_@MangaFilmCrunchyroll_WIND_BREAKER_E08_S1_VOSTFR_CONVERTIE.mp4"  loop></video>
              <div class="content">
              
              <span  class="desc">
                "Actually, the best gift you could have given her was a lifetime or adventures" Alice in Wonderland - I've always loved this quote. what's your favourite quote?
              </span>
              <div class="tags">
                <span>#party</span>
                <span>#colorful</span>
              </div>
              <div class="footer">
                <div class="like">
                  <i class="bx bxs-heart"></i>
                  <span>12k</span>
                </div>
                <div class="comment">
                  <i class="bx bxs-message-rounded-dots"></i>
                  <span>12k</span>
                </div>
                <div class="share">
                  <i class="bx bxs-share-alt"></i>
                  <span>12k</span>
                </div>
                
              </div>
            </div>
          </div>
        </div>
  
        <!-----element-->
  
        <div class="ele">
          <div class="elv" style="position: relative;"><video onclick="videocli(this)" class="short"  src="videos/[@Watch_Animes] The Grimm Variation - 04 VOSTFR.mp4"  loop></video>
            <div class="content">
              
              <span  class="desc">
                "Actually, the best gift you could have given her was a lifetime or adventures" Alice in Wonderland - I've always loved this quote. what's your favourite quote?
              </span>
              <div class="tags">
                <span>#party</span>
                <span>#colorful</span>
              </div>
              <div class="footer">
                <div class="like">
                  <i class="bx bxs-heart"></i>
                  <span>12k</span>
                </div>
                <div class="comment">
                  <i class="bx bxs-message-rounded-dots"></i>
                  <span>12k</span>
                </div>
                <div class="share">
                  <i class="bx bxs-share-alt"></i>
                  <span>12k</span>
                </div>
                
              </div>
            </div>
          </div>
        </div>
      </div>
  
      <div class="fen" id="tabPanel-2"  role="tabpanel" tabindex="0" aria-labelledby="tab-2">
        <div class="ele">
          <div class="elv" style="position: relative;"><video onclick="videocli(this)" class="short"  src="videos/_@MangaFilmCrunchyroll_WIND_BREAKER_E13_S1_VOSTFR_🔚🔚🔚.mp4"  loop></video>
            <div class="content">
              
              <span  class="desc">
                "Actually, the best gift you could have given her was a lifetime or adventures" Alice in Wonderland - I've always loved this quote. what's your favourite quote?
              </span>
              <div class="tags">
                <span>#party</span>
                <span>#colorful</span>
              </div>
              <div class="footer">
                <div class="like">
                  <i class="bx bxs-heart"></i>
                  <span>12k</span>
                </div>
                <div class="comment">
                  <i class="bx bxs-message-rounded-dots"></i>
                  <span>12k</span>
                </div>
                <div class="share">
                  <i class="bx bxs-share-alt"></i>
                  <span>12k</span>
                </div>
                
              </div>
            </div>
          </div>
        </div>
  
        <!-----element-->
  
        <div class="ele">
          <div class="elv" style="position: relative;"><video onclick="videocli(this)" class="short" src="videos/_@MangaFilmCrunchyroll_WIND_BREAKER_E08_S1_VOSTFR_CONVERTIE.mp4"  loop></video>
              <div class="content">
              
              <span  class="desc">
                "Actually, the best gift you could have given her was a lifetime or adventures" Alice in Wonderland - I've always loved this quote. what's your favourite quote?
              </span>
              <div class="tags">
                <span>#party</span>
                <span>#colorful</span>
              </div>
              <div class="footer">
                <div class="like">
                  <i class="bx bxs-heart"></i>
                  <span>12k</span>
                </div>
                <div class="comment">
                  <i class="bx bxs-message-rounded-dots"></i>
                  <span>12k</span>
                </div>
                <div class="share">
                  <i class="bx bxs-share-alt"></i>
                  <span>12k</span>
                </div>
                
              </div>
            </div>
          </div>
        </div>
  
        <!-----element-->
  
        <div class="ele">
          <div class="elv" style="position: relative;"><video onclick="videocli(this)" class="short"  src="videos/[@Watch_Animes] The Grimm Variation - 04 VOSTFR.mp4"  loop></video>
            <div class="content">
              
              <span  class="desc">
                "Actually, the best gift you could have given her was a lifetime or adventures" Alice in Wonderland - I've always loved this quote. what's your favourite quote?
              </span>
              <div class="tags">
                <span>#party</span>
                <span>#colorful</span>
              </div>
              <div class="footer">
                <div class="like">
                  <i class="bx bxs-heart"></i>
                  <span>12k</span>
                </div>
                <div class="comment">
                  <i class="bx bxs-message-rounded-dots"></i>
                  <span>12k</span>
                </div>
                <div class="share">
                  <i class="bx bxs-share-alt"></i>
                  <span>12k</span>
                </div>
                
              </div>
            </div>
          </div>
        </div>
      </div>
  
      <div class="fen" id="tabPanel-3"  role="tabpanel" tabindex="0" aria-labelledby="tab-3">
        <div class="ele">
          <div class="elv" style="position: relative;"><video onclick="videocli(this)" class="short"  src="videos/_@MangaFilmCrunchyroll_WIND_BREAKER_E13_S1_VOSTFR_🔚🔚🔚.mp4"  loop></video>
            <div class="content">
              
              <span  class="desc">
                "Actually, the best gift you could have given her was a lifetime or adventures" Alice in Wonderland - I've always loved this quote. what's your favourite quote?
              </span>
              <div class="tags">
                <span>#party</span>
                <span>#colorful</span>
              </div>
              <div class="footer">
                <div class="like">
                  <i class="bx bxs-heart"></i>
                  <span>12k</span>
                </div>
                <div class="comment">
                  <i class="bx bxs-message-rounded-dots"></i>
                  <span>12k</span>
                </div>
                <div class="share">
                  <i class="bx bxs-share-alt"></i>
                  <span>12k</span>
                </div>
                
              </div>
            </div>
          </div>
        </div>
  
        <!-----element-->
  
        <div class="ele">
          <div class="elv" style="position: relative;"><video onclick="videocli(this)" class="short" src="videos/_@MangaFilmCrunchyroll_WIND_BREAKER_E08_S1_VOSTFR_CONVERTIE.mp4"  loop></video>
              <div class="content">
              
              <span  class="desc">
                "Actually, the best gift you could have given her was a lifetime or adventures" Alice in Wonderland - I've always loved this quote. what's your favourite quote?
              </span>
              <div class="tags">
                <span>#party</span>
                <span>#colorful</span>
              </div>
              <div class="footer">
                <div class="like">
                  <i class="bx bxs-heart"></i>
                  <span>12k</span>
                </div>
                <div class="comment">
                  <i class="bx bxs-message-rounded-dots"></i>
                  <span>12k</span>
                </div>
                <div class="share">
                  <i class="bx bxs-share-alt"></i>
                  <span>12k</span>
                </div>
                
              </div>
            </div>
          </div>
        </div>
  
        <!-----element-->
  
        <div class="ele">
          <div class="elv" style="position: relative;"><video onclick="videocli(this)" class="short"  src="videos/[@Watch_Animes] The Grimm Variation - 04 VOSTFR.mp4"  loop></video>
            <div class="content">
              
              <span  class="desc">
                "Actually, the best gift you could have given her was a lifetime or adventures" Alice in Wonderland - I've always loved this quote. what's your favourite quote?
              </span>
              <div class="tags">
                <span>#party</span>
                <span>#colorful</span>
              </div>
              <div class="footer">
                <div class="like">
                  <i class="bx bxs-heart"></i>
                  <span>12k</span>
                </div>
                <div class="comment">
                  <i class="bx bxs-message-rounded-dots"></i>
                  <span>12k</span>
                </div>
                <div class="share">
                  <i class="bx bxs-share-alt"></i>
                  <span>12k</span>
                </div>
                
              </div>
            </div>
          </div>
        </div>
      </div>
  
      <div class="fen" id="tabPanel-4"  role="tabpanel" tabindex="0" aria-labelledby="tab-4">
        <div class="ele">
          <div class="elv" style="position: relative;"><video onclick="videocli(this)" class="short"  src="videos/_@MangaFilmCrunchyroll_WIND_BREAKER_E13_S1_VOSTFR_🔚🔚🔚.mp4"  loop></video>
            <div class="content">
              
              <span  class="desc">
                "Actually, the best gift you could have given her was a lifetime or adventures" Alice in Wonderland - I've always loved this quote. what's your favourite quote?
              </span>
              <div class="tags">
                <span>#party</span>
                <span>#colorful</span>
              </div>
              <div class="footer">
                <div class="like">
                  <i class="bx bxs-heart"></i>
                  <span>12k</span>
                </div>
                <div class="comment">
                  <i class="bx bxs-message-rounded-dots"></i>
                  <span>12k</span>
                </div>
                <div class="share">
                  <i class="bx bxs-share-alt"></i>
                  <span>12k</span>
                </div>
                
              </div>
            </div>
          </div>
        </div>
  
        <!-----element-->
  
        <div class="ele">
          <div class="elv" style="position: relative;"><video onclick="videocli(this)" class="short" src="videos/_@MangaFilmCrunchyroll_WIND_BREAKER_E08_S1_VOSTFR_CONVERTIE.mp4"  loop></video>
              <div class="content">
              
              <span  class="desc">
                "Actually, the best gift you could have given her was a lifetime or adventures" Alice in Wonderland - I've always loved this quote. what's your favourite quote?
              </span>
              <div class="tags">
                <span>#party</span>
                <span>#colorful</span>
              </div>
              <div class="footer">
                <div class="like">
                  <i class="bx bxs-heart"></i>
                  <span>12k</span>
                </div>
                <div class="comment">
                  <i class="bx bxs-message-rounded-dots"></i>
                  <span>12k</span>
                </div>
                <div class="share">
                  <i class="bx bxs-share-alt"></i>
                  <span>12k</span>
                </div>
                
              </div>
            </div>
          </div>
        </div>
  
        <!-----element-->
  
        <div class="ele">
          <div class="elv" style="position: relative;"><video onclick="videocli(this)" class="short"  src="videos/[@Watch_Animes] The Grimm Variation - 04 VOSTFR.mp4"  loop></video>
            <div class="content">
              
              <span  class="desc">
                "Actually, the best gift you could have given her was a lifetime or adventures" Alice in Wonderland - I've always loved this quote. what's your favourite quote?
              </span>
              <div class="tags">
                <span>#party</span>
                <span>#colorful</span>
              </div>
              <div class="footer">
                <div class="like">
                  <i class="bx bxs-heart"></i>
                  <span>12k</span>
                </div>
                <div class="comment">
                  <i class="bx bxs-message-rounded-dots"></i>
                  <span>12k</span>
                </div>
                <div class="share">
                  <i class="bx bxs-share-alt"></i>
                  <span>12k</span>
                </div>
                
              </div>
            </div>
          </div>
        </div>

      </div>
  
      
    </div>

    

    </div>
  </section>


  <section class="newsfeed">
    
  
  </section>

  

</section>

  


  <form action="add.php" method="post" id="movie-form1" style="display:none;" enctype="multipart/form-data">
        <input type="file" id="movie" name="movie" accept="video/*" style="display: none;">
      </form>
  <div class="space"></div>
  

<script>
const tabsContainer = document.querySelector("[role=tablist]");
const tabButtons = tabsContainer.querySelectorAll("[role=tab]");
const tabPanels = document.querySelectorAll("[role=tabpanel]");

tabsContainer.addEventListener("click", (e) => {
  const clickedTab = e.target.closest("button");
  const currentTab = tabsContainer.querySelector('[aria-selected="true"]');

  if (!clickedTab || clickedTab === currentTab) return;

  switchTab(clickedTab);
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
  const activePanel = tabsContainer.nextElementSibling.querySelector(
    "#" + CSS.escape(activePanelId)
  );
  tabButtons.forEach((button) => {
    button.setAttribute("aria-selected", false);
    button.setAttribute("tabindex", "-1");
  });

  tabPanels.forEach((panel) => {
    panel.style.display='none';
  });

  if(window.innerWidth<700){
    activePanel.style.display='block';

  }else{
    activePanel.style.display='grid';

  }
  
  newTab.setAttribute("aria-selected", true);
  newTab.setAttribute("tabindex", "0");
  
  newTab.focus();
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
function openTab(tabName) {

var i;
var tabcontent = document.getElementsByClassName('fen');
var tablinks = document.getElementsByClassName('tab');
for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].classList.remove('active');

}
for (i = 0; i < tablinks.length; i++) {
    tablinks[i].classList.remove('active');

}
document.getElementById(tabName).classList.add('active');
document.querySelector('[data-tab="' + tabName + '"]').classList.add('active');
localStorage.setItem('activeTab', tabName);


};
</script>
  <script src="anime.js"></script>
  <script src="main.js"></script>
</body>

</html>