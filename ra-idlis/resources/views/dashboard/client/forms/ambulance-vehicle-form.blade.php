<div class=" ambuDetails" style="width: 100%;">
    <div class="col-md-12 ">
        <strong class="text-primary "> Ambulance Details:</strong>
    </div>
    <!-- <div class="showifHospital ambuDetails" style="width: 100%;" hidden> -->
</div>

@php 
    $_aptid = $aptid;
    $_aptdesc = "Change Request";
    $_dispSubmit = true;
    $_dispData = "Update Details";

    $main_serv_desc = "Ambulance Services"; 
    $addon_serv_desc = "Add Ons / Ancilliary / Other Services";
    $main_colspan = 2;
    $addon_colspan = 2;
    $colspan = 4;
@endphp
@if($isupdate == 1) @php ++$main_colspan; ++$addon_colspan;  $colspan = 5; @endphp @endif
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
                            {{csrf_field()}}
                            <input type="hidden" name="uid" id="uid" value="{{isset($user->uid) ? $user->uid : '' }}"/>
                            <input type="hidden" name="appid" id="appid" />      
                            @if($isaddnew == 1)        
                                <div class="row">
                                    <div class="text-center">
                                        <a class="btn btn-success action-btn" href="#" title="Add New {{$main_serv_desc}}" data-toggle="modal" data-target="#mainService">
                                            <i class="fa fa-plus-circle"></i>&nbsp;Add New {{$main_serv_desc}}
                                        </a>
                                    </div>
                                </div>
                            @endif
                            <table class="table display" id="example" style="overflow-x: scroll;">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="width:  auto">Ambulance Service(Type 1, Type 2)</th>
                                        <th class="text-center" style="width:  auto">Ambulance Type(Owned, Outsoured)</th>
                                        <th class="text-center" style="width:  auto">Plate Number</th>
                                        <th class="text-center" style="width:  auto">Owner Name</th>
                                        
                                        @if($isupdate == 1)        
                                            <th class="text-center" style="width:  auto">
                                                <center>Options</center>
                                            </th>
                                        @endif    
                                    </tr>
                                </thead>
                                <tbody>
                                @if (isset($appform_ambulance))
                                    @php $aa = 0;  @endphp
                                    @foreach ($appform_ambulance as $d)
                                        @if(!empty($d->plate_number))
                                            @php $aa++;    @endphp
                                            <tr>
                                        
                                                <td class="text-center">@if($d->typeamb == 1) Type 1 (Basic Life Support) @else Type 2 (Advance Life Support) @endif </td>
                                                <td class="text-center">@if($d->ambtyp == "1") Outsourced @else Owned @endif</td>
                                                <td class="text-center">{{$d->plate_number}}</td>
                                                <td class="text-center">{{$d->ambOwner}}</td>

                                            @if($isupdate == 1)   

                                                    <td class="text-center">
                                                        
                                                        <button class="btn btn-primary" onclick="showDataAmb(
                                                        '{{$aa}}', '{{$d->typeamb}}','{{$d->ambtyp}}','{{$d->plate_number}}','{{$d->ambOwner}}','0')" data-toggle="modal" data-target="#mainService"><i class="fa fa-edit"></i></button>
                                                        <button class="btn btn-danger " onclick="showDataDelAmb(
                                                        '{{$aa}}', '{{$d->typeamb}}','{{$d->ambtyp}}','{{$d->plate_number}}','{{$d->ambOwner}}','0')" data-toggle="modal" data-target="#delService"><i class="fa fa-minus-circle"></i>
                                                        </button>

                                            @endif 
                                        </tr>
                                            @endif 
                                    @endforeach	
                                @else
                                    <tr>
                                        <td colspan="{{$main_colspan+2}}" class="text-center">No Records found.</td>
                                    </tr>
                                @endif
                                </tbody>
                                <tfoot>
                                    <tr><td colspan="{{$colspan}}" class="text-center">Total Number of Ambulance Apply: @if (isset($appform_ambulance)) {{count($appform_ambulance)}} @endif</td></tr>
                                </tfoot>
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
                                    <th class="text-center" style="width:  auto">Ambulance Service(Type 1, Type 2)</th>
                                    <th class="text-center" style="width:  auto">Ambulance Type(Owned, Outsoured)</th>
                                        <th class="text-center" style="width:  auto">Plate Number</th>
                                        <th class="text-center" style="width:  auto">Owner Name</th>
                                    @if($isupdate == 1)        
                                        <th class="text-center" style="width:  auto">
                                            <center>Options</center>
                                        </th>
                                    @endif   
                                </tr>
                            </thead>
                            <tbody>
                            @if (isset($reg_ambulance))
                                    @foreach ($reg_ambulance as $d)
                                        @if(!empty($d["plate_number"]))
                                        <tr>
                                            <td class="text-center">@if($d["typeamb"] == "1") Type 1 (Basic Life Support) @else Type 2 (Advance Life Support) @endif</td>
                                            <td class="text-center">@if($d["ambtyp"] == "1") Outsourced @else Owned @endif</td>
                                            <td class="text-center">{{$d["plate_number"]}}</td>
                                            <td class="text-center">{{$d["ambOwner"]}}</td>

                                        @if($isupdate == 1)   
                                            <td class="text-center">                                                
                                                <button class="btn btn-primary" onclick="showDataAmb( '',
                                                    '{{$d["typeamb"]}}','{{$d["ambtyp"]}}','{{$d["plate_number"]}}','{{$d["ambOwner"]}}', '1' )" data-toggle="modal" data-target="#mainService"><i class="fa fa-edit"></i>
                                                </button>
                                                <button class="btn btn-danger " onclick="showDataDelAmb(
                                                    '{{$d["typeamb"]}}','{{$d["ambtyp"]}}','{{$d["plate_number"]}}','{{$d["ambOwner"]}}',
                                                    '1')" data-toggle="modal" data-target="#delService"><i class="fa fa-minus-circle"></i>
                                                </button>
                                            </td>
                                        @endif 
                                    </tr>
                                        @endif 
                                @endforeach	
                            @else
                                <tr>
                                    <td colspan="2" class="text-center">No Records found.</td>
                                </tr>
                            @endif
                            </tbody>
                            <tfoot>
                                <td colspan="{{$colspan}}" class="text-center"> Total Number of Registered Ambulance:  @if (isset($reg_ambulance)) {{count($reg_ambulance) -1}} @else 0 @endif</td>
                            </tfoot>
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
            <div class="modal-body text-justify" style=" background-color: #272b30;
            color: white;">
                <h5 class="modal-title text-center"><strong>Add New {{$main_serv_desc}}</strong></h5>
                <hr>
                <div class="container">
                    <form id="frmMainService" action="{{asset('/client1/changerequest/actionsubmit')}}" method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" name="cat_id"value="{{$cat_id}}">
                        <input type="hidden" name="appid" value="{{$appid}}">         
                        <input type="hidden" name="regfac_id" value="{{$regfac_id}}">   
                        <input type="hidden" name="noOfRegAmbulance" id="noOfRegAmbulance" value=" @if (isset($reg_ambulance)) {{count($reg_ambulance) -1}} @else 0 @endif">  
                        <input type="hidden" name="id" id="id" value="">  
                        <input type="hidden" name="action" id="action" value="add">
                        <div class="col-sm-12 alert alert-danger alert-dismissible fade show" style="display:none" id="AddErrorAlert" role="alert">
                            <strong><i class="fas fa-exclamation"></i></strong>&nbsp;An <strong>error</strong> occurred. Please contact the system administrator.
                            <button type="button" class="close" onclick="$('#AddErrorAlert').hide(1000);" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="col-sm-4">{{$main_serv_desc}} Type:</div>
                        <div class="col-sm-8" style="margin:0 0 .8em 0;">
                            <select name="typeamb" id="typeamb" class="form-control select2-hidden-accessible ctyamb" style="width: 100%" data-select2-id="newserv" tabindex="-1" aria-hidden="true">
                                                         
                                <option value="" disabled="" readonly="" hidden="" selected="" data-select2-id="2">Please Select</option>
                                <option value="1">Type 1 (Basic Life Support)</option>
                                <option value="2">Type 2 (Advance Life Support)</option>
                            </select>
                        </div>			
                        <div class="col-sm-4">Ambulance Type (Owned, Outsoured):</div>
                        <div class="col-sm-8" style="margin:0 0 .8em 0;">
                            <select name="ambtyp" id="ambtyp" class="form-control select2-hidden-accessible cambt" style="width: 100%:" data-select2-id="newserv" tabindex="-1" aria-hidden="true">
                                <option value="" disabled="" readonly="" hidden="" selected="" data-select2-id="2">Please Select</option>
                                <option value="1">Outsourced</option>
                                <option value="2">Owned</option>
                            </select>
                        </div>					
                        <div class="col-sm-4">Plate Number / Conduction Sticker:</div>
                        <div class="col-sm-8" style="margin:0 0 .8em 0;">
                            <input type="text" id="plate_number" name="plate_number" placeholder="Plate Number/Conduction Sticker" class="form-control" required="">
                        </div>			
                        <div class="col-sm-4" id="ambownerdiv">Owner:</div>
                        <div class="col-sm-8" id="ambownerdiv2" style="margin:0 0 .8em 0;">
                            <input type="text" id="ambOwner" name="ambOwner" placeholder="Owner" class="form-control" required="">
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

<div id="clickable"> </div>


<script>

    function showDataAmb(id, typeamb, ambtyp, plate_number, ambOwner, fromRegistered){

        $("#id").val(id);
        $("#typeamb").val(typeamb);
        $("#ambtyp").val(ambtyp);
        $("#plate_number").val(plate_number);
        $("#ambOwner").val(ambOwner);
    }
    
    function showDataDelAmb(typeamb, ambtyp, plate_number, ambOwner, fromRegistered){

        $("#id").val(id);
        $("#del_typeamb").val(typeamb);
        $("#del_ambtyp").val(ambtyp);
        $("#del_plate_number").val(plate_number);
        $("#del_ambOwner").val(ambOwner);
        $("#fromRegistered").val(fromRegistered);
    }

</script>