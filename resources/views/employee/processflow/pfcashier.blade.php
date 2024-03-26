@if (session()->exists('employee_login'))  
  @extends('mainEmployee')
  @section('title', 'Cashier')
  @section('content')
  {{-- {{dd($BigData)}} --}}
  <input type="text" id="CurrentPage" hidden="" value="MOD010"> 
  <div class="content p-4">
      <div class="card">
          <div class="card-header bg-white font-weight-bold">
             <h3>Cashiering</h3>
          </div>
          
          <form class="filter-options-form">
            @include('employee.tableDataFilter') 
          </form>

          <div class="card-body table-responsive backoffice-list">
   
              <table class="table table-hover" >
                  <thead>
                    <tr>
                      <td scope="col" class="text-center">Line#</td>
                      <td scope="col" class="text-center">Process</td>
                      <td scope="col" class="text-center">Type</td>
                      <td scope="col" class="text-center">App.Code</td>
                      <td scope="col" class="text-center">Facility Name</tdth>
                      <td scope="col" class="text-center">Type of Facility</td>
                      <td scope="col" class="text-center">Applied Date</td>
                      <td scope="col" class="text-center">Payment Confirmation Date</td>
                      <td scope="col" class="text-center">Payment Confirmatio Status<br><small>If status is <strong>"For Payment"</strong> if payment is NOT YET <strong>accepted and confirmed</strong>, otherwise it is <strong>"Paid"</strong>.</small></td>
                      <td scope="col" class="text-center">Options</td>
                    </tr>
                  </thead>
                  <tbody id="FilterdBody">  
                      @if (isset($BigData))
                        @if(count($BigData) > 0)
                        @php  $status = 1;    @endphp
                          @foreach ($BigData as $data)
                                @php
                                  $paid = ""; $reco = ""; $ifdisabled = '';$color = '';
                                  
                                  if(isset($data->appid_payment)) {  $paid = $data->appid_payment; }
                                  if(isset($data->isrecommended)) {  $reco = $data->isrecommended; }                                
                                  
                              if($data->status == 'P' || $data->status == 'RA' || $data->status == 'RE' || $data->status == 'RI' ){
                                    $ifdisabled = 'disabled';
                                  }

                                @endphp
                                <tr>
                                  <td class="text-center">{{$status}}</td>
                                  <td class="text-center">{{$data->aptdesc}}</td>
                                  <td class="text-center"><strong>{{$data->hfser_id}}</strong></td>
                                  <td class="text-center">{{$data->hfser_id}}R{{$data->rgnid}}-{{$data->appid}}</td>
                                  <td class="text-left">{{$data->facilityname}}</td>
                                  <td class="text-left">{{$data->hgpdesc}}</td> 
                                  <td class="text-center">{{$data->formattedDate}}</td>
                                  <td class="text-center">@if(isset($data->CashierApproveformattedDate)){{$data->CashierApproveformattedDate}} @endif</td>
                                  <td class="text-center">{{$data->paymentstatus}}</td>
                                    <td>
                                      <div class="container">
                                        <div class="row">
                                          <div class="col-6">
                                            <button type="button"  onclick="window.location.href = '{{ asset('/employee/dashboard/processflow/actions') }}/{{$data->appid}}/{{$data->aptid}}?from=main'" class="btn btn-outline-primary" ><i class="fa fa-credit-card"></i></button>
                                          </div>
                                        </div>
                                      </div>
                                    </td>
                                </tr>
                                @php
                                  $status +=1;
                                @endphp
                          @endforeach
                        @else
                          <tr><td colspan="8" class="text-center">No data available in table</td></tr>              
                        @endif 
                      @else
                        <tr><td colspan="8" class="text-center">No data available in table</td></tr>   
                      @endif
                  </tbody>
                  <tfoot>
                    <tr>
                      <td scope="col" class="text-center">Line#</td>
                      <td scope="col" class="text-center">Process</td>
                      <td scope="col" class="text-center">Type</td>
                      <td scope="col" class="text-center">App.Code</td>
                      <td scope="col" class="text-center">Facility Name</tdth>
                      <td scope="col" class="text-center">Type of Facility</td>
                      <td scope="col" class="text-center">Applied Date</td>
                      <td scope="col" class="text-center">Payment Confirmation Date</td>
                      <td scope="col" class="text-center">Current Status</td>
                      <td scope="col" class="text-center">Options</td>
                    </tr>
                  </tfoot>
              </table>
          </div>
      </div>
  </div>
<div class="modal fade" id="bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content" style="border-radius: 0px;border: none;">
        <div class="modal-body" style=" background-color: #272b30;color: white;">
        <span class="MOD010">
          <h5 class="modal-title text-center"><strong>Add Payment</strong></h5>
          <hr>
          <div class="container">
            <form method="POST" action="{{asset('employee/dashboard/cashier')}}" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="container lead">Payment</div><br>
                <div class="container">
                  <div class="row">
                    <div class="col-6 pt-2">User ID:</div>
                    <div class="col-6">
                      <input type="text" readonly value="@if(isset($loggedIn['cur_user'])){{$loggedIn['cur_user']}} @endif" name="userID" class="form-control">
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-6 pt-2">Payment Date:</div>
                    <div class="col-6">
                      <input type="hidden" name="appid">
                      <input type="date" name="pDate" value="@if(isset($loggedIn['date'])){{$loggedIn['date']}} @endif" class="form-control">
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-6 pt-2">Mode of Payment:</div>
                    <div class="col-6">
                      <select required class="form-control" name="mPay">
                        <option value="">Select one</option>
                        @foreach($paymentMethod as $meth)
                          <option value="{{$meth->chg_code}}">{{$meth->chg_desc}}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-6 pt-2">OR Reference:</div>
                    <div class="col-6">
                      <input type="text" required="" name="orRef" class="form-control">
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-6 pt-2">Deposit Slip Number:</div>
                    <div class="col-6">
                      <input type="text" name="slipNum" class="form-control">
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-6 pt-2">Other Reference:</div>
                    <div class="col-6">
                      <input type="text" name="otherRef" class="form-control">
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-6 pt-2">Attached File:</div>
                    <div class="col-6">
                      <input type="file" name="attFile" class="form-control">
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-6 pt-2">Amount Paid:</div>
                    <div class="col-6">
                      <input type="number" required="" name="aPaid" class="form-control">
                    </div>
                  </div>
                  <div class="row mt-5 mb-5">
                    <div class="col-6">
                      <button class="btn btn-primary btn-block" type="submit">Submit</button>
                    </div>
                    <div class="col-6">
                      <button class="btn btn-danger btn-block" type="button" onclick="$('#bd-example-modal-sm').modal('hide')">Cancel</button>
                    </div>
                  </div>
                </div>
            </form>
          </div>
          </span>
        </div>
      </div>
    </div>
</div>
  <script type="text/javascript">
    $(document).ready(function(){
      $.fn.dataTable.ext.search.push(
        function (settings, data, dataIndex) {
            var min = $('#min').datepicker('getDate');
            var max = $('#max').datepicker('getDate');
            var startDate = new Date(data[3]);
            if (min == null && max == null) return true;
            if (min == null && startDate <= max) return true;
            if (max == null && startDate >= min) return true;
            if (startDate <= max && startDate >= min) return true;
            return false;
        }
    );

    $('#min').datepicker({ onSelect: function () { table.draw(); }, changeMonth: true, changeYear: true });
    $('#max').datepicker({ onSelect: function () { table.draw(); }, changeMonth: true, changeYear: true });



      // $('#example').DataTable();
      var table = $('#example').DataTable();
      $("#example thead .select-filter").each( function ( i ) {
      var e = i == 0 ? 1 :  6 ;
        var select = $('<select><option value=""></option></select>')
            .appendTo( $(this).empty() )
            // .appendTo( $(this).empty() )
            .on( 'change', function () {
                table.column( e )
                    .search( $(this).val() )
                    .draw();
            } );
 
        table.column(e).data().unique().sort().each( function ( d, j ) {
            select.append( '<option value="'+d+'">'+d+'</option>' )
        } );





    });

    
    $('#min, #max').change(function () {
        table.draw();
    });

  });

    function insert(id) {
      $('input[name=appid]').empty().val(id);
    }


   
  </script>

<script lang="javascript">
    const reloadUsingLocationHash = () => {
      window.location.hash = "reload";
    }
    window.onload = reloadUsingLocationHash();
  </script>
  @endsection
@else
  <script type="text/javascript">window.location.href= "{{ asset('employee') }}";</script>
@endif
