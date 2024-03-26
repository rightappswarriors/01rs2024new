@section('title')
RL - FDA
@endsection
@extends('main')
@section('content')
@include('client1.cmp.__payment')

<body>
    <style type="text/css">
        table,
        thead,
        tbody,
        tr,
        td,
        th {
            border: 1px solid black !important;
        }

        @media print {
            .hidePrint {
                visibility: hidden;
            }

            @page {
                margin: 0;
            }

            body {
                margin: 1.6cm;
            }

            .pagebreak {
                page-break-before: always;
            }
        }

        .table th {
            vertical-align: middle;
            text-align: center !important;
        }

        .tab {
            margin-left: 40px;
        }
    </style>
    <div class="container mt-5 mb-5">
        <!-- <div class="container mt-5 mb-5"> -->
        <div class="card">

            <!-- <div class="card-header">
				<div class="row">
					<div class="col-md-2 hide-div">
						<img src="{{asset('ra-idlis/public/img/doh2.png')}}" style="float: right; max-height: 118px; padding-left: 20px;">
					</div>
					<div class="col-md-8">
						<h6 class="card-title text-center">Republic of the Philippines  </h6>
						<h5 class="card-title text-center">Department of Health</h5>
						<h5 class="card-title text-center">FOOD AND DRUG ADMINISTRATION</h5>
						<h5 class="card-title text-center">Filinvest Corporate City</h5>
						<h5 class="card-title text-center">Alabang, City of Muntinlupa</h5>
					</div>
					<div class="col-md-2 hide-div">
						<img src="{{asset('ra-idlis/public/img/fda.png')}}" class="img-fluid" style="float: left; padding-right: 30px; margin-top: 30px;">
					</div>
				</div>
			</div> -->
            <div>
                <!-- <div  style="padding-left: 80px;padding-right: 80px;"> -->
                <div class="card-body">

                    <div style="padding-left: 45%; ">

                        <div class="row">
                            <div class="col-md-5">
                                <h5><b>Authorized Status</b></h5>
                            </div>
                            <div class="col-md-1">:</div>
                            <div class="col-md-6"></div>
                        </div>
                        <div class="row">
                            <div class="col-md-5">
                                <h5><b>CDRRHR-RRD LTO No</b></h5>
                            </div>
                            <div class="col-md-1">:</div>
                            <div class="col-md-6"></div>
                        </div>

                    </div>
                    <br />



                    <center>
                        <div class="container text-center pt-3 font-weight-bold" style="font-size: 30px;">LICENSE TO OPERATE<br />A THERAPEUTIC X-RAY FACILITY</div>
                    </center>
                    <br />
                    This license to operate an x-ray facility is hereby issued to:

                    <center>
                        <h1>{{strtoupper($data->facilityname)}}</h1>
                    </center>


                    <div class="container mt-4" style=" text-align: justify;">
                        <span style="font-weight: 50em;">with business address at <b>{{$data->street_number . ' ' .$data->street_name . ' ' . AjaxController::getAddressByLocation($data->rgnid,$data->provid,$data->cmid,$data->brgyid)}}</b> for having complied with the relevant
                            administrative order/s issued by the Department of Health as
                            promulgated by the Center for Device Regulation, Radiation Health,
                            and Research of the Food and Drug Administration and in line with the provisions of Republic Act No. 9711.
                        </span>

                        <br />
                        <br />
                        <span style="font-weight: 50em;"> This license is valid <b><span style="font-weight: 80em;"> from {{isset($dets[0]->valfrom) ? Date('F j, Y',strtotime($dets[0]->valfrom)) : ''}} to {{isset($dets[0]->valto) ? Date('F j, Y',strtotime($dets[0]->valto)) : ''}}</span></b>, renewable yearly, and subject to suspension and/or revocation for any violation/s of the above mentioned laws.</span>

                        <br />
                        <br />
                        <span><b>Given in Manila, Philippines this <u>{{Date('jS',strtotime($data->issuedate))}}</u> day of <u>{{Date('F Y',strtotime($data->issuedate))}}</u></b></span>
                        <!-- <span><b>Given in Manila, Philippines this «Date_Issued» two thousand and twenty one.</b></span> -->

                        <br />
                        <br />
                        <div class="row">
                            <div class="col-md-6">
                                <!-- <h3>*«DTN»*</h3>
                                <b>D T N : «DTN»</b> -->

                                <b>D T N :</b>

                            </div>
                            <div class="col-md-6">
                                <h4><b>BY AUTHORITY OF THE DIRECTOR GENERAL</b></h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">


                            </div>
                            <div class="col-md-6">
                                <center>
                                    <span class="text-center font-weight-bold">
                                        ATTY. EMILIO L. POLIG, JR.
                                    </span>
                                    <br>
                                    <span class="text-center">
                                        Director.
                                    </span>
                                    <br>
                                    <span class="text-center">
                                        Field Regulatory Operation Office.
                                    </span>
                                </center>
                            </div>
                        </div>

                    </div>

                    <br />
                    <span><b>Radiation Therapy Service Category:</b></span>

                    <center> <b>
                            <h3>

                                @switch($getLevel)
                                @case(4)
                                Level 1
                                @break
                                @case(5)
                                Level 2
                                @break
                                @case(6)
                                Level 3
                                @break
                                @case(7)
                                Specialized Diagnostic and Interventional X-ray Services
                                @break
                                @default
                                Not specified
                                @break
                                @endswitch
                            </h3>
                        </b></center>

                    <br />
                    <span><b>Name of Owner / Legal Person : {{$data->owner}}</b></span>
                    <br />
                    <p style="float: right;"> <b>NOT VALID WITHOUT FDA SEAL</b></p>
                    <br />
                    <br />
                    <div class="row">
                        <div class="col-md-2">OR Number</div>
                        <div class="col-md-1">:</div>
                        <div class="col-md-6"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">OR Amount</div>
                        <div class="col-md-1">:</div>
                        <div class="col-md-6"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">OR Date</div>
                        <div class="col-md-1">:</div>
                        <div class="col-md-6"></div>
                    </div>
                    <br />
                    <br />

                    <i><b>This license shall be displayed in a conspicuous place within the x-ray facility. </b></i>





                </div>
            </div>
        </div>
    </div>
    <div class="container mt-5 mb-5 pagebreak">
        <!-- <div class="container mt-5 mb-5"> -->
        <div class="card">
            <div class="card-body">
                <center>
                    <br>
                    <br>
                    <b>ADDITIONAL INFORMATION:</b>
                    <br>
                    <br>
                    <b>
                        <h3>{{strtoupper($data->facilityname)}}</h3>
                    </b>
                    <b>
                        <h3>{{$data->hfser_id}}R{{$data->rgnid}}-{{$data->appid}}</h3>
                    </b>
                    <b>
                        <h2>{{isset($dets[0]->valfrom) ? Date('F j, Y',strtotime($dets[0]->valfrom)) : ''}} to {{isset($dets[0]->valto) ? Date('F j, Y',strtotime($dets[0]->valto)) : ''}}</h2>
                    </b>
                </center>
                <br />
                <br />
                <b>Additional Personnel:</b>
                <br />
                <div class="row">
                    <div class="col-md-7">Chief Radiation Oncologist:</div>
                    <div class="col-md-5"></div>
                </div>
                <div class="row">
                    <div class="col-md-7">Certified Medical Physicist in Radiation Oncology Medical Physics:</div>
                    <div class="col-md-5"></div>
                </div>
                <div class="row">
                    <div class="col-md-7">Radiation Oncology Medical Physicist / Radiation Protection Officer (RPO):</div>
                    <div class="col-md-5"></div>
                </div>
                <div class="row">
                    <div class="col-md-7">Radiation Oncology Medical Physicist / Assistant RPO:</div>
                    <div class="col-md-5"></div>
                </div>
                <div class="row">
                    <div class="col-md-7">Chief Radiologic Technologist:</div>
                    <div class="col-md-5"><b>{{$cheifradt}}</b></div>
                </div>
                <br>
                <br>
                <b>Therapeutic X-ray Equipment:</b>
                <table style="width: 100%; text-align:center;">
                    <tr>
                        <td rowspan="2">Manufacturer/Brand</td>
                        <td rowspan="2">Model</td>
                        <td rowspan="2">Serial Number</td>
                        <td colspan="2">Energy</td>
                    </tr>
                    <tr>
                        <td>Photon</td>
                        <td>Electron</td>
                    </tr>
                    @foreach($hfsrbannexb as $Equipment)
                    <tr>

                        <td>{{($Equipment->brandname ?? 'No Brandname Entered')}}</td>
                        <td>{{($Equipment->model ?? 'No Model Entered')}}</td>
                        <td>{{($Equipment->serial ?? 'No Serial Entered')}}</td>
                        <td></td>
                        <td></td>
                    </tr>
                    @endforeach
                </table>
                <br>
                <b>Diagnostic and Specialized Equipment Used in Radiotherapy:</b>
                <table style="width: 100%; text-align:center;">
                    <tr>
                        <td rowspan="2">Manufacturer(Control Console / Tube)</td>
                        <td rowspan="2">Maximum mA</td>
                        <td rowspan="2">Maximum kVp</td>
                        <td colspan="2">Serial No.</td>
                        <td rowspan="2">Application/Use</td>
                    </tr>
                    <tr>
                        <td>Control Console</td>
                        <td>Tube</td>
                    </tr>
                    @foreach($cdrrhrxraylist as $xraylist)
                    <tr>
                        <td>{{$xraylist->brandtubeconsole}}</td>
                        <td>{{$xraylist->maxma}}</td>
                        <td>{{$xraylist->maxkvp}}</td>
                        <td>{{$xraylist->serialconsole}}</td>
                        <td>{{$xraylist->serialtubehead}}</td>
                        <td>{{$xraylist->appuse}}</td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        // window.print();
    </script>
</body>
@endsection