<form id="form_ptcoptions" method="POST" class="row">
    {{ csrf_field() }}
    <input type="hidden" name="appid" value="{{$appform->appid}}"> 
    <input type="hidden" name="grp_id" value="13">                  

    <div class="modal fade" id="changePTCOptions" tabindex="-1" aria-labelledby="changePTCOptionsModalLabel" aria-hidden="true">
        <div class="modal-dialog  modal-lg">
            <div class="modal-content" style=" background-color: #272b30; color: white;">
                <div class="modal-header">
                    <h5 class="modal-title" id="changePTCOptionsModalLabel">PTC Info Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-justify" style=" background-color: #272b30; color: white;">

                    <div class="row">        
                        
                        <div class="col-md-12">
                            <label>Scope of Works <span class="text-danger">*</span></label>
                            <textarea class="form-control" rows="2" cols="60" name="construction_description" id="construction_description" placeholder="Scope of Works" spellcheck="false"></textarea>
                        </div>
                            
                        <div class="col-md-12" id="noDal">
                            <label>No. of Dialysis Station <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="noofdialysis" name="noofdialysis" placeholder="No. of dialysis station">
                        </div>    
                        
                        <div class="col-md-12" id="NSB">
                            <br>
                            <label>Number of Single Bed <span class="text-danger">*</span></label>
                            <h3 id="singlebedview" hidden=""></h3>
                            <input class="form-control" type="number" name="singlebed" id="singlebed" placeholder="Number of Single Bed" >
                        </div>
                        
                        <div class="col-md-12" id="NDD">
                            <br>
                            <label>Number of Double Deck <span class="text-danger">*</span></label>
                            <h3 id="doubledeckview" hidden=""></h3>
                            <input class="form-control" type="number" name="doubledeck" id="doubledeck" placeholder="Number of Double Deck">
                        </div>  

                        <div class="col-md-12" id="NPtc">
                            <br>
                            <label>Proposed Number of Beds <span class="text-danger">*</span></label>
                            <h3 id="propbedcapview" hidden=""></h3>
                            <input class="form-control" type="number" name="propbedcap" id="propbedcap" placeholder="Proposed Number of Beds">
                        </div>

                        <div class="col-md-12" id="RPtc">

                            <div class="othersReqrenew" id="othersReqrenew" style="display: block;">
                                <label>Options</label>
                                <select name="renoOption" id="renoOption" class="form-control" style="margin-bottom: 20px;" >
                                    <option value="0" readonly="" hidden="" disabled="" selected="">Please select</option>
                                    <option value="1">Increase in Bed Capacity</option>
                                    <option value="2">Increase Dialysis Station</option>
                                    <option value="3">Change in Ownership</option>
                                    <option value="4">Upgrading of level of hospital</option>
                                    <option value="5">Upgrading of clinical Lab in hospital</option>
                                    <option value="6">Upgrading of clinical Lab in MFOWS</option>
                                    <option value="7">Others, Please specify in the scope of works</option>
                                </select>

                                <label>Increase Bed Capacity From</label>
                                <input style="margin-bottom: 20px;" type="number" class="form-control" name="incbedcapfrom" id="incbedcapfrom" placeholder="Increase Bed Capacity From">

                                <label>Increase Bed Capacity To</label>
                                <input style="margin-bottom: 20px;" type="number" class="form-control" name="incbedcapto" id="incbedcapto" placeholder="Increase Bed Capacity To">
                            </div>
                            
                            <div class="dialysisReqrenew" id="dialysisReqrenew" hidden="hidden">
                                <label>Increase Dialysis Station From</label>
                                <input style="margin-bottom: 20px;" type="number" class="form-control" name="incstationfrom" id="incstationfrom" placeholder="Increase Dialysis Station From">

                                <br>
                                <label>Increase Dialysis Station To</label>
                                <input style="margin-bottom: 20px;" type="number" class="form-control" name="incstationto" id="incstationto" placeholder="Increase Dialysis Station To">
                            </div>
                            
                            <div>
                                <label>LTO Number</label>
                                <input style="margin-bottom: 20px;" type="text" class="form-control" name="ltonum" id="ltonum" placeholder="LTO Number" >
                                
                                <label>CON Number</label>
                                <input style="margin-bottom: 20px;" type="text" class="form-control" name="connum" id="connum" placeholder="CON Number" >
                            </div>

                        </div>
                                                    
                        <div class="col-md-12 con-number"><b class="text-primary">CON Number</b></div>
                        <div class="col-md-12 con-number">
                            <input type="text" class="form-control" id="connumber" name="connumber" placeholder="CON Number" >
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
                