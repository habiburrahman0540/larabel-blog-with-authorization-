<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>@yield('title') - {{ config('app.name', 'Laravel') }}</title>

 <!-- Favicon-->
 <link rel="icon" href="favicon.ico" type="image/x-icon">

<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

<!-- Bootstrap Core Css -->
<link href="{{asset('public/assets/backend/plugins/bootstrap/css/bootstrap.css')}}" rel="stylesheet">

<!-- Waves Effect Css -->
<link href="{{asset('public/assets/backend/plugins/node-waves/waves.css')}}" rel="stylesheet" />

<!-- Animation Css -->
<link href="{{asset('public/assets\backend\plugins\animate-css/animate.min.css')}}" rel="stylesheet" />

<!-- Sweet Alert Css -->
<link href="{{asset('public/assets\backend\plugins/sweetalert/sweetalert.css')}}" rel="stylesheet" />
<!-- Morris Chart Css-->
<link href="{{asset('public/assets/backend/plugins/morrisjs/morris.css')}}" rel="stylesheet" />

    <!-- Colorpicker Css -->
    <link href="{{asset('public/assets/backend/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.css')}}" rel="stylesheet" />

    <!-- Dropzone Css -->
    <link href="{{asset('public/assets/backend/plugins/dropzone/dropzone.css')}}" rel="stylesheet">

    <!-- Multi Select Css -->
    <link href="{{asset('public/assets/backend/plugins/multi-select/css/multi-select.css')}}" rel="stylesheet">

    <!-- Bootstrap Spinner Css -->
    <link href="{{asset('public/assets/backend/plugins/jquery-spinner/css/bootstrap-spinner.css')}}" rel="stylesheet">
    <!-- Bootstrap Select Css -->
    <link href="{{asset('public/assets/backend/plugins/bootstrap-select/css/bootstrap-select.css')}}" rel="stylesheet" />
    <!-- noUISlider Css -->
    <link href="{{asset('public/assets/backend/plugins/nouislider/nouislider.min.css')}}" rel="stylesheet" />
    <script src="{{asset('public/assets/backend/plugins/jquery-datatable/jquery.dataTables.js')}}"></script>

<script src="{{asset('public/assets/backend/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js')}}"></script>
<script src="{{asset('public/assets/backend/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('public/assets/backend/plugins/jquery-datatable/extensions/export/buttons.flash.min.js')}}"></script>
<script src="{{asset('public/assets/backend/plugins/jquery-datatable/extensions/export/jszip.min.js')}}"></script>
<script src="{{asset('public/assets/backend/plugins/jquery-datatable/extensions/export/pdfmake.min.js')}}"></script>
<script src="{{asset('public/assets/backend/plugins/jquery-datatable/extensions/export/vfs_fonts.js')}}"></script>
<script src="{{asset('public/assets/backend/plugins/jquery-datatable/extensions/export/buttons.html5.min.js')}}"></script>
<script src="{{asset('public/assets/backend/plugins/jquery-datatable/extensions/export/buttons.print.min.js')}}"></script>
<script src="{{asset('public/assets/backend/js/sweetalert2.all.min.js')}}"></script>
<script src="{{asset('public/assets/backend/js/pages/tables/jquery-datatable.js')}}"></script>
<!-- Custom Css -->
<link href="{{asset('public/assets/backend/css/style.css')}}" rel="stylesheet">

<!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
<link href="{{asset('public/assets/backend/css/themes/all-themes.css')}}" rel="stylesheet" />

    @stack('css')
</head>
<body class="theme-red">

 <!-- Page Loader -->
 <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Please wait...</p>
        </div>
    </div>
    <!-- #END# Page Loader -->
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->
    <!-- Search Bar -->
    <div class="search-bar">
        <div class="search-icon">
            <i class="material-icons">search</i>
        </div>
        <input type="text" placeholder="START TYPING...">
        <div class="close-search">
            <i class="material-icons">close</i>
        </div>
    </div>
    <!-- #END# Search Bar -->
    <!-- Top Bar -->
    
    @include('layouts.backend.partial.topbar')
    <!-- #Top Bar -->
    <section>
        <!-- Left Sidebar -->
        @include('layouts.backend.partial.sidebar')
        <!-- #END# Left Sidebar -->
      
    </section>

    <section class="content">
        @yield('content')
    </section>


 <!-- Jquery Core Js -->
 <script src="{{asset('public/assets/backend/plugins/jquery/jquery.min.js')}}"></script>

<!-- Bootstrap Core Js -->
<script src="{{asset('public/assets/backend/plugins/bootstrap/js/bootstrap.js')}}"></script>

<!-- Select Plugin Js -->
<script src="{{asset('public/assets/backend/plugins/bootstrap-select/js/bootstrap-select.js')}}"></script>

<!-- Slimscroll Plugin Js -->
<script src="{{asset('public/assets/backend/plugins/jquery-slimscroll/jquery.slimscroll.js')}}"></script>

<!-- Waves Effect Plugin Js -->
<script src="{{asset('public/assets/backend/plugins/node-waves/waves.js')}}"></script>
<script src="{{asset('public/assets/backend/plugins/jquery-countto/jquery.countTo.js')}}"></script>
<script src="{{asset('public/assets/backend/plugins/raphael/raphael.min.js')}}"></script>
<script src="{{asset('public/assets/backend/plugins/morrisjs/morris.js')}}"></script>
<script src="{{asset('public/assets/backend/plugins/chartjs/Chart.bundle.js')}}"></script>
<!-- Flot Charts Plugin Js -->
<script src="{{asset('public/assets/backend/plugins/flot-charts/jquery.flot.js')}}"></script>
<script src="{{asset('public/assets/backend/plugins/flot-charts/jquery.flot.resize.js')}}"></script>

<script src="{{asset('public/assets/backend/plugins/flot-charts/jquery.flot.pie.js')}}"></script>
<script src="{{asset('public/assets/backend/plugins/flot-charts/jquery.flot.categories.js')}}"></script>
<script src="{{asset('public/assets/backend/plugins/flot-charts/jquery.flot.time.js')}}"></script>

<!-- Sparkline Chart Plugin Js -->
<script src="{{asset('public/assets/backend/plugins/jquery-sparkline/jquery.sparkline.js')}}"></script>
<script src="{{asset('public/assets/backend/js/admin.js')}}"></script>
<script src="{{asset('public/assets/backend/js/pages/index.js')}}"></script>
 <!-- Sweet Alert Plugin Js -->
 <script src="{{asset('public/assets/backend/plugins/sweetalert/sweetalert.min.js')}}"></script>

<!-- Bootstrap Colorpicker Js -->
    <script src="{{asset('public/assets/backend/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js')}}"></script>

    <!-- Dropzone Plugin Js -->
    <script src="{{asset('public/assets/backend/plugins/dropzone/dropzone.js')}}"></script>

    <!-- Input Mask Plugin Js -->
    <script src="{{asset('public/assets/backend/plugins/jquery-inputmask/jquery.inputmask.bundle.js')}}"></script>

    <!-- Multi Select Plugin Js -->
    <script src="{{asset('public/assets/backend/plugins/multi-select/js/jquery.multi-select.js')}}"></script>

    <!-- Jquery Spinner Plugin Js -->
    <script src="{{asset('public/assets/backend/plugins/jquery-spinner/js/jquery.spinner.js')}}"></script>

    <!-- Bootstrap Tags Input Plugin Js -->
    <script src="{{asset('public/assets/backend/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js')}}"></script>

    <!-- noUISlider Plugin Js -->
    <script src="{{asset('public/assets/backend/plugins/nouislider/nouislider.js')}}"></script>
    




<!-- Custom Js -->

<script src="{{asset('public/assets/backend/js/pages/forms/advanced-form-elements.js')}}"></script>

<!-- Demo Js -->
<script src="{{asset('public/assets/backend/js/demo.js')}}"></script>
 <!-- TinyMCE -->
 
<script type="text/javascript" src="{{asset('public/assets/backend/plugins/tinymce/tinymce.min.js')}}"></script>
<script type="text/javascript">
tinymce.init({
    selector: "#mceEditor",
    theme: "modern",
    plugins: [
        "advlist autolink lists link image charmap print preview hr anchor pagebreak",
        "searchreplace wordcount visualblocks visualchars code fullscreen",
        "insertdatetime media nonbreaking save table contextmenu directionality",
        "emoticons template paste textcolor colorpicker textpattern imagetools"
    ],
    toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
    toolbar2: "print preview media | forecolor backcolor emoticons",
    image_advtab: true,
    templates: [
        {title: 'Test template 1', content: 'Test 1'},
        {title: 'Test template 2', content: 'Test 2'}
    ]
});
</script>

    @stack('js')
</body>
</html>
