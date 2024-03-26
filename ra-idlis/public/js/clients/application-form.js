const queryString = window.location.search;
const searchParams = new URLSearchParams(queryString);

$(function() {
    console.log("BASE: ", base_url);
    $("#institution_helper").tooltip();
    

    const appid = searchParams.get("appid");

    if(appid) {
        
        callApi('/api/application/fetch', { appid : appid }, 'POST').then(d => {
            const { provinces, cities, brgy, classification, subclass } = d.data;
            if(provinces.length) {
                provinces.map(province => {
                    $("#province").append(`<option value='${province.provid}' selected="selected">${province.provname}</option>`);
                });
                $("#province").removeAttr('disabled');
            }
            if(cities.length) {
                cities.map(c => {
                    $("#city_monicipality").append(`<option value='${c.cmid}'>${c.cmname}</option>`);
                });
                $("#city_monicipality").removeAttr('disabled');
            }
            if(brgy.length) {
                brgy.map(c => {
                    $("#brgy").append(`<option value='${c.brgyid}'>${c.brgyname}</option>`);
                });
                $("#brgy").removeAttr('disabled');
            }
            if(classification.length) {
                classification.map(c => {
                    $("#classification").append(`<option value='${c.classid}'>${c.classname}</option>`);
                });
                $('#classification').val(d.data.application.classid);
                $("#classification").removeAttr('disabled');
            }
            if(subclass.length) {
                subclass.map(c => {
                    $("#subclass").append(`<option value='${c.classid}'>${c.classname}</option>`);
                });
                $('#subclass').val(d.data.application.subClassid);
                $("#subclass").removeAttr('disabled');
            }
            $("#subclass").selectpicker('refresh');
            $("#classification").selectpicker('refresh');
            $("#brgy").selectpicker('refresh');
            $("#city_monicipality").selectpicker('refresh');
            $('#province').selectpicker('refresh');
            
            if(d.data.application) {
                const areacodes = JSON.parse(d.data.application.areacode);
                $('#typeOfApplication').val(d.data.application.hfser_id);
                $('#facility_name').val(d.data.application.facilityname);
                $('#region').val(d.data.application.rgnid);
                $('#province').val(d.data.application.provid);
                $('#city_monicipality').val(d.data.application.cmid);
                $('#brgy').val(d.data.application.brgyid);
                $('#street_num').val(d.data.application.street_number);
                $('#street_name').val(d.data.application.street_name);
                $('#zip').val(d.data.application.zipcode);
                $('#fac_mobile_number').val(d.data.application.contact);
                $('#areacode').val(areacodes[0]);
                $('#faxareacode').val(areacodes[1]);
                $('#prop_landline_areacode').val(areacodes[2]);
                $('#landline').val(d.data.application.landline);
                $('#faxNumber').val(d.data.application.faxnumber);
                $('#fac_email_address').val(d.data.application.email);
                $('#uid').val(d.data.application.uid);
                $('#cap_inv').val(d.data.application.cap_inv);
                $('#lot_area').val(d.data.application.lot_area);
                $('#noofbed').val(d.data.application.noofbed);
                $('#ocid').val(d.data.application.ocid);
                $('#classification').val(d.data.application.classid);
                $('#subClassid').val(d.data.application.subClassid);
                $('#facmode').val(d.data.application.facmode);
                $('#funcid').val(d.data.application.funcid);
                $('#owner').val(d.data.application.owner);
                $('#prop_mobile').val(d.data.application.ownerMobile);
                $('#prop_landline').val(d.data.application.ownerLandline);
                $('#prop_email').val(d.data.application.ownerEmail);
                $('#official_mail_address').val(d.data.application.mailingAddress);
                $('#approving_authority_pos').val(d.data.application.approvingauthoritypos);
                $('#approving_authority_name').val(d.data.application.approvingauthority);
                $("input[name=facid][value=" + d.data.application.facid + "]").prop('checked', true);
                $('.selectpicker').selectpicker('refresh');
                if(d.data.application.hfep_funded === 0) {
                    $('#hfep_funded').prop('checked', true)
                }
            }
            if(d.data.con_catchment) {
                let = con_catchment_total = 0;
                d.data.con_catchment.map(c => {
                    let typeWords = 'SECONDARY';

                    
                    if(c.type === "0") {
                        // Primary
                        typeWords = 'PRIMARY';
                    }
                    const row = `
                        <tr id="rowEntry${c.id}" class="${typeWords} itemRow" >
                            <td>
                                <button class="btn btn-danger btn-xs" onClick="removeProjectedPopulationRow(${c.id})">
                                    <i class="fa fa-times"></i>
                                </button>
                            </td>
                            <td>
                                ${typeWords}
                                <input type="hidden" name="type[]" value="${c.type}">
                            </td>
                            <td>
                                <input 
                                    type="text" 
                                    class="form-control" 
                                    name="location[]" 
                                    value="${c.location}"
                                    />
                            </td>
                            <td class="population_field">
                                <input 
                                    type="number" 
                                    class="form-control" 
                                    name="population[]" 
                                    class="population populationCount"
                                    data-id="${c.id}"
                                    value="${c.population}"
                                    onkeyup="calculateProjectedPopulationCost(this)"
                                />
                            </td>
                        </tr>
                    `;
                    $('#projected_populations').prepend(row);
                    calculateProjectedPopulationCost();
                })
            }
            if(d.data.con_hospital) {
                d.data.con_hospital.map(c => {
                    const entry = c.id;//$('#existing_hospitals tr').length;
                    const row = `
                        <tr id="rowEntryHospital${entry}" class="itemRow" >
                            <td>
                                <button class="btn btn-danger btn-xs" onClick="removeExistingHospitalRow(${entry})">
                                    <i class="fa fa-times"></i>
                                </button>
                            </td>
                            <td>
                                <input type="text"  class="form-control" name="facilitynames[]" value="${c.facilityname}"/>
                            </td>
                            <td>
                                <input type="text"  class="form-control" name="locations[]" value="${c.location1}"/>
                            </td>
                            <td>
                                <input type="text"  class="form-control" name="bedcapacities[]" value="${c.noofbed1}"/>
                            </td>
                            <td>
                                <select class="form-control" name="cat_hos[]">
                                    <option value="">Please select</option>
                                    <option value="H" ${c.cat_hos === 'H' ? 'selected' : ''}>Level 1 Hospital</option>  
                                    <option value="H2" ${c.cat_hos === 'H2' ? 'selected' : ''}>Level 2 Hospital</option>  
                                    <option value="H3" ${c.cat_hos === 'H3' ? 'selected' : ''}>Level 3 Hospital</option> 
                                </select>
                            </td>
                            <td>
                                <input type="text" class="form-control" name="license[]" value="${c.license}"/>
                            </td>
                            <td>
                                <input type="date" class="form-control" name="validity[]" value="${c.validity}">
                            </td>
                            <td>
                                <input type="date" class="form-control" name="date_operation[]" value="${c.date_operation}">
                            </td>
                            <td>
                                <textarea cols="4" class="form-control" name="remarks[]">${c.remarks}</textarea>
                            </td>
                        </tr>
                    `;
                    $('#existing_hospitals').prepend(row);
                })
            }
        })
    }
});

const fillForm = data => {

}
const savePartial = async (e) => {
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


    const facid = $('input[name="facid"]:checked').val();    
    const data = {
        appid:                  appid,
        hfser_id:               $('#typeOfApplication').val(),
        facilityname:           $('#facility_name').val(),
        rgnid:                  $('#region').val(),
        provid:                 $('#province').val(),
        cmid:                   $('#city_monicipality').val(),
        brgyid:                 $('#brgy').val(),
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
        classid:                $('#classification').val(),
        subClassid:             $('#subclass').val(),
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
        hfep_funded:            ($("#hfep_funded").is(":checked") ? 0 : null),
        draft:                  1,
        con_catch:              con_catch,
        con_hospital:           con_hospital
    }
    console.log(data)
    callApi('/api/application/save', data, 'POST').then(d => {
        const id = d.data.id;
        alert('Information now saved');
        // window.location.replace(`${base_url}/client/dashboard/new-application?appid=${id}`);
    }).then(error => {
        console.log(error);
    })
}
const setOfficialMailAddress = async (e) => {
    
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
        // if(!street_number) {
        //     isError = true;
        //     errMessage = errMessage + 'Street Number';
        // }
        if(!street_name) {
            if(isError) {
                errMessage = errMessage + ', Street Name';
            }
            else {
                isError = true;
                errMessage = errMessage + ' Street Name';
            }
        }
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
const fetchSubClass = async (e) => {
    const ocid = $("#ocid").val();
    const classid = $("#classification").val();
    if( e.value ) {
        const data = { 'ocid' : ocid, 'classid' : classid }
        callApi('/api/classification/fetch', data, 'POST').then(classification => {
            $("#subclass").empty();
            $("#subclass").append(`<option value=''>Please select</option>`);
            $("#subclass").removeAttr('disabled');
            classification.data.map(c => {
                $("#subclass").append(`<option value='${c.classid}'>${c.classname}</option>`);
            })
            $("#subclass").selectpicker('refresh')
        })
    }
    else {
        $("#subclass").addAttr('disabled')
    }
}
const fetchClassification = async (e) => {
    const ocid = $("#ocid").val();
    console.log('EYYY, ', ocid);
    if( ocid ) {
        const data = { 'ocid' : ocid }
        callApi('/api/classification/fetch', data, 'POST').then(classification => {
            $("#classification").empty();
            $("#classification").append(`<option value=''>Please select</option>`);
            $("#classification").removeAttr('disabled');
            classification.data.map(c => {
                $("#classification").append(`<option value='${c.classid}'>${c.classname}</option>`);
            })
            $("#classification").selectpicker('refresh')
        })

        

    }
    else {
        $("#classification").addAttr('disabled')
    }

    
}

const fetchBaranggay = async (e) => {
    const cmid = $("#city_monicipality").val();
    console.log("Received brgy")
    console.log('EYYY, ', cmid);
    if( cmid ) {
        const data = { 'cmid' : cmid }
        callApi('/api/barangay/fetch', data, 'POST').then(barangay => {
            $("#brgy").empty();
            $("#brgy").append(`<option value=''>Please select</option>`);
            $("#brgy").removeAttr('disabled');
            barangay.data.map(c => {
                
                $("#brgy").append(`<option value='${c.brgyid}'>${c.brgyname}</option>`);
            })
            $("#brgy").selectpicker('refresh')
        }).catch(err => {
            console.log(err);
        })
    }
    else {
        $("#brgy").addAttr('disabled')
    }
}

const fetchMonicipality = async (e) => {
    const provid = $("#province").val();
    console.log('EYYY, ', provid);
    if( provid ) {
        const data = { 'provid' : provid }
        callApi('/api/municipality/fetch', data, 'POST').then(city => {
            $("#city_monicipality").empty();
            $("#city_monicipality").append(`<option value=''>Please select</option>`);
            $("#city_monicipality").removeAttr('disabled');
            city.data.map(c => {
                $("#city_monicipality").append(`<option value='${c.cmid}'>${c.cmname}</option>`);
            })
            $("#city_monicipality").selectpicker('refresh')
        }).catch(err => {
            console.log(err);
        });
    }
    else {
        $("#city_monicipality").addAttr('disabled')
    }
}
const fetchProvince = async (e) => {
    const rgnid = $("#region").val() //.text()
    console.log('EYYY, ', rgnid);
    if( rgnid ) {
        const data = { 'rgnid' : rgnid }
        callApi('/api/province/fetch', data, 'POST').then(provinces => {
            localStorage.setItem('rgnid', rgnid)
            const localProvID = parseInt(localStorage.getItem('provid'))
            // console.log(localRgnID);
            $("#province").empty();
            $("#province").append(`<option value=''>Please select</option>`);
            $("#province").removeAttr('disabled');
            provinces.data.map(province => {
               
                $("#province").append(`<option value='${province.provid}' selected="selected">${province.provname}</option>`);
            })
            // console.log(localProvID)
            // $("#province").val(localProvID)
            $("#province").selectpicker('refresh')
        }).catch(err => {
            console.log(err);
        })
    }
    else {
        $("#province").addAttr('disabled')
    }
}
const checkFacilityName = async (e) => {
    const facilityname = $('#facility_name').val()
    console.log('EYYY, ', facilityname);
    if( facilityname ) {
        callApi('/api/application/validate-name/registered', {
        // callApi('/api/application/validate-name', {
            name: facilityname
        }, 'POST').then(ok => {

            if(ok.data.resp == "dontexist"){
                console .log("appdata")
            console.log(ok.data.message)
            localStorage.setItem('facilityname', facilityname)
            $("#facility_name").css('border', '1px solid green');
            $("#facility_name_feedback").removeClass('text-danger');
            $("#facility_name_feedback").addClass('text-success');
            $("#facility_name_feedback").html(ok.data.message);
        }else{
            var appdata = ok.data.appdata
            console .log("appdata")
            console .log(appdata)
            console .log("appdata")
            // alert(err.response.data.message)
            $("#facility_name").css('border', '1px solid red');
            $("#facility_name_feedback").removeClass('text-success');
            $("#facility_name_feedback").addClass('text-danger');
            $("#facility_name_feedback").html(err.response.data.message);
        }

        }).catch(err => {
            // var appdata = err.data.appdata
            // console .log(appdata)
            // // alert(err.response.data.message)
            // $("#facility_name").css('border', '1px solid red');
            // $("#facility_name_feedback").removeClass('text-success');
            // $("#facility_name_feedback").addClass('text-danger');
            // $("#facility_name_feedback").html(err.response.data.message);
        })
    }
    else {
        $("#facility_name").css('border', '1px solid red');
        $("#facility_name_feedback").removeClass('text-success');
        $("#facility_name_feedback").addClass('text-danger');
        $("#facility_name_feedback").html('Facility name is required');
    }
    
}

// const checkFacilityNameNew1 = async (e) => {
//     const facilityname = $('#facility_name').val()
//     console.log('EYYY, ', facilityname);
//     if( facilityname ) {
//         callApi('/api/application/validate-name/registered', {
//         // callApi('/api/application/validate-name', {
//             name: facilityname
//         }, 'POST').then(ok => {

//             if(ok.data.resp == "dontexist"){
//                 console .log("appdata")
//             console.log(ok.data.message)
//             localStorage.setItem('facilityname', facilityname)
//             $("#facility_name").css('border', '1px solid green');
//             $("#facility_name_feedback").removeClass('text-danger');
//             $("#facility_name_feedback").addClass('text-success');
//             $("#facility_name_feedback").html(ok.data.message);
//         }else{
//             var appdata = ok.data.appdata
//             console .log("appdata")
//             console .log(appdata)
//             console .log("appdata")
//             // alert(err.response.data.message)
//             $("#facility_name").css('border', '1px solid red');
//             $("#facility_name_feedback").removeClass('text-success');
//             $("#facility_name_feedback").addClass('text-danger');
//             $("#facility_name_feedback").html(err.response.data.message);
//         }

//         }).catch(err => {
//             // var appdata = err.data.appdata
//             // console .log(appdata)
//             // // alert(err.response.data.message)
//             // $("#facility_name").css('border', '1px solid red');
//             // $("#facility_name_feedback").removeClass('text-success');
//             // $("#facility_name_feedback").addClass('text-danger');
//             // $("#facility_name_feedback").html(err.response.data.message);
//         })
//     }
//     else {
//         $("#facility_name").css('border', '1px solid red');
//         $("#facility_name_feedback").removeClass('text-success');
//         $("#facility_name_feedback").addClass('text-danger');
//         $("#facility_name_feedback").html('Facility name is required');
//     }
    
// }
function callApi(url, data, method) {
    const config = {
        method: method,
        url: `${base_url}${url}`,
        headers: { 
          'Content-Type': 'application/json'
        },
        data : data
    };
    return axios(config)
};
const removeProjectedPopulationRow = (rowId) => {
    $(`#rowEntry${rowId}`).remove();
    calculateProjectedPopulationCost();

    calculatepop()
}
const removeExistingHospitalRow = (rowId) => {
    $(`#rowEntryHospital${rowId}`).remove();
}
function thousands_separators(num) {
    var num_parts = num.toString().split(".");
    num_parts[0] = num_parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    return num_parts.join(".");
}
const calculateProjectedPopulationCost = (e) => {

    const items = $('#projected_populations tr.itemRow')
    let total = 0;
    for(let i = 0;i < items.length; i++ ) {
        // console.log(items[i].id)
        // const popValue = $(`#rowEntry${items[i].id} td input.population`).val()
        // console.log(items[i].children[3].children[0].value)
        const value = items[i].children[3].children[0].value;
        // console.log(Number.isInteger(parseInt(value)))
        if( Number.isInteger(parseInt(value)) ) {
            console.log(value)
            total += parseFloat(value);
        }
    }
    $("#projectedPopulationCost").html(thousands_separators(total))
}
const addProjectedPopulation = () => {
    const entry = $('#projected_populations tr').length;
    const primary = $('#projected_populations tr.PRIMARY').length;
    let type = '1';
    let typeWords = 'SECONDARY';
    if(primary === 0) {
        // Primary
        type = '0';
        typeWords = 'PRIMARY';
    }
    const row = `
        <tr id="rowEntry${entry}" class="${typeWords} itemRow" >
            <td>
                <button class="btn btn-danger btn-xs" onClick="removeProjectedPopulationRow(${entry})">
                    <i class="fa fa-times"></i>
                </button>
            </td>
            <td>
                ${typeWords}
                <input type="hidden" name="type[]" value="${type}">
            </td>
            <td><input type="text" class="form-control locs" name="location[]" /></td>
            <td class="population_field">
                <input 
                    type="number" 
                    class="form-control pops" 
                    name="population[]" 
                    class="population populationCount"
                    data-id="${entry}"
                    onkeyup="calculatepop()"
                    min="1"
                   
                />
            </td>
        </tr>
    `;
    //  onkeyup="calculateProjectedPopulationCost(this)"
    $('#projected_populations').prepend(row);
}
const addListOfExistingHospitals = () => {
    const entry = $('#existing_hospitals tr').length;
    const row = `
        <tr id="rowEntryHospital${entry}" class="itemRow itmex" >
            <td>
                <button class="btn btn-danger btn-xs" onClick="removeExistingHospitalRow(${entry})">
                    <i class="fa fa-times"></i>
                </button>
            </td>
            <td >
                <input type="text" style="width: 200px !important;" class="form-control exfacn " name="facilitynames[]"/>
            </td>
            <td>
                <input type="text" style="width: 250px !important;"   class="form-control exloc" name="locations[]"/>
            </td>
            <td>
                <input type="text" style="width: 100px !important;"   class="form-control exbedcap" name="bedcapacities[]"/>
            </td>
            <td>
                <select style="width: 250px !important;"  class="form-control excat" name="cat_hos[]">
                    <option value="">Please select</option>
                    <option value="H">Level 1 Hospital</option>  
                    <option value="H2">Level 2 Hospital</option>  
                    <option value="H3">Level 3 Hospital</option> 
                </select>
            </td>
            <td>
                <input type="text" style="width: 150px !important;" class="form-control exlic" name="license[]" />
            </td>
            <td>
                <input type="date" class="form-control exval" name="validity[]">
            </td>
            <td>
                <input type="date" class="form-control exdatop" name="date_operation[]">
            </td>
            <td>
                <textarea cols="2"  style="width: 100px !important;" class="form-control exrem" name="remarks[]"></textarea>
            </td>
        </tr>
    `;
    $('#existing_hospitals').prepend(row);
}

