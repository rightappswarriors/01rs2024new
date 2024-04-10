
<form method="POST">
    {{ csrf_field() }}
    <!-- Application Details -->
    <input type="hidden" name="appid" value="{{$appform->appid}}">   
    <input type="hidden" name="appform_areacode" value="{{$appform->areacode}}">  
    <input type="hidden" name="grp_id" value="5">   
        
    <div class="modal fade" id="changeOwner" tabindex="-1" aria-labelledby="changeOwnerModalLabel" aria-hidden="true">
        <div class="modal-dialog  modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="changeOwnerModalLabel">Health Facility Name and NHFR Code</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-info">
                    @php                    
                            $areacode_1 = "";
                            $areacode_2 = "";
                            $areacode_3 = "";

                            try {

                                if(!empty($appform->areacode))
                                {
                                    $areacode = json_decode($appform->areacode);
                                    $areacode_1 = $areacode[0];
                                    $areacode_2 = $areacode[1];
                                    $areacode_3 = $areacode[2];
                                }
                            } catch (Exception $e) {}                            
                        @endphp

                    <div class="form-group col-md-12">
                        <label for="facility_name">Owner Name <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <input type="text" name="owner" class="form-control" placeholder="OWNER NAME" value="{{$appform->owner}}" required="" id="owner"> 
                        </div>
                    </div>

                    <div class="form-group col-md-12">
                        <label for="facility_name">Proponent/Owner Mobile No. </label>
                        <div class="input-group">
                            <input type="number" name="ownerMobile" class="form-control" placeholder="Proponent/Owner Mobile No." value="{{$appform->ownerMobile}}" id="ownerMobile"> 
                        </div>
                    </div>
                    
                    <div class="form-group col-md-12">
                        <label for="facility_name">Proponent/Owner Landline </label>
                        <div class="input-group">
                            <input type="number" name="areacode3" class="form-control col-md-3" placeholder="Area Code" value="{{$areacode_3}}"> 
                            <input type="number" name="ownerLandline" class="form-control col-md-9" placeholder="Proponent/Owner Landline" value="{{$appform->ownerLandline}}" id="ownerLandline"> 
                        </div>
                    </div>
                    
                    <div class="form-group col-md-12">
                        <label for="facility_name">Proponent/Owner Email Address </label>
                        <div class="input-group">
                            <input type="text" name="ownerEmail" class="form-control" placeholder="Proponent/Owner Email Address" value="{{$appform->ownerEmail}}" id="ownerEmail"> 
                        </div>
                    </div>
                    
                    <div class="form-group col-md-12">
                        <label for="facility_name">Official Mailing Address </label>
                        <label>
                            <input name="isSameAsFacilityAddress" type="checkbox" id="isSameAsFacilityAddress" value="1" onchange="setOfficialMailAddressNew(this)"> Official Mailing address same as Facility Address? If no, please specify complete address
                        </label>           
                        <div class="input-group">
                            <input type="text" name="mailingAddress" class="form-control" placeholder="Official Mailing Address" value="{{$appform->mailingAddress}}" id="mailingAddress"> 
                        </div>
                    </div>
                        
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger action-btn" data-dismiss="modal">
                        <i class="fa fa-times" aria-hidden="true"></i>
                        No, Recheck details
                    </button>
                    <button class="btn btn-primary action-btn" type="submit">
                        <i class="fa fa-floppy-o" aria-hidden="true"></i> Save Data
                    </button>
                </div>
            </div>
        </div>
    </div>

</form>