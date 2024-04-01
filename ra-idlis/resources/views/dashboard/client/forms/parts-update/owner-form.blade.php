
<form action="{{asset('/client1/changerequest/actionsubmit')}}" method="POST">
    {{ csrf_field() }}
    <!-- Application Details -->
    <input type="hidden" name="appid" id="appid" value="{{$appform->appid}}">   
        
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

                    <div class="form-group col-md-12">
                        <label for="facility_name">Owner Name <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <input type="text" name="facilityname" class="form-control" placeholder="FACILITY NAME" value="{{$appform->facilityname}}" id="facility_name" onblur="checkFacilityNameNew(this.value)" required=""> 
                        </div>
                    </div>

                    <div class="form-group col-md-12">
                        <label for="facility_name">Proponent/Owner Mobile No. </label>
                        <div class="input-group">
                            <input type="text" name="nhfrcode" class="form-control" placeholder="NHFR Code" value="{{$appform->nhfcode}}" id="nhfrcode"> 
                        </div>
                    </div>
                    
                    <div class="form-group col-md-12">
                        <label for="facility_name">Proponent/Owner Landline </label>
                        <div class="input-group">
                            <input type="text" name="nhfrcode" class="form-control" placeholder="NHFR Code" value="{{$appform->nhfcode}}" id="nhfrcode"> 
                        </div>
                    </div>
                    
                    <div class="form-group col-md-12">
                        <label for="facility_name">Proponent/Owner Email Address </label>
                        <div class="input-group">
                            <input type="text" name="nhfrcode" class="form-control" placeholder="NHFR Code" value="{{$appform->nhfcode}}" id="nhfrcode"> 
                        </div>
                    </div>
                    
                    <div class="form-group col-md-12">
                        <label for="facility_name">Official Mailing Address </label>
                        <label>
                            <input name="mailingAddress" type="checkbox" id="isSameAsFacilityAddress" value="1" onchange="setOfficialMailAddressNew(this)"> Official Mailing address same as Facility Address? If no, please specify complete address
                        </label>           
                        <div class="input-group">
                            <input type="text" name="nhfrcode" class="form-control" placeholder="NHFR Code" value="{{$appform->nhfcode}}" id="nhfrcode"> 
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