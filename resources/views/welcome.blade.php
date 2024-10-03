<!-- resources/views/map.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leaflet Map</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <style>
        #map {
            height: 400px;
            width: 100%;
        }
        #save-btn {
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div id="map" height="400px" width="400px" ></div>
    <button id="save-btn">Save Location</button>

    <script>
        // Initialiser la carte
        var map = L.map('map').setView([51.505, -0.09], 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '© OpenStreetMap'
        }).addTo(map);

        // Ajouter un marqueur déplaçable
        var marker = L.marker([51.505, -0.09], {draggable: true}).addTo(map);

        // Fonction pour enregistrer la localisation
        function saveLocation() {
            var position = marker.getLatLng();
            var latitude = position.lat;
            var longitude = position.lng;

            // Envoyer les coordonnées à Laravel via Axios
            axios.post('http://localhost:8000/save-coordinates', {
                latitude: latitude,
                longitude: longitude
            })
            .then(function (response) {
                console.log(response);
                alert('Coordinates saved successfully: ' + response.data.latitude + ', ' + response.data.longitude);
            })
            .catch(function (error) {
                console.error('Error saving coordinates:', error);
                alert('Error saving coordinates');
            });
        }

        // Événement au clic du bouton pour sauvegarder la localisation
        document.getElementById('save-btn').addEventListener('click', saveLocation);
    </script>
</body>
</html>
