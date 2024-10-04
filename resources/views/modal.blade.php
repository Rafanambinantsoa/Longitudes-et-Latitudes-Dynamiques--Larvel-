<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css">

    <style>
      #map {
        height: 300px;
        width: 100%;
        border: 1px solid red;
      }
    </style>

    <title>Modal with Map and Kim</title>
  </head>
  <body>
    <h1>Hello, Antsa Bosse!</h1>

    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
      Launch modal
    </button>

    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Map & Form Modal</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="row">
              <!-- Map on the left side -->
              <div class="col-md-6">
                <div id="map"></div>
              </div>
              <!-- Form on the right side -->
              <div class="col-md-6">
                <form>
                  <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="exampleInputEmail1">
                  </div>
                  <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1">
                  </div>
                  <div class="mb-3">
                    <label for="latitude" class="form-label">Latitude</label>
                    <input type="text" class="form-control" id="latitude" readonly>
                  </div>
                  <div class="mb-3">
                    <label for="longitude" class="form-label">Longitude</label>
                    <input type="text" class="form-control" id="longitude" readonly>
                  </div>
                  <button type="submit" class="btn btn-primary">Submit</button>
                </form>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Bootstrap JS and Leaflet JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>

    <script>
      var map, marker;

      // Initialize map when modal is shown
      document.getElementById('staticBackdrop').addEventListener('shown.bs.modal', function () {
        if (!map) {
          // Center the map on Madagascar
          map = L.map('map').setView([-18.8792, 47.5079], 6); // Zoom level set to 6 for better view

          L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
          }).addTo(map);

          // Place the draggable marker at a point in Madagascar
          marker = L.marker([-18.8792, 47.5079], {draggable: true}).addTo(map);

          marker.on('moveend', function () {
            var lat = marker.getLatLng().lat;
            var lng = marker.getLatLng().lng;
            // Update the separate fields for latitude and longitude
            document.getElementById('latitude').value = lat;
            document.getElementById('longitude').value = lng;
          });
        } else {
          // Delay to ensure modal is fully rendered
          setTimeout(function() {
            map.invalidateSize();
          }, 200);
        }
      });
    </script>
  </body>
</html>
