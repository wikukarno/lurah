<div class="modal fade" id="ubahProfileModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ubah Profile</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <form id="form-ubah-profile-staff">
                        @csrf
                        <input type="hidden" name="id" id="profile" value="{{ Auth::user()->id }}">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="name">Nama</label>
                                    <input type="text" name="name" id="name" class="form-control">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" id="email" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="phone">Nomor Hp</label>
                                    <input type="number" name="phone" id="phone" class="form-control">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="address">Alamat</label>
                                    <input type="address" name="address" id="address" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="flex text-right">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                            <button type="submit" id="btnUbahProfile" class="btn btn-success">Ubah Sekarang</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>