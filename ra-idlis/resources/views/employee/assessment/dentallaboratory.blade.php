@extends('mainEmployee')
@section('title', 'Assessment Tool')
@section('content')

	<style type="text/css">
		input {
		  outline: 0;
		  border-width: 0 0 1px;
		  border-color: black;
		}
	</style>


	<div class="content p-4">
		@yield('errors')
		<div class="card">
			<nav aria-label="breadcrumb">
			  <ol class="breadcrumb">
			    <li class="breadcrumb-item"><a href="{{ asset('/employee/dashboard') }}">Dashboard</a></li>
			    <li class="breadcrumb-item"><a href="{{ asset('/employee/dashboard/assessment') }}">Assessment</a></li>
			    <li class="breadcrumb-item active" aria-current="page">DENTAL LABORATORY</li>
			  </ol>
			</nav>
			<div class="container p-4 table-responsive">

				<div class="row mb-4">
					<div class="col-2">
						<img src="{{asset('ra-idlis/public/img/doh2.png')}}" class="img-fluid">
					</div>
					<div class="col-9">
						<div class="container font-weight-bold text-center" style="font-size: 18px;">
							Republic of the Philippines<br>
							Department of Health
						</div>
						<div class="container font-weight-bold text-center mt-3 mb-5" style="font-size: 20px;">
							HEALTH FACILITIES AND SERVICES REGULATORY BUREAU<br>
							ASSESSMENT TOOL FOR LICENSING A DENTAL LABORATORY
						</div>
					</div>
				</div>

				<div class="col-12">
					{{-- name --}}
					<div class="row mb-3">
						<div class="col-3">
							<p>Name of Laboratory</p>
						</div>
						<div class="col-9">
							<input type="text" name="nameOfLaboratory" class="w-100 mb-3">
						</div>
					</div>
					{{-- address --}}
					<div class="row mb-3">
						<div class="col-3">
							<p>Address of Laboratory</p>
						</div>
						<div class="col-9">
							<span>
								<input type="text" name="addressOfLaboratory" class="w-100">
								<div class="row mb-3">
									<div class="col-6">
										No. & Street
									</div>
									<div class="col-6">
										Barangay
									</div>
								</div>
							</span>
							<span>
								<input type="text" name="addressOfLaboratory2" class="w-100">
								<div class="row mb-3">
									<div class="col">
										City/ Municipality
									</div>
									<div class="col text-right">
										Province
									</div>
									<div class="col text-right">
										Region
									</div>
								</div>
							</span>
						</div>
					</div>
					{{-- application --}}
					<div class="row mb-3">
						<div class="col-3">
							<p>Application for</p>
						</div>
						<div class="col-9">
							<div class="row">
								<div class="col">
									<p>[  ]  Initial</p>
								</div>
								<div class="col">
									<p>[  ]   Renewal</p>
									<p>
										License No. <input type="text" name="licenseNo">
									</p>
									<p>
										Date Issued <input type="text" name="dateIssued">
									</p>
									<p>
										Expiry Date <input type="text" name="expiryDate">
									</p>
								</div>
							</div>
						</div>
					</div>
					{{-- general information --}}
					<div class="mb-5">GENERAL INFORMATION</div>
					{{-- name of owner --}}
					<div class="row mb-3">
						<div class="col-3">
							<p>Name of Owner</p>
						</div>
						<div class="col-9">
							<input type="text" name="nameOfOwner" class="w-100 mb-3">
						</div>
					</div>
					{{-- name of supervisor --}}
					<div class="row mb-3">
						<div class="col-3">
							<p>Name of Supervisor</p>
						</div>
						<div class="col-9">
							<input type="text" name="nameOfSupervisor" class="w-100 mb-3">
						</div>
					</div>
					{{-- classification --}}
					<div class="mb-5">
						Classification According to
						<br>
						Please tick (<i class="fa fa-check"></i>) the appropriate boxes.
					</div>
				</div>

				{{-- <div class="col-4 border h-100">
					<p class="mt-4">Name of Laboratory</p>
					<p class="mt-4">Address of Laboratory</p>
					<p class="mt-4">Telephone/ Fax No.</p>
				</div>
				<div class="col-8 border h-100">
					<input type="text" name="nameOfLaboratory" class="w-100 mb-3">
					<span>
						<input type="text" name="addressOfLaboratory" class="w-100">
						<div class="row mb-3">
							<div class="col-6">
								No. & Street
							</div>
							<div class="col-6">
								Barangay
							</div>
						</div>
					</span>
					<span>
						<input type="text" name="addressOfLaboratory2" class="w-100">
						<div class="row mb-3">
							<div class="col">
								City/ Municipality
							</div>
							<div class="col text-right">
								Province
							</div>
							<div class="col text-right">
								Region
							</div>
						</div>
					</span>
					<input type="text" name="nameOfLaboratory" class="w-100">
				</div> --}}
			</div>
	</div>
	@yield('script')
@endsection