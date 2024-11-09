<!-- Modal -->
<div class="modal fade" id="clientregisteredfacilities" tabindex="-1" role="dialog" aria-labelledby="clientregisteredfacilitiesLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="clientregisteredfacilitiesLabel">List of Registered Facilities</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    
                    <div class="col-md-12" id="style-15" class="scrollbar" style="overflow-x: scroll;">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center" style="white-space: nowrap;">License Details</th>
                                    <th class="text-center" style="white-space: nowrap;">Facility Name</th>
                                    <th class="text-center">Options</th>
                                </tr>
                            </thead>
                            <tbody class="text-white font-weight-bold">
                                @if(count($appDet1)) 
                                    @foreach($appDet1 AS $each) 
                                        @if($each[0]->canapply == $each[0]->canapply) 
                                            <?php 
                                                $_tColor = (($each[0]->isapproved == 1) ? ((FunctionsClientController::checkExpiryDate($each[0]->validDate)) ? "danger" : "success") : "warning"); 
                                                $_tMsg = ((FunctionsClientController::checkExpiryDate($each[0]->validDate)) ? "License already expired." : $each[0]->trns_desc); 
                                            ?>
                                            <tr class="bg-{{$_tColor}}">
                                                <td class="text-center">
                                                    <span style="font-size: larger;">{{(isset($each[0]->licenseNo) ?$each[0]->licenseNo : "Not Applicable")}}</span><br/>
                                                    <p><br/>{{$each[0]->hfser_desc}}<br/>
                                                        @if(isset($each[0]->nhfcode))NHFR Code: {{$each[0]->nhfcode}}<br/> @endif
                                                        @if(isset($each[0]->regfac_id)) Registered ID: {{$each[0]->regfac_id}}<br/> @endif
                                                    </p>
                                                </td>
                                                <td class="text-center">
                                                    <span style="font-size: larger;">{{$each[0]->facilityname}}</span><br/>
                                                    <p>{{$each[0]->hgpdesc}}</p>
                                                    <p>{{$each[0]->address}}</p>

                                                    <p>Valid until  
                                                    @if($each[0]->hfser_id == 'CON')
                                                        {{((isset($each[0]->approvedDate)) ? date("F j, Y", ((strtotime($each[0]->approvedDate)-(86400*2))+15552000)) : 'DATE_ISSUED')}}
                                                    @elseif($each[0]->hfser_id == 'LTO')
                                                        {{date('F j, Y', strtotime("Last day of December", strtotime($each[0]->approvedDate)))}}
                                                    @elseif($each[0]->hfser_id == 'COA')
                                                        {{date('F j, Y', strtotime($each[0]->validDate))}}
                                                    @else 
                                                        {{($each[0]->hfser_id == 'LTO' ? (isset($each[4]->valto) ? Date('F j, Y',strtotime($each[4]->valto)) : "Valid To is not applicable"): "Permit is valid." )}}
                                                    @endif
                                                    <br/>Issued On {{Date('M d,  Y',strtotime($each[0]->approvedDate))}}</p>
                                                </td>	
                                                <td>
                                                    @if($each[0]->hfser_id != "PTC")
                                                        <button style="margin-top: 10px;" class="btn btn-light" data-toggle="tooltip" data-placement="top" title="Change Request Form" @if(isset($each[0]->regfac_id)) onclick="window.location.href='{{asset('client1/changerequest')}}/{{$each[0]->regfac_id}}/main'" @endif>
                                                        <i class="fa fa-pencil-square-o"></i><br><small> Change<br>Request Form </small></button>
                                                    @endif					
                                                </td>
                                            </tr>
                                        @endif 
                                    @endforeach 
                                
                                @else
                                    <tr>
                                        <td colspan="5">No application applied yet.</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>