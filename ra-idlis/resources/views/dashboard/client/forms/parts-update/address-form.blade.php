
<form action="{{asset('/client1/changerequest/actionsubmit')}}" method="POST">
    {{ csrf_field() }}
    <!-- Application Details -->
    <input type="hidden" name="appid" id="appid" value="{{$appform->appid}}">
    <input type="hidden" name="assignedRgn" id="assignedRgn" >
        
    <div class="modal fade" id="changeAddress" tabindex="-1" aria-labelledby="changeAddressModalLabel" aria-hidden="true">
        <div class="modal-dialog  modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="changeAddressModalLabel">Facility Address</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    
                    <div class="row alert alert-info">

                        <div class="col-md-3">
                            <label class="text-left upd-text-title">Region <span class="text-danger">*</span>
                            </label>
                            <h6  class="text-center upd-text-info">{{$appform->rgn_desc}}</h6>
                        </div>
                        <div class="col-md-3">
                            <label class="text-left upd-text-title">Province/District <span class="text-danger">*</span>
                            </label>
                            <h6  class="text-center upd-text-info">{{$appform->provname}}</h6>
                        </div>
                        <div class="col-md-3">
                            <label class="text-left upd-text-title">City/Municipality <span class="text-danger">*</span>
                            </label>
                            <h6  class="text-center upd-text-info">{{$appform->cmname}}</h6>
                        </div>
                        <div class="col-md-3">
                            <label class="text-left upd-text-title">Barangay <span class="text-danger">*</span>
                            </label>
                            <h6  class="text-center upd-text-info">{{$appform->brgyname}}</h6>
                        </div>


                        <div class="col-md-3">
                            <label class="text-left upd-text-title">Street Number
                            </label>
                            <h6  class="text-center upd-text-info">{{$appform->street_number}}&nbsp;</h6>
                        </div>


                        <div class="col-md-6">
                            <label class="text-left upd-text-title">Street name
                            </label>
                            <h6  class="text-center upd-text-info">{{$appform->street_name}}&nbsp;</h6>
                        </div>


                        <div class="col-md-3">
                            <label class="text-left upd-text-title">Zip Code <span class="text-danger">*</span>
                            </label>
                            <h6  class="text-center upd-text-info">{{$appform->zipcode}}&nbsp;</h6>
                        </div>

                    </div>
                    
                    <hr />
                    <div class="row">
                        
                        <div class="col-md-3 change-div">
                        
                            <label for="region">Region<span class="text-danger">*</span></label>

                            <div id="region_org">
                                <select class="form-control selectpicker show-menu-arrow toRemove" data-rgid="reg" id="region" name="rgnid" required data-live-search="true" data-style="text-dark form-control custom-selectpicker" data-size="5" onChange="fetchProvince(this)">
                                    <option value="">Please select</option>
                                    @foreach( $regions as $region)
                                        @if($region->rgnid != 'HFSRB')
                                        <option value="{{$region->rgnid}}">{{$region->rgn_desc}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>

                            <div id="region_ex" hidden>
                                <input class="form-control "  id="regionU" name="rgnidU" value="@if(isset($fAddress) && count($fAddress) > 0) {{$fAddress[0]->rgn_desc}} @endif"  disabled />
                            </div>    
                        </div>

                        <div class="col-md-3 change-div">
                            <label for="province">Province/District <span class="text-danger">*</span></label>
                            <div id="prov_org">
                                <select class="form-control selectpicker show-menu-arrow toRemove" value='{{((isset($fAddress) && count($fAddress) > 0) ? $fAddress[0]->provid: null)}}' id="province"  disabled name="provid" required data-live-search="true" data-style="text-dark form-control custom-selectpicker" data-size="5" onChange="fetchMonicipality(this)">
                                    <option value="">Please select</option>
                                </select>
                            </div>
                            <div id="prov_ex" hidden>
                                <input class="form-control "  id="provinceU" name="providU" value="@if(isset($fAddress) && count($fAddress) > 0) {{$fAddress[0]->provname}} @endif"  disabled />
                            </div>
                        </div>

                        <div class="col-md-3 change-div">
                            <label for="city_monicipality">City/Municipality <span class="text-danger">*</span></label>
                            <div id="cm_org">
                                <select class="form-control  selectpicker show-menu-arrow toRemove" value='{{((isset($fAddress) && count($fAddress) > 0) ? $fAddress[0]->cmid: null)}}' id="city_monicipality" disabled name="cmid" required data-live-search="true" data-style="text-dark form-control custom-selectpicker" data-size="5" onChange="fetchBaranggay(this)">
                                    <option value="">Please select</option>
                                </select>
                            </div>
                            <div id="cm_ex" hidden>
                                <input class="form-control "  id="city_monicipalityU" name="cmidU" value="@if(isset($fAddress) && count($fAddress) > 0) {{$fAddress[0]->cmname}} @endif"   disabled />
                            </div>
                        </div>

                        <div class="col-md-3 change-div">
                            <label for="brgy">Barangay<span class="text-danger">*</span></label>
                            <div id="br_org">
                                <select class="form-control selectpicker show-menu-arrow toRemove" value='{{((isset($fAddress) && count($fAddress) > 0) ? $fAddress[0]->brgyid: null)}}' id="brgy" disabled name="brgyid" data-live-search="true" data-style="text-dark form-control custom-selectpicker" data-size="5" required>
                                    <option value="">Please select</option>
                                </select>
                            </div>
                            <div id="br_ex" hidden>
                                <input class="form-control "  id="brgyU" name="brgyidU" value="@if(isset($fAddress) && count($fAddress) > 0) {{$fAddress[0]->brgyname}} @endif"  disabled />
                            </div>
                        </div>

                        <div class="mb-2 col-md-12 change-div">&nbsp;</div>
                        <div class="col-md-4 change-div">
                            <label for="street_num">Street Number </label>
                            <input type="text" class="form-control" id="street_num" name="street_number"placeholder="STREET NUMBER" value='{{((isset($fAddress) && count($fAddress) > 0) ? $fAddress[0]->street_number: null)}}'>
                        </div>

                        <div class="col-md-4 change-div">
                            <label for="street_name">Street name</label>
                            <input type="text" class="form-control" id="street_name" name="street_name" placeholder="STREET NAME" value='{{(( isset($fAddress) && count($fAddress) > 0) ? $fAddress[0]->street_name: null)}}' >
                        </div>

                        <div class="col-md-4 change-div">
                            <label for="zip">Zip Code <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="zip" name="zipcode" required placeholder="ZIP CODE" value='{{((isset($fAddress) && count($fAddress) > 0) ? $fAddress[0]->zipcode: null)}}'  >
                            <small><span class="text-danger">NOTE: </span>for reference, please follow this <a href="https://zip-codes.philsite.net/" target="_blank">link</a></small>
                        </div>

                        <script>
                            var fs =  document.getElementById("facid")

                            if(fs){
                                fs.value = $('#region').val() == undefined ? '{!!((count($fAddress) > 0) ? $fAddress[0]->rgnid: "")!!}' : $('#region').val()
                            }

                            window.addEventListener('click', function(e) {
                                var facs =  document.getElementsByName('facid');
                                var hgpid =  document.getElementsByName('hgpid');
                                var ass =  document.getElementById("assignedRgn")
                                console.log(ass.value)

                                setTimeout(function(){
                                    
                                    if(facs){
                                        
                                        if(facs.length > 0){
                                            for( i = 0; i < facs.length; i++ ) {
                                                //   console.log("exist facid")
                                                    if( facs[i].checked ) {
                                                
                                                        if(facs[i].value == 'H2' || facs[i].value == 'H3'){
                                                            ass.value = 'hfsrb';
                                                            //   console.log('facs' + facs[i].value)
                                                            
                                                        }else{
                                                            ass.value = $('#region').val() == undefined ? '{!!((count($fAddress) > 0) ? $fAddress[0]->rgnid: "")!!}' : $('#region').val()
                                                        }                                            
                                                    }
                                                }
                                        }else{
                                            ass.value = $('#region').val() == undefined ? '{!!((count($fAddress) > 0) ? $fAddress[0]->rgnid: "")!!}' : $('#region').val()
                                        }
                                    }

                                    if(hgpid){
                                        
                                        if(hgpid.length > 0){
                                            for( i = 0; i < hgpid.length; i++ ) {
                                                //   console.log("exist facid")
                                                    if( hgpid[i].checked ) {
                                                
                                                        if(hgpid[i].value == '1' || hgpid[i].value == '9' || hgpid[i].value == '5' || hgpid[i].value == '12'){
                                                            ass.value = 'hfsrb';
                                                            //   console.log('hgpid' + hgpid[i].value)
                                                            
                                                        }else if(hgpid[i].value == '6'){
                                                                    if(facs.length > 0){
                                                                        for( var a = 0; a < facs.length; a++ ) {
                                                                        // console.log("exist facid")
                                                                            if( facs[a].checked ) {
                                                                        
                                                                                if(facs[a].value == 'H2' || facs[a].value == 'H3'){
                                                                                    ass.value = 'hfsrb';
                                                                                    // console.log('facs' + facs[a].value)                                                    
                                                                                }                                                            
                                                                            }
                                                                        }
                                                                    }else{
                                                                        ass.value = $('#region').val() == undefined ? '{!!((count($fAddress) > 0) ? $fAddress[0]->rgnid: "")!!}' : $('#region').val()
                                                                    }
                                                        }else{
                                                            ass.value = $('#region').val() == undefined ? '{!!((count($fAddress) > 0) ? $fAddress[0]->rgnid: "")!!}' : $('#region').val()
                                                        }                                            
                                                    }
                                                }
                                        } else {
                                            ass.value = $('#region').val() == undefined ? '{!!((count($fAddress) > 0) ? $fAddress[0]->rgnid: "")!!}' : $('#region').val()
                                        }
                                    }

                            }, 1000);
                            setTimeout(function(){
                                    console.log("assignedRgn")
                                    console.log($('#assignedRgn').val())        
                            }, 2000);
                            
                            });

                            setTimeout(function(){
                                //    console.log("assignedRgn")
                                //    console.log($('#assignedRgn').val())
                            }, 2000);

                        </script>



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