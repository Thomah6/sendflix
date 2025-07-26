<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['video'])) {
    $targetDir = "uploads/";
    $originalFileName = basename($_FILES["video"]["name"]);
    $targetFile = $targetDir . $originalFileName;
    $videoFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Vérifier si le fichier est une vidéo
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mime = finfo_file($finfo, $_FILES["video"]["tmp_name"]);
    finfo_close($finfo);
    if (strpos($mime, 'video') === false) {
        echo "Le fichier n'est pas une vidéo.";
        exit;
    }

    // Vérifier les types de fichiers autorisés
    $allowedTypes = array("mp4", "avi", "mov", "mpeg");
    if (!in_array($videoFileType, $allowedTypes)) {
        echo "Seuls les fichiers MP4, AVI, MOV et MPEG sont autorisés.";
        exit;
    }

    // Télécharger le fichier
    if (move_uploaded_file($_FILES["video"]["tmp_name"], $targetFile)) {
        echo "Le fichier ". htmlspecialchars($originalFileName). " a été téléchargé.";

        // Chemin vers l'exécutable FFmpeg
        $ffmpegPath = __DIR__ . "/ffmpeg/bin/ffmpeg";

        // Obtenir la durée de la vidéo
        $commandGetDuration = "$ffmpegPath -i " . escapeshellarg($targetFile) . " 2>&1";
        $output = shell_exec($commandGetDuration);
        preg_match('/Duration: (\d+):(\d+):(\d+\.\d+)/', $output, $matches);
        if (!isset($matches[3])) {
            echo "Erreur lors de l'obtention de la durée de la vidéo : " . $output;
            exit;
        }
        $hours = $matches[1];
        $minutes = $matches[2];
        $seconds = $matches[3];
        $totalSeconds = ($hours * 3600) + ($minutes * 60) + $seconds;

        // Calculer le point de départ (milieu de la vidéo moins 30 secondes)
        $startTime = $totalSeconds / 2 - 30;
        if ($startTime < 0) {
            $startTime = 0;
        }

        // Appeler FFmpeg pour extraire 60 secondes de la vidéo
        $outputFile = $targetDir . "output_" . $originalFileName;
        $command = "$ffmpegPath -i " . escapeshellarg($targetFile) . " -ss $startTime -t 60 -c copy " . escapeshellarg($outputFile) . " 2>&1";

        // Exécuter la commande et capturer l'erreur
        $output = shell_exec($command);

        if (file_exists($outputFile)) {
            echo "La vidéo a été traitée et enregistrée sous le nom de : " . $outputFile;
        } else {
            echo "Erreur lors du traitement de la vidéo : " . $output;
        }
    } else {
        echo "Désolé, une erreur est survenue lors du téléchargement de votre fichier.";
    }
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Upload et traitement vidéo avec barre de progression</title>
    <link href="https://vjs.zencdn.net/7.11.4/video-js.css" rel="stylesheet" />

    <style>
        .progress {
            width: 50%;
            margin: 20px auto;
            background-color: #f1f1f1;
            border: 1px solid #ccc;
            height: 30px;
            position: relative;
        }
        .progress-bar {
            width: 0;
            height: 100%;
            background-color: #4caf50;
            text-align: center;
            line-height: 30px;
            color: white;
            transition: width 0.1s ease-in;
        }
    </style>
</head>
<body>
    <h2>Upload et traitement vidéo avec barre de progression</h2>
    <form id="uploadForm" action="" method="post" enctype="multipart/form-data">
        <label for="video">Sélectionnez une vidéo :</label>
        <input type="file" name="video" id="video" accept="video/*">
        <button type="submit">Uploader et Traiter</button>
    </form>
    <div class="progress" style="display:none;">
        <div class="progress-bar" id="progressBar">0%</div>
    </div>

    <script>
        document.getElementById('uploadForm').addEventListener('submit', function(event) {
            event.preventDefault();
            
            var form = this;
            var formData = new FormData(form);
            
            var xhr = new XMLHttpRequest();
            xhr.open('POST', form.action, true);

            xhr.upload.onprogress = function(e) {
                if (e.lengthComputable) {
                    var percentComplete = (e.loaded / e.total) * 100;
                    document.getElementById('progressBar').style.width = percentComplete.toFixed(2) + '%';
                    document.getElementById('progressBar').innerHTML = percentComplete.toFixed(2) + '%';
                    document.querySelector('.progress').style.display = 'block';
                }
            };

            xhr.onload = function() {
                if (xhr.status === 200) {
                    var response = xhr.responseText;
                    alert(response);
                } else {
                    alert('Erreur lors du traitement de la requête.');
                }
            };

            xhr.onerror = function() {
                alert('Erreur réseau lors de l\'envoi de la requête.');
            };

            xhr.send(formData);
        });
    </script>
              <video style="width: 100%;height:390px;"  src="shorts/[ OxTorrent.com ] Zombieland.Double.Tap.2019.FRENCH.BDRip.XviD-EXTREME.avi" autoplay="" loop="" controls class="post-video"></video>


              <video id="my-video" class="video-js vjs-default-skin" controls preload="auto" width="640" height="264">
  <source src="shorts/converted_669e5120871a2.mp4" type="video/mp4" />
  <!-- Sources alternatives pour d'autres formats -->
</video>
<script src="https://vjs.zencdn.net/7.11.4/video.min.js"></script>

              <script>
  var player = videojs('my-video');
</script>

</body>
</html>
