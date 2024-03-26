@if (session()->exists('employee_login'))
@extends('mainEmployee')
@section('title', 'Order of Payment Process Flow')
@section('content')
<div class="content p-4">
  <div hidden>
    @isset($OOPs)
      <datalist id="OrderOfPaymentList">
          @foreach ($OOPs as $day)
            <option id="{{$day->oop_id}}_OOP" value="{{$day->oop_id}}">{{$day->oop_desc}}</option>
          @endforeach
      </datalist>
    @endisset
    @if (isset($OOPs) && isset($Chrges))
        @foreach ($OOPs as $O)
          <datalist id="{{$O->oop_id}}_List">
            @foreach ($Chrges as $C)
              @if ($C->oop_id == $O->oop_id)
                <option value="{{$C->chgapp_id}}" id="{{$C->chgapp_id}}_CHG" code="{{$C->chg_code}}" amt="{{$C->amt}}" frmAMT="{{$C->formattedAmt}}">{{$C->chg_desc}} {{$C->chg_rmks}}</option>
              @endif
            @endforeach
          </datalist>
        @endforeach
    @endif
  </div>
    <div class="card">
        <div class="card-header bg-white font-weight-bold">
          @isset($APPID)<input type="text" id="APPID" value="{{$APPID}}" hidden>@endisset
          <input type="" id="token" value="{{ Session::token() }}" hidden>
           Order of Payment Evaluation <span class="optnTD" style="display: none;">(Override Payment Mode)</span>&nbsp;
           <button class="btn btn-primary" onclick="window.history.back();">Back</button>
        </div>
        <div class="card-body">
          <table class="table table-borderless">
          <thead>
            <tr>
              <td width="100%">
                <h2>@isset($AppData) {{$AppData->facilityname}} @endisset</h2>
                <h5>@isset($AppData) {{strtoupper($AppData->streetname)}}, {{strtoupper($AppData->brgyname)}}, {{$AppData->cmname}}, {{$AppData->provname}} @endisset</h5>
                <h5>
                  Code: <span class="font-weight-bold">{{$code}}</span>
                </h5>
                <h6>@isset($AppData) Status: @if ($AppData->isPayEval === null) <span style="color:blue">For Payment Evaluation</span> @elseif($AppData->isPayEval == 1)  <span style="color:green">Payment Evaluated</span> @else <span style="color:red">Disapproved Payment</span> @endif @endisset</h6>
              </td>
            </tr>
          </thead>
          </tbody>  
        </table>
        <hr>
        <div class="col d-flex justify-content-end">
          <button type="button" onclick="window.print();" class="btn btn-primary p-3 mb-3">
            <i class="fa fa-print" aria-hidden="true"></i> Print
          </button>
        </div>
        <div class="container border">
          <table class="table">
            <thead>
                <tr>
                  <th scope="col" style="text-align:left;width:auto;">Description</th>
                  {{-- <th scope="col" style="text-align:center;width:auto;">Nature of Collection</th> --}}
                  {{-- <th scope="col" style="text-align:center;width:auto;">Account Code</th> --}}
                  {{-- <th scope="col" style="text-align:center;width:auto;">UACS Title</th> --}}
                  <th scope="col" style="text-align:left;width:auto;">Amount</th>
                  {{-- <th scope="col" class="optnTD" style="text-align:center;width:auto;">Option</th> --}}
                </tr>
            </thead>
            <tbody id="PaymentTable">
              @isset($Payments)
              @php $orderofpaymentSum = 0.00;  @endphp
                @foreach ($Payments as $element)
                  @if($element->cat_id !== 'PMT' && $element->isPaid != 1)
                  @php $orderofpaymentSum += $element->amount; @endphp
                  <tr>
                    <td class="font-weight-bold">{{$element->reference}}</td>
                    {{-- <td class="text-center font-weight-bold">{{isset($element->m04Desc) ? $element->m04Desc : 'Not Yet Defined'}}</td> --}}
                    {{-- <td scope="row" style="text-align:center;cursor: pointer;"><span data-toggle="tooltip" title="{{$element->m04Desc}}">{{isset($element->m04ID) ? $element->m04ID : 'Not Yet Defined'}}</span></td> --}}
                    {{-- <td scope="row" style="text-align:center">{{isset($element->m04Desc) ? $element->m04ID : 'Not Yet Defined'}}</td> --}}
                   {{--  <td class="text-center">@isset($element->cat_type)@if($element->cat_type == "P") {{Date("F j, Y", strtotime($element->t_date))}}, {{date("g:i a", strtotime($element->t_time))}} @endif @endisset</td>
                    <td class="text-center">@isset($element->cat_type)@if($element->cat_type == "P") {{$element->chg_desc}} @endif @endisset</td> --}}
                    <td style="text-align:left">{!!($element->reference != 'Payment'? 'PHP '.number_format(abs($element->amount)) : '<strong>-PHP '.number_format(abs($element->amount))."</strong")!!}</td>
                    <td class="optnTD" style="display:none"><center><button style="background-color: #d40000" class="btn btn-primarys" onclick="showDelete({{$element->id}}, '{{$element->chg_code}} - {{$element->reference}}')" data-toggle="modal" data-target="#DelGodModal"><i class="fa fa-trash" aria-hidden="true"></i></button></center></td>
                    <td>
                      
                    </td>
                  </tr>
                  @endif
                @endforeach
              @endisset
              @isset($Sum)
                <tr style="border-top: double">
                  <td class="font-weight-bold" scope="row" colspan="1" style="text-align:center; font-size: 23px;">Total Amount</td>
                  <td class="font-weight-bold text-center" scope="row" style="text-align:left; font-size: 23px;">{{'PHP '.number_format($orderofpaymentSum,2)}}</td>
                  <td scope="row" class="optnTD" style="display:none">&nbsp;</td>
                </tr>
              @endisset
            </tbody>
          </table>
        </div>
        @isset($AppData)
        @if(!isset($AppData->isPayEval))
        <br>
        <hr>
        <div class="container">
          <center>
            {{-- <span class="optnTD"><button style="background-color: #82d202" class="btn btn-primarys" data-toggle="modal" data-target="#AccepttGodModal">Accept Payment</button> &nbsp;</span> --}}
            <span class="optnTD"><button style="background-color: #82d202" class="btn btn-primarys" onclick="ShowifApOrReg(1)" data-toggle="modal" data-target="#AccepttGodModal" >Approve</button> &nbsp;</span>
            {{-- <span  class="optnTD"><button style="background-color: #dc3545;" class="btn btn-primarys" onclick="ShowifApOrReg(0)"  data-toggle="modal" data-target="#AccepttGodModal" >Reject</button>&nbsp;</span> --}}
            <span style="display:none" class="optnTD"><button style="background-color: #82d202;" class="btn btn-primarys" onclick="AddPay()" data-toggle="modal" data-target="#AddGodModal">Add</button>&nbsp;</span>
            <span class="optnTD"><button style="background-color: #3557d2" class="btn btn-primarys" id="OvrBtn" onclick="$('.optnTD').toggle();setData(1);">Override</button></span>
            <span style="display:none" class="optnTD">&nbsp;<button style="background-color: #ff8100;" class="btn btn-primarys" id="CnclBtn" onclick="$('.optnTD').toggle();setData(0);" id="">Cancel Override</button></span>
          </center>
        </div>
        @endif
        @endisset
      </div>
      </div>
    </div>
</div>

<div class="modal fade" id="DelGodModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content" style="border-radius: 0px;border: none;">
            <div class="modal-body" style=" background-color: #272b30;color: white;">
              <h5 class="modal-title text-center"><strong>Delete Charge</strong></h5>
              <hr>
              <div class="col-sm-12 alert alert-danger alert-dismissible fade show" style="display: none" id="DelErrorAlert" role="alert">
                        <strong><i class="fas fa-exclamation"></i></strong>&nbsp;An <strong>error</strong> occurred. Please contact the system administrator.
                        <button type="button" class="close" onclick="$('#DelErrorAlert').hide(1000);" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
              <div class="container">
                <span id="DelModSpan">
                </span>
                <hr>
                    <div class="row">
                      <div class="col-sm-6">
                      <button type="button" onclick="deleteNow();" class="btn btn-outline-success form-control" style="border-radius:0;"><span class="fa fa-sign-up"></span>Yes</button>
                    </div> 
                    <div class="col-sm-6">
                      <button type="button" data-dismiss="modal" class="btn btn-outline-danger form-control" style="border-radius:0;"><span class="fa fa-sign-up"></span>No</button>
                    </div>
                    </div>
              </div>
            </div>
          </div>
        </div>
      </div>
<div class="modal fade" id="AccepttGodModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content" style="border-radius: 0px;border: none;">
            <div class="modal-body" style=" background-color: #272b30;color: white;">
              <h5 class="modal-title text-center"><strong> <span id="AppRegTitle">&nbsp;</span> </strong></h5>
              <hr>
              <div class="col-sm-12 alert alert-danger alert-dismissible fade show" style="display: none" id="AccErrorAlert" role="alert">
                        <strong><i class="fas fa-exclamation"></i></strong>&nbsp;An <strong>error</strong> occurred. Please contact the system administrator.
                        <button type="button" class="close" onclick="$('#AccErrorAlert').hide(1000);" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
              <div class="col-sm-12">
                    <div class="col-sm-12 text-justify"> 
                      <p>ClICKING YES MEANS ALL REQUIREMENTS HAVE BEEN REVIEWED AND NO FURTHER CORRECTIONS ARE NECESSARY ON THE APPLICATION</p>
                    </div>
                    <form id="ApprRejRmk" data-parsley-validate>
                    @isset($APPID)
                      <input type="text" id="SelectedAPPID" value="{{$APPID}}" hidden="">
                    @endisset
                    <div class="row" hidden>
                        <div class="col-sm-4">Remarks:</div>
                        <div class="col-sm-8"><textarea rows="3" id="RmkTest" class="form-control"></textarea></div>
                    </div>
                  </form>
                <hr>
                    <div class="row">
                      <div class="col-sm-6">
                      <button type="button" id="AppRegBtn" onclick="" class="btn btn-outline-success form-control" style="border-radius:0;"><span class="fa fa-sign-up"></span>Yes</button>
                    </div> 
                    <div class="col-sm-6">
                      <button type="button" data-dismiss="modal" class="btn btn-outline-danger form-control" style="border-radius:0;"><span class="fa fa-sign-up"></span>No</button>
                    </div>
                    </div>
              </div>
            </div>
          </div>
        </div>
      </div>
<div class="modal fade" id="AddGodModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content" style="border-radius: 0px;border: none;">
            <div class="modal-body" style=" background-color: #272b30;color: white;">
              <h5 class="modal-title text-center"><strong>Add Payment</strong></h5>
              <hr>
              <div class="col-sm-12 alert alert-danger alert-dismissible fade show" style="display: none" id="AddErrorAlert" role="alert">
                        <strong><i class="fas fa-exclamation"></i></strong>&nbsp;An <strong>error</strong> occurred. Please contact the system administrator.
                        <button type="button" class="close" onclick="$('#AddErrorAlert').hide(1000);" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
              <div class="">
                <form id="addRgn" data-parsley-validate>
                  {{ csrf_field() }}
                  <span class="container" id="AddModSpan" style="width: 100%">
                  </span>
                </form>
                <hr>
                    <div class="row">
                      <div class="col-sm-6">
                      <button type="button" onclick="$('#addRgn').submit()" class="btn btn-outline-success form-control" style="border-radius:0;"><span class="fa fa-sign-up"></span>Add</button>
                    </div> 
                    <div class="col-sm-6">
                      <button type="button" data-dismiss="modal" class="btn btn-outline-danger form-control" style="border-radius:0;"><span class="fa fa-sign-up"></span>Cancel</button>
                    </div>
                    </div>
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
	var OverrideMode = 0,AprvRejVar = 0;
        $(document).ready(function(){ $('[data-toggle="tooltip"]').tooltip();});
        function setData(data){
          OverrideMode = data;
        }
    function showDelete (id,desc){
            $('#DelModSpan').empty();
            $('#DelModSpan').append(
                '<div class="col-sm-12"> Are you sure you want to delete <span style="color:red"><strong>' + desc + '</strong></span>?' +
                  // <input type="text" id="edit_desc2" class="form-control"  style="margin:0 0 .8em 0;" required>
                '<input type="text" id="toBeDeletedID" class="form-control"  style="margin:0 0 .8em 0;" value="'+id+'" hidden>'+
                '<input type="text" id="toBeDeletedname" class="form-control"  style="margin:0 0 .8em 0;" value="'+desc+'" hidden>'+
                '</div>'
              );
        }
    
    function AddPay(){
          $('#AddModSpan').empty();
          $('#AddModSpan').append(
                '<div class="row">' +
                  '<div class="col-sm-4">Order of Payment:</div>' +
                  '<div class="col-sm-8" style="margin:0 0 .8em 0;">' +
                    '<input type="text" id="selectOOP" data-parsley-required-message="*<strong>Order of Payment</strong> required" list="OrderOfPaymentList" onchange="getChrges();" class="form-control"  required>' +
                  '</div>' +
                '</div>' +
                '<div class="row">' +
                  '<div class="col-sm-4">Charge</div>' +
                  '<div class="col-sm-8" style="margin:0 0 .8em 0;">' +
                    '<select type="text" id="selectCharge" data-parsley-required-message="*<strong>Charge</strong> required" onchange="getAmount()" class="form-control"  required>' +
                    '</select>' +
                  '</div>' +
                '</div>' +
                '<div class="row">' +
                  '<div class="col-sm-4">Amount</div>' +
                  '<div class="col-sm-8" style="margin:0 0 .8em 0;">' +
                    '<input type="text" id="selectAMOUNT" class="form-control" disabled value="">' +
                  '</div>' +
                '</div>'
            );
        }
    function getChrges(){
          var selectOOP = $('#selectOOP').val();
          var arr = $('#'+selectOOP+'_List option[value]').map(function () {return this.value}).get();
          if (arr.length != 0) {
            var arr2 = $('#'+selectOOP+'_List option[value]').map(function () {return this.text}).get();
            $('#selectCharge').empty();
            $('#selectCharge').append('<option value="">&nbsp;</option>');
            for (var i = 0; i < arr.length; i++) {
              var code = $('#' +arr[i] + '_CHG').attr('code');
              var desc = $('#' +arr[i] + '_CHG').text;
              $('#selectCharge').append('<option value="'+arr[i]+'">'+code+' ('+arr2[i]+')</option>');
            }
          } else {
            $('#selectCharge').empty();
          }
        }
    function getAmount(){
          $('#selectAMOUNT').attr('value','');
          var selectedID = $('#selectCharge').val();
          if (selectedID != '') {
            console.log(selectedID);
            var amount = $('#' +selectedID + '_CHG').attr('frmamt');
            $('#selectAMOUNT').attr('value',amount);
          }
        }
    function ShowifApOrReg(AppOrReje){
          if (AppOrReje == 1) { // Appproved
              $('#AppRegTitle').text('ISSUE ORDER OF PAYMENT');
              $('#AppRegBtn').attr('onclick','AprvRej(1)');
              $("#AppRegTest").append("Accepted");
          } else { // Reject
              $('#AppRegTitle').text('Disapprove');
              $('#AppRegBtn').attr('onclick','AprvRej(0)');
              $("#AppRegTest").append("Disapprove");
          }
        }
    function AprvRej(ApOrRe){
          AprvRejVar = ApOrRe;
          $('#ApprRejRmk').submit();
        }
        
    $('#addRgn').on('submit', function(event){
            event.preventDefault();
            var form = $(this);
            form.parsley().validate();
            if (form.parsley().isValid()) {
                var selectedID = $('#selectCharge').val();
                var amount = $('#' +selectedID + '_CHG').attr('amt');
                var selectedText = $('#' +selectedID + '_CHG').text();
                // console.log(selectedText);
                $.ajax({
                    method : 'POST',
                    data : { 
                         _token:$('#token').val(),
                         id : $('#selectCharge').val(),
                         amount : amount,
                         desc : selectedText,
                         appid : $('#APPID').val(),
                      },
                    success : function(data){
                        if (data == 'DONE') {
                            alert('Successfully added new payment');
                            $('#AddGodModal').modal('toggle');
                            location.reload();
                        } else if (data == 'ERROR') {
                          $('#AddErrorAlert').show(100);
                        }
                    }, 
                    error : function(XMLHttpRequest, textStatus, errorThrown){
                        console.log(errorThrown);
                        $('#AddErrorAlert').show(100);
                    }
                });
            }
        });
   	function deleteNow(){
            $.ajax({
                url : '{{ asset('employee/dashboard/processflow/orderofpayment/deleteCharge') }}',
                method : 'POST',
                data: {_token:$('#token').val(),id :$('#toBeDeletedID').val()},
                success : function(data){
                  if (data == 'DONE') {
                      $('#DelGodModal').modal('toggle');
                      alert('Successfully deleted a charge');
                      location.reload();
                  } else if (data == 'ERROR') {
                      $('#DelErrorAlert').show(100);
                  }
                },
                error : function(XMLHttpRequest, textStatus, errorThrown){
                  console.log(errorThrown);
                  $('#DelErrorAlert').show(100);
                }
            });
        }
    $('#ApprRejRmk').on('submit', function(e){
          e.preventDefault();
          var form = $(this);
          form.parsley().validate();
          if (form.parsley().isValid()) {
              $.ajax({
                url : '{{ asset('employee/dashboard/processflow/orderofpayment/accept_orderofpayment') }}',
                method : 'POST',
                data : {_token:$('#token').val(), id: $('#SelectedAPPID').val(),  AoR : AprvRejVar, selected : 0},
                success : function(data){
                  if (data == 'ERROR') {
                    $('#AccErrorAlert').show(100);
                  } else if(data == 'DONE') {
                      alert('Successfully changed status of application');
                      window.location.href = "{{ asset('employee/dashboard/processflow/evaluate') }}";
                  }
                },
                error : function(a,b,c){
                    console.log(c);
                    $('#AccErrorAlert').show(100);
                }
              });
          }
        });

</script>
@endsection
@else
  <script type="text/javascript">window.location.href= "{{ asset('employee') }}";</script>
@endif
