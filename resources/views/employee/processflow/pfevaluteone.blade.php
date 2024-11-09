@if (session()->exists('employee_login'))     
    @php
    $triggerThis = ($forhfsrb ? ($AppData->isrecommended == 2 || $AppData->isrecommended == null) : ($office == 'xray' ? ($AppData->ispreassessed == 2 || $AppData->ispreassessed == null) : ($AppData->ispreassessedpharma == 2 || $AppData->ispreassessedpharma == null)));
    
    @endphp 
    @extends('mainEmployee')
    @section('title', 'Evaluate Process Flow')
    @section('content')

    <style type="text/css">
          .control-group {
            display: inline-block;
            vertical-align: top;
            background: #fff;
            text-align: left;
            margin: 10px;
          }
          .control {
            display: block;
            position: relative;
            padding-left: 30px;
            margin-bottom: 15px;
            cursor: pointer;
            font-size: 18px;
          }
          .control input {
            position: absolute;
            z-index: -1;
            opacity: 0;
          }
          .control__indicator {
            position: absolute;
            top: 2px;
            left: 0;
            height: 20px;
            width: 20px;
            background: #e6e6e6;
          }
          .control--radio .control__indicator {
            border-radius: 50%;
          }
          .control:hover input ~ .control__indicator,
          .control input:focus ~ .control__indicator {
            background: #ccc;
          }
          .control input:checked ~ .control__indicator {
            background: #2aa1c0;
          }
          .control:hover input:not([disabled]):checked ~ .control__indicator,
          .control input:checked:focus ~ .control__indicator {
            background: #0e647d;
          }
          .control input:disabled ~ .control__indicator {
            background: #e6e6e6;
            opacity: 0.6;
            pointer-events: none;
          }
          .control__indicator:after {
            content: '';
            position: absolute;
            display: none;
          }
          .control input:checked ~ .control__indicator:after {
            display: block;
          }
          .control--checkbox .control__indicator:after {
            left: 8px;
            top: 4px;
            width: 3px;
            height: 8px;
            border: solid #fff;
            border-width: 0 2px 2px 0;
            transform: rotate(45deg);
          }
          .control--checkbox input:disabled ~ .control__indicator:after {
            border-color: #7b7b7b;
          }
          .control--radio .control__indicator:after {
            left: 7px;
            top: 7px;
            height: 6px;
            width: 6px;
            border-radius: 50%;
            background: #fff;
          }
          .control--radio input:disabled ~ .control__indicator:after {
            background: #7b7b7b;
          }
          .select {
            position: relative;
            display: inline-block;
            margin-bottom: 15px;
            width: 100%;
          }
          .select select {
            display: inline-block;
            width: 100%;
            cursor: pointer;
            padding: 10px 15px;
            outline: 0;
            border: 0;
            border-radius: 0;
            background: #e6e6e6;
            color: #7b7b7b;
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
          }
          .select select::-ms-expand {
            display: none;
          }
          .select select:hover,
          .select select:focus {
            color: #000;
            background: #ccc;
          }
          .select select:disabled {
            opacity: 0.5;
            pointer-events: none;
          }
          .select__arrow {
            position: absolute;
            top: 16px;
            right: 15px;
            width: 0;
            height: 0;
            pointer-events: none;
            border-style: solid;
            border-width: 8px 5px 0 5px;
            border-color: #7b7b7b transparent transparent transparent;
          }
          .select select:hover ~ .select__arrow,
          .select select:focus ~ .select__arrow {
            border-top-color: #000;
          }
          .select select:disabled ~ .select__arrow {
            border-top-color: #ccc;
          }
          .shadow-textarea textarea.form-control::placeholder {
            font-weight: 300;
          }
          .shadow-textarea textarea.form-control {
              padding-left: 0.8rem;
          }
          .z-depth-1{
            -webkit-box-shadow: 0 2px 5px 0 rgba(0,0,0,.16),0 2px 10px 0 rgba(0,0,0,.12)!important;
            box-shadow: 0 2px 5px 0 rgba(0,0,0,.16),0 2px 10px 0 rgba(0,0,0,.12)!important;
          }
    </style>      

    <div class="content p-4">
      @isset($Holidays)
        <datalist id="HolidaysList">
            @foreach ($Holidays as $day)
              <option id="{{$day->hdy_date}}_dt" typ="{{$day->hdy_typ}}">{{$day->hdy_desc}}</option>
            @endforeach
        </datalist>
      @endisset

        <div class="card">
            <div class="card-header bg-white font-weight-bold">
              <input type="text" id="NumberOfRejected" value="@isset ($numOfX) {{$numOfX}} @endisset" hidden>
              <input type="" id="token" value="{{ Session::token() }}" hidden>
              
              @if(app('request')->input('from') == 'rec')
                <button class="btn btn-primary  ml-3 pb-2 pt-2 mt-2 mb-2 font-weight-bold" onclick="window.history.back();">Back</button>&nbsp;
              @else
                <a href="{{asset('/employee/dashboard/processflow/evaluate')}}"><button class="btn btn-primary  ml-3 pb-2 pt-2 mt-2 mb-2 font-weight-bold" >Back</button></a>
              @endif
               &nbsp; Documentary Evaluation 
            </div>

            <div class="card-body">
              <div class="col-sm-12">

                  <h2>@isset($AppData)[<strong>{{$AppData->hfser_id}}R{{$AppData->rgnid}}-{{$AppData->appid}}</strong>]
                      &nbsp;{{$AppData->facilityname}} @endisset</h2>
                  <h5>
                    @isset($AppData)
                      {{ $AppData->street_number?  strtoupper($AppData->street_number).',' : ' ' }}
                      {{ $AppData->streetname?  strtoupper($AppData->streetname).',': ' '}}
                      {{strtoupper($AppData->brgyname)}}, 
                      {{$AppData->cmname}}, {{$AppData->provname}} 
                    @endisset
                  </h5>
                  <label>Process Type:&nbsp;</label>
                  <span class="font-weight-bold">
                    @if($AppData->aptid == 'R'){{'Renewal'}}@elseif($AppData->aptid == 'IN'){{'Initial New'}}@elseif($AppData->aptid == 'IC'){{'Initial Change'}}@else{{'Unidentified'}}@endif
                    @if(isset($AppData->hfser_id)){{' '.$AppData->hfser_id}}@endif
                  </span>
                
                  @if($forhfsrb)
                    <h6>
                      <label>Institutional Character: </label>
                      @if(isset($AppData) && isset($AppData->facmdesc))
                        <strong>{{$AppData->facmdesc}}</strong>
                      @else
                        <span style="color:red">Not Available</span>
                      @endif

                      &nbsp;&nbsp;&nbsp;
                      <label>Checklist Review Count:&nbsp;</label>
                      <span class="font-weight-bold">
                        @if(isset($AppData)){{$AppData->no_chklist}}@else{{'Not Available'}}@endif
                      </span>                    
                    </h6>
                    @isset($AppData) Status: 
                      @if ($AppData->isrecommended === null) 
                        <span style="color:blue">For Evaluation</span>
                      @elseif($AppData->isrecommended == 1)  
                        <span style="color:green">Accepted Evaluation</span> 
                      @elseif($AppData->isrecommended === 0) 
                        <span style="color:red">Disapproved Evaluation</span> 
                      @else 
                        <span style="color:orange">Evaluated, for Revision</span> 
                      @endif 
                    @endisset
              </div>

              <div class="row">
                
                <div class="col-md-8">
                  @if ($AppData->isrecommended == 2 || $AppData->isrecommended == null)
                    <button data-toggle="modal" data-target="#myModal" class="btn btn-primary ml-3 pb-2 pt-2 mt-2 mb-2 font-weight-bold"><i class="fa fa-plus pr-3"></i>Add Requirements</button>
                  @endif
                </div>
                @if($AppData->hfser_id == 'PTC' && $AppData->isAcceptedFP != 1)
                <div class="col-md-2 d-flex justify-content-end">
                  <a data-toggle="modal" data-target="#floorplan" class="font-weight-bold text-white btn btn-success btn btn-primary ml-3 pb-2 pt-2 mt-2 mb-2"><i class="fa fa-files-o" aria-hidden="true"></i> Receive Floorplan</a>
                </div>
                @endif
                  @if($AppData->aptid == 'IC')
                    <div class="col-md-2 d-flex justify-content-end">
                      <a href="{{asset('client1/changerequest')}}/{{$AppData->regfac_id}}/main" target="_blank" class="font-weight-bold text-white btn btn-block btn-info btn-flat ml-3 pb-2 pt-2 mt-2 mb-2"><i class="fa fa-eye" aria-hidden="true"></i>&nbsp; View Change Application</a>
                    </div>
                  @else
                    <div class="col-md-2 d-flex justify-content-end">
                      <a href="{{$linkToEdit}}?grplo=rlo{{$AppData->aptid == 'R' ? '&type=r': ''}}" target="_blank" class="font-weight-bold text-white btn btn-block btn-info btn-flat ml-3 pb-2 pt-2 mt-2 mb-2"><i class="fa fa-eye" aria-hidden="true"></i>&nbsp; View Application</a>
                    </div>
                  @endif
                @endif
                 
              </div>
               
                
            <table class="table" id="example">
              <thead>
                <tr>
                  <th scope="col" width="60%" >
                    <strong>Requirements</strong>
                  </th>
                  <th scope="col" width="10%">Uploaded File Actions</th>
                  <th scope="col" width="15%">
                    <center> <strong>Uploaded Date & Time</strong></center>
                  </th>
                  <th scope="col" width="15%">
                    <center><strong>Complied?</strong></center>
                  </th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  
                </tr>
              <form id="EvalForm" data-parsley-validate>
                <input type="text" name="TotalNumber" value="@isset($UploadData){{count($UploadData)}}@endisset" hidden>
                @if (isset($UploadData))
                  @foreach ($UploadData as $UpData)
                      
                  <tr>
                    <td >
                      <font>

                        {!!empty($UpData->updesc)? 'No Description' : (!empty($UpData->upDesc) ? $UpData->upDesc .'('.$UpData->updesc.')' . '<br>' . (isset($UpData->upDescRemarks) ? '<span class="font-weight-bold"><br>Evaluator\'s Remarks: <br></span>'. $UpData->upDescRemarks : '') : $UpData->updesc)!!}
                      </font>
                    </td>

                    @if($UpData->upid == 1 && !empty($UpData->upDesc) && !isset($UpData->filepath))
                    <td width="15%">
                      <center class="font-weight-bold">NO FILE UPLOADED YET</center>
                    </td>
                    <td>
                      <center class="font-weight-bold">NOT YET AVAILABLE</center>
                    </td>
                    <td>
                      <center class="font-weight-bold">NOT YET AVAILABLE</center>
                    </td>
                    @else
                    <td>
                      <center>
                        @isset($UpData->filepath)
                        <div class="row">
                        @if(AjaxController::isExist($UpData->filepath))
                          @if(in_array($UpData->fileExten, $accepted))
                          <div class="col-md-6">
                              <a target="_blank" href="{{ route('OpenFile', $UpData->filepath) }}" class="btn btn-primary text-white"><i class="fa fa-eye" aria-hidden="true"></i></a>
                          </div>
                          @endif
                          <div class="col-md-6">
                            <a class="btn btn-primary text-white" href="{{ route('DownloadFile', $UpData->filepath) }}">
                              <i class="fa fa-download" aria-hidden="true"></i>
                            </a>
                          </div>
                          @else
                          <div class="col-md-12 font-weight-bold">
                            File does not exist
                          </div>
                        @endif
                        </div>
                        @else
                        <button type="button" class="btn-primary" style="background-color: red">
                          <i class="fa fa-times" aria-hidden="true"></i>
                        </button>
                        @endisset
                      </center>
                    </td>
                    <td>
                      <center>
                        @if(isset($UpData->formattedUploadTime) || isset($UpData->formattedUploadDate))
                          {{$UpData->formattedUploadDate}}-{{$UpData->formattedUploadTime}} 
                        @else
                          N/A
                        @endif
                      </center>
                    </td>
                    
                    <td>
                      <center>
                        <span class="{{$UpData->apup_id}}_span_edit"{{-- @if($UpData->evaluation !== NULL)style="display: none"@endif --}}>
                          <div class="row booleans laSelected" apup="{{$UpData->apup_id}}" >
                             <div class="col-6">
                               <div class="control-group">
                                <label class="control control--radio">Yes
                                  <input value="1" onblur="savDocDet('{{$UpData->apup_id}}', 1, null)" type="radio" name="{{$UpData->apup_id}}_rad" @if($UpData->evaluation !== NULL AND $UpData->evaluation == 1)checked=""@endif>
                                  <div class="control__indicator"></div>
                                  </label>
                               </div> 
                             </div>
                             <div class="col-6">
                                <div class="control-group">
                                   <label class="control control--radio">No
                                     <input onblur="savDocDet('{{$UpData->apup_id}}', 0, null)" value="0" type="radio" name="{{$UpData->apup_id}}_rad" @if($UpData->evaluation !== NULL AND $UpData->evaluation == 0)checked=""@endif>
                                     <div class="control__indicator"></div>
                                   </label>
                                 </div> 
                          </div>
                        </div>
                          <p style="text-align: left;">Remarks:</p>
                          <textarea onblur="savDocDet('{{$UpData->apup_id}}', null, this.value)" name="{{$UpData->apup_id}}_txt" class="form-control" rows="5">{{$UpData->remarks}} </textarea>
                          <br>
                          {{-- <button type="button" title="Save" onclick="saveEvals()" class="btn btn-success" @if($UpData->evaluation === NULL)style="display: none"@endif><i class="fa fa-floppy-o" aria-hidden="true"></i></button>
                          <button type="button" title="Cancel Edit" onclick="$('.{{$UpData->apup_id}}_span_edit').toggle()" class="btn btn-danger" @if($UpData->evaluation === NULL)style="display: none"@endif><i class="fa fa-times" aria-hidden="true"></i></button> --}}
                        </span>
                        {{-- @else --}}

                         <!-- <span class="{{$UpData->apup_id}}_span_edit" @if($UpData->evaluation === NULL)style="display: none"@else style=""@endif>
                            @if($UpData->evaluation == 1) 
                              <button type="button" title="Evaluation Accepted" class="btn btn-success" disabled>
                               <i class="fa fa-check-circle" aria-hidden="true"></i>
                              </button>
                            @else
                              <button type="button" class="btn btn-danger" title="Evaluation Not Accepted" disabled>
                                <i class="fa fa-times" aria-hidden="true"></i>
                              </button>
                            @endif
                            <button type="button" title="View Remarks" data-toggle="modal" data-target="#ShowDetailsModal" class="btn btn-primary" onclick="ShowDetails({{$UpData->evaluation}}, {{$UpData->apup_id}}, '{{$UpData->updesc}}')">
                              <i class="fa fa-eye" aria-hidden="true"></i>
                            </button>
                            @isset($AppData)
                              @if($triggerThis) 
                                <button type="button" title="Edit" onclick="$('.{{$UpData->apup_id}}_span_edit').toggle()" class="btn btn-warning"><i class="fa fa-edit" aria-hidden="true"></i></button>
                              @endif
                            @endisset
                         </span> -->
                        {{-- @endif --}}
                      </center>
                    </td>
                    @endif

                  </tr>
                  @endforeach
                @endif
              </tbody>  
            </table>
            @if($AppData->hfser_id == 'PTC' && isset($AppData->conCode)) Other Details:  {{$AppData->conCode}}@endif
            <br>
            
          {{--  <div class="col-sm-12" id="TheSaveButton" @if(isset($numOfNull) AND ($numOfNull== 0)) style="display: none" @endif>
              <hr>
              <button type="button" class="btn btn-success" onclick="saveEvals()">
                  <i class="fa fa-floppy-o" aria-hidden="true"></i>  Save Application
                </button>
            </div> --}}
            
            <div class="row">
              <div class="col-sm-12">

                        <!-- data-toggle="modal" data-target="#exampleModalCenter" -->
              </div>  
              <div class="col-sm-6 d-none">
                <span>
                  <label class="form-inline">Date of Inspection:&nbsp;
                  @isset($AppData)
                    @if ($AppData->isrecommended === null)
                      <input type="date" id="propDate" data-toggle="tooltip" title="Recommended Date : @isset($DateString){{$DateString}}@endisset" class="form-control" onchange="chckDate();" value="@isset($ActualString){{$ActualString}}@endisset" required>&nbsp;</label>
                    @elseif($AppData->isrecommended == '0')
                    <span style="color: red;font-weight: bolder">None</span>
                    @else 
                    <span style="color: green;font-weight: bolder">{{($AppData->formattedPropDate ?? null)}}</span>
                    @endif
                  @endisset
                </span>
                <span>
                  <label class="form-inline">Time of Inspection:&nbsp;
                  @isset($AppData)
                    @if ($AppData->isrecommended === null)
                    <input type="time" class="form-control" data-toggle="tooltip" title="Recommended time is between 8:00 AM to 5:00 PM" data-parsley-required-message="Required" id="propTime" onchange="chckTime();" value="08:00" required>
                    @elseif($AppData->isrecommended == '0')
                    <span style="color: red;font-weight: bolder">None </span>
                    @else
                    <span style="color: green;font-weight: bolder">{{($AppData->formattedPropTime ?? null)}} </span>
                    @endif
                  @endisset
                </span>
              </form>    
              </div>   
            </div>
            <br>
            {{-- @endif --}}
            <div class="col-sm-12 d-flex justify-content-center">
              @if(!empty($documentDate))
                @isset($AppData)
                  @if ($triggerThis)
                  <button type="button" id="approveButton" class="btn btn-success" onclick="Recommended4Inspection('ApproveApplication');">Accepted</button>&nbsp;&nbsp;
                  <button type="button" id="rejectButton" class="btn btn-danger" onclick="Recommended4Inspection('RejectApplication');">Not Accepted</button>&nbsp;&nbsp;
                  <button type="button" id="reviseButton" class="btn btn-warning" onclick="Recommended4Inspection('ReviseApplication')">Need for Resubmission</button>
                  {{-- @elseif($AppData->isrecommended == '0') --}}
                  {{-- <span style="color: red;font-weight: bolder">NO </span> --}}
                  {{-- @elseif($AppData->isrecommended == '1') --}}
                  {{-- <span style="color: green;font-weight: bolder">YES </span> --}}
                  {{-- @elseif($AppData->isrecommended == 2) --}}
                  {{-- <button type="button"  class="btn btn-success ml-3 pb-2 pt-2 mt-2 mb-2 font-weight-bold" onclick="Recommended4Inspection('ApproveApplication');">Recommended for Inspection</button> --}}
                  {{-- <button type="button" class="btn btn-danger ml-3 pb-2 pt-2 mt-2 mb-2 font-weight-bold" onclick="Recommended4Inspection('RejectApplication');">Reject Application</button> --}}
                  {{-- <span style="color: orange;font-weight: bolder">NO, FOR REVISION </span> --}}
                  @endif
                @endisset
              @else
             <button class="btn btn-block p-4 btn-primary ml-3 pb-2 pt-2 mt-2 mb-2 font-weight-bold" onclick="acceptDocu()">Accept Documents</button>
              @endif
              </div>
              &nbsp;
              {{-- @isset($OPPok)
                @if ($OPPok === null AND $AppData->isrecommended == 1)
                  <button type="button" class="btn btn-info ml-3 pb-2 pt-2 mt-2 mb-2 font-weight-bold" title="Order of Payment" data-target="#ShowList" data-toggle="modal"  onclick="location.href='{{ asset('/employee/dashboard/lps/evaluate/')}}/{{$AppData->appid}}/{{$OOPs->oop_id}}/add'"><i class="fa fa-plus" aria-hidden="true"></i></button>
                @elseif($OPPok !== null AND $AppData->isrecommended == 1)
                  <button type="button" class="btn btn-info ml-3 pb-2 pt-2 mt-2 mb-2 font-weight-bold" title="Order of Payment" onclick="location.href='{{ asset('/employee/dashboard/lps/evaluate/')}}/{{$AppData->appid}}/{{$OPPok->oop_id}}/view'"><i class="fa fa-eye" aria-hidden="true"></i></button>
                @endif
              @endisset --}}
              
              @if($AppData->aptid == 'R' && false)

              <div class="col text-center mt-3" style="font-size: 20px"><u><a target="_blank" href="{{url('client1/apply/GenerateReportAssessments/'.$AppData->appid)}}">Show Client's Self Assessment</a></u></div>
            
              <div style="padding-left: 30%;">
                <div style="width: 60%;">
                @include('employee.processflow.evalOptRenewal')
                </div>
              </div>
              
              @endif
          

<script>
    document.getElementById('appid').value = '{{$AppData->appid}}'
    document.getElementById('valid_from').value = '{{$AppData->validDateFrom}}'
    // document.getElementById('valid_from').value = '{{$AppData->approvedDate}}'
    document.getElementById('valid_to').value = '{{$AppData->validDate ? $AppData->validDate : date("F j, Y", strtotime("Last day of December", strtotime($AppData->approvedDate ? $AppData->approvedDate : today())))}}'
    document.getElementById('bed_cap').value = '{{$AppData->noofbed}}'
    document.getElementById('dialysis_station').value = '{{$AppData->noofdialysis}}'
   
</script>
            
            </div>
        </div>
    </div>
        </div>


     <div class="remthis modal fade" id="floorplan" tabindex="-1" role="dialog" aria-labelledby="viewModalLabel" aria-hidden="true">
        {{csrf_field()}}
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            
              <div class="modal-content bg-dark">
                  <div class="modal-header" id="viewHead">
                      <h5 class="modal-title text-white" id="viewModalLabel">Floor Plan</h5>
                      <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <form id="FP">
                    <div class="modal-body bg-white">
                      <div class="container">
                        <div class="col-md text-center text-warning">
                          <i class="fa fa-exclamation-circle mt-5 mb-3" style="font-size: 200px;" aria-hidden="true"></i>
                        </div>
                        <div class="col-md text-center">
                          <span style="font-size: 30px;">Please select action for floorplan</span>
                          <br>
                          {{csrf_field()}}
                          <input type="hidden" name="action" value="FP">
                          <select name="fpselect" required class="form-control mt-3 mb-3">
                            <option value="" selected="">Please Select</option>
                            <option value="1">Accepted</option>
                            <option value="0">Not Accepted</option>
                          </select>
                          @if(isset($AppData->fpcomment))
                          <span style="font-size: 30px;">Previous Remark</span>
                          <textarea class="w-100 form-control" disabled rows="5">{{$AppData->fpcomment}}</textarea>
                          @endif

                          <span style="font-size: 30px;">Remarks of Selected Action</span>
                          <textarea class="w-100 form-control" name="fpremark" cols="30" rows="10"></textarea>
                        </div>
                      </div>
                    </div>
                  </form>
                  <div class="modal-footer">
                    <button class="btn btn-primary p-3" form="FP" type="submit">Submit</button>
                    <button class="btn btn-danger p-3" type="button" data-dismiss="modal">Go back</button>
                  </div>
              </div>
            

        </div>
      </div>


    <div class="remthis modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="viewModalLabel" aria-hidden="true">
        <form method="POST">
          {{csrf_field()}}
          <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
              <div class="modal-content bg-dark">
                  <div class="modal-header" id="viewHead">
                      <h5 class="modal-title text-white" id="viewModalLabel">Add Another Requirements</h5>
                      <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <div class="modal-body bg-white">
                    <div class="container">
                      <table class="table table-stripped">
                        <thead>
                          <tr>
                            <th><button type="button" class="btn btn-primary" onclick="addNewRowA('toInsert', 0, 'abc');"><i class="fa fa-plus"></i> Add</button></th>
                            <th>Action</th>
                            <th>Name of Requirements</th>
                            <th>Remarks</th>
                          </tr>
                        </thead>
                        <tbody id="toInsert">
                          <tr class="1">
                            <td></td>
                            <td><button class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Remove" onclick="deleteRow(1);"><i class="fa fa-times"></i></button></td>
                            <td><input type="text" name="addUpload[]" class="form-control" required></td>
                            <td>
                              <textarea name="addUploadRemarks[]" id="" cols="30" rows="1" class="form-control"></textarea>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                  </div>
              </div>
          </div>
          </form>
      </div>

    
    <div class="modal fade" id="TestModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-body">
                    <h4 class="modal-title text-center"><strong>Evaluate</strong></h4>
                    <hr>
                    <form id="EvalFormConfirm" action="{{ asset('employee/dashboard/processflow/evaluate') }}/@isset($appID){{$appID}}@else # @endisset" method="POST" data-parsley-validate>
                      {{csrf_field()}}
                      <input type="hidden" name="appUp_ID" value="">
                      <input type="hidden" name="evalYesNo" value="">
                    <div class="container">
                      <div class="col-sm-12" id="TestModalBody">
                      </div>
                      <br>
                      <div class="row">
                        <div class="col-sm-5" style="font-weight: bold">
                          Remarks (255 max):
                        </div>
                        <div class="col-sm-7" id="TestModaRemarks">
                        </div>
                      </div>
                      <br>
                    </div>
                    <hr>
                      <div class="row">
                          <div class="col-sm-2">
                          </div>
                          <div class="col-sm-4">
                            <button type="submit" class="btn btn-outline-success form-control" style="border-radius:0;" ><span class="fa fa-sign-up"></span>Confirm</button>
                          </div> 
                          <div class="col-sm-4">
                            <button type="button" data-dismiss="modal" class="btn btn-outline-danger form-control" style="border-radius:0;"><span class="fa fa-sign-up"></span>Cancel</button>
                          </div>
                      </div>
                      </form>
                  </div>
                </div>
            </div>
         </div>
    <div class="modal fade" id="ShowList" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-body">
           <div class="showHospit"><h5>Please select the type of Order of Payment</h5>
            <ul>
              @isset ($OOPS)
                @foreach ($OOPS as $oop)
                  <ol><a href="{{ asset('/employee/dashboard/lps/evaluate/')}}/{{$AppData->appid}}/{{$oop->oop_id}}/add">{{$oop->oop_desc}}</a></ol>
                @endforeach
              @endisset
           </ul>
           <div class="text-center"><button type="button" class="btn btn-warning showHospit" data-dismiss="modal" style="display:none" onclick="showNow2()">Cancel</button></div>
           </div>
          </div>
        </div>
      </div>
    </div>
    <div class="modal fade" id="modalins" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-body">
                    <table  class="showConfirm">
                    <td><h5><span id="ConfirmMessage"></span></h5></td>
                    <td><button type="button" class="btn-primary" id="ModalYesButton">Yes</button></td>
                    {{-- onclick="showNow()" --}}
                    <td><button type="button" class="btn-defaults" id="ModalNoButton">No</button></td>
                   </table>
           <div class="showHospit" style="display: none"><h5>Since YES you will proceed to Order of Payment.</h5>
            <ul>
              <ol><a href="{{asset('headorderofpayment')}}">Hospital Based Private</a></ol>
              <ol><a href="{{asset('headorderofpayment2')}}">Hospital Based Government</a></ol>
              <ol><a href="{{asset('headorderofpayment3')}}">Non-Hospital based other Health Facilities</a></ol>
              <ol><a href="{{asset('headorderofpayment4')}}">Certificate of Need/Permit to Construct </a></ol>
              <ol><a href="{{asset('headorderofpayment5')}}">Dental Laboratory</a></ol>
              <ol><a href="{{asset('headorderofpayment6')}}">Non-Hospital Based with Ancillary</a></ol>
           </ul>
           <div class="text-center"><button type="button" class="btn btn-warning showHospit" data-dismiss="modal" style="display:none" onclick="showNow2()">Cancel</button></div>
           </div>
          </div>
        </div>
      </div>
    </div>
    <div class="modal fade" id="ShowDetailsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content"> 
            <div class="modal-body">
              <h4 class="modal-title text-center"><strong>Details</strong></h4>
                <hr>
                <span id="ShowDetailsModalBody"></span>
                <hr>            
                  <div class="row">
                    <div class="col-sm-2">
                    </div>
                    <div class="col-sm-4">
                    </div> 
                    <div class="col-sm-4">
                      <button type="button" data-dismiss="modal" class="btn btn-outline-danger form-control" style="border-radius:0;"><span class="fa fa-sign-up"></span>Close</button>
                    </div>
                  </div>
            </div>
        </div>
      </div>
    </div>    
  </div>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js" integrity="sha512-bZS47S7sPOxkjU/4Bt0zrhEtWx0y0CRkhEp8IckzK+ltifIIE9EMIMTuT/mEzoIMewUINruDBIR/jJnbguonqQ==" crossorigin="anonymous"></script>
    <script type="text/javascript">
      let counterForDom = 0;  
      let slug = true;
       var checkForError = Array();
    	 $(document).ready(function()
    	 	{ 
          toggleButtons()
          $('input[type=radio]').change(function(event) {
           toggleButtons()
          });

    	 		$('[data-toggle="tooltip"]').tooltip();
    	 		
    	 	});
         const base_url = '{{URL::to('/')}}';
         function callApi(url, data, method) {
              const config = {
                  method: method,
                  url: `${base_url}${url}`,
                  headers: { 
                    'Content-Type': 'application/json'
                  },
                  data : data
              };
              return axios(config)
          };

         function savDocDet(id,check, remarks){
          const data = {
            id: id,
            check: check,
            remarks: remarks
          } 

          console.log(data)

          callApi('/api/doc/eval/save', data, 'POST').then(d => {
            console.log(d.data.msg)

          }
          ).then(error => {


              console.log(error);
          })

          }

       function toggleButtons(){
         let checkForNo = Array(); 
          let checkForYes = Array();
          let choices = $('.laSelected').map(function () {return $(this).attr('apup')}).get();
          $('input[type=radio]:checked').each(function(index, el) {
            if($(this).val() == "1"){
              checkForYes.push($(this));
            }
            if($(this).val() == "0"){
              checkForNo.push($(this));
            } 
          });
          if(checkForNo.length > 0){
            $('#approveButton').hide();
            $('#rejectButton').show();
            $('#reviseButton').show();
          } else if((checkForYes.length == choices.length) && checkForYes.length != 0) {
            $('#approveButton').show();
            $('#rejectButton').hide();
            $('#reviseButton').hide();
          } else if((checkForYes.length != choices.length) && checkForYes.length == 0) {
            $('#approveButton').hide();
            $('#rejectButton').show();
            $('#reviseButton').hide();
          }
       }

    	 var numOfUploads = @isset($numOfApp){{$numOfApp}}@else 0 @endisset, numOfRejected = @isset($numOfX){{$numOfX}}@else 0 @endisset, numofAprv = @isset($numOfAprv){{$numOfAprv}}@else 0 @endisset, numOfNull = @isset($numOfNull){{$numOfNull}}@else 0 @endisset, apid = @isset($appID){{$appID}}@else 0 @endisset, DateError = 0, DateErrorMsg ='',TimeError = 0;

       function acceptDocu(){
        let r = window.confirm('Are you sure you want to check this submitted files?');
          if(r){
            $.ajax({
              type: 'POST',
              data: {_token: $('#token').val(),checkFiles: true},
              success: function(){
                location.reload();
              }
            })
            
          }
       }
       
       function saveEvals(){
          var IDs = $('.laSelected').map(function () {return $(this).attr('apup')}).get();
          var ifCheck = [], chckRmrks = [];
          var x = 0, y = '';
          if(IDs.length > 0) {
              for (var i = 0; i < IDs.length; i++) {
                var sad = (typeof($('input[name="'+IDs[i]+'_rad"]:checked').val()) == 'undefined') ? null :  parseInt($('input[name="'+IDs[i]+'_rad"]:checked').val());
                ifCheck.push(sad);
                chckRmrks.push($('textarea[name="'+IDs[i]+'_txt"]').val());
                if ((sad == 0) && ($('textarea[name="'+IDs[i]+'_txt"]').val() == '') ) {
                   x = 1; y = IDs[i];
                   break;
                }
                
              }
              // console.log(ifCheck);
              // console.log(x);            
                var allIsNull = ifCheck.every(function(i){return i == null; });
                if (allIsNull == false) {
                  if (x == 0) {
                      $.ajax({
                        method: 'POST',
                        data : {_token:$('#token').val(), ids:IDs, ifChk:ifCheck, ChkRmk: chckRmrks},
                        success: function(data){
                          if (data == 'DONE') {
                            $slug = true;
                          }
                        },
                        error : function(a, b, c){
                          console.log(c);
                          $('#ERROR_MSG2').show(100);
                        }
                    }); 
                  }
                    else {
                      customAlert({
                        type: 'error',
                        title: 'Oops...',
                        text: 'Please Provide remarks',
                      });
                       slug = false;
                      $('textarea[name="'+y+'_txt"]').focus();
                    }
                } else {
                  slug = false;
                  customAlert({
                    type: 'error',
                    title: 'Oops...',
                    text: 'Please Check all fields before proceeding',
                  });
                }          
          }
       }
    	 {{--function showNow(){
              $('.showHospit').show();
              $('.showConfirm').hide();
          }--}}
      {{--function showNow2(){
            $('.showConfirm').show();
            $('.showHospit').hide();
          }--}}
        // function showModalForEvaluate(YesNo, app_up_id){
        //               var msg = "";
        //               $('input[name="appUp_ID"]').val(app_up_id);
        //               $('input[name="evalYesNo"]').val(YesNo);
        //               $('#TestModalBody').empty();
        //               $('#TestModaRemarks').empty();
        //               $('#TestModaRemarks').append('<textarea id="EvalRemarkTxtArea" name="remark" data-parsley-maxlength="255" class="form-control" rows="4" style="width: 100%;height: 100%;"></textarea>');
        //               $('#EvalRemarkTxtArea').attr('data-parsley-maxlength-message','Remarks should have <strong>255</strong> characters or fewer.');
        //               // maxlength='140'
        //               $('#EvalRemarkTxtArea').attr('maxlength','255');
        //               if (YesNo == 0) { // NO
        //                   msg = 'This is to confirm that the uploaded document you evaluated has a <span style="color:red">problem</span>, please state the problem in the remarks area.';
        //                   $('#EvalRemarkTxtArea').attr('required','');
        //                   $('#EvalRemarkTxtArea').attr('data-parsley-required-message','*<strong>Remark</strong> required.');
        //               } else { // YES
        //                 msg = 'This is to confirm that the uploaded document you evaluated is <span style="color:green">correct</span>, add additional remark if neccessary. ';
        //               }
        //               $('#TestModalBody').append('<h5 style="text-align:justify;text-justify: inter-word">&nbsp;&nbsp;&nbsp;'+msg+'</h5>');
        //             }
      function ShowDetails (evaluation,apup_id,desc){
                      $.ajax({
                        url : '{{asset('employee/dashboard/processflow/getSingleDownloadDetails')}}',
                        method : 'POST',
                        data : {_token:$('#token').val(), apup_id: apup_id},
                        success : function(data){
                           if (data == 'NONE') { // Error
                              $('#ShowDetailsModal').modal('toggle');
                           } else {
                              var name = "", status = "";
                              var remark = (data.remarks == null) ? '' : data.remarks;
                              // data.remarks
                              if (data.grpid == 'NA') {name="Administrator";}
                              else {
                                    var mname = data.mname;
                                    mname = mname.charAt(0);
                                    name = data.fname + ' ' + mname.toLowerCase() + ' ' + data.lname;
                               }
                               if (data.evaluation === null) {status = "Not yet Evaluated";}
                               else if (data.evaluation == "0") {status = '<span style="color:red;font-weight:bold">Document Disapproved</span>';}
                               else if (data.evaluation == "1") {status = '<span style="color:green;font-weight:bold">Document Approved</span>';}
                              $('#ShowDetailsModalBody').empty();
                              $('#ShowDetailsModalBody').append(
                                    '<div class="container">' +
                                      '<div class="row"><div class="col-sm-5" style="font-weight: bold">Description:</div><div class="col-sm-7"><justify>'+desc+'</justify></div></div><br>' +
                                      '<div class="row"><div class="col-sm-5" style="font-weight: bold">Evaluated By:</div><div class="col-sm-7">'+name+'</div></div>' +
                                      '<div class="row"><div class="col-sm-5" style="font-weight: bold">Evaluation Time/Date:</div><div class="col-sm-7">'+data.formattedEvalTime+' - '+data.formatteEvalDate+'</div></div>' + 
                                      // '<div class="row"><div class="col-sm-5" style="font-weight: bold">Evaluated By:</div><div class="col-sm-7">'+name+'</div></div>' +                        
                                      '<div class="row"><div class="col-sm-5" style="font-weight: bold">Status:</div><div class="col-sm-7">'+status+'</div></div>' +
                                      '<div class="row"><div class="col-sm-5" style="font-weight: bold">Remarks:</div><div class="col-sm-7">'+remark+'</div></div>' +                          
                                    '</div>'
                                );
                           }
                        },
                      });
                    }
        function Recommended4Inspection(classTOCall){
             
          var IDs = $('.laSelected').map(function () {return $(this).attr('apup')}).get();
          var ifCheck = [], chckRmrks = [];
          var x = 0, y = '';
          
          if(IDs.length > 0) {
              for (var i = 0; i < IDs.length; i++) {
                var sad = (typeof($('input[name="'+IDs[i]+'_rad"]:checked').val()) == 'undefined') ? null :  parseInt($('input[name="'+IDs[i]+'_rad"]:checked').val());
                ifCheck.push(sad);
                chckRmrks.push($('textarea[name="'+IDs[i]+'_txt"]').val());
                if ((sad == 0) && ($('textarea[name="'+IDs[i]+'_txt"]').val() == '') ) {
                   x = 1; y = IDs[i];
                   break;
                }                
              }

              ifCheck.forEach(function(index, el) {
               if(index == null){
                flag = 'uncheck';
                checkForError.push(flag);
               } else {
                  if(index == 0 && chckRmrks[el] == ""){
                    flag = 'remarks';
                    checkForError.push(flag);
                  }
               } 
             });
              if($.inArray('uncheck', checkForError) >= 0){
              Swal.fire({
                type: 'error',
                title: 'Error',
                text: 'Please evaluate all list first before proceeding.',
              })
              checkForError = [];
             } else if($.inArray('remarks', checkForError) >= 0){
                Swal.fire({
                  type: 'error',
                  title: 'Error',
                  text: 'Remarks required if evaluated with NO.',
                })
                checkForError = [];
             } else {
                  $.ajax({
                    method: 'POST',
                    data : {_token:$('#token').val(), ids:IDs, ifChk:ifCheck, ChkRmk: chckRmrks},
                    success: function(data){
                      if (data == 'DONE') {
                        window[classTOCall]();
                      }
                    },
                    error : function(a, b, c){
                      console.log(c);
                      $('#ERROR_MSG2').show(100);
                    }
                  }); 
                // window[classTOCall]();
             }
        
          } else {
              window[classTOCall]();
          }
                  }
        function ReviseApplication(){
          $.ajax({
            url : '{{ asset('employee/dashboard/processflow/judgeApplication') }}',
             method : 'POST',
             data : {_token:$('#token').val(), apid :apid, selected: 2, requestFor: '{{$office}}' {{$coaFlag ? ',isCoa: true' : ''}} },
             success : function(data){
                if (data == 'DONE') {                  
                Swal.fire({
                  type: 'success',
                  title: 'Success',
                  text: 'Successfully changed application status to revision.',
                }).then(() => {
                  window.location.href = '{{ asset('employee/dashboard/processflow/evaluate') }}'
                });
             
                } else if (data == 'ERROR'){
                    $('#ERROR_MSG2').show(100);
                } else if (data == 'MAX') {
                  Swal.fire({
                    type: 'error',
                    title: 'Oops...',
                    text: 'Maximum number of tries reached, application will be automatically be Disapproved.',
                  }).then(() => {
                    RejectApplication()
                  });
                    
                }
             },
             error : function(a, b, c){
                console.log(c);
                $('#ERROR_MSG2').show(100);
             }
          });
        }
        function RejectApplication(){
              $.ajax({
                    url : '{{ asset('employee/dashboard/processflow/judgeApplication') }}',
                    method : 'POST',
                    data : {_token:$('#token').val(), apid :apid, selected: 0, requestFor: '{{$office}}' {{$coaFlag ? ',isCoa: true' : ''}} },
                    success : function(data){
                      if (data == 'DONE') {
                        Swal.fire({
                          type: 'success',
                          title: 'Success',
                          text: 'Successfully set application to Not Accepted.',
                        }).then(() => {
                          window.location.href = '{{ asset('employee/dashboard/processflow/evaluate') }}';
                        });
                      } else if (data == 'ERROR'){
                          $('#ERROR_MSG2').show(100);
                      }
                    }, error : function (XMLHttpRequest, textStatus, errorThrown){
                       console.log(errorThrown);
                       $('#ERROR_MSG2').show(100);
                    }

                });
          }
          function ApproveApplication(){
            @if($AppData->hfser_id == 'PTC' && $AppData->isAcceptedFP != 1)
              alert("Floorplan not yet accepted")
            @else
              getFuncApprvl()
            @endif
          }

          function getFuncApprvl(){
            let final = Array();
            let answers = $(".laSelected");

            answers.each(function(a,b){
             if($(this).find('input[type=radio]:checked').val() == 0){
              final.push('hasNo');
             }
            })
            
            if(final.length <= 0){
              $.ajax({
                  url : '{{ asset('employee/dashboard/processflow/judgeApplication') }}',
                  method : 'POST',
                  data : {_token:$('#token').val(), apid :apid, propdate : $('#propDate').val(), proptime : $('#propTime').val(), selected: 1, requestFor: '{{$office}}' {{$coaFlag ? ',isCoa: true' : ''}}},
                  success : function(data){
                      if (data == 'DONE') {
                          Swal.fire({
                            type: 'success',
                            title: 'Success',
                            text: 'Successfully set application to Accepted',  //
                          }).then(() => {
                            //@if(($AppData->hfser_id == 'PTC' && $AppData->isAcceptedFP != 1 && $forhfsrb) || (!$forhfsrb || $redirect))
                            //location.reload();
                            //@else
                             //window.location.href = '{{ asset('employee/dashboard/processflow/orderofpayment/') }}/{{$appID}}';
                            //@endif
                            //window.location.href = '{{ asset('employee/dashboard/processflow/evaluate') }}';
                            window.location.href = '{{ asset('employee/dashboard/processflow/evaluate') }}';

                          });
                        } else if (data == 'ERROR') {
                          $('#ERROR_MSG2').show(100);
                        }
                  }, error : function (XMLHttpRequest, textStatus, errorThrown){
                      console.log(errorThrown);
                      $('#ERROR_MSG2').show(100);
                  }
              });
              } else {
                Swal.fire({
                  type: 'error',
                  title: 'Error',
                  html: 'You need to evaluate all requirements to <span class="font-weight-bold">YES</span> to continue approving.',
                })
              }
          }

        function chckDate(){
                    var dateVal = $('#propDate').val();
                    var recoDate = "@isset($AfterDay){{$AfterDay}}@else # @endisset";
                    var DateNow = "@isset($DateNow){{$DateNow}}@else # @endisset"
                    if(new Date(dateVal) > new Date(recoDate)){ // Check if its within 30 days 
                      alert('The inspection date should be within 30 days the evaluation date.');
                      DateError = 1;
                      DateErrorMsg = 'The inspection date should be within 30 days the evaluation date.';
                      $('#propDate').focus();
                    } else if(new Date(dateVal) < new Date(DateNow)) {
                        alert('The inspection date should not be before the evaluation date.');
                        DateError = 1;
                        DateErrorMsg = 'The inspection date should not be before the evaluation date.';
                        $('#propDate').focus();
                    }else { 
                        var ChckIfWeekend = new Date(dateVal);
                        DateError = 0;
                        DateErrorMsg = '';
                        if(ChckIfWeekend.getDay() == 6 || ChckIfWeekend.getDay() == 0) { // Check if its a weekend or not
                            alert('The inspection date should be on weekdays.');
                            DateError = 1;
                            DateErrorMsg = 'The inspection date should be 30 days after the evaluation date.';
                            $('#propDate').focus();
                          } else {
                               DateError = 0;
                               DateErrorMsg = '';
                               var x = $('#'+dateVal+'_dt').text();
                               if (x) {
                                  var y = $('#'+dateVal+'_dt').attr('typ');
                                  var msg = 'The selected date is a '+y+' holiday : '+x+'.';
                                  alert(msg);
                                  DateError = 1;
                                  DateErrorMsg = msg;
                               } else {
                                  DateError = 0;
                                  DateErrorMsg = '';
                               }
                          } 
                    }
                  }
        function chckTime(){
                      var format = 'hh:mm';
                      // var time = moment() gives you current time. no format required.
                      var time = moment($('#propTime').val(),format),
                        beforeTime = moment('07:59',format),
                        afterTime = moment('17:01',format);
                      if (time.isBetween(beforeTime, afterTime)) {
                        TimeError = 0;
                      } else {
                        TimeError = 1;
                      }
                  }

    function addNewRowA(elName, ind, elToInsName) {
      let idom = document.getElementById(elName);
      if(idom != undefined || idom != null) {
        counterForDom +=1, 
        whatToInsert = [
        '<tr class="trd'+(counterForDom + 1001)+'">'+
          '<td></td>'+
          '<td><button class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Remove" onclick="deleteRow(\'trd'+(counterForDom + 1001)+'\');"><i class="fa fa-times"></i></button></td>'+
          '<td><input type="text" name="addUpload[]" class="form-control" required></td>'+
          '<td><textarea name="addUploadRemarks[]" id="" cols="30" rows="1" class="form-control"></textarea></td>'+
        '</tr>'
        ];
        if(whatToInsert.indexOf(ind) < 0) {
          $(whatToInsert[ind]).insertBefore(idom);    
        }
      }
      
    }

    function deleteRow(elName) {
      let idom = $("."+elName);
      if(idom != undefined || idom != null) {
        $(idom).remove();
      }
    }

    // function confirmFP(){
    //   
      
    // }

    $("#FP").submit(function(event) {
      event.preventDefault();
      let trigger = {{((isset($AppData->isrecommended) && $AppData->isrecommended == 1) ? 'true' : 'false')}};
      $.ajax({
        url: '{{url('employee/dashboard/processflow/assignmentofhferc/'.$AppData->appid.'/1')}}',
        type: 'POST',
        data: $(this).serialize(),
        success: function(a){
          if(a == 'done'){
            if (trigger && $('[name=fpselect]').val() == 1) {
              alert('Application accepted. Redirecting you to order of payment')
              window.location.href = '{{ asset('employee/dashboard/processflow/orderofpayment/') }}/{{$appID}}';
            } else {
              location.reload();
            }
          } else {
            console.log(a);
          }
        }
      })
    });
    </script>
    @endsection
@else
  <script type="text/javascript">window.location.href= "{{ asset('employee') }}";</script>
@endif