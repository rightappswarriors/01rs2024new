<script>

const savePartialAto = async (e) => {
        var errors = 0;
        var ermsg = " ";
        var errorPar = 0;
        var ermsgP = " ";

        var invalids = 0;
        var invmssg = " ";

        if($('#aptidnew').val() == "R"){

            if($('#license_number').val() == ""){errorPar +=1;  errors +=1; ermsgP+= "\nPrevious License Number, "; ermsg += "\nPrevious License Number, "}
            if($('#license_validity').val() == ""){errorPar +=1;  errors +=1; ermsgP+= "\nPrevious License Validity Date, "; ermsg += "\nPrevious License Validity Date, "}
        }

       if($('#facility_name').val() == ""){errorPar +=1;  errors +=1; ermsgP+= "Facility Name, "; ermsg += "Facility Name, "}

        // Disregard if update
        @if(count($fAddress) > 0) 
            if($('#region').val() == "Please select"){errorPar +=1; errors +=1; ermsgP += "Region, "; ermsg += "Region, "}
            if($('#province').val() == "Please select"){errorPar +=1; errors +=1; ermsgP+= "Province, "; ermsg += "Province, "}
            if($('#city_monicipality').val() == "Please select"){errorPar +=1; errors +=1; ermsgP+= "Municipality, "; ermsg += "Municipality, "}
            if($('#brgy').val() == "Please select"){errorPar +=1; errors +=1; ermsgP+= "Baranggay, "; ermsg += "Baranggay, "}
        @else
            if($('#region').val() == ""){errorPar +=1; errors +=1; ermsgP += "Region, "; ermsg += "Region, "}
            if($('#province').val() == ""){errorPar +=1; errors +=1; ermsgP+= "Province, "; ermsg += "Province, "}
            if($('#city_monicipality').val() == ""){errorPar +=1; errors +=1; ermsgP+= "Municipality, "; ermsg += "Municipality, "}
            if($('#brgy').val() == ""){errorPar +=1; errors +=1; ermsgP+= "Baranggay, "; ermsg += "Baranggay, "}
        @endif
         // Disregard if update

        // if($('#street_name').val() == ""){errors +=1; ermsg += "Street Name, "}
        if($('#zip').val() == ""){errors +=1; ermsg += "Zip Code, "}

        if($('#fac_mobile_number').val() == ""){errors +=1; ermsg += "Facility Mobile No., "}
        // if($('#areacode').val() == ""){errors +=1; ermsg += "Facility Landline Area code, "}
        // if($('#landline').val() == ""){errors +=1; ermsg += "Facility Landline, "}
        // if($('#faxareacode').val() == ""){errors +=1; ermsg += "Fax Area code, "}
        // if($('#faxNumber').val() == ""){errors +=1; ermsg += "Fax Number, "}
        if($('#fac_email_address').val() == ""){errors +=1; ermsg += "Facility Email, "}
        if($('#ocid').val() == "Please select"){errors +=1; ermsg += "Ownership, "}

        // Disregard if update
        if($('#classification').val() == "Please select"){errorPar +=1; errors +=1; ermsgP+= "Classification, "; ermsg += "Classification, "}
        // if($('#subclass').val() == "Please select"){errorPar +=1; errors +=1; ermsgP+= "Sub Classification, "; ermsg += "Sub Classification, "}
        // Disregard if update

        if($('#facmode').val() == "Please select"){errors +=1; ermsg += "Institutional Character, "}
        if($('#funcid').val() == "Please select"){errors +=1; ermsg += "Function, "}
      
        if($('#owner').val() == ""){errors +=1; ermsg += "Owner, "}
        if($('#prop_mobile').val() == ""){errors +=1; ermsg += "Proponent Mobile, "}
        // if($('#prop_landline_areacode').val() == ""){errors +=1; ermsg += "Proponent Landline Areacode, "}
        // if($('#prop_landline').val() == ""){errors +=1; ermsg += "Proponent Landline, "}
        if($('#prop_email').val() == ""){errors +=1; ermsg += "Proponent Email, "}
        if($('#official_mail_address').val() == ""){errors +=1; ermsg += "Official Mailing Address, "}
        if($('#approving_authority_pos').val() == ""){errors +=1; ermsg += "Approving Authority Position, "}
        if($('#approving_authority_name').val() == ""){errors +=1; ermsg += "Approving Authority Name, "}
        
      
        if($('input[name="hgpid"]:checked').val() == undefined){errors +=1; ermsg += "Facilities/Type, "}
        
        if($('#fac_email_address').val() != ""){
            var check = checkEmailValidity($('#fac_email_address').val()) 
           if(check == false){
             invalids +=1;   invmssg += "Invalid Facility Email Address, "
           } 
        }
        if($('#prop_email').val() != ""){
            var check = checkEmailValidity($('#prop_email').val()) 
           if(check == false){
             invalids +=1;   invmssg += "Invalid Proponent Email Address, "
           } 
        }
        
        if($('#fac_mobile_number').val() != ""){
            var check = checkNumberlValidity($('#fac_mobile_number').val()) 
           if(check == false){
             invalids +=1;   invmssg += "Invalid Facility Mobile Number, "
           } 
        }

        if($('#prop_mobile').val() != ""){
            var check = checkNumberlValidity($('#prop_mobile').val()) 
           if(check == false){
             invalids +=1;   invmssg += "Invalid Proponent Mobile Number, "
           } 
        }

        // if(errors > 0){
        //     alert("Please fill the following fields properly: " + ermsg)
        // }else{
        //     console.log("errors")
        //     console.log(errors)
        //     submitProper(e)
        // }
        if(e == 'final'){
            if(errors > 0){
                alert("Please fill the following fields properly: " + ermsg)
            }else{
                // console.log("errors")
                // console.log(errors)
                if(invalids > 0){
                    alert(invmssg)
                }else{
                    submitProper(e)
                }
            }
         }else{
            if(errorPar > 0){
                alert("Please fill the following required initial fields properly: " + ermsgP)
            }else{
                if(invalids > 0){
                    alert(invmssg)
                }else{
                    submitProper(e)
                }
            }
         }
}

function submitProper (e){
    console.log("Saving Partial Form");
    const appid         = searchParams.get("appid");
    const types         = $("input[name='type[]']");
    const locations     = $("input[name='location[]'");
    const population    = $("input[name='population[]'");
    const con_catch     = [];

    const facilitynames     = $("input[name='facilitynames[]']");
    const loc               = $("input[name='locations[]']");
    const bedcapacities     = $("input[name='bedcapacities[]']");
    const cat_hos           = $("select[name='cat_hos[]']");
    const license           = $("input[name='license[]']");
    const validity          = $("input[name='validity[]']");
    const date_operation    = $("input[name='date_operation[]']");
    const remarks           = $("textarea[name='remarks[]']");

    const con_hospital  = [];
    for(let i  = 0; i < facilitynames.length; i++ ) {
        const con_hosp_data = {
            appid:          appid,
            facilityname:   facilitynames[i].value,
            location1:      loc[i].value,
            cat_hos:        cat_hos[i].value,
            noofbed1:       bedcapacities[i].value,
            license:        license[i].value,
            validity:       validity[i].value,
            date_operation: date_operation[i].value,
            remarks:        remarks[i].value
        }
        con_hospital.push(con_hosp_data)
    }
    console.log(con_hospital);

    for(let i  = 0; i < types.length; i++ ) {
        const con_catch_data = {
            appid:          appid,
            type:           types[i].value,
            location:       locations[i].value,
            population:     population[i].value,
            isfrombackend:  null
        }
        con_catch.push(con_catch_data)
    }

    var allFacids = getAllFacids();

    const facid = $('input[name="facid"]:checked').val();    
    const data = {
        saveas:                  e == 'update' ? 'final' : e,
        aptid:                  $('#aptidnew').val(),
        appid:                  $('#appid').val(),
        hfser_id:               $('#typeOfApplication').val(),
        facilityname:           $('#facility_name').val(),
        rgnid:                  $('#region').val() == undefined ? '{!!((count($fAddress) > 0) ? $fAddress[0]->rgnid: "")!!}' : $('#region').val(),
        provid:                 $('#province').val() == undefined ? '{!!((count($fAddress) > 0) ? $fAddress[0]->provid: "")!!}' : $('#province').val(),
        cmid:                   $('#city_monicipality').val() == undefined ? '{!!((count($fAddress) > 0) ? $fAddress[0]->cmid: "")!!}' : $('#city_monicipality').val(),
        brgyid:                 $('#brgy').val() == undefined ? '{!!((count($fAddress) > 0) ? $fAddress[0]->brgyid: "")!!}' : $('#brgy').val(),
        street_number:          $('#street_num').val(),
        street_name:            $('#street_name').val(),
        zipcode:                $('#zip').val(),
        contact:                $('#fac_mobile_number').val(),
        areacode:               `["${$('#areacode').val()}", "${$('#faxareacode').val()}", "${$('#prop_landline_areacode').val()}"]`,
        landline:               $('#landline').val(),
        faxnumber:              $('#faxNumber').val(),
        email:                  $('#fac_email_address').val(),
        uid:                    $("#uid").val(),
        cap_inv:                $('#cap_inv').val(),
        lot_area:               $('#lot_area').val(),
        noofbed:                $('#noofbed').val(),
        ocid:                   $('#ocid').val(),
        classid:                $('#classification').val()  == undefined ? '{!!((count($fAddress) > 0) ? $fAddress[0]->classid: "")!!}' : $('#classification').val() ,
        subClassid:             $('#subclass').val()  == "" ||  $('#subclass').val() == undefined ? '{!!((count($fAddress) > 0) ? $fAddress[0]->subClassid: "")!!}' : $('#subclass').val(),
        facmode:                $('#facmode').val(),
        funcid:                 $('#funcid').val(),
        facid:                  facid,
        owner:                  $('#owner').val(),
        ownerMobile:            $('#prop_mobile').val(),
        ownerLandline:          $('#prop_landline').val(),
        ownerEmail:             $('#prop_email').val(),
        mailingAddress:         $('#official_mail_address').val(),
        approvingauthoritypos:  $('#approving_authority_pos').val(),
        approvingauthority:     $('#approving_authority_name').val(),
        hfep_funded:            ($('#hfep').prop('checked') ? 0 : null),
        draft:                  1,
        con_catch:              con_catch,
        con_hospital:           con_hospital,
        facid:                  JSON.stringify(allFacids),
        hgpid:                  $('input[name="hgpid"]:checked').val(),
        appchargenew:             $('#tempAppChargenew').val(),//appchargetemp
        appcharge:             $('#tempAppCharge').val(),//appchargetemp
        appchargeHgp:             $('#tempAppChargeHgpid').val(),//appchargetemp
        assignedRgn:             $('#assignedRgn').val(),//6-3-2021
        hfser: "ATO",
        remarks:             $('#remarks').val(),
        appchargenew:             $('#tempAppChargenew').val(),//appchargetemp
        appchargeHgpnew:             $('#tempAppChargeHgpidnew').val(),//appchargetemp

        license_number:         null,
        license_validity:       null,
        head_of_facility_name:             $('#head_of_facility_name').val(),        
        // aptid: "IN"
    }

    if(data.aptid == "R")
    {
        data.license_number = $('#license_number').val();
        data.license_validity = $('#license_validity').val();
    }

    console.log(data)
    callApi('/api/application/ato/save', data, 'POST').then(d => {
     const id = d.data.id;
             if(e == "final"){
                if(id){
                    
                window.location.href="{{asset('client1/apply/attachment/ATO')}}/"+ id
                }
            
            }else{
                alert('Information now saved');
            }
    }).then(error => {
        console.log(error);
    })
}

function getAllFacids (){
   

    var listfacids = getCheckedValue('facid') 

    let thisFacid = []

    if(listfacids.length > 0){
        if(Array.isArray(listfacids)) {
						for(let i = 0; i < listfacids.length; i++) {
					  		// sArr.push('facid[]='+listfacids[i]); 
                            if(listfacids[i] != ""){
					  		thisFacid.push(listfacids[i]);
                            }
						} 
					}
    }
   
    return thisFacid
   
}

function checkEmailValidity(email) 
{
 if (/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email))
  {
    return (true)
  }
    return (false)
}

function checkNumberlValidity(number) 
{
 if (/^(09|\+639)\d{9}$/.test(number))
  {
    return (true)
  }
    return (false)
}

</script>