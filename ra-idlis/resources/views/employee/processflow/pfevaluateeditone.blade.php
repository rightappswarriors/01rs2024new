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
              <input type="text" id="NumberOfRejected" value="@isset ($numOfX) {{$numOfX}} @endisset" hidden>
              <input type="" id="token" value="{{ Session::token() }}" hidden>
               Evaluation (Modify Application)
               <button class="btn btn-primary" onclick="window.history.back();">Back</button>
            </div>
            <div class="card-body">
              {{-- <div class="col-sm-12">
                  <h2>@isset($AppData) {{$AppData->facilityname}} @endisset</h2>
                  <h5>@isset($AppData) {{strtoupper($AppData->streetname)}}, {{strtoupper($AppData->brgyname)}}, {{$AppData->cmname}}, {{$AppData->provname}} @endisset</h5>
                    <h6>Institutional Character: @if(isset($AppData) && isset($AppData->facmdesc))<strong>{{$AppData->facmdesc}}</strong>@else<span style="color:red">Not Available</span>@endif &nbsp;<button type="button"  class="btn btn-warning" onclick="window.location.href='{{ asset('employee/dashboard/processflow/evaluate')}}/{{$AppData->appid}}/edit'"><i class="fa fa-edit" aria-hidden="true"></i> Edit</button></h6>
                    <h6>@isset($AppData) Status: @if ($AppData->isrecommended === null) <span style="color:blue">For Evaluation</span> @elseif($AppData->isrecommended == 1)  <span style="color:green">Accepted Evaluation</span> @else <span style="color:red">Rejected Evaluation</span> @endif @endisset</h6>
              </div> --}}
            <br>
            </div>
        </div>
    </div>
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
                    <td><button type="button" class="btn-primarys" id="ModalYesButton">Yes</button></td>
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
    <script type="text/javascript">
    </script>
    @endsection
@else
  <script type="text/javascript">window.location.href= "{{ asset('employee') }}";</script>
@endif