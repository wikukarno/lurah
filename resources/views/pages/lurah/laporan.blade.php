@extends('layouts.dashboard')

@section('title')
Data Laporan
@endsection

@section('content')
<section class="main-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Data Laporan</h3>
                    </div>
                    <div class="container">
                        {{-- <div class="row">
                            <div class="col-12 col-lg-6">
                                <label for="checkYear" class="text-dark">Cetak Laporan Tahunan</label>
                                <div class="form-group d-flex align-items-center">
                                    <select class="form-control" id="checkYear">
                                        <option value="Pilih Tahun">Pilih Tahun</option>
                                        @foreach ($years as $year)
                                        <option value="{{ $year->year }}">{{ $year->year }}</option>
                                        @endforeach
                                    </select>
                                    <a href="javascript:void(0)" onclick="downloadLaporanTahunan()"
                                        class="btn btn-primary ml-3">
                                        <i class="fas fa-print"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <label for="checkMonth" class="text-dark">Cetak Laporan Bulanan</label>
                                <div class="form-group d-flex align-items-center">
                                    <select class="form-control" id="checkMonth">
                                        <option value="Pilih Bulan">Pilih Bulan</option>
                                        @foreach ($months as $month)
                                        <option value="{{ $month->month }}">
                                            {{ getMonth($month->month) }}
                                        </option>
                                        @endforeach
                                    </select>
                                    <a href="javascript:void(0)" onclick="downloadLaporanBulanan()"
                                        id="download-laporan-bulanan" class="btn btn-primary ml-3">
                                        <i class="fas fa-print"></i>
                                    </a>
                                </div>
                            </div>
                        </div> --}}
                        <div class="row d-flex align-items-center">
                            <div class="col-12 col-lg-6">
                                <form id="form-by-month">
                                    @csrf
                                    <label for="month">Filter Berdasarkan Bulan</label>
                                    <div class="form-group d-flex align-items-center">
                                        <select class="form-control form-control-lg" id="month">
                                            <option value="Pilih Bulan">Pilih bulan</option>
                                            @foreach ($months as $month)
                                            <option value="{{ $month->month }}">
                                                {{ getMonth($month->month) }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <a href="javascript:void(0)" id="btnDownloadLaporanBulanan"
                                            onclick="downloadLaporanBulanan()" class="btn btn-primary ml-3">
                                            <i class="fas fa-print"></i>
                                        </a>
                                    </div>
                                </form>
                            </div>
                            <div class="col-12 col-lg-6">
                                <form id="form-by-year">
                                    @csrf
                                    <label for="year">Filter Berdasarkan Tahun</label>
                                    <div class="form-group d-flex align-items-center">
                                        <select class="form-control form-control-lg" id="year">
                                            <option value="Pilih Tahun">Pilih Tahun</option>
                                            @foreach ($years as $item)
                                            <option value="{{ $item->year }}">{{ $item->year }}</option>
                                            @endforeach
                                        </select>
                                        <a href="javascript:void(0)" id="btnDownloadLaporanTahunan"
                                            onclick="downloadLaporanTahunan()" class="btn btn-primary ml-3">
                                            <i class="fas fa-print"></i>
                                        </a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="tb_laporan" class="table table-hover scroll-horizontal-vertical w-100">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>NIK</th>
                                        <th>Nama</th>
                                        <th>Jenis Surat</th>
                                        <th>Tanggal Diajukan</th>
                                        <th>Tanggal Disetujui</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('after-scripts')
<script>
    // filter by month
    if($('#month').change(function(){
        var month = $(this).val();
        var _token = $('input[name="_token"]').val();
        
        $.ajax({
            url: "{{ route('lurah.filter-laporan-bulanan') }}",
            method: "POST",
            data: {month:month, _token:_token},
            success:function(data){
                // if data notfound
                if(!data.data.length > 0 && $('#month').val() != 'Pilih Bulan' && $('#year').val() != 'Pilih Tahun'){
                    $('#btnDownloadLaporanBulanan').on('click', function(){
                        swal({
                            title: "Data tidak ditemukan",
                            text: "Mohon maaf, Data tidak bisa di download, karena data tidak ditemukan",
                            icon: "error",
                            button: "Ok",
                        });
                    });
                    console.log('data not found');
                    
                }
                $('#tb_laporan').DataTable().destroy();
                $('#tb_laporan tbody').html(data.data);
                $('#tb_laporan').DataTable({
                    "scrollX": true,
                    "scrollY": "300px",
                    "scrollCollapse": true,
                    "paging": true,
                    "searching": true,
                    "info": true,
                    "order": [[ 0, "asc" ]],
                    data: data.data,
                    columns: [
                        { data: 'DT_RowIndex', name: 'id' },
                        { data: 'no_nik', name: 'no_nik' },
                        { data: 'nama', name: 'nama' },
                        { data: 'jenis_surat', name: 'jenis_surat' },
                        { data: 'created_at',
                            name: 'created_at',
                        },
                        { data: 'updated_at', name: 'updated_at' },
                    ]
                });
            }
        });
    }));

    // filter by year
    if($('#year').change(function(){
        var year = $(this).val();
        var _token = $('input[name="_token"]').val();
        
        $.ajax({
            url: "{{ route('lurah.filter-laporan-tahunan') }}",
            method: "POST",
            data: {year:year, _token:_token},
            success:function(data){

                if(!data.data.length){
                    $('#btnDownloadLaporanTahunan').on('click', function(e){
                        e.preventDefault();
                        swal({
                            title: "Data tidak ditemukan",
                            text: "Mohon maaf, Data tidak bisa di download, karena data tidak ditemukan",
                            icon: "error",
                            button: "Ok",
                        });
                    });
                    console.log('data not found');
                }

                $('#tb_laporan').DataTable().destroy();
                $('#tb_laporan tbody').html(data.data);
                $('#tb_laporan').DataTable({
                    "scrollX": true,
                    "scrollY": "300px",
                    "scrollCollapse": true,
                    "paging": true,
                    "searching": true,
                    "info": true,
                    "order": [[ 0, "asc" ]],
                    data: data.data,
                    columns: [
                        { data: 'DT_RowIndex', name: 'id' },
                        { data: 'no_nik', name: 'no_nik' },
                        { data: 'nama', name: 'nama' },
                        { data: 'jenis_surat', name: 'jenis_surat' },
                        { data: 'created_at',
                            name: 'created_at',
                        },
                        { data: 'updated_at', name: 'updated_at' },
                    ]
                });
            }
        });
    }));

    // filter by month and year
    if($('#month' && '#year' || '#year' && '#month').change(function(){
        var month = $('#month').val();
        var year = $('#year').val();
        var _token = $('input[name="_token"]').val();
        
        $.ajax({
            url: "{{ route('lurah.filter-laporan-bulanan-tahunan') }}",
            method: "POST",
            data: {month:month, year:year, _token:_token},
            success:function(data){
                $('#tb_laporan').DataTable().destroy();
                $('#tb_laporan tbody').html(data.data);
                $('#tb_laporan').DataTable({
                    "scrollX": true,
                    "scrollY": "300px",
                    "scrollCollapse": true,
                    "paging": true,
                    "searching": true,
                    "info": true,
                    "order": [[ 0, "asc" ]],
                    data: data.data,
                    columns: [
                        { data: 'DT_RowIndex', name: 'id' },
                        { data: 'no_nik', name: 'no_nik' },
                        { data: 'nama', name: 'nama' },
                        { data: 'jenis_surat', name: 'jenis_surat' },
                        { data: 'created_at', name: 'created_at'},
                        { data: 'updated_at', name: 'updated_at' },
                    ]
                });
            }
        });
    }));

    if ($('#month').val() == 'Pilih Bulan' && $('#year').val() == 'Pilih Tahun') {
        $('#tb_laporan').DataTable({
            processing: true,
            serverSide: true,
            ordering: [[1, 'asc']],
            ajax: {
                url: "{{ route('lurah.laporan') }}",
            },
            columns: [
                { data: 'DT_RowIndex', name: 'id' },
                { data: 'no_nik', name: 'no_nik' },
                { data: 'nama', name: 'nama' },
                { data: 'jenis_surat', name: 'jenis_surat' },
                { data: 'created_at', name: 'created_at' },
                { data: 'updated_at', name: 'updated_at' },
            ],
        });
    }

    // download laporan tahunan
    function downloadLaporanTahunan()
    {
        if($('#year').val() == 'Pilih Tahun'){
            swal({
                title: "Gagal!",
                text: "Pilih Tahun Terlebih Dahulu!",
                icon: "error",
                button: "OK",
            });
        }else{
            window.open("{{ url('/pages/dashboard/lurah/cetak-laporan-tahunan/') }}/" + $('#year').val());
            // window.open("{{ url('/pages/dashboard/lurah/cetak-laporan-tahunan/') }}/" + $('#checkYear').val(), '_blank');
        }
    }

    // validasi dan download laporan bulanan
    function downloadLaporanBulanan()
    {
        
        if($('#month').val() == 'Pilih Bulan' && $('#year').val() == 'Pilih Tahun'){
            swal({
                title: "Gagal!",
                text: "Pilih Bulan dan Tahun Terlebih Dahulu" + "\n" + "Untuk Download Laporan Bulanan!",
                icon: "error",
                button: "OK",
            });
        } else if($('#month').val() != 'Pilih Bulan' && $('#year').val() == 'Pilih Tahun'){
            swal({
                title: "Gagal!",
                text: "Pilih Tahun Terlebih Dahulu" + "\n" + "Untuk Download Laporan Bulanan!",
                icon: "error",
                button: "OK",
            });
        } else if($('#month').val() == 'Pilih Bulan' && $('#year').val() != 'Pilih Tahun'){
            swal({
                title: "Gagal!",
                text: "Pilih Bulan Terlebih Dahulu" + "\n" + "Untuk Download Laporan Bulanan!",
                icon: "error",
                button: "OK",
            });
        } else {
            window.open("{{ url('/pages/dashboard/lurah/cetak-laporan-bulanan/') }}/" + $('#month').val() + "/" + $('#year').val(), '_blank');
        }
    }
</script>
@endpush