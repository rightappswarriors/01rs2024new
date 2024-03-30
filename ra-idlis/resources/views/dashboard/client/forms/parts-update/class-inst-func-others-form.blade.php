
<form action="{{asset('/client1/changerequest/actionsubmit')}}" method="POST">
    {{ csrf_field() }}
    <!-- Application Details -->
    <input type="hidden" name="appid" id="appid" value="{{$appform->appid}}">
        
    <div class="modal fade" id="changeCFIO" tabindex="-1" aria-labelledby="changeCFIOModalLabel" aria-hidden="true">
        <div class="modal-dialog  modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="changeCFIOModalLabel">Change in Classification/Institutional Character/Function</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    
                    <hr />
                    <div class="row">
                        <div class="col-md-12 change-div">
                            <div class="col-md-6">

                                <b class="text-primary">CHANGE IN CLASSIFICATION ACCORDING TO</b>
                            </div>
                            <div class="col-md-6">
                                <label class="text-danger">
                                <input type="checkbox" name="hfep" id="hfep" value="1"> HFEP Funded</label>
                            </div>
                        </div>
                        <div class="col-md-4 change-div">
                            <label for="ownership">Ownership <span class="text-danger">*</span></label>

                            <select class="form-control show-menu-arrow" id="ocid"  name="ocid"  data-style="text-dark form-control custom-selectpicker" data-size="5" required onChange="fetchClassification(this)">
                                <option>Please select</option>
                                <option  value="G">Government</option>
                                <option  value="P">Private</option>
                            </select>
                        </div>
                        <div class="col-md-4 change-div">
                            <label for="classification">Classification <span class="text-danger">*</span></label>
                            
                            <select class="form-control  show-menu-arrow toRemove" id="classification" value='' disabled name="classid"  data-style="text-dark form-control custom-selectpicker" data-size="5" required onChange="fetchSubClass(this)" {{ app('request')->input('cont') == 'yes'? '' : '' }} >
                                <option>Please select</option>
                            </select>
                        </div>
                        <div class="col-md-4 change-div">
                            <label for="subclass">Sub Classification</label>
                            <select class="form-control  show-menu-arrow toRemove" onchange="getFacServCharge()" id="subclass" disabled name="subClassid" data-style="text-dark form-control custom-selectpicker" data-size="5">
                                <option>Please select</option>
                            </select>
                        </div>
                        <div class="mb-2 col-md-12 change-div">&nbsp;</div>
                        <div class="col-md-6 change-div">

                            <label for="facmode">Institutional Character <span class="text-danger">*</span></label>
                            <div class="row">
                                <div class="col-lg-10 col-md-10 col-xs-10">
                                    <select class="form-control  show-menu-arrow" id="facmode" name="facmode" data-live-search="true" data-style="text-dark form-control custom-selectpicker" data-size="5" required>
                                        <option>Please select</option>
                                        <option value="2">Free Standing</option>
                                        <option value="4">Institution Based</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 change-div">
                            <label for="funcid">Function <span class="text-danger">*</span></label>
                            <select class="form-control  show-menu-arrow" data-funcid="main" id="funcid" name="funcid" data-live-search="true" data-style="text-dark form-control custom-selectpicker" data-size="5" required >
                                <option>Please select</option>
                                <option value="1">General</option>
                                <option value="2">Specialty</option>
                                <option value="3">Not Applicable</option>
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
                        <i class="fa fa-floppy-o" aria-hidden="true"></i> Save Application
                    </button>
                </div>
            </div>
        </div>
    </div>

</form>