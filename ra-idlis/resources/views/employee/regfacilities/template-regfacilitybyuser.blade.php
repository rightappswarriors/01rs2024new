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
                        <div class="">
                            <img src="{{asset('ra-idlis/public/img/doh2.png')}}" alt="@lang('Profile Image')" class="b-radius--10 w-100">
                        </div>
                        <div class="mt-15">
                            <span class="text--small">@lang('Username ') </span><h4 class="text-bold">{{$user->uid}}</h4>
                            <span class="text--small">@lang('Created On') <strong>{{$user->t_date .' '.$user->t_time}}</strong></span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card b-radius--10 overflow-hidden mt-30 box--shadow1">
                <div class="card-body">
                    <h5 class="mb-20 text-muted">@lang('User information')</h5>
                    <ul class="list-group">

                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            @lang('Username')
                            <span class="font-weight-bold">{{$user->uid}}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            @lang('Total Registered Facilities')
                            <span class="font-weight-bold"><a href="#"> 0 </a></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            @lang('Total Applications')
                            <span class="font-weight-bold"><a href="#"> 0 </a></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                           @lang('Total Pending Applications')
                            <span class="font-weight-bold">0</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                           @lang('Total Approved Application')
                            <span class="font-weight-bold">{{-- $user->userExtra->paid_right --}}0</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            @lang('Total Rejected Application')
                            <span class="font-weight-bold">0</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            @lang('Status')
                            @if($user->isActive == 1)
                                <span class="badge badge-pill bg--success">@lang('Actived')</span>
                            @else
                                <span class="badge badge-pill bg--danger">@lang('Deactivated')</span>
                            @endif
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            @lang('Temporary Banned')
                            @if($user->isTempBanned == 1)
                                <span class="badge badge-pill bg--success">@lang('Temporary Banned')</span>
                            @else
                                <span class="badge badge-pill bg--danger">@lang('Not Banned')</span>
                            @endif
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            @lang('Banned')
                            @if($user->isBanned == 1)
                                <span class="badge badge-pill bg--success">@lang('Banned')</span>
                            @else
                                <span class="badge badge-pill bg--danger">@lang('Not Banned')</span>
                            @endif
                        </li>                        
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            @lang('Email')
                            @if(!isset($user->token) || empty($user->token))
                                <span class="badge badge-pill bg--success">@lang('Verified')</span>
                            @else
                                <span class="badge badge-pill bg--danger">@lang('Not Verified')</span>
                            @endif
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            @lang('Last Change Password')
                            <span class="font-weight-bold">{{$user->lastChangePassDate}} {{$user->lastChangePassTime}}</span>
                        </li>
                    </ul>
                </div>
            </div>

        </div>


        

        <div class="col-xl-9 col-lg-7 col-md-7 mb-30">

            <div class="card mt-50">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active">
                            <a class="nav-link active" id="v-pills-settings-tab" data-toggle="tab" href="#v-pills-settings" role="tab" aria-controls="v-pills-settings" aria-selected="true"><i class="fas fa-user"></i> @lang('User Information')</a> 
                        </li>
                        <li>
                            <a class="nav-link" id="v-pills-mc-tab" data-toggle="pill" href="#v-pills-manager" role="tab" aria-controls="v-pills-pmo" aria-selected="false"><i class="fa fa-check" aria-hidden="true"></i>  @lang('Login Logs') </a>
                        </li>
                        <li>
                            <a class="nav-link" id="v-pills-pmo-tab" data-toggle="pill" href="#v-pills-pmo" role="tab" aria-controls="v-pills-pmo" aria-selected="false"><i class="fa fa-bank"></i> @lang('Registered Facility')</a>
                        </li>
                    </ul>	
                </div>

                <div class="card-body">
                    <h5 class="card-title border-bottom pb-2">@lang('Information of') {{$user->nameofcompany}}</h5>

                    <form action="#" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group ">
                                    <label class="  font-weight-bold">@lang('Name of Company')<span class="text-danger">*</span></label>
                                    <input class="form-control" type="text" name="nameofcompany" value="{{$user->nameofcompany}}">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group ">
                                    <label class="  font-weight-bold">@lang('Athorized Signatory')<span class="text-danger">*</span></label>
                                    <input class="form-control" type="text" name="authorizedsignature" value="{{$user->authorizedsignature}}">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="   font-weight-bold">@lang('Position') <span class="text-danger">*</span></label>
                                    <input class="form-control" type="text" name="assign" value="{{$user->assign}}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group ">
                                    <label class="  font-weight-bold">@lang('Email') <span class="text-danger">*</span></label>
                                    <input class="form-control" type="email" name="email" value="{{$user->email}}">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="   font-weight-bold">@lang('Contact Number') <span class="text-danger">*</span></label>
                                    <input class="form-control" type="text" name="contact" value="{{$user->contact}}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-xl-4 col-md-6  col-sm-3 col-12">
                                <label class="  font-weight-bold">@lang('Status') </label>
                                <input type="checkbox" data-onstyle="-success" data-offstyle="-danger"
                                       data-toggle="toggle" data-on="@lang('Active')" data-off="@lang('Banned')" data-width="100%"
                                       name="status"  @if($user->isActive) checked @endif>
                            </div>

                            <div class="form-group col-xl-4 col-md-6  col-sm-3 col-12">
                                <label class="  font-weight-bold">@lang('Banned') </label>
                                <input type="checkbox" data-onstyle="-success" data-offstyle="-danger"
                                       data-toggle="toggle" data-on="@lang('Unbanned')" data-off="@lang('Banned')" data-width="100%"
                                       name="status"  @if($user->isActive) checked @endif>
                            </div>

                            <div class="form-group col-xl-4 col-md-6  col-sm-3 col-12">
                                <label class="  font-weight-bold">@lang('Temporary Banned') </label>
                                <input type="checkbox" data-onstyle="-success" data-offstyle="-danger"
                                       data-toggle="toggle" data-on="@lang('Unbanned Temporary')" data-off="@lang('Banned Temporary')" data-width="100%"
                                       name="status"  @if($user->isActive) checked @endif>
                            </div>

                            <div class="form-group  col-xl-4 col-md-6  col-sm-3 col-12">
                                <label class="  font-weight-bold">@lang('Email Verification') </label>
                                <input type="checkbox" data-width="100%" data-onstyle="-success" data-offstyle="-danger"
                                       data-toggle="toggle" data-on="@lang('Verified')" data-off="@lang('Unverified')" name="ev"
                                       checked>

                            </div>

                            <div class="form-group  col-xl-4 col-md-6  col-sm-3 col-12">
                                <label class="  font-weight-bold">@lang('SMS Verification') </label>
                                <input type="checkbox" data-width="100%" data-onstyle="-success" data-offstyle="-danger"
                                       data-toggle="toggle" data-on="@lang('Verified')" data-off="@lang('Unverified')" name="sv"
                                       checked >
                            </div>
                        </div>


                        <div class="row mt-4">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <button type="submit" class="btn btn--primary btn-block btn-lg">@lang('Save Changes')
                                    </button>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
            </div>


<!---------------------------------->




@yield('content-regfacilitybyuser')





<!---------------------------------->



        </div>
    </div>


    {{-- Add Sub Balance MODAL --}}
    <div id="addSubModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('Add / Subtract Balance')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="#" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <input type="checkbox" data-width="100%" data-onstyle="-success" data-offstyle="-danger" data-toggle="toggle" data-on="@lang('Add Balance')" data-off="@lang('Subtract Balance')" name="act" checked>
                            </div>


                            <div class="form-group col-md-12">
                                <label>@lang('Amount')<span class="text-danger">*</span></label>
                                <div class="input-group has_append">
                                    <input type="text" name="amount" class="form-control" placeholder="@lang('Please provide positive amount')">
                                    <div class="input-group-append">
                                        <div class="input-group-text"> 0</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn--dark" data-dismiss="modal">@lang('Close')</button>
                        <button type="submit" class="btn btn--success">@lang('Submit')</button>
                    </div>
                </form>
            </div>
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
  