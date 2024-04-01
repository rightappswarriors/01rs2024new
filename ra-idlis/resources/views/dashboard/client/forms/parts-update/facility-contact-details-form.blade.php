
<form action="{{asset('/client1/changerequest/actionsubmit')}}" method="POST">
    {{ csrf_field() }}
    <!-- Application Details -->
    <input type="hidden" name="appid" id="appid" value="{{$appform->appid}}">   
        
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

                        <div class="form-group col-md-12">
                            <label class="text-left"><i class="fa fa-mobile"></i> Facility Mobile No. </label>
                            <div class="input-group">
                                <input type="text" name="landline" class="form-control" placeholder="Facility Mobile No." value="{{$appform->landline}}" id="nhfrcode"> 
                            </div>
                        </div>

                        <div class="form-group col-md-12">
                            <label class="text-left"><i class="fa fa-phone-square"></i> Facility Landline </label>
                            <div class="input-group">
                                <input type="text" name="landline" class="form-control" placeholder="Facility Landline" value="({{$appform->areacode}})  {{$appform->landline}}" id="facility_name" onblur="checkFacilityNameNew(this.value)" required=""> 
                            </div>
                        </div>

                        <div class="form-group col-md-12">
                            <label class="text-left"><i class="fa fa-fax"></i> Fax Number </label>
                            <div class="input-group">
                                <input type="text" name="landline" class="form-control" placeholder="Fax Number" value="({{$appform->areacode}})  {{$appform->landline}}" id="nhfrcode"> 
                            </div>
                        </div>

                        <div class="form-group col-md-12">
                            <label class="text-left"><i class="fa  fa-envelope"></i> Facility Email Address  </label>
                            <div class="input-group">
                                <input type="text" name="email" class="form-control" placeholder="Facility Email Address" value="{{$appform->email}}" id="facility_name" onblur="checkFacilityNameNew(this.value)" required=""> 
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