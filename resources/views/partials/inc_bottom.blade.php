<!-- jQuery -->
{{-- <script src="{{asset('backends/plugins/jquery/jquery.min.js')}}"></script> --}}

<!-- jQuery UI 1.11.4 -->
<script src="{{asset('backends/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{asset('backends/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- ChartJS -->
<script src="{{asset('backends/plugins/chart.js/Chart.min.js')}}"></script>
<!-- Sparkline -->
<script src="{{asset('backends/plugins/sparklines/sparkline.js')}}"></script>
<!-- JQVMap -->
{{-- <script src="{{asset('backends/plugins/jqvmap/jquery.vmap.min.js')}}"></script> --}}
{{-- <script src="{{asset('backends/plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script> --}}
<!-- jQuery Knob Chart -->
<script src="{{asset('backends/plugins/jquery-knob/jquery.knob.min.js')}}"></script>
<!-- daterangepicker -->
<script src="{{asset('backends/plugins/moment/moment.min.js')}}"></script>
<script src="{{asset('backends/plugins/daterangepicker/daterangepicker.js')}}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{asset('backends/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
<!-- Summernote -->
<script src="{{asset('backends/plugins/summernote/summernote-bs4.min.js')}}"></script>
<!-- overlayScrollbars -->
<script src="{{asset('backends/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('backends/dist/js/adminlte.js')}}"></script>
<!-- AdminLTE for demo purposes -->
{{-- <script src="{{asset('backends/dist/js/demo.js')}}"></script> --}}
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{asset('backends/dist/js/pages/dashboard.js')}}"></script>

<!-- Bootstrap Switch -->
<script src="{{asset('backends')}}/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>

<script src="{{asset('backends')}}/plugins/sweetalert2/sweetalert2.min.js"></script>
<script src="{{asset('backends')}}/js/notify/pnotify.min.js"></script>

<script src="{{asset('backends')}}/plugins/toastr/toastr.min.js"></script>



<script src="{{asset('backends')}}/js/uploader_bootstrap.js"></script>
<script src="{{asset('backends')}}/js/validate.min.js"></script>

<!-- Select2 -->
<script src="{{asset('backends')}}/plugins/select2/js/select2.full.min.js"></script>



<script>
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
    theme: 'bootstrap4'
    })
     //Date picker
     $('#date_of_birth').datetimepicker({
        format: 'L'
    });
    $('#date_of_em').datetimepicker({
        format: 'L'
    });
    


</script>



@include('partials.js.custom_js')
