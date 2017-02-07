<!--[if lt IE 9]>
<script src="/assets/global/plugins/respond.min.js"></script>
<script src="/assets/global/plugins/excanvas.min.js"></script>
<![endif]-->
<!-- BEGIN CORE PLUGINS -->
<script src="/assets/global/plugins/jquery.min.js" type="text/javascript"></script>
<script src="/assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="/assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
<script src="/assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
<script src="/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="/assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>

<!--Solve toggle switch problem for create order v2 page-->
@if(isset($_G['route_name']) && ($_G['route_name'] != 'frontend.createorderv2' ) && ($_G['route_name'] != 'frontend.editorderv2' ) )
    <script src="/assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
@endif

<script src="/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
<script src="/assets/global/plugins/bootstrap-toastr/toastr.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
{{--<script src="/assets/global/plugins/moment.min.js" type="text/javascript"></script>--}}
{{--<script src="/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js" type="text/javascript"></script>--}}
<script src="/assets/global/plugins/morris/morris.min.js" type="text/javascript"></script>
{{--<script src="/assets/global/plugins/morris/raphael-min.js" type="text/javascript"></script>--}}
{{--<script src="/assets/global/plugins/counterup/jquery.waypoints.min.js" type="text/javascript"></script>--}}
{{--<script src="/assets/global/plugins/counterup/jquery.counterup.min.js" type="text/javascript"></script>--}}
{{--<script src="/assets/global/plugins/amcharts/amcharts/amcharts.js" type="text/javascript"></script>--}}
{{--<script src="/assets/global/plugins/amcharts/amcharts/serial.js" type="text/javascript"></script>--}}
{{--<script src="/assets/global/plugins/amcharts/amcharts/pie.js" type="text/javascript"></script>--}}
{{--<script src="/assets/global/plugins/amcharts/amcharts/radar.js" type="text/javascript"></script>--}}
{{--<script src="/assets/global/plugins/amcharts/amcharts/themes/light.js" type="text/javascript"></script>--}}
{{--<script src="/assets/global/plugins/amcharts/amcharts/themes/patterns.js" type="text/javascript"></script>--}}
{{--<script src="/assets/global/plugins/amcharts/amcharts/themes/chalk.js" type="text/javascript"></script>--}}
{{--<script src="/assets/global/plugins/amcharts/ammap/ammap.js" type="text/javascript"></script>--}}
{{--<script src="/assets/global/plugins/amcharts/ammap/maps/js/worldLow.js" type="text/javascript"></script>--}}
{{--<script src="/assets/global/plugins/amcharts/amstockcharts/amstock.js" type="text/javascript"></script>--}}
{{--<script src="/assets/global/plugins/fullcalendar/fullcalendar.min.js" type="text/javascript"></script>--}}
{{--<script src="/assets/global/plugins/flot/jquery.flot.min.js" type="text/javascript"></script>--}}
{{--<script src="/assets/global/plugins/flot/jquery.flot.resize.min.js" type="text/javascript"></script>--}}
{{--<script src="/assets/global/plugins/flot/jquery.flot.categories.min.js" type="text/javascript"></script>--}}
{{--<script src="/assets/global/plugins/jquery-easypiechart/jquery.easypiechart.min.js" type="text/javascript"></script>--}}
{{--<script src="/assets/global/plugins/jquery.sparkline.min.js" type="text/javascript"></script>--}}
{{--<script src="/assets/global/plugins/jqvmap/jqvmap/jquery.vmap.js" type="text/javascript"></script>--}}
{{--<script src="/assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.russia.js" type="text/javascript"></script>--}}
{{--<script src="/assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.world.js" type="text/javascript"></script>--}}
{{--<script src="/assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.europe.js" type="text/javascript"></script>--}}
{{--<script src="/assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.germany.js" type="text/javascript"></script>--}}
{{--<script src="/assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.usa.js" type="text/javascript"></script>--}}
{{--<script src="/assets/global/plugins/jqvmap/jqvmap/data/jquery.vmap.sampledata.js" type="text/javascript"></script>--}}
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN THEME GLOBAL SCRIPTS -->
<script type="text/javascript">
    +function () {
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });
    }(jQuery);
</script>
<script src="/js/ajaxform.min.js" type="text/javascript"></script>
<script src="/js/app.js" type="text/javascript"></script>
<script src="/js/global.js" type="text/javascript"></script>
<!-- END THEME GLOBAL SCRIPTS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<!-- END PAGE LEVEL SCRIPTS -->
<!-- BEGIN THEME LAYOUT SCRIPTS -->
<script src="/assets/layouts/layout4/scripts/layout.min.js" type="text/javascript"></script>
<script src="/assets/layouts/layout4/scripts/demo.min.js" type="text/javascript"></script>
<script src="/assets/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
<!-- END THEME LAYOUT SCRIPTS -->
<!-- chat module -->
<script src="/custom/js/frontend/myChatPullRequest.js" type="text/javascript"></script>
<script src="/custom/js/frontend.js" type="text/javascript"></script>