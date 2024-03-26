@if (session()->exists('employee_login'))   
  @extends('mainEmployee')
  @section('title', 'Application List for List of Personnel')
  @section('content')
  <input type="text" id="CurrentPage" hidden="" value="RHR001">
  <div class="content p-4">
  	<div class="card">
  		<div class="card-header bg-white font-weight-bold">
          Application List for List of Personnel
          </div>
          <div class="card-body table-responsive">
          	<table class="table table-hover" style="font-size:13px;" id="example">
                  <thead>
                  <tr>
                      <th scope="col" style="text-align: center; width:auto">Type</th>
                      <th scope="col" style="text-align: center; width:auto">Code</th>
                      <th scope="col" style="text-align: center; width:auto">Name of the Facility</th>
                      <th scope="col" style="text-align: center; width:auto">Type of Facility</th>
                      <th scope="col" style="text-align: center; width:auto">Type</th>
                      <th scope="col" style="text-align: center; width:auto">Date Applied</th>
                      <th scope="col" style="text-align: center; width:auto">Status</th>
                      {{-- <th scope="col" style="">Current Status</th> --}}
                      <th scope="col" style="text-align: center; width:auto">Options</th>
                  </tr>
                  </thead>
                  <tbody id="FilterdBody">
                   @if (isset($LotsOfDatas))
                    @foreach ($LotsOfDatas as $data)
                    @if($data->hfser_id == 'LTO' || $data->hfser_id == 'ATO')
                    @php
                      // $status = '';
                            // $paid = $data->appid_payment;
                            // $reco = $data->isrecommended;
                            // $color = '';
                            // if ($data->isrecommended == null) {
                            //     $status = 'For Evaluation';$color = 'black';
                            // }else if ($data->isrecommended == 1) {
                            //   $status = 'Application Approved';$color = 'green';
                            //     }
                            // if ($paid == null) {$status = 'For Evaluation (Not Paid)';$color = 'red';
                            //     }
                    @endphp
                     <tr>
                       <td style="text-align:center">{{$data->hfser_id}}</td>
                       <td style="text-align:center">{{$data->hfser_id}}R{{$data->rgnid}}-{{$data->appid}}</td>
                       <td style="text-align:center"><strong>{{$data->facilityname}}</strong></td>
                       <td style="text-align:center">{{$data->hgpdesc}}</td>
                       <td style="text-align:center">{{$data->aptdesc}}</td>
                        <td style="text-align:center">{{$data->formattedDate}}</td>
                       {{-- <td><center><h5>@if($data->appid_payment !== null) <span class="badge badge-success">Yes</span> @else <span class="badge badge-pill badge-warning">No</span> @endif</h5></center></td> --}}
                        {{-- <td>{{$data->formattedDateEval}}</td> --}}
                        {{-- <td>{{$data->recommendedbyName}}</td> --}}
                        {{-- <td>{{$data->RgnEvaluated}}</td> --}}
                        {{-- <td></td>
                        <td></td> --}}
                        
                        <td style="color:black;font-weight:bolder;text-decoration: underline;">{{$data->trns_desc}}</td>
                        <td><center>
                          <button type="button" title="View detailed information for {{$data->facilityname}}" class="btn btn-outline-info" onclick="window.location.href='{{asset('client1/apply/hfsrb/view/annexa/'.$data->appid)}}'"><i class="fa fa-fw fa-eye"></i></button>
                        </center></td>
                     </tr>
                     @endif
                    @endforeach
                  @endif 
                  </tbody>
              </table>
          </div>
  	</div>
  </div>
  <div class="modal fade" id="GodModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog {{-- modal-lg --}}" role="document">
        <div class="modal-content" style="border-radius: 0px;border: none;">
          <div class="modal-body" style=" background-color: #272b30;color: white;">
            <h5 class="modal-title text-center"><strong>View Application</strong></h5>
            <hr>
            <div class="container">
                  <form id="ViewNow" data-parsley-validate>
                  <span id="ViewBody">
                  </span>
                  <hr>
                  <div class="row">
                    <div class="col-sm-6">
                      &nbsp;
                    {{-- <button type="button" class="btn btn-outline-info form-control" id="PreAssessButton" style="border-radius:0;"><span class="fa fa-sign-up"></span>View Preassessment</button> --}}
                  </div> 
                  <div class="col-sm-6">
                    <button type="button" data-dismiss="modal" class="btn btn-outline-danger form-control" style="border-radius:0;"><span class="fa fa-sign-up"></span>Cancel</button>
                  </div>
                  </div>
                </form>
            </div>
          </div>
        </div>
      </div>
  </div>
  <div class="modal fade" id="ShowEvalInfo" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog {{-- modal-lg --}}" role="document">
        <div class="modal-content" style="border-radius: 0px;border: none;">
          <div class="modal-body text-justify" style=" background-color: #272b30;color: white;">
            <h5 class="modal-title text-center"><strong><span id="EvalTitle"></span> Evaluation</strong></h5>
            <hr>
            <div class="container">
                  <form id="" data-parsley-validate>
                  <span id="EvalBody">
                  </span>
                  <hr>
                  <div class="row">
                    <div class="col-sm-6">
                    <button type="button" class="btn btn-outline-info form-control" style="border-radius:0;" id="ViewEvalButton"><span class="fa fa-sign-up"></span>View Evaluation</button>
                  </div> 
                  <div class="col-sm-6">
                    <button type="button" data-dismiss="modal" class="btn btn-outline-danger form-control" style="border-radius:0;"><span class="fa fa-sign-up"></span>Cancel</button>
                  </div>
                  </div>
                </form>
            </div>
          </div>
        </div>
      </div>
  </div>
  <script type="text/javascript">
  	$(document).ready(function() {$('#example').DataTable();});
  	function showData(appid, aptdesc, authorizedsignature, brgyname, classname, cmname, email, facilityname, facname, formattedDate, formattedTime, hfser_desc, ocdesc, provname, rgn_desc, streetname, zipcode, isrecommended, hfser_id, statusX, uid, trns_status){
          var status = '';
          // var paid = appid_payment;
          // if (statusX == 'P') {
          //     status = '<span style="color:red">Pending</span>';
          // } 
          $('#PreAssessButton').attr('onclick', '');
          $('#PreAssessButton').attr('onclick', "location.href='{{ asset('/employee/dashboard/lps/preassessment') }}/"+uid+"'");
          $('#ViewBody').empty();
          $('#ViewBody').append(
              '<div class="row">'+
                  '<div class="col-sm-4">Facility Name:' +
                  '</div>' +
                  '<div class="col-sm-8">' + facilityname +
                  '</div>' +
              '</div>' +
              // '<br>' + 
              '<div class="row">'+
                  '<div class="col-sm-4">Address:' +
                  '</div>' +
                  '<div class="col-sm-8">' + streetname + ', ' + brgyname + ', ' + cmname + ', ' + provname + ' - ' + zipcode +
                  '</div>' +
              '</div>' +
              '<div class="row">'+
                  '<div class="col-sm-4">Owner:' +
                  '</div>' +
                  '<div class="col-sm-8">' + authorizedsignature + 
                  '</div>' +
              '</div>' +
              '<div class="row">'+
                  '<div class="col-sm-4">Applying for:' +
                  '</div>' +
                  '<div class="col-sm-8">' + hfser_id + ' ('+hfser_desc+') - ' + aptdesc +
                  '</div>' +
              '</div>' +
              '<div class="row">'+
                  '<div class="col-sm-4">Time and Date:' +
                  '</div>' +
                  '<div class="col-sm-8">' + formattedTime + ' - ' + formattedDate +
                  '</div>' +
              '</div>' +
              '<div class="row">'+
                  '<div class="col-sm-4">Status:' +
                  '</div>' +
                  '<div class="col-sm-8">' +trns_status +
                  '</div>' +
              '</div>'
            );
      }
      function showEvalInfo(EvalTime, EvalDate, PropTime, PropDate, RecommendedBy, RgnRecommended, code, idCode){
          $('#ViewEvalButton').attr('onclick','');
          $('#ViewEvalButton').attr('onclick',"location.href='{{ asset('/employee/dashboard/processflow/evaluate') }}/"+idCode+"'");
          $('#EvalTitle').empty();
          $('#EvalTitle').text(code);
          $('#EvalBody').empty();
          $('#EvalBody').append(
                '<div class="row">'+
                    '<div class="col-sm-5">Evaluated On:</div>' +
                    '<div class="cols-sm-7" style="font-weight:bold">' + EvalDate + ' ' + EvalTime +
                    '</div>' + 
                '</div>'  +
                '<div class="row">'+
                    '<div class="col-sm-5">Recommended By:</div>' +
                    '<div class="cols-sm-7" style="font-weight:bold">' + RecommendedBy +
                    '</div>' + 
                '</div>' +
                '<div class="row">'+
                    '<div class="col-sm-5">Region Evaluated:</div>' +
                    '<div class="cols-sm-7" style="font-weight:bold">' + RgnRecommended +
                    '</div>' + 
                '</div>' +
                '<div class="row">'+
                    '<div class="col-sm-5">Proposed Inspection:</div>' +
                    '<div class="cols-sm-7" style="font-weight:bold">' + PropDate + ' ' + PropTime +
                    '</div>' + 
                '</div>'
            );
      }
  </script>
  @endsection
@else
  <script type="text/javascript">window.location.href= "{{ asset('employee') }}";</script>
@endif