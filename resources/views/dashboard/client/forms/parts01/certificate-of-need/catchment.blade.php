<div class="mb-2 col-md-12">&nbsp;</div>
<div class="col-md-12"><b class="text-primary">Projected Primary and Secondary Catchment Population (P) of the Proposed Hospital: <span class="text-danger">*</span></b></div>
<div class="col-md-12">
    <div class="alert alert-info">
        <ul>
            <li><b class="text-danger">Primary Catchment/Area</b> refers to the municipality/urban district for Level 1 Hospitals, rural district/city for Level 2 Hospitals, provice and region for Level 3 Hospitals</li>
            <li><b class="text-danger">Secondary Catchment Area</b> refers to other geographic areas that have access or contigous to the Primary Catchment Area</li>
            <li><b class="text-danger">Note:</b> Source of Projected Population (5th year) of Catchment Area should be from PSA. Refer to this link <a href="https://psa.gov.ph/statistics/census/projected-population" target="_blank">here</a></li>
            <!-- <li><b class="text-danger">Note:</b> Source of Projected Population (5th year) of Catchment Area should be from PSA/NEDA. Refer to this link <a href="https://www.doh.gov.ph/sites/default/files/publications/Philippines%20projected%20pop%20by%20Prov%2CCity%2CBarangay%202018-2022.pdf" target="_blank">here</a></li> -->
            <li><b class="text-danger">Note:</b> Please Refer to Regional DOH websites on encoding Population Projection</li>
        </ul>
    </div>
    <table class="table table-bordered" >
        <thead class=" p-3">
            <tr class="bg-dark text-white">
                <th class="text-center">
                    <button class="btn btn-success" type="button" onClick="addProjectedPopulation()">
                        <i class="fa fa-plus"></i>
                    </button>
                </th>
                <th>Type</th>
                <th>Location</th>
                <th>Projected Population (5th year) of Catchment Area</th>
            </tr>
        </thead>

        <tbody id="projected_populations">
            
           
            <tr class="border"  >
                <td colspan="3" class="border text-right">Total</td>
                <td colspan="2" class="border font-weight-bold" id="total">  <span id="projectedPopulationCostN">0</span></td>
                <!-- <td colspan="2" class="border font-weight-bold" id="total">  <span id="projectedPopulationCost">0</span></td> -->
            </tr>
            <!-- <tr>
                <td colspan="2" class="text-right">Total</td>
                <td colspan="2" id="total">
                    <span id="projectedPopulationCost">0</span>
                </td>
            </tr> -->
        </tbody>
    </table>
</div>