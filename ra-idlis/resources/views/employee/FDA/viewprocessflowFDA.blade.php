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

      
      <input type="" id="token" value="{{ Session::token() }}" hidden>
      <div class="card-body table-responsive  backoffice-list">
        <div>   
          <table class="table table-hover" style="font-size:13px;" id="1example">
            <thead>
              <tr style="font-weight:bold;">
                  <td style="text-align: center;" rowspan="2">Options</td>
                  <td style="text-align: center;" rowspan="2">Process Types &<br/> Application Code</td>
                  <td style="text-align: center;"  rowspan="2">Name, Type and Region of the Facility <br/>Applied Date and Payment Confirmation Date</td>
                  <td style="text-align: center; border-left: darkgray;border-left-width: thin;border-left-style: solid;"  colspan="2">DOH Inspection</td>
                                  
                  @if($FDAtype == 'machines')
                    <td style="text-align: center;border-left: darkgray;border-left-width: thin;border-left-style: solid;"  rowspan="2"> Radiation Application Status</td>
                    <td style="text-align: center; border-left: darkgray;border-left-width: thin;border-left-style: solid;" rowspan="2">COC Attachment and Validity</td>
                    <td style="text-align: center; border-left: darkgray;border-left-width: thin;border-left-style: solid;" rowspan="2">FDA Remarks</td>
                  @else
                    <td style="text-align: center; border-left: darkgray;border-left-width: thin;border-left-style: solid;" @if($FDAtype == 'all') colspan="2" @endif> Cashier Details of</td>
                    <td style="text-align: center; border-left: darkgray;border-left-width: thin;border-left-style: solid;" @if($FDAtype == 'all') colspan="2" @endif> Pre-Assessment Details of</td>
                    <td style="text-align: center; border-left: darkgray;border-left-width: thin;border-left-style: solid;"  @if($FDAtype == 'all') colspan="2" @endif> Inspection Details of</td>
                    <td style="text-align: center;border-left: darkgray;border-left-width: thin;border-left-style: solid;"  @if($FDAtype == 'all') colspan="2" @endif> Recommendation Details of</td>
                    <td style="text-align: center;border-left: darkgray;border-left-width: thin;border-left-style: solid;"  @if($FDAtype == 'all') colspan="2" @endif> Final Decision Details of</td>
                    <td style="text-align: center;border-left: darkgray;border-left-width: thin;border-left-style: solid;"  rowspan="2"> Pharmacy Application Status</td>
                  @endif 
                  
                  <td style="text-align: center;border-left: darkgray;border-left-width: thin;border-left-style: solid;" rowspan="2">DOH Status</td>  
                  
              </tr>
              <tr style="font-weight:bold;">
                      <td style="text-align: center; border-left: darkgray;border-left-width: thin;border-left-style: solid;">Target Last Date</td>                      
                      <td style="text-align: center;">Actual Date</td>                    
                  @if($FDAtype != 'all' && $FDAtype == 'pharma')
                      <td  style="text-align: center; border-left: darkgray;border-left-width: thin;border-left-style: solid;">Pharmacy</td>                  
                      <td  style="text-align: center; border-left: darkgray;border-left-width: thin;border-left-style: solid;">Pharmacy</td>                 
                      <td  style="text-align: center; border-left: darkgray;border-left-width: thin;border-left-style: solid;">Pharmacy</td>                  
                      <td  style="text-align: center; border-left: darkgray;border-left-width: thin;border-left-style: solid;">Pharmacy</td>                  
                      <td  style="text-align: center; border-left: darkgray;border-left-width: thin;border-left-style: solid;">Pharmacy</td>
                  @endif 
              </tr>
            </thead>
            <tbody id="FilterdBody">
              @if (isset($LotsOfDatas))
                  @if(count($LotsOfDatas) > 0)
                    @foreach ($LotsOfDatas as $data)
                        <tr>
                          <td class="text-center" style="width:50px;">          
                              <button type="button" title="View detailed information for {{$data->facilityname}}" class="btn btn-info form-control" onclick="showData({{$data->appid}},'{{$data->aptdesc}}', '{{$data->authorizedsignature}}','{{$data->brgyname}}', '{{$data->classname}}' ,'{{$data->cmname}}', '{{$data->email}}', '{{$data->facilityname}}','{{$data->hgpdesc}}', '{{$data->formattedDate}}', '{{$data->formattedTime}}', '{{$data->hfser_desc}}','{{$data->ocdesc}} - {{$data->classname}} - {{$data->subclassname}}', '{{$data->provname}}','{{$data->rgn_desc}}', '{{$data->street_name}}', '{{$data->zipcode}}', '{{$data->isrecommended}}', '{{$data->hfser_id}}', '{{$data->status}}', '{{$data->uid}}', '{{$data->trns_desc}}');" data-toggle="modal" data-target="#GodModal"><i class="fa fa-fw fa-eye"></i></button>
                            
                            @if($FDAtype == 'machines')
                                     
                                <button type="button" title="Update Status for {{$data->facilityname}}" class="btn btn-info form-control" onclick="showDataStatus({{$data->appid}},'{{$data->facilityname}}', '{{$data->status}}');" data-toggle="modal" data-target="#ModalStatus" style="padding: 5px;margin:1px;font-size: xx-small;">Update Status</button>

                                <button type="button" title="Edit Remarks for {{$data->facilityname}}" class="btn btn-info form-control" onclick="showDataRemarks({{$data->appid}},'{{$data->facilityname}}', '{{$data->RecoRemarkFDA}}');" data-toggle="modal" data-target="#ModalRemarks" style="padding: 5px;margin:1px;font-size: xx-small;">Edit Remarks</button>
                                
                                <button type="button" title="Upload COC for {{$data->facilityname}}" class="btn btn-info form-control" onclick="showDataCOC({{$data->appid}},'{{$data->facilityname}}', '{{$data->xrayVal}}', '{{$data->xrayCOC}}', '{{$data->xrayUp}}');" data-toggle="modal" data-target="#ModalCOC" style="padding: 5px;margin:1px;font-size: xx-small;">Upload COC</button>
                              
                            @endif
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
                          <td style="text-align:center; border-left: darkgray;border-left-width: thin;border-left-style: solid;">                           
                          {{-- DOH Inspection Target Date--}}     
                              @if(isset($data->formattedDatePropEval)){{$data->formattedDatePropEval}} @endif 
                          </td>
                          <td style="text-align:center;">                         
                          {{-- DOH Inspection Actual Date--}}     
                              @if(isset($data->formattedInspectedDate)){{$data->formattedInspectedDate}} @endif 
                          </td>
                          @if($FDAtype != 'all' && $FDAtype == 'machines')
                            <td style="text-align:center;color:black;border-left: darkgray;border-left-width: thin;border-left-style: solid;">
                              {{$data->FDAStatMach}}
                            </td>

                            {{-- COC Attachment and Validity --}} 
                            <td style="text-align:center;border-left: darkgray;border-left-width: thin;border-left-style: solid;">
                            
                                @if(isset($data->xrayValStart) || isset($data->formattedXrayValidityDate))Validity Date<br/>@endif
                                @if(isset($data->formattedXrayStartValidityDate)){{$data->formattedXrayStartValidityDate}} @endif                              
                                @if(isset($data->formattedXrayValidityDate)) to {{$data->formattedXrayValidityDate}} @endif 
                                <br/><br/>    
                                @if(isset($data->xrayUp))
                                <a href="{{url('file/download/')}}/{{$data->xrayUp}} " class="btn btn-info form-control" style="font-size:small">Click Here to download</a>
                                @endif
                            </td>

                            <td style="text-align:center;border-left: darkgray;border-left-width: thin;border-left-style: solid;">                         
                            {{-- FDA Remarks --}}     
                                @if(isset($data->RecoRemarkFDA)){{$data->RecoRemarkFDA}} @endif 
                            </td>
                            
                          @endif 

                          
                          @if($FDAtype != 'all' && $FDAtype == 'pharma')
                          {{-- Cashier --}}
                              <td style="text-align:center; border-left: darkgray;border-left-width: thin;border-left-style: solid;"> 
                                @if(isset($data->formattedCashierApproveDatePharma)) {{$data->formattedCashierApproveDatePharma}} @endif 
                                @if(isset($data->formattedCashierApproveTimePharma)) {{$data->formattedCashierApproveTimePharma}} @endif 
                                
                                @if(isset($data->CashierApproveByPharma)) <br/><br/> By: {{$data->CashierApproveByPharma}} @endif 
                                @if(isset($data->CashierApproveIpPharma)) <br/> IP Addr: {{$data->CashierApproveIpPharma}} @endif
                              </td>
                          
                          {{-- Pre-Assessment --}}
                              <td style="text-align:center; border-left: darkgray;border-left-width: thin;border-left-style: solid;"> 
                                @if(isset($data->formattedIsPreassessedDatePharma)) {{$data->formattedIsPreassessedDatePharma}} @endif 
                                @if(isset($data->formattedIsPreassessedTimePharma)) {{$data->formattedIsPreassessedTimePharma}} @endif 
                                
                                @if(isset($data->ispreassessedbypharma)) <br/><br/> By: {{$data->ispreassessedbypharma}} @endif 
                                @if(isset($data->ispreassessedippharma)) <br/> IP Addr: {{$data->ispreassessedippharma}} @endif
                              </td>
                          
                          {{-- Inspection  --}}
                              <td style="text-align:center; border-left: darkgray;border-left-width: thin;border-left-style: solid;"> 
                                @if(isset($data->formattedRecommendedDateFDAPharma)) {{$data->formattedRecommendedDateFDAPharma}} @endif 
                                @if(isset($data->formattedRecommendedTimeFDAPharma)) {{$data->formattedRecommendedTimeFDAPharma}} @endif 
                                
                                @if(isset($data->recommendedbyFDAPharma)) <br/><br/> By: {{$data->recommendedbyFDAPharma}} @endif 
                                @if(isset($data->recommendedippaddrFDAPharma)) <br/> IP Addr: {{$data->recommendedippaddrFDAPharma}} @endif
                              </td>

                          {{-- Recommendation  --}}
                              <td style="text-align:center; border-left: darkgray;border-left-width: thin;border-left-style: solid;"> 
                                @if(isset($data->formattedRecoDateFDAPhar)) {{$data->formattedRecoDateFDAPhar}} @endif 
                                @if(isset($data->formattedRecoTimeFDAPhar)) {{$data->formattedRecoTimeFDAPhar}} @endif 
                                
                                @if(isset($data->RecobyFDAPhar)) <br/><br/> By: {{$data->RecobyFDAPhar}} @endif 
                                @if(isset($data->RecoippaddrFDAPhar)) <br/> IP Addr: {{$data->RecoippaddrFDAPhar}} @endif
                              </td>

                          {{-- Final Decision --}}
                              <td style="text-align:center; border-left: darkgray;border-left-width: thin;border-left-style: solid;"> 
                                @if(isset($data->formattedApprovedDateFDAPharma)) {{$data->formattedApprovedDateFDAPharma}} @endif 
                                @if(isset($data->formattedApprovedTimeFDAPharma)) {{$data->formattedApprovedTimeFDAPharma}} @endif 
                                
                                @if(isset($data->approvedByFDAPharma)) <br/><br/> By: {{$data->approvedByFDAPharma}} @endif 
                                @if(isset($data->approvedIpAddFDAPharma)) <br/> IP Addr: {{$data->approvedIpAddFDAPharma}} @endif
                              </td>
                          @endif 


                          @if($FDAtype != 'all' && $FDAtype == 'pharma')
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
                  <td style="text-align: center; border-left: darkgray;border-left-width: thin;border-left-style: solid;"  colspan="2">DOH Inspection</td>
                                  
                  @if($FDAtype == 'machines')
                    <td style="text-align: center; border-left: darkgray;border-left-width: thin;border-left-style: solid;" rowspan="2">FDA Remarks</td>
                    <td style="text-align: center; border-left: darkgray;border-left-width: thin;border-left-style: solid;" rowspan="2">COC Attachment and Validity</td>
                  @else
                    <td style="text-align: center; border-left: darkgray;border-left-width: thin;border-left-style: solid;" @if($FDAtype == 'all') colspan="2" @endif> Cashier Details of</td>
                    <td style="text-align: center; border-left: darkgray;border-left-width: thin;border-left-style: solid;" @if($FDAtype == 'all') colspan="2" @endif> Pre-Assessment Details of</td>
                    <td style="text-align: center; border-left: darkgray;border-left-width: thin;border-left-style: solid;"  @if($FDAtype == 'all') colspan="2" @endif> Inspection Details of</td>
                    <td style="text-align: center;border-left: darkgray;border-left-width: thin;border-left-style: solid;"  @if($FDAtype == 'all') colspan="2" @endif> Recommendation Details of</td>
                    <td style="text-align: center;border-left: darkgray;border-left-width: thin;border-left-style: solid;"  @if($FDAtype == 'all') colspan="2" @endif> Final Decision Details of</td>
                  @endif 
                  <td style="text-align: center;border-left: darkgray;border-left-width: thin;border-left-style: solid;"  @if($FDAtype == 'all') colspan="2" @endif> Application Status of</td>
                  <td style="text-align: center;border-left: darkgray;border-left-width: thin;border-left-style: solid;" rowspan="2">DOH Status</td>  
                  
              </tr>
              <tr style="font-weight:bold;">
                      <td style="text-align: center; border-left: darkgray;border-left-width: thin;border-left-style: solid;">Target Last Date</td>                      
                      <td style="text-align: center;">Actual Date</td>                    
                  @if($FDAtype != 'all' && $FDAtype == 'pharma')
                      <td  style="text-align: center; border-left: darkgray;border-left-width: thin;border-left-style: solid;">Pharmacy</td>
                  @endif 

                  @if($FDAtype != 'all' && $FDAtype == 'pharma')
                      <td  style="text-align: center; border-left: darkgray;border-left-width: thin;border-left-style: solid;">Pharmacy</td>
                  @endif 

                  @if($FDAtype != 'all' && $FDAtype == 'pharma')
                      <td  style="text-align: center; border-left: darkgray;border-left-width: thin;border-left-style: solid;">Pharmacy</td>
                  @endif 

                  @if($FDAtype != 'all' && $FDAtype == 'pharma')
                      <td  style="text-align: center; border-left: darkgray;border-left-width: thin;border-left-style: solid;">Pharmacy</td>
                  @endif

                  @if($FDAtype != 'all' && $FDAtype == 'pharma')
                      <td  style="text-align: center; border-left: darkgray;border-left-width: thin;border-left-style: solid;">Pharmacy</td>
                  @endif 

                  @if($FDAtype != 'all' && $FDAtype == 'machines')
                      <td style="text-align: center; border-left: darkgray;border-left-width: thin;border-left-style: solid;">Radiation</td>
                  @endif @if($FDAtype != 'all' && $FDAtype == 'pharma')
                      <td  style="text-align: center; border-left: darkgray;border-left-width: thin;border-left-style: solid;">Pharmacy</td>
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
  
  <div class="modal fade" id="ModalStatus" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog  modal-lg " role="document">
        <div class="modal-content" style="border-radius: 0px;border: none;">
          <div class="modal-body" style=" background-color: #272b30;color: white;">
            <h5 class="modal-title text-center"><strong>Update Application Status</strong></h5>
            <hr>
            <div class="container">
                <form id="ViewNowStatus" method="POST"   data-parsley-validate>
                  <input type="hidden" name="action" id="action_status" value="status">
                  <input type="hidden" name="appid" id="appid_status" >
                  <span id="ViewBodyStatus"></span>
                  <br/>
                  <div class="row">
                    <div class="col-sm-3">Status:</div>
                    <div class="col-sm-8"> 
                      <select name="FDAStatMach" id="FDAStatMach" class="form-control" required style="width: 100%;" onchange="showDiv(this)">
                            <option disabled hidden selected>Please Select</option>                            
                            <option value="Cancelled">Cancelled</option>
                            <option value="No Application">No Application</option>
                            <option value="On Process">On Process</option>
                            <option value="Approved">Approved</option>
                            <option value="Disapproved Application">Disapproved Application</option>
                            <option value="Denied">Denied</option>                          
                      </select>
                    <div class="col-sm-1"></div>
                    </div>
                  </div>
                  <br/><hr>
                  <div class="row">                    
                    <div class="col-sm-12">
                      <button type="submit" class="btn btn-success form-control" style="border-radius:0;"><span class="fa fa-save"></span>   Save</button>
                    </div>
                  </div>
                </form>
            </div>
          </div>
        </div>
      </div>
  </div>
  
  <div class="modal fade" id="ModalRemarks" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog  modal-lg " role="document">
        <div class="modal-content" style="border-radius: 0px;border: none;">
          <div class="modal-body" style=" background-color: #272b30;color: white;">
            <h5 class="modal-title text-center"><strong>Update Remarks</strong></h5>
            <hr>
            <div class="container">
                <form id="ViewNowRemarks" method="post" data-parsley-validate>
                  <input type="hidden" name="action" id="action_remarks" value="remarks">
                  <input type="hidden" name="appid" id="appid_remarks" >
                  <span id="ViewBodyRemarks"></span>
                  <br/><hr>
                  <div class="row">                    
                    <div class="col-sm-12">
                      <button type="submit" class="btn btn-success form-control" style="border-radius:0;"><span class="fa fa-save"></span>   Save</button>
                    </div>
                  </div>
                </form>
            </div>
          </div>
        </div>
      </div>
  </div>
    <!-------------
  <div class="modal fade" id="ModalCOC" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog  modal-lg " role="document">
        <div class="modal-content" style="border-radius: 0px;border: none;">
          <div class="modal-body" style=" background-color: #272b30;color: white;">
            <h5 class="modal-title text-center"><strong>Upload COC</strong></h5>
            <hr>
            <div class="container">
                <form id="ViewNowCOC"  method="post" action="{{asset('employee/nhfr/import/nhfr')}}" enctype="multipart/form-data">
                  <input type="hidden" name="action" id="action_coc" value="coc">
                  <input type="hidden" name="appid" id="appid_coc" >
                  <span id="ViewBodyCOC">
                  </span> 

                  <br/>
                  <div class="row">
                    <div class="col-sm-3">Start of Validity:</div>
                    <div class="col-sm-9"> 
                      <input type="date" class="form-control" id="xrayValStart" name="xrayValStart" placeholder="Start of Validity" required>
                    </div>
                  </div>
                  
                  <br/>
                  <div class="row">
                    <div class="col-sm-3">End of Validity:</div>
                    <div class="col-sm-9"> 
                      <input type="date" class="form-control" id="xrayVal" name="xrayVal" placeholder="End of Validity" required>
                    </div>
                  </div>

                  <br/>
                  <div class="row">

                    <div class="col-sm-3">Upload:</div>
                    <div class="col-sm-9"> 
                      <input type="file" name="xrayUp" id="xrayUp" required accept=".pdf, image/png, image/jpeg"> 
                    </div>

                  </div>

                  <br/><hr>
                  <div class="row">                    
                    <div class="col-sm-12">
                      <button type="submit" class="btn btn-success form-control" style="border-radius:0;"><span class="fa fa-save"></span>   Save</button>
                    </div>
                  </div>
                </form>
            </div>
          </div>
        </div>
      </div>
  </div>

------------------>


  <div class="modal fade" id="ModalCOC" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content" style="border-radius: 0px;border: none;">
        <div class="modal-body" style=" background-color: #272b30;color: white;">

          <h5 class="modal-title text-center"><strong>Approval/Issuance of Application</strong></h5>
          <hr>
          <div class="col-sm-12 alert alert-danger alert-dismissible fade show" style="display: none" id="AccErrorAlert" role="alert">
              <strong><i class="fas fa-exclamation"></i></strong>&nbsp;An <strong>error</strong> occurred. Please contact the system administrator.
              <button type="button" class="close" onclick="$('#AccErrorAlert').hide(1000);" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          
          <div class="container">

            <form id="AppFormFinal" enctype="multipart/form-data" data-parsley-validate>
                <input type="text" id="desc_isAppr" value="" disabled hidden>
                {{csrf_field()}}
                <input type="hidden" name="action" id="action_coc" value="coc">
                <input type="hidden" name="appid" id="appid_coc" >
                <span id="ViewBodyCOC">
                </span>

                <div class="row pt-3">
                  <div class="col-sm-4">Start of Validity Date:<span style="color:red;font-weight: bolder">*</span> </div>
                    <div class="col-sm-8" >
                      <input type="date" class="form-control" id="xrayValStart" name="xrayValStart" placeholder="Start of Validity" required>
                    </div>
                </div>
                <div class="row pt-3">
                  <div class="col-sm-4">End of Validity Date:<span style="color:red;font-weight: bolder">*</span> </div>
                    <div class="col-sm-8" >
                      <input type="date" class="form-control" rows="5" name="xray" id="xray" data-parsley-required-message="<strong>X-Ray Validity Date<strong> required." required="">
                    </div>
                </div>
                <div class="row pt-3">
                  <div class="col-sm-4">Upload COC for Machine:<span style="color:red;font-weight: bolder">*</span> </div>
                    <div class="col-sm-8" >
                      <input type="file" class="form-control" rows="5" name="xrayCOCUP" id="xrayCOCUP" data-parsley-required-message="<strong>Upload COC for Machine<strong> required." required="">
                    </div>
                </div>                   
                <hr>

                <div class="row">                    
                    <div class="col-sm-12">
                      <button type="submit" d="MODALBTN" class="btn btn-success form-control" style="border-radius:0;"><span class="fa fa-save"></span>   Save</button>
                    </div>
                  </div>
            </form>
          </div>

        </div>
      </div>
    </div>
  </div>


  <!------------------------------->

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
    //ViewNowRemarks
    $('#ViewNowStatus').on('submit',function(event){
            event.preventDefault();
            var form = $(this);
            form.parsley().validate();
            if (form.parsley().isValid()){	
                $.ajax({
                  method : 'POST',
                  data : {
                        _token : $('#token').val(),
                        action : $('#action_status').val(),
                        appid : $('#appid_status').val(),
                        FDAStatMach : $('#FDAStatMach').val()
                        ///desc : $('#desc_rmk').val(),
                        //id : $('#APPID').val(),
                        //pass : $('#chckpass').val(),
                        //validity : ($("#validityDate").length > 0 ? $("#validityDate").val() : null),
                       // validityDateFrom : ($("#validityDateFrom").length > 0 ? $("#validityDateFrom").val() : null)
                  }, success : function(data){
                                        
                    console.log(data);
                    
                      if (data == 'DONE') {
                          Swal.fire({
                            type: 'success',
                            title: 'Success',
                            text: 'Status successfully updated.',
                          }).then(() => {
                            //window.location.href = '{{ asset('employee/dashboard/processflow/approval') }}';
                            location.reload();
                          });
                      } else if (data == 'ERROR'){
                        $('#AccErrorAlert').show(100); 

                      } 
                  }, error : function(a,b,c){ 
                      console.log(c);
                      $('#AccErrorAlert').show(100);
                  },

                });
            }
        });

    $('#ViewNowRemarks').on('submit',function(event){
            event.preventDefault();
            var form = $(this);
            form.parsley().validate();
            if (form.parsley().isValid()){	
                $.ajax({
                  method : 'POST',
                  data : {
                        _token : $('#token').val(),
                        action : $('#action_remarks').val(),
                        appid : $('#appid_remarks').val(),
                        RecoRemarkFDA : $('#RecoRemarkFDA').val()
                        ///desc : $('#desc_rmk').val(),
                        //id : $('#APPID').val(),
                        //pass : $('#chckpass').val(),
                        //validity : ($("#validityDate").length > 0 ? $("#validityDate").val() : null),
                       // validityDateFrom : ($("#validityDateFrom").length > 0 ? $("#validityDateFrom").val() : null)
                  }, success : function(data){
                                        
                    console.log(data);
                    
                      if (data == 'DONE') {
                          Swal.fire({
                            type: 'success',
                            title: 'Success',
                            text: 'Remarks successfully saved.',
                          }).then(() => {
                            //window.location.href = '{{ asset('employee/dashboard/processflow/approval') }}';
                            location.reload();
                          });
                      } else if (data == 'ERROR'){
                        $('#AccErrorAlert').show(100); 

                      } 
                  }, error : function(a,b,c){ 
                      console.log(c);
                      $('#AccErrorAlert').show(100);
                  },

                });
            }
        });

        $('#ViewNowCOC').on('submit',function(event){
            event.preventDefault();
            var form = $(this);
            form.parsley().validate();
            if (form.parsley().isValid()){	
                $.ajax({
                  method : 'POST',
                  data : {
                        _token : $('#token').val(),
                        action : $('#action_coc').val(),
                        appid : $('#appid_coc').val(),
                        ///desc : $('#desc_rmk').val(),
                        //id : $('#APPID').val(),
                        //pass : $('#chckpass').val(),
                        xrayValStart : ($("#xrayValStart").length > 0 ? $("#xrayValStart").val() : null),
                        xrayVal : ($("#xrayVal").length > 0 ? $("#xrayVal").val() : null)
                  }, success : function(data){
                                        
                    console.log(data);
                    
                      if (data == 'DONE') {
                          Swal.fire({
                            type: 'success',
                            title: 'Success',
                            text: 'Remarks successfully saved.',
                          }).then(() => {
                            //window.location.href = '{{ asset('employee/dashboard/processflow/approval') }}';
                            location.reload();
                          });
                      } else if (data == 'ERROR'){
                        $('#AccErrorAlert').show(100); 

                      } 
                  }, error : function(a,b,c){ 
                      console.log(c);
                      $('#AccErrorAlert').show(100);
                  },

                });
            }
        });


        $('#AppFormFinal').on('submit',function(event){
            event.preventDefault();
            var form = $(this);
            form.parsley().validate();
            if (form.parsley().isValid()){	
                let data = new FormData(this);
                data.append('id',$('#APPID').val());
                data.append('isOk',$('#desc_isAppr').val());
                data.append('desc',$('#desc_rmk').val());
                $.ajax({
                  method : 'POST',
                  data : data, 
                  cache: false,
                  contentType: false,
                  processData: false,
                  success : function(data){
                      if (data == 'DONE') {
                        Swal.fire({
                          type: 'success',
                          title: 'Success',
                          text: 'Success.',
                        }).then(() => {
                          location.reload();
                        });
                      } else if (data == 'ERROR'){
                        $('#AccErrorAlert').show(100);  
                      } else if(data == 'WRONGPASSWORD'){
                        Swal.fire({
                          type: 'error',
                          title: 'Error',
                          text: 'Wrong Password. Please try again.',
                        }).then(() => {
                        });
                      } else {
                        Swal.fire({
                          type: 'error',
                          title: 'COC/RL',
                          text: data
                        })
                      }
                  }, error : function(a,b,c){ 
                      console.log(c);
                      $('#AccErrorAlert').show(100);
                  },

                });
            } else {
              alert('Please check for all requirements');
            }
        });

  </script>

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

      function showDataStatus(appid, facilityname, facname){
          var status = '';

          $('#ViewBodyStatus').empty();
          $('#ViewBodyStatus').append(
              '<div class="row">'+
                  '<div class="col-sm-3">Application ID:' +
                  '</div>' +
                  '<div class="col-sm-9 text-bold" style="font-size: x-large;">' + appid +
                  '</div>' +
              '</div>' +
            '<div class="row">'+
                  '<div class="col-sm-3">Facility Name:' +
                  '</div>' +
                  '<div class="col-sm-9">' + facilityname +
                  '</div>' +
              '</div>'
            );

            document.getElementById('appid_status').value = appid;
      }
      
      function showDataRemarks(appid, facilityname, RecoRemarkFDA){
          var status = '';

          $('#ViewBodyRemarks').empty();
          $('#ViewBodyRemarks').append(
              '<div class="row">'+
                  '<div class="col-sm-3">Application ID:' +
                  '</div>' +
                  '<div class="col-sm-9 text-bold" style="font-size: x-large;">' + appid +
                  '</div>' +
              '</div>' +
              '<div class="row">'+
                  '<div class="col-sm-3">Facility Name:' +
                  '</div>' +
                  '<div class="col-sm-9">' + facilityname +
                  '</div>' +
              '</div><br/>' +
              '<div class="row mt-10">'+
                  '<div class="col-sm-3">Remarks:' +
                  '</div>' +
                  '<div class="col-sm-9"><textarea name="RecoRemarkFDA" id="RecoRemarkFDA" rows="5" cols="50" required>' + RecoRemarkFDA + 
                  '</textarea></div>' +
              '</div>'
            );

            
            document.getElementById('appid_remarks').value = appid;
      }
      
      function showDataCOC(appid, facilityname, xrayVal, xrayCOC, xrayUp){
          var status = '';

          $('#ViewBodyCOC').empty();
          $('#ViewBodyCOC').append(
              '<div class="row">'+
                  '<div class="col-sm-3">Application ID:' +
                  '</div>' +
                  '<div class="col-sm-9 text-bold" style="font-size: x-large;">' + appid +
                  '</div>' +
              '</div>' +
              '<div class="row">'+
                  '<div class="col-sm-3">Facility Name:' +
                  '</div>' +
                  '<div class="col-sm-9">' + facilityname +
                  '</div>' +
              '</div>'
            );
            
            document.getElementById('appid_coc').value = appid;
            document.getElementById('xrayVal').value = xrayVal;
            document.getElementById('xrayCOC').value = xrayCOC;
            document.getElementById('xrayUp').value = xrayUp;
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