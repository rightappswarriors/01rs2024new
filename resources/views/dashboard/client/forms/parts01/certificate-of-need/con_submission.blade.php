<script>

const savePartialCon = async (e) => {
    console.log("brgy")
    console.log($('#brgy').val())

        var errors = 0;
        var ermsg = " ";
        var errorPar = 0;
        var ermsgP = " ";
        var invalids = 0;
        var invmssg = " ";

       if($('#facility_name').val() == ""){errorPar +=1;  errors +=1; ermsgP+= "\nFacility Name, "; ermsg += "\nFacility Name, "}

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
        if($('#zip').val() == ""){errors +=1; ermsg += "\nZip Code, "}

        if($('#fac_mobile_number').val() == ""){errors +=1; ermsg += "\nFacility Mobile No., "}
        // if($('#areacode').val() == ""){errors +=1; ermsg += "Facility Landline Area code, "}
        // if($('#landline').val() == ""){errors +=1; ermsg += "Facility Landline, "}
        // if($('#faxareacode').val() == ""){errors +=1; ermsg += "Fax Area code, "}
        // if($('#faxNumber').val() == ""){errors +=1; ermsg += "Fax Number, "}
        if($('#fac_email_address').val() == ""){errors +=1; ermsg += "\nFacility Email, "}
        if($('#ocid').val() == "Please select"){errors +=1; ermsg += "\nOwnership, "}

        // Disregard if update
        if($('#classification').val() == "Please select"){errorPar +=1; errors +=1; ermsgP+= "\nClassification, "; ermsg += "\nClassification, "}
        // if($('#subclass').val() == "Please select"){errorPar +=1; errors +=1; ermsgP+= "\nSub Classification, "; ermsg += "\nSub Classification, "}
        // Disregard if update

        if($('#facmode').val() == "Please select"){errors +=1; ermsg += "\nInstitutional Character, "}
        if($('#funcid').val() == "Please select"){errors +=1; ermsg += "\nFunction, "}
      
        if($('#owner').val() == ""){errors +=1; ermsg += "\nOwner, "}
        if($('#prop_mobile').val() == ""){errors +=1; ermsg += "\nProponent Mobile, "}
        // if($('#prop_landline_areacode').val() == ""){errors +=1; ermsg += "Proponent Landline Areacode, "}
        // if($('#prop_landline').val() == ""){errors +=1; ermsg += "Proponent Landline, "}
        if($('#prop_email').val() == ""){errors +=1; ermsg += "\nProponent Email, "}
        if($('#official_mail_address').val() == ""){errors +=1; ermsg += "\nOfficial Mailing Address, "}
        if($('#approving_authority_pos').val() == ""){errors +=1; ermsg += "\nApproving Authority Position, "}
        if($('#approving_authority_name').val() == ""){errors +=1; ermsg += "\nApproving Authority Name, "}
        
      
        if($('input[name="facid"]:checked').val() == undefined){errors +=1; ermsg += "\nFacilities/Type, "}
        
        if($('#fac_email_address').val() != ""){
            var check = checkEmailValidity($('#fac_email_address').val()) 
           if(check == false){
             invalids +=1;   invmssg += "\nInvalid Facility Email Address, "
           } 
        }
        if($('#prop_email').val() != ""){
            var check = checkEmailValidity($('#prop_email').val()) 
           if(check == false){
             invalids +=1;   invmssg += "\nInvalid Proponent Email Address, "
           } 
        }
        
        if($('#fac_mobile_number').val() != ""){
            var check = checkNumberlValidity($('#fac_mobile_number').val()) 
           if(check == false){
             invalids +=1;   invmssg += "\nInvalid Facility Mobile Number, "
           } 
        }

        if($('#prop_mobile').val() != ""){
            var check = checkNumberlValidity($('#prop_mobile').val()) 
           if(check == false){
             invalids +=1;   invmssg += "\nInvalid Proponent Mobile Number, "
           } 
        }

        if($('#noofbed').val() == "" ||  $('#noofbed').val() <= 0 ){errors +=1; ermsg += "\nProposed bed capacity must not be 0 or empty,"}        

        const types = $("input[name='type[]']");
        const pops = document.getElementsByClassName("pops") ;
        const locs = document.getElementsByClassName("locs") ;
        if(types.length <= 0){
            errors +=1; ermsg += "\nPlease add catchment area,"
        }
        // console.log("pooops")
        // console.log(pops)

        var nopop = 0;
        for(var p = 0; p < pops.length; p++ ){
            console.log("popval")
                console.log(pops[p].value)
            if(pops[p].value == null ||pops[p].value == undefined ||pops[p].value == "" || !pops[p].value || pops[p].value <= 0){
                nopop += 1;
                console.log("nopop")
                console.log(nopop)
            }

            // if($('.pops').get(p).val() == ""){
            //     console.log("popval")
            //     console.log(pops[p].value)
            //     nopop += 1;
            //     console.log(nopop)
            // }

        }
        console.log(nopop)
        if(nopop > 0){
            errors +=1; ermsg += "\nIncomplete/Invalid Projected Population,"
        }
        
        var nolocs = 0;
        for(var p = 0; p < locs.length; p++ ){
            console.log("popval")
                console.log(locs[p].value)
            if(locs[p].value == null ||locs[p].value == undefined ||locs[p].value == "" || !locs[p].value){
                nolocs += 1;
            }
        }
        
        if(nolocs > 0){
            errors +=1; ermsg += "\nIncomplete catchment locations,"
        } 

        const exlocs = document.getElementsByClassName("itmex") ;
        console.log(exlocs.length)

        if(exlocs.length > 0)
        {
            const exfacn = document.getElementsByClassName("exfacn") ;
            const exloc = document.getElementsByClassName("exloc") ;
            const exbedcap = document.getElementsByClassName("exbedcap") ;
            const excat = document.getElementsByClassName("excat") ;
            const exlic = document.getElementsByClassName("exlic") ;
            const exval = document.getElementsByClassName("exval") ;
            const exdatop = document.getElementsByClassName("exdatop") ;

            if(exfacn,exloc,exbedcap,excat,exlic,exval,exdatop)
            {
                for(var xi = 0 ; xi < exlocs.length; xi++)
                {
                    if(
                        (exfacn[xi].value == null || exfacn[xi].value== undefined || exfacn[xi].value == "" || !exfacn[xi].value) ||
                        (exloc[xi].value == null || exloc[xi].value== undefined || exloc[xi].value == "" || !exloc[xi].value) ||
                        (exbedcap[xi].value == null || exbedcap[xi].value== undefined || exbedcap[xi].value == "" || !exbedcap[xi].value) ||
                        (excat[xi].value == null || excat[xi].value== undefined || excat[xi].value == "" || !excat[xi].value) ||
                        (exlic[xi].value == null || exlic[xi].value== undefined || exlic[xi].value == "" || !exlic[xi].value) ||
                        (exval[xi].value == null || exval[xi].value== undefined || exval[xi].value == "" || !exval[xi].value) ||
                        (exdatop[xi].value == null || exdatop[xi].value== undefined || exdatop[xi].value == "" || !exdatop[xi].value) 
                    ){
                        errors +=1; ermsg += "\nIncomplete existing hospital details,"
                    }
                }
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
                 console.log("errors1")
                 console.log(errors)
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
        // aptid:                  $('#aptid').val(),
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
        // facid:                  facid,
        owner:                  $('#owner').val(),
        ownerMobile:            $('#prop_mobile').val(),
        ownerLandline:          $('#prop_landline').val(),
        ownerEmail:             $('#prop_email').val(),
        mailingAddress:         $('#official_mail_address').val(),
        approvingauthoritypos:  $('#approving_authority_pos').val(),
        approvingauthority:     $('#approving_authority_name').val(),
        hfep_funded:            ($('#hfep').prop('checked') ? 0 : null),
        draft:                  1,
        con_catch:               JSON.stringify(con_catch),
        con_hospital:           JSON.stringify(con_hospital),
        facid:                  JSON.stringify(allFacids),
        remarks:             $('#remarks').val(),
        hgpid:                  6,
        // hgpid:                  $('input[name="hgpid"]:checked').val(),
        assignedRgn:             $('#assignedRgn').val(),//6-3-2021
        appchargenew:             $('#tempAppChargenew').val(),//appchargetemp
        appcharge:             $('#tempAppCharge').val(),//appchargetemp
        hfser: "CON",
        appchargenew:             $('#tempAppChargenew').val(),//appchargetemp
        appchargeHgpnew:             $('#tempAppChargeHgpidnew').val(),//appchargetemp
        // aptid: "IN"
        status: "FSR"
    }
    console.log(data)

    callApi('/api/application/con/save', data, 'POST').then(d => {
        const id = d.data.id;
    console.log("Application Form ");
        console.log(d.data.applicaiton)
             if(e == "final"){
                if(id){
                    
                window.location.href="{{asset('client1/apply/attachment/CON')}}/"+ id
                }
            
            }else{
                alert('Information now saved');
            }
        // alert('Information now saved');
        // window.location.replace(`${base_url}/client/dashboard/new-application?appid=${id}`);
       
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

function getCheckedValue(groupName) {
              var radios;
              if (groupName == "anxsel") {
                     radios = document.getElementsByClassName(groupName);
              } else {
                     radios = document.getElementsByName(groupName);
              }


              var rad = []
              for (i = 0; i < radios.length; i++) {
                     if (radios[i].checked) {
                            rad.push(radios[i].value);

                     }
              }
              return rad;
       }


</script>