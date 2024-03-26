<meta charset="utf-8">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="shortcut icon" href="https://doh.gov.ph/sites/default/files/favicon.ico" type="image/vnd.microsoft.icon">

{{-- Font-Awesome --}}
<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css" integrity="sha384-+d0P83n9kaQMCwj8F4RJB66tzIwOKmrdb46+porD/OvrJ+37WqIM7UoBtwHO6Nlg" crossorigin="anonymous">
{{-- Bootstrap --}}
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
{{-- Buttom --}}
<link rel="stylesheet" type="text/css" href="{{asset('ra-idlis/public/css/button.css')}}">
{{-- Animate --}}
<link rel="stylesheet" type="text/css" href="{{asset('ra-idlis/public/css/animate.css')}}">
{{-- Parsley --}}
<link rel="stylesheet" type="text/css" href="{{asset('ra-idlis/public/css/parsley.css')}}">
{{-- BootAdmin --}}
<link rel="stylesheet" href="{{asset('ra-idlis/public/css/css/bootadmin.min.css')}}">
{{-- Datatables --}}
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css">
{{-- FullCalendar --}}
<link rel="stylesheet" href="{{asset('ra-idlis/public/css/css/fullcalendar.min.css')}}">
{{-- Lobibox --}}
<link rel="stylesheet" href="{{ asset('ra-idlis/public/lobibox/css/Lobibox.min.css') }}"/>
<link rel="stylesheet" type="text/css" href="{{ asset('ra-idlis/public/css/font-awesome-animation.min.css') }}">


<link rel="stylesheet" type="text/css" href="{{asset('ra-idlis/public/css/bootstrap-toggle-master/css/bootstrap-toggle.min.css')}}">
{{-- <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet"> --}}



<!-- Froala. -->
{{-- <link href='https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.8.5/css/froala_editor.min.css' rel='stylesheet' type='text/css' />
<link href='https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.8.5/css/froala_style.min.css' rel='stylesheet' type='text/css' /> --}}
{{-- Quill --}}
{{-- <link href="//cdn.quilljs.com/1.3.6/quill.core.css" rel="stylesheet">
<link href="//cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet"> --}}
{{-- Summernote --}}
 <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.10/summernote-bs4.css" rel="stylesheet">
 <link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
 <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css" rel="stylesheet" />
 <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

{{-- Jquery --}}
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
{{-- Popper --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
{{-- Bootstrap --}}
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
{{-- Parsley --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.8.1/parsley.min.js"></script>
{{-- Moment --}}
<script src="{{asset('ra-idlis/public/js/moment.js')}}"></script>
{{-- Number2Words --}}
<script src="{{asset('ra-idlis/public/js/num2words.js')}}"></script>
{{-- FullCalendar --}}
<script type="text/javascript" src="{{ asset('ra-idlis/public/js/fullcalendar.min.js') }}"></script>
{{-- DataTable --}}
<script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
{{-- DataTable Dependencies --}}
<script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
{{-- Lobibox --}}
<script src="{{asset('ra-idlis/public/lobibox/js/Lobibox.min.js')}}"></script>
<!-- Froala JS file. -->
{{-- <script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.8.5/js/froala_editor.min.js'></script> --}}
{{-- Tiny MCE --}}
{{-- <script src='https://cloud.tinymce.com/stable/tinymce.min.js'></script> --}}
{{-- Quill --}}
{{-- <script src="//cdn.quilljs.com/1.3.6/quill.core.js"></script>
<script src="//cdn.quilljs.com/1.3.6/quill.min.js"></script>
 --}}
 {{-- CKEDITOR --}}
 {{-- <script src="//cdn.ckeditor.com/4.10.1/basic/ckeditor.js"></script> --}}
 {{-- Summernote --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.10/summernote-bs4.js"></script>

{{-- Lloyd - Dec 7, 2018 Toggle Checkbox --}}
{{-- <link href="{{asset('ra-idlis/public/css/bootstrap-toggle.min.css')}}" rel="stylesheet"> --}}
<script src="{{asset('ra-idlis/public/js/bootstrap-toggle-master/js/bootstrap-toggle.min.js')}}"></script>



{{-- <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script> --}}



{{-- <script src="//code.jquery.com/jquery-1.10.2.js"></script> --}}
<script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
 {{-- Others --}}


 <!---------------------------  Added as of January 2023  ----------------------------->
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('bower_components/font-awesome/css/font-awesome.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{asset('bower_components/Ionicons/css/ionicons.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('dist/css/AdminLTE.min.css')}}">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{asset('dist/css/skins/_all-skins.min.css')}}">
  <!-- Morris chart -->
  <link rel="stylesheet" href="{{asset('bower_components/morris.js/morris.css')}}">
  <!-- jvectormap -->
  <link rel="stylesheet" href="{{asset('bower_components/jvectormap/jquery-jvectormap.css')}}">
  <!-- Date Picker -->
  <link rel="stylesheet" href="{{asset('bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{asset('bower_components/bootstrap-daterangepicker/daterangepicker.css')}}">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="{{asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}">

  <style>  .hide{  display: none;  }  </style>

  <!-- jQuery 3 -->
  {{-- <script src="{{asset('bower_components/jquery/dist/jquery.min.js')}}"></script> --}}
  <!-- jQuery UI 1.11.4 -->
  <script src="{{asset('bower_components/jquery-ui/jquery-ui.min.js')}}"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
    $.widget.bridge('uibutton', $.ui.button);
  </script>
  <!-- Bootstrap 3.3.7 -->
  {{-- <script src="{{asset('bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script> --}}
  <!-- Morris.js charts -->
  <script src="{{asset('bower_components/raphael/raphael.min.js')}}"></script>
  <script src="{{asset('bower_components/morris.js/morris.min.js')}}"></script>
  <!-- Sparkline -->
  <script src="{{asset('bower_components/jquery-sparkline/dist/jquery.sparkline.min.js')}}"></script>
  <!-- jvectormap -->
  <script src="{{asset('plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')}}"></script>
  <script src="{{asset('plugins/jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
  <!-- jQuery Knob Chart -->
  <script src="{{asset('bower_components/jquery-knob/dist/jquery.knob.min.js')}}"></script>
  <!-- daterangepicker -->
  <script src="{{asset('bower_components/moment/min/moment.min.js')}}"></script>
  <script src="{{asset('bower_components/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
  <!-- datepicker -->
  <script src="{{asset('bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
  <!-- Bootstrap WYSIHTML5 -->
  <script src="{{asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}"></script>
  <!-- Slimscroll -->
  <script src="{{asset('bower_components/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
  <!-- FastClick -->
  <script src="{{asset('bower_components/fastclick/lib/fastclick.js')}}"></script>
  <!-- AdminLTE App -->
  <script src="{{asset('dist/js/adminlte.min.js')}}"></script>
  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <script src="{{asset('dist/js/pages/dashboard.js')}}"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="{{asset('dist/js/demo.js')}}"></script>
  
  <script>
    function toProcessFlow(caseForDirectory,where){
      switch (caseForDirectory) {
        case 1:
          url = "{{url('employee/dashboard/processflow/view/')}}" + "/" + where;
          break;
         case 2:
          url = "{{url('employee/dashboard/others/surveillance')}}";
          break;
         case 3:
          url = "{{url('employee/dashboard/others/monitoring')}}";
          break;
      }
      window.location.href = url;
    }
  </script>

<!---------------------------  Added as of January 2023  ----------------------------->
