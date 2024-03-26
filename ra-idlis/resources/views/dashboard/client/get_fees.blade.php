<script>
    // getFees()

    window.addEventListener('change', function(e) {
        var name = e.target.name;
        var pls = "Please select";
        if (name == 'ocid' || name == 'facmode' || name == 'funcid') {
            if ($("#ocid").val() != pls && $("#facmode").val() != pls && $("#funcid").val() != pls) {
                getFees()
            }

        }


    });

    function getFees() {
        const desc = {
            _token: $("input[name=_token]").val(),
            ocid: $("#ocid").val(),
            facmode: $("#facmode").val(),
            funcid: $("#funcid").val(),
            facids: JSON.stringify(getFacs()) ,
        }


        console.log("desc")
        console.log(desc)
        console.log("facsss")
        console.log( getFacs())

        console.log("token")
        console.log($("input[name=_token]").val())

        $.ajax({
            url: "{{ asset('service/fees') }}",
            method: 'POST',
            data: desc,
            success: function(data) {

                console.log("data")
                console.log(data)


            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                console.log(errorThrown);
                $('#EditErrorAlert').show(100);
            },
        });


    }

    function getFacs() {
        var addons = getaddonsValues();
        var facids = getCheckedValue('facid');
        var anxsel = getCheckedValue('anxsel');

        let thisFacid = [];

        if (Array.isArray(facids)) {
            for (let i = 0; i < facids.length; i++) {
                // sArr.push('facid[]=' + facids[i]);
                thisFacid.push(facids[i]);
            }
        }

        if (anxsel.length > 0) {
            if (Array.isArray(anxsel)) {
                for (let i = 0; i < anxsel.length; i++) {
                    // sArr.push('facid[]=' + anxsel[i]);
                    thisFacid.push(anxsel[i]);
                }
            }
        }
        if (addons.length > 0) {
            if (Array.isArray(addons)) {
                for (let i = 0; i < addons.length; i++) {
                    // sArr.push('facid[]=' + addons[i]);
                    thisFacid.push(addons[i]);
                }
            }
        }

        return thisFacid;

    }
</script>