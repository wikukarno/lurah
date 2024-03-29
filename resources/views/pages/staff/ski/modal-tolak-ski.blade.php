<div class="modal fade" id="tolakSkiModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tolak Surat Izin Keramaian</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="container">
          <form id="form-tolak-ski">
            @csrf
            <input type="hidden" name="id" id="id-ski">
            <div class="row">
              <div class="col-12">
                <div class="form-group">
                  <label for="nama">Alasan Penolakan</label>
                  <textarea name="alasan_penolakan" id="alasan_penolakan" maxlength="30" class="form-control" required></textarea>
                </div>
              </div>
            </div>
            <div class="flex text-right">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
              <button type="submit" id="btnTolakSku" class="btn btn-success">Tolak Sekarang</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>