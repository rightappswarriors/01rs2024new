<div class="remthis modal fade" id="viewModalF" tabindex="-1" role="dialog" aria-labelledby="viewModalLabel" aria-hidden="true" id="toDark">
    <div class="modal-dialog modal-lg" role="document" style="max-width: 1500px !important;">
        <div class="modal-content" >

            <div class="modal-header" id="viewHead">
                <h5 class="modal-title" id="viewModalLabel">LIST OF PERSONNEL FOR DIAGNOSTIC RADIOLOGY AND RADIATION SERVICES (Annex F)</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <div class="modal-body" id="viewBody">
                <div id="_errMsg"></div>

                <div class="card-body table-responsive" id="viewAll">
                    <span id="viewModalHeader">
                        <button class="btn btn-primary mb-5" type="button" style="width:100px" data-toggle="modal" data-target="#addModalF" id="addBtn" onclick="changeFormAsset('{{asset('client1/apply/app/LTO/48/hfsrb/annexAAdd')}}')">
                            Add
                        </button>
                    </span>
                    <div id="tApp_wrapper" class="dataTables_wrapper no-footer">
                        <table class="table table-hover" style="font-size: 13px;" id="tApp">
                            <thead style="background-color: #428bca; color: white">
                                <tr role="row">
                                    <th class="text-center">Name</th>
                                    <th class="text-center">Position/Designation</th>
                                    <th class="text-center">Rad No.</th>
                                    <th class="text-center">Rad Onco</th>
                                    <th class="text-center">FPCR*</th>
                                    <th class="text-center">DPBR*</th>
                                    <th class="text-center">DOH Cert*</th>
                                    <th class="text-center">FP CCP*</th>
                                    <th class="text-center">Trained*</th>
                                    <th class="text-center">FPROS*</th>
                                    <th class="text-center">RXT*</th>
                                    <th class="text-center">RRT*</th>
                                    <th class="text-center">RSO*</th>
                                    <th class="text-center">Others*</th>
                                    <th class="text-center">PRC License No.</th>
                                    <th class="text-center">Validity*</th>
                                    <th class="text-center">Options</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach(AjaxController::getAllAnnexA() as $key => $value)
                                    <tr>
                                        <td class="text-center">{{$value->surname}}</td>
                                        <td class="text-center">{{$value->prof}}</td>
                                        <td class="text-center">{{$value->prcno}}</td>
                                        <td class="text-center">{{$value->speciality}}</td>
                                        <td class="text-center">{{\Carbon\Carbon::parse($value->dob)->format('M d, Y')}}</td>
                                        <td class="text-center">{{$value->sex}}</td>
                                        <td class="text-center">{{$value->employement}}</td>
                                        <td class="text-center">{{$value->employement}}</td>
                                        <td class="text-center">{{$value->employement}}</td>
                                        <td class="text-center">{{$value->employement}}</td>
                                        <td class="text-center">{{$value->employement}}</td>
                                        <td class="text-center">{{$value->employement}}</td>
                                        <td class="text-center">{{$value->employement}}</td>
                                        <td class="text-center">{{$value->employement}}</td>
                                        <td class="text-center">{{$value->prcno}}</td>
                                        <td class="text-center">{{$value->employement}}</td>
                                        <td>
                                            <center>
                                                <button class="btn btn-info" title="Edit" data-toggle="modal" data-target="#addModalF" onclick="changeFormAssetWithData('{{asset('client1/apply/app/LTO/48/hfsrb/annexFEdit')}}', '{{$value->id}}')">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button class="btn btn-danger" title="Delete" data-toggle="modal" data-target="#delModalF" onclick="onDelete('{{$value->id}}')">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </center>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
				
				<div class="card-body table-responsive" >
				<table >
					<tr>
						<td>LEGEND</td>
						<td>&nbsp;&nbsp;&nbsp;</td>
						<td>&nbsp;</td>
					</tr>
					<tr>
						<td>Rad. – Radiology/X-ray Department</td>
						<td>&nbsp;&nbsp;&nbsp;</td>
						<td>FPCCP – Fellow of the Philippine College of Chest Physicians</td>
					</tr>
					<tr>
						<td>Rad. Onco – Radiation Oncology Department</td>
						<td>&nbsp;&nbsp;&nbsp;</td>
						<td>FPROS – Fellow of the Philippine Radiation Oncology Society</td>
					</tr>
					<tr>
						<td>FPCR - Fellow of the Philippine College of Radiology</td>
						<td>&nbsp;&nbsp;&nbsp;</td>
						<td>RXT – Registered X-ray Technologist</td>
					</tr>
					<tr>
						<td>DPBR – Diplomate of the Philippine Board of Radiology</td>
						<td>&nbsp;</td>
						<td>RRT – Registered Radiologic Technologist</td>
					</tr>
					<tr>
						<td>DOH Cert – Department of Health Certified</td>
						<td>&nbsp;&nbsp;&nbsp;</td>
						<td>&nbsp;</td>
					</tr>
				</table>
				</div>
            </div>
        </div>
    </div>
</div>

<div class="remthis modal fade mt-5" id="addModalF" tabindex="-1" role="dialog" aria-labelledby="viewModalLabel" aria-hidden="true" id="toDark">
    <div class="modal-dialog modal-lg shadow" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h6 class="modal-title" id="addModalLabel">NEW PERSONNEL FOR DIAGNOSTIC RADIOLOGY AND RADIATION SERVICES</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <div class="modal-body">

                <div class="card-body table-responsive" id="addAll">
                    <form method="POST" action="{{asset('client1/apply/app/LTO/48/hfsrb/annexAAdd')}}" id="form" data-parsley-validate novalidate>
                        {{csrf_field()}}
                        <input id="appid" type="hidden" name="appid" value="{{$appid}}">
                        <input id="id" type="hidden" name="id" value="">
                        <div class="container">
                            <div class="row mb-2">
                                <div class="col-sm-12"><b>Basic Information</b></div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-sm-12">Personnel Name:</div>
                                <div class="col-sm-6">
                                    <input class="form-control w-100" id="add_lname" name="add_lname" required="" data-parsley="" data-parsley-required-message="<b>*PERSONNEL Name</b> required">
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-sm-12">Profession:</div>
                                <div class="col-sm-6">
									<input class="form-control w-100" id="add_lname" name="add_profession" required="" data-parsley="" data-parsley-required-message="<b>*PROFESSION</b> required">
                                    <!-- select class="form-control w-100" name="add_profession" id="add_profession" required="" data-required="true" data-parsley-required-message="<b>*Profession</b> required">
                                        <option hidden="" selected="" disabled=""></option>
                                        {{-- <option value="N">NURSE</option>
                                        <option value="P">PHYSICIAN</option>
                                        <option value="PA">PHARMACY ASSISTANT</option>
                                        <option value="PS">PHARMACISTS</option>
                                        <option value="T">THERAPIST</option> --}}
                                        @foreach(AjaxController::getAllProfessions() as $key => $value)
                                            <option value="{{$value->pworkid}}">{{$value->pworkname}}</option>
                                        @endforeach
                                    </select --->
                                </div>
                            </div>
                            <hr>
                            
                            <div class="row mb-2">
                                <div class="col-sm-12">Department:</div>
                                <div class="col-sm-6">
                                    <select class="form-control w-100" name="add_profession" id="add_profession" required="" data-required="true" data-parsley-required-message="<b>*Profession</b> required">
                                        <option hidden="" selected="" disabled=""></option>
                                        <option value="RX">Radiology/X-ray</option>
                                        <option value="RO">	Radiation Oncology</option>
                                    </select>
                                </div>
                            </div>
                            <hr>
							
							<div class="row mb-2">
                                <div class="col-sm-12"><b>Qualification/Certification</b></div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-sm-12"><input type="checkbox">&nbsp;Fellow of the Philippine College of Radiology</div>
                                <div class="col-sm-12"><input type="checkbox">&nbsp;Diplomate of the Philippine Board of Radiology</div>
                                <div class="col-sm-12"><input type="checkbox">&nbsp;Department of Health Certified</div>
                                <div class="col-sm-12"><input type="checkbox">&nbsp;Fellow of the Philippine College of Chest Physicians</div>
                                <div class="col-sm-12"><input type="checkbox">&nbsp;Trained</div>
                                <div class="col-sm-12"><input type="checkbox">&nbsp;Fellow of the Philippine Radiation Oncology Society</div>
                                <div class="col-sm-12"><input type="checkbox">&nbsp;Registered X-ray Technologist</div>
                                <div class="col-sm-12"><input type="checkbox">&nbsp;Registered Radiologic Technologist</div>
                                <div class="col-sm-12"><input type="checkbox">&nbsp;Radiation Oncology Society</div>
                                
                            </div>
							
                            <hr>
							<div class="row mb-2">
                                <div class="col-sm-12"><b>PRC Information</b></div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-sm-12">PRC No.:</div>
                                <div class="col-sm-6">
                                    <input class="form-control w-100" id="add_prcno" name="add_prcno" required="" data-required="true" data-parsley-required-message="<b>*PRC No.</b> required">
                                </div>
                            </div>
                            
							<div class="row mb-2">
                                <div class="col-sm-12">PRC Validity From:</div>
                                <div class="col-sm-6">
                                    <input type="date" class="form-control w-100" name="add_prcno" required="" data-required="true" data-parsley-required-message="<b>*PRC No.</b> required">
                                </div>
                            </div>
							
							<div class="row mb-2">
                                <div class="col-sm-12">PRC Validity To:</div>
                                <div class="col-sm-6">
                                    <input type="date" class="form-control w-100" name="add_prcno" required="" data-required="true" data-parsley-required-message="<b>*PRC No.</b> required">
                                </div>
                            </div>
							
                            <hr>
                            <div class="row mb-2">
                                <div class="col-sm-12">&nbsp;</div>
                                <div class="col-sm-6">
                                    <button class="btn btn-success w-100" type="button" onclick="onSubmit()">SUBMIT</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="remthis modal fade mt-5" id="delModalF" tabindex="-1" role="dialog" aria-labelledby="viewModalLabel" aria-hidden="true" id="toDark">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="viewModalLabel"><i class="fas fa-exclamation-triangle text-warning"></i> You are about to delete this record</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <div class="modal-body" id="delBody">

            </div>

            <div class="modal-footer">
                <form method="POST" action="{{asset('client1/apply/app/LTO/48/hfsrb/annexADelete')}}">
                    {{csrf_field()}}

                    <input type="hidden" name="id" id="did">
                    <button class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    //when add modal opens
    $('#addModalF').on('shown.bs.modal', function (e) {
        $("#viewBody").css({ opacity: 0.5 });
        $("#viewBody").css('background-color', '#dedede');
        $("#viewHead").css({ opacity: 0.5 });
        $("#viewHead").css('background-color', '#dedede');
        $("#addBtn").addClass("disabled");
        $('#form').parsley();
    })

    //when add modal closes
    $('#addModalF').on('hidden.bs.modal', function (e) {
        $("#viewBody").css({ opacity: 1 });
        $("#viewBody").css('background-color', '#ffffff');
        $("#viewHead").css({ opacity: 1 });
        $("#viewHead").css('background-color', '#ffffff');
        $("#addBtn").removeClass("disabled");
    })

    //when add modal opens
    $('#delModalF').on('shown.bs.modal', function (e) {
        $("#viewBody").css({ opacity: 0.5 });
        $("#viewBody").css('background-color', '#dedede');
        $("#viewHead").css({ opacity: 0.5 });
        $("#viewHead").css('background-color', '#dedede');
        $("#addBtn").addClass("disabled");
        $('#form').parsley();
    })

    //when add modal closes
    $('#delModalF').on('hidden.bs.modal', function (e) {
        $("#viewBody").css({ opacity: 1 });
        $("#viewBody").css('background-color', '#ffffff');
        $("#viewHead").css({ opacity: 1 });
        $("#viewHead").css('background-color', '#ffffff');
        $("#addBtn").removeClass("disabled");
    })

    function changeFormAsset(asset) {
        let form = document.getElementById('form');
            form.removeAttribute('action');
            form.setAttribute('action', asset);
    }

    function changeFormAssetWithData(asset, id) {
        let form = document.getElementById('form');
            form.removeAttribute('action');
            form.setAttribute('action', asset);

        document.getElementById('id').value=id;

        annexa.open("GET", "{{asset('client1/apply/app/LTO/48/hfsrb/getAnnexAById')}}"+id, true);
        annexa.send();
    }

    var annexa = new XMLHttpRequest();
    annexa.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            // Typical action to be performed when the document is ready:
            var x = JSON.parse(this.responseText);

            Array.from(x).forEach(function(v) {
                $('input[name=add_fname]').val(v.surname);
                $('input[name=add_mname]').val(v.firstname);
                $('input[name=add_lname]').val(v.middlename);
                $('input[name=add_bdate]').val(v.dob);
                $('#add_profession').val(v.prof);
                // $('input[name=add_highestatt]').val(v.);
                $('input[name=add_specialty]').val(v.speciality);
                $('input[name=add_prcno]').val(v.prcno);
                $('#add_status').val(v.employement);
            });
        }
    };

    function onDelete(id) {
        document.getElementById('did').value=id;
    }

    function onSubmit() {
        var appid = document.getElementById('appid').value;
        var fname = document.getElementById('add_fname').value;
        var mname = document.getElementById('add_mname').value;
        var lname = document.getElementById('add_lname').value;
        var sex = $('[name="add_sex"]:checked').val();
        var dob = document.getElementById('add_bdate').value;
        var prof = document.getElementById('add_profession').value;
        var spec = document.getElementById('add_specialty').value;
        var prcno = document.getElementById('add_prcno').value;
        var status = document.getElementById('add_status').value;

        if ($.trim($('#add_fname').val()) == '') {
            alert('Input can not be left blank');
            return false;
        } else if ($.trim($('#add_mname').val()) == '') {
            alert('Input can not be left blank');
            return false;
        } else if ($.trim($('[name="add_sex"]:checked').val()) == undefined || $.trim($('[name="add_sex"]:checked').val()) == null) {
            alert('Input can not be left blank');
            return false;
        } else if ($.trim($('#add_lname').val()) == '') {
            alert('Input can not be left blank');
            return false;
        } else if ($.trim($('#add_bdate').val()) == '') {
            alert('Input can not be left blank');
            return false;
        } else if ($.trim($('#add_profession').val()) == '') {
            alert('Input can not be left blank');
            return false;
        } else if ($.trim($('#add_specialty').val()) == '') {
            alert('Input can not be left blank');
            return false;
        } else if ($.trim($('#add_prcno').val()) == '') {
            alert('Input can not be left blank');
            return false;
        } else if ($.trim($('#add_status').val()) == '') {
            alert('Input can not be left blank');
            return false;
        }


        add.open("GET", "{{asset('client1/apply/app/LTO/48/hfsrb/annexAAdd')}}"+fname+"/"+mname+"/"+lname+"/"+sex+"/"+dob+"/"+prof+"/"+spec+"/"+prcno+"/"+status+"/"+appid, true); 
        add.send();
    }

    var add = new XMLHttpRequest();
    add.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            // Typical action to be performed when the document is ready:
            var x = JSON.parse(this.responseText);

            console.log(x);
            if(x.data) {
                alert('Successfully added new personnel.')
            } else {
                alert('An error has occured. Please refresh and try again.')
            }

            $('#addModalF').modal('hide');

            $('#tApp').DataTable().row.add([
                    "<center>"+x.data+"</center>",
                    "<center>"+x.row[2]+"</center>",
                    "<center>"+x.row[0]+"</center>",
                    "<center>"+x.row[1]+"</center>",
                    "<center>"+x.row[5]+"</center>",
                    "<center>"+x.row[7]+"</center>",
                    "<center>"+x.row[6]+"</center>",
                    "<center>"+x.row[4]+"</center>",
                    "<center>"+x.row[3]+"</center>",
                    "<center>"+x.row[8]+"</center>",
                    "<center>"+
                        '<button class="btn btn-info" title="Edit" data-toggle="modal" data-target="#addModalF" onclick="changeFormAssetWithData(\"{{asset("client1/apply/app/LTO/48/hfsrb/annexAEdit")}}\", '+x.row[9]+')">'+
                            '<i class="fas fa-edit"></i>' +
                        '</button>' +
                        '<button class="btn btn-danger" title="Delete" data-toggle="modal" data-target="#delModalF" onclick="onDelete(\"+x.row[9]+\")">'+
                            '<i class="fas fa-trash-alt"></i>' +
                        '</button>' +
                    "</center>"
                ]).draw();
        }
    };

    // $('#tApp').DataTable();
    $('#tApp').DataTable();
</script>
</center>