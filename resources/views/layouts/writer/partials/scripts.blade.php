<div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="{{asset("template_pgadmin/plugins/jquery/jquery.min.js")}}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{asset("template_pgadmin/plugins/jquery-ui/jquery-ui.min.js")}}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="{{asset("template_pgadmin/plugins/bootstrap/js/bootstrap.bundle.min.js")}}"></script>
    <!-- ChartJS -->
    <script src="{{asset("template_pgadmin/plugins/chart.js/Chart.min.js")}}"></script>
    <!-- Sparkline -->
    <script src="{{asset("template_pgadmin/plugins/sparklines/sparkline.js")}}"></script>
    <!-- JQVMap -->
    <script src="{{asset("template_pgadmin/plugins/jqvmap/jquery.vmap.min.js")}}"></script>
    <script src="{{asset("template_pgadmin/plugins/jqvmap/maps/jquery.vmap.usa.js")}}"></script>
    <!-- jQuery Knob Chart -->
    <script src="{{asset("template_pgadmin/plugins/jquery-knob/jquery.knob.min.js")}}"></script>
    <!-- daterangepicker -->
    <script src="{{asset("template_pgadmin/plugins/moment/moment.min.js")}}"></script>
    <script src="{{asset("template_pgadmin/plugins/daterangepicker/daterangepicker.js")}}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{asset("template_pgadmin/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js")}}"></script>
    <!-- Summernote -->
    <script src="{{asset("template_pgadmin/plugins/summernote/summernote-bs4.min.js")}}"></script>
    <!-- overlayScrollbars -->
    <script src="{{asset("template_pgadmin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js")}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset("template_pgadmin/dist/js/adminlte.js")}}"></script>
    <!-- AdminLTE for demo purposes -->
{{--    <script src="{{asset("template_pgadmin/dist/js/demo.js")}}"></script>--}}
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
{{--    <script src="{{asset("template_pgadmin/dist/js/pages/dashboard.js")}}"></script>--}}
    <!-- App compiled -->
    <script src="{{ mix('/js/app.js') }}"></script>

</div>
