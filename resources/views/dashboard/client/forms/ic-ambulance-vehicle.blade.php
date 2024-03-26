<form  id="form_AmbulanceVehicle" action="{{asset('/client1/apply/change_request_submit')}}" method="POST">
    {{ csrf_field() }}
    <input type="hidden" name="cat_id" id="cat_id" value="2">
    <input type="hidden" name="uid" id="uid" value="{{$uid}}">
    <input type="hidden" name="appid" id="appid" value="{{$registered_facility->appid}}">         
    <input type="hidden" name="regfac_id" id="regfac_id" value="{{$registered_facility->regfac_id}}">     
    <input type="hidden" name="noofdialysis_old" id="noofdialysis_old" value="{{number_format($registered_facility->noofdialysis,0)}}"> 
        
    
    

    <div class="modal fade" id="changeAmbulanceVehicle" tabindex="-1" aria-labelledby="changeAmbulanceVehicleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="changeAmbulanceVehicleModalLabel">Increase / Decrease in Dialysis Station</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-info">
                    
                    
                    </div> 

                    {{-- LTO For Ambulance Details --}}
                    @include('dashboard.client.forms.parts.license-to-operate.for-ambulance-details')
                  



                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger action-btn" data-dismiss="modal">
                        <i class="fa fa-times" aria-hidden="true"></i>
                        No, Recheck details
                    </button>
                    <button class="btn btn-primary action-btn" type="submit">
                        <i class="fa fa-floppy-o" aria-hidden="true"></i> Confirm
                    </button>
                </div>
            </div>
        </div>
    </div>

</form>
