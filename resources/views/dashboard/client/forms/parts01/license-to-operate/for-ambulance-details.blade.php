<div class=" ambuDetails" style="width: 100%; " hidden>
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


		<!-- <table class="table table-bordered">
    <thead class=" p-3">
        <tr class="bg-dark text-white">
            <th class="text-center">
                <button 
                    class="btn btn-success" 
                    type="button"
                    onClick=""    
                >
                    <i class="fa fa-plus"></i>
                </button>
            </th>
            <th>Ambulance Service(Type 1, Type 2)</th>
            <th>Ambulance Type(Owned, Outsoured)</th>
            <th>Details</th>
        </tr>
    </thead>
</table> -->

		<div class="row col-border-right showAmb">
			{{-- <div class="col-md-4">
								<p>Ambulance Service:</p>
								<div class="input-group mb-3">
								  <div class="input-group-prepend">
								    <label class="input-group-text" for="typeamb"><i class="fa fa-info" data-toggle="tooltip" data-placement="top" title="Lorem ipsum dolar"></i></label>
								  </div>
								  <select class="form-control " id="typeamb" name="typeamb">
										<option selected value hidden disabled>Please select</option>
										<option value="1">Type 1 (Basic Life Support)</option>
										<option value="2">Type 2 (Advance Life Support)</option>
									</select>
								</div>
								<p>Ambulance Service:</p>
								<div class="mb-3">
									<select class="form-control " id="typeamb" name="typeamb">
										<option selected value hidden disabled>Please select</option>
										<option value="1">Type 1 (Basic Life Support)</option>
										<option value="2">Type 2 (Advance Life Support)</option>
									</select>
								</div>
							</div>
							<div class="col-md-4">
								<p>Ambulance Count:</p>
								<div class="mb-3">
									<input type="number" class="form-control" id="noofamb" name="noofamb" placeholder="Ambulance Count">
								</div>
							</div>
							<div class="col-md-4">
								<p>Plate Number/Conduction Number:</p>
								<div class="mb-3">
									<input type="text" class="form-control" id="plate_number" name="plate_number" placeholder="Plate Number">
								</div>
							</div> --}}
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