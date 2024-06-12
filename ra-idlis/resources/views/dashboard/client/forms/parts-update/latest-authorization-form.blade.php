<form method="POST">
    {{ csrf_field() }}
    <input type="hidden" name="appid" value="{{$appform->appid}}">   
    <input type="hidden" name="hfser_id" value="{{$appform->hfser_id}}">   
    <input type="hidden" name="grp_id" value="7">  

    @if($appform->hfser_id == 'PTC') <input type="hidden" name="ptcCode" value=""> @endif
        
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
                        <label for="facility_name">Certificate of Need No. (if applicable) </label>
                        <div class="input-group">
                            <input type="text" name="conCode" class="form-control" placeholder="Certificate of Need No. (if applicable)" value="{{$appform->ptc_conCode}}" id="conCode"> 
                        </div>
                    </div>

                    <div class="form-group col-md-12" @if($appform->hfser_id == 'PTC') hidden @endif>
                        <label for="facility_name">Permit to Construct No. (if applicable) </label>
                        <div class="input-group">
                            <input type="text" name="ptcCode" class="form-control" placeholder="Permit to Construct No. (if applicable)" value="{{$appform->ptcCode}}" id="ptcCode"> 
                        </div>
                    </div>
                    <!--
                    <div class="form-group col-md-12" @if($appform->hfser_id == 'PTC') hidden @endif>
                        <label>Date Issued </label>
                        <div class="input-group">
                            <input type="date" name="ptc_approveddate" class="form-control" placeholder="Date Issued" value="{{$appform->ptc_approveddate}}" id="ptc_approveddate" > 
                        </div>
                    </div> -->

                    <div class="form-group col-md-12">
                        <label for="facility_name">Latest LTO/COA/COR/ATO Number </label>
                        <div class="input-group">
                            <input type="text" name="ltoCode" class="form-control" placeholder="Latest LTO/COA/COR/ATO Number" value="{{$appform->ptc_ltoCode}}" id="ltoCode"> 
                        </div>
                    </div>
                    <!--
                    <div class="form-group col-md-12" @if($appform->hfser_id == 'PTC') hidden @endif>
                        <label>Validity Period </label>
                        <div class="input-group">
                            <input type="date" name="lto_validityto" class="form-control" placeholder="Validity Period" value="{{$appform->lto_validityto}}" id="facility_name" > 
                        </div>
                    </div> -->


                        
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