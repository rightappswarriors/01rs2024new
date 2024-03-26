@if (session()->exists('employee_login'))  
	@extends('main')
	@section('content')
	@include('client1.cmp.__apply')
	<body>
		<div class="container-fluid pb-3 mt-5">
			<div class="container-fluid">
				<table class="table table-hover" id="tApp">
		      		<thead style="background-color: #428bca; color: white" id="theadapp">
		      			<tr>
                            <th>COC Number</th>
							<th>Valid To</th>
							<th>COC File</th>
						</tr>
		      		</thead>
		      		<tbody id="loadHere">
		      			@foreach($cocs as $coc)
							<tr>
					
								<td>{{$coc->coc_number}}</td>
								<td>{{$coc->valid_to}}</td>
								<td class="text-center">
									@isset($coc->coc_file)
										<a target="_blank" href="{{ route('OpenFile', $coc->coc_file)}}"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a>
									@else
										<span class="font-weight-bold">NOT DEFINED YET</span>
									@endisset
								</td>
							</tr>
							@endforeach
		      		</tbody>
		      	</table>
			</div>
		</div>

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
		<script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
		<script src="{{asset('ra-idlis/public/js/forall.js')}}"></script>

		<script>
			$(function(){
				$("#tApp").dataTable();
			})

			function procesTag(choice,id){
				let r;
				switch (choice) {
					case 0:
						r = confirm('Are you sure you want to Untag this Personnel?');
						break;
					case 1:
						r = confirm('Are you sure you want to tag this Personnel?');
						break;
				}
				if(r){
					$.ajax({
						method: 'POST',
						data: {action : choice,id: id, _token: '{{csrf_token()}}'},
						success: function(a){
							if(a == 'DONE'){
								alert('Selected Operation successful');
								location.reload();
							} else {
								console.log(a);
							}
						}
					})
				}
			}
			
		</script>
	</body>
	@endsection
@else
  <script type="text/javascript">window.location.href= "{{ asset('client1/apply') }}";</script>
@endif