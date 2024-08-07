<style>
  #map {
    height: 85%;
    width: 100%;
  }
  
  .modal-body {
    height: 500px; /* Atur tinggi modal-body agar map mengambil ruang penuh */
  }
</style>


<!-- Modal -->
<div class="modal modal-lg fade" id="mapKoordinatPicker" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Silahkan Klik pada lokasi jalan yang akan di buat aduan</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div id="map"></div>
        <p>Koordinat: <span id="coordinates">Klik pada peta untuk mendapatkan koordinat</span></p>
        <button class="btn btn-sm btn-primary" data-bs-dismiss="modal" onclick="hapusError('lokasi')">Simpan</button>
      </div>
    </div>
  </div>
</div>
