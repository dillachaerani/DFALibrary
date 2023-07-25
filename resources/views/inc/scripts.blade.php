<!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
<script src="{{asset('assets/js/libs/jquery-3.1.1.min.js')}}"></script>
<script src="{{asset('bootstrap/js/popper.min.js')}}"></script>
<script src="{{asset('bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{asset('plugins/font-icons/feather/feather.min.js')}}"></script>
<script type="text/javascript">
    $(document).ready(function() {
        feather.replace();
    });
</script>
<script src="{{asset('plugins/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>
<script src="{{asset('assets/js/app.js')}}"></script>
<script>
    $(document).ready(function() {
        App.init();
    });
</script>
<script src="{{asset('assets/js/scrollspyNav.js')}}"></script>
<script src="{{asset('plugins/highlight/highlight.pack.js')}}"></script>
<script src="{{asset('plugins/sweetalerts/sweetalert2.min.js')}}"></script>
<script src="{{asset('plugins/sweetalerts/custom-sweetalert.js')}}"></script>
<script src="{{asset('assets/js/custom.js')}}"></script>
<!-- END GLOBAL MANDATORY SCRIPTS -->
<!-- BEGIN BLOCK UI SCRIPTS -->
<script src="{{asset('assets/js/scrollspyNav.js')}}"></script>
<script src="{{asset('plugins/blockui/jquery.blockUI.min.js')}}"></script>
<script src="{{asset('plugins/blockui/custom-blockui.js')}}"></script>
<!-- END BLOCK UI SCRIPTS -->
<!-- BEGIN NOTIFICATION -->
<script src="{{asset('plugins/notification/snackbar/snackbar.min.js')}}"></script>
<script src="{{asset('assets/js/components/notification/custom-snackbar.js')}}"></script>
<!-- END NOTIFICATION -->
<script src="{{asset('assets/js/clipboard/clipboard.min.js')}}"></script>
<script src="{{asset('assets/js/forms/custom-clipboard.js')}}"></script>
<!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
@yield('script')
<script src="{{asset('backend/js/app.js')}}"></script>
@yield('custom-script')
<!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->