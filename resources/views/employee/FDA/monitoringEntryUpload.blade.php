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
              <input type="" id="token" value="{{ Session::token() }}" hidden>
               Evaluation
               <button class="btn btn-primary" onclick="window.history.back();">Back</button>
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
{{--                     <h6>@isset($AppData) Status: @if ($AppData->isrecommendedFDA === null) <span style="color:blue">For Evaluation</span> @elseif($AppData->isrecommendedFDA == 1)  <span style="color:green">Accepted Evaluation</span> @elseif($AppData->isrecommendedFDA === 0) <span style="color:red">Rejected Evaluation</span> @else <span style="color:orange">Evaluated, for Revision</span> @endif @endisset</h6> --}}
              	</div>
                {{-- <div class="d-flex justify-content-end">
                  <div class="row">
                    <div class="col-md">
                      <button class="btn btn-primary p-3" data-toggle="modal" data-target="#show">Show Requirements</button>
                    </div>
                  </div>
                  
                </div> --}}
            	@if(!isset($eval))

            	<div class="container pt-5 pb-3">

            <div class="container"></div>
					<form method="POST" enctype="multipart/form-data">
						{{csrf_field()}}
						<div class="row">
	            			<div class="col-md-12 text-center" style="font-size: 40px;">
	            				<u>{{($choosen == 'machines' ? 'Radiation Facility' : 'Pharmacy')}}</u>
	            			</div>
	            		</div>
	            		<div class="row pt-3">
	            			<div class="col-md-12 text-center" style="font-size: 30px;">
	            				Upload Monitoring Results of <span class="font-weight-bold">{{$AppData->facilityname}}</span>
	            			</div>
	            		</div>
	            		<div class="row pt-5 pb-3">
	            			<div class="col-md d-flex justify-content-center">
								<img src="{{asset('ra-idlis/public/img/FDADocuments.jpg')}}" alt="fda documents" width="30%">
							</div>
						</div>
	            		<div class="row pt-3 pb-4">
      							<div class="col-md d-flex justify-content-center">
                      <div class="col-md-3 lead">
                        Monitoring Result File
                      </div>
                      <div class="col-md">
      								<input type="file" name="fileUp" class="form-control" required>
                      </div>
      							</div>
                    <div class="col-md d-flex justify-content-center" id="otherUpload" style="display: none!important;">
                      <div class="col-md-2 lead">
                        @if($choosen == 'machines') NOD @else Other Requirement @endif Upload
                      </div>
                      <div class="col-md">
                      <input type="file" name="otherUpload" class="form-control" id="otherUploadFile">
                      </div>
                    </div>
	            		</div>
	            		<div class="row">
	            			<div class="col-md-12">
	            				<div class="col-md text-center pb-2 pt-3" style="font-size: 20px;">
	            					Monitoring Result
	            				</div>
	            				<div class="col-md d-flex justify-content-center">
	            					<select name="recommendation" class="form-control" style="width: 30%;" required="">
	            						<option value="" disabled hidden selected>Please Select</option>
	            						<option value="C">Compliant</option>
	            						<option value="FC">For Compliance</option>
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
	            				<button class="btn btn-primary" type="submit">Submit</button>
	            			</div>
	            		</div>
					</form>
            	</div>

				@else

				<div class="container pt-5">
					<div class="row pb-3">
            			<div class="col-md-12 text-center" style="font-size: 40px;">
            				<u>{{($choosen == 'machines' ? 'Radiation Facility' : 'Pharmacy')}}</u>
            			</div>
            		</div>
					<div class="row">
            			<div class="col-md-12 text-center" style="font-size: 30px;">
            				View Monitoring Results of <span class="font-weight-bold">{{$AppData->facilityname}}</span>
            			</div>
            		</div>
            		<div class="row pt-5 pb-4">
            			<div class="col-md-12 text-center" style="font-size: 30px;">
            				Download File
            			</div>
						<div class="col-md d-flex justify-content-center pt-3">
							<a href="{{url('file/download/'.$eval->fileName)}}" class="btn btn-primary p-3">Download File</a>
						</div>
            		</div>
            		<div class="row">
            			<div class="col-md-12">
            				<div class="col-md text-center pb-2 pt-3" style="font-size: 30px;">
            					Monitoring Result
            				</div>
            				<div class="col-md d-flex justify-content-center lead" style="font-size: 26px;" >
            					<u>{{($eval->decision == 'C' ? 'Compliant' : 'For Compliance')}}</u>
            				</div>
            			</div>
            		</div>
            		<div class="row pt-3">
            			<div class="col-md-12">
            				<div class="col-md text-center pb-2 pt-3" style="font-size: 30px;">
            					Remarks
            				</div>
            				<div class="col-md d-flex justify-content-center" style="font-size: 26px;">
            					<u>{{$eval->remark}}</u>
            				</div>
            			</div>
            		</div>
            	</div>


                @isset($fromClient)
                  <p class="display-4 text-center mt-5"><u>Response from Client</u></p>
                  @foreach($fromClient as $key => $value)
                    <div class="row">
                        @php 
                        $images = explode(',',$value->fileName);
                        $perDiv = (12 % count($images) == 0 ? '-'.(12 / count($images)) : '-3');
                      @endphp
                      @foreach($images as $image)
                        <div class="col{{$perDiv}} mt-3">
                          {{-- <img onclick="window.open('{{asset('ra-idlis/storage/app/public/uploaded/'.$image)}}')" class="w-100" src="{{asset('ra-idlis/storage/app/public/uploaded/'.$image)}}" style="cursor: pointer;"> --}}
                          <img onclick="window.open('{{asset('ra-idlis/storage/app/public/uploaded/'.$image)}}')" class="w-100" src="{{(is_array(getimagesize(url('ra-idlis/storage/app/public/uploaded/'.$image))) ? asset('ra-idlis/storage/app/public/uploaded/'.$image) : url('ra-idlis/public/img/no-preview-available.png'))}}" style="cursor: pointer;">
                        </div>
                      @endforeach
                    </div>
                  @endforeach
                  @if($monitoringDetails->decision != 'C')
                  <div class="d-flex justify-content-center">
                    {{-- Change Status to Compliant --}}
                    <button class="btn btn-primary mt-4" data-toggle="modal" data-target="#ShowDetailsModal">Accepted</button>
                  </div>
                  <div class="d-flex justify-content-center">
                    {{-- Resend to Client for other details --}}
                    <button class="btn btn-primary mt-4" data-toggle="modal" data-target="#ShowDetailsModalResend">Not Accepted</button>
                  </div>
                  @endif

                @endisset

            	@endif
            </div>
      	</div>
        @if($monitoringDetails->decision != 'C')

      	<div class="modal fade" id="ShowDetailsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
        <form method="post"> 
          {{csrf_field()}}
          <input type="hidden" name="changeTo" value="C">
  				<div class="modal-content"> 
            
  					<div class="modal-body">
  					<h4 class="modal-title text-center text-danger"><strong>Warning</strong></h4>
  					  <hr>
  					  <span id="ShowDetailsModalBody"></span>         
  				    <div class="row">
  				      <div class="col-md-12 text-center lead">
                  Are you sure you want to change status of this monitored facility to Compliant?
  				     </div>
  				    </div>
  				  </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-outline-primary form-control" style="border-radius:0;"><span class="fa fa-sign-up"></span>Submit</button>
              <button type="button" data-dismiss="modal" class="btn btn-outline-danger form-control" style="border-radius:0;"><span class="fa fa-sign-up"></span>Close</button>
            </div>
          </div>
        </form>
        </div>
        </div>

        <div class="modal fade" id="ShowDetailsModalResend" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
        <form method="post"> 
          {{csrf_field()}}
          <div class="modal-content"> 
            
            <div class="modal-body">
            <h4 class="modal-title text-center text-danger"><strong>Warning</strong></h4>
              <hr>
              <span id="ShowDetailsModalBody"></span>         
              <div class="row">
                <div class="col-md-12 text-center lead">
                 Resend application details to client
               </div>
               <div class="col-md-12 text-center lead">
                  <textarea name="remarksFC" class="form-control mt-3 mb-3" cols="50" rows="10" style="width: 100%"></textarea>
                  <small class="lead">Remarks</small>
               </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-outline-primary form-control" style="border-radius:0;"><span class="fa fa-sign-up"></span>Submit</button>
              <button type="button" data-dismiss="modal" class="btn btn-outline-danger form-control" style="border-radius:0;"><span class="fa fa-sign-up"></span>Close</button>
            </div>
          </div>
        </form>
        </div>
        </div>


        @endif

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

      $("[name=recommendation]").change(function(){
        if($(this).val() != 'C'){
          $("[name=remarks]").attr('required','true');
          $("#otherUpload").removeAttr('style');
          $("#otherUploadFile").attr('required','true');
        } else {
          $("[name=remarks]").removeAttr('required');
          $("#otherUpload").attr('style','display: none!important;');
          $("#otherUploadFile").removeAttr('required');
        }
      })
    
    </script>



    
    @endsection
@else
  <script type="text/javascript">window.location.href= "{{ asset('employee') }}";</script>
@endif