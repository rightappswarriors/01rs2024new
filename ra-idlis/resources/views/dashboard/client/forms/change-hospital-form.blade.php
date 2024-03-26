@php 
    $_aptid = $aptid;
    $_aptdesc = "Change Request";
    $_dispSubmit = true;
    $_dispData = "Update Details";

    $main_serv_desc = "Hospital Level"; 
    $addon_serv_desc = "Add Ons / Ancilliary / Other Services";
    $main_colspan = 3;
    $addon_colspan = 3;
@endphp
@if($isupdate == 1) @php ++$main_colspan; ++$addon_colspan; @endphp @endif
<div class="row">
    <div class="col-md-12">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active">
                    <a class="nav-link active" id="v-main-applied-tab" data-toggle="tab" href="#v-main-applied" role="tab" aria-controls="v-main-applied" aria-selected="true">
                        <i class="fa fa-file"></i> List of Services  to Apply
                    </a> 
                </li>
                <li>
                    <a class="nav-link" id="v-main-reg-tab" data-toggle="pill" href="#v-main-reg" role="tab" aria-controls="v-main-reg" aria-selected="false">
                        <i class="fa fa-check"></i> List of Registered Services
                    </a>
                </li>
            </ul>
            
            <div class="tab-content mt-5">	

                <div class="tab-pane active" id="v-main-applied">

                    <div class="col-md-12 text-center">
                        <h3 class="text-uppercase font-weight-bold">List of {{$main_serv_desc}} to Apply</h3>
                    </div>                  
                    <div class="col-md-12">    
                             @if($isaddnew == 1)   
                             {{-- 
                                <div class="row">
                                    <div class="text-center">
                                        <a class="btn btn-success action-btn" href="#" title="Add New {{$main_serv_desc}}" data-toggle="modal" data-target="#mainService">
                                            <i class="fa fa-plus-circle"></i>&nbsp;Add New {{$main_serv_desc}}
                                        </a>
                                    </div>
                                </div>--}}     
                            @endif 
                            <table class="table display" id="example" style="overflow-x: scroll;">
                                <thead>
                                    <tr>   
                                        <th class="text-center" style="width:  auto">Action</th>
                                        <th colspan="2" class="text-center" style="width:  auto">To New {{$main_serv_desc}}</th>
                                        
                                        @if($isupdate == 1)        
                                            <th class="text-center" style="width:  auto">
                                                <center>Options</center>
                                            </th>
                                        @endif    
                                    </tr>
                                </thead>
                                <tbody>
                                @if (isset($mainservices_applied))
                                    @foreach ($mainservices_applied as $d)
                                        <tr>
                                            <td class="text-center"> @if (isset($d->facid_old) && !empty($d->facid_old)) Update  @else Add New  @endif</td>
                                            <td class="text-center">{{$d->anc_name}}<br/><small style="color:#ccc">[{{$d->facid}}]</small> </td>
                                            <td class="text-center">{{$d->facname}}</td>

                                            @if($isupdate == 1)   
                                                <td class="text-center">
                                                    <button class="btn btn-primary" onclick="showDataMainServ(
                                                            '{{$d->anc_name}}',
                                                            '{{$d->facid}}',
                                                            '{{$d->facid}}',
                                                            '{{$d->facname}}',
                                                            'edit'
                                                        )" data-toggle="modal" data-target="#mainService"><i class="fa fa-edit"></i></button>
                                                    <button class="btn btn-danger " onclick="showDataDelServ('{{$d->facid}}', '{{$d->facname}}', '0')" 
                                                            data-toggle="modal" data-target="#delService"><i class="fa fa-minus-circle"></i>
                                                    </button>
                                                </td>
                                            @endif 
                                        </tr>
                                    @endforeach	
                                @else
                                    <tr>
                                        <td colspan="{{$main_colspan+2}}" class="text-center">No Records found.</td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                    </div>

                    <div class="col-md-12 text-center">
                        <h3 class="text-uppercase font-weight-bold">List of {{$addon_serv_desc}}  to Apply</h3>
                    </div> 
                    <div class="col-md-12">  
                            {{csrf_field()}}
                            <input type="hidden" name="uid" id="uid" value="{{isset($user->uid) ? $user->uid : '' }}"/>
                            <input type="hidden" name="appid" id="appid" />
                            @if($isaddnew == 1)       
                                <div class="row">
                                    <div class="text-center">
                                        <a class="btn btn-success action-btn" href="#" title="Add New {{$addon_serv_desc}}" data-toggle="modal" data-target="#addOnService">
                                            <i class="fa fa-plus-circle"></i>&nbsp;Add New {{$addon_serv_desc}}
                                        </a>
                                    </div>
                                </div>
                            @endif
                            <table class="table display" id="example" style="overflow-x: scroll;">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="width:  auto">Action</th>
                                        <th colspan="2" class="text-center" style="width:  auto">To New Service</th>
                                        {{-- <th class="text-center" style="width: auto;text-align: center">Type</th>
                                        <th class="text-center" style="width: auto;text-align: center">Details</th>  --}}
                                        @if($isupdate == 1)   
                                            <th class="text-center" style="width:  auto">
                                                <center>Options</center>
                                            </th>
                                        @endif 
                                    </tr>
                                </thead>
                                <tbody>
                                @php $proceed_addon = 0; @endphp
                                @if (isset($addOnservices_applied))
                                    @foreach ($addOnservices_applied as $d)
                                        @php $proceed_addon = 1; @endphp
                                        <tr>
                                            <td class="text-center"> @if (isset($d->facid_old) && !empty($d->facid_old)) Update  @else Add New  @endif</td>
                                            <td class="text-center">{{$d->anc_name}}<br/><small style="color:#ccc">[{{$d->facid}}]</small> </td>
                                            <td class="text-center">{{$d->facname}}</td>
                                            {{-- <td class="text-center">Owned</td>
                                            <td class="text-center">Remarks</td>  --}}
                                            @if($isupdate == 1)   
                                                <td class="text-center">
                                                    <button class="btn btn-primary" onclick="showDataAddOnServ(
                                                    '{{$d->facid}}',
                                                    '{{$d->servtyp}}',
                                                    '{{$d->servowner}}',
                                                    '{{$d->facid_old}}',
                                                    'edit'
                                                    )" data-toggle="modal" data-target="#addOnService"><i class="fa fa-edit"></i></button>
                                                    <button class="btn btn-danger " onclick="showDataDelServ('{{$d->facid}}', '{{$d->facname}}', '0')" 
                                                            data-toggle="modal" data-target="#delService"><i class="fa fa-minus-circle"></i>
                                                    </button>
                                                </td>
                                            @endif 
                                        </tr>
                                    @endforeach	
                                @endif
                                
                                @if($proceed_addon == 0)   
                                    <tr>
                                        <td colspan="{{$addon_colspan+2}}" class="text-center">No Records found.</td>
                                    </tr>
                                @endif
                                
                                </tbody>
                            </table>
                    </div>

                </div>
                <div class="tab-pane" id="v-main-reg">

                    <div class="col-md-12 text-center">
                        <h3 class="text-uppercase font-weight-bold">List of Registered {{$main_serv_desc}}</h3>
                    </div>                  
                    <div class="col-md-12">  
                        <table class="table display" id="example" style="overflow-x: scroll;">
                            <thead>
                                <tr>
                                    <th class="text-center" style="width:  auto">Group</th>
                                    <th class="text-center" style="width:  auto">Description</th> 
                                    @if($isupdate == 1)        
                                        <th class="text-center" style="width:  auto">
                                            <center>Options</center>
                                        </th>
                                    @endif   
                                </tr>
                            </thead>
                            <tbody>
                            @if (isset($mainservices_reg))
                                @foreach ($mainservices_reg as $d)
                                    <tr>
                                        <td class="text-center">{{$d->anc_name}}<br/><small style="color:#ccc">[{{$d->facid}}]</small> </td>
                                        <td class="text-center">{{$d->facname}}</td>

                                        @if($isupdate == 1)   
                                            <td class="text-center"><button class="btn btn-primary" onclick="showDataMainServ(
                                                '{{$d->anc_name}}',
                                                '{{$d->facid}}',
                                                '{{$d->facid}}',
                                                '{{$d->facname}}',
                                                'edit'

                                            )" data-toggle="modal" data-target="#mainService"><i class="fa fa-edit"></i></button>
                                            <button class="btn btn-danger " onclick="showDataDelServ('{{$d->facid}}', '{{$d->facname}}', '1')" 
                                                    data-toggle="modal" data-target="#delService"><i class="fa fa-minus-circle"></i>
                                            </button>                                          
                                            </td>
                                        @endif 
                                    </tr>
                                @endforeach	
                            @else
                                <tr>
                                    <td colspan="2" class="text-center">No Records found.</td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>

                    <div class="col-md-12 text-center">
                        <h3 class="text-uppercase font-weight-bold">List of Registered {{$addon_serv_desc}}</h3>
                    </div> 
                    <div class="col-md-12">  
                        <table class="table display" id="example" style="overflow-x: scroll;">
                            <thead>
                                <tr>
                                    <th class="text-center" style="width:  auto">Group</th>
                                    <th class="text-center" style="width:  auto">Description</th>
                                    {{-- <th class="text-center" style="width: auto;text-align: center">Type</th>
                                    <th class="text-center" style="width: auto;text-align: center">Details</th>  --}}
                                    @if($isupdate == 1)        
                                        <th class="text-center" style="width:  auto">
                                            <center>Options</center>
                                        </th>
                                    @endif   
                                </tr>
                            </thead>
                            <tbody>
                            @php $proceed_addon = 0; @endphp
                            @if (isset($addOnservices_reg))
                                @foreach ($addOnservices_reg as $d)
                                    @php $proceed_addon = 1; @endphp
                                    <tr>
                                        <td class="text-center">{{$d->anc_name}}<br/><small style="color:#ccc">[{{$d->facid}}]</small> </td>
                                        <td class="text-center">{{$d->facname}}</td>
                                        {{-- <td class="text-center">Owned</td>
                                        <td class="text-center">Remarks</td>  --}}
                                        @if($isupdate == 1)   
                                            <td class="text-center">
                                                <button class="btn btn-primary" onclick="showDataAddOnServ(
                                                    '{{$d->facid}}',
                                                    '{{$d->servtyp}}',
                                                    '{{$d->servowner}}',
                                                    '{{$d->facid_old}}',
                                                    'edit'
                                                    )" data-toggle="modal" data-target="#addOnService"><i class="fa fa-edit"></i></button>
                                                <button class="btn btn-danger " onclick="showDataDelServ('{{$d->facid}}', '{{$d->facname}}', '1')" 
                                                        data-toggle="modal" data-target="#delService"><i class="fa fa-minus-circle"></i>
                                                </button>
                                            </td>
                                        @endif 
                                    </tr>
                                @endforeach	
                            @endif
                            
                            @if($proceed_addon == 0)   
                                <tr>
                                    <td colspan="{{$addon_colspan}}" class="text-center">No Records found.</td>
                                </tr>
                            @endif
                            
                            </tbody>
                        </table>
                    </div>

                </div>

            </div>

        </div> 
    </div>     
    
</div>


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
                    <form id="frmMainService" action="{{asset('/client1/changerequest/actionsubmit')}}" method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" name="cat_id"value="{{$cat_id}}">
                        <input type="hidden" name="appid" value="{{$appid}}">         
                        <input type="hidden" name="regfac_id" value="{{$regfac_id}}">     
                        <input type="hidden" name="action" id="ms_action" value="main">
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
                    <form id="frmAddOnService" action="{{asset('/client1/changerequest/actionsubmit')}}" method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" name="cat_id" value="{{$cat_id}}">
                        <input type="hidden" name="appid" value="{{$appid}}">         
                        <input type="hidden" name="regfac_id" value="{{$regfac_id}}">     
                        <input type="hidden" name="action" id="ao_action" value="add">
                        <input type="hidden" name="facid_old" id="ms_facid_old" >
                        <input type="hidden" name="servowner" id="ms_servowner" >
                        <input type="hidden" name="servtyp" id="ms_servowner" >
                        
                        @if(!$isupdate)
                        <input type="hidden" name="facid_old" value="">  
                        @endif
                        <div class="col-sm-12 alert alert-danger alert-dismissible fade show" style="display:none" id="AddErrorAlert" role="alert">
                            <strong><i class="fas fa-exclamation"></i></strong>&nbsp;An <strong>error</strong> occurred. Please contact the system administrator.
                        </div>
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
                    <form id="frmdelService" action="{{asset('/client1/changerequest/actionsubmit')}}" method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" name="cat_id" value="{{$cat_id}}">
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

    function showDataMainServ(anc_name, facid, oldfacid, oldfacname, action){
        
        $("#mainServiceActLabel").empty().html('Change to New {{$addon_serv_desc}}');
        $("#ms_facid").val(facid);
        $("#ms_facid_old").val(facid);
        //$("#ms_action").val(action);
    }

    function showDataAddOnServ(facid, servtyp, servowner, oldfacid, action){

        $("#addOnServiceActLabel").empty().html('Change to New {{$addon_serv_desc}}');
        $("#ao_action").val(action);
        $("#ao_facid_current").val(oldfacid);
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