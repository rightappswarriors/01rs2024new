@extends('main')
@section('content')
@include('client1.cmp.__apply')
<style type="text/css">
	.legend {
	  background-color: #fff;
	  left: 80px;
	  padding: 20px;
	  border: 1px solid;
	}
	.legend h4 {
	  text-transform: uppercase;
	  font-family: sans-serif;
	  text-align: center;
	}
	.legend ul {
	  list-style-type: none;
	  margin: 0;
	  padding: 0;
	}
	.legend li { padding-bottom: 5px; }
	.legend span {
	  display: inline-block;
	  width: 12px;
	  height: 12px;
	  margin-right: 6px;
	}
	.ddi{
		color: #fff;
	}

</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
	<script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<body>
	@include('client1.cmp.nav')
	@include('client1.cmp.breadcrumb')
	@include('client1.cmp.msg')

	<div  style="background: #fff;padding-left: 25px;padding-right: 25px;padding-top: 0;padding-bottom: 0;">
	<!-- <div  style="background: #fff;padding: 25px;"> -->
		<div style="overflow-x: scroll; min-height: 50%" >
		<div class="card-header bg-white font-weight-bold">


      <div class="card-header bg-white font-weight-bold">



      <a href="{{asset('client1/action/compliance/')}}/{{$complianceId}}">For Corrective Action </a>/ 

        Attachment / 
        <a href="{{asset('client1/action/complianceremarks/')}}/{{$complianceId}}/{{$appid}}">Remarks</a> / 

        <div class="row mt-3">


 
        <div class="col-sm-3">
        <button type="button"  class="btn btn-info w-100" data-toggle="modal" data-target="#unregModal">
            <i class="fa fa-plus" aria-hidden="true"></i> &nbsp;
            Add Attachments
        </button>
        </div>

       
      </div>
</div>

			<table class="table table-bordered" id="tAppCl" style="border-bottom: none;border-collapse: collapse;">
				<thead class="thead-dark">
                    <tr>
                      <!-- <td scope="col" class="text-center"></td> -->
                      <td scope="col" class="text-center">Timestamp</td>
                      <td scope="col" class="text-center">File Name</td>
                      <td scope="col" class="text-center">Description</td>
                      <td scope="col" class="text-center">Type</td>
                      <td scope="col" class="text-center">From</td>
                      <td scope="col" class="text-center">Action</td>
                  </tr>
				</thead>
                <tbody>
              
              @if (isset($BigData))
                 @foreach ($BigData as $index => $data)
                 
                     <tr>
                       <td class="text-center">{{$data->date_submitted}}</td>
                       <td class="text-center">{{$data->attachment_name}}</td>
                       <td class="text-center">{{$data->description}}</td>
                       <td class="text-center">{{$data->type}}</td>
                       <td class="text-center">{{$data->authorizedsignature == "" ? $data->fname : $data->authorizedsignature }} {{$data->authorizedsignature == "" ? $data->lname : ''}}</td>
                      
                       <td>

                       <a href="{{asset('file/open')}}/{{$data->file_real_name}}" target="_blank" class="btn btn-primary"> 
                       <i class="fa fa-fw fa-eye"></i>

                       <a href="{{asset('file/open')}}/{{$data->file_real_name}}" download class="btn btn-success"> 
                       <i class="fa fa-fw fa-download"></i>
                       </td>
   
            
                     
                     </tr>

                 @endforeach
               @endif
             </tbody>
			</table>
		</div>

        <div class="modal fade" id="unregModal" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content " style="border-radius: 0px;border: none;">
                <div class="modal-body text-justify" style=" background-color: #5a636b;color: white;">
                    <h5 class="modal-title text-center">
                    <strong>Add Attachments</strong> 
                    </h5>
                    <hr>
                    <div class="input-group form-inline">
                    <div class="card-body">
                        <form id="unreg" enctype="multipart/form-data" method="POST" action="{{asset('client1/apply/complianceaddattachment')}}" data-parsley-validate>

                        {{csrf_field()}}
                        <input type="hidden" name="compliance_id" value="{{$complianceId}}">
                        <input type="hidden" name="appid" value="{{$appid}}">
                    
                        <div class="row mb-3">
                           
                            <div class="col-sm-8">
                            <input type="file" multiple name="attachment" accept=".jpg, .pdf, .png, .doc." required="required">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-sm-4">
                            <b>Name:<span style="color:red">*</span></b>
                            </div>
                            <div class="col-sm-8">
                            <input type="text" name="attachment_name" required="required" class="form-control" style="width:100%;">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-sm-4">
                            <b>Description:<span style="color:red">*</span></b>
                            </div>
                            <div class="col-sm-8">
                            <textarea name="description" style="width:100%;" rows="10" class="form-control" required="required"></textarea>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                            <button type="" name="btn_sub" class="btn btn-primary" {{-- data-toggle="modal" data-target="#uprModal" onclick="submitprompt(document.getElementById('u_nameoffaci'))" --}}><b>SUBMIT</b></button>
                            </div>
                            <div class="col-sm-6">
                            <button type="button" data-dismiss="modal"  name="btn_sub" class="btn btn-danger w-100"><b>CLOSE</b></button>
                            </div>
                        </div>
                        </form> 
                    </div>
                    </div>
                </div>
                </div>
            </div>
        </div>

	</div>
    </div>


	<script src="{{asset('ra-idlis/public/js/forall.js')}}"></script>
	<script type="text/javascript">
		"use strict";
		var ___div = document.getElementById('__applyBread');
		if(___div != null || ___div != undefined) {
			___div.classList.remove('active');
			___div.classList.add('text-primary');
		}
		(function() {
		})();
		$(function () {
		  	$('[data-toggle="tooltip"]').tooltip()
		});
		$(document).ready( function () {
		    $('#tApp').DataTable({
		    	"ordering": false,
		    	"lengthMenu": [10, 20, 50, 100]
		    });
		});
		function remAppHiddenId(elId) {
			let idom = document.getElementById(elId);
			if(idom != undefined || idom != null) {
				if(idom.hasAttribute('hidden')) {
					idom.removeAttribute('hidden');
				} else {
					idom.setAttribute('hidden', true);
				}
			}
		}
	</script>

<script type="text/javascript">
		"use strict";
		var ___div = document.getElementById('__applyBread');
		if(___div != null || ___div != undefined) {
			___div.classList.remove('active');
			___div.classList.add('text-primary');
		}
		(function() {
		})();
		$(function () {
		  	$('[data-toggle="tooltip"]').tooltip()
		});
		$(document).ready( function () {
		    $('#tAppCl').DataTable({
		    	"ordering": false,
		    	"lengthMenu": [10, 20, 50, 100]
		    });
		});
		function remAppHiddenId(elId) {
			let idom = document.getElementById(elId);
			if(idom != undefined || idom != null) {
				if(idom.hasAttribute('hidden')) {
					idom.removeAttribute('hidden');
				} else {
					idom.setAttribute('hidden', true);
				}
			}
		}
	</script>
	@include('client1.cmp.footer')
</body>
@endsection

<script>

		function subProofPay(appid){

			
			document.getElementById("uppp-"+appid).addEventListener("submit", function(event){
			event.preventDefault()
			});

			
			var form =	document.forms["uppp-"+appid].getElementsByTagName("input");
			
			if(form[0].value != ""){
				if(confirm("Are you sure you want to send your proof of payment?")){
				
					$(document).on('submit','#uppp'+appid,function(event){
						event.preventDefault();
						let data = new FormData(this);
						console.log("data")
						console.log(data)
						$.ajax({
							url: '{{asset('client1/sendproofpay')}}',
							type: 'POST',
							contentType: false,
							processData: false,
							data:data,
							success: function(a){
								console.log("a")
								// console.log(a)
								// if(a == 'DONE'){
								// 	alert('Successfully Edited Personnel');
								// 	location.reload();
								// } else {
								// 	console.log(a);
								// }
							},
							fail: function(a,b,c){
								console.log([a,b,c]);
							}
						})
					})


				// $.ajax({
				// 		url: '{{asset('client1/sendproofpay')}}',
				// 		// dataType: "json", 
	    		// 		async: false,
				// 		type: 'POST',
				// 	data:subs,
				// 	cache: false,
			    //     contentType: false,
			    //     processData: false,
				// 		success: function(a){
				// 			console.log(a.msg)
                            
				// 		}
				// 	});


				}
			}
			
		}								
										

									</script>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css" />
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/datetime/1.0.3/css/dataTables.dateTime.min.css" />