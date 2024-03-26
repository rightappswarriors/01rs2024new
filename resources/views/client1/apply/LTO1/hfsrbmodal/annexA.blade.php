<div class="remthis modal fade" id="viewModalA" tabindex="-1" role="dialog" aria-labelledby="viewModalLabel" aria-hidden="true" id="toDark">
    <div class="modal-dialog modal-lg" role="document" style="max-width: 1500px !important;">
        <div class="modal-content" >

            <div class="modal-header" id="viewHead">
                <h5 class="modal-title" id="viewModalLabel">LIST OF PERSONNEL (Annex A)</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <div class="modal-body" id="viewBody">
                <div id="_errMsg"></div>
        
                <div class="card-body table-responsive" id="viewAll">
                    <span id="viewModalHeader">
                        <button class="btn btn-primary mb-5" type="button" style="width:100px" data-toggle="modal" data-target="#addModalA" id="addBtn" onclick="changeFormAsset('{{asset('client1/apply/app/LTO/48/hfsrb/annexAAdd')}}')">
                            Add
                        </button>
                    </span>
                    <div id="tApp_wrapper" class="dataTables_wrapper no-footer">
                        <table class="table table-hover" style="font-size: 13px;" id="tApp">
                            <thead style="background-color: #428bca; color: white">
                                <tr role="row">
                                    <th class="text-center">ID</th>
                                    <th class="text-center">Surname</th>
                                    <th class="text-center">First Name</th>
                                    <th class="text-center">Middle Name</th>
                                    <th class="text-center">Profession*</th>
                                    <th class="text-center">PRC No.</th>
                                    <th class="text-center">Specialty</th>
                                    <th class="text-center">Date of Birth</th>
                                    <th class="text-center">Sex</th>
                                    <th class="text-center">Employment</th>
                                    <th class="text-center">Options</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach(AjaxController::getAllAnnexA() as $key => $value)
                                    <tr>
                                        <td class="text-center">{{$value->id}}</td>
                                        <td class="text-center">{{$value->surname}}</td>
                                        <td class="text-center">{{$value->firstname}}</td>
                                        <td class="text-center">{{$value->middlename}}</td>
                                        <td class="text-center">{{$value->prof}}</td>
                                        <td class="text-center">{{$value->prcno}}</td>
                                        <td class="text-center">{{$value->speciality}}</td>
                                        <td class="text-center">{{\Carbon\Carbon::parse($value->dob)->format('M d, Y')}}</td>
                                        <td class="text-center">{{$value->sex}}</td>
                                        <td class="text-center">{{$value->employement}}</td>
                                        <td>
                                            <center>
                                                <button class="btn btn-info" title="Edit" data-toggle="modal" data-target="#addModalA" onclick="changeFormAssetWithData('{{asset('client1/apply/app/LTO/48/hfsrb/annexAEdit')}}', '{{$value->id}}')">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button class="btn btn-danger" title="Delete" data-toggle="modal" data-target="#delModalA" onclick="onDelete('{{$value->id}}')">
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

            </div>
        </div>
    </div>
</div>

<div class="remthis modal fade mt-5" id="addModalA" tabindex="-1" role="dialog" aria-labelledby="viewModalLabel" aria-hidden="true" id="toDark">
    <div class="modal-dialog modal-lg shadow" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h6 class="modal-title" id="addModalLabel">NEW PERSONNEL (Do NOT include Pharmacy/X-Ray)</h6>
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
                                <div class="col-sm-12">First Name:</div>
                                <div class="col-sm-6">
                                    <input class="form-control w-100" id="add_fname" name="add_fname" required="" data-parsley="" data-parsley-required-message="<b>*First Name</b> required">
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-sm-12">Middle Name:</div>
                                <div class="col-sm-6">
                                    <input class="form-control w-100" id="add_mname" name="add_mname" required="" data-parsley="" data-parsley-required-message="<b>*Middle Name</b> required">
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-sm-12">Surname:</div>
                                <div class="col-sm-6">
                                    <input class="form-control w-100" id="add_lname" name="add_lname" required="" data-parsley="" data-parsley-required-message="<b>*Last Name</b> required">
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-sm-12">Sex:</div>
                                <div class="col-sm-6">
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="customRadioInline1" id="add_sexM" name="add_sex" value="Male" class="custom-control-input" required="" data-required="true" data-parsley-required-message="<b>*Sex</b> required" data-parsley-multiple="add_sex">
                                        <label class="custom-control-label" for="customRadioInline1">Male</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="customRadioInline2" id="add_sexF" name="add_sex" value="Female" class="custom-control-input" required="" data-required="true" data-parsley-required-message="<b>*Sex Name</b> required" data-parsley-multiple="add_sex">
                                        <label class="custom-control-label" for="customRadioInline2">Female</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-sm-12">Date of Birth:</div>
                                <div class="col-sm-6">
                                    <input class="form-control w-100" id="add_bdate"  name="add_bdate" type="date" required="" data-required="true" data-parsley-required-message="<b>*Date of Birth</b> required">
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-sm-12">Profession:</div>
                                <div class="col-sm-6">
                                    <select class="form-control w-100" name="add_profession" id="add_profession" required="" data-required="true" data-parsley-required-message="<b>*Profession</b> required">
                                        <option hidden="" selected="" disabled=""></option>
                                        {{-- <option value="N">NURSE</option>
                                        <option value="P">PHYSICIAN</option>
                                        <option value="PA">PHARMACY ASSISTANT</option>
                                        <option value="PS">PHARMACISTS</option>
                                        <option value="T">THERAPIST</option> --}}
                                        @foreach(AjaxController::getAllProfessions() as $key => $value)
                                            <option value="{{$value->pworkid}}">{{$value->pworkname}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <hr>
                            <div class="row mb-2">
                                <div class="col-sm-12"><b>Educational Background</b></div>
                            </div>
                            {{-- <div class="row mb-2">
                                <div class="col-sm-12">Highest Education Attainment:</div>
                                <div class="col-sm-6">
                                    <input class="form-control w-100" name="add_highestatt" required="" data-required="true" data-parsley-required-message="<b>*Highest Education Attainment</b> required">
                                </div>
                            </div> --}}
                            <div class="row mb-2">
                                <div class="col-sm-12">Specialty Board Certificate (for physicians), specify (if applicable):</div>
                                <div class="col-sm-6">
                                    <input class="form-control w-100" id="add_specialty" name="add_specialty">
                                </div>
                            </div>
                            <hr>
                            <div class="row mb-2">
                                <div class="col-sm-12"><b>PRC</b></div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-sm-12">PRC No.:</div>
                                <div class="col-sm-6">
                                    <input class="form-control w-100" id="add_prcno" name="add_prcno" required="" data-required="true" data-parsley-required-message="<b>*PRC No.</b> required">
                                </div>
                            </div>
                            <hr>
                            <div class="row mb-2">
                                <div class="col-sm-12"><b>Employment</b></div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-sm-12">Status:</div>
                                <div class="col-sm-6">
                                    <select class="form-control w-100" name="add_status" id="add_status" required="" data-required="true" data-parsley-required-message="<b>*Status</b> required">
                                        <option hidden="" selected="" disabled=""></option>
                                        {{--<option value="AWOL">Absent Without Leave</option>
                                        <option value="CON">Contractual</option>
                                        <option value="EOC">End of Contract</option>
                                        <option value="OTH">Others</option>
                                        <option value="PER">Permanent</option>
                                        <option value="RES">Resigned</option>
                                        <option value="RET">Retired</option>
                                        <option value="SE">Self-Employed</option>
                                        <option value="TER">Terminated</option> --}}
                                        @foreach(AjaxController::getAllEmploymentStatus() as $key => $value)
                                            <option value="{{$value->pworksid}}">{{$value->pworksname}}</option>
                                        @endforeach
                                    </select>
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

<div class="remthis modal fade mt-5" id="delModalA" tabindex="-1" role="dialog" aria-labelledby="viewModalLabel" aria-hidden="true" id="toDark">
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
    $('#addModalA').on('shown.bs.modal', function (e) {
        $("#viewBody").css({ opacity: 0.5 });
        $("#viewBody").css('background-color', '#dedede');
        $("#viewHead").css({ opacity: 0.5 });
        $("#viewHead").css('background-color', '#dedede');
        $("#addBtn").addClass("disabled");
        $('#form').parsley();
    })

    //when add modal closes
    $('#addModalA').on('hidden.bs.modal', function (e) {
        $("#viewBody").css({ opacity: 1 });
        $("#viewBody").css('background-color', '#ffffff');
        $("#viewHead").css({ opacity: 1 });
        $("#viewHead").css('background-color', '#ffffff');
        $("#addBtn").removeClass("disabled");
    })

    //when add modal opens
    $('#delModalA').on('shown.bs.modal', function (e) {
        $("#viewBody").css({ opacity: 0.5 });
        $("#viewBody").css('background-color', '#dedede');
        $("#viewHead").css({ opacity: 0.5 });
        $("#viewHead").css('background-color', '#dedede');
        $("#addBtn").addClass("disabled");
        $('#form').parsley();
    })

    //when add modal closes
    $('#delModalA').on('hidden.bs.modal', function (e) {
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
        console.log(asset);

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

            $('#addModalA').modal('hide');

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
                        '<button class="btn btn-info" title="Edit" data-toggle="modal" data-target="#addModalA" onclick="changeFormAssetWithDataee(\"{{asset("client1/apply/app/LTO/48/hfsrb/annexAEdit")}}\", '+x.row[9]+')">'+
                            '<i class="fas fa-edit"></i>' +
                        '</button>' +
                        '<button class="btn btn-danger" title="Delete" data-toggle="modal" data-target="#delModalA" onclick="onDelete(\"+x.row[9]+\")">'+
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