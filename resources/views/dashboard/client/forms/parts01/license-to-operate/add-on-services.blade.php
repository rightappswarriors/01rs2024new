<!-- <div class="addOnServe" style="width: 100%;"  hidden>
<div class="mb-2 col-md-12">&nbsp;</div>
    <div class="col-md-12"><b class="text-primary">Add on Services</b></div>


    {{-- Ambulatory Surgical Clinic --}}
    <div class="col-md-4">
        <label>
            <input type="checkbox" name="groupThis" id="ASC-AO-CS-PCL" value="ASC-AO-CS-PCL" /> Primary Clinical Laboratory
        </label>
    </div>
    <div class="col-md-4">
        <label>
            <input type="checkbox" name="groupThis" id="ASC-AO-CS-SCL" value="ASC-AO-CS-SCL" /> Secondary Clinical Laboratory
        </label>
    </div>
    <div class="col-md-4">
        <label>
            <input type="checkbox" name="groupThis" id="ASC-AO-CS-TCL" value="ASC-AO-CS-TCL" /> Drug Testing Laboratory
        </label>
    </div>
    <div class="col-md-4">
        <label>
            <input type="checkbox" name="groupThis" id="ASC-CS-AO-HIV" value="ASC-CS-AO-HIV" /> HIV Testing Laboratory
        </label>
    </div>
</div> -->

<div class="addOnServe" style="width: 100%; " hidden>
    <div class="mb-2 col-md-12">&nbsp;</div>
    <div class="col-md-12 ">
        <b class="text-primary "> Add on services:
        </b>
    </div>



    <div style="width:95%; padding-left: 35px">

        <div class="row col-border-right showAmb">

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <td> <button class="btn btn-success" id="buttonIdAos"><i class="fa fa-plus-circle"></i></button> </td>
                        <th>
                            <center>Services</center>
                        </th>
                        <th>
                            <center>Type(Owned, Outsoured)</center>
                        </th>
                        <th>
                            <center>Details</center>
                        </th>
                    </tr>
                </thead>
                <tbody id="body_addOn">
                    <tr id="tr_addOn" hidden>
                    <!-- <tr id="tr_addOn" hidden> -->
                        <!-- preventDef -->
                        <!-- onclick="if(! this.parentNode.parentNode.hasAttribute('id')) { this.parentNode.parentNode.parentNode.removeChild(this.parentNode.parentNode); }" -->
                        <!-- onClick="$(this).closest('tr').remove();" -->
                        <td onclick="return preventDef()"> <button class="btn btn-danger "  onclick="if(! this.parentNode.parentNode.hasAttribute('id')) { this.parentNode.parentNode.parentNode.removeChild(this.parentNode.parentNode); }"><i class="fa fa-minus-circle" onclick="return preventDef()"></i></button> </td>
                        <td>
                            <div class="input-group">
                                <!-- <div class="input-group-prepend">
                                    <label class="input-group-text" for="typeamb"><i class="fa fa-info" data-toggle="tooltip" data-placement="top" title="Lorem ipsum dolar"></i></label>
                                </div> -->
                                <p id="aoselCont">
                                    <select class="form-control " id="addOnServ" name="addOnServ">

                                        <option selected value hidden disabled>Please select</option>

                                    </select>
                                </p>

                            </div>
                        </td>
                        <td>
                            <select class="form-control" id="aoservtyp" name="aoservtyp" onclick="getFacServCharge(this.value)">
                                <option selected value hidden disabled>Please Select</option>
                                <option value="1">Outsourced</option>
                                <option value="2">Owned</option>
                            </select>
                        </td>
                        <td>
                            <div class="row">

                                <div class="col-md">
                                    <input type="text" class="form-control" id="aoservOwner" name="aoservOwner" placeholder="Owner">
                                </div>
                            </div>

                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>