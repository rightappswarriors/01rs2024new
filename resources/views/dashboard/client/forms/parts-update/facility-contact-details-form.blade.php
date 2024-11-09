
<form method="POST">
    {{ csrf_field() }}
    <!-- Application Details -->
    <input type="hidden" name="appid" value="{{$appform->appid}}">  
    <input type="hidden" name="appform_areacode" value="{{$appform->areacode}}">  
    <input type="hidden" name="grp_id" value="3">   
        
    <div class="modal fade" id="changeContactDetails" tabindex="-1" aria-labelledby="changeContactDetailsModalLabel" aria-hidden="true">
        <div class="modal-dialog  modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="changeContactDetailsModalLabel">Health Facility Name and NHFR Code</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-info">
                        @php
                            try {
                                $areacode_1 = "";
                                $areacode_2 = "";
                                $areacode_3 = "";

                                if(!empty($appform->areacode))
                                {
                                    $areacode = json_decode($appform->areacode);
                                    $areacode_1 = $areacode[0];
                                    $areacode_2 = $areacode[1];
                                    $areacode_3 = $areacode[2];
                                }
                            } catch (Exception $e) {}                            
                        @endphp
                        <div class="form-group col-md-12">
                            <label class="text-left"><i class="fa fa-mobile"></i> Facility Mobile No.  <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="number" name="contact" class="form-control" placeholder="Facility Mobile No." value="{{$appform->contact}}" id="contact" required=""> 
                            </div>
                        </div>

                        <div class="form-group col-md-12">
                            <label class="text-left"><i class="fa fa-phone-square"></i> Facility Landline </label>
                            <div class="input-group">
                                <input type="number" name="areacode1" class="form-control col-md-3" placeholder="Area Code" value="{{$areacode_1}}"> 
                                <input type="number" name="landline" class="form-control col-md-9" placeholder="Facility Landline" value="{{$appform->landline}}" id="landline" > 
                            </div>
                        </div>

                        <div class="form-group col-md-12">
                            <label class="text-left"><i class="fa fa-fax"></i> Fax Number </label>
                            <div class="input-group">
                                <input type="number" name="areacode2" class="form-control col-md-3" placeholder="Area Code" value="{{$areacode_2}}"> 
                                <input type="number" name="faxnumber" class="form-control col-md-9" placeholder="Fax Number" value="{{$appform->faxnumber}}" id="faxnumber"> 
                            </div>
                        </div>

                        <div class="form-group col-md-12">
                            <label class="text-left"><i class="fa  fa-envelope"></i> Facility Email Address  <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="text" name="email" class="form-control" placeholder="Facility Email Address" value="{{$appform->email}}" id="email" required=""> 
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