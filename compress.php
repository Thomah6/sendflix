<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Compression Vidéo Côté Client</title>
</head>
<body>
    <h2>Compression Vidéo Côté Client</h2>
    <input type="file" id="videoFile" accept="video/*">
    <button onclick="compressVideo()">Compresser la vidéo</button>
    <progress id="progressBar" value="0" max="100"></progress>
    <div id="output"></div>

    <script>
        async function compressVideo() {
            const fileInput = document.getElementById('videoFile');
            const file = fileInput.files[0];

            if (!file) {
                alert('Sélectionnez d\'abord une vidéo.');
                return;
            }

            const videoElement = document.createElement('video');
            videoElement.src = URL.createObjectURL(file);
            videoElement.setAttribute('crossorigin', 'anonymous');
            videoElement.setAttribute('playsinline', 'true');
            videoElement.preload = 'auto';

            videoElement.onloadedmetadata = async () => {
                const canvas = document.createElement('canvas');
                canvas.width = videoElement.videoWidth;
                canvas.height = videoElement.videoHeight;

                const context = canvas.getContext('2d');
                context.drawImage(videoElement, 0, 0, canvas.width, canvas.height);

                const quality = 0.5; // Adjust quality here (0.5 means 50% quality)

                // Convert canvas to Blob
                canvas.toBlob(async (blob) => {
                    const compressedBlob = new Blob([blob], { type: 'video/mp4' });

                    const downloadUrl = URL.createObjectURL(compressedBlob);

                    const output = document.getElementById('output');
                    output.innerHTML = `
                        <p>Vidéo compressée avec succès !</p>
                        <p><a href="${downloadUrl}" download>Télécharger la vidéo compressée</a></p>
                    `;
                }, 'video/mp4', quality);
            };

            videoElement.onerror = () => {
                alert('Erreur lors du chargement de la vidéo.');
            };

            videoElement.load();
        }
    </script>
</body>
</html>
