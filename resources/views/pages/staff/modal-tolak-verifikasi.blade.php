<div class="modal fade" id="tolakVerifikasiModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Penolakan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <form id="form-tolak-verifikasi">
                        @csrf
                        <input type="hidden" name="id_penolakan" id="id_penolakan">
                        <div class="row">
                            <div class="col-12 col-lg-12">
                                <div class="form-group">
                                    <label for="name">Alasan Penolakan</label>
                                    <textarea name="alasan_penolakan" id="alasan_penolakan" class="form-control"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="flex text-right">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            <button type="submit" id="btnTolakVerifikasi" class="btn btn-danger">Tolak Sekarang</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>