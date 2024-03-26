
<p>&nbsp;</p>
<div class="col-md-12 change-div"><b class="text-primary">FACILITY CONTACT DETAILS</b></div>
<div class="col-md-3 change-div">
    <label for="fac_mobile_number">Facility Mobile No. <span class="text-danger">*</span></label>
    <input 
        type="number" 
        class="form-control" 
        id="fac_mobile_number" 
        name="contact"
        placeholder="FACILITY MOBILE #"
        value='{{((isset($fAddress) && count($fAddress) > 0) ? $fAddress[0]->contact: null)}}'
        >

</div>
<div class="col-md-3 change-div">
    <label for="facility_landline">Facility Landline 
    <!-- <span class="text-danger">*</span> -->
    </label>
    <div class='form-group row'>
        <div class="col-xs-12 col-md-6 col-lg-5">
            <input 
            type="number"
                placeholder="Area code"
                name="areacode"
                id="areacode"
                required
                class="form-control" 
           
                />
        </div>
        <div class="col-xs-12 col-md-6 col-lg-7">
            <input 
                type="number"
                name="landline" 
                id="landline"
                placeholder="FACILITY LANDLINE"
                required
                class="form-control" 
                value='{{(isset($fAddress) && (count($fAddress) > 0) ? $fAddress[0]->landline: null)}}'
                />
        </div>
    </div>
</div>
<div class="col-md-3 change-div">
    <label for="fax">Fax Number 
    <!-- <span class="text-danger">*</span> -->
    </label>
    <div class="form-group row">
        <div class="col-xs-12 col-md-6 col-lg-5">
            <input 
                    type="number"
                    placeholder="Area code"
                    name="faxareacode"
                    id="faxareacode"
                    required
                    class="form-control" />
        </div>
        <div class="col-xs-12 col-md-6 col-lg-7">
            <input 
                type="number"
                name="faxNumber" 
                id="faxNumber"
                placeholder="FACILITY FAX #"
                required
                class="form-control" 
                value='{{(isset($fAddress) && (count($fAddress) > 0) ? $fAddress[0]->faxNumber: null)}}'
                />
        </div>
    </div>
</div>
<div class="col-md-3 change-div">
    <label for="fac_email_address">Facility Email Address <span class="text-danger">*</span></label>
    <input type="text" class="form-control" id="fac_email_address" name="email" placeholder="EMAIL"  value='{{(isset($fAddress) && (count($fAddress) > 0) ? $fAddress[0]->email: null)}}' >
</div>
        
<script>


</script>