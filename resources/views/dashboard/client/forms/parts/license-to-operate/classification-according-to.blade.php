<!-- <div class="mb-2 col-md-12">
    <hr />
    &nbsp;
</div>
<div class="row" style="padding-left: 15px; padding-right: 15px">
    <div class="col-md-6">
        <b class="text-primary">Classfication According to:
        </b>
    </div>
    <div class="col-md-6">
        <label class="text-danger">
            <input type="checkbox" name="hfep" id="hfep" value="1"> HFEP Funded</label>
    </div>
</div>


<div class="row" style="padding-left: 15px; padding-right: 15px">
    {{-- Ownership --}}
    <div class="col-md-4">
        <label>Ownership
            <span class="text-danger">*</span>
        </label>

        <div class="mb-3">
            <select class="form-control" id="ocid" name="ocid">
                <option selected value hidden disabled>Please select</option>
                @foreach($ownership AS $each)
                <option value="{{$each->ocid}}">{{$each->ocdesc}}</option>
                @endforeach
            </select>
        </div>
    </div>

    {{-- Classification --}}
    <div class="col-md-4">
        <label>Classification
            <span class="text-danger">*</span>
        </label>

        <div class="mb-3">
            <select class="form-control" id="classid" name="classid">
                <option selected value hidden disabled>Please select</option>
            </select>
        </div>
    </div>

    {{-- Sub Classification --}}
    <div class="col-md-4">
        <label>Sub Classification
            <span class="text-danger">*</span>
        </label>

        <div class="mb-3">
            <select class="form-control" id="subClassid" name="subClassid">
                <option selected value hidden disabled>Please select</option>
            </select>
        </div>
    </div>
</div>
<div class="row" style="padding-left: 15px; padding-right: 15px">
    {{-- Institutional Character --}}
    <div class="col-md-6">
        <label>Institutional Character
            <span class="text-danger">*</span>
        </label>


        <div class="mb-3">
            <div class="row">
                <div class="col-md-11">
                    <select class="form-control" id="facmode" name="facmode">
                        <option selected value hidden disabled>Please select</option>
                        @foreach($facmode AS $each)
                        <option value="{{$each->facmid}}">{{$each->facmdesc}}</option>
                        @endforeach
                    </select>
                </div>


                <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left" title="Tooltip on left" aria-hidden="true"></i>
 -->

                <!-- <div class="col-md-1 pt-1 dfn-hover" style="font-size: 30px;">
                    <dfn data-info="Institution Based &#xa;- A health Facility that is located  &#xa; within the premises and operates  &#xa; as part of an institution &#xa;  &#xa; Free Standing  &#xa; - A health Facility that is not&#xa;attached to an insitution and&#xa;operates independently &#xa;  &#xa; Hospital Based  &#xa; - A health Facility that is located in &#xa; a Hospital
									"><i class="fa fa-question-circle" aria-hidden="true"></i></dfn>
                </div> -->
            <!-- </div>
        </div>
    </div>



    <div class="col-md-6">
        <p class="req">Function:</p>
        <div class="mb-3">
            <select class="form-control" id="funcid" name="funcid">
                <option selected value hidden disabled>Please select</option>
                @foreach($function AS $each)
                <option value="{{$each->funcid}}">{{$each->funcdesc}}</option>
                @endforeach
            </select>
        </div>
    </div>

</div>
<script>
    $(function() {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script> -->