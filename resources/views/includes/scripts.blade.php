<!-- General JS Scripts -->
<script src="{{ asset('assets/modules/jquery.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js"
    integrity="sha512-AIOTidJAcHBH2G/oZv9viEGXRqDNmfdPVPYOYKGy3fti0xIplnlgMHUGfuNRzC6FkzIo0iIxgFnr9RikFxK+sw=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="{{ asset('assets/modules/popper.js') }}"></script>
<script src="{{ asset('assets/modules/tooltip.js') }}"></script>
<script src="{{ asset('assets/modules/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/modules/nicescroll/jquery.nicescroll.min.js') }}"></script>
<script src="{{ asset('assets/modules/moment.min.js') }}"></script>
<script src="{{ asset('assets/js/stisla.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/jquery.dataTables.min.js"
    integrity="sha512-BkpSL20WETFylMrcirBahHfSnY++H2O1W+UnEEO4yNIl+jI2+zowyoGJpbtk6bx97fBXf++WJHSSK2MV4ghPcg=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<!-- JS Libraies -->
<script src="{{ asset('assets/modules/simple-weather/jquery.simpleWeather.min.js') }}"></script>
<script src="{{ asset('assets/modules/chart.min.js') }}"></script>
<script src="{{ asset('assets/modules/jqvmap/dist/jquery.vmap.min.js') }}"></script>
<script src="{{ asset('assets/modules/jqvmap/dist/maps/jquery.vmap.world.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.min.js"
    integrity="sha512-eAr+jBW2rJOKfwtPPPc/LTtqgWvJvgKbO+ux5ka6Cy5jUlgL0V1VbWFVWNlqMLgRkwyu2SS8UhRilwMBQC3Asw=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="{{ asset('assets/modules/summernote/summernote-bs4.js') }}"></script>

<script src="{{ asset('assets/modules/chocolat/dist/js/jquery.chocolat.min.js') }}"></script>

<!-- Page Specific JS File -->
<script src="{{ asset('assets/js/page/index-0.js') }}"></script>

<!-- Template JS File -->
<script src="{{ asset('assets/js/scripts.js') }}"></script>
<script src="{{ asset('build/assets/app.024077bb.js') }}"></script>

<script src="{{ asset('assets/js/custom.js') }}"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>



<script>
    jQuery.datetimepicker.setLocale('id');
    jQuery('#tanggal_lahir').datetimepicker({
        i18n:{
            de:
            {
                months:[
                'Januari','Februari','Maret','April',
                'Mei','Juni','Juli','Agustus',
                'September','Oktober','November','Desember',
                ],
                dayOfWeek:[
                "So.", "Mo", "Di", "Mi",
                "Do", "Fr", "Sa.",
                ]
            }
        },
        timepicker:false,
        format:'d.m.Y'
    });
</script>