<div class="mb-2 col-md-12">&nbsp;</div>

<div class="col-md-12">
    <b class="text-primary">Option:
        <span class="text-danger">*</span>
    </b>
</div>

{{-- Scape of Works --}}
<div class="col-md-12">
    <label>
        Scope of Works
        <span class="text-danger">*</span>
    </label>
    <textarea class="form-control" rows="2" cols="60" name="construction_description" id="construction_description" placeholder="Scope of Works"></textarea>
</div>

{{-- Proposed Bed Capacity --}}


<!-- <div class="col-md-12"> -->
<div class="col-md-12" id="NSB" hidden>
<br/>
    <label>
        Number of Single Bed
        <span class="text-danger">*</span>
    </label>
    <p>
        <h3  id="singlebedview" hidden></h3>
    </p>
    <input class="form-control" type="number" name="singlebed" id="singlebed" placeholder="Number of Single Bed" />
</div>
<div class="col-md-12" id="NDD" hidden>
<br/>
    <label>
        Number of Double Deck
        <span class="text-danger">*</span>
    </label>
    <p>
        <h3  id="doubledeckview" hidden></h3>
    </p>
    <input class="form-control" type="number" name="doubledeck" id="doubledeck" placeholder="Number of Double Deck" />
</div>    
<div class="col-md-12" id="NPtc" hidden>
<br/>
    <label>
        Proposed Number of Beds
        <span class="text-danger">*</span>
    </label>
    <p>
        <h3  id="propbedcapview" hidden></h3>
    </p>
    <input class="form-control" type="number" name="propbedcap" id="propbedcap" placeholder="Proposed Number of Beds" />
</div>
<br/>
<div class="col-md-12" id="RPtc" hidden>
    <div class="othersReqrenew" id="othersReqrenew"style="display: block;" hidden>
    <label>Options</label>
        <select name="renoOption" id="renoOption" class="form-control" style="margin-bottom: 20px;">
            <option value="0" readonly hidden disabled selected>Please select</option>
            <option value="1">Increase in Bed Capacity</option>
            <option value="2">Increase Dialysis Station</option>
            <option value="3">Change in Ownership</option>
            <option value="4">Upgrading of level of hospital</option>
            <option value="5">Upgrading of clinical Lab in hospital</option>
            <option value="6">Upgrading of clinical Lab in MFOWS</option>
            <option value="7">Others, Please specify in the scope of works</option>
        </select>
        <label>Increase Bed Capacity From</label>
        <input style="margin-bottom: 20px;" type="number" class="form-control" name="incbedcapfrom" id="incbedcapfrom" placeholder="Increase Bed Capacity From">
         <label>Increase Bed Capacity To</label>
        <input style="margin-bottom: 20px;" type="number" class="form-control" name="incbedcapto" id="incbedcapto" placeholder="Increase Bed Capacity To">
    </div>
    {{-- dialysis --}}
    <div class="dialysisReqrenew" id="dialysisReqrenew"hidden >
        <label>Increase Dialysis Station From</label>
        <input style="margin-bottom: 20px;" type="number" class="form-control" name="incstationfrom" id="incstationfrom" placeholder="Increase Dialysis Station From">
         <label>Increase Dialysis Station To</label>
        <input style="margin-bottom: 20px;" type="number" class="form-control" name="incstationto" id="incstationto" placeholder="Increase Dialysis Station To">
    </div>
    {{-- general --}}
    <div>
        <label>LTO Number</label>
        <input style="margin-bottom: 20px;" type="text" class="form-control" name="ltonum" id="ltonum" placeholder="LTO Number">
        <p>CON Number</p>
        <input style="margin-bottom: 20px;" type="text" class="form-control" name="connum" id="connum" placeholder="CON Number">
    </div>
</div>