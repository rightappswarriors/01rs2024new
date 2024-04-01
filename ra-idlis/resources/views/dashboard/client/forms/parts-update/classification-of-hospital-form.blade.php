
<form action="{{asset('/client1/changerequest/actionsubmit')}}" method="POST">
    {{ csrf_field() }}
    <!-- Application Details -->
    <input type="hidden" name="appid" id="appid" value="{{$appform->appid}}">
        
    <div class="modal fade" id="changeCOH" tabindex="-1" aria-labelledby="changeCOHModalLabel" aria-hidden="true">
        <div class="modal-dialog  modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="changeCOHModalLabel">CLASSIFICATION OF HOSPITAL</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    
                    <hr />
                    <div class="row">
                        <div class="col-md-6 change-div">
                            <label for="ownership">Classification of Hospital <span class="text-danger">*</span></label>

                            <select class="form-control show-menu-arrow" id="ocid"  name="ocid"  data-style="text-dark form-control custom-selectpicker" data-size="5" required onChange="fetchClassification(this)">
                                <option>Please select</option>
                                <option  value="G">Government</option>
                                <option  value="P">Private</option>
                            </select>
                        </div>
                        <div class="col-md-6 change-div">
                            <label for="classification">Hospital Level <span class="text-danger">*</span></label>
                            
                            <select class="form-control  show-menu-arrow toRemove" id="classification" value='' disabled name="classid"  data-style="text-dark form-control custom-selectpicker" data-size="5" required onChange="fetchSubClass(this)" {{ app('request')->input('cont') == 'yes'? '' : '' }} >
                                <option>Please select</option>
                            </select>
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