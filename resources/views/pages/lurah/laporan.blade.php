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
                    
                    <div class="card-body">
                        <div class="form-filter mb-4">
                            <div class="row">
                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label for="month">Bulan</label>
                                        <select id="month" class="form-control">
                                            <option selected>Pilih Bulan</option>
                                            @foreach ($months as $item)
                                            <option value="{{ $item->month }}">{{ getMonth($item->month) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label for="year">Tahun</label>
                                        <select id="year" class="form-control">
                                            <option selected>Pilih Tahun</option>
                                            @foreach ($years as $item)
                                            <option value="{{ $item->year }}">{{ $item->year }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-lg-6">
                                    <button class="btn btn-info btn-block" onclick="downloadLaporanBulanan()">Download Laporan Bulanan</button>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <button class="btn btn-primary btn-block" onclick="downloadLaporanTahunan(this)">Download Laporan Tahunan</button>
                                </div>
                            </div>
                        </div>
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
                                        <th>Bulan</th>
                                        <th>Tahun</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th style="display:none">No.</th>
                                        <th style="display:none">NIK</th>
                                        <th style="display:none">Nama</th>
                                        <th style="display:none">Jenis Surat</th>
                                        <th style="display:none">Tanggal Diajukan</th>
                                        <th style="display:none">Tanggal Disetujui</th>
                                        <th>Bulan</th>
                                        <th>Tahun</th>
                                    </tr>
                                </tfoot>
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
    $('#tb_laporan').DataTable({
        initComplete: function() {
            this.api().columns().every(function() {
                var column = this;
                var select = $('<select class="form-control" style="width:150px;"></select>')
                .appendTo($(column.footer()).empty())
                .on('change', function () {
                    var val = $.fn.dataTable.util.escapeRegex($(this).val());
                    column.search(val ? '^' + val + '$' : '', true, false).draw();
                });
                
                column.data().unique().sort()
                .each(function (d, j) {
                    select.append('<option value="' + d + '">' + d + '</option>');
                });
            });
        },
        processing: true,
        serverSide: true,
        lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
        dom: 'lBfrtip',
        ordering: [[1, 'asc']],
        ajax: {
            url: "{{ route('lurah.laporan') }}",
        },
        data: {
            month: $('#month').val(),
            year: $('#year').val(),
        },
        columns: [
            { data: 'DT_RowIndex', name: 'id' },
            { data: 'nik', name: 'nik' },
            { data: 'nama', name: 'nama' },
            { data: 'categories_id', name: 'categories_id' },
            { data: 'created_at', name: 'created_at' },
            { data: 'updated_at', name: 'updated_at' },
            { data: 'bulan', name: 'bulan' },
            { data: 'tahun', name: 'tahun' },
        ],
        buttons: [
            {
                extend: 'excel',
                text: 'Download Excel',
                className: 'btn btn-success',
                exportOptions: {
                columns: [0, 1, 2, 3, 4, 5]
                }
            },
        ],
    });
    // download laporan tahunan
    function downloadLaporanTahunan()
    {
        if($('#year').val() == 'Pilih Tahun'){
            swal({
                title: "Gagal!",
                text: "Pilih Tahun Terlebih Dahulu" + "\n" + "Untuk Download Laporan Tahunan!",
                icon: "error",
                button: "OK",
            });
        } else {
            window.open("{{ url('/pages/dashboard/lurah/cetak-laporan-tahunan/') }}/" + $('#year').val(), '_blank');
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