<div>
    <form >
        <input type="hidden" id="appid" >
        <br /><br />
        <i><b>This option is for renewal only</b></i>
        <br /><br />
        <span>Valid From</span><br />
        <input name="valid_from" type="date" class="form-control" id="valid_from"  />
        <br />
        <span>Valid To</span><br />
        <input name="valid_to" type="date" class="form-control" id="valid_to"  />
        <br />
        <span>Bed Capacity</span><br />
        <input name="bed_cap" type="text" class="form-control" id="bed_cap"  />
        <br />
        <span>Authorized Dialysis Station</span><br />
        <input name="dialysis_station" type="text" class="form-control" id="dialysis_station"  />
        <br />
        <center>
      
        @if($AppData->savedRenewalOpt == 0)
        <button type="button" onclick="subData()" class="btn">
            Save
        </button>
        @endif
        </center>
    </form>

    <script>
        function subData(e){

            const data ={
                _token: $("input[name=_token]").val(),
                id: $("input[id=appid]").val(),
                valid_from: $("input[name=valid_from]").val(),
                valid_to: $("input[name=valid_to]").val(),
                bed_cap: $("input[name=bed_cap]").val(),
                dialysis_station: $("input[name=dialysis_station]").val(),
            }

            console.log("data", data)
          
            if(confirm("Are you sure you want to udpate data?")){
                             $.ajax({
                                url: '{{asset('api/save/renewalopt')}}',
                                dataType: "json", 
                                async: false,
                                method: 'POST',
                                data: data,
                                success: function(a){
                                    var aler = "Failed to save data"
                                    if(a.status == "success"){
                                         aler = "Data successfully saved"
                                    }
                                    alert(aler)
                                    location.reload();
                                console.log("msg",a.msg)
                                console.log("stat",a.status)
                                    
                                }
                            });
              }
              }
    </script>
</div>