@extends('mainEmployee')
@section('title', 'Surveillance')
@section('content')
  <div class="content p-4">
    <div class="card">
      <div class="card-header bg-white font-weight-bold">
           @include('employee.cmp._survHead')
           {{-- <a href="#" title="Add New Surveillance" data-toggle="modal" data-target="#monModal"><button class="btn-primarys"><i class="fa fa-plus-circle"></i>&nbsp;Add new</button></a> --}}
           {{-- <div class="container"> --}}
             <div class="row mt-3">

              <!-- <div class="col-sm-3">
                <button type="button" class="btn btn-info w-100" data-toggle="modal" data-target="#monModal">
                  <i class="fa fa-plus" aria-hidden="true"></i> &nbsp;
                  Add Licensed Facility
                </button>
              </div> -->
               
               <div class="col-sm-3">
                <button type="button" onclick="backToAdd()" class="btn btn-info w-100" data-toggle="modal" data-target="#unregModal">
                  <i class="fa fa-plus" aria-hidden="true"></i> &nbsp;
                  Add Unlicensed Facility
                </button>
              </div>

              <div class="col-sm-3">
                <button type="button" class="btn btn-info w-100" data-toggle="modal" data-target="#fromComplaints">
                  <i class="fa fa-plus" aria-hidden="true"></i> &nbsp;
                  Add From Complaints
                </button>
              </div>
              
             </div>
           {{-- </div> --}}
      </div>
      
      @include('employee.tableDateSearch')
      <div class="card-body">
			<div class="card-body table-responsive">
				<table class="table table-hover" style="font-size: 13px;" id="example">
          <!-- <table class="table table-hover" style="font-size: 13px; width: 100%" id="exampleSurv"> -->
          <!-- <table class="table table-hover" style="font-size: 13px;" id="example"> -->
            <thead>
              <tr>
                <th scope="col" style="text-align: center; width:auto;">ID</th>
                <th scope="col" style="text-align: center; width:auto">Name of Facility</th>
                <th scope="col" style="text-align: center; width:auto">Surveillance Entry From</th>
                <th scope="col" style="text-align: center; width:150px;">Location/ <br>Address</th>
                <th scope="col" style="text-align: center; width:auto">Facility Code</th>
                {{-- <th scope="col" style="text-align: center; width:auto">Date of Monitoring</th> --}}
                <th scope="col" style="text-align: center; width:auto">Team Assigned</th>
                <th scope="col" style="text-align: center; width:auto">Surveillance Schedule</th>
                {{-- <th scope="col" style="text-align: center; width:auto">Span of <br> Inspection</th> --}}
                <th scope="col" style="text-align: center; width:auto;">NOV <br>Reference<br> number</th>
                <th scope="col" style="text-align: center; width:auto;">Reported Violation</th>
                {{-- <th scope="col" style="text-align: center; width:auto">Status of Compliance</th> --}}
                {{-- <th scope="col" style="text-align: center; width:auto">Course <br>of<br>Action/Remarks</th> --}}
                <th scope="col" style="text-align: center; width:auto">Status</th>
                <th scope="col" style="text-align: center; width:auto">Options</th>
              </tr>
            </thead>
            <tbody>
              @isset($AllData)
                @foreach($AllData as $key => $value)
                  <tr>
                    <td style="text-align:center">{{$value->survid}}</td>
                    <td style="text-align:center">{{$value->name_of_faci}}</td>
                    <td style="text-align:center">{{$value->fromWhere}}</td>
                    <td style="text-align:center">{{$value->address_of_faci}}</td>
                    <td style="text-align:center">{{$value->hgpdesc}}</td>
                    <!-- <td style="text-align:center">$value->facname</td> -->
                    {{-- <td style="text-align:center">{{ \Carbon\Carbon::parse($value->date_recom)->format('M d, Y') }}</td> --}}
                    <td style="text-align:center">
                      @if($value->team != "")
                      
                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#sMonModal" onclick="showTeamSurv('{{$value->team}}')">
                          <i class="fa fa-fw fa-eye"></i>
                          Show Team
                        </button>
                      @else
                        <span style="color: red"><b>Not Yet Assigned</b></span>
                      @endif
                    </td>
                    <td style="text-align:center">
                      @if($value->date_surveillance != "") 
                        <b>{{\Carbon\Carbon::parse($value->date_surveillance)->format('M d, Y')}}</b> to
                        <b>{{\Carbon\Carbon::parse($value->date_surveillance_end)->format('M d, Y')}}</b>
                      @endif
                    </td>
                    {{-- <td style="text-align:center">
                      @if($value->date_surveillance != "") 
                        {{\Carbon\Carbon::parse($value->date_monitoring)->format('M d, Y')}}
                        @php
                          $date_start = new DateTime($value->date_surveillance);
                          $date_end = new DateTime($value->date_surveillance_end);
                          $interval = $date_start->diff($date_end);
                          $interval->d = $interval->d;
                        @endphp
                        @if($interval->d > 1)
                          {{$interval->d}} days
                        @else
                          {{$interval->d}} day
                        @endif
                      @endif
                    </td> --}}
                    <td style="text-align:center">{{$value->hfsrbno}}</td>
                    <td style="text-align:center" class="font-weight-bold">{{$value->violation}}</td>
                   
                    <td style="text-align:center;" class="text-light font-weight-bold">
                        <span style="color: black">
                        @if($value->status)
                        {{ $value->status != 'RS' ? AjaxController::getTransStatusById($value->status)[0]->trns_desc : ( $value->s_ver_others ?  $value->s_ver_others : $value->vdesc) }}
                        @endif
                        </span>
                    </td>

                    <!-- @if($value->isApproved == "1")
                      <td style="text-align:center;" class="bg-success text-light font-weight-bold">
                        <span style="text-shadow: 2px 2px 4px #000000">
                          {{AjaxController::getTransStatusById('A')[0]->trns_desc}}
                        </span>
                      </td>
                    @elseif($value->isFinePaid != "" )
                      <td style="text-align:center;" class="bg-info text-light font-weight-bold">
                        <span style="text-shadow: 2px 2px 4px #000000">
                          {{AjaxController::getTransStatusById('PP')[0]->trns_desc}}
                        </span>
                      </td>
                    @elseif($value->recommendation != "")
                      <td style="text-align:center;" class="bg-primary text-light font-weight-bold">
                        <span style="text-shadow: 2px 2px 4px #000000">
                          {{AjaxController::getTransStatusById('FPE')[0]->trns_desc}}
                        </span>
                      </td>
                    @elseif($value->assessmentStatus != "")
                      <td style="text-align:center;" class="bg-warning text-light font-weight-bold">
                        <span style="text-shadow: 2px 2px 4px #000000">
                          {{AjaxController::getTransStatusById('FA')[0]->trns_desc}}
                        </span>
                      </td> 
                    @elseif($value->team != "")
                      <td style="text-align:center;" class="bg-danger text-light font-weight-bold">
                        <span style="text-shadow: 2px 2px 4px #000000">
                          {{AjaxController::getTransStatusById('FS')[0]->trns_desc}}
                        </span>
                      </td>
                    @elseif($value->team == "")
                      <td style="text-align:center;" class="bg-secondary text-light font-weight-bold">
                        <span style="text-shadow: 2px 2px 4px #000000">
                          {{AjaxController::getTransStatusById('NT')[0]->trns_desc}}
                        </span>
                      </td>
                    @endif -->

                    <td style="text-align:center">
                      <div class="dropup">
                      
                        <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <i class="fa fa-align-justify"></i>
                        </button>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton" style="padding-left: 5px">
                          
                         
                          <button class="btn btn-outline-info" data-toggle="modal" data-target="#eMonModal" onclick="getEditData(
                          '{{$value->hfsrbno}}', '{{$value->name_of_faci}}', '{{AjaxController::getHgpByFacid($value->type_of_faci)[0]->hgpdesc }}', '{{\Carbon\Carbon::parse($value->date_added)->format('M d, Y')}}')" title="View {{$value->name_of_faci}}">
                            <i class="fa fa-fw fa-eye"></i>
                          </button>  

  <!-- <button class="btn btn-outline-info" data-toggle="modal" data-target="#eMonModal" onclick="getEditData(
                          '{{$value->hfsrbno}}', '{{$value->name_of_faci}}', ' AjaxController::getHgpByFacid($value->type_of_faci)[0]->hgpdesc ', '{{\Carbon\Carbon::parse($value->date_added)->format('M d, Y')}}')" title="View {{$value->name_of_faci}}">
                            <i class="fa fa-fw fa-eye"></i>
                          </button>  
 -->


                           <!-- <button class="btn btn-outline-info" data-toggle="modal" data-target="#eMonModal" onclick="getEditData(
                          '{{$value->hfsrbno}}', '{{$value->name_of_faci}}', ' AjaxController::getFacTypeByFacid($value->type_of_faci)[0]->facname ', '{{\Carbon\Carbon::parse($value->date_added)->format('M d, Y')}}')" title="View {{$value->name_of_faci}}">
                            <i class="fa fa-fw fa-eye"></i>
                          </button> -->
                          @if($value->team != "")
                            @php
                              $url = 'employee/dashboard/processflow/assessment/'.$value->survid.'/SURV/'.$value->type_of_faci;
                            @endphp
                            {{-- <button class="btn btn-outline-primary" title="Inspect {{$value->name_of_faci}}" onclick="window.location.href='{{url($url)}}'">
                              <i class="fa fa-search" aria-hidden="true"></i>
                            </button> --}}
                          @endif
                          
                          @if(strtolower($value->fromWhere) == 'unregistered facility')
                            <button class="btn btn-outline-warning" onclick="editData('{{$value->survid}}')" title="Delete {{$value->name_of_faci}}">
                              <i class="fa fa-fw fa-edit"></i>
                            </button>
                          @endif

                          @if($value->team == "")
                            <button class="btn btn-outline-danger" data-toggle="modal" data-target="#dMonModal" onclick="getDelData(
                              '{{$value->survid}}', '{{$value->name_of_faci}}'
                              )" title="Delete {{$value->name_of_faci}}">
                              <i class="fa fa-fw fa-trash"></i>
                            </button>
                          @endif
                        </div>
                      </div>

                      {{-- <center>
                        <button class="btn btn-outline-info" data-toggle="modal" data-target="#eMonModal" onclick="getEditData(
                          '{{$value->hfsrbno}}', '{{$value->name_of_faci}}', '{{ AjaxController::getHgpByFacid($value->type_of_faci)[0]->hgpdesc }}', '{{\Carbon\Carbon::parse($value->date_added)->format('M d, Y')}}')" title="View {{$value->name_of_faci}}">
                          <i class="fa fa-fw fa-eye"></i>
                        </button>  
                        <!-- <button class="btn btn-outline-info" data-toggle="modal" data-target="#eMonModal" onclick="getEditData(
                          '{{$value->hfsrbno}}', '{{$value->name_of_faci}}', ' AjaxController::getHgpByFacid($value->type_of_faci)[0]->hgpdesc ', '{{\Carbon\Carbon::parse($value->date_added)->format('M d, Y')}}')" title="View {{$value->name_of_faci}}">
                          <i class="fa fa-fw fa-eye"></i>
                        </button> -->
 <!-- <button class="btn btn-outline-info" data-toggle="modal" data-target="#eMonModal" onclick="getEditData(
                          '{{$value->hfsrbno}}', '{{$value->name_of_faci}}', ' AjaxController::getFacTypeByFacid($value->type_of_faci)[0]->facname ', '{{\Carbon\Carbon::parse($value->date_added)->format('M d, Y')}}')" title="View {{$value->name_of_faci}}">
                          <i class="fa fa-fw fa-eye"></i>
                        </button> -->

                        @if($value->team != "")
                          @php
                            $url = 'employee/dashboard/processflow/assessment/'.$value->survid.'/SURV/'.$value->type_of_faci;
                          @endphp
                          <button class="btn btn-outline-primary" title="Inspect {{$value->name_of_faci}}" onclick="window.location.href='{{url($url)}}'">
                            <i class="fa fa-search" aria-hidden="true"></i>
                          </button>
                        @endif

                        @if(strtolower($value->fromWhere) == 'unregistered facility')
                          <button class="btn btn-outline-warning" onclick="editData('{{$value->survid}}')" title="Delete {{$value->name_of_faci}}">
                            <i class="fa fa-fw fa-edit"></i>
                          </button>
                        @endif

                        @if($value->team == "")
                          <button class="btn btn-outline-danger" data-toggle="modal" data-target="#dMonModal" onclick="getDelData(
                            '{{$value->survid}}', '{{$value->name_of_faci}}'
                            )" title="Delete {{$value->name_of_faci}}">
                            <i class="fa fa-fw fa-trash"></i>
                          </button>
                        @endif
                      </center> --}}
                    </td>
                  </tr>
                @endforeach
              @endisset
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>  

  {{-- Monitoring Identification --}}
  <div class="modal fade" id="monModal" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content " style="border-radius: 0px;border: none;">
        <div class="modal-body text-justify" style=" background-color: #272b30;color: white;">
          <h5 class="modal-title text-center">
            <strong>Add New Facility To Survey</strong> 
            <span class="btn button-outline-primary" data-toggle="tooltip" title="" data-html="true" style="cursor: pointer" data-original-title="<b style='color:yellow'>WARNING</b>, Submitting new facility is irreversible.">
              <i class="fa fa-question-circle" aria-hidden="true"></i>
            </span>
          </h5>
          <hr>
          <div class="input-group form-inline">
            <div class="card-body">
            <!--  -->
              <form method="POST" action="{{asset('employee/dashboard/others/surv_submit/regfac')}}" data-parsley-validate>
              <!-- <form method="POST" action="{{asset('employee/dashboard/others/surv_submit')}}" data-parsley-validate> -->

                {{csrf_field()}}

                <input type="hidden" name="e_sappid" id="e_sappid">
                <input type="hidden" name="e_date" id="e_date" value="{{date('Y-m-d')}}">
                <input type="hidden" name="fromWhere" value="Registered Facility">

                {{-- Criteria --}}
                <div class="row mb-2">
                  <div class="col-sm-4">
                    Type of Facility:<span style="color:red">*</span>
                  </div>

                  <div class="col-sm-8">
                    <select name="name_of_faci" class="form-control w-100" onchange="changeFactypeNew(this.value)" id="factype" data-parsley-required-message="<b>*Type of Facility</b> required" required data-parsley="factype" required>  
                    <!-- <select name="name_of_faci" class="form-control w-100" onchange="changeFaciSurveillance()" id="factype" data-parsley-required-message="<b>*Type of Facility</b> required" required data-parsley="factype" required>   -->
                      <option disabled hidden selected value=""></option>
                      @isset($TypName)
                        @foreach($TypName as $key => $value)
                          <option value="{{$value->hgpid}}">{{$value->hgpdesc}}</option>
                        @endforeach
                      @endisset
                    </select>
                  </div>
                </div>

                {{-- Name of Facility --}}

                <div class="row mb-2">
                  <div class="col-sm-4">
                    Name of Facility:<span style="color:red">*</span> &nbsp;&nbsp;

                    {{-- <span class="btn button-outline-primary" data-toggle="tooltip" title="" data-html="true" style="cursor: pointer" data-original-title="Selecting multiple facilites will only select the latter.">
                      <i class="fa fa-question-circle" aria-hidden="true"></i>
                    </span> --}}

                  </div>

                  <div class="col-sm-8">
                    <select name="e_sappid" class="form-control w-100" id="facName" data-parsley-required-message="<b>*Name of Facility</b> required" class="form-control" required data-parsley-multiple="facName" onchange="changeFacnameNew(this.value)">
                    <!-- <select name="e_sappid" class="form-control w-100" id="facName" data-parsley-required-message="<b>*Name of Facility</b> required" class="form-control" required data-parsley-multiple="facName" onchange="changeFaciType()"> -->
                       <option diabled hidden selected value=""></option> 
                    </select>
                  </div>
                </div>
                  

                {{-- <div class="input-group form-inline mb-1">
                  <input class="form-control" type="" name="">
                  <div class="input-group-append">
                    <button class="btn btn-danger" title="Clear" type="button"><i class="fa fa-times" aria-hidden="true"></i></button>
                  </div>
                  <div class="input-group-append">
                    <button class="btn btn-primary" title="Add New Licensed Facility" type="button"><i class="fa fa-plus" aria-hidden="true"></i></button>
                  </div>
                </div> --}}

                {{-- address of faci --}}
                <div class="row mb-2">
                  <div class="col-sm-4">
                    Address of Facility:<span style="color:red">*</span>
                  </div>

                  <div class="col-sm-8">
                    <input type="text" name="address_of_faci"  class="form-control form-inline w-100" readonly required id="facaddr" data-parsley-required-message="<b>*Address of Facility</b> required" data-parsley="facName">
                  </div>
                </div>

                <hr>

                <div class="row">
                  <div class="col-sm-4">
                    &nbsp;
                  </div>

                  {{-- <div class="col-sm-4">
                    <button type="button" class="btn btn-info w-100" data-toggle="modal" data-target="#unregModal">
                      <i class="fa fa-plus" aria-hidden="true"></i> &nbsp;
                      Add unregistered facility
                    </button>
                  </div> --}}

                  {{-- <div class="col-sm-4">
                    <button type="button" class="btn btn-info w-100" data-toggle="modal" data-target="#fromComplaints">
                      <i class="fa fa-plus" aria-hidden="true"></i> &nbsp;
                      Add From Complaints
                    </button>
                  </div> --}}

                  <div class="col-sm-4 mt-1">
                    &nbsp;
                  </div>

                  <!--<div class="col-sm-8 mt-1">
                    <button type="button" class="btn btn-warning w-100" data-toggle="modal" data-target="#">
                      <i class="fa fa-plus" aria-hidden="true"></i> &nbsp;
                      Add from Complaints
                    </button>
                  </div>-->

                </div>
                <hr>
                <div class="mx-auto">
                  <button type="submit" name="btn_sub" class="btn btn-primary"><b>SUBMIT</b></button>
                </div>
              </form> 
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script type="text/javascript">
    function submitprompt(children) {
      console.log(children);
      if(document.getElementById('factype').value == "") {
        document.getElementById('prmsg').innerHTML = "<b>Please select a facility before submitting.</b>";
        document.getElementById('prsubmit').hidden=true;
        document.getElementById('prclose').hidden=false;
      } else if(document.getElementById('facName').value == "") {
        document.getElementById('prmsg').innerHTML = "<b>Please select a facility before submitting.</b>";
        document.getElementById('prsubmit').hidden=true;
        document.getElementById('prclose').hidden=false;
      }else {
        document.getElementById('prsubmit').hidden=false;
        document.getElementById('prclose').hidden=true;
        document.getElementById('prmsg').innerHTML = "<b>Add this facility to survey: </b>";
        document.getElementById('p_sappid').value = document.getElementById('e_sappid').value;
        document.getElementById('p_date').value = document.getElementById('e_date').value;
        document.getElementById('prfactype').value = document.getElementById('factype').value;

        var display = "";
        Array.from(children).forEach(function(v) {
          if(v.value==children.value) {
            // console.log(v);
            display += v.innerText + "<br>";
            document.getElementById('prdisplay').innerHTML = display;
          }
        });
      } 
    }
  </script>

  {{-- Monitoring Evaluate --}}
  <div class="modal fade" id="eMonModal" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content " style="border-radius: 0px;border: none;">
        <div class="modal-body text-justify" style=" background-color: #272b30;color: white;">
          <h5 class="modal-title text-center"><strong>View Surveillance</strong></h5>
          <hr>
          <div class="input-group form-inline mb-1 mt-2">
            <form class="container" method="POST" action="">
              {{csrf_field()}}

              {{-- hfsrbno --}}
              <input class="form-control w-100" type="" name="hfsrbno" id="hfsrbno" hidden>

              {{-- nov --}}
              <div class="row mb-3">
                <div class="col-sm-5 w-100">
                  NOV Reference number:
                </div>

                <div class="col-sm-7 w-100">
                  <input class="form-control w-100" type="" name="edit_nov" id="edit_nov" readonly>
                </div>
              </div>

              {{-- date issued --}}
              <div class="row mb-3">
                <div class="col-sm-5 w-100">
                    Date Added:
                </div>

                <div class="col-sm-7 w-100">
                    <input class="form-control w-100" type="" name="edit_date" id="edit_date" readonly>
                </div>
              </div>

              {{-- name --}}
              <div class="row mb-3">
                <div class="col-sm-5 w-100">
                  Name of Facility:
                </div>

                <div class="col-sm-7 w-100" colspan="12">
                  <input class="form-control w-100" type="" name="edit_name" id="edit_name" readonly>
                </div>
              </div>

              {{-- type --}}
              <div class="row mb-3">
                <div class="col-sm-5 w-100">
                  Type of Facility:
                </div>

                <div class="col-sm-7 w-100">
                  <input class="form-control w-100" type="" name="edit_type" id="edit_type" readonly>
                </div>
              </div>

              <!--{{-- violation --}}
              <div class="row">
                <div class="col w-100" colspan="12">
                  Violation:
                </div>
              </div>
              <div class="row mb-2">
                <div class="col w-100" colspan="12">
                  <input class="form-control w-100" type="" name="edit_violation" id="edit_violation" readonly>
                </div>
              </div>

              {{-- recommendation --}}
              <div class="row">
                <div class="col w-100" colspan="12">
                  Recommendation:
                </div>
              </div>
              <div class="row mb-2">
                <div class="col w-100" colspan="12">
                  <input class="form-control w-100" type="" name="edit_recommendation" id="edit_recommendation" readonly>
                </div>
              </div>

              {{-- recommentaion-cont --}}
              <div class="row">
                <div class="col w-100" colspan="12">
                  
                </div>
              </div>
              <div class="row mb-2">
                <div class="col w-100" colspan="12">
                  <input class="form-control w-100" type="" name="edit_recommendation_cont" id="edit_recommendation_cont" readonly>
                </div>
              </div>

              <!--{{-- monitoring team --}}
              <div class="row">
                <div class="col w-100" colspan="12">
                  Monitoring Team:
                </div>
              </div>
              <div class="row mb-2">
                <div class="col w-100" colspan="12">
                  <input class="form-control w-100" type="" name="edit_monitoring" id="edit_monitoring" readonly>
                </div>
              </div>

              {{-- status --}}
              <div class="row">
                <div class="col w-100" colspan="12">
                  Status of Compliance:
                </div>
              </div>
              <div class="row mb-2">
                <div class="col w-100" colspan="12">
                  <select class="form-control w-100" type="" name="edit_status" id="edit_status" onchange="editSurvOthers(this)">
                    <option value="approved">Approved</option>
                    <option value="notapproved">Not Approved</option>
                    <option value="ot">Others:</option>
                  </select>
                </div>
              </div>
              {{-- hidden --}}
              <div class="input-group form-inline mb-1" id="edit_ver_others" hidden>
                <textarea type="" name="edit_ver_others" class="form-control" placeholder="Specify" disabled></textarea>
              </div>-->

              {{-- submit btn --}}
              <div class="row mt-3">
                <div class="col" colspan="6">
                  {{-- <button type="button" class="btn btn-outline-success w-100"><center>Save</center></button> --}}
                </div>
                <div class="col" colspan="6">
                  <button type="button" data-dismiss="modal" class="btn btn-outline-danger w-100"><center>Close</center></button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  {{-- Monitoring Team --}}
  <div class="modal fade" id="sMonModal" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content " style="border-radius: 0px;border: none;">
        <div class="modal-body text-justify" style=" background-color: #272b30;color: white;">
          <h5 class="modal-title text-center"><strong>View Team</strong></h5>
          <hr>
          <div class="input-group form-inline mb-1 mt-2">
            <form class="container" method="POST" action="">
              
              <div class="row mt-3">
                <div class="col-sm-5">
                  Teams:
                </div>
                <div class="col-sm-7">
                  <input readonly id="steam" class="form-control w-100">
                </div>
              </div>

              <div class="row mt-3">
                <div class="col-sm-12">
                  Members:
                </div>
                <div class="col-sm-12">
                  <!-- <select readonly class="form-control w-100" id="smember" multiple rows="5" disabled></select> -->
                  <ul id="myList" style=" text-transform: capitalize;">
                    <!-- <li>Coffee</li>
                    <li>Tea</li> -->
                  </ul>
                </div>
              </div>

              {{-- submit btn --}}
              <div class="row mt-3">
                <div class="col-sm-6">
                  {{-- <button type="button" class="btn btn-outline-success w-100"><center>Save</center></button> --}}
                </div>
                <div class="col-sm-6">
                  <button type="button" data-dismiss="modal" class="btn btn-outline-danger w-100"><center>Close</center></button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  {{-- Monitoring Delete --}}
  <div class="modal fade" id="dMonModal" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content " style="border-radius: 0px;border: none;">
        <div class="modal-body text-justify" style=" background-color: #272b30;color: white;">
          <h5 class="modal-title text-center"><strong>Delete Surveillance</strong></h5>
          <hr>
          <div class="input-group form-inline mb-1 mt-2">
            <form class="container" method="POST" action="{{asset('employee/dashboard/others/surv_delete')}}">
              {{csrf_field()}}

              {{-- monid --}}
              <input class="form-control w-100" type="" name="dmonid" id="dmonid" hidden>

              {{-- message --}}
              <div class="row">
                <div class="col w-100" colspan="12">
                  <center>Are you sure you want to delete <b><span style="color:red" id="delMsg"></span></b></center>
                </div>
              </div>

              {{-- submit btn --}}
              <div class="row mt-3">
                <div class="col" colspan="6">
                  <button type="submit" class="btn btn-outline-success w-100"><center>Yes</center></button>
                </div>
                <div class="col" colspan="6">
                  <button type="button" data-dismiss="modal" class="btn btn-outline-danger w-100"><center>No</center></button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  {{-- Monitoring Submit Prompt --}}
  <div class="modal fade" id="prModal" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content " style="border-radius: 0px;border: none;">
        <div class="modal-body text-justify" style=" background-color: #5a636b;color: white;">
          <h5 class="modal-title text-center">
            <strong>CONFIRMATION</strong> 
          </h5>
          <hr>
          <div class="input-group form-inline">
            <div class="card-body">
              <form method="POST" action="{{asset('employee/dashboard/others/surv_submit')}}" data-parsley-validate>

                {{csrf_field()}}

                <input type="hidden" name="e_sappid" id="p_sappid">
                <input type="hidden" name="e_date" id="p_date" value="{{date('Y-m-d')}}">

                <div class="row mb-5">
                  <div class="col-sm-12" id="prmsg">
                  </div>

                  <div class="col-sm-12 mt-3" id="prdisplay">
                  </div>
                </div>

                {{-- Criteria --}}
                {{-- <div class="row mb-2">
                  <div class="col-sm-4">
                    Type of Facility:<span style="color:red">*</span>
                  </div>

                  <div class="col-sm-8">
                    <select name="name_of_faci" class="form-control w-100" onchange="changeFaciMonitoring()" id="prfactype" data-parsley-required-message="<b>*Type of Facility</b> required" required data-parsley="factype">  
                      <option disabled hidden selected value=""></option>
                      @isset($TypName)
                        @foreach($TypName as $key => $value)
                          <option value="{{$value->facid}}">{{$value->facname}}</option>
                        @endforeach
                      @endisset
                    </select>
                  </div>
                </div> --}}

                {{-- Name of Facility --}}

               {{--  <div class="row mb-2">
                  <div class="col-sm-4">
                    Name of Facility:<span style="color:red">*</span> &nbsp;&nbsp;

                    <span class="btn button-outline-primary" data-toggle="tooltip" title="" data-html="true" style="cursor: pointer" data-original-title="All Available Facilities will be selected.">
                      <i class="fa fa-question-circle" aria-hidden="true"></i>
                    </span>

                  </div>

                  <div class="col-sm-8">
                    <select name="type_of_faci" class="form-control w-100" id="pfacName" multiple onchange="changeFaciType()"> --}}
                      {{-- <option diabled hidden selected value=""></option> --}}
               {{--      </select>
                  </div>
                </div> --}}

                {{-- address of faci --}}
               {{--  <div class="row">
                  <div class="col-sm-4">
                    Address of Facility:<span style="color:red">*</span>
                  </div>

                  <div class="col-sm-8">
                    <input type="text" name="address_of_faci" class="form-control form-inline w-100" readonly id="pfacaddr">
                  </div>
                </div> --}}

                <div class="row">
                  <div class="col-sm-12">
                    <button type="submit" name="btn_sub" id="prsubmit" class="btn btn-primary w-100"><b>SUBMIT</b></button>
                  </div>
                </div>

                <div class="row" id="prclose">
                  <div class="col-sm-12">
                    <button type="submit" data-dismiss="modal"  name="btn_sub" class="btn btn-danger w-100"><b>CLOSE</b></button>
                  </div>
                </div>
              </form> 
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  {{-- Monitoring Unregister Submit --}}
  <div class="modal fade" id="unregModal" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content " style="border-radius: 0px;border: none;">
        <div class="modal-body text-justify" style=" background-color: #5a636b;color: white;">
          <h5 class="modal-title text-center">
            <strong>Add Unlicensed Facility</strong> 
          </h5>
          <hr>
          <div class="input-group form-inline">
            <div class="card-body">
              <form id="unreg" method="POST" action="{{asset('employee/dashboard/others/surv_submit_u')}}" data-parsley-validate>

                {{csrf_field()}}
                <input type="hidden" name="forEdit" value="yes">
                <input type="hidden" name="fromWhere" value="Unregistered Facility">
                <input type="hidden" name="u_sdate" id="u_sdate" value="{{date('Y-m-d')}}">
                <input type="hidden" name="formNeed">
                <div class="row mb-3">
                  <div class="col-sm-4">
                    <b>Name of Facility:<span style="color:red">*</span></b>
                  </div>

                  <div class="col-sm-8">
                    <input class="form-control w-100" type="u_nameoffaci" id="u_nameoffaci" name="u_nameoffaci" data-parsley-required-message="<b>*Name of Facility</b> required" required>
                  </div>
                </div>

                <div class="row mb-3">
                  <div class="col-sm-4">
                    <b>Type of Facility:<span style="color:red">*</span></b>
                  </div>

                  <div class="col-sm-8">
                    <select class="form-control w-100" id="u_typeoffaci" name="u_typeoffaci" data-parsley-required-message="<b>*Type of Facility</b> required" required data-parsley="factype">
                      <option selected disabled hidden>Facility Type </option>
                      <!-- @foreach(AjaxController::getAllFacilityType() as $key => $value)
                        @if($value->servtype_id == 1)
                        <option value="{{$value->facid}}">{{$value->facname}}</option>
                        @endif

                      @endforeach -->
                      @isset($TypName)
                        @foreach($TypName as $key => $value)
                          <option value="{{$value->hgpid}}">{{$value->hgpdesc}}</option>
                        @endforeach
                      @endisset
                    </select>
                  </div>
                </div>

                <div class="row mb-3">
                  <div class="col-sm-4">
                    <b>Location:<span style="color:red">*</span></b>
                  </div>

                  <div class="col-sm-8">

                    <div class="row mb-1">
                      <div class="col-sm-6">
                        Region:<br>
                        <select class="form-control w-100" onchange="unregRegionChange(this)" id="u_reg" name="u_reg" data-parsley-required-message="<b>*Region</b> required" required data-parsley="factype">
                          <option selected hidden disabled>Region</option>
                          @foreach(AjaxController::getAllRegion() as $key => $value)
                            <option value="{{$value->rgnid}}">{{$value->rgn_desc}}</option>
                          @endforeach
                        </select>
                      </div>

                      <div class="col-sm-6">
                        Province:<br>
                        <select class="form-control w-100" id="uProv" onchange="unregProvinceChange(this)" name="u_prov" data-parsley-required-message="<b>*Province</b> required" required data-parsley="factype">
                          <option selected hidden disabled>Province</option>
                        </select>
                      </div>
                    </div>

                    <div class="row mb-2">
                      <div class="col-sm-6">
                        City/Municipality:<br>
                        <select class="form-control w-100" id="uCM" onchange="unregCMChange(this)" name="u_cm" data-parsley-required-message="<b>*City/Municipality</b> required" required data-parsley="factype">
                          <option selected hidden disabled>City/Municipality</option>
                        </select>
                      </div>

                      <div class="col-sm-6">
                        Barangay:<br>
                        <select class="form-control w-100" id="uBrgy" name="u_brgy"  data-parsley-required-message="<b>*Barangay</b> required" required data-parsley="factype">
                          <option selected hidden disabled>Barangay</option>
                        </select>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-sm-12">
                        Address:<br>
                        <input class="form-control w-100" id="uAddr" type="" name="uAddr" data-parsley-required-message="<b>*Address</b> required" required data-parsley="factype">
                      </div>
                    </div>

                  </div>
                </div>

                <div class="row mb-3">
                  <div class="col-sm-4">
                    <b>Complaint/Remarks:<span style="color:red">*</span></b>
                  </div>
                  <div class="col-sm-8">
                    <textarea name="complaint" cols="62" rows="10" class="form-control" required="required"></textarea>
                  </div>
                </div>

                <div class="row">
                  <div class="col-sm-6">
                    <button type="" name="btn_sub" class="btn btn-primary" {{-- data-toggle="modal" data-target="#uprModal" onclick="submitprompt(document.getElementById('u_nameoffaci'))" --}}><b>SUBMIT</b></button>
                  </div>
                  <div class="col-sm-6">
                    <button type="button" data-dismiss="modal"  name="btn_sub" class="btn btn-danger w-100"><b>CLOSE</b></button>
                  </div>
                </div>
              </form> 
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="fromComplaints" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content " style="border-radius: 0px;border: none;">
        <div class="modal-body text-justify" style=" background-color: #5a636b;color: white;">
          <h5 class="modal-title text-center">
            <strong>Add From Complaints</strong> 
          </h5>
          <hr>
          <div class="input-group form-inline">
            <div class="card-body">
              <form method="POST" action="{{asset('employee/dashboard/others/surv_submit_u/regfac')}}" id="fromComp" data-parsley-validate>

                {{csrf_field()}}
                <input type="hidden" name="fromWhere" value="Complaints">
                <input type="hidden" name="regfac_idcomp" id="regfac_idcomp" >

                <input type="hidden" name="u_sdate" value="{{date('Y-m-d')}}">
                {{-- <input type="hidden" name="formNeed"> --}}
                <div class="row mb-3">
                  <div class="col-sm-4">
                    <b>Name of Facility:<span style="color:red">*</span></b>

                  </div>

                  <div class="col-sm-8">
                    <select class="form-control w-100" onchange="getComplaintsDet(this)">
                      <option value="">Please Select</option>
                      @foreach($comp as $complaint)
                      <option value="{{$complaint->ref_no}}">{{$complaint->ref_no}}-{{$complaint->name_of_faci}}</option>
                      @endforeach
                    </select>
                    <input type="hidden" name="u_nameoffaci" id="compNameofFaci" hidden="" readonly>
                    <input type="hidden" name="compid" id="compid" hidden="" readonly>
                    {{-- <input class="form-control w-100" type="u_nameoffaci" id="u_nameoffaci" name="u_nameoffaci" data-parsley-required-message="<b>*Name of Facility</b> required" required> --}}
                  </div>
                </div>

                <div class="row mb-3">
                  <div class="col-sm-4">
                    <b>Type of Facility:<span style="color:red">*</span></b>
                  </div>

                  <div class="col-sm-8">
                    {{-- <select class="form-control w-100" id="u_typeoffaci" name="u_typeoffaci" data-parsley-required-message="<b>*Type of Facility</b> required" required data-parsley="factype">
                      <option selected disabled hidden>Facility Type</option>
                      @foreach(AjaxController::getAllFacilityType() as $key => $value)
                        <option value="{{$value->facid}}">{{$value->facname}}</option>
                      @endforeach
                    </select> --}}
                    <input type="text" id="comTypeDisplay" class="form-control w-100" readonly>
                    <input type="hidden" name="u_typeoffaci" id="comType" class="form-control w-100" readonly>
                    <input type="hidden" name="comAppid" id="comAppid" class="form-control w-100" readonly>
                  </div>
                </div>

                <div class="row mb-3">
                  <div class="col-sm-4">
                    <b>Location:<span style="color:red">*</span></b>
                  </div>

                  <div class="col-sm-8">
                      <input type="text" name="address" id="comLoc" class="form-control w-100" readonly>
                  </div>
                </div>

                <div class="row mb-3">
                  <div class="col-sm-4">
                    <b>Complaint:<span style="color:red">*</span></b>
                  </div>
                  <div class="col-sm-8">
                    <textarea name="complaint" id="comComp" cols="62" rows="4" class="form-control" required="required" readonly></textarea>
                  </div>
                </div>

                <div class="row mb-3">
                  <div class="col-sm-4">
                    <b>Details:<span style="color:red">*</span></b>
                  </div>
                  <div class="col-sm-8">
                    <textarea name="details" id="comDetails" cols="62" rows="3" class="form-control" required="required"></textarea>
                  </div>
                </div>

                <div class="row">
                  <div class="col-sm-6">
                    <button type="" name="btn_sub" class="btn btn-primary" {{-- data-toggle="modal" data-target="#uprModal" onclick="submitprompt(document.getElementById('u_nameoffaci'))" --}}><b>SUBMIT</b></button>
                  </div>
                  <div class="col-sm-6">
                    <button type="button" data-dismiss="modal"  name="btn_sub" class="btn btn-danger w-100"><b>CLOSE</b></button>
                  </div>
                </div>
              </form> 
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  {{-- Surveillnace Unreg Submit Prompt --}}
  <div class="modal fade" id="uprModal" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content " style="border-radius: 0px;border: none;">
        <div class="modal-body text-justify" style=" background-color: #8693a0;color: white;">
          <h5 class="modal-title text-center">
            <strong>CONFIRMATION</strong> 
          </h5>
          <hr>
          <div class="input-group form-inline">
            <div class="card-body">
              <form method="POST" action="{{asset('employee/dashboard/others/surv_submit_u')}}" data-parsley-validate>

                {{csrf_field()}}

                <input type="hidden" name="u_date" id="u_date" value="{{date('Y-m-d')}}">
                <input type="hidden" name="u_name" id="u_name">
                <input type="hidden" name="u_type" id="u_type">
                <input type="hidden" name="u_rgn" id="u_rgn">
                <input type="hidden" name="u_prov" id="u_prov">
                <input type="hidden" name="u_cm" id="u_cm">
                <input type="hidden" name="u_brgy" id="u_brgy">
                <input type="hidden" name="u_addr" id="u_addr">

                <div class="row mb-5">
                  <div class="col-sm-12" id="uprmsg">
                  </div>

                  <div class="col-sm-12 mt-3" id="uprdisplay">
                  </div>
                </div>

                <div class="row" id="prclose" id="uprsubmit" hidden>
                  <div class="col-sm-6">
                    <button type="button" data-dismiss="modal"   name="btn_sub" class="btn btn-primary w-100"><b>SUBMIT</b></button>
                  </div>

                  {{-- <div class="col-sm-6" id="uprclose">
                    <button type="button" data-dismiss="modal"  name="btn_sub" class="btn btn-danger w-100"><b>CLOSE</b></button>
                  </div> --}}
                </div>
              </form> 
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script type="text/javascript">
    
    function showTeamSurv(id){
      let aString = '';
      if(id != ""){
        $.ajax({
          url: '{{asset('employee/mf/getMembersInTeam/neww')}}',
          // url: '{{asset('employee/mf/getMembersInTeam')}}',
          method: 'POST',
          data: {_token : $("input[name=_token]").val(), id: id},
          async: false,
          success: function(a){
            console.log(a)


            $("#steam").val(a[0].montname);
            // $("#steam").val(id);
            // if(a.length > 0)
            // {
              $("#myList").empty();
              // $("#smember").empty();
              for (var i = 0; i < a.length; i++) {
                // aString  += '<option>'+a[i].wholename+'</option>';
                // aString  += '<option>'+a[i]['wholename']+'</option>';
                var node = document.createElement("LI");
                var textnode = document.createTextNode(a[i].wholename);
                node.appendChild(textnode);
                document.getElementById("myList").appendChild(node);
              }
              // $("#smember").append(aString);
            // }
          }
        })
      }
    }

    function submitprompt(children) {
      console.log(children);
      if(document.getElementById('u_sdate').value == "" ||
        document.getElementById('u_nameoffaci').value == "" ||
        document.getElementById('u_typeoffaci').value == "" ||
        document.getElementById('u_reg').value == "" || 
        document.getElementById('uProv').value == "" || 
        document.getElementById('uCM').value == "" || 
        document.getElementById('uBrgy').value == "" ||
        document.getElementById('uAddr').value == "") {

        document.getElementById('u_date').value = document.getElementById('u_sdate').value;
        document.getElementById('u_name').value = document.getElementById('u_nameoffaci').value;
        document.getElementById('u_type').value = document.getElementById('u_typeoffaci').value;
        document.getElementById('u_rgn').value = document.getElementById('u_reg').value;
        document.getElementById('u_prov').value = document.getElementById('uProv').value;
        document.getElementById('u_cm').value = document.getElementById('uCM').value;
        document.getElementById('u_brgy').value = document.getElementById('uBrgy').value;
        document.getElementById('u_addr').value = document.getElementById('uAddr').value;

        document.getElementById('uprmsg').innerHTML = "<b>Please fill in the fields before submitting.</b>";
        // document.getElementById('uprsubmit').hidden=true;
        // document.getElementById('uprclose').hidden=false;

      } else {
        document.getElementById('uprsubmit').hidden=false;
        document.getElementById('uprclose').hidden=true;
        document.getElementById('uprmsg').innerHTML = "<b>Add this facility to survey: </b>";
        document.getElementById('p_sappid').value = document.getElementById('e_sappid').value;
        // document.getElementById('p_date').value = document.getElementById('e_date').value;
        // document.getElementById('prfactype').value = document.getElementById('factype').value;
        var display = "";
        Array.from(children).forEach(function(v) {
          display += v.text + " " + "<br>";
        });

        document.getElementById('prdisplay').innerHTML = display;
      }
    }
  </script>

  

  <script type="text/javascript">
 var facnames = JSON.parse('{!!addslashes(json_encode($FacName))!!}')
        console.log(facnames)
function changeFacnameNew (value){
        console.log("value")
        console.log(value)
       

        var result = facnames.filter(function (v) {
                                return v.regfac_id == value;
                            })

                            document.getElementById("facaddr").value = result[0].address

  }
function changeFactypeNew (value){
        console.log("value")
        console.log(value)
       

        var result = facnames.filter(function (v) {
                                return v.facid == value;
                            })
console.log(result)

        for(var i = 0; i < result.length ; i++){
          var x = document.createElement("OPTION");
          x.setAttribute("value", result[i].regfac_id);
          var t = document.createTextNode(result[i].facilityname);
          x.appendChild(t);
          document.getElementById("facName").appendChild(x);
        }
                            // document.getElementById("facaddr").value = result[0].address

  }

    function unregRegionChange(dom) {
      unregRegion.open("GET", "{{asset('employee/dashboard/others/surveillance/unreg')}}"+"/"+dom.value, true);
      unregRegion.send();

      var up = document.getElementById('uProv');
      var uc = document.getElementById('uCM');
      var ub = document.getElementById('uBrgy');

      while(up.firstChild) { up.removeChild(up.firstChild); }
      while(uc.firstChild) { uc.removeChild(uc.firstChild); }
      while(ub.firstChild) { ub.removeChild(ub.firstChild); }

      var x = document.createElement('OPTION');
          x.setAttribute('hidden', '');
          x.setAttribute('selected', '');
          x.setAttribute('disabled', '');
          x.innerHTML = "Province";

      var y = document.createElement('OPTION');
          y.setAttribute('hidden', '');
          y.setAttribute('selected', '');
          y.setAttribute('disabled', '');
          y.innerHTML = "City/Municipality";

      var z = document.createElement('OPTION');
          z.setAttribute('hidden', '');
          z.setAttribute('selected', '');
          z.setAttribute('disabled', '');
          z.innerHTML = "Barangay";

      up.appendChild(x);
      uc.appendChild(y);
      ub.appendChild(z);
      // $('#uProv, #uCM, #uBrgy').trigger('change');

    }

    var unregRegion = new XMLHttpRequest();
      unregRegion.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        var data = JSON.parse(this.responseText);
        
        var select = document.getElementById('uProv');

        while(select.firstChild) {
          select.removeChild(select.firstChild);
        }

        var option1 = document.createElement('OPTION');
              option1.innerText='Select';

              select.appendChild(option1);

        Array.from(data).forEach(function(v) {
          var option = document.createElement('OPTION');
              option.setAttribute('value', v.provid);
              option.innerText=v.provname;

              select.appendChild(option);
        });
      }
    };

    function unregProvinceChange(dom) {
      unregProvince.open("GET", "{{asset('employee/dashboard/others/surveillance/unprov')}}"+"/"+dom.value, true);
      unregProvince.send();

      var uc = document.getElementById('uCM');
      var ub = document.getElementById('uBrgy');

      var y = document.createElement('OPTION');
          y.setAttribute('hidden', '');
          y.setAttribute('selected', '');
          y.setAttribute('disabled', '');
          y.innerHTML = "City/Municipality";

      var z = document.createElement('OPTION');
          z.setAttribute('hidden', '');
          z.setAttribute('selected', '');
          z.setAttribute('disabled', '');
          z.innerHTML = "Barangay";

      while(uc.firstChild) { uc.removeChild(uc.firstChild); }
      while(ub.firstChild) { ub.removeChild(ub.firstChild); }

      uc.appendChild(y);
      ub.appendChild(z);
      // $('#uCM, #uBrgy').trigger('change');
    }

    var unregProvince = new XMLHttpRequest();
      unregProvince.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        var data = JSON.parse(this.responseText);
        
        var select = document.getElementById('uCM');

        while(select.firstChild) {
          select.removeChild(select.firstChild);
        }

        var option1 = document.createElement('OPTION');
              option1.innerText='Select';

              select.appendChild(option1);

        Array.from(data).forEach(function(v) {
          var option = document.createElement('OPTION');
              option.setAttribute('value', v.cmid);
              option.innerText=v.cmname;

              select.appendChild(option);
        });
      }
    };

    function unregCMChange(dom) {
      unregCM.open("GET", "{{asset('employee/dashboard/others/surveillance/uncm')}}"+"/"+dom.value, true);
      unregCM.send();
      
      var ub = document.getElementById('uBrgy');

      var z = document.createElement('OPTION');
          z.setAttribute('hidden', '');
          z.setAttribute('selected', '');
          z.setAttribute('disabled', '');
          z.innerHTML = "Barangay"; 


      while(ub.firstChild) { ub.removeChild(ub.firstChild); }

      ub.appendChild(z);
      // $('#uBrgy').trigger('change');
    }

    var unregCM = new XMLHttpRequest();
      unregCM.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        var data = JSON.parse(this.responseText);
        
        var select = document.getElementById('uBrgy');

        while(select.firstChild) {
          select.removeChild(select.firstChild);
        }

        var option1 = document.createElement('OPTION');
              option1.innerText='Select';

              select.appendChild(option1);

        Array.from(data).forEach(function(v) {
          var option = document.createElement('OPTION');
              option.setAttribute('value', v.brgyid);
              option.innerText=v.brgyname;

              select.appendChild(option);
        });
      }
    };


    function editData (survid){
      $.ajax({
        method: 'POST',
        data: {_token : '{{csrf_token()}}', action: 'getUnregisteredData', survid: survid},
        success: function(a){
          let data = JSON.parse(a);
          let addr = JSON.parse(data['compAddress']);

          console.log("type")
          console.log(data['type_of_faci'])

          $("#unreg").removeAttr('action');
          $("#u_nameoffaci").val(data['name_of_faci']);
          $("#u_typeoffaci").val(data['type_of_faci']).trigger('change');



          $("#u_reg").val(addr['reg']).trigger('change');
          setTimeout(function(){

            $("#uProv").val(addr['prov']).trigger('change');
          },300); 
          
          setTimeout(function(){

            $("#uCM").val(addr['cm']).trigger('change');
          },700); 
          setTimeout(function(){

            $("#uBrgy").val(addr['brgy']).trigger('change');
            
          },700); 

          $('input[name=forEdit]').val(survid);

          $("#uAddr").val(data['address_of_faci']).trigger('change');
          $("textarea[name=complaint]").val(data['violation'])
          setTimeout(function(){
            $("#unregModal").modal('show');
          },700);
          
        }
      })

    }

    function backToAdd(){
      $("#unreg").attr('action','{{asset('employee/dashboard/others/surv_submit_u')}}')
       $("#u_nameoffaci").val('');
          $("#u_typeoffaci").val('');
          $("#u_reg").val('').trigger('change');
          $("#uProv").val('').trigger('change');
          $("#uCM").val('').trigger('change');
          $("#uBrgy").val('').trigger('change');
          $("#uAddr").val('').trigger('change');
          $("textarea[name=complaint]").val('')
    }


    $('select').select2({ width: '100%' })
  </script>
  <script>
			$(document).ready( function () {
    $('#myTable').DataTable();
} );
	</script>

  @include('employee.cmp._othersJS')
@endsection