<div class="mb-2 col-md-12">&nbsp;</div>

<div class="col-md-12">
    <b class="text-primary">Type of Facility
        <span class="text-danger">*</span>
    </b>
</div>

<!-- 
    {{-- Drug Abuse Treatment & Rehabilitation Center (DATRC) --}}
        <div class="col-md-12">
            <label>
                <input type="radio" name="hgpid" value="9"/> Drug Abuse Treatment & Rehabilitation Center (DATRC)
            </label>
        </div>

    {{-- Dental Clinic --}}
        <div class="col-md-12">
            <label>
                <input type="radio" name="hgpid" value="19"/> Dental Clinic
            </label>
        </div>

    {{-- Human Stem Cell and Cell-Based or Cellular Therapy Facility --}}
        <div class="col-md-12">
            <label>
                <input type="radio" name="hgpid" value="14"/> Human Stem Cell and Cell-Based or Cellular Therapy Facility
            </label>
        </div>

    {{-- Laboratory for Drinking Water Analysis (LDWA) --}}
        <div class="col-md-12">
            <label>
                <input type="radio" name="hgpid" value="11"/> Laboratory for Drinking Water Analysis (LDWA)
            </label>
        </div>

    {{-- Medical Facility for Overseas Workers and Seafarers (MFOWS) --}}
        <div class="col-md-12">
            <label>
                <input type="radio" name="hgpid" value="12"/> Medical Facility for Overseas Workers and Seafarers (MFOWS)
            </label>
        </div>

    {{-- Kidney Transplant Facility --}}
        <div class="col-md-12">
            <label>
                <input type="radio" name="hgpid" value="10"/> Kidney Transplant Facility
            </label>
        </div>

    {{-- Newborn Screening Center (NSC) --}}
        <div class="col-md-12">
            <label>
                <input type="radio" name="hgpid" value="13"/> Newborn Screening Center (NSC)
            </label>
        </div>

    {{-- Drug Testing Laboratory --}}
        <div class="col-md-12">
            <label>
                <input type="radio" name="hgpid" value="8"/> Drug Testing Laboratory
            </label>
        </div> -->

<div class="col-md-12">
    <div class="mb-3" id="hfaci_grp">
        @if(count($hfaci_service_type) > 0) @for($i = 0; $i < ceil(count($hfaci_service_type)/4); $i++) <?php $_min = $i * 4;
                                                                                                        $_oMax = $_min + 4;
                                                                                                        $_nMax = (($_oMax > count($hfaci_service_type)) ? count($hfaci_service_type) : $_oMax); ?> <div class="row">
            @for($j = $_min; $j < $_nMax; $j++) <div class="col-md-3">
                <div class="custom-control custom-radio mr-sm-2">
                    <input onclick="type_of_fac(this.id)" type="radio" class="custom-control-input" id="{{$hfaci_service_type[$j]->hgpid}}" name="hgpid" value="{{$hfaci_service_type[$j]->hgpid}}">
                    <!-- <input onclick="type_of_fac(this.id)" type="radio" class="custom-control-input" id="{{$hfaci_service_type[$j]->hgpid}}" name="hgpid" value="{{$hfaci_service_type[$j]->hgpid}}"> -->
                    <label class="custom-control-label" for="{{$hfaci_service_type[$j]->hgpid}}">{{$hfaci_service_type[$j]->hgpdesc}}</label>
                </div>
    </div>
    @endfor
</div>
@endfor @else
<p>No facility type(s).</p>
@endif
</div>