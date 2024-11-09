<form id="form_bedcapacity" method="POST" class="row">
    {{ csrf_field() }}
    <input type="hidden" name="appid" value="{{$appform->appid}}"> 
    <input type="hidden" name="grp_id" value="13">                  

    <div class="modal fade" id="changeBedCapacity" tabindex="-1" aria-labelledby="changeBedCapacityModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="changeBedCapacityModalLabel">Increase / Decrease Bed Capacity</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-info">

                        <div class="form-group col-md-12">
                            <label for="facility_name">Bed Capacity : <span class="text-danger">*</span> </label>
                            <div class="input-group">
                                <input class="form-control" type="number" name="noofbed_applied" id="noofbed_applied" placeholder="Applied Bed Capacity" min="0" autocomplete="off" value="{{$appform->noofbed}}">
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
                        <i class="fa fa-floppy-o" aria-hidden="true"></i>Save Data
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>
                