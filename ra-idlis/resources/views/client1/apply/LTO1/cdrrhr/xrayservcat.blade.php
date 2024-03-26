@if (session()->exists('uData'))  
	@extends('main')
	@section('content')
	@include('client1.cmp.__apply')
	@include('client1.cmp.requirementsSlider')
	@include('client1.cmp.nav')
		@include('client1.cmp.breadcrumb')
		@include('client1.cmp.msg')

	<body>
		@php $already = []; @endphp
		@include('client1.cmp.__wizard')
		<div class="container-fluid mt-5">
			<div class="row">
				<div class="col-md-6 d-flex justify-content-start" id="prevDiv">
					<a href="#" class="inactiveSlider slider">&laquo; Previous</a>
				</div>
				<div class="col-md-6 d-flex justify-content-end" id="nextDiv">
					<a href="#" class="activeSlider slider">Next &raquo;</a>
				</div>
			</div>
		</div>
		
		<div class="container mt-5 mb-5">
			<form id="servAdd">
			<p class="text-center">
				GENERAL RADIOGRAPHY (TICK APPROPRIATE SERVICES)<br>	
				<span class="text-danger">Note: If you select a higher service xray category, you must select any lower level xray examination service.</span>
			</p>
			{{csrf_field()}}
			<div class="container">
				<div class="row">
				@php $count = 0; @endphp
				@foreach($serv as $cat)
					@if(!in_array($cat->catid, $already))
						@php array_push($already,$cat->catid); $count++;@endphp
						<div class="container pt-5 pb-5 text-center lead ">
							<u>{{$cat->catdesc}}</u>
						</div>
					@endif
					<div class="col-md-4">
						<div class="custom-control custom-checkbox">
					    	<input name="services[]" formOf="{{$count}}" type="checkbox" class="custom-control-input" id="{{$cat->servid}}" {{(is_array($selected) ? in_array($cat->servid,$selected) ? "checked" : "" : "")}} value="{{$cat->servid}}">
					    	<label class="custom-control-label" for="{{$cat->servid}}">{{$cat->servdesc}}</label>
					  	</div>
				  	</div>
				@endforeach
				</div>
			</div>
			@if(!$canAdd)
			<div class="d-flex justify-content-center mt-5">
				<button class="btn btn-primary p-3" type="submit">
					Save
				</button>
			</div>
			@endif
			</form>
		</div>
		
		
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
		<script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
		<script src="{{asset('ra-idlis/public/js/forall.js')}}"></script>
		<script type="text/javascript">
			$("#servAdd").submit(function(e){	
				e.preventDefault();
				let highest = 0;
				let arrAll = [] ,arrSel = [];

				$("input[name='services[]']:checked").each(function(index, el) {
					if(parseInt($(this).attr('formof')) > highest){
						highest = parseInt($(this).attr('formof'));
					} 
						
					if(!arrAll.includes(parseInt($(this).attr('formof')))){
						arrAll.push(parseInt($(this).attr('formof')));
					}
				});

				if(highest == 4)
				{
					highest = 3;
				}

				for (var i = highest - 1; i >= 1; i--) {
					if(!arrAll.includes(i)){
						arrSel.push(parseInt(i));
					}
				}
				if(arrSel.length > 0){
					alert('Please any of levels '+arrSel.join(', ') + ' to continue');
				} else {
					let data = $(this).serialize();
					$.ajax({
						method: "POST",
						data: data,
						success:function(a){
							if(a == 'DONE'){
								alert('Record Successfully Saved!');
							} else if(a == 'noServSelected') {
								alert('Please select from choices above');
							}
						}
					})
				}
			})


			"use strict";
			// var ___div = document.getElementById('__applyBread'), ___wizardcount = document.getElementsByClassName('wizardcount');
			// document.getElementById('stepDetails').innerHTML = 'Step 3.b: FDA Requirement';
			// if(___wizardcount != null || ___wizardcount != undefined) {
			// 	for(let i = 0; i < ___wizardcount.length; i++) {
			// 		if(i < 2) {
			// 			___wizardcount[i].parentNode.classList.add('past');
			// 		}
			// 		if(i == 2) {
			// 			___wizardcount[i].parentNode.classList.add('active');
			// 		}
			// 	}
			// }
			// if(___div != null || ___div != undefined) {
			// 	___div.classList.remove('active');	___div.classList.add('text-primary');
			// }
		</script>
		@include('client1.cmp.footer')
		<script>
			onStep(3);
			slider(['fda','CDRRHR/personnel',{{$appid}}],['fda','CDRRHR/xraymachines',{{$appid}}]);
		</script>
	</body>
	@endsection
@else
  <script type="text/javascript">window.location.href= "{{ asset('client1/apply') }}";</script>
@endif