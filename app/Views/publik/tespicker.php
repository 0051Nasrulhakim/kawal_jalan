<!DOCTYPE html>
<html>
<head>
    <title>Koordinat Picker dengan Leaflet</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <style>
        #map {
            height: 500px;
            width: 100%;
        }
    </style>
</head>
<body>
    <h1>Koordinat Picker dengan Leaflet</h1>
    <div id="map"></div>
    <p>Koordinat: <span id="coordinates">Klik pada peta untuk mendapatkan koordinat</span></p>
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script>
        // Inisialisasi peta
        var map = L.map('map').setView([-6.1754, 106.8272], 13);

        // Tambahkan tile layer dari OpenStreetMap
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        // Buat marker kosong
        var marker;

        // Event listener untuk mendapatkan koordinat saat peta diklik
        function onMapClick(e) {
            var coord = e.latlng;
            var lat = coord.lat;
            var lng = coord.lng;
            document.getElementById("coordinates").innerHTML = "Lat: " + lat + ", Lng: " + lng;

            // Jika marker belum ada, buat marker baru
            if (!marker) {
                marker = L.marker([lat, lng]).addTo(map);
            } else {
                // Jika marker sudah ada, pindahkan marker ke lokasi baru
                marker.setLatLng([lat, lng]);
            }
            
            // Perbarui popup marker
            marker.bindPopup("Koordinat: " + lat + ", " + lng).openPopup();
        }

        map.on('click', onMapClick);
    </script>
</body>
</html>
