<div class="mb-2 col-md-12">&nbsp;</div>
<div class="col-md-12"><b class="text-primary">Type of Health Facility: <span class="text-danger">*</span></b></div>

<!-- @foreach($hfaci_service_type as $h)
<div class="col-md-3">
    <label><input type="radio" name="hgpid" value="{{$h->hgpid}}"/> {{$h->hgpdesc}}</label>
</div>
@endforeach -->

<div class="col-md-12">
    <div class="mb-3" id="hfaci_grp">
        @if(count($hfaci_service_type) > 0) @for($i = 0; $i < ceil(count($hfaci_service_type)/4); $i++) <?php $_min = $i * 4;
                                                                                                        $_oMax = $_min + 4;
                                                                                                        $_nMax = (($_oMax > count($hfaci_service_type)) ? count($hfaci_service_type) : $_oMax); ?> <div class="row">
            @for($j = $_min; $j < $_nMax; $j++) <div class="col-md-3">
                <div class="custom-control custom-radio mr-sm-2">
                    <input type="radio" class="custom-control-input hfaci_service_type" id="{{$hfaci_service_type[$j]->hgpid}}" name="hgpid" value="{{$hfaci_service_type[$j]->hgpid}}">
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