@extends('main')
@section('content')
@include('client1.cmp.__home')
<body>
    @include('client1.cmp.nav')
    @include('client1.cmp.breadcrumb')
    @include('client1.cmp.msg')
    @include('dashboard.client.templates.step')
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
    <style type="text/css">
        #style-15::-webkit-scrollbar-track {
            -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.1);
            background-color: #F5F5F5;
            border-radius: 10px;
        }

        #style-15::-webkit-scrollbar {
            width: 10px;
            background-color: #F5F5F5;
        }

        #style-15::-webkit-scrollbar-thumb {
            border-radius: 10px;
            background-color: #FFF;
            background-image: -webkit-gradient(linear,
                    40% 0%,
                    75% 84%,
                    from(#4D9C41),
                    to(#19911D),
                    color-stop(.6, #54DE5D))
        }
    </style>

    @include('dashboard.client.forms.loadertyle')

    @php 
        
    @endphp
    
    <div style="display: block;" id="myDivLo">
            <div class="container-fluid mt-5 mb-5">
                <div class="row">
                    <div class="col-md-8">
                    <i style="position: absolute; left:30px; font-size: 25px; cursor: pointer;" onclick="window.print()" class="fa fa-print" aria-hidden="true"></i>
<!-- <i style="position: absolutes; top: 10px;right: 2px; font-size: 25px; cursor: pointer;" onclick="window.print()" class="fa fa-print" aria-hidden="true"></i> -->                        <h2 class=" text-center pt-2"> <img src="https://idlis.infoadvance.com.ph/ra-idlis/public/img/doh2.png" style="width:50px;"> APPLICATION FORM</h2>
                    </div>
                    <div class="col-md-8">
<section class="container-fluid">
<div class="card">
    <div class="card-header">
        <p class="lead text-center text-danger">Please note: Red asterisk (*) is a required field and may be encountered throughout the system </p>
    </div>
    <div class="card-body">
        <form action="{{asset('/client1/apply/change_request_submit')}}" method="POST" class="row">
            {{ csrf_field() }}
            <!-- Application Details -->
            <input type="hidden" name="cat_id" id="cat_id" value="3">
            <input type="hidden" name="uid" id="uid" value="{{$uid}}">
            <input type="hidden" name="appid" id="appid" value="{{$registered_facility->appid}}">         
            <input type="hidden" name="regfac_id" id="regfac_id" value="{{$registered_facility->regfac_id}}">     
            <input type="hidden" name="noofbed_old" id="noofbed_old" value="{{number_format($registered_facility->noofbed,0)}}">     
               
            <!-- Application Details -->            
            <div class="form-group col-md-4">
                <label>System Registered ID: <strong class="text-xl">{{$registered_facility->regfac_id}}</strong></label>
            </div>
            <div class="form-group col-md-4">
                <label>NHFR Code: <strong class="text-xl">{{$registered_facility->nhfcode}}</strong></label>
            </div>
            <div class="form-group col-md-4">
                <h4>Application ID: <strong class="text-xl"></strong></h4>
            </div>

            <div class="form-group col-md-6">
                <label for="approving_authority_pos">Application Type<span class="text-danger">*</span></label>
                <input type="hidden" class="form-control" id="aptidnew" name="aptidnew">           
                <label><strong class="text-xl">Initial Change</strong></label>
            </div>

            <div class="form-group col-md-6">
                <label for="typeOfApplication">Type of Authorization <span class="text-danger">*</span></label>

                <label><strong class="text-xl">{{$registered_facility->hfser_desc}}</strong></label>
            </div>

            <div class="form-group col-md-6">
                <label for="approving_authority_pos">License/Accreditation Number : </label>
                <label><strong class="text-xl">{{$registered_facility->con_id}} {{$registered_facility->ptc_id}} {{$registered_facility->lto_id}} {{$registered_facility->ato_id}} {{$registered_facility->coa_id}} {{$registered_facility->cor_id}}</strong></label>
            </div>

            <div class="form-group col-md-6">
                <label for="approving_authority_pos">Validity Date : </label>
                <label><strong>{{$validity}}</strong></label>
            </div>

            <div class="form-group col-md-12">
                <label for="facility_name">Registered Facility Name : <span class="text-danger">*</span> </label>
                <h3 class="text-center text-uppercase"><strong>{{$registered_facility->facilityname_old}}</strong></h3>
            </div>

            @if($registered_facility->facilityname != $registered_facility->facilityname_old)
                <div class="form-group col-md-12">
                    <label for="facility_name"><i>Rename Facility to <span class="text-danger">*</span></i> </label>
                    <div class="input-group">
                        <input type="text" name="facilityname" readonly="" class="form-control text-center text-uppercase" placeholder="FACILITY NAME" value="{{$registered_facility->facilityname}}" id="facility_name" onblur="checkFacilityNameNew(this.value)" required=""> 
                    </div>
                </div>
            @endif

            <div class="form-group col-md-12">
                <label for="facility_name">Registered Facility Address : <span class="text-danger">*</span> </label>
                <label class="text-center text-uppercase"><strong>{{$registered_facility->mailingAddress}}</strong></label>
            </div>

            @if($registered_facility->facilitytype != $registered_facility->facilitytype)
                <div class="form-group col-md-12">
                    <label for="facility_name">Change in Facility Address to<span class="text-danger">*</span></label>
                    <div class="input-group">
                        <input type="text" name="facilityaddress" readonly="" class="form-control" placeholder="FACILITY ADDRESS" value="{{$registered_facility->mailingAddress}}" id="facility_name" required=""> 
                    </div>
                </div>
            @endif


            <div class=" ambuDetails" style="width: 100%;">
                <div class="col-md-12 ">
                    <b class="text-primary "> Ambulance Details:
                    </b>
                </div>
                <!-- <div class="showifHospital ambuDetails" style="width: 100%;" hidden> -->

                <div class="col-md-12">
                    <span class="text-danger">NOTE: For Owned ambulance, Payments are as follows:</span> <br>
                    Ambulance Service Provider = ₱ 5,000
                    Ambulance Unit (Per Unit) = ₱ 1,000
                </div>
                <div style="width:95%; padding-left: 35px">
                    <div class="mb-2 col-md-12">&nbsp;</div>


                    <div class="row col-border-right showAmb">
                    
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <td> <button class="btn btn-success" id="buttonId"><i class="fa fa-plus-circle"></i></button> </td>
                                    <th>Ambulance Service(Type 1, Type 2)</th>
                                    <th>Ambulance Type(Owned, Outsoured)</th>
                                    <th>Details</th>
                                </tr>
                            </thead>
                            <tbody id="body_amb">
                                <tr id="tr_amb" hidden>
                                    <!-- preventDef -->
                                    <!-- onclick="if(! this.parentNode.parentNode.hasAttribute('id')) { this.parentNode.parentNode.parentNode.removeChild(this.parentNode.parentNode); }" -->
                                    <!-- onClick="$(this).closest('tr').remove();" -->
                                    <td onclick="preventDef()"> <button class="btn btn-danger " onclick="if(! this.parentNode.parentNode.hasAttribute('id')) { this.parentNode.parentNode.parentNode.removeChild(this.parentNode.parentNode); }"><i class="fa fa-minus-circle"></i></button> </td>
                                    <td>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <label class="input-group-text" for="typeamb"><i class="fa fa-info" data-toggle="tooltip" data-placement="top" title="Lorem ipsum dolar"></i></label>
                                            </div>
                                            <select class="form-control ctyamb" id="typeamb" name="typeamb">
                                                <option selected value hidden disabled>Please select</option>
                                                <option value="1">Type 1 (Basic Life Support)</option>
                                                <option value="2">Type 2 (Advance Life Support)</option>
                                            </select>
                                        </div>
                                    </td>
                                    <td>
                                        <select class="form-control cambt" id="ambtyp" name="ambtyp">
                                            <option selected value hidden disabled>Please Select</option>
                                            <option value="1">Outsourced</option>
                                            <option value="2">Owned</option>
                                        </select>
                                    </td>
                                    <td>
                                        <div class="row">
                                            <div class="col-md">
                                                <input type="text" class="form-control cpn" id="plate_number" name="plate_number" placeholder="Plate Number/Conduction Sticker">
                                            </div>
                                            <div class="col-md" id="ambownerdiv" hidden>
                                                <input type="text" class="form-control" id="ambOwner" name="ambOwner" placeholder="Owner">
                                            </div>
                                        </div>

                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>

            <button type="submit" class="btn btn-primary action-btn"  style="margin:auto; margin-top:10px;">
                <i class="fa fa-floppy-o" aria-hidden="true"></i> Submit Application
            </button>

        </form>
    </div>
</div>



<style>
    .action-btn {
        margin:20px;
    }
    .feedback {
        width: 100%;
        display: block;
    }
    .custom-selectpicker {
        border: 1px solid #ced4da;
    }
    .region {
        display: none;
    }
    .province {
        display: none;
    }
</style>

       </div>
            </div>
            <!-- Modals -->
            
            <!-- Modal -->
         
</div>
</div>
    @include('dashboard.client.forms.loaderscript')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js" integrity="sha512-bZS47S7sPOxkjU/4Bt0zrhEtWx0y0CRkhEp8IckzK+ltifIIE9EMIMTuT/mEzoIMewUINruDBIR/jJnbguonqQ==" crossorigin="anonymous"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
    <script>
        const base_url = '{{URL::to('/')}}';
    </script>
    <script src="{{asset('ra-idlis/public/js/clients/application-form.js')}}"></script>
    <script>
         
         function initialAmbulDetails(typeamb, ambtyp, plate_number, ambOwner){
            if(typeamb.length > 0){
                var nltypa =  document.getElementById("tr_amb" ).querySelectorAll('#typeamb');
                nltypa[0].value = typeamb[0];  
                
                var nlamntyp =  document.getElementById("tr_amb" ).querySelectorAll('#ambtyp');
                nlamntyp[0].value = ambtyp[0]; 

                var nlpn =  document.getElementById("tr_amb" ).querySelectorAll('#plate_number');
                nlpn[0].value = plate_number[0]; 

                                        var nlao =  document.getElementById("tr_amb" ).querySelectorAll('#ambOwner');
                                        var nlaodiv =  document.getElementById("tr_amb" ).querySelectorAll('#ambownerdiv');
                                        
                                        if(ambtyp[0] == 1){
                                            nlaodiv[0].removeAttribute('hidden')
                                            nlao[0].value = ambOwner[0]; 
                                        }
                                        
                for(var ta = 1; ta < typeamb.length ; ta++){
                
                                    var trAdon =   document.getElementById("tr_amb");
                                    var cln = trAdon.cloneNode(true);
                                    cln.removeAttribute("id");
                                    cln.removeAttribute("hidden");
                                    cln.setAttribute("class", "tr_amb");
                                    cln.className += cln.className ? " "+"amb"+ta : "amb"+ta
                                    document.getElementById("body_amb").appendChild(cln);

                                    var nltypa =  document.getElementsByClassName("amb"+ta )[0].querySelectorAll('#typeamb');
                                    nltypa[0].value = typeamb[ta]; 

                                    var nlamntyp =  document.getElementsByClassName("amb"+ta )[0].querySelectorAll('#ambtyp');
                                    nlamntyp[0].value = ambtyp[ta]; 

                                    var nlpn =  document.getElementsByClassName("amb"+ta )[0].querySelectorAll('#plate_number');
                                    nlpn[0].value = plate_number[ta];  
                                    
                        
                                        var nlao =  document.getElementsByClassName("amb"+ta )[0].querySelectorAll('#ambOwner');
                                        var nlaodiv =  document.getElementsByClassName("amb"+ta )[0].querySelectorAll('#ambownerdiv');
                                        if(ambtyp[ta] == 1){
                                            nlaodiv[0].removeAttribute('hidden')
                                            nlao[0].value = ambOwner[ta]; 
                                        }
                
                }
            }

        }

        document.getElementById("buttonId").addEventListener("click", function(event) {
            event.preventDefault()
            var itm = document.getElementById("tr_amb");
            var cln = itm.cloneNode(true);
            cln.removeAttribute("id");
            cln.removeAttribute("hidden");
            cln.setAttribute("class", "tr_amb");
            document.getElementById("body_amb").appendChild(cln);
        });
    </script>
    @include('client1.cmp.footer')
    @include('dashboard.client.forms.generalFormScript')
</body>
@endsection