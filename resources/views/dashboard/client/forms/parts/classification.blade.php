<p>&nbsp;</p>
<div class="row col-md-12 change-div">
    <hr />
    <div class="col-md-6">

        <b class="text-primary">CLASSIFICATION ACCORDING TO</b>
    </div>
    <div class="col-md-6">
        <label class="text-danger">
            <input type="checkbox" name="hfep" id="hfep" value="1"> HFEP Funded</label>
    </div>
</div>
<div class="col-md-4 change-div">
    <label for="ownership">Ownership <span class="text-danger">*</span></label>

    <select class="form-control show-menu-arrow" id="ocid"  name="ocid"  data-style="text-dark form-control custom-selectpicker" data-size="5" required onChange="fetchClassification(this)" {{ app('request')->input('cont') == 'yes'? '' : '' }}>
    <!-- <select class="form-control selectpicker show-menu-arrow" id="ocid" name="ocid" data-live-search="true" data-style="text-dark form-control custom-selectpicker" data-size="5" required onChange="fetchClassification(this)"> -->
        <option>Please select</option>
        <option  value="G">Government</option>
        <option  value="P">Private</option>
    </select>
</div>
<div class="col-md-4 change-div">
    <label for="classification">Classification <span class="text-danger">*</span></label>
    <!-- if(isset($fAddress) && count($fAddress) > 0)
    <input class="form-control "  value="$fAddress[0]->classname" disabled />
    
    else -->
    <select class="form-control  show-menu-arrow toRemove" id="classification" value='{{((isset($fAddress) && count($fAddress) > 0) ? $fAddress[0]->classid: null)}}' disabled name="classid"  data-style="text-dark form-control custom-selectpicker" data-size="5" required onChange="fetchSubClass(this)" {{ app('request')->input('cont') == 'yes'? '' : '' }} >
    <!-- <select class="form-control selectpicker show-menu-arrow toRemove" id="classification" value='{{((isset($fAddress) && count($fAddress) > 0) ? $fAddress[0]->classid: null)}}' disabled name="classid" data-live-search="true" data-style="text-dark form-control custom-selectpicker" data-size="5" required onChange="fetchSubClass(this)"> -->
        <option>Please select</option>
    </select>
    <!-- endif -->
</div>
<div class="col-md-4 change-div">
    <label for="subclass">Sub Classification</label>
    <!-- <label for="subclass">Sub Classification <span class="text-danger">*</span></label> -->
    <!-- if(isset($fAddress) && count($fAddress) > 0)
    <input class="form-control " name="subClassid" id="subclass"  disabled  />
    else -->
    <select class="form-control  show-menu-arrow toRemove" onchange="getFacServCharge()" id="subclass" disabled value='{{((isset($fAddress) && count($fAddress) > 0) ? $fAddress[0]->subClassid: null)}}'name="subClassid" data-style="text-dark form-control custom-selectpicker" data-size="5" required {{ app('request')->input('cont') == 'yes'? '' : '' }}>
    <!-- <select class="form-control selectpicker show-menu-arrow toRemove" onchange="getFacServCharge()" id="subclass" disabled value='{{((isset($fAddress) && count($fAddress) > 0) ? $fAddress[0]->subClassid: null)}}'name="subClassid" data-live-search="true" data-style="text-dark form-control custom-selectpicker" data-size="5" required> -->
        <option>Please select</option>
    </select>
    <!-- endif -->
</div>
<div class="mb-2 col-md-12 change-div">&nbsp;</div>
<div class="col-md-6 change-div">
    <label for="facmode">Institutional Character <span class="text-danger">*</span></label>
    <div class="row">
        <div class="col-lg-10 col-md-10 col-xs-10">
            <select class="form-control  show-menu-arrow" id="facmode" name="facmode" data-live-search="true" data-style="text-dark form-control custom-selectpicker" data-size="5" required {{ app('request')->input('cont') == 'yes'? '' : '' }}>
            <!-- <select class="form-control selectpicker show-menu-arrow" id="facmode" name="facmode" data-live-search="true" data-style="text-dark form-control custom-selectpicker" data-size="5" required> -->
                <option>Please select</option>
                <option value="2">Free Standing</option>
                <option value="4">Institution Based</option>
            </select>
        </div>
    </div>
</div>
<div class="col-md-6 change-div">
    <label for="funcid">Function <span class="text-danger">*</span></label>
    <select class="form-control  show-menu-arrow" data-funcid="main" id="funcid" name="funcid" data-live-search="true" data-style="text-dark form-control custom-selectpicker" data-size="5" required {{ app('request')->input('cont') == 'yes'? '' : '' }}>
    <!-- <select class="form-control selectpicker show-menu-arrow" data-funcid="main" id="funcid" name="funcid" data-live-search="true" data-style="text-dark form-control custom-selectpicker" data-size="5" required> -->
        <option>Please select</option>
        <option value="1">General</option>
        @if($hfser != 'CON')
        <option value="2">Specialty</option>
        @endif
        <option value="3">Not Applicable</option>
    </select>
</div>