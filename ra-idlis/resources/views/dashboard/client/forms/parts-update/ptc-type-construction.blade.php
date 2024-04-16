<form id="form_bedcapacity" method="POST" class="row">
    {{ csrf_field() }}
    <input type="hidden" name="appid" value="{{$appform->appid}}"> 
    <input type="hidden" name="grp_id" value="13">                  

    <div class="modal fade" id="changePTCTypeCons" tabindex="-1" aria-labelledby="changePTCTypeConsModalLabel" aria-hidden="true">
        <div class="modal-dialog  modal-lg">
            <div class="modal-content" style=" background-color: #272b30; color: white;">
                <div class="modal-header">
                    <h5 class="modal-title" id="changePTCTypeConsModalLabel">Type of Constructions</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-justify" style=" background-color: #272b30; color: white;">
                    <div class="row">

                        <div class="col-md-3 text-bold">Type of Construction: <span class="text-danger">*</span></div>
                        <div class="col-md-3">
                            <label> <input id="type0" type="radio" onclick="getPTCtype(this.value)" name="type" value="0"> New </label>
                        </div>
                        <div class="col-md-6">
                            <label><input type="radio" id="type1" name="type" onclick="getPTCtype(this.value)" value="1"> Expansion/Renovation/Substantial Alteration</label>
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
                