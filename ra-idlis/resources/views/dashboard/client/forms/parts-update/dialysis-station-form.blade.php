<form  id="form_dialysisstation" action="{{asset('/client1/changerequest/actionsubmit')}}" method="POST">
    {{ csrf_field() }}
    <input type="hidden" name="appid" id="appid" value="{{$appform->appid}}">         
        
    
    <div class="modal fade" id="changeDialysisStation" tabindex="-1" aria-labelledby="changeDialysisStationModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="changeDialysisStationModalLabel">Increase / Decrease in Dialysis Station</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-info">

                    <div class="form-group col-md-12">
                        <label for="facility_name">Number of Dialysis Station<span class="text-danger">*</span></label>
                        <div class="input-group">
                            <input class="form-control" type="number" name="noofdialysis" id="noofdialysis" placeholder="No. of Dialysis Station" min="0" autocomplete="off" value="{{$appform->noofdialysis}}">
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