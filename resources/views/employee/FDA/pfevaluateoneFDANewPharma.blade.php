@if (session()->exists('employee_login'))      
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
            <div class="card-header bg-white font-weight-bold">
            <button class="btn btn-primary" onclick="window.history.back();">Back</button>
              <input type="" id="token" value="{{ Session::token() }}" hidden>
               Evaluation 
              
            </div>
            <div class="card-body">
            	<div class="col-sm-12">
                  <h2>@isset($AppData) {{$AppData->facilityname}} @endisset</h2>
                  <h5>@isset($AppData) {{strtoupper($AppData->streetname)}}, {{strtoupper($AppData->brgyname)}}, {{$AppData->cmname}}, {{$AppData->provname}} @endisset</h5>
                    @if(!empty($documentDate))
                    <h6>Institutional Character: 
                      @if(isset($AppData) && isset($AppData->facmdesc))<strong>{{$AppData->facmdesc}}</strong>
                        @else<span style="color:red">Not Available</span>
                        @endif &nbsp;
                        <a href="{{$linkToEdit}}" target="_blank" class="btn btn-warning">
                          <i class="fa fa-edit" aria-hidden="true"></i> Edit Application
                        </a>
                    </h6>
                    @endif
                    <h6>@isset($AppData) Status: @if ($AppData->isrecommendedFDA === null) <span style="color:blue">For Evaluation</span> @elseif($AppData->isrecommendedFDA == 1)  <span style="color:green">Accepted Evaluation</span> @elseif($AppData->isrecommendedFDA === 0) <span style="color:red">Disapproved Evaluation</span> 
                   
                    @else <span style="color:orange">Evaluated, for Revision</span> @endif @endisset</h6>

                    @if($AppData->isRecoDecisionPhar == 'Return for Correction') <span style="color:orange">Retuned for Correction</span> @endif
                    @if($AppData->isRecoDecisionPhar == 'Return for Correction' && $AppData->corResubmitPhar == 1) <br/><span style="color:GREEN">Correction Resubmitted</span> @endif
              	</div>
                <div class="d-flex justify-content-end">
                  <div class="row">
                    <div class="col-md">
                      <button class="btn btn-primary p-3" data-toggle="modal" data-target="#show">Show Requirements</button>
                    </div>
                    <!-- @if(strtolower($choosen) != 'machines')
                    <div class="col-md">
                      <a class="btn {{(FunctionsClientController::existOnDB('cdrrpersonnel',[['appid',$appid],['isTag',1]]) ? 'bg-danger': 'btn-primary')}} p-3 text-white" target="_blank" href="{{url('client1/apply/fda/CDRR/view/personnel/').'/'.$appid.'/tag'}}">Tag Pharmacist</a>
                    </div>
                    @endif -->
                  </div>
                  
                </div>
               
            	@if(($AppData->isRecoDecisionPhar == 'Return for Correction' &&  $AppData->corResubmitPhar == 0 )|| !isset($eval))

            	<div class="container pt-5 pb-3">

            <div class="container"></div>
					<form method="POST" enctype="multipart/form-data">
						{{csrf_field()}}
						<div class="row">
	            			<div class="col-md-12 text-center" style="font-size: 40px;">
	            				<u>{{($choosen == 'machines' ? 'Machine' : 'Pharmacy')}}</u>
	            			</div>
	            		</div>
	            		<div class="row pt-3">
	            			<div class="col-md-12 text-center" style="font-size: 30px;">
	            			Upload Evaluation Results of <span class="font-weight-bold">{{$AppData->facilityname}}</span>
	            			</div>
	            		</div>
	            		<div class="row pt-5 pb-3">
	            			<div class="col-md d-flex justify-content-center">
								<img src="{{asset('ra-idlis/public/img/FDADocuments.jpg')}}" alt="fda documents" width="30%">
							</div>
						</div>
	            		<div class="row pt-3 pb-4">
							<div class="col-md d-flex justify-content-center">
								<input type="file" name="fileUp" required>
							</div>
	            		</div>
	            		<div class="row">
	            			<div class="col-md-12">
	            				<div class="col-md text-center pb-2 pt-3" style="font-size: 20px;">
	            					Evaluation Recommendation 
	            				</div>
	            				<div class="col-md d-flex justify-content-center">
	            					<select name="recommendation" class="form-control" required style="width: 30%;">
	            						<option disabled hidden selected>Please Select</option>
                        @if($choosen == "machines")
	            						<option value="Certificate of Compliance  ">Certificate of Compliance  </option>
	            						<option value="License to Operate for LINAC, Transporatable  X-Ray Facility">License to Operate for LINAC, Transporatable  X-Ray Facility</option>
	            						<option value="Certificate of Facility Registration (MRI)">Certificate of Facility Registration (MRI)</option>
                          <option value="Notice of Deficiency (30 Days compliance)">Notice of Deficiency (30 Days compliance)</option>
                          <option value="Recommendation for Disapproval including forfeiture of payment">Recommendation for Disapproval including forfeiture of payment</option>
                      
                        @else
                        <option value="COCN">Certificate of Compliance</option>
                        <option value="NOD">Notice of Deficiency (30 Days compliance)</option>
                        <option value="RLN">Recommendation Letter </option>
                        @endif
                          
                          <!-- <option value="COC">COC</option>
	            						<option value="RL">RL</option>
                          <option value="RFD">RFD</option>
                          <option value="RFC">RFC</option> -->

	            					</select>
	            				</div>
	            			</div>
	            		</div>
	            		<div class="row pt-3">
	            			<div class="col-md-12">
	            				<div class="col-md text-center pb-2 pt-3" style="font-size: 20px;">
	            					Remarks
	            				</div>
	            				<div class="col-md d-flex justify-content-center">
	            					<textarea name="remarks" class="form-control" cols="30" rows="10" style="width: 43%"></textarea>
	            				</div>
	            			</div>
	            		</div>
	            		<div class="row pt-3">
	            			<div class="col-md d-flex justify-content-center">
	            				<button class="btn btn-primary" type="submit">Submit </button>
	            			</div>
	            		</div>
					</form>
            	</div>

				@else

				<div class="container pt-5">
					<div class="row pb-3">
            			<div class="col-md-12 text-center" style="font-size: 40px;">
            				<u>{{($choosen == 'machines' ? 'Machine' : 'Pharmacy')}}</u>
            			</div>
            		</div>
					<div class="row">
            			<div class="col-md-12 text-center" style="font-size: 30px;">
            				View Evaluation Results of <span class="font-weight-bold">{{$AppData->facilityname}}</span>
            			</div>
            		</div>
                @if(isset($eval->uploadfilename))
            		<div class="row pt-5 pb-4">
            			<div class="col-md-12 text-center" style="font-size: 30px;">
            				Download File
            			</div>
        					<div class="col-md d-flex justify-content-center pt-3">
        						<a href="{{url('file/download/'.$eval->uploadfilename)}}" class="btn btn-primary p-3">Download File</a>
        					</div>
            		</div>
                @endif

            		<div class="row">
            			<div class="col-md-12">
            				<div class="col-md text-center pb-2 pt-3" style="font-size: 30px;">
            					Evaluation Recommendation
            				</div>
            				<div class="col-md d-flex justify-content-center lead" style="font-size: 26px;" >
            					<u>
                      @switch($eval->decision)
                        @case('COCN')
                          Certificate of Compliance
                        @break 
                        @case('LINAC')
                        License to Operate for LINAC, Transporatable  X-Ray Facility
                        @break 
                        @case('CFR')
                        Certificate of Facility Registration (MRI)
                        @break
                        @case('NOD')
                        Notice of Deficiency (30 Days compliance)
                        @break
                        @case('RFD')
                        Recommendation for Disapproval including forfeiture of payment
                        @break

                        @default
                            Recommendation Letter
                        @break
						       		@endswitch
                       
                      
                      
                      
                      </u>


            				</div>
                    <div class="col-md d-flex justify-content-center lead" style="font-size: 26px;" >
                       @if(strtolower($eval->decision) == 'rfc')
                        <div class="row">
                          <div class="col">
                            <a data-toggle="modal" data-target="#AccepttGodModal" style="cursor: pointer;" class="text-primary"><u>Update Recommendation</u></a>
                          </div>
                        </div>
                      @endif
                    </div>
            			</div>
            		</div>
            		<div class="row pt-3">
            			<div class="col-md-12">
            				<div class="col-md text-center pb-2 pt-3" style="font-size: 30px;">
            					Remarks
            				</div>
            				<div class="col-md d-flex justify-content-center" style="font-size: 26px;">
            					<u>{{$eval->remarks}}</u>
            				</div>
            			</div>
            		</div>
            	</div>

            	@endif
            </div>
      	</div>

         <div class="modal fade" id="AccepttGodModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
          <form method="post">
              <div class="modal-dialog" role="document">
                <div class="modal-content" style="border-radius: 0px;border: none;">
                  <div class="modal-body" style=" background-color: #272b30;color: white;">
                    <h5 class="modal-title text-center"><strong>Update Recommendation</strong></h5>
                    <hr>
                    <div class="col-sm-12 alert alert-danger alert-dismissible fade show" style="display: none" id="AccErrorAlert" role="alert">
                              <strong><i class="fas fa-exclamation"></i></strong>&nbsp;An <strong>error</strong> occurred. Please contact the system administrator.
                              <button type="button" class="close" onclick="$('#AccErrorAlert').hide(1000);" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                              </button>
                          </div>
                    <div class="container">
                          <div class="col-sm-12">
                            <div class="row">
                              <div class="col-md-12">
                                  <div class="col-md text-center pb-2 pt-3" style="font-size: 20px;">
                                    Evaluation Recommendation 
                                  </div>
                                  <div class="col-md d-flex justify-content-center">
                                    <select name="recommendation" class="form-control" required style="width: 100%;">
                                      <option disabled hidden selected>Please Select</option>
                                      <option value="COC">COC</option>
                                      <option value="RL">RL</option>
                                      <option value="RFD">RFD</option>
                                      <option value="RFC">RFC</option>
                                    </select>
                                  </div>
                                </div>
                            </div>
                          </div>
                          <input type="hidden" name="isupdate">
                          {{csrf_field()}}
                      <hr>
                        <div class="row">
                            <div class="col-sm-6">
                              <button type="submit" id="MODALBTN" onclick="" class="btn btn-outline-success form-control" style="border-radius:0;"><span class="fa fa-sign-up"></span>Yes</button>
                          </div> 
                          <div class="col-sm-6">
                            <button type="button" data-dismiss="modal" class="btn btn-outline-danger form-control" style="border-radius:0;"><span class="fa fa-sign-up"></span>No</button>
                          </div>
                     </div>

                   
                 </div>
               </div>
             </div>
           </div>
           </form>
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

        <div class="modal fade" id="show" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content"> 
              <div class="modal-body">
                <div class="row">
                @isset($list)
                  @foreach($list as $items)
                    @if($items[4] == ($choosen == 'machines' ? 'CDRRHR' :'CDRR'))
                    <div class="col-md mt-3 mb-2">
                      <a target="_blank" class="btn btn-success" href="{{url($items[0].'/'.$appid)}}">{{$items[1]}}</a>
                    </div>
                    @endif
                  @endforeach
                @else
                  No List Given
                @endisset
                </div>
              </div>
            </div>
          </div>
        </div>
    
    <script>
      $("[name=recommendation]").change(function(event) {
        if($(this).find('option:selected').val() == 'RL'){
          $("[name=fileUp]").removeAttr('required').hide();
        } else {
          $("[name=fileUp]").attr('required',true).show();
        }
      });
    </script>


    
    
    @endsection
@else
  <script type="text/javascript">window.location.href= "{{ asset('employee') }}";</script>
@endif