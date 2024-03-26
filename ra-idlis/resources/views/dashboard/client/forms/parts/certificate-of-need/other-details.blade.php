<div class="mb-2 col-md-12">&nbsp;</div>
<div class="row col-md-12">
    <div class="col-md-6">
        <div class="col-md-12"><b class="text-primary">OTHER DETAILS</b></div>
    </div>
    <!-- <div class="col-md-6">
        <label class="text-primary">
            <input type="checkbox" name="hfep_funded"  id="hfep_funded"/> HFEP Funded
        </label>
    </div> -->
</div>
<div class="col-md-4">
    <label for="cap_inv">Capital Investment <span class="text-danger">*</span></label>
    <div class="input-group">
        <div class="input-group-addon p-2">₱</div>
        <input type="number" class="form-control" id="cap_inv" placeholder="Capital Investment" name="cap_inv" required>
    </div>
</div>
<div class="col-md-4">
    <label for="cap_inv">Lot Area (by square meters) <span class="text-danger">*</span></label>
    <input type="number" class="form-control" id="lot_area" name="lot_area" placeholder="Lot Area" required>
</div>
<div class="col-md-4">
    <label for="cap_inv">Proposed Bed Capacity <span class="text-danger">*</span></label>
    <input type="number" onchange="suggestPtc(this.value)" class="form-control" id="noofbed" name="noofbed" placeholder="Proposed Bed Capacity">
</div>

<script>
function suggestPtc(value){
    console.log("Recieved bedcap")
    var ocid = document.getElementById("ocid").value;
console.log(ocid)
    if(ocid == 'P'){
        if(value > 99){
            alert("100 and above beds are encourage to directly apply to PTC, Please lower Proposed beds or proceed to PTC");
        }
    }else if(ocid == 'Please select'){
        alert("Please select ownership")
    }
}
</script>