<script src="//cdn.datatables.net/plug-ins/1.10.24/filtering/row-based/range_dates.js"></script>
<script src="https://cdn.datatables.net/datetime/1.0.3/js/dataTables.dateTime.min.js"></script>
@php 
  
    $typeOfFDA = '';

    if(isset($FDAtype))
    {
      $typeOfFDA = ucfirst($FDAtype);
    }

@endphp
@if (session()->exists('employee_login'))   
  @extends('mainEmployee')
  @section('title', 'View '. $typeOfFDA .' Flow')
  @section('content')
 {{-- <input type="text" id="CurrentPage" hidden="" value="PF001">  --}}

  <div class="content p-4">
  	<div class="card" >
   
  		<div class="card-header bg-white font-weight-bold">
             <h3>{{$typeOfFDA}} Application Status</h3> 
      </div>
      <form class="filter-options-form">
            @include('employee.FDA.FDAtableDataFilter') 
      </form>
      <div class="card-body table-responsive  backoffice-list">
        <div>   
          <table class="table table-hover" style="font-size:13px;" id="1example">
            <thead>
              <tr style="font-weight:bold;">
                  <td style="text-align: center;" rowspan="2">Options</td>
                  <td style="text-align: center;" rowspan="2">Process Types &<br/> Application Code</td>
                  <td style="text-align: center;"  rowspan="2">Name, Type and Region of the Facility <br/>Applied Date and Payment Confirmation Date</td>
                  <td style="text-align: center; border-left: darkgray;border-left-width: thin;border-left-style: solid;" @if($FDAtype == 'all') colspan="2" @endif> Cashier Details of</td>
                  <td style="text-align: center; border-left: darkgray;border-left-width: thin;border-left-style: solid;" @if($FDAtype == 'all') colspan="2" @endif> Pre-Assessment Details of</td>
                  <td style="text-align: center; border-left: darkgray;border-left-width: thin;border-left-style: solid;"  @if($FDAtype == 'all') colspan="2" @endif> Inspection Details of</td>
                  <td style="text-align: center;border-left: darkgray;border-left-width: thin;border-left-style: solid;"  @if($FDAtype == 'all') colspan="2" @endif> Recommendation Details of</td>
                  <td style="text-align: center;border-left: darkgray;border-left-width: thin;border-left-style: solid;"  @if($FDAtype == 'all') colspan="2" @endif> Final Decision Details of</td>
                  <td style="text-align: center;border-left: darkgray;border-left-width: thin;border-left-style: solid;"  @if($FDAtype == 'all') colspan="2" @endif> Application Status of</td>
                  <td style="text-align: center;border-left: darkgray;border-left-width: thin;border-left-style: solid;" rowspan="2">DOH Status</td>  
                  
              </tr>
              <tr style="font-weight:bold;">
                  @if($FDAtype != 'all' && $FDAtype == 'machines')
                      <td style="text-align: center; border-left: darkgray;border-left-width: thin;border-left-style: solid;">Radiation</td>
                  @endif @if($FDAtype != 'all' && $FDAtype == 'pharma')
                      <td  style="text-align: center; border-left: darkgray;border-left-width: thin;border-left-style: solid;">Pharmacy</td>
                  @endif 

                  @if($FDAtype != 'all' && $FDAtype == 'machines')
                      <td style="text-align: center; border-left: darkgray;border-left-width: thin;border-left-style: solid;">Radiation</td>
                  @endif @if($FDAtype != 'all' && $FDAtype == 'pharma')
                      <td  style="text-align: center; border-left: darkgray;border-left-width: thin;border-left-style: solid;">Pharmacy</td>
                  @endif 

                  @if($FDAtype != 'all' && $FDAtype == 'machines')
                      <td style="text-align: center; border-left: darkgray;border-left-width: thin;border-left-style: solid;">Radiation</td>
                  @endif @if($FDAtype != 'all' && $FDAtype == 'pharma')
                      <td  style="text-align: center; border-left: darkgray;border-left-width: thin;border-left-style: solid;">Pharmacy</td>
                  @endif 

                  @if($FDAtype != 'all' && $FDAtype == 'machines')
                      <td style="text-align: center; border-left: darkgray;border-left-width: thin;border-left-style: solid;">Radiation</td>
                  @endif @if($FDAtype != 'all' && $FDAtype == 'pharma')
                      <td  style="text-align: center; border-left: darkgray;border-left-width: thin;border-left-style: solid;">Pharmacy</td>
                  @endif

                  @if($FDAtype != 'all' && $FDAtype == 'machines')
                      <td style="text-align: center; border-left: darkgray;border-left-width: thin;border-left-style: solid;">Radiation</td>
                  @endif @if($FDAtype != 'all' && $FDAtype == 'pharma')
                      <td  style="text-align: center; border-left: darkgray;border-left-width: thin;border-left-style: solid;">Pharmacy</td>
                  @endif 

                  @if($FDAtype != 'all' && $FDAtype == 'machines')
                      <td style="text-align: center; border-left: darkgray;border-left-width: thin;border-left-style: solid;">Radiation</td>
                  @endif @if($FDAtype != 'all' && $FDAtype == 'pharma')
                      <td  style="text-align: center; border-left: darkgray;border-left-width: thin;border-left-style: solid;">Pharmacy</td>
                  @endif 
              </tr>
            </thead>
            <tbody id="FilterdBody">
              @if (isset($LotsOfDatas))
                  @if(count($LotsOfDatas) > 0)
                    @foreach ($LotsOfDatas as $data)
                        <tr>
                          <td>
                            <center>                              
                              <button type="button" title="View detailed information for {{$data->facilityname}}" class="btn btn-info form-control" onclick="showData({{$data->appid}},'{{$data->aptdesc}}', '{{$data->authorizedsignature}}','{{$data->brgyname}}', '{{$data->classname}}' ,'{{$data->cmname}}', '{{$data->email}}', '{{$data->facilityname}}','{{$data->hgpdesc}}', '{{$data->formattedDate}}', '{{$data->formattedTime}}', '{{$data->hfser_desc}}','{{$data->ocdesc}} - {{$data->classname}} - {{$data->subclassname}}', '{{$data->provname}}','{{$data->rgn_desc}}', '{{$data->street_name}}', '{{$data->zipcode}}', '{{$data->isrecommended}}', '{{$data->hfser_id}}', '{{$data->status}}', '{{$data->uid}}', '{{$data->trns_desc}}');" data-toggle="modal" data-target="#GodModal"><i class="fa fa-fw fa-eye"></i></button>
                            </center>
                          </td>
                          <td style="text-align:center">
                              {{$data->aptdesc}} {{$data->hfser_id}} <br/><strong>{{$data->hfser_id}}R{{$data->rgnid}}-{{$data->appid}}</strong>

                              @if(isset($data->nhfcode))<br/><br/><strong>NHFR Code: {{$data->nhfcode}} </strong>@endif 
                            </td>
                          <td style="text-align:left; font-family: 'Open Sans';">
                              <strong>{{$data->facilityname}}</strong>
                              <br/><br/>Type: {{( $data->hgpdesc ?? 'NOT FOUND')}}   
                              <br/>Ownership: {{( $data->ocdesc ?? 'NOT FOUND')}}      
                              <br/>Region: {{( $data->rgn_desc ?? 'NO REGION')}}   

                              @if(isset($data->t_date))<br/><br/><I>Applied on</I> {{date("F j, Y", strtotime($data->t_date)) }} @else <br/><br/><span style="color:red;">{{ 'Not Officially Applied Yet.' }}</span> @endif                    
                          </td>

                          {{-- Cashier --}}
                          @if($FDAtype != 'all' && $FDAtype == 'machines')
                              <td style="text-align:center; border-left: darkgray;border-left-width: thin;border-left-style: solid;"> 
                                @if(isset($data->formattedCashierApproveDateFDA)) {{$data->formattedCashierApproveDateFDA}} @endif 
                                @if(isset($data->formattedCashierApproveTimeFDA)) {{$data->formattedCashierApproveTimeFDA}}  @endif 
                                
                                @if(isset($data->CashierApproveByFDA)) <br/><br/> By: {{$data->CashierApproveByFDA}} @endif 
                                @if(isset($data->CashierApproveIpFDA)) <br/> IP Addr: {{$data->CashierApproveIpFDA}} @endif
                              </td>
                          @endif @if($FDAtype != 'all' && $FDAtype == 'pharma')
                              <td style="text-align:center; border-left: darkgray;border-left-width: thin;border-left-style: solid;"> 
                                @if(isset($data->formattedCashierApproveDatePharma)) {{$data->formattedCashierApproveDatePharma}} @endif 
                                @if(isset($data->formattedCashierApproveTimePharma)) {{$data->formattedCashierApproveTimePharma}} @endif 
                                
                                @if(isset($data->CashierApproveByPharma)) <br/><br/> By: {{$data->CashierApproveByPharma}} @endif 
                                @if(isset($data->CashierApproveIpPharma)) <br/> IP Addr: {{$data->CashierApproveIpPharma}} @endif
                              </td>
                          @endif 
                          
                          {{-- Pre-Assessment --}}
                          @if($FDAtype != 'all' && $FDAtype == 'machines')
                              <td style="text-align:center; border-left: darkgray;border-left-width: thin;border-left-style: solid;"> 
                                @if(isset($data->formattedIsPreassessedDate)) {{$data->formattedIsPreassessedDate}} @endif 
                                @if(isset($data->formattedIsPreassessedTime)) {{$data->formattedIsPreassessedTime}}  @endif 
                                
                                @if(isset($data->ispreassessedby)) <br/><br/> By: {{$data->ispreassessedby}} @endif 
                                @if(isset($data->ispreassessedip)) <br/> IP Addr: {{$data->ispreassessedip}} @endif
                              </td>
                          @endif @if($FDAtype != 'all' && $FDAtype == 'pharma')
                              <td style="text-align:center; border-left: darkgray;border-left-width: thin;border-left-style: solid;"> 
                                @if(isset($data->formattedIsPreassessedDatePharma)) {{$data->formattedIsPreassessedDatePharma}} @endif 
                                @if(isset($data->formattedIsPreassessedTimePharma)) {{$data->formattedIsPreassessedTimePharma}} @endif 
                                
                                @if(isset($data->ispreassessedbypharma)) <br/><br/> By: {{$data->ispreassessedbypharma}} @endif 
                                @if(isset($data->ispreassessedippharma)) <br/> IP Addr: {{$data->ispreassessedippharma}} @endif
                              </td>
                          @endif 
                          
                          {{-- Inspection  --}}
                          @if($FDAtype != 'all' && $FDAtype == 'machines')
                              <td style="text-align:center; border-left: darkgray;border-left-width: thin;border-left-style: solid;"> 
                                @if(isset($data->formattedRecommendedDateFDA)) {{$data->formattedRecommendedDateFDA}} @endif 
                                @if(isset($data->formattedRecommendedTimeFDA)) {{$data->formattedRecommendedTimeFDA}}  @endif 
                                
                                @if(isset($data->recommendedbyFDA)) <br/><br/> By: {{$data->recommendedbyFDA}} @endif 
                                @if(isset($data->recommendedippaddrFDA)) <br/> IP Addr: {{$data->recommendedippaddrFDA}} @endif
                              </td>
                          @endif @if($FDAtype != 'all' && $FDAtype == 'pharma')
                              <td style="text-align:center; border-left: darkgray;border-left-width: thin;border-left-style: solid;"> 
                                @if(isset($data->formattedRecommendedDateFDAPharma)) {{$data->formattedRecommendedDateFDAPharma}} @endif 
                                @if(isset($data->formattedRecommendedTimeFDAPharma)) {{$data->formattedRecommendedTimeFDAPharma}} @endif 
                                
                                @if(isset($data->recommendedbyFDAPharma)) <br/><br/> By: {{$data->recommendedbyFDAPharma}} @endif 
                                @if(isset($data->recommendedippaddrFDAPharma)) <br/> IP Addr: {{$data->recommendedippaddrFDAPharma}} @endif
                              </td>
                          @endif 

                          {{-- Recommendation  --}}
                          @if($FDAtype != 'all' && $FDAtype == 'machines')
                              <td style="text-align:center; border-left: darkgray;border-left-width: thin;border-left-style: solid;"> 
                                @if(isset($data->formattedRecoDateFDA)) {{$data->formattedRecoDateFDA}} @endif 
                                @if(isset($data->formattedRecoTimeFDA)) {{$data->formattedRecoTimeFDA}}  @endif 
                                
                                @if(isset($data->RecobyFDA)) <br/><br/> By: {{$data->RecobyFDA}} @endif 
                                @if(isset($data->RecoippaddrFDA)) <br/> IP Addr: {{$data->RecoippaddrFDA}} @endif
                              </td>
                          @endif @if($FDAtype != 'all' && $FDAtype == 'pharma')
                              <td style="text-align:center; border-left: darkgray;border-left-width: thin;border-left-style: solid;"> 
                                @if(isset($data->formattedRecoDateFDAPhar)) {{$data->formattedRecoDateFDAPhar}} @endif 
                                @if(isset($data->formattedRecoTimeFDAPhar)) {{$data->formattedRecoTimeFDAPhar}} @endif 
                                
                                @if(isset($data->RecobyFDAPhar)) <br/><br/> By: {{$data->RecobyFDAPhar}} @endif 
                                @if(isset($data->RecoippaddrFDAPhar)) <br/> IP Addr: {{$data->RecoippaddrFDAPhar}} @endif
                              </td>
                          @endif 

                          {{-- Final Decision --}}
                          @if($FDAtype != 'all' && $FDAtype == 'machines')
                              <td style="text-align:center; border-left: darkgray;border-left-width: thin;border-left-style: solid;"> 
                                @if(isset($data->formattedApprovedDateFDA)) {{$data->formattedApprovedDateFDA}} @endif 
                                @if(isset($data->formattedApprovedTimeFDA)) {{$data->formattedApprovedTimeFDA}}  @endif 
                                
                                @if(isset($data->approvedByFDA)) <br/><br/> By: {{$data->approvedByFDA}} @endif 
                                @if(isset($data->approvedIpAddFDA)) <br/> IP Addr: {{$data->approvedIpAddFDA}} @endif
                              </td>
                          @endif @if($FDAtype != 'all' && $FDAtype == 'pharma')
                              <td style="text-align:center; border-left: darkgray;border-left-width: thin;border-left-style: solid;"> 
                                @if(isset($data->formattedApprovedDateFDAPharma)) {{$data->formattedApprovedDateFDAPharma}} @endif 
                                @if(isset($data->formattedApprovedTimeFDAPharma)) {{$data->formattedApprovedTimeFDAPharma}} @endif 
                                
                                @if(isset($data->approvedByFDAPharma)) <br/><br/> By: {{$data->approvedByFDAPharma}} @endif 
                                @if(isset($data->approvedIpAddFDAPharma)) <br/> IP Addr: {{$data->approvedIpAddFDAPharma}} @endif
                              </td>
                          @endif 


                          @if($FDAtype != 'all' && $FDAtype == 'machines')
                            <td style="color:black;text-align:left;border-left: darkgray;border-left-width: thin;border-left-style: solid;">
                              {{$data->FDAStatMach}}
                            </td>
                          @endif @if($FDAtype != 'all' && $FDAtype == 'pharma')
                            <td style="text-align:center; border-left: darkgray;border-left-width: thin;border-left-style: solid;">
                              {{$data->FDAStatPhar}}
                            </td>
                          @endif 

                          <td style="color:black;text-align:left;border-left: darkgray;border-left-width: thin;border-left-style: solid;">
                              @if(isset($data->trns_desc))
                                  <span style="font-weight:bolder;">{{$data->trns_desc}} </span><br/>                             
                              @endif 
                              @if(isset($data->submittedReq)) 

                              @else 
                                <span style="color: red; font-weight:bolder;">No attachment for basic requirements submitted yet.</span><br/>
                              @endif   

                              @if(isset($data->formattedUpdatedDate)) 
                                <span style="color: black;font-weight:normal; font-size: small;">
                                  <i>Last updated on {{ $data->formattedUpdatedDate }} @if(isset($data->formattedUpatedTime)) {{ $data->formattedUpatedTime }}  @endif.</i>
                                </span> <br/>
                              @endif
                              
                              @if(isset($data->asrgn_desc)) 
                                Assigned to <span style="color:blue">{{$data->asrgn_desc}}</span><br/>
                              @endif

                              @if(isset($data->formattedInspectedDate)) Inspected On {{$data->formattedInspectedDate}} <br/>@endif 
                              @if(isset($data->formattedApprovedDate)) Approved/Disapproved On {{$data->formattedApprovedDate }} <br/> @endif 
                          </td>
                        </tr>

                    @endforeach
                  @else
                      <tr><td colspan="16" class="text-center">No data available in table</td></tr>              
                  @endif 
                @else
                  <tr><td colspan="16" class="text-center">No data available in table</td></tr>              
              @endif 
            </tbody>

            <tfoot>
            <tr style="font-weight:bold;">
                  <td style="text-align: center;" rowspan="2">Options</td>
                  <td style="text-align: center;" rowspan="2">Process Types &<br/> Application Code</td>
                  <td style="text-align: center;"  rowspan="2">Name, Type and Region of the Facility <br/>Applied Date and Payment Confirmation Date</td>
                  <td style="text-align: center; border-left: darkgray;border-left-width: thin;border-left-style: solid;" @if($FDAtype == 'all') colspan="2" @endif> Cashier Details of</td>
                  <td style="text-align: center; border-left: darkgray;border-left-width: thin;border-left-style: solid;" @if($FDAtype == 'all') colspan="2" @endif> Pre-Assessment Details of</td>
                  <td style="text-align: center; border-left: darkgray;border-left-width: thin;border-left-style: solid;"  @if($FDAtype == 'all') colspan="2" @endif> Inspection Details of</td>
                  <td style="text-align: center;border-left: darkgray;border-left-width: thin;border-left-style: solid;"  @if($FDAtype == 'all') colspan="2" @endif> Recommendation Details of</td>
                  <td style="text-align: center;border-left: darkgray;border-left-width: thin;border-left-style: solid;"  @if($FDAtype == 'all') colspan="2" @endif> Final Decision Details of</td>
                  <td style="text-align: center;border-left: darkgray;border-left-width: thin;border-left-style: solid;"  @if($FDAtype == 'all') colspan="2" @endif> Application Status of</td>
                  <td style="text-align: center;border-left: darkgray;border-left-width: thin;border-left-style: solid;" rowspan="2">DOH Status</td>  
                  
              </tr>
              <tr style="font-weight:bold;">
                  @if($FDAtype != 'all' && $FDAtype == 'machines')
                      <td style="text-align: center; border-left: darkgray;border-left-width: thin;border-left-style: solid;">Radiation</td>
                  @endif @if($FDAtype != 'all' && $FDAtype == 'pharma')
                      <td style="text-align: center;">Pharmacy</td>
                  @endif 

                  @if($FDAtype != 'all' && $FDAtype == 'machines')
                      <td style="text-align: center; border-left: darkgray;border-left-width: thin;border-left-style: solid;">Radiation</td>
                  @endif @if($FDAtype != 'all' && $FDAtype == 'pharma')
                      <td style="text-align: center;">Pharmacy</td>
                  @endif 

                  @if($FDAtype != 'all' && $FDAtype == 'machines')
                      <td style="text-align: center; border-left: darkgray;border-left-width: thin;border-left-style: solid;">Radiation</td>
                  @endif @if($FDAtype != 'all' && $FDAtype == 'pharma')
                      <td style="text-align: center;">Pharmacy</td>
                  @endif 

                  @if($FDAtype != 'all' && $FDAtype == 'machines')
                      <td style="text-align: center; border-left: darkgray;border-left-width: thin;border-left-style: solid;">Radiation</td>
                  @endif @if($FDAtype != 'all' && $FDAtype == 'pharma')
                      <td style="text-align: center;">Pharmacy</td>
                  @endif

                  @if($FDAtype != 'all' && $FDAtype == 'machines')
                      <td style="text-align: center; border-left: darkgray;border-left-width: thin;border-left-style: solid;">Radiation</td>
                  @endif @if($FDAtype != 'all' && $FDAtype == 'pharma')
                      <td style="text-align: center;">Pharmacy</td>
                  @endif 

                  @if($FDAtype != 'all' && $FDAtype == 'machines')
                      <td style="text-align: center; border-left: darkgray;border-left-width: thin;border-left-style: solid;">Radiation</td>
                  @endif @if($FDAtype != 'all' && $FDAtype == 'pharma')
                      <td style="text-align: center;">Pharmacy</td>
                  @endif 
              </tr>
            </tfoot>
          </table>

        </div>
      </div>
  	</div>
  </div>
  <div class="modal fade" id="GodModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog  modal-lg " role="document">
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
                    {{-- <div class="col-sm-6">
                      <button type="button" class="btn btn-info form-control" id="PreAssessButton" style="border-radius:0;"><span class="fa fa-sign-up"></span>View Preassessment</button>
                    </div> --}}
                    <div class="col-sm-3"></div>
                    <div class="col-sm-6">
                      <button type="button" data-dismiss="modal" class="btn btn-info form-control" style="border-radius:0;"><span class="fa fa-sign-up"></span>Close</button>
                    </div>
                    <div class="col-sm-3"></div>
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
    
  	function showData(appid, aptdesc, authorizedsignature, brgyname, classname, cmname, email, facilityname, facname, formattedDate, formattedTime, hfser_desc, ocdesc, provname, rgn_desc, street_name, zipcode, isrecommended, hfser_id, statusX, uid, trns_status){
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
                  '<div class="col-sm-8">' + street_name + ', ' + brgyname + ', ' + cmname + ', ' + provname + ' - ' + zipcode +
                  '</div>' +
              '</div>' +
              '<div class="row">'+
                  '<div class="col-sm-4">Owner:' +
                  '</div>' +
                  '<div class="col-sm-8">' + authorizedsignature + 
                  '</div>' +
              '</div>' +
              '<div class="row">'+
                  '<div class="col-sm-4">Classification:' +
                  '</div>' +
                  '<div class="col-sm-8">' + ocdesc + 
                  '</div>' +
              '</div>' +
              '<div class="row">'+
                  '<div class="col-sm-4">Applying for:' +
                  '</div>' +
                  '<div class="col-sm-8">' + hfser_id + ' ('+hfser_desc+') - ' + aptdesc +
                  '</div>' +
              '</div>' +
              '<div class="row">'+
                  '<div class="col-sm-4">Date:' +
                  '</div>' +
                  '<div class="col-sm-8"> ' + formattedDate + ' ' + formattedTime + 
                  '</div>' +
              '</div>' +
              '<div class="row">'+
                  '<div class="col-sm-4"> Client User ID:' +
                  '</div>' +
                  '<div class="col-sm-8">' + uid +
                  '</div>' +
              '</div>' +
              '<div class="row">'+
                  '<div class="col-sm-4">DOH Status:' +
                  '</div>' +
                  '<div class="col-sm-8">' +trns_status +
                  '</div>' +
              '</div>'
            );
      }
      function showEvalInfo(EvalTime, EvalDate, PropTime, PropDate, RecommendedBy/*, RgnRecommended*/, code, idCode){
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
                // '<div class="row">'+
                //     '<div class="col-sm-5">Region Evaluated:</div>' +
                //     '<div class="cols-sm-7" style="font-weight:bold">' + RgnRecommended +
                //     '</div>' + 
                // '</div>' +
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

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css" />
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/datetime/1.0.3/css/dataTables.dateTime.min.css" />


<!-- https://cdn.datatables.net/datetime/1.0.3/js/dataTables.dateTime.min.js -->