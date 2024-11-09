<form id="form_changeRemarks" method="POST" class="row">
    {{ csrf_field() }}
    <input type="hidden" name="appid" value="{{$appform->appid}}"> 
    <input type="hidden" name="grp_id" value="20">                  

    <div class="modal fade" id="changeRemarks" tabindex="-1" aria-labelledby="changeRemarksModalLabel" aria-hidden="true">
        <div class="modal-lg modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="changeBedCapacityModalLabel">DOH Remarks</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-info form-group col-md-12">

                            <label for="facility_name">Staff in Charge Remarks: <span class="text-danger">*</span> </label>
                            <textarea class="form-control col-sm-12 text-left" name="appComment">{{$appform->appComment}}</textarea>                        
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger action-btn" data-dismiss="modal">
                        <i class="fa fa-times" aria-hidden="true"></i>
                        No, Recheck details
                    </button>
                    <button class="btn btn-primary action-btn" type="submit">
                        <i class="fa fa-floppy-o" aria-hidden="true"></i>Save Data
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>
                