<link href="{{asset('assets/css/loader.css')}}" rel="stylesheet" type="text/css" />
<script src="{{asset('assets/js/loader.js')}}"></script>

<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
<link href="{{asset('bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />

<link href="{{asset('assets/css/plugins.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/css/scrollspyNav.css')}}" rel="stylesheet" type="text/css" />
<!-- END GLOBAL MANDATORY STYLES -->
<link href="{{asset('assets/css/components/tabs-accordian/custom-tabs.css')}}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/forms/theme-checkbox-radio.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/forms/switches.css')}}">
<link href="{{asset('assets/css/elements/custom-pagination.css')}}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">
<script src="{{asset('plugins/sweetalerts/promise-polyfill.js')}}"></script>
<link href="{{asset('plugins/sweetalerts/sweetalert2.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('plugins/sweetalerts/sweetalert.css')}}" rel="stylesheet" type="text/css" />
<!-- BEGIN BLOCK UI STYLES -->
<link href="{{asset('assets/css/components/custom-modal.css')}}" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="{{asset('plugins/animate/animate.css')}}">
<style>   
  .blockui-growl-message {
      display: none;
      text-align: left;
      padding: 15px;
      background-color: #455a64;
      color: #fff;
      border-radius: 3px;
  }
  .blockui-animation-container { display: none; }
  .multiMessageBlockUi {
      display: none;
      background-color: #455a64;
      color: #fff;
      border-radius: 3px;
      padding: 15px 15px 10px 15px;
  }
  .multiMessageBlockUi i { display: block }
</style>
<!-- END BLOCK UI STYLES -->
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/elements/alert.css')}}">
<!-- notification --->
<link href="{{asset('plugins/notification/snackbar/snackbar.min.css')}}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/forms/custom-clipboard.css')}}">

<!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES -->
@yield('css')
<link href="{{asset('backend/css/app.css')}}" rel="stylesheet" type="text/css" />
@yield('styles')
<!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->