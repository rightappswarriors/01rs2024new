
<form method="POST">
    {{ csrf_field() }}
    <!-- Application Details -->
    <input type="hidden" name="grp_id" value="1">   
    <input type="hidden" name="appid" value="{{$appform->appid}}">   
        
    <div class="modal fade" id="changeRenameHF" tabindex="-1" aria-labelledby="changeRenameHFModalLabel" aria-hidden="true">
        <div class="modal-dialog  modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="changeRenameHFModalLabel">Health Facility Name and NHFR Code</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-info">
                        
                        <div class="form-group col-md-12">
                            <label for="facility_name">Registered ID </label>
                            <div class="input-group">
                                <input type="text" name="regfac_id" class="form-control" placeholder="Registered ID" value="{{$appform->regfac_id}}" id="regfac_id"> 
                            </div>
                        </div>
                        
                        <div class="form-group col-md-12">
                            <label for="facility_name">NHFR Code </label>
                            <div class="input-group">
                                <input type="text" name="nhfcode" class="form-control" placeholder="NHFR Code" value="{{$appform->nhfcode}}" id="nhfcode"> 
                            </div>
                        </div>

                        <div class="form-group col-md-12">
                            <label for="facility_name">Facility Name <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="text" name="facilityname" class="form-control" placeholder="FACILITY NAME" value="{{$appform->facilityname}}" id="facility_name" onblur="checkFacilityNameNew(this.value)" required=""> 
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