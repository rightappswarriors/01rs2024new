<form id="form_bedcapacity" action="{{asset('/client1/changerequest/actionsubmit')}}" method="POST" class="row">
    {{ csrf_field() }}
    <input type="hidden" name="appid" id="appid" value="{{$appform->appid}}">                     

    <div class="modal fade" id="changePharmacy" tabindex="-1" aria-labelledby="changeBedCapacityModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="changeBedCapacityModalLabel">For Pharmacy</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-info">

                        <div class="form-group col-md-12">
                            <label for="facility_name">Number of Main Pharmacy <span class="text-danger">*</span> </label>
                            <div class="input-group">
                                <input class="form-control" type="number" name="noofbed_applied" id="noofbed_applied" placeholder="Number of Main Pharmacy" min="0" autocomplete="off" value="{{$appform->noofbed}}">
                            </div>
                        </div>

                        <div class="form-group col-md-12">
                            <label for="facility_name">No. of Satellites <span class="text-danger">*</span> </label>
                            <div class="input-group">
                                <input class="form-control" type="number" name="noofbed_applied" id="noofbed_applied" placeholder="No. of Satellites" min="0" autocomplete="off" value="{{$appform->noofbed}}">
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
                