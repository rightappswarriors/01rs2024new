    @if (session()->exists('employee_login'))


    @extends('mainEmployee')
    @section('title', 'Service Charges Master File')
    @section('content')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">


    <style>
        .modal-xl {
            width: 98%;
            max-width: 2000px;
        }

        .formst td {
            padding: 10px;
            border: .5px solid gray;
            border-collapse: collapse;
            text-align: center;
        }

        .formst th {
            border: .5px solid gray;
            border-collapse: collapse;
            padding: 5px;
            text-align: center;
            background-color: #7db073;
        }

        .typeStyle {
            background-color: #8ec984;
        }
    </style>
    <div class="content p-4">
		<div class="card">
		<div class="card-header bg-white font-weight-bold">
             Service Fees
			 @include('employee.tableDateSearch')
			 <a href="#" title="Add New Service Charge" data-toggle="modal" data-target="#myModal"><button class="btn-primarys"><i class="fa fa-plus-circle"></i>&nbsp;Add new</button></a>
         </div>
		  
		
		<div class="card-body table-responsive">
        <table class="table display table-hover" style="width: 100%; zoom: 85%" id="example">
            <thead>
				<tr>
                      <th></th>
                      <th class="select-filter"></th>
                      <th ></th>
                      <th ></th>
                      <th  class="select-filter"></th>
                      <th></th>
                      <th class="select-filter"></th>
                      <th ></th>
                      <th ></th>
                      <th ></th>
                      <th ></th>
                      <th ></th>
                      <th ></th>
                     
                  </tr>
                <tr>
                    <td  scope="col" class="text-center"> <label for="servid">ID</label></td>
                    <td  scope="col" class="text-center"> <label for="hfser_id">Application Type</label></td>
                    <td  scope="col" class="text-center"> <label for="servetype">Service Type</label></td>
                    <td  scope="col" class="text-center"> <label for="ocid">Ownership <br />type</label></td>
                    <td  scope="col" class="text-center"><label for="facmode">Instituitional<br /> Character</label></td>
                    <td  scope="col" class="text-center"> <label for="funcid">Function </label></td>
                    <td  scope="col" class="text-center"><label>Initial<br /> New<br /> Amt</label></td>
                    <td  scope="col" class="text-center"><label>Initial<br /> Change<br /> Amt</label></td>
                    <td  scope="col" class="text-center"><label>Renewal<br /> Amt</label></td>
                    <!-- <td colspan="3">Amount</td> -->
                    <td  scope="col" class="text-center"> <label for="reperiod">Renewal<br /> Period</label></td>
                    <td  scope="col" class="text-center"> <label for="reperiod">Remarks</label></td>
                    <td  scope="col" class="text-center"> <label for="penalty">For <br /> Penalty</label></td>
                    <td  scope="col" class="text-center"> <label for="penalty"></label></td>
                </tr>
                <!-- <tr>

                    <td class="typeStyle"><small>Initial new</small></td>
                    <td class="typeStyle"><small>Initial change</small></td>
                    <td class="typeStyle"><small>Renewal</small></td>
                </tr> -->
            </thead>
            <tbody id="FilterdBody">
                @foreach($data as $d => $value)
                <tr>
                    <td>{{$value->id}}</td>
                    <td>@if(isset($value->hfser_id)){{$value->hfser_id}}@endif</td>
                @if($type == 'service')
                <td>{{$value->facname}} {{$value->spec ? '('.$value->spec.')' : '('.$value->hgpdesc.'-'.$value->anc_name.')' }}</td>
                @else
                <td>{{$value->fee_name}}</td>
                @endif
                 
                    <td>{{$value->ocid == 'G' ? 'Government':( $value->ocid == 'P' ? 'Private' : '')}}</td>
                    <td>{{$value->facmdesc}}</td>
                    <td>{{$value->funcid == 1 ? 'General' : ($value->funcid == 2 ? 'Specialty' : 'NA')}}</td>
                    <td>{{$value->initial_new_amount}}</td>
                    <td>{{$value->initial_change_amount}}</td>
                    <td>{{$value->renewal_amount}}</td>
                    <td>{{$value->renewal_period}}</td>
                    <td>{{$value->remarks}}</td>
                    <td>{{$value->isPenalties == 1 ? 'yes' : ''}}</td>
                    <td>
                        <i style="cursor: pointer; " onclick="deleteFee('{{$value->id}}')" class="fa fa-trash"></i>
                        <i style="cursor: pointer; " onclick="updateFee('{{$value->id}}', '{{$value->hfser_id }}','{{$value->ocid}}','{{$value->facmode}}','{{$value->funcid}}','{{$value->initial_new_amount}}','{{$value->renewal_amount}}','{{$value->initial_change_amount}}','{{$value->renewal_period}}','{{$value->remarks}}','{{$value->isPenalties}}')" data-toggle="modal" data-target="#upModal" class="fa fa-edit"></i>

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
		</div>



        <div class="modal fade" id="upModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content" style="border-radius: 0px;border: none;">
                    <div class="modal-body text-justify" style="color: black;">
                        <input type="hidden" class="form-control" id="upid" name="upid">
                        Application Type
                        
                        <select class="form-control   show-menu-arrow" id="uphfser_id" name="uphfser_id" data-style="text-dark form-control custom-selectpicker" data-size="5" required>
                            <!-- <select  class="form-control selectpicker show-menu-arrow " name="servetype" data-style="text-dark form-control custom-selectpicker" data-size="5" data-live-search="true" required> -->
                            <option>Please select</option>
                            
                            @foreach($apptype as $key => $value)
                            <option value="{{$value->hfser_id}}">{{$value->hfser_desc}}</option>
                            @endforeach
                        
                        </select>
                        
                        Ownership
                        <select class="form-control   show-menu-arrow" id="upocid" name="upocid" data-style="text-dark form-control custom-selectpicker" data-size="5" required>
                            <option>Please select</option>
                            <option value="G">Government</option>
                            <option value="P">Private</option>
                        </select>
                        Instituitional Character
                        <select class="form-control  show-menu-arrow" id="upfacmode" name="upfacmode" data-live-search="true" data-style="text-dark form-control custom-selectpicker" data-size="5" required>
                            <option>Please select</option>
                            <option value="4">Institution Based</option>
                            <option value="5">Non-Institution Based</option>
                        </select>
                        Function
                        <select class="form-control  show-menu-arrow" data-funcid="main" id="upfuncid" name="upfuncid" data-live-search="true" data-style="text-dark form-control custom-selectpicker" data-size="5" required>
                            <option>Please select</option>
                            <option value="1">General</option>
                            <option value="2">Specialty</option>
                            <option value="3">Not Applicable</option>
                        </select>
                        Initial New Amount
                        <input type="number" class="form-control" id="upinnamount" name="upinnamount">
                        Initial Change Amount
                        <input type="number" class="form-control  " id="upicamount" name="upicamount">
                        Renewal Charge Amount
                        <input type="number" class="form-control  " id="upreamount" name="upreamount">
                        Renewal Charge
                        <input type="number" class="form-control " id="upreperiod" name="upreperiod">

                        Remarks
                        <input type="text" class="form-control " id="upremarks" name="upremarks">
                        For penalty
                        <input type="hidden" name="upfpenalty" id="upfpenalty" ><input type="checkbox" id="upforchkbx" onclick="this.previousSibling.value=1-this.previousSibling.value">
                        <br>
                        <br>
                        <button onclick="sendUpdate()" class="btn-primarys">Save</button>

                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content" style="border-radius: 0px;border: none;">
                    <div class="modal-body text-justify" style="color: black;">
                        <h5 class="modal-title text-center"><strong>Add New Service Fee</strong></h5><button class="btn btn-success" id="buttonId"><i class="fa fa-plus-circle"></i></button>
                        <button class="btn btn-primary" onclick="submit()">Submit</button>
                        <hr>
                        <div>
                            <table class="formst" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th rowspan="2"> <label for="servetype"></label></th>
                                        <th rowspan="2"> <label for="hfser_id">Application Type</label></th>
                                        <th rowspan="2"> <label for="servetype">Service Type</label></th>
                                        <th rowspan="2"> <label for="ocid">Ownership <br />type</label></th>
                                        <th rowspan="2"><label for="facmode">Instituitional Character</label></th>
                                        <th rowspan="2"> <label for="funcid">Function </label></th>
                                        <th colspan="3">Amount</th>
                                        <th rowspan="2"> <label for="reperiod">Renewal Period</label></th>
                                        <th rowspan="2"> <label for="reperiod">Remarks</label></th>
                                        <th rowspan="2"> <label for="penalty">For <br /> Penalty</label></th>
                                    </tr>
                                    <tr>

                                        <td class="typeStyle"><small>Initial new</small></td>
                                        <td class="typeStyle"><small>Initial change</small></td>
                                        <td class="typeStyle"><small>Renewal</small></td>
                                    </tr>
                                </thead>
                                <tbody id="body_amb">
                                    <tr id="tr_amb">
                                        <td width="50"> <button class="btn btn-danger " onclick="if(! this.parentNode.parentNode.hasAttribute('id')) { this.parentNode.parentNode.parentNode.removeChild(this.parentNode.parentNode); }"><i class="fa fa-minus-circle"></i></button> </td>
                                        <td width="250">
                                            <select class="form-control  show-menu-arrow " name="hfser_id" data-style="text-dark form-control custom-selectpicker" data-size="5" data-live-search="true" required>
                                                <!-- <select  class="form-control selectpicker show-menu-arrow " name="servetype" data-style="text-dark form-control custom-selectpicker" data-size="5" data-live-search="true" required> -->
                                                <option>Please select</option>
                                                
                                                @foreach($apptype as $key => $value)
                                                <option value="{{$value->hfser_id}}">{{$value->hfser_desc}}</option>
                                                @endforeach
                                            
                                            </select>
                                        </td>
                                        <td width="400">

                                            <select class="form-control  show-menu-arrow " name="servetype" data-style="text-dark form-control custom-selectpicker" data-size="5" data-live-search="true" required>
                                                <!-- <select  class="form-control selectpicker show-menu-arrow " name="servetype" data-style="text-dark form-control custom-selectpicker" data-size="5" data-live-search="true" required> -->
                                                <option>Please select</option>
                                            @if($type == 'service')
                                                @foreach($factypes as $key => $value)
                                                <option value="{{$value->facid}}">{{$value->facname}} {{$value->spec ? '('.$value->spec.')' : '('.$value->hgpdesc.'-'.$value->anc_name.')' }}-{{$value->facid}}</option>
                                                @endforeach
                                            @else
                                                @foreach($allcat as $key => $ac)
                                                <option value="{{$ac->hgpid}}">{{$ac->hgpdesc}}</option>
                                                <!-- <option value="ac->cat_id">ac->cat_desc</option> -->
                                                @endforeach
                                            @endif
                                            </select>
                                        </td>
                                        <td width="120">

                                            <select class="form-control   show-menu-arrow" id="ocid" name="ocid" data-style="text-dark form-control custom-selectpicker" data-size="5" required>
                                                <option>Please select</option>
                                                <option value="G">Government</option>
                                                <option value="P">Private</option>
                                            </select>
                                        </td>
                                        <td width="120">

                                            <select class="form-control  show-menu-arrow" id="facmode" name="facmode" data-live-search="true" data-style="text-dark form-control custom-selectpicker" data-size="5" required>
                                                <option>Please select</option>
                                                <option value="4">Institution Based</option>
                                                <option value="5">Non-Institution Based</option>
                                            </select>
                                        </td>
                                        <td width="120">

                                            <select class="form-control  show-menu-arrow" data-funcid="main" id="funcid" name="funcid" data-live-search="true" data-style="text-dark form-control custom-selectpicker" data-size="5" required>
                                                <option>Please select</option>
                                                <option value="1">General</option>
                                                <option value="2">Specialty</option>
                                                <option value="3">Not Applicable</option>
                                            </select>
                                        </td>
                                        <td width="100">
                                            <!-- <label for="funcid">Initial Amount </label> -->
                                            <input type="number" class="form-control" id="innamount" name="innamount">
                                        <td width="100">
                                            <!-- <label for="reamount">Renewal Amount </label> -->
                                            <input type="number" class="form-control  " id="icamount" name="icamount">
                                        </td>
                                        <td width="100">
                                            <!-- <label for="reamount">Renewal Amount </label> -->
                                            <input type="number" class="form-control  " id="reamount" name="reamount">
                                        </td>
                                        <td width="80">

                                            <input type="number" class="form-control " value="1" id="reperiod" name="reperiod">
                                        </td>
                                        <td width="220">

                                            <input type="text" class="form-control " id="remarks" name="remarks">
                                        </td>
                                        <td width="50">
                                            <input type="hidden" name="fpenalty" id="fpenalty" value="0"><input type="checkbox" onclick="this.previousSibling.value=1-this.previousSibling.value">
                                            <!-- <input type="checkbox" class="form-control" id="fpenalty" value="1" name="fpenalty"> -->
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
		
		
		</div>
		</div>
        
		
		<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js" integrity="sha512-bZS47S7sPOxkjU/4Bt0zrhEtWx0y0CRkhEp8IckzK+ltifIIE9EMIMTuT/mEzoIMewUINruDBIR/jJnbguonqQ==" crossorigin="anonymous"></script>
        <!-- Latest compiled and minified JavaScript -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

        <script>
            $(document).ready(function() {
                $('#example').DataTable();
            });


            function submit() {
                const servetype = document.getElementsByName('servetype');
                const hfser_id = document.getElementsByName('hfser_id');
                const ocid = document.getElementsByName('ocid');
                const facmode = document.getElementsByName('facmode');
                const funcid = document.getElementsByName('funcid');
                const innamount = document.getElementsByName('innamount');
                const icamount = document.getElementsByName('icamount');
                const reamount = document.getElementsByName('reamount');
                const reperiod = document.getElementsByName('reperiod');
                const remarks = document.getElementsByName('remarks');
                const fpenalty = document.getElementsByName('fpenalty');
                
                console.log("servetype")
                console.log(servetype[0].value)

                const fees = [];
                for (let i = 0; i < servetype.length; i++) {
                    console.log(servetype[i].value)
                    const data = {
                        servetype: servetype[i].value,
                        hfser_id: hfser_id[i].value,
                        ocid: ocid[i].value,
                        facmode: facmode[i].value,
                        funcid: funcid[i].value,
                        innamount: innamount[i].value,
                        icamount: icamount[i].value,
                        reamount: reamount[i].value,
                        reperiod: reperiod[i].value,
                        remarks: remarks[i].value,
                        fpenalty: fpenalty[i].value,
                        type: '{{$type}}'
                    }
                    fees.push(data)
                }

                if (confirm("Are you sure you want to proceed?")) {
                    $.ajax({
                        url: "{{ asset('servicefee/save') }}",
                        method: 'post',
                        data: {
                            _token: $('#token').val(),
                            items: JSON.stringify(fees)
                        },
                        success: function(data) {
                            if (data == "DONE") {

                                alert('Successfully Added');
                                  location.reload();

                            } else if (data == "ERROR") {
                                $('#EditErrorAlert').show(100);
                            }
                        },
                        error: function(XMLHttpRequest, textStatus, errorThrown) {
                            console.log(errorThrown);
                            $('#EditErrorAlert').show(100);
                        },
                    });
                }
                console.log(fees);
            }

            function deleteFee(id) {
                if (confirm("Are you sure you want to remove this fee?")) {
                    $.ajax({
                        url: "{{ asset('servicefee/remove') }}",
                        method: 'post',
                        data: {
                            _token: $('#token').val(),
                            id: id
                        },
                        success: function(data) {
                            if (data == "DONE") {

                                alert('Fee successfully removed');
                                location.reload();

                            } else if (data == "FAILED") {
                                alert('Failed to remove fee');
                            }
                        },
                        error: function(XMLHttpRequest, textStatus, errorThrown) {
                            console.log(errorThrown);
                            $('#EditErrorAlert').show(100);
                        },
                    });
                }
            }

            function updateFee(id, hfser_id, ocid, facmode, funcid, initial_new_amount, renewal_amount, initial_change_amount, renewal_period, remarks, isPenalties) {
                $('#upid').val(id)
                $('#uphfser_id').val(hfser_id)
                $('#upocid').val(ocid)
                $('#upfacmode').val(facmode)
                $('#upfuncid').val(funcid)
                $('#upinnamount').val(initial_new_amount)
                $('#upicamount').val(initial_change_amount)
                $('#upreperiod').val(renewal_period)
                $('#upreamount').val(renewal_amount)
                $('#upremarks').val(remarks)
                $('#upfpenalty').val(isPenalties)

                if (isPenalties == 1) {
                    document.getElementById("upforchkbx").checked = true;
                } else {
                    document.getElementById("upforchkbx").checked = false;
                }
            }

            function sendUpdate() {
                var subs = {
                        id: $('#upid').val(),
                        hfser_id: $('#uphfser_id').val(),
                        ocid: $('#upocid').val(),
                        facmode: $('#upfacmode').val(),
                        funcid: $('#upfuncid').val(),
                        innamount: $('#upinnamount').val(),
                        icamount: $('#upicamount').val(),
                        reamount: $('#upreamount').val(),
                        reperiod: $('#upreperiod').val(),
                        remarks: $('#upremarks').val(),
                        fpenalty: $('#upfpenalty').val(),
                        _token: $('#token').val(),
                    }

                    console.log(subs)
                if (confirm("Are you sure you want to update date?")) {
                   

                    $.ajax({
                        url: "{{ asset('servicefee/update') }}",
                        method: 'post',
                        data: subs,
                        success: function(data) {
                            if (data == "DONE") {

                                alert('Fee successfully updated');
                                location.reload();

                            } else if (data == "FAILED") {
                                alert('Failed to update fee');
                            }
                        },
                        error: function(XMLHttpRequest, textStatus, errorThrown) {
                            console.log(errorThrown);
                            $('#EditErrorAlert').show(100);
                        },
                    });
                }
            }


            document.getElementById("buttonId").addEventListener("click", function(event) {
                event.preventDefault()
                var trs = document.getElementsByClassName("tr_amb");
                var itm = document.getElementById("tr_amb");
                var cln = itm.cloneNode(true);
                cln.removeAttribute("id");
                cln.setAttribute("class", "tr_amb");
                // cln.setAttribute("id", "tr_amb"+(parseInt(trs.length)  + 1));

                document.getElementById("body_amb").appendChild(cln);

                //         var id= "tr_amb"+(parseInt(trs.length)  + 1)
                // console.log(id)
                // setTimeout(function(){  
                //     var sel = document.getElementById(id);
                //         // .querySelectorAll('input[name="servetype"]');
                //        console.log(sel)

                //  }, 1000);

                // cln.find('input[name="servetype"]').removeClass("selectpicker")
                // cln.find('.selectpicker').remove();
                // cln.find('input[name="servetype"]').selectpicker();
                // cln.find('input[name="servetype"]').remove();
                // cln.find('input[name="servetype"]').selectpicker();
                // cln.find('input[name="servetype"]').removeClass("selectpicker");


                // var opt = document.createElement("option");
                //     opt.value = "what";
                //     opt.textContent = "whatts";
                //     sel.appendChild(opt);
            });
        </script>
        <script src="//cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
        @endsection
        @else
        <script type="text/javascript">
            window.location.href = "{{ asset('employee') }}";
        </script>
        @endif