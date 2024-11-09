
<div class="modal fade" id="changeAmbulanceVehicle" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" style="border-radius: 0px;border: none;">
            <div class="modal-body text-justify" style=" background-color: #272b30; color: white;">
                <h5 class="modal-title text-center"><strong>Add New</strong></h5>
                <hr>

                <form id="form_AmbulanceVehicle" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" name="grp_id" value="12">   
                    <input type="hidden" name="appid" value="{{$appid}}">         
                    <input type="hidden" name="regfac_id" value="{{$regfac_id}}">   
                    <input type="hidden" name="action" id="action" value="add">

                    <div class="col-sm-12">
                        <div class="col-sm-12 alert alert-danger alert-dismissible fade show" style="display:none" id="AddErrorAlert" role="alert">
                            <strong><i class="fas fa-exclamation"></i></strong>&nbsp;An <strong>error</strong> occurred. Please contact the system administrator.
                            <button type="button" class="close" onclick="$('#AddErrorAlert').hide(1000);" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">Type:</div>
                            <div class="col-sm-8" >
                                <select name="typeamb" id="typeamb" class="form-control select2-hidden-accessible ctyamb" style="width: 100%" data-select2-id="newserv" tabindex="-1" aria-hidden="true">
                                    <option value="" disabled="" readonly="" hidden="" selected="" data-select2-id="2">Please Select</option>
                                    <option value="1">Type 1 (Basic Life Support)</option>
                                    <option value="2">Type 2 (Advance Life Support)</option>
                                </select>
                            </div>		
                        </div>	
                        <br/>
                        <div class="row">			
                            <div class="col-sm-4">Ambulance Type (Owned, Outsoured):</div>
                            <div class="col-sm-8" >
                                <select name="ambtyp" id="ambtyp" class="form-control select2-hidden-accessible cambt" style="width: 100%:" data-select2-id="newserv" tabindex="-1" aria-hidden="true">
                                    <option value="" disabled="" readonly="" hidden="" selected="" data-select2-id="2">Please Select</option>
                                    <option value="1">Outsourced</option>
                                    <option value="2">Owned</option>
                                </select>
                            </div>			
                        </div>	
                        <br/>
                        <div class="row">				
                            <div class="col-sm-4">Plate Number / Conduction Sticker:</div>
                            <div class="col-sm-8" >
                                <input type="text" id="plate_number" name="plate_number" placeholder="Plate Number/Conduction Sticker" class="form-control" required="">
                            </div>	
                        </div>	
                        <br/>	
                        <div class="row">		
                            <div class="col-sm-4" id="ambownerdiv">Owner:</div>
                            <div class="col-sm-8" id="ambownerdiv2" >
                                <input type="text" id="ambOwner" name="ambOwner" placeholder="Owner" class="form-control" required="">
                            </div>	
                        </div>	
                        <br/>
                        
                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-success form-control" style="border-radius:0;">
                                <span class="fa fa-sign-up"></span>Save
                            </button>
                        </div> 
                    </div>
                    
                </form>

            </div>
        </div>
    </div>
</div>



<div class="modal fade" id="delAmbulanceVehicle" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" style="border-radius: 0px;border: none;">
            <div class="modal-body text-justify" style=" background-color: #272b30;
            color: white;">
                <h5 class="modal-title text-center"><strong>Delete Ambulance</strong></h5>
                <hr>
                <div class="container">
                    <form id="frmdelAmbulanceVehicle" method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" name="grp_id" value="12">   
                        <input type="hidden" name="appid" value="{{$appid}}">         
                        <input type="hidden" name="regfac_id" value="{{$regfac_id}}">   
                        <input type="hidden" name="noOfRegAmbulance" id="noOfRegAmbulance" value=" @if (isset($reg_ambulance)) {{count($reg_ambulance) -1}} @else 0 @endif">  
                        <input type="hidden" name="id" id="del_id" value="">  
                        <input type="hidden" name="action" value="del">                        
                        <input type="hidden" id="del_ambtyp_id" name="ambtyp" class="form-control" readonly required="">
                        <input type="hidden" id="del_typeamb_id" name="typeamb" class="form-control" readonly required="">

                        <div class="col-sm-12 alert alert-danger alert-dismissible fade show" style="display:none" id="AddErrorAlert" role="alert">
                            <strong><i class="fas fa-exclamation"></i></strong>&nbsp;An <strong>error</strong> occurred. Please contact the system administrator.
                            <button type="button" class="close" onclick="$('#AddErrorAlert').hide(1000);" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="col-sm-4">Ambulance Type:</div>
                        <div class="col-sm-8" style="margin:0 0 .8em 0;">
                            <select id="del_typeamb" class="form-control select2-hidden-accessible ctyamb" style="width: 100%" data-select2-id="newserv" tabindex="-1" aria-hidden="true">     
                                <option value="" disabled="" readonly="" hidden="" selected="" data-select2-id="2">Please Select</option>
                                <option value="1">Type 1 (Basic Life Support)</option>
                                <option value="2">Type 2 (Advance Life Support)</option>
                            </select>
                        </div>			
                        <div class="col-sm-4">Ambulance Type (Owned, Outsoured):</div>
                        <div class="col-sm-8" style="margin:0 0 .8em 0;">                        
                            <select id="del_ambtyp" class="form-control select2-hidden-accessible cambt" style="width: 100%:" data-select2-id="newserv" tabindex="-1" aria-hidden="true">
                                <option value="" disabled="" readonly="" hidden="" selected="" data-select2-id="2">Please Select</option>
                                <option value="1">Outsourced</option>
                                <option value="2">Owned</option>
                            </select>
                        </div>					
                        <div class="col-sm-4">Plate Number / Conduction Sticker:</div>
                        <div class="col-sm-8" style="margin:0 0 .8em 0;">
                            <input type="text" id="del_plate_number" name="plate_number" placeholder="Plate Number/Conduction Sticker" class="form-control" readonly required="">
                        </div>			
                        <div class="col-sm-4" id="ambownerdiv">Owner:</div>
                        <div class="col-sm-8" id="ambownerdiv2" style="margin:0 0 .8em 0;">
                            <input type="text" id="del_ambOwner" name="ambOwner" placeholder="Owner" class="form-control" required="">
                        </div>	
                        <br/>
                        <div class="col-sm-4"></div>
                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-danger form-control" style="border-radius:0;">
                                <span class="fa fa-sign-up"></span>Delete
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
