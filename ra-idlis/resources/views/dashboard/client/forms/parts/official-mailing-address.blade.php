<p>&nbsp;</p>
<div class="col-md-12 change-div"><b class="text-primary">Official Mailing Address</b><span class="text-danger">*</span></div>
<div class="col-md-12 change-div">
    <!-- <label for="official_mail_address">Official Mailing Address <span class="text-danger">*</span></label> -->
    <p>
        <label>
            <input name="mailingAddress" type="checkbox" id="isSameAsFacilityAddress" value="1" onChange="{{((isset($fAddress) && count($fAddress) > 0) ? 'setOfficialMailAddressUp(this)': 'setOfficialMailAddressNew(this)')}}"> Official Mailing address same as Facility Address? If no, please specify complete address</label>
            <!-- <input name="mailingAddress" type="checkbox" id="isSameAsFacilityAddress" value="1" onChange="{{((isset($fAddress) && count($fAddress) > 0) ? 'setOfficialMailAddressUp(this)': 'setOfficialMailAddress(this)')}}"> Official Mailing address same as Facility Address? If no, please specify complete address</label> -->
    </p>
    <input name="official_mail_address" type="text" class="form-control" id="official_mail_address" placeholder="Official Mailing Address" />
</div>
@if(isset($fAddress) && count($fAddress) > 0)
    <script>
        const setOfficialMailAddressUp = async (e) => {

            const isSame = $("#isSameAsFacilityAddress").prop('checked')
            console.log('EYYYY ', isSame)
            if (isSame) {
                street_number = $("#street_num").val();
                street_name = $("#street_name").val();
                brgy = $("#brgyU").val();
                city = $("#city_monicipalityU").val();
                prov = $("#provinceU").val();
                region = $("#regionU").val();
                let errMessage = 'Please fill up the following fields: ';
                let isError = false;
                
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
                } else {
                    var offmail = `${street_number} ${street_name} ${brgy} ${city} ${prov} ${region}`;
                    $("#official_mail_address").val(offmail.toUpperCase())
                }
            } else {
                $("#official_mail_address").val('')
            }

        }
   </script> 
@endif

<script>
    const setOfficialMailAddressNew = async (e) => {
        
        const isSame = $("#isSameAsFacilityAddress").prop('checked')
        console.log('EYYYY ', isSame) 
        if(isSame) {
            street_number = $("#street_num").val();
            street_name = $("#street_name").val();
            brgy = $("#brgy option:selected" ).text();
            city = $("#city_monicipality option:selected" ).text();
            prov = $("#province option:selected" ).text();
            region = $("#region option:selected" ).text();
            let errMessage = 'Please fill up the following fields: ';
            let isError = false;
            
            if(!brgy) {
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
            else {

                // $("#official_mail_address").val(`${street_number} ${street_name} ${brgy} ${city} ${prov} ${region}`)
                var offmail = `${street_number} ${street_name} ${brgy} ${city} ${prov} ${region}`;
                $("#official_mail_address").val(offmail.toUpperCase())        
            }
        }
        else {
            $("#official_mail_address").val('')
        }
    }
</script>