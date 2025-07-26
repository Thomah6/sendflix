<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['video'])) {
    // Définir les chemins
    $uploadDir = "brouillon/";
    $originalFileName = basename($_FILES["video"]["name"]);
    $uploadedFilePath = $uploadDir . $originalFileName;

    // Vérifier et déplacer le fichier téléchargé
    if (move_uploaded_file($_FILES["video"]["tmp_name"], $uploadedFilePath)) {
        echo "Le fichier " . htmlspecialchars($originalFileName) . " a été téléchargé.<br>";

        // Chemin vers l'exécutable FFmpeg
        $ffmpegPath = __DIR__ . "/ffmpeg/bin/ffmpeg";

        // Définir les noms des fichiers
        $uniqueId = uniqid();
        $convertedFileName = "converted_{$uniqueId}.mp4";
        $convertedFilePath = $uploadDir . $convertedFileName;

        // Convertir la vidéo en MP4
        $command = "$ffmpegPath -i " . escapeshellarg($uploadedFilePath) . " -c:v libx264 -c:a aac -pix_fmt yuv420p -movflags faststart -hide_banner " . escapeshellarg($convertedFilePath) . " 2>&1";
        $output = shell_exec($command);

        if (file_exists($convertedFilePath)) {
            echo "La vidéo a été convertie en MP4 et enregistrée sous le nom : " . htmlspecialchars($convertedFileName) . "<br>";
        } else {
            echo "Erreur lors de la conversion de la vidéo : " . nl2br(htmlspecialchars($output));
            exit;
        }

        // Nettoyer le fichier téléchargé si ce n'est plus nécessaire
        unlink($uploadedFilePath);

    } else {
        echo "Erreur lors du téléchargement du fichier.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Upload et Conversion Vidéo</title>
</head>
<body>
    <h2>Upload et Conversion Vidéo</h2>
    <form action="" method="post" enctype="multipart/form-data">
        <label for="video">Sélectionnez une vidéo :</label>
        <input type="file" name="video" id="video" accept="video/*" required>
        <button type="submit">Uploader et Convertir</button>
    </form>
</body>
</html>
