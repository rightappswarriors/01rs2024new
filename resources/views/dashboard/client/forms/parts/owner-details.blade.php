<p>&nbsp;</p>
<div class="col-md-12 change-div"><b class="text-primary">OWNER DETAILS</b></div>
<div class="col-md-12 change-div">
    <label for="owner">OWNER <span class="text-danger">*</span></label>
   @php 
    $di = '';

    if(($hfser == 'LTO' && app('request')->input('cont') == 'yes')){
        $di = 'disabled';
    }
   @endphp

    <input {{$di}}    type="text"     class="form-control"    id="owner"  name="owner"  placeholder="OWNER (Name/Company/Organization)"  value="{{$nameofcomp}}" >
</div>
<div class="col-md-12 change-div">
    <div class="mb-3 mt-3 alert alert-warning">
        For Sole-proprietorship,
        <ul class="list-unstyled" style="font-size: small">
            <li>
                Name of the owner must be the same as your DTI-Business Name Registration
            </li>
        </ul>

        For Partnership and Corporation,
        <ul class="list-unstyled" style="font-size: small">
            <li>
                Name of the owner must be the same as your SEC Registration
            </li>
        </ul>

        For Cooperative,
        <ul class="list-unstyled" style="font-size: small">
            <li>
                Name of the owner must be the same as your Cooperative Development Authority Registration
            </li>
        </ul>
        
        For Government Facilities,
        <ul class="list-unstyled" style="font-size: small">
            <li>
                Please refer to your Enabling Act/Board Resolution
            </li>
        </ul>
        
    </div>
</div>