<script src="//cdn.datatables.net/plug-ins/1.10.24/filtering/row-based/range_dates.js"></script>
<script src="https://cdn.datatables.net/datetime/1.0.3/js/dataTables.dateTime.min.js"></script>

@if (session()->exists('employee_login'))   
  @extends('mainEmployee')

  <!-- bootstrap 4  -->
  <link rel="stylesheet" href="{{ asset('assets/admin/css/vendor/grid.min.css') }}">
    <!-- bootstrap toggle css -->
    <link rel="stylesheet" href="{{asset('assets/admin/css/vendor/bootstrap-toggle.min.css')}}">
    <!-- fontawesome 5  -->
    <link rel="stylesheet" href="{{asset('assets/global/css/all.min.css')}}">
    <!-- line-awesome webfont -->
    <link rel="stylesheet" href="{{asset('assets/global/css/line-awesome.min.css')}}">

    <!-- custom select box css -->
    <link rel="stylesheet" href="{{asset('assets/admin/css/vendor/nice-select.css')}}">
    <!-- code preview css -->
    <link rel="stylesheet" href="{{asset('assets/admin/css/vendor/prism.css')}}">
    <!-- select 2 css -->
    <link rel="stylesheet" href="{{asset('assets/admin/css/vendor/select2.min.css')}}">
    <!-- jvectormap css -->
    <link rel="stylesheet" href="{{asset('assets/admin/css/vendor/jquery-jvectormap-2.0.5.css')}}">
    <!-- datepicker css -->
    <link rel="stylesheet" href="{{asset('assets/admin/css/vendor/datepicker.min.css')}}">
    <!-- timepicky for time picker css -->
    <link rel="stylesheet" href="{{asset('assets/admin/css/vendor/jquery-timepicky.css')}}">
    <!-- bootstrap-clockpicker css -->
    <link rel="stylesheet" href="{{asset('assets/admin/css/vendor/bootstrap-clockpicker.min.css')}}">
    <!-- bootstrap-pincode css -->
    <link rel="stylesheet" href="{{asset('assets/admin/css/vendor/bootstrap-pincode-input.css')}}">
    <!-- dashdoard main css -->
    <link rel="stylesheet" href="{{asset('assets/admin/css/app.css')}}">


  @section('content')

    
  <div class="row mb-none-30">
        <div class="col-xl-3 col-lg-5 col-md-5 mb-30">

            <div class="card b-radius--10 overflow-hidden box--shadow1">
                <div class="card-body p-0">
                    <div class="p-3 bg--white">
                        <div class="text-center">
                            <img src="{{asset('ra-idlis/public/img/doh2.png')}}" alt="@lang('Profile Image')" class="b-radius--10" style="width:70%!important;">
                        </div>
                        <div class="mt-15 text-center">
                            
                            <h4 class="">[{{$user->regfac_id}}] {{$user->facilityname}}</h4>
                            <span class="text--small">@lang('Located at') <strong>{{$user->street_number}} {{$user->street_name}} {{$user->brgyname}}, {{$user->cmname}}, {{$user->provname}} {{$user->rgn_desc}} {{$user->zipcode}}</strong></span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card b-radius--10 overflow-hidden mt-30 box--shadow1">
                <div class="card-body">
                    <h7 class="mb-   text-muted">@lang('Facility information')</h7>
                    <ul class="list-group">

                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span class="row">
                                <span class="col-md-12 small">@lang('Username')</span>
                                <span class="col-md-12 font-weight-bold text-right">{{$user->uid}}</span>
                            </span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span class="row">
                                <span class="col-md-12 small">@lang('Registered Facility ID')</span>
                                <span class="col-md-12 font-weight-bold text-right">{{$user->regfac_id}}</span>
                            </span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span class="row">
                                <span class="col-md-12 small">@lang('NHFR Code')</span>
                                <span class="col-md-12 font-weight-bold text-right">{{$user->nhfcode}}</span>
                            </span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span class="row">
                                <span class="col-md-12 small">@lang('Facility Type')</span>
                                <span class="col-md-12 font-weight-bold text-right">{{$user->facilitytype}}</span>
                            </span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span class="row">
                                <span class="col-md-12 small">@lang('Institutional Character')</span>
                                <span class="col-md-12 font-weight-bold text-right">{{$user->facmdesc}}</span>
                            </span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span class="row">
                                <span class="col-md-12 small">@lang('Owner')</span>
                                <span class="col-md-12 font-weight-bold text-right">{{$user->owner}}</span>
                            </span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span class="row">
                                <span class="col-md-12 small">@lang('Ownership')</span>
                                <span class="col-md-12 font-weight-bold text-right">{{$user->ocdesc}} {{$user->classname}}</span>
                            </span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span class="row">
                                <span class="col-md-12 small">@lang('PTC License')</span>
                                <span class="col-md-12 font-weight-bold text-right">{{$user->ptc_id}}</span>
                            </span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span class="row">
                                <span class="col-md-12 small">@lang('LTO License')</span>
                                <span class="col-md-12 font-weight-bold text-right">{{$user->lto_id}}</span>
                            </span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span class="row">
                                <span class="col-md-12 small">@lang('ATO License')</span>
                                <span class="col-md-12 font-weight-bold text-right">{{$user->ato_id}}</span>
                            </span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span class="row">
                                <span class="col-md-12 small">@lang('COA License')</span>
                                <span class="col-md-12 font-weight-bold text-right">{{$user->coa_id}}</span>
                            </span>
                        </li>   
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span class="row">
                                <span class="col-md-12 small">@lang('COR License')</span>
                                <span class="col-md-12 font-weight-bold text-right">{{$user->cor_id}}</span>
                            </span>
                        </li>   
                    </ul>
                </div>
            </div>

        </div>        
        @php 

            $_tab = "";
            $active_faci = "";
            $active_pers = "";
            $active_appl = "";
            $active_arch = "";
            $active_logs = "";

            $isfaci = "false";
            $ispers = "false";
            $isappl = "false";
            $isarch = "false";
            $islogs = "false";

            if(isset($actiontab)){

                switch ($actiontab) {
				    case 'facility':
                        $active_faci = "active";
                         $isfaci = "true";

                    break;

                    case 'personnel':
                        $active_pers = "active";
                        $ispers = "true";

                    break;

                    case 'application':
                        $active_appl = "active";
                        $isappl = "true";

                    break;

                    case 'archive':
                        $active_arch = "active";
                        $isarch = "true";

                    break;

                    default:
                        $active_logs = "active";
                        $islogs = "true";

                    break;
                }
            }
        
        @endphp
        <div class="col-xl-9 col-lg-7 col-md-7 mb-30">
            <section class="container-fluid">

                <div class="card mt-50" style="min-height:100%">
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li>
                                <a href="{{ asset('employee/dashboard/facilityrecords/') }}/{{$user->regfac_id}}" class="nav-link {{$active_faci}}"  role="tab" aria-selected="{{$isfaci}}"><i class="fa fa-bank"></i> @lang('Facility Profile')</a>
                            </li>
                            <li>
                                <a href="{{ asset('employee/dashboard/facilityrecords/annexa/') }}/{{$user->regfac_id}}"  class="nav-link {{$active_pers}}"  role="tab" aria-selected="{{$ispers}}"><i class="fa fa-group"></i> @lang('List of Personnel')</a>
                            </li>
                            {{-- <li>
                                <a href="{{ asset('employee/dashboard/facilityrecords/') }}/{{$user->regfac_id}}" class="nav-link {{$active_appl}}"  role="tab" aria-selected="{{$isappl}}"><i class="fa fa-file"></i> @lang('List of Applicaitons')</a>
                            </li>  --}}
                            <li>
                                <a  href="{{ asset('employee/dashboard/facilityrecords/archive/') }}/{{$user->regfac_id}}"  class="nav-link {{$active_arch}}"  role="tab" aria-selected="{{$isarch}}"><i class="fa fa-folder"></i> @lang('Archive of Files')</a>
                            </li>
                            <li>
                                <a href="{{ asset('employee/dashboard/facilityrecords/notification') }}/{{$user->uid}}/{{$user->regfac_id}}"  class="nav-link {{$active_logs}}"  role="tab" aria-selected="{{$islogs}}"><i class="fa fa-bell"></i> @lang('Notification History')</a>
                            </li>
                        </ul>	
                    </div>
                    <!---------------------------------->
                    @yield('content-regfacility')
                    <!---------------------------------->
                </div>
            </section>
        </div>

    </div>
    
<!-- jQuery library -->
<script src="{{asset('assets/global/js/jquery-3.6.0.min.js')}}"></script>
<!-- bootstrap js -->
<script src="{{asset('assets/admin/js/vendor/grid.min.js')}}"></script>
<!-- bootstrap-toggle js -->
<script src="{{asset('assets/admin/js/vendor/bootstrap-toggle.min.js')}}"></script>

<!-- slimscroll js for custom scrollbar -->
<script src="{{asset('assets/admin/js/vendor/jquery.slimscroll.min.js')}}"></script>
<!-- custom select box js -->
<script src="{{asset('assets/admin/js/vendor/jquery.nice-select.min.js')}}"></script>


@stack('script-lib')

<script src="{{ asset('assets/admin/js/nicEdit.js') }}"></script>

<!-- code preview js -->
<script src="{{asset('assets/admin/js/vendor/prism.js')}}"></script>
<!-- seldct 2 js -->
<script src="{{asset('assets/admin/js/vendor/select2.min.js')}}"></script>
<!-- main js -->
<script src="{{asset('assets/admin/js/app.js')}}"></script>

{{-- LOAD NIC EDIT --}}
<script>
    "use strict";
    bkLib.onDomLoaded(function() {
        $( ".nicEdit" ).each(function( index ) {
            $(this).attr("id","nicEditor"+index);
            new nicEditor({fullPanel : true}).panelInstance('nicEditor'+index,{hasPanel : true});
        });
    });
    (function($){
        $( document ).on('mouseover ', '.nicEdit-main,.nicEdit-panelContain',function(){
            $('.nicEdit-main').focus();
        });
    })(jQuery);
</script>

@stack('script')




  @endsection
@else
  <script type="text/javascript">window.location.href= "{{ asset('employee') }}";</script>
@endif

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css" />
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/datetime/1.0.3/css/dataTables.dateTime.min.css" />
  