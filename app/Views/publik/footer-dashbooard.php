   <div class="footer-clear">

       <div class="footer">
           <div class="wrapper">
               sasasa
           </div>
       </div>
   </div>

   </body>

   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
   <script>
       function getKoordinat() {
           if (navigator.geolocation) {
               var options = {
                   enableHighAccuracy: true,
                   maximumAge: 0,
                   timeout: 15000
               };
               var izin = navigator.geolocation.getCurrentPosition(showPosition, showError, options);
               console.log(izin)
           } else {
               console.log("Geolocation is not supported by this browser.");
           }
       }

       function showError(error) {
           var lokasi = document.getElementById('lokasi')

           switch (error.code) {
               case error.PERMISSION_DENIED:

                   lokasi.innerHTML = "Lokasi Anda tidak terdeteksi, silahkan nyalakan fitur lokasi pada hp / browser";

                   console.log("User denied the request for Geolocation.");
                   break;
               case error.POSITION_UNAVAILABLE:

                   lokasi.innerHTML = "Lokasi Tidak Tersedia";

                   console.log("Location information is unavailable.");
                   break;
               case error.TIMEOUT:

                   lokasi.innerHTML = "Gagal mendapatkan Lokasi silahkan coba beberapa saat lagi";

                   console.log("The request to get user location timed out.");
                   break;
               case error.UNKNOWN_ERROR:
                   console.log("An unknown error occurred.");
                   break;
           }
       }

       function showPosition(position) {

           var latitude = position.coords.latitude;
           var longitude = position.coords.longitude;

           var lat_input = document.getElementById('latInput');
           var lon_input = document.getElementById('lonInput');

           lat_input.value = latitude;
           lon_input.value = longitude;

           var lokasi = document.getElementById('lokasi')

           lokasi.innerHTML = "Latitude: " + latitude + ", Longitude: " + longitude;
           console.log('lon', longitude)

       }

       $(document).ready(function() {
           getKoordinat();
       });
   </script>

   </html>