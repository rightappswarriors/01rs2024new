

<div class=" hospClassif" hidden style="width: 100%;">

<div class="mb-2 col-md-12">&nbsp;</div>
    <div class="col-md-12 ">
        <b class="text-primary "> Classification of Hospital:
        </b>
    </div>

    <!-- <div class="col-md-12 showifHospital" >
    <select class="form-control" name="funcid" id="funcid">
        <option value="1">General</option>
        <option value="2">Speciality</option>
        <option value="3">Not Applicable</option>
    </select>
</div> -->

    <div class="col-md-12 ">
        <select onchange="sel_hosp_class(this.value)" class="form-control"  data-funcid="duplicate" id="funcid" name="funcid">
            <option  selected value hidden disabled>Please select</option>
            @isset($function)
                @foreach($function AS $each)
                    <option value="{{$each->funcid}}">{{$each->funcdesc}}</option>
                @endforeach
            @endisset
        </select>
    </div>
</div>