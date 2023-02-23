@extends('layouts.dashboard')

@section('title')
Data Laporan
@endsection

@section('content')
{{-- <section class="main-content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <div class="row text-center">
                    <div class="col-12">
                        <img src="{{ asset('assets/images/maintenance.svg') }}" alt="maintenance" class="img-fluid">
                        <h1 class="mt-5">Mohon Maaf!</h1>
                        <p>Fitur ini sedang dalam perbaikan</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> --}}
<section class="main-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Data Laporan </h3>
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
                                        <th>Tahun</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>No.</th>
                                        <th>NIK</th>
                                        <th>Nama</th>
                                        <th>Jenis Surat</th>
                                        <th>Tanggal Diajukan</th>
                                        <th>Tanggal Disetujui</th>
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
                var select = $('<select><option value=""></option></select>')
                    .appendTo($(column.footer()).empty())
                    .on('change', function () {
                        var val = $.fn.dataTable.util.escapeRegex($(this).val());
                    
                        column.search(val ? '^' + val + '$' : '', true, false).draw();
                    });
                
                    column
                    .data()
                    .unique()
                    .sort()
                    .each(function (d, j) {
                    select.append('<option value="' + d + '">' + d + '</option>');
                });


            });
        },
        processing: true,
        serverSide: true,
        lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
        dom: 'lBfrtip',
        buttons: [
            {
                extend: 'excel',
                text: 'Download Excel',
                className: 'btn btn-success',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5]
                }
            },
            {
                extend: 'print',
                text: 'Print',
                className: 'btn btn-info',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5]
                }
            },
        ],
        ordering: [[1, 'asc']],
        ajax: {
            url: "{{ route('lurah.laporan') }}",
        },
        columns: [
            { data: 'DT_RowIndex', name: 'id' },
            { data: 'nik', name: 'nik' },
            { data: 'nama', name: 'nama' },
            { data: 'jenis_surat', name: 'jenis_surat' },
            { data: 'created_at', name: 'created_at' },
            { data: 'updated_at', name: 'updated_at' },
            { data: 'tahun', name: 'tahun' },
        ],
    });

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