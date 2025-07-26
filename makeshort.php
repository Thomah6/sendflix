<?php
require('conn.php');
session_start();

$ffmpegPath = __DIR__ . "/ffmpeg/bin/ffmpeg";

// Vérifiez et récupérez les données POST
$path = $_POST['path'] ?? '';
$description = $_POST['description'] ?? '';
$categories = $_POST['categories'] ?? '';
$type = $_POST['type'] ?? '';

// Validation des entrées
if (empty($path) || empty($type)) {
    echo 'Missing file path or video type.';
    exit;
}

// Déterminez le chemin du fichier
$targetFile = __DIR__ . '/brouillon/' . basename($path);
$targetDir = __DIR__ . '/shorts/';
$originalFileName = basename($path);

// Vérifiez si le fichier existe
if (!file_exists($targetFile)) {
    echo "File does not exist: " . $targetFile;
    exit;
}

// Générez un nom de fichier unique pour la vidéo courte
$uniqueId = uniqid();
$extension = pathinfo($originalFileName, PATHINFO_EXTENSION);
$outputFileName = "output_{$uniqueId}.$extension";
$outputFile = $targetDir . $outputFileName;

// Obtenez la durée de la vidéo
$commandGetDuration = "$ffmpegPath -i " . escapeshellarg($targetFile) . " 2>&1";
$output = shell_exec($commandGetDuration);
preg_match('/Duration: (\d+):(\d+):(\d+\.\d+)/', $output, $matches);
if (!isset($matches[3])) {
    echo "Error retrieving video duration: " . $output;
    exit;
}
$hours = $matches[1];
$minutes = $matches[2];
$seconds = $matches[3];
$totalSeconds = ($hours * 3600) + ($minutes * 60) + $seconds;

// Calculez le point de départ (milieu de la vidéo moins 30 secondes)
$startTime = $totalSeconds / 2 - 30;
if ($startTime < 0) {
    $startTime = 0;
}

// Appelez FFmpeg pour extraire 60 secondes de la vidéo
$command = "$ffmpegPath -i " . escapeshellarg($targetFile) . " -ss $startTime -t 60 -c copy " . escapeshellarg($outputFile) . " 2>&1";
$output = shell_exec($command);

// Générez une miniature
$out = "couvertures/";
$outputThumbnail = $out . uniqid() . '.jpg';
$cmd = "$ffmpegPath -i " . escapeshellarg($targetFile) . " -ss 00:00:08 -vframes 1 " . escapeshellarg($outputThumbnail) . " 2>&1";
exec($cmd, $out, $return);

if ($return !== 0) {
    echo 'Error generating thumbnail.';
} else {
    // Obtenez le chemin relatif du fichier extrait
    $relativeOutputFile = 'shorts/' . $outputFileName;

    if (file_exists($outputFile)) {
        // Sauvegardez les données dans la base de données
        $userId = $_SESSION['id'] ?? 1; // Assurez-vous que la session utilisateur est définie
        $stmtt = $pdo->prepare("DELETE FROM brouillon WHERE link = :path AND user = :userId");
        $stmtt->execute(['path' => $path, 'userId' => $userId]);
        // unlink($targetFile); // Décommentez cette ligne si vous souhaitez supprimer le brouillon

        $stmt = $pdo->prepare("INSERT INTO solo (titre, description, user_id, categories, full, short, couv, type) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $result = $stmt->execute([
            $originalFileName,
            $description,
            $userId,
            $categories,
            $path,
            $relativeOutputFile,
            $outputThumbnail,
            $type
        ]);

        if ($result) {
            echo "The video has been processed and successfully saved.";
        } else {
            echo "Error saving data to the database.";
        }
    } else {
        echo "Error processing the video: " . $output;
    }
}
?>
