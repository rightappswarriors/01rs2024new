<div class="col-md-12 change-div"><b class="text-primary">APPLICATION</b></div>

@if(isset($appid))
    <div class="form-group col-md-6">
       
    </div>
    <div class="form-group col-md-6">
        <label>Application ID: <strong class="text-xl">{{$appid}}</strong></label>
    </div>
@endif

<div class="form-group col-md-6 change-div">
    <label for="approving_authority_pos">Application Type<span class="text-danger">*</span></label>
    <select class="form-control" id="aptidnew" name="aptidnew"  onchange="aptidnewOnChange()" disabled>
    
        <option value="IN" selected="selected" >Initial New</option>
        <option value="R">Renewal</option>
    </select>
</div>

<div class="form-group col-md-6 change-div">
    <label for="typeOfApplication">Type of Application <span class="text-danger">*</span></label>
    <?php $hfser_id = isset($appdata->hfser_id) ? $appdata->hfser_id : ''; ?>

    <div style="display: none;">
        <select class="form-control selectpicker show-menu-arrow" id="typeOfApplication" name="hfser_id" required data-live-search="true" data-style="text-dark form-control custom-selectpicker" data-size="5">
            <option>Please select</option>
            <option value="CON" {{ 'CON' == $hfser ? 'selected' : '' }}>Certificate of Need</option>
            <option value="PTC" {{ 'PTC' == $hfser ? 'selected' : '' }}>Permit to Construct</option>
            <option value="ATO" {{ 'ATO' == $hfser ? 'selected' : '' }}>Authority to Operate</option>
            <option value="COA" {{ 'COA' == $hfser ? 'selected' : '' }}>Certificate of Accreditation</option>
            <option value="LTO" {{ 'LTO' == $hfser ? 'selected' : '' }}>License to Operate</option>
            <option value="COR" {{ 'COR' == $hfser ? 'selected' : '' }}>Certificate of Registration</option>
        </select>
    </div>

    <div style="display: none;">
        @if ($hfser == 'CON')
        <?php $value = 'Certificate of Need' ?>
        @elseif ($hfser == 'PTC') {
        <?php $value = 'Permit to Construct' ?>
        }
        @elseif ($hfser == 'ATO') {
        <?php $value = 'Authority to Operate' ?>
        }
        @elseif ($hfser == 'COA') {
        <?php $value = 'Certificate of Accreditation' ?>
        }
        @elseif ($hfser == 'LTO') {
        <?php $value = 'License to Operate' ?>
        }
        @else
        <?php $value = 'Certificate of Registration' ?>
        @endif
    </div>

    <div class="input-group">        
        <input class="form-control" id="typeApp" type="text" value="{{ $value }}" readonly>
    </div>
</div>

@php $hiddenfield_renewal = "hidden"; @endphp

@if(array_key_exists('type', $_GET))  
    @if($_GET['type'] == "r")
    @php $hiddenfield_renewal = ""; @endphp 
    @endif 
@endif

<div id="div_license_number" class="form-group col-md-6 change-div">
    <label for="approving_authority_pos">Previous License/Accreditation Number   <span class="text-danger">*</span></label>
    <input class="form-control" name="license_number"  id="license_number"   type="text" value="{{isset($fAddress) && count($fAddress) > 0 ? $fAddress[0]->license_number : null}}"  required>
</div>

<div id="div_license_validity" class="form-group col-md-6 change-div"  >
    <label for="approving_authority_pos">Previous Validity Date  <span class="text-danger">*</span></label>
    <input class="form-control"  name="license_validity" id="license_validity"   type="date" value="{{isset($fAddress) && count($fAddress) > 0 ? $fAddress[0]->license_validity : null}}" required>
</div>


@if(app('request')->input('type') == 'rxr')
    <div class="form-group col-md-6 change-div">
        <label for="facilitycode">Facility Code</label>
        <input class="form-control" id="facilitycode" name="facilitycode" type="text" value="" required>
    </div>
    <div class="form-group col-md-6 change-div">
        <label for="year">Year</label>
        <input class="form-control" id="year" name="year" type="text" value="" required>
    </div>
@endif
<div class="form-group col-md-12 change-div">
    <label for="facility_name">Facility Name  <span class="text-danger">*</span></label>
    <div class="input-group">
        <input type="text" name="facilityname" class="form-control" placeholder="FACILITY NAME" 
        value="{{isset($fAddress) && count($fAddress) > 0 ? $fAddress[0]->facilityname : null}}" 
        id="facility_name" onblur="checkFacilityNameNew(this.value)" required> 
        <!-- <input type="text" name="facilityname" class="form-control" placeholder="FACILITY NAME" 
        value="{{isset($fAddress) && count($fAddress) > 0 ? $fAddress[0]->facilityname : null}}" 
        id="facility_name" onChange="checkFacilityName(this)" required> -->
        <div class="input-group-append" data-toggle="tooltip" data-placement="top" title="" data-original-title="Manually search existing Facility">
            <button class="btn btn-dark" type="button" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-search"></i></button>
        </div>
        <small id="facility_name_feedback" class="feedback"></small>
    </div>
</div>

<script>
    @if(app('request')->input('cont') == 'yes')

        setTimeout(function(){  
        //  document.getElementById("facility_name").disabled = true;
        //  document.getElementById("street_num").disabled = true;
        //  document.getElementById("street_name").disabled = true;
        //
        document.getElementById("zip").disabled = true;
        //   document.getElementById("noofbed").disabled = true; 
        }, 2000);
        //   $( document ).ready(function() {
        //     console.log("nkkk")
        //      $("#facility_name").attr("disabled", true);
        //      $("#street_num").attr("disabled", true);
        //      $("#street_name").attr("disabled", true);
        //      $("#street_name").attr("disabled", true);
        //      $("#zip").attr("disabled", true);
        //      $("#noofbed").attr("disabled", true);
        // });
    @endif
</script>



<script>
    function aptidnewOnChange() {
        var x = document.getElementById("aptidnew").value;
        document.getElementById("div_license_number").setAttribute("hidden", "hidden");
        document.getElementById("div_license_validity").setAttribute("hidden", "hidden");
        
        if(x == 'R')
        {
            document.getElementById("div_license_number").removeAttribute("hidden");
            document.getElementById("div_license_validity").removeAttribute("hidden");
        }

    }
</script>

