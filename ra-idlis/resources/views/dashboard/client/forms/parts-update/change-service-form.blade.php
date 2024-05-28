@php 
    $_aptid = $aptid;
    $_aptdesc = "Change Request";
    $_dispSubmit = true;
    $_dispData = "Update Details";

    $main_serv_desc = "Main Services"; 
    $addon_serv_desc = "Add Ons / Ancilliary / Other Services";
    $main_colspan = 3;
    $addon_colspan = 3;

    $cat_id = 0;
@endphp
@if($isupdate == 1) @php ++$main_colspan; ++$addon_colspan; @endphp @endif

<div class="modal fade" id="mainService" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" style="border-radius: 0px;border: none;">
            <div class="modal-header"  style=" background-color: #272b30; color: white;" id="mainViewHead">
                <h5 class="modal-title"  id="mainServiceActLabel">Add New {{$addon_serv_desc}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-justify" style=" background-color: #272b30; color: white;" id="mainViewBody">
                <h5 class="modal-title text-center"><strong>Add New {{$main_serv_desc}}</strong></h5>
                <hr>
                <div class="container">
                    <form id="frmMainService"  method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" name="grp_id"value="10">
                        <input type="hidden" name="appid" value="{{$appid}}">         
                        <input type="hidden" name="regfac_id" value="{{$regfac_id}}">     
                        <input type="hidden" name="action" id="ms_action" value="add">
                        <input type="hidden" name="facid_old" id="ms_facid_old" >
                        <input type="hidden" name="servowner" id="ms_servowner" >
                        <input type="hidden" name="servtyp" id="ms_servowner" >
                        <div class="col-sm-12 alert alert-danger alert-dismissible fade show" style="display:none" id="AddErrorAlert" role="alert">
                            <strong><i class="fas fa-exclamation"></i></strong>&nbsp;An <strong>error</strong> occurred. Please contact the system administrator.
                            <button type="button" class="close" onclick="$('#AddErrorAlert').hide(1000);" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        
                        <div class="col-sm-4">New {{$main_serv_desc}}:</div>
                        <div class="col-sm-8" style="margin:0 0 .8em 0;">
                            <select name="facid" id="ms_facid" class="form-control select2-hidden-accessible" style="width: 100%" data-select2-id="ms_facid" tabindex="-1" aria-hidden="true">
                                <option value="" disabled="" readonly="" hidden="" selected="" data-select2-id="2">Please Select</option>                               
                                @if (isset($mainservicelist))
                                                                        
                                    @php $groupname = ""; $newgroup=1; @endphp
                                    @foreach ($mainservicelist as $d)

                                        @if($groupname != $d->anc_name)
                                            @php $groupname = $d->anc_name; $newgroup=0; @endphp
                                            <optgroup label="{{$d->anc_name}}">
                                        @endif

                                        <option value="{{$d->facid}}"> {{$d->facname}} <small style="color:#ccc">[{{$d->facid}}]</small></option>
                                        
                                        @if($newgroup == 1)
                                            </optgroup>
                                            @php $newgroup=0; @endphp
                                        @endif

                                    @endforeach	
                                @endif

                            </select>
                        </div>						
                        <br/>
                        <div class="col-sm-4"></div>
                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-success form-control" style="border-radius:0;">
                                <span class="fa fa-sign-up"></span>Save
                            </button>
                        </div> 
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="addOnService" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" style="border-radius: 0px;border: none;">
            <div class="modal-header"   style=" background-color: #272b30; color: white;" id="addOnViewHead">
                <h5 class="modal-title" id="addOnServiceActLabel">Add New {{$addon_serv_desc}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <div class="modal-body text-justify" style=" background-color: #272b30;   color: white;" id="addOnViewBody">
                <div class="container">
                    <form id="frmAddOnService"  method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" name="grp_id" value="10">
                        <input type="hidden" name="appid" value="{{$appid}}">         
                        <input type="hidden" name="regfac_id" value="{{$regfac_id}}">     
                        <input type="hidden" name="action" id="ao_action" value="add">
                        <input type="hidden" name="facid_old" id="ms_facid_old" >
                        <input type="hidden" name="servowner" id="ms_servowner" >
                        <input type="hidden" name="servtyp" id="ms_servowner" >
                        
                        @if(!$isupdate)
                        @endif
                        <div class="col-sm-12 alert alert-danger alert-dismissible fade show" style="display:none" id="AddErrorAlert" role="alert">
                            <strong><i class="fas fa-exclamation"></i></strong>&nbsp;An <strong>error</strong> occurred. Please contact the system administrator.
                        </div>
                        {{-- 
                        @if($isupdate)
                            <div class="col-sm-4" style="display:none;">Current:</div>
                            <div class="col-sm-8" style="margin:0 0 .8em 0;">
                                <select name="facid_old" id="ao_facid_current" class="form-control select2-hidden-accessible" style="width: 100%:">
                                    <option value="">Please Select</option>
                                    @if (isset($addonservicelist))
                                    
										@php $groupname = ""; $newgroup=1; @endphp
                                        @foreach ($addonservicelist as $d)

                                            @if($groupname != $d->anc_name)
                                                @php $groupname = $d->anc_name; $newgroup=0; @endphp
                                                <optgroup label="{{$d->anc_name}}">
                                            @endif

                                            <option value="{{$d->facid}}"> {{$d->facname}} <small style="color:#ccc">[{{$d->facid}}]</small></option>
                                            
                                            @if($newgroup == 1)
                                                </optgroup>
                                                @php $newgroup=0; @endphp
                                            @endif

                                        @endforeach	
                                    @endif
                                </select>
                            </div>	
                        @endif
                        --}}
                        <div class="col-sm-4">New:</div>
                        <div class="col-sm-8" style="margin:0 0 .8em 0;">
                            <select name="facid" id="ao_facid" class="form-control select2-hidden-accessible" style="width: 100%:">
                                <option value="">Please Select</option>
                                @if (isset($addonservicelist))
									@php $groupname = ""; $newgroup=1; @endphp
                                    @foreach ($addonservicelist as $d)

                                        @if($groupname != $d->anc_name)
                                            @php $groupname = $d->anc_name; $newgroup=0; @endphp
                                            <optgroup label="{{$d->anc_name}}">
                                        @endif

                                        <option value="{{$d->facid}}"> {{$d->facname}} <small style="color:#ccc">[{{$d->facid}}]</small></option>
                                        
                                        @if($newgroup == 1)
                                            </optgroup>
                                            @php $newgroup=0; @endphp
                                        @endif

                                    @endforeach	
                                @endif
                            </select>
                        </div>			
                        <div class="col-sm-4">Type:</div>
                        <div class="col-sm-8" style="margin:0 0 .8em 0;">
                            <select name="servtyp" id="ao_servtype" class="form-control select2-hidden-accessible" style="width: 100%:" data-select2-id="ao_servtype" tabindex="-1" aria-hidden="true">
                                <option value="" disabled="" readonly="" hidden="" selected="" data-select2-id="2">Please Select</option>
                                <option value="1">Outsourced</option>
                                <option value="2">Owned</option>
                            </select>
                        </div>					
                        <div class="col-sm-4">Details:</div>
                        <div class="col-sm-8" style="margin:0 0 .8em 0;">
                            <input type="text" name="servowner" id="ao_servowner" class="form-control" required="">
                        </div>	
                        <br/>
                        <div class="col-sm-4"></div>
                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-success form-control" style="border-radius:0;">
                                <span class="fa fa-sign-up"></span>Save
                            </button>
                        </div> 
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="modal fade" id="delService" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" style="border-radius: 0px;border: none;">
            <div class="modal-header"   style=" background-color: #272b30; color: white;">
                <h5 class="modal-title" id="addOnServiceActLabel">Remove this service?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <div class="modal-body text-justify" style=" background-color: #272b30;   color: white;" >
                <div class="container">
                    <form id="frmdelService"  method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" name="grp_id" value="10">
                        <input type="hidden" name="appid" value="{{$appid}}">         
                        <input type="hidden" name="regfac_id" value="{{$regfac_id}}">     
                        <input type="hidden" name="action" value="del">
                        <input type="hidden" name="facid_old" >
                        <input type="hidden" name="servowner">
                        <input type="hidden" name="servtyp" >
                        <input type="hidden" name="fromRegistered" id="fromRegistered">
                        <input type="hidden" name="facid" id="del_facid">

                        <div class="col-sm-12" style="margin:0 0 .8em 0;">
                            <input type="text" name="facname" id="del_facname"  class="form-control">
                                                
                        </div>	
                        					
                        <br/>
                        <div class="row" >
                            <div class="col-sm-4">&nbsp;</div>
                            <div class="col-sm-4">
                                <button type="button" class="btn btn-secondary form-control" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">Close</span>
                                </button>
                            </div> 
                            <div class="col-sm-4">
                                <button type="submit" class="btn btn-danger form-control" style="border-radius:0;">
                                    <span class="fa fa-sign-up"></span>Remove
                                </button>
                            </div> 
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="clickable"> </div>


<script>

    function showDataMainServ(anc_name, facid, action){
        
        $("#mainServiceActLabel").empty().html('Change to New {{$addon_serv_desc}}');
        $("#ms_facid").val(facid);
        $("#ms_action").val(action);
    }

    function showDataAddOnServ(facid, servtyp, servowner, action){

        $("#addOnServiceActLabel").empty().html('Change to New {{$addon_serv_desc}}');
        $("#ao_action").val(action);
        $("#ao_facid").val(facid);
        $("#ao_ownedtype").val(servtyp);
        $("#ao_servowner").val(servowner);
    }
    
    function showDataDelServ(facid, facname, fromRegistered){

        $("#del_facid").val(facid);
        $("#del_facname").val(facname);
        $("#fromRegistered").val(fromRegistered);
    }

   /* $(document).on('submit','#frmMainService',function(event){
        event.preventDefault();
        let data = new FormData(this);
        $.ajax({
            type: 'POST',
            data:data,
            contentType: false,
            processData: false,
            success: function(a){
                if(a == 'DONE'){
                    alert('Operation Successul');
                    location.reload();
                } else {
                    console.log(a);
                }
            }
        })
    })

    $(document).on('submit','#frmAddOnService',function(event){
        event.preventDefault();
        let data = new FormData(this);
        $.ajax({
            type: 'POST',
            data:data,
            contentType: false,
            processData: false,
            success: function(a){
                if(a == 'DONE'){
                    alert('Operation Successul');
                    location.reload();
                } else {
                    console.log(a);
                }
            }
        })
    }) */
</script>