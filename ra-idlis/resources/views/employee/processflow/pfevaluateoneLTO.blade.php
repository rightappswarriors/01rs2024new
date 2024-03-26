@if (session()->exists('employee_login'))     
    @php
    $triggerThis = ($forhfsrb ? ($AppData->isrecommended == 2 || $AppData->isrecommended == null) : ($office == 'xray' ? ($AppData->ispreassessed == 2 || $AppData->ispreassessed == null) : ($AppData->ispreassessedpharma == 2 || $AppData->ispreassessedpharma == null)));
    @endphp 
    @extends('mainEmployee')
    @section('title', 'Evaluate Process Flow')
    @section('content')
    <div class="content p-4">
      @isset($Holidays)
        <datalist id="HolidaysList">
            @foreach ($Holidays as $day)
              <option id="{{$day->hdy_date}}_dt" typ="{{$day->hdy_typ}}">{{$day->hdy_desc}}</option>
            @endforeach
        </datalist>
      @endisset
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
        <div class="card">
            <div class="card-header bg-white font-weight-bold" style="width: 100%;">
              <input type="text" id="NumberOfRejected" value="@isset ($numOfX) {{$numOfX}} @endisset" hidden>
              <input type="" id="token" value="{{ Session::token() }}" hidden>
              
              @if($office == 'xray')
                <a href="{{asset('employee/dashboard/processflow/pre-assessment/FDA/xray')}}">
                  <button class="btn btn-primary  ml-3 pb-2 pt-2 mt-2 mb-2 font-weight-bold" >Back</button>
                </a>
              @elseif($office == 'pharma')
                <a href="{{asset('employee/dashboard/processflow/pre-assessment/FDA/pharma')}}">
                  <button class="btn btn-primary  ml-3 pb-2 pt-2 mt-2 mb-2 font-weight-bold" >Back</button>
                </a>
              @else
                <a href="{{asset('/employee/dashboard/processflow/evaluate/technical')}}">
                  <button class="btn btn-primary  ml-3 pb-2 pt-2 mt-2 mb-2 font-weight-bold" >Back</button>
                </a>
              @endif 
              &nbsp; 
              
              @if($office == 'xray')
                    Pre-assessment (Radiation)
              @elseif($office == 'pharma')
                    Pre-assessment (Pharmacy)
              @else
                    Technical Evaluation
              @endif 
              
              
               @if($office == 'pharma')
                  <div style="float: right;">
                    <a class="btn {{(FunctionsClientController::existOnDB('cdrrpersonnel',[['appid',$AppData->appid],['isTag',1]]) ? 'bg-danger': 'btn-primary')}} p-3 text-white" target="_blank" href="{{url('client1/apply/fda/CDRR/view/personnel/').'/'.$AppData->appid.'/tag'}}">({{$tagcount}}) Tag Pharmacist</a>
                  </div>
               @endif

               
               <!-- <button class="btn btn-primary" onclick="window.history.back();">Back</button> -->
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
                  @if($AppData->aptid == 'R'){{'Renewal'}}@elseif($AppData->aptid == 'IN'){{'Initial New'}}@else{{'Unidentified'}}@endif
                  @if(isset($AppData->hfser_id)){{' '.$AppData->hfser_id}}@endif
                </span>

                @if($forhfsrb)
                  @if(!empty($documentDate))
                  <h6>Institutional Character: 
                    @if(isset($AppData) && isset($AppData->facmdesc))
                      <strong>{{$AppData->facmdesc}}</strong>
                    @else
                      <span style="color:red">Not Available</span>
                    @endif &nbsp;
                    
                    <a style="float: right;" href="{{$linkToEdit}}?grplo=rlo{{$AppData->aptid == 'R' ? '&type=r': ''}}" target="_blank" class="btn btn-info">
                      <i class="fa fa-eye" aria-hidden="true"></i> View Application
                    </a>                      
                    <span style="float: right;">&nbsp;&nbsp;</span>
                    <a style="float: right;" href="{{url('client1/apply/GenerateReportAssessments/'.$AppData->appid)}}" target="_blank" class="btn btn-info">
                      <i class="fa fa-eye" aria-hidden="true"></i> Client's Self Assessment
                    </a>
                  </h6>
                  @endif

                  <h6>@isset($AppData) Status: @if ($AppData->isrecommended === null) <span style="color:blue">For Evaluation</span> @elseif($AppData->isrecommended == 1)  <span style="color:green">Accepted Evaluation</span> @elseif($AppData->isrecommended === 0) <span style="color:red">Disapproved Evaluation</span> @else <span style="color:red">Evaluated, for Revision</span> @endif @endisset</h6>
                  @endif
              </div>
             
              {{-- @if(!empty($documentDate)) --}}
            <table class="table" id="example">
              <thead>
                <tr>
                  <td scope="col" width="60%" >
                    <strong>Requirements </strong>

                  </td>
                  <td scope="col">
                    <a style="float: right;" href="{{$linkToEdit}}?grplo=rlo{{$AppData->aptid == 'R' ? '&type=r': ''}}" target="_blank" class="btn btn-info">
                        <i class="fa fa-eye" aria-hidden="true"></i> View Application
                      </a>                      
                  <span style="float: right;">&nbsp;&nbsp;</span>
                
                  @if($office == 'xray')
                      <a style="float: right;" href="{{asset('client1/printPaymentFDA')}}/{{FunctionsClientController::getToken()}}/{{$AppData->appid}}" target="_blank" class="btn btn-info">
                    <i class="fa fa-eye" aria-hidden="true"></i> Preview Order of Payment</a>
                    <span style="float: right;">&nbsp;&nbsp;</span>
									@endif
									@if($office == 'pharma')

                      <a style="float: right;" href="{{asset('client1/printPaymentFDACDRR')}}/{{FunctionsClientController::getToken()}}/{{$AppData->appid}}" target="_blank" class="btn btn-info">
                    <i class="fa fa-eye" aria-hidden="true"></i> Preview Order of Payment</a>
                    <span style="float: right;">&nbsp;&nbsp;</span>
									@endif		
                  @if($office == 'xray')			
                      <a style="float: right;" href="{{asset('employee/dashboard/processflow/FDA/machines/orderofpayment/')}}/{{$AppData->appid}}" target="_blank" class="btn btn-primary ">
                      <i class="fa fa-edit" aria-hidden="true"></i> Override Order of Payment</a>
                      <span style="float: right;">&nbsp;&nbsp;</span>
                  @endif

                  {{-- @if($office == 'pharma')			
                      <a style="float: right;" href="{{asset('employee/dashboard/processflow/FDA/pharma/orderofpayment/')}}/{{$AppData->appid}}" target="_blank" class="btn btn-primary ">
                      <i class="fa fa-edit" aria-hidden="true"></i> Override Order of Payment</a>
                      <span style="float: right;">&nbsp;&nbsp;</span>
                  @endif  --}}

                  </td>
                </tr>
              </thead>
              <tbody>
                  @php $counter = $forNosent = 0 ; $idnt=0;@endphp
                  @foreach($requirements as $req)
                    
                  @php 
                    if($counter == 0){
                      $class = 'coc';
                    } else {
                      $class = 'notcoc';
                    }
                  @endphp
                  <tr>
                    <td>
                      <div class="row">
                      <div class="col-5">
                        <span class="font-weight-bold">{{$req[1]}}: </span>
                      </div>
                      <div class="col-2">
                        <a class="btn btn-primary ml-5" target="_blank" href="{{$req[0]}}/{{$AppData->appid}}">View Details</a>
                      </div>
                      </div>
                    </td>
                    <td>
                      @if(!empty($req[2][0]))
                      @php $idnt+=1; @endphp
                     <script>
                       console.log('{!! json_encode($req[2][0]) !!}')
                      </script>

                      @if($office == 'pharma' || $office == 'xray')
                        <span class="{{$req[2][0]->id.$req[2][0]->id}}_span_edit" @if($req[2][0]->evaluation !== NULL)style="display: none"@endif>
                            <div class="row booleans laSelected {{$class}}" apup="{{$req[2][0]->id}}" >
                              <div class="col-6">
                                <div class="control-group">
                                  <label class="control control--radio">Yes
                                    <input value="1" type="radio" name="{{$req[2][0]->id}}_rad_{{$req[2][0]->id}}{{$idnt}}" @if($req[2][0]->evaluation !== NULL AND $req[2][0]->evaluation == 1)checked=""@endif>
                                    <div class="control__indicator"></div>
                                    </label>
                                </div> 
                              </div>
                                <div class="col-6">
                                  <div class="control-group">
                                    <label class="control control--radio">No
                                      <input value="0" type="radio" name="{{$req[2][0]->id}}_rad_{{$req[2][0]->id}}{{$idnt}}" @if($req[2][0]->evaluation !== NULL AND $req[2][0]->evaluation == 0)checked=""@endif>
                                      <div class="control__indicator"></div>
                                    </label>
                                  </div> 
                                </div>
                            </div>
                            <p style="text-align: left;">Remarks:</p>
                            <textarea name="{{$idnt}}{{$req[2][0]->id}}_txt" class="form-control" rows="5">@if($req[2][0]->evaluation !== NULL){{$req[2][0]->remarks}}@endif</textarea>
                            <br>
                            <button type="button" title="Save" onclick="saveEvals()" class="btn btn-success" style="display: none"><i class="fa fa-floppy-o" aria-hidden="true"></i></button>
                            <button type="button" title="Cancel Edit" onclick="').toggle()" class="btn btn-danger" style="display: none"><i class="fa fa-times" aria-hidden="true"></i></button>
                          </span>
                        @endif
                        
                        <span class="{{$req[2][0]->id.$req[2][0]->id}}_span_edit" @if($req[2][0]->evaluation === NULL)style="display: none"@else style=""@endif>
                            @if($req[2][0]->evaluation == 1) 
                              <button type="button" title="Evaluation Accepted" class="btn btn-success" disabled>
                               <i class="fa fa-check-circle" aria-hidden="true"></i>
                              </button>
                            @else
                              <button type="button" class="btn btn-danger" title="Evaluation Not Accepted" disabled>
                                <i class="fa fa-times" aria-hidden="true"></i>
                              </button>
                            @endif
                            @isset($AppData)
                              {{-- @if($AppData->isrecommended == 2 || $AppData->isrecommended == null)  --}}
                              @if($triggerThis)
                                <button type="button" title="Edit" onclick="$('.{{$req[2][0]->id.$req[2][0]->id}}_span_edit').toggle()" class="btn btn-warning"><i class="fa fa-edit" aria-hidden="true"></i></button>
                              @endif
                            @endisset
                         </span>
                         
                      @else
                      <span class="font-weight-bold">NO LIST(S) GIVEN</span>
                      @php 
                        $forNosent++;
                      @endphp
                      @endif
                    </td>

                    <!-- <td>
                      @if(!empty($req[2][0]))
                       <span class="{{$req[2][0]->id.$req[2][0]->id}}_span_edit" @if($req[2][0]->evaluation !== NULL)style="display: none"@endif>
                          <div class="row booleans laSelected" apup="{{$req[2][0]->id}}" >
                             <div class="col-6">
                               <div class="control-group">
                                <label class="control control--radio">Yes
                                  <input value="1" type="radio" name="{{$req[2][0]->id}}_rad_{{$req[2][0]->id}}" @if($req[2][0]->evaluation !== NULL AND $req[2][0]->evaluation == 1)checked=""@endif>
                                  <div class="control__indicator"></div>
                                  </label>
                               </div> 
                             </div>
                              <div class="col-6">
                                <div class="control-group">
                                   <label class="control control--radio">No
                                     <input value="0" type="radio" name="{{$req[2][0]->id}}_rad_{{$req[2][0]->id}}" @if($req[2][0]->evaluation !== NULL AND $req[2][0]->evaluation == 0)checked=""@endif>
                                     <div class="control__indicator"></div>
                                   </label>
                                 </div> 
                              </div>
                          </div>
                          <p style="text-align: left;">Remarks:</p>
                          <textarea name="{{$req[2][0]->id}}_txt" class="form-control" rows="5">@if($req[2][0]->evaluation !== NULL){{$req[2][0]->remarks}}@endif</textarea>
                          <br>
                          <button type="button" title="Save" onclick="saveEvals()" class="btn btn-success" style="display: none"><i class="fa fa-floppy-o" aria-hidden="true"></i></button>
                          <button type="button" title="Cancel Edit" onclick="').toggle()" class="btn btn-danger" style="display: none"><i class="fa fa-times" aria-hidden="true"></i></button>
                        </span>
                        <span class="{{$req[2][0]->id.$req[2][0]->id}}_span_edit" @if($req[2][0]->evaluation === NULL)style="display: none"@else style=""@endif>
                            @if($req[2][0]->evaluation == 1) 
                              <button type="button" title="Evaluation Accepted" class="btn btn-success" disabled>
                               <i class="fa fa-check-circle" aria-hidden="true"></i>
                              </button>
                            @else
                              <button type="button" class="btn btn-danger" title="Evaluation Not Accepted" disabled>
                                <i class="fa fa-times" aria-hidden="true"></i>
                              </button>
                            @endif
                            @isset($AppData)
                              {{-- @if($AppData->isrecommended == 2 || $AppData->isrecommended == null)  --}}
                              @if($triggerThis)
                                <button type="button" title="Edit" onclick="$('.{{$req[2][0]->id.$req[2][0]->id}}_span_edit').toggle()" class="btn btn-warning"><i class="fa fa-edit" aria-hidden="true"></i></button>
                              @endif
                            @endisset
                         </span>
                      @else
                      <span class="font-weight-bold">NO LIST(S) GIVEN</span>
                      @php 
                        $forNosent++;
                      @endphp
                      @endif
                    </td> -->

                  </tr>
                  @php $counter++; @endphp
                  @endforeach
                
                <form id="EvalForm" data-parsley-validate>
                  
                </form>
              </tbody>  
            </table>
            <br>
            
            </div>
            <br>
            {{-- @endif --}}
            
            <div class="col-sm-12 d-flex justify-content-center">
          @if($office == 'pharma' || $office == 'xray')
              @if(!empty($documentDate))
                @isset($AppData)
                  @if ($triggerThis)
                    {{-- @if ($AppData->isrecommended == 2 || $AppData->isrecommended == null) --}}
                    @if(count($requirements) != $forNosent || $office == 'pharma')                 
                      <button type="button" id="approveButton" class="btn btn-success" onclick="Recommended4Inspection('ApproveApplication');">Approve</button>
                    @endif
                    &nbsp; &nbsp;             
                    <button type="button" id="reviseButton" class="btn btn-warning" onclick="Recommended4Inspection('ReviseApplication')">Need for Revision</button>
                  @endif
                @endisset
              @else
                <button class="btn btn-block p-4 btn-primary" onclick="acceptDocu()">Accept Documents</button>
              @endif
              </div>

          @endif
              &nbsp;

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
          <div class="col-sm-6 d-none">
            <span>
              {{csrf_token()}}
              <label class="form-inline">Date of Inspection:&nbsp;
              @isset($AppData)
                @if ($AppData->isrecommended === null)
                  <input type="date" id="propDate" data-toggle="tooltip" title="Recommended Date : @isset($DateString){{$DateString}}@endisset" class="form-control" onchange="chckDate();" value="@isset($ActualString){{$ActualString}}@endisset" required>&nbsp;</label>
                @elseif($AppData->isrecommended == '0')
                <span style="color: red;font-weight: bolder">None</span>
                @else 
                <span style="color: green;font-weight: bolder">{{$AppData->formattedPropDate}}</span>
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
                <span style="color: green;font-weight: bolder">{{$AppData->formattedPropTime}} </span>
                @endif
              @endisset
            </span>
          </div>

          <div>
            
          @if($office != 'pharma' && $office != 'xray')
            @if($AppData->aptid == 'R')
              <div class="col mt-3" style="width: 300px">
              <!-- <u><a target="_blank" href="{{url('client1/apply/GenerateReportAssessments/'.$AppData->appid)}}">Show Client's Self Assessment</a></u> -->
                @include('employee.processflow.evalOptRenewal')
              <br/>
              </div>
            @endif
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
    
    <script>
      $(document).ready(function()
      { 
          toggleButtons()
          $('input[type=radio]').not(':eq(1)').change(function(event) {
           toggleButtons()
          });
      });
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


        // if(checkForNo.length > 0){
        //   $('#approveButton').hide();
        //   $('#rejectButton').show();
        //   $('#reviseButton').show();
        // } else if(checkForYes.length == choices.length) {
        //   $('#approveButton').show();
        //   $('#rejectButton').hide();
        //   $('#reviseButton').hide();
        // }


     }
      var checkForError = Array();
      var numOfUploads = @isset($numOfApp){{$numOfApp}}@else 0 @endisset, numOfRejected = @isset($numOfX){{$numOfX}}@else 0 @endisset, numofAprv = @isset($numOfAprv){{$numOfAprv}}@else 0 @endisset, numOfNull = @isset($numOfNull){{$numOfNull}}@else 0 @endisset, apid = @isset($appID){{$appID}}@else 0 @endisset, DateError = 0, DateErrorMsg ='',TimeError = 0;

      var delay = ( function() {
          var timer = 0;
          return function(callback, ms) {
              clearTimeout (timer);
              timer = setTimeout(callback, ms);
          };
      })();

      function Recommended4Inspection(classTOCall){
        var flag;
        var IDs = $('.laSelected').map(function () {return $(this).attr('apup')}).get();  
        var ifCheck = [], chckRmrks = [];
        var x = 0, y = '';
        
        if(IDs.length > 0) {
          
          var inpt = 0;
          
          for (var i = 0; i < IDs.length; i++) {
            inpt +=1;
            var sad = (typeof($('input[name="'+IDs[i]+'_rad_'+IDs[i]+inpt+'"]:checked').val()) == 'undefined') ? null :  parseInt($('input[name="'+IDs[i]+'_rad_'+IDs[i]+inpt+'"]:checked').val());
            // var sad = (typeof($('input[name="'+IDs[i]+'_rad_'+IDs[i]+'"]:checked').val()) == 'undefined') ? null :  parseInt($('input[name="'+IDs[i]+'_rad_'+IDs[i]+'"]:checked').val());
            console.log($('input[name="'+IDs[i]+'_rad_'+IDs[i]+inpt+'"]:checked').val());
            console.log(IDs[i]+'_rad_'+IDs[i]+inpt);
            ifCheck.push(sad);
            chckRmrks.push($('textarea[name="'+inpt+IDs[i]+'_txt"]').val());

            if ((sad == 0) && ($('textarea[name="'+inpt+IDs[i]+'_txt"]').val() == '') ) {
                x = 1; y = IDs[i];
                break;
            }              
          }

          console.log(ifCheck);

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
              text: 'Please evaluate all list first before proceedings.',
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
            let count = 0;
            let tables = {!!$tables!!};

            if(classTOCall == 'ApproveApplication'){
              approve = 1;
            } else {
              approve = 0;
            }
                          
            ifCheck.forEach(function(index, el) {
                // setTimeout(function () {
                  $.ajax({
                    url:'{{asset('employee/dashboard/processflow/LTO/evaluate/')}}',
                    method: "post",
                    data: {_token:$("input[name=_token]").val(), appid:apid, table: tables[count], eval:ifCheck[count], id:IDs[count],remarks:chckRmrks[count], approve: approve, requestFor: '{{$office}}'}
                  })
                // }, 1000);
              count++;
            });

            window[classTOCall]();
          }
              // if (allIsNull == false) {
              //   if (x == 0) {
              //       $.ajax({
              //         method: 'POST',
              //         data : {_token:$('#token').val(), ids:IDs, ifChk:ifCheck, ChkRmk: chckRmrks},
              //         success: function(data){
              //           if (data == 'DONE') {
              //             // window[classTOCall]();
              //           }
              //         },
              //         error : function(a, b, c){
              //           console.log(c);
              //           $('#ERROR_MSG2').show(100);
              //         }
              //     }); 
              //   }
              //     else {
              //       alert('Remarks required if evaluated NO');
    
              //       $('textarea[name="'+y+'_txt"]').focus();
              //     }
              // } else {

              //   alert('Please check all requirements before continuing');
              // }          
        } else {
            window[classTOCall]();
        }
      }

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

       function ApproveApplication(){
          let final = Array();
          let answers = $(".laSelected.notcoc");
          answers.each(function(a,b){
           if($(this).find('input[type=radio]:checked').val() == 0){
              final.push('hasNo');
           }
           
          })
          if(final.length <= 0){

            if(jQuery(".laSelected.coc").length){
              var coc = jQuery('[type="radio"]:eq( 0 )').prop('checked');

              if(coc == true){
                var $cocapprove = 1;
              } else {
                var $cocapprove = 0;
              }
            } else {
              var $cocapprove = 0;
            }
           
            $.ajax({
                url : '{{ asset('employee/dashboard/processflow/judgeApplication') }}',
                method : 'POST',
                data : {_token:$('#token').val(), apid :apid, coc: $cocapprove, propdate : $('#propDate').val(), proptime : $('#propTime').val(), selected: 1, requestFor: '{{$office}}' {{$coaFlag ? ',isCoa: true' : ''}}},
                success : function(data){
                    if (data == 'DONE') {
                      Swal.fire({
                        type: 'success',
                        title: 'Success',
                        text: 'Successfully Accepted Application.',
                      }).then(() => {
                        // if(!$forhfsrb || $redirect)
                            location.reload();
                        // else
                        //  window.location.href = '{{ asset('employee/dashboard/processflow/orderofpayment/') }}/{{$appID}}';
                        // endif
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

        function RejectApplication(){
          $.ajax({
                url : '{{ asset('employee/dashboard/processflow/judgeApplication') }}',
                method : 'POST',
                data : {_token:$('#token').val(), apid :apid, selected: 0, requestFor: '{{$office}}' {{$coaFlag ? ',isCoa: true' : ''}}},
                success : function(data){
                  if (data == 'DONE') {
                    Swal.fire({
                      type: 'success',
                      title: 'Success',
                      text: 'Successfully Disapproved Application.',
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

        function ReviseApplication(){
          $.ajax({
            url : '{{ asset('employee/dashboard/processflow/judgeApplication') }}',
             method : 'POST',
             data : {_token:$('#token').val(), apid :apid, selected: 2, requestFor: '{{$office}}' {{$coaFlag ? ',isCoa: true' : ''}}},
             success : function(data){
                if (data == 'DONE') {
                  Swal.fire({
                    type: 'success',
                    title: 'Success',
                    text: 'Successfully changed application status to revision.',
                  }).then(() => {

              @if($office == 'xray')
                  window.location.href = '{{ asset('employee/dashboard/processflow/pre-assessment/FDA/xray') }}';
             
              @elseif($office == 'pharma')
              window.location.href = '{{ asset('employee/dashboard/processflow/pre-assessment/FDA/pharma') }}';
             
              @else
              window.location.href = '{{ asset('employee/dashboard/processflow/evaluate/technical') }}';
               
               @endif
                 


                  });
                } else if (data == 'ERROR'){
                    $('#ERROR_MSG2').show(100);
                } else if (data == 'MAX') {
                    Swal.fire({
                      type: 'error',
                      title: 'Error',
                      text: 'Maximum number of tries reached, application will be automatically be Disapproved.',
                    }).then(() => {
                      RejectApplication();
                    });       
                }
             },
             error : function(a, b, c){
                console.log(c);
                $('#ERROR_MSG2').show(100);
             }
          });
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
                var allIsNull = ifCheck.every(function(i){return i === null; });
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
                      Swal.fire({
                        type: 'success',
                        title: 'Success',
                        text: 'Remarks required if evaluated NO.',
                      }).then(() => {
                        slug = false;
                        $('textarea[name="'+y+'_txt"]').focus();
                      });
                    }
                } else {
                  slug = false;
                  Swal.fire({
                    type: 'error',
                    title: 'Success',
                    text: 'Please check all requirements before continuing',
                  });
                }          
          }
       }
    </script>



    
    @endsection
@else
  <script type="text/javascript">window.location.href= "{{ asset('employee') }}";</script>
@endif