
<form  method="POST">
    {{ csrf_field() }}
    <!-- Application Details -->
    <input type="hidden" name="appid" value="{{$appform->appid}}"> 
    <input type="hidden" name="grp_id" value="6">    
        
    <div class="modal fade" id="changeApprovingAuthority" tabindex="-1" aria-labelledby="changeApprovingAuthorityModalLabel" aria-hidden="true">
        <div class="modal-dialog  modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="changeApprovingAuthorityModalLabel">APPROVING AUTHORITY DETAILS</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-info">
                    <div class="form-group col-md-12">
                        <label for="facility_name">Approving Authority Position/Designation </label>
                        <div class="input-group">
                            <select class="form-control  show-menu-arrow" data-funcid="main" id="approving_authority_pos" name="approvingauthoritypos" data-live-search="true" data-style="text-dark form-control custom-selectpicker" data-size="5" required>
                                <option value="">Please select</option>
                                <option value="President" @if($appform->approvingauthoritypos == 'President') {{'selected'}} @endif >President</option>
                                <option value="Owner" @if($appform->approvingauthoritypos == 'Owner') {{'selected'}} @endif >Owner</option>
                                <option value="Head of Facility" @if($appform->approvingauthoritypos == 'Head of Facility') {{'selected'}} @endif >Head of Facility</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group col-md-12">
                        <label>Approving Authority Full Name <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <input type="text" name="approvingauthority" class="form-control" placeholder="Approving Authority Full Name" value="{{$appform->approvingauthority}}" id="approvingauthority" required=""> 
                        </div>
                    </div>

                    <div class="form-group col-md-12">
                        <label>Head of Facility Full Name <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <input type="text" name="head_of_facility_name" class="form-control" placeholder="Head of Facility Full Name" value="{{$appform->head_of_facility_name}}" id="head_of_facility_name" required=""> 
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