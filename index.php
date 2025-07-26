
<?php
require('conn.php');
session_start();
if(isset($_SESSION['id'])){
  $userid=$_SESSION['id'];
  $profile=$_SESSION['profil'];

}else{
  header('Location:auth/step1.php');
}

function formatSocialDate($date) {
  $now = new DateTime();
  $then = new DateTime($date);
  $diff = $now->diff($then);

  $intervals = [
      'year' => 31536000,
      'month' => 2592000,
      'week' => 604800,
      'day' => 86400,
      'hour' => 3600,
      'minute' => 60,
      'second' => 1,
  ];

  $diffInSeconds = ($now->getTimestamp() - $then->getTimestamp());

  foreach ($intervals as $name => $seconds) {
      if ($diffInSeconds >= $seconds) {
          $value = floor($diffInSeconds / $seconds);
          $formatted = $value . ' ' . $name . ($value > 1 ? 's' : '') . ' ago';
          return $formatted;
      }
  }
}




?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <link rel="shortcut icon" href="auth/images/favicon.ico" type="image/x-icon">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
  
</head>

<body>
  <audio src="bruitages/heart.wav" id="hbruitage" style="display:none;"></audio>
<section id="preloader">
    <div class="loader">
      <div class="inner one"></div>
      <div class="inner two"></div>
      <div class="inner three"></div>
    </div>
  </section>
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
                        <a href="#" class="active">
                            <i class='ri ri-fire-line icon' ></i>
                            <span class="text nav-text">Explore</span>
                        </a>
                    </li>

                    <li class="nav-link " >
                    <a href="#" data-pec="index.php" onclick="add(this.getAttribute('data-pec'))" style="position: relative;">
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
                        <a href="profil.php">
                            <i class=' icon' >
                            
                            <img src="auth/<?=$profile?>" style="border-radius: 50%; width: 25px;height:25px;border:1px solid #8E919A;">
        
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

    <nav class="gamebar close">
    <header>
            <div class="image-text">
                <span class="image">
                    <i class="bx bxs-message-square-dots" style="font-size: 30px;"></i>
                    <span class="name">&nbsp;Discussion</span>

                </span>

                <div class="text logo-text">
                </div>
            </div>

        </header>

        <div style="background:none;margin-top:100px;height:calc(100% - 200px);">

          <div class="conv">
            <div style="margin-bottom:5px;cursor:pointer;background-color: #242C39;border-radius:5px;padding:7px;width:100%;display:flex;">
                <div style="width:50px;height:50px;border-radius:50%;overflow:hidden;">
                    <img src="images/hero-slider-5.jpg" style="object-fit: cover;width:100%;height:100%;">
                </div>
                <div style="margin-left:10px;width:calc(100% - 65px);overflow:hidden;text-overflow:ellipsis;height:50px; justify-content:center;line-height:50px;">
                  Onésime
                </div>
            </div>
             
          </div>
         

          <div style="margin-top: 10px;cursor:pointer;background-color: #242C39;border-radius:5px;padding:7px;width:100%;display:flex;">
              <div style="width:100%;height:50px;border-radius:50%;font-size:30px;color:white;line-height:50px;text-align:center;justify-content:center;">
                  <I class="ri ri-add-line"></I>
              </div>
          </div>

        </div>
    </nav>
    
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

      <div class="icon" id="upload-container">
    <i data-pec="index.php" onclick="add(this.getAttribute('data-pec'))" id="upc" style="font-size:50px;color: #ffffff;" class="bx bxs-plus-square"></i>
    <svg id="progress-circle" width="60" height="60">
        <circle cx="30" cy="30" r="25" stroke="#ccc" stroke-width="3" fill="none"/>
        <circle id="progress-bar" cx="30" cy="30" r="25" stroke="#00D4FF" stroke-width="3" fill="none" stroke-dasharray="169.65" stroke-dashoffset="169.65"/>
    </svg>
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
<section class="corps">
<section class="live">

    <div class="person live-active">
      <div class="profile-pic"><img style="width: 100%;border-radius:50%;height:100%;object-fit: cover;" src="auth/<?=$profile?>"> </div>
      <p class="name">You</p>
      <span><i class="bx bxs-circle"></i> Actif</span>
    </div>
    <div class="person">
      <div class="profile-pic"><img style="width: 100%;border-radius:50%;height:100%;object-fit: cover;" src="images/profile3.jpg"> </div>
      <p class="name">Miranda</p>
    </div>
    <div class="person">
      <div class="profile-pic"><img style="width: 100%;border-radius:50%;height:100%;object-fit: cover;" src="images/profile3.jpg"> </div>
      <p class="name">Jack</p>
    </div>
    <div class="person">
      <div class="profile-pic"><img style="width: 100%;border-radius:50%;height:100%;object-fit: cover;" src="images/profile2.jpg"> </div>
      <p class="name">Jimmy</p>
    </div>
    <div class="person">
      <div class="profile-pic"><img style="width: 100%;border-radius:50%;height:100%;object-fit: cover;" src="images/pp.jpg"> </div>
      <p class="name">Alex</p>
    </div>
    <div class="person">
      <div class="profile-pic" ><img style="width: 100%;border-radius:50%;height:100%;object-fit: cover;" src="images/lo.jpg"> </div>
      <p class="name">Anselme</p>
    </div>
    <div class="person">
      <div class="profile-pic"><img style="width: 100%;border-radius:50%;height:100%;object-fit: cover;" src="images/profile2.jpg"> </div>
      <p class="name">Luc</p>
    </div>
    <div class="person">
      <div class="profile-pic"><img style="width: 100%;border-radius:50%;height:100%;object-fit: cover;" src="images/profile3.jpg"> </div>
      <p class="name">Oliver</p>
    </div>
  </section>

  <section class="newsfeed">
    
    <div class="cards-container">
      <?php
      $fr=$pdo->query("SELECT * FROM solo ORDER BY id DESC");
      while($frr=$fr->fetch()){
        $spath=$frr['short'];
        $titre=$frr['titre'];
        $desc=$frr['description'];
        $usid=$frr['user_id'];
        $date=$frr['date'];
        $couv=$frr['couv'];
        
        $pm=$pdo->prepare("SELECT * FROM users WHERE id='$usid'");
        $pm->execute();
        if($pm=$pm->fetch()){
          $username=$pm['username'];
          $profil=$pm['profil'];
        }
        

        ?>

<div class="ccard">
    <div class="card" style="position: relative;">
        <div style="position: relative;">
            <video data-src="<?=$spath?>" poster="<?=$couv?>" onclick="videocli(this)" class="short" preload="none" loop></video>
            <div style="display:none; cursor: pointer;" class="play">
                <img src="auth/images/play.png" style="width: 70px;">
            </div>
            <div class="gift">
                <div id="tooltip" class="tooltip">
                    <ul style="list-style:none;">
                        <li style="margin-bottom: 20px;">
                            <div class="icon-wrapper" style="height:1.5em;">
                                <div style="overflow:hidden;" class="svg-icon icon-heart">
                                    <i class="bi bi-heart ici" style="font-size:30px;"></i>
                                </div>
                            </div>
                        </li>
                        <li style="margin-bottom: 5px;">
                            <!-- Icône Flamme -->
                            <div class="icon-wrapper">
                            <div class="fire">
  <div class="fire-left active">
    <div class="main-fire"></div>
    <div class="particle-fire"></div>
  </div>
  <div class="fire-center active">
    <div class="main-fire"></div>
    <div class="particle-fire"></div>
  </div>
  <div class="fire-right active">
    <div class="main-fire"></div>
    <div class="particle-fire"></div>
  </div>
  <div class="fire-bottom active">
    <div class="main-fire"></div>
  </div>
</div>
                            </div>
                        </li>
                        <li style="margin-top:10px;">
                            <!-- Icône Étoile -->
                            <div class="icon-wrapper">
                            <div class="svg-icon icon-star" >
                            <i class="bi bi-star-fill active" onclick="createStars(event, this)" style="font-size:30px;"></i>
                                </div>


                            </div>
                        </li>
                    </ul>
                </div>
                <i class="bx bxs-gift rainbow-icon" id="tooltipButton"></i>
            </div>
        </div>
        <div class="content">
            <div class="header">
                <div class="profile-pic"><img src="auth/<?=$profil?>"></div>
                <div class="detail">
                    <p class="name"><?=$username?></p>
                    <p class="posted"><?=formatSocialDate($date);?></p>
                </div>
                <div class="detail">
                <p><button style="outline:none;border:none;border-radius:20px;background:#a418f5;color:#ffffff;padding:10px 14px;"><i class="bx bx-plus"></i> S'abonner</button></p>
                </div>
            </div>
            <span class="desc"><?=$desc?></span>
            <div class="tags">
                <span>#party</span>
                <span>#colorful</span>
            </div>
            <div class="footer">
                <div class="comment">
                    <i class="bx bxs-message-alt"></i>
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

<?php
      }
      ?>
      
    


    


  

  </div>
  
  </section>
  
  
</section>

  
  
  <form action="add.php" method="post" id="movie-form1" style="display:none;" enctype="multipart/form-data">
        <input type="file" id="movie" name="movie" accept="video/*" style="display: none;">
      </form>

  
  <div class="space"></div>
<script>
 







</script>
<script src="jquery-3.6.4.min.js"></script>
<script src="anime.js"></script>
<script src="home.js"></script>
<script src="main.js"></script>
</body>

</html>