@if (session()->exists('employee_login'))
@section('title', 'Assessment Tool')
@extends('mainEmployee')

@section('content')
	<style>
		.switch {
			position: relative;
			display: inline-block;
			width: 95px;
			height: 34px;
		}

		ul,li{
			list-style-type: none;
		}

		.switch input {display:none;}

		.slider {
			position: absolute;
			cursor: pointer;
			top: 0;
			left: 0;
			right: 0;
			bottom: 0;
			background-color: #ca2222;
			-webkit-transition: .4s;
			transition: .4s;
			border-radius: 34px;
		}

		.slider:before {
			position: absolute;
			content: "";
			height: 26px;
			width: 26px;
			left: 4px;
			bottom: 4px;
			background-color: white;
			-webkit-transition: .4s;
			transition: .4s;
			border-radius: 50%;
		}

		input:checked + .slider {
			background-color: #2ab934;
		}

		input:focus + .slider {
			box-shadow: 0 0 1px #2196F3;
		}

		input:checked + .slider:before {
			-webkit-transform: translateX(26px);
			-ms-transform: translateX(26px);
			transform: translateX(55px);
		}

		/*------ ADDED CSS ---------*/
		.slider:after
		{
		padding-left:24px;
		content:'Showing uncomplied';
		color: white;
		display: block;
		position: absolute;
		transform: translate(-50%,-50%);
		top: 50%;
		left: 50%;
		font-size: 10px;
		font-family: Verdana, sans-serif;
		}

		.myRow{
			display: -webkit-box;
		    display: -ms-flexbox;
		    display: flex;
		    -ms-flex-wrap: wrap;
		    flex-wrap: wrap;
		    margin-right: -15px;
		    margin-left: -15px;
		}

		input:checked + .slider:after
		{  
			padding-right: 33px;
			content:'Show All';
		}

		div{
			overflow: hidden;
		}

		/*--------- END --------*/

		#menu1 {
			position: fixed;
			right: 0;
			top: 50%;
			left: 93.5%;
			width: 8em;
			margin-top: -2.5em;
			z-index: 9999999;
		}

		#menu{
			position: fixed;
		    bottom: 15px;
		    right: 70px;
		    width: 8em;
		    z-index: 9999999;
		    /*height: 50px;*/
		    display: block;
		}
		@media print{
			#menu, #return-to-top, nav:first-child, div.sidebar, button{
				display: none!important;
			}
			thead,tfoot {display: table-row-group;}
			.page{
				overflow: hidden;
				page-break-after: avoid;
				page-break-inside:avoid;
			}
		}
	</style>

	<div class="container" id="menu">
		<label class="switch"><input type="checkbox" id="togBtn" checked><div class="slider round"></div></label>
	</div>
	<div class="container" id="menu1">
		<button type="button" name="buttonPrint"><i class="fas fa-print" style="font-size: 30px; color:#064FF2"></i></button>
	</div>
		<form method="POST" action="{{asset('/employee/dashboard/assessment/document')}}">
			{{csrf_field()}}
			<input type="hidden" name="html" value="">
			<input type="hidden" name="filename" value="sample">
			
			<button type="submit" class="d-none" name="toSubmit"></button>
		</form>
	

	<div class="container-fluid page" id="masterFile">
		<div class="row">
			@foreach ($file as $item)
				@include('employee.assessment.'.$item)
			@endforeach
			<div class="container-fluid pb-4">
				<div class="card">
					<span class="font-weight-bold p-3">Inspected By:</span>
					<table class="table text-center">
						<thead>
							<th>Printed Name</th>
							<th>Signature</th>
							<th>Position/Designation</th>
						</thead>
						<tbody>
							@php
								$untilComma = 0;
							@endphp
							@foreach($assessor as $assessors)
							@php
								$untilComma = strpos($assessors, ',',true);
							@endphp
								<tr>
									<td scope="col">{{substr($assessors,0,$untilComma)}}</td>
									<td></td>
									<td scope="col">{{(substr($assessors,$untilComma+1) === 'NONE' ? null : substr($assessors,$untilComma+1))}}</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
			<div class="container-fluid">
				<div class="card">
					<div class="col-10 font-weight-bold pb-3">Received By:</div>
					<div class="col-10 pb-3">Signature</div>
					<div class="col-12 font-weight-bold border-bottom"></div>
					<div class="col-10 pb-3">Printed Name</div>
					<div class="col-12 font-weight-bold border-bottom"></div>
					<div class="col-10 pb-3">Position/Designation</div>
					<div class="col-12 font-weight-bold border-bottom"></div>
					<div class="col-10 pb-3">Date <span class="offset-2 font-weight-bold pl-5">{{Date('m/d/Y')}}</span></div>
				</div>
			</div>
		</div>
	</div>

	<script type="text/javascript">
	$(function(){
		let data = {!!$data!!};
	  let counter = 0;
	  $(function(){
	  	$('.input').css({
	  		'vertical-align':'middle',
	  		'text-align':'center'
	  	});
	  })

	  for (let key in data) {
	  	if(data != 'filename'){
		    if($(".input:eq("+counter+")").length > 0){
		      $(".input:eq("+counter+")").html((data[key] == 'true' || data[key] == 'false')?(data[key] == 'true'?'<i class="fa fa-check text-success" style="font-size:30px"; aria-hidden="true"></i>':'<i class="fa fa-times text-danger" style="font-size:30px"; aria-hidden="true"></i>'):(data[key]) != 'null' ? data[key] : '' );
		      // $(".input:eq("+counter+")").html(key);
		    }
		    counter++;
	    }
	  }


		$(document).on('click','#togBtn',function(){
			let currentStatus = $(this).prop('checked');
			let mf = $('#masterFile');
			if(currentStatus == true){
				$(mf).find('.input').parent().show()
			} else {	
				$(mf).find('.input').parent().hide()
				let qwe = $(mf).find('.input').parent();
				 $(qwe).each(function () {
				 	if($(this).find('td').children().hasClass('fa-times') && $(this).find('td').children().length > 0 && $(this).is(':hidden')){
				 		$(this).show();
						$(this).parent().show();
				 	}
				 })
			}
		})

		$(document).on('click','button[name=buttonPrint]',function(){
			let htmlFromHere = $("#masterFile").html();

            let final = 
            '<!DOCTYPE html>\n'+
                '<html>\n'+
                '<head>\n'+
                '<meta charset="utf-8">'+
                '<meta http-equiv="Content-Type" content="text/html; charset=utf-8">\n'+
                '<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">\n'+

                '<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">\n'+
                '<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">\n'+
                '<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css" integrity="sha384-+d0P83n9kaQMCwj8F4RJB66tzIwOKmrdb46+porD/OvrJ+37WqIM7UoBtwHO6Nlg" crossorigin="anonymous">\n'+
                '<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">\n'+
                '<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">\n'+
                '<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css">\n'+
                '<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.10/summernote-bs4.css" rel="stylesheet">\n'+
                '<style type="text/css">\n'+
					'thead{\n'+
						'display: table-row-group;\n'+
					'}\n'+
					'.page{\n'+
						'overflow: hidden;\n'+
						'page-break-after: avoid;\n'+
						'page-break-inside:avoid;\n'+
					'}\n'+

				'</style>\n'+
                '</head>\n'+
                '<body>\n'+
                htmlFromHere+
                '</body>\n'+
                '</html>\n'
                triggerCopy(final, function(){});
                

		})
	})

	function triggerCopy(final,callback){
		$('input[name=html]').val(final);
		triggerSubmit();
	}

	function triggerSubmit() {
		$("button[name=toSubmit]").click();
	}

	</script>
@overwrite


@section('errors')
  {!!(empty($selfCheck)?'<div class="alert alert-danger text-center" role="alert"><span class="lead">Current Facility did not submit a self-assessment test! </span></div>':"")!!}
@endsection

@else
  <script type="text/javascript">window.location.href= "{{ asset('employee') }}";</script>
@endif
