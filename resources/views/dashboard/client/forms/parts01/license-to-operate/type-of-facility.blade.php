
<div class="mb-2 col-md-12"><hr /></div>

<div class="col-md-12">
    
    <b class="text-primary">Type of Facility:
        <span class="text-danger">*</span>
    </b>
</div>

<div class="col-md-12">
    <div class="mb-3" id="hfaci_grp">
        @if(isset($hfaci_service_type))
            @if(is_array($hfaci_service_type))
                @if(count($hfaci_service_type) > 0) 
                    @for($i = 0; $i < ceil(count($hfaci_service_type)/4); $i++) 
                        <?php $_min = $i * 4;
                            $_oMax = $_min + 4;
                            $_nMax = (($_oMax > count($hfaci_service_type)) ? count($hfaci_service_type) : $_oMax);  ?>

                        <div class="row">
                            @for($j = $_min; $j < $_nMax; $j++) 
                                <div class="col-md-3">
                                    <div class="custom-control custom-radio mr-sm-2">
                                        <input type="radio" class="custom-control-input hfaci_service_type" id="{{$hfaci_service_type[$j]->hgpid}}" name="hgpid" value="{{$hfaci_service_type[$j]->hgpid}}">
                                        <!-- <input onclick="type_of_fac(this.id)" type="radio" class="custom-control-input" id="{{$hfaci_service_type[$j]->hgpid}}" name="hgpid" value="{{$hfaci_service_type[$j]->hgpid}}"> -->
                                        <label class="custom-control-label" for="{{$hfaci_service_type[$j]->hgpid}}">{{$hfaci_service_type[$j]->hgpdesc}}</label>
                                    </div>
                                </div>
                            @endfor
                        </div>
                    @endfor 
                @else
                    <p>No facility type(s).</p>
                @endif
            @endif
        @endif
    </div>
</div>

</div>