
<form action="{{asset('/client1/changerequest/actionsubmit')}}" method="POST">
    {{ csrf_field() }}
    <!-- Application Details -->
    <input type="hidden" name="appid" id="appid" value="{{$appform->appid}}">   
        
    <div class="modal fade" id="changeLatestAuthorization" tabindex="-1" aria-labelledby="changeLatestAuthorizationModalLabel" aria-hidden="true">
        <div class="modal-dialog  modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="changeLatestAuthorizationModalLabel">LATEST AUTHORIZATION NUMBER</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-info">
                    <div class="form-group col-md-12">
                        <label for="facility_name">Permit to Construct No. (if applicable) </label>
                        <div class="input-group">
                            <input type="text" name="nhfrcode" class="form-control" placeholder="Permit to Construct No. (if applicable)" value="{{$appform->nhfcode}}" id="nhfrcode"> 
                        </div>
                    </div>

                    <div class="form-group col-md-12">
                        <label>Date Issued <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <input type="date" name="facilityname" class="form-control" placeholder="Approving Authority Full Name" value="{{$appform->facilityname}}" id="facility_name" onblur="checkFacilityNameNew(this.value)" required=""> 
                        </div>
                    </div>

                    <div class="form-group col-md-12">
                        <label for="facility_name">Latest LTO/COA/COR/ATO Number </label>
                        <div class="input-group">
                            <input type="text" name="nhfrcode" class="form-control" placeholder="Latest LTO/COA/COR/ATO Number" value="{{$appform->nhfcode}}" id="nhfrcode"> 
                        </div>
                    </div>

                    <div class="form-group col-md-12">
                        <label>Validity Period <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <input type="date" name="facilityname" class="form-control" placeholder="Validity Period" value="{{$appform->facilityname}}" id="facility_name" onblur="checkFacilityNameNew(this.value)" required=""> 
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