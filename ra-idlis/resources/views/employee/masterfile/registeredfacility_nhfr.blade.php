<script src="//cdn.datatables.net/plug-ins/1.10.24/filtering/row-based/range_dates.js"></script>
<script src="https://cdn.datatables.net/datetime/1.0.3/js/dataTables.dateTime.min.js"></script>

@if (session()->exists('employee_login'))   
  @extends('mainEmployee')
  @section('title', $pg_title)
  @section('content')
  <div class="content p-4">
  	<div class="card" style="width: 165vh;" >
  		<div class="card-header bg-white font-weight-bold">
			<h3> {{$pg_title}} </h3>
			<span class="AP001_add" style="float: right; margin-top:10px;">
			
				<a href="#" title="Add New Registered Facility" data-toggle="modal" data-target="#myModal" style="margin-right:5px;"><button class="btn-primarys"><i class="fa fa-plus-circle"></i>&nbsp;Add New Facility</button></a>

				<a href="#" title="Import From NHFR" data-toggle="modal" data-target="#myModal" style="margin-right:5px;"><button class="btn-primarys"><i class="fa fa-upload"></i>&nbsp;Import From NHFR</button></a>

				<a href="#" title="Download Import Format for NHFR" data-toggle="modal" data-target="#myModal"><button class="btn-primarys"><i class="fa fa-upload"></i>&nbsp;Download Import Format for NHFR</button></a>
			</span>
      </div>
        @include('employee.masterfile.registeredfacility_filter') 
      <div class="card-body table-responsive">
        
      <table class="table table-hover" style="font-size:13px;" id="1example">
            <thead>
				<tr>
					<td scope="col" style="text-align: center;">Option</td>   
					<td scope="col" style="text-align: center;">Registered Facility ID</td>
					<td scope="col" style="text-align: center;">NHFR Code</td>
					<td scope="col" style="text-align: center;">Name of the Facilities</td>
					<td scope="col" style="text-align: center;">Address</td>
					<td scope="col" style="text-align: center;">City/Municipality</td>
					<td scope="col" style="text-align: center;">Province</td>
					<td scope="col" style="text-align: center;">Region</td>
					
					<td scope="col" style="text-align: center;">Ownership</td>
					<td scope="col" style="text-align: center;">Class / Subclass</td>
					<td scope="col" style="text-align: center;">Instituional Character</td>
					<td scope="col" style="text-align: center;">Bed Capacity</td>
					
					<td scope="col" style="text-align: center;">Name of Owner</td>
					<td se="col"cop style="text-align: center;">Facility Contact Info</td>
					
					<td scope="col" style="text-align: center;">License And Validity Date</td> 
				</tr>
            </thead>
            <tbody id="FilterdBody">
              @if (isset($LotsOfDatas))
                @foreach ($LotsOfDatas as $data)

                    <tr>
						<td><button class="btn-primarys" onclick="showData(
								'{{$data->facilityname}}',
								'{{$data->owner}}',
								'{{$data->facid}}',
								'{{$data->rgnid}}',
								'{{$data->street_number}}',
								'{{$data->street_name}}',
								'{{$data->zipcode}}',
								'{{$data->ownerMobile}}',
								'{{$data->ownerEmail}}',
								'{{$data->ocid}}',
								'{{$data->mailingAddress}}',
								'{{$data->approvingauthority}}',
								'{{$data->approvingauthoritypos}}',
								'{{$data->facmode}}',
								'{{$data->funcid}}',
								'{{$data->provid}}',
								'{{$data->cmid}}',
								'{{$data->brgyid}}',
								'{{$data->classid}}',
								'{{$data->subClassid}}',

							)" data-toggle="modal" data-target="#myModal"><i class="fas fa-eye"></i></button></td>
						<td style="text-align:left"><strong>{{$data->regfacid}}</strong></td>
						<td style="text-align:left"><strong>{{$data->facilityname}}</strong></td>
						<td style="text-align:center">{{$data->street_number}} {{$data->street_name}} {{$data->brgyname}}, {{$data->cmname}}, {{$data->provname}} {{$data->zipcode}}</td>
						<td style="text-align:center">{{$data->street_number}} {{$data->street_name}} {{$data->brgyname}}, {{$data->cmname}}, {{$data->provname}} {{$data->zipcode}}</td>
						<td style="text-align:center">{{$data->rgn_desc}}</td>
						<td style="text-align:left">{{( $data->hgpdesc ?? 'NOT FOUND')}} {{$data->facmdesc}}</td>
						<td style="text-align:left">{{$data->noofbed}}</td>                      
						
						<td style="text-align:left">{{$data->approvingauthority}}, {{$data->approvingauthoritypos}}</td>
						<td style="text-align:left">{{$data->owner}}</td>
						<td style="text-align:left">{{$data->ocdesc}}</td>
						<td style="text-align:left">{{$data->classname}}/{{$data->subclassname}}</td>
						<td style="text-align:left">{{$data->doh_retained}}</td>
						
						<td style="text-align:left">{{$data->landline}}</td>
						<td style="text-align:left">{{$data->faxnumber}}</td>
						<td style="text-align:left">{{$data->email}}</td>
						<td style="text-align:left">{{$data->hfser_id}}</td>  
						<td style="text-align:left">{{$data->license_id}}</td>   

						<td style="text-align:left">{{$data->issued_date}}</td>
						<td style="text-align:left">{{$data->approvedRemark}}</td>
                    </tr>

                @endforeach
              @endif 
            </tbody>
          </table>

      </div>
  	</div>
  </div>
  @endsection

  @include('employee.masterfile.registeredfacility_form')
<script>
	$(document).ready(function() {
		$('#example').DataTable();
	});

	const base_url = '{{URL::to('/')}}';

	function showData(facname, owner, facid, rgind,
	street_num,
	street_name,
	zip,
	ownerMobile,
ownerEmail,
ocid,
mailingAddress,
approving_authority_name,
approving_authority_pos,
facmode,
funcid,
provid,
cmid,
brgyid,
classid,
subClassid,
	){
		$("#facility_name").val(facname);
		$("#facilitytype").val(facid);
		$("#region").val(rgind);
		$("#owner").val(owner);
		$("#street_num").val(street_num);
		$("#street_name").val(street_name);
		$("#zip").val(zip);
		$("#fac_mobile_number").val(ownerMobile);
		$("#fac_email_address").val(ownerEmail);
		$("#ocid").val(ocid);
		$("#official_mail_address").val(mailingAddress);
		$("#approving_authority_name").val(approving_authority_name);
		$("#approving_authority_pos").val(approving_authority_pos);
		$("#facmode").val(facmode);
		$("#funcid").val(funcid);

		
		$("#mainbtn").val(funcid);

		fetchProvinceIN(rgind, provid)
		fetchMonicipalityIN(provid,cmid)
		fetchBaranggayIN(cmid, brgyid)
		fetchSubClassIN(ocid,classid, subClassid)
		fetchClassificationIN(ocid,classid)
		
}

const fetchSubClassIN = async (ocid,classid, subClassid) => {
     
            const data = {
                'ocid': ocid,
                'classid': classid
            }
            callApi('/api/classification/fetch', data, 'POST').then(classification => {
                $("#subclass").empty();
                $("#subclass").append(`<option value=''>Please select</option>`);
                $("#subclass").removeAttr('disabled');
                classification.data.map(c => {
                    $("#subclass").append(`<option value='${c.classid}' `+(subClassid == c.classid ? `selected="selected"` : ``) +`>${c.classname}</option>`);
                })
                $("#subclass").selectpicker('refresh')
            })
       
    }

	const fetchClassificationIN = async (ocid,classid) => {
      
            const data = {
                'ocid': ocid
            }
            callApi('/api/classification/fetch', data, 'POST').then(classification => {
                $("#classification").empty();
                $("#classification").append(`<option value=''>Please select</option>`);
                $("#classification").removeAttr('disabled');
                classification.data.map(c => {
                    $("#classification").append(`<option value='${c.classid}' `+(classid == c.classid ? `selected="selected"` : ``) +`>${c.classname}</option>`);
                })
                $("#classification").selectpicker('refresh')
            })



        


    }

const fetchProvinceIN = async (rgnid, provid) => {
       
	   const data = {
		   'rgnid': rgnid
	   }
	   callApi('/api/province/fetch', data, 'POST').then(provinces => {
		 
		   $("#province").empty();
		   $("#province").append(`<option value=''>Please select</option>`);
		   $("#province").removeAttr('disabled');
		   provinces.data.map(province => {

				
				$("#province").append(`<option  value='${province.provid}' `+(provid == province.provid ? `selected="selected"` : ``) +` >${province.provname}</option>`);
				
			
			})
		   
		   $("#province").selectpicker('refresh')
	   }).catch(err => {
		   console.log(err);
	   })
   
}


const fetchBaranggayIN = async (cmid, brgyid) => {
       
      
            const data = {
                'cmid': cmid
            }
            callApi('/api/barangay/fetch', data, 'POST').then(barangay => {
                $("#brgy").empty();
                $("#brgy").append(`<option value=''>Please select</option>`);
                $("#brgy").removeAttr('disabled');
                barangay.data.map(c => {

                    $("#brgy").append(`<option value='${c.brgyid}' `+(brgyid == c.brgyid ? `selected="selected"` : ``) +`>${c.brgyname}</option>`);
                })
                $("#brgy").selectpicker('refresh')
            }).catch(err => {
                console.log(err);
            })
       
    }

const fetchMonicipalityIN = async (provid,cmid) => {
        
       
            const data = {
                'provid': provid
            }
            callApi('/api/municipality/fetch', data, 'POST').then(city => {
                $("#city_monicipality").empty();
                $("#city_monicipality").append(`<option value=''>Please select</option>`);
                $("#city_monicipality").removeAttr('disabled');
                city.data.map(c => {
                    $("#city_monicipality").append(`<option value='${c.cmid}'  `+(cmid == c.cmid ? `selected="selected"` : ``) +` >${c.cmname}</option>`);
                })
                $("#city_monicipality").selectpicker('refresh')
            }).catch(err => {
                console.log(err);
            });       
    }

</script>



@endsection


@else
  <script type="text/javascript">window.location.href= "{{ asset('employee') }}";</script>
@endif

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css" />
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/datetime/1.0.3/css/dataTables.dateTime.min.css" />
  