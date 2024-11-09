
<form method="POST">
    {{ csrf_field() }}
    <!-- Application Details -->
    <input type="hidden" name="appid" value="{{$appform->appid}}">   
    <input type="hidden" name="appform_areacode" value="{{$appform->areacode}}">  
    <input type="hidden" name="grp_id" value="5">   
        
    <div class="modal fade" id="changeOwner" tabindex="-1" aria-labelledby="changeOwnerModalLabel" aria-hidden="true">
        <div class="modal-dialog  modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="changeOwnerModalLabel">Health Facility Name and NHFR Code</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-info">
                    @php                    
                            $areacode_1 = "";
                            $areacode_2 = "";
                            $areacode_3 = "";

                            try {

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
                        <label for="facility_name">Owner Name <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <input type="text" name="owner" class="form-control" placeholder="OWNER NAME" value="{{$appform->owner}}" required="" id="owner"> 
                        </div>
                    </div>

                    <div class="form-group col-md-12">
                        <label for="facility_name">Proponent/Owner Mobile No. </label>
                        <div class="input-group">
                            <input type="number" name="ownerMobile" class="form-control" placeholder="Proponent/Owner Mobile No." value="{{$appform->ownerMobile}}" id="ownerMobile"> 
                        </div>
                    </div>
                    
                    <div class="form-group col-md-12">
                        <label for="facility_name">Proponent/Owner Landline </label>
                        <div class="input-group">
                            <input type="number" name="areacode3" class="form-control col-md-3" placeholder="Area Code" value="{{$areacode_3}}"> 
                            <input type="number" name="ownerLandline" class="form-control col-md-9" placeholder="Proponent/Owner Landline" value="{{$appform->ownerLandline}}" id="ownerLandline"> 
                        </div>
                    </div>
                    
                    <div class="form-group col-md-12">
                        <label for="facility_name">Proponent/Owner Email Address </label>
                        <div class="input-group">
                            <input type="text" name="ownerEmail" class="form-control" placeholder="Proponent/Owner Email Address" value="{{$appform->ownerEmail}}" id="ownerEmail"> 
                        </div>
                    </div>
                    
                    <div class="form-group col-md-12">
                        <label for="facility_name">Official Mailing Address </label>
                        <label>
                            <input name="mailingAddress" type="checkbox" id="isSameAsFacilityAddress" value="1" onChange="
                            {{(     isset($appform->mailingAddress) ? 'setOfficialMailAddressUp1(this)': 'setOfficialMailAddressNew1(this)'   )}}"> Official Mailing address same as Facility Address? If no, please specify complete address
                        </label>           
                        <div class="input-group">
                            <input type="text" name="mailingAddress" class="form-control" placeholder="Official Mailing Address" value="{{$appform->mailingAddress}}" id="mailingAddress">
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

@if(isset($appform->mailingAddress))
    <script>
        const setOfficialMailAddressUp1 = async (e) => {

            const isSame = $("#isSameAsFacilityAddress").prop('checked')
            console.log('EYYYY ', isSame)
            if (isSame) {
                /*street_number = $("#street_number_txt").val();
                street_name = $("#street_name_txt").val();
                brgy = $("#brgyid_name").val();
                city = $("#cmid_name").val();
                prov = $("#provid_name").val();
                region = $("#rgnid_name").val();*/
                let errMessage = 'Please fill up the following fields: ';
                let isError = false;
                /*
                if (!street_name) {
                    if (isError) {
                        errMessage = errMessage + ', Street Name';
                    } else {
                        isError = true;
                        errMessage = errMessage + ' Street Name';
                    }
                }
                if (!brgy) {
                    if (isError) {
                        errMessage = errMessage + ', Barangay';
                    } else {
                        isError = true;
                        errMessage = errMessage + ' Barangay';
                    }
                }
                if (!city) {
                    if (isError) {
                        errMessage = errMessage + ', City/Municipality';
                    } else {
                        isError = true;
                        errMessage = errMessage + ' City/Municipality';
                    }
                }
                if (!prov) {
                    if (isError) {
                        errMessage = errMessage + ', Province';
                    } else {
                        isError = true;
                        errMessage = errMessage + ' Province';
                    }
                }
                if (!region) {
                    if (isError) {
                        errMessage = errMessage + ', Region';
                    } else {
                        isError = true;
                        errMessage = errMessage + ' Region';
                    }
                }
                if (isError) {
                    $("#official_mail_address").val('')
                    $("#isSameAsFacilityAddress").prop('checked', false)
                    alert(errMessage);
                } else { */
                    var offmail = 'Test'; //`${street_number} ${street_name} ${brgy} ${city} ${prov} ${region}`;
                    $("#official_mail_address").val(offmail.toUpperCase())
               // }
            } else {
                $("#official_mail_address").val('')
            }

        }
   </script> 
@endif


<script>
    const setOfficialMailAddressNew1 = async (e) => {
        
        const isSame = $("#isSameAsFacilityAddress").prop('checked')
        console.log('EYYYY ', isSame) 
        if(isSame) {
            street_number = $("#street_number_txt").val();
            street_name = $("#street_name_txt").val();
            brgy = $("#brgyid_name").val();
            city = $("#cmid_name").val();
            prov = $("#provid_name").val();
            region = $("#rgnid_name").val();
            let errMessage = 'Please fill up the following fields: ';
            let isError = false;
            
            /*if(!brgy) {
                if(isError) {
                    errMessage = errMessage + ', Barangay';
                }
                else {
                    isError = true;
                    errMessage = errMessage + ' Barangay';
                }
            }
            if(!city) {
                if(isError) {
                    errMessage = errMessage + ', City/Municipality';
                }
                else {
                    isError = true;
                    errMessage = errMessage + ' City/Municipality';
                }
            } 
            if(!prov) {
                if(isError) {
                    errMessage = errMessage + ', Province';
                }
                else {
                    isError = true;
                    errMessage = errMessage + ' Province';
                }
            }
            if(!region) {
                if(isError) {
                    errMessage = errMessage + ', Region';
                }
                else {
                    isError = true;
                    errMessage = errMessage + ' Region';
                }
            }
            if(isError) {
                $("#official_mail_address").val('')
                $("#isSameAsFacilityAddress").prop('checked', false)
                alert(errMessage);
            }
            else { */

                // $("#official_mail_address").val(`${street_number} ${street_name} ${brgy} ${city} ${prov} ${region}`)
                var offmail = `${street_number} ${street_name} ${brgy} ${city} ${prov} ${region}`;
                $("#official_mail_address").val(offmail.toUpperCase())        
            //}
        }
        else {
            $("#official_mail_address").val('')
        }
    }
</script>