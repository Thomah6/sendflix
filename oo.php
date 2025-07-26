<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réduire la taille d'une vidéo</title>
</head>
<body>
    <h2>Téléchargez une vidéo et réduisez-la</h2>
    
    <?php
    // Vérifie si un fichier a été téléchargé
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['videoFile'])) {
        // Chemin temporaire du fichier téléchargé
        $tmpFilePath = $_FILES['videoFile']['tmp_name'];
        
        // Nom du fichier d'entrée
        $inputFileName = $_FILES['videoFile']['name'];
        
        // Dossier de destination pour sauvegarder le fichier téléchargé
        $uploadDir = 'uploads/';
        $uploadedFilePath = $uploadDir . $inputFileName;
        
        // Déplace le fichier téléchargé vers le dossier d'uploads
        if (move_uploaded_file($tmpFilePath, $uploadedFilePath)) {
            // Chemin vers l'exécutable FFmpeg sur votre serveur
            $ffmpegPath = '/ffmpeg/bin/ffmpeg'; // Mettez le chemin correct vers l'exécutable FFmpeg
            
            // Chemin pour le fichier de sortie réduit
            $outputFileName = 'video_reduite.mp4';
            $outputFilePath = $uploadDir . $outputFileName;
            
            // Commande FFmpeg pour réduire la taille de la vidéo tout en maintenant une qualité raisonnable
            $cmd = "$ffmpegPath -i $uploadedFilePath -vf scale=iw*0.8:ih*0.8 $outputFilePath";
            
            // Exécute la commande FFmpeg
            exec($cmd, $output, $return_code);
            
            // Vérifie si FFmpeg a réussi à exécuter la commande
            if ($return_code === 0 && file_exists($outputFilePath)) {
                // Téléchargement du fichier réduit
                echo "<h3>Vidéo réduite avec succès ! Téléchargez votre fichier :</h3>";
                echo "<a href='$outputFilePath' download> Télécharger la vidéo réduite </a>";
            } else {
                echo "<p>Erreur lors du traitement de la vidéo avec FFmpeg.</p>";
            }
        } else {
            echo "<p>Erreur lors du déplacement du fichier téléchargé.</p>";
        }
    }
    ?>

    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
        <input type="file" name="videoFile" accept="video/mp4">
        <br><br>
        <button type="submit">Réduire la taille de la vidéo</button>
    </form>
</body>
</html>
