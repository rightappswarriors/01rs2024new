@if (session()->exists('employee_login'))  
  @extends('mainEmployee')
  @section('title', 'Cashier')
  @section('content')
  {{-- {{dd($BigData)}} --}}
  <input type="text" id="CurrentPage" hidden="" value="FD011"> 
  <div class="content p-4">
      <div class="card">
          <div class="card-header bg-white font-weight-bold">
            <h3> Cashiering (Pharmacy)</h3>
          </div>
          <div class="card-body table-responsive">
        
          <form class="filter-options-form">
            @include('employee.FDA.FDAtableDataFilterPharma') 
          </form>
              <table class="table table-hover"  style="font-size:13px;">
                  <thead>
                  <tr>
                      <!-- <td scope="col" class="text-center"></td> -->
                      <td scope="col" class="text-center">ID</td>
                      <td scope="col" class="text-center">Type</td>
                      <td scope="col" class="text-center">Application Code</td>
                      <td scope="col" class="text-center">Name of Facility</td>
                      <td scope="col" class="text-center">Type of Facility</td>
                      <td scope="col" class="text-center">Date</td>
                      <td scope="col" class="text-center">&nbsp;</td>
                      <td scope="col" class="text-center">Current Status</td>
                      <td scope="col" class="text-center">Options</td>
                  </tr>
                  </thead>
                  <tbody id="FilterdBody">  
                      @if (isset($BigData))
                        @php
                          $status = 1;
                        @endphp
                        @foreach ($BigData as $data)
                              @php
                                $paid = $data->appid_payment;
                                $ifdisabled = '';$color = '';

                              @endphp
                              <tr>
                                <td class="text-center">{{$status}}</td>
                                <td class="text-center">{{$data->hfser_id}}</td>
                                <td class="text-center">{{$data->hfser_id}}R{{$data->rgnid}}-{{$data->appid}}</td>
                                <td class="text-center"><strong>{{$data->facilityname}}</strong></td>
                                <td class="text-center">{{(ajaxController::getFacilitytypeFromHighestApplicationFromX08FT($data->appid)->hgpdesc ?? 'NOT FOUND')}}</td>
                                <td class="text-center">{{$data->formattedDate}}</td>
                                <td class="text-center">{{$data->aptdesc}}</td>
                                <td class="text-center" style="font-weight:bold;">{{$data->proofpaystatPhar == 'posting' ? 'For Posting' :($data->proofpaystatPhar == 'posted' ? 'Posted' : 'For Payment')}}</td>
                                  <td>
                                    <div class="container">
                                      <div class="row">
                                        <div class="col-6">
                                          <button type="button"  onclick="window.location.href = '{{ asset('employee/dashboard/processflow/FDA/pharma/actions') }}/{{$data->appid}}/{{$data->aptid}}'" {{$ifdisabled}} class="btn btn-outline-primary" ><i class="fa fa-credit-card"></i></button>
                                        </div>
                                       </div>
                                    </div>
                                  </td>
                              </tr>
                              @php
                                $status +=1;
                              @endphp
                        @endforeach
                      @endif
                  </tbody>
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
                      <input type="text" readonly value="{{$loggedIn['cur_user']}}" name="userID" class="form-control">
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-6 pt-2">Payment Date:</div>
                    <div class="col-6">
                      <input type="hidden" name="appid">
                      <input type="date" name="pDate" value="{{$loggedIn['date']}}" class="form-control">
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
            var startDate = new Date(data[5]);
            if (min == null && max == null) return true;
            if (min == null && startDate <= max) return true;
            if (max == null && startDate >= min) return true;
            if (startDate <= max && startDate >= min) return true;
            return false;
        }
    );

    $('#min').datepicker({ onSelect: function () { table.draw(); }, changeMonth: true, changeYear: true });
    $('#max').datepicker({ onSelect: function () { table.draw(); }, changeMonth: true, changeYear: true });


      var table = $('#example').DataTable();

      $("#example thead .select-filter").each( function ( i ) {
      var e = i == 0 ? 4 :  7;
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
  @endsection
@else
  <script type="text/javascript">window.location.href= "{{ asset('employee') }}";</script>
@endif
