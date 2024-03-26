<script>
    const queryString1 = window.location.search;
    const urlParams = new URLSearchParams(queryString1);

    const apptype = urlParams.get('type')
    const grplo = urlParams.get('grplo')
   

    if (apptype == 'r') {
        renewalFees()
        
        //removeFreeStanding()
    } 

    if(grplo == 'rlo'){
        setTimeout(function() {
            replicateAmbu()
            renFeeProcess();
            }
        , 5000);
    }



    //  get initials 


    function renewalFees() {
        document.getElementById("aptidnew").value = 'R';
    }

    window.addEventListener('change', function(e) {

        // replicateAmbu()

        setTimeout(function() {
            replicateAmbu()
            renFeeProcess();
            }
        , 2000);

    });

    function renFeeProcess(){
        
        // var service_type = document.getElementById("typeOfApplication")?.value;
        var ocid = document.getElementsByName("ocid")[0].value;
        var facmode = document.getElementsByName("facmode")[0].value;
        var funcid = document.getElementsByName("funcid")[0].value;
        var service_ids = getCheckedValueAns('facid').concat(getCheckedValueAns('anxsel'))
        // var service_ids = getCheckedValue('facid').concat(getCheckedValue('anxsel'))
        var category = getCategory()

        const data = {
            ocid: ocid,
            facmode: facmode,
            funcid: funcid,
            type: 'service',
            service_id: JSON.stringify(service_ids),
            category: JSON.stringify(category)
        }

     

        // console.log("service_types", service_ids)
        // console.log("send data", data)

        if (ocid != "Please select" && facmode != "Please select" && funcid != "Please select") {
            sendData(data)
        }

    }

    function getCheckedValueAns(groupName) {

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

    function getCategory() {
        var radios = document.getElementsByName('hgpid');

        var rad = []
        for (i = 0; i < radios.length; i++) {
            if (radios[i].checked) {
                rad.push(radios[i].value);

            }
        }
        return rad;
    }

    function sendData(data) {
        $.ajax({
            url: base_url + '/api/newfee/service/fee',
            method: 'POST',
            data: data,
            success: function(data) {
                console.log("data response", data)

                const subclass = $('#subclass').val() == "" || $('#subclass').val() == undefined ? '{!!((count($fAddress) > 0) ? $fAddress[0]->subClassid: "")!!}' : $('#subclass').val(); //appchargetemp
                displayFees(data.service_fee, subclass)
                displayFeesCat(data.category, subclass)
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                console.log(errorThrown);
                $('#EditErrorAlert').show(100);
            }
        });
    }

    function displayFees(data, subclass) {
        let serv_chg = document.getElementById('serv_chgN');
        serv_chg.innerHTML = ' '
        var ta = []; //appchargetemp

        console.log("services fee", data)
        data.map((dt, index) => {
            var amt = (apptype == 'r' ? dt.renewal_amount : (apptype == 'ic' ? dt.initial_change_amount : dt.initial_new_amount))
            amt = subclass == "ND" ? 0 : amt;
            ta.push({
                reference: dt.facname,
                amount: amt,
                type: 'service',
                service_id: dt.service_id
            }) //appcharge
            serv_chg.innerHTML += '<tr><td>' + dt.facname + '</td><td>&#8369;&nbsp;<span>' + (parseInt(amt)).toFixed(2)
                // numberWithCommas(subclass == "ND" ? 0 : (parseInt(amt)).toFixed(2))
                +
                '</span></td></tr>';
        })

        console.log("ta services", ta)

        document.getElementById('tempAppChargeHgpidnew').value = JSON.stringify(ta) //appchargetemp
        // document.getElementById('tempAppChargeHgpidnew').value = JSON.stringify(getUnique(ta,'chgapp_id'))//appchargetemp

        // tempAppChargeHgpidnew

    }

    function displayFeesCat(data, subclass) {
        let serv_chg = document.getElementById('not_serv_chgN');
        serv_chg.innerHTML = ' '
        var ta = []; //appchargetemp

        console.log("data display", data)

        data.map((dt, index) => {
            var amt = (apptype == 'r' ? dt.renewal_amount : (apptype == 'ic' ? dt.initial_change_amount : dt.initial_new_amount))
            amt = subclass == "ND" ? 0 : amt;
            ta.push({
                reference: dt.hgpdesc,
                amount: amt,
                type: 'category',
                service_id: dt.service_id
            }) //appcharge
            // ta.push({reference : dt.hgpdesc,amount: amt, chgapp_id:  distinctArr[i]['chgapp_id'] }) //appcharge
            serv_chg.innerHTML += '<tr><td>' + dt.hgpdesc + '</td><td>&#8369;&nbsp;<span>' + (parseInt(amt)).toFixed(2)
                // numberWithCommas(subclass == "ND" ? 0 : (parseInt(amt)).toFixed(2))
                +
                '</span></td></tr>';
        })

        console.log("ta cats", ta)

        // document.getElementById('tempAppChargenew').value = JSON.stringify(getUnique(ta,'chgapp_id'))//appchargetemp
        document.getElementById('tempAppChargenew').value = JSON.stringify(ta) //appchargetemp

    }

    function replicateAmbu() {
        let serv_chg_not = document.getElementById('serv_chg_not');
        let serv_chg_notN = document.getElementById('serv_chg_notN');
        
        if(serv_chg_notN && serv_chg_not){
            serv_chg_notN.innerHTML = serv_chg_not.innerHTML;
        }

    }

    function removeFreeStanding() {
        $("#facmode option[value='2']").remove();
    }
</script>