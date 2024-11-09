<div class="mb-2 col-md-12 change-div">&nbsp;</div>

<div class="col-md-12 change-div">
    <b class="text-primary">PTC No.:
        <!-- <span class="text-danger">*</span> 5-5-2021-->
    </b>
</div>

<!-- <div class="col-md-12">
    <input class="form-control" type="text" name="ptcCode" id="ptcCode" placeholder="PTC Code"/> 
</div> -->
<script>
function ptc_na(){
          document.getElementById("ptcCode").value= "N/A";
          }
</script>
<div class="col-md-12 change-div">
    <div class="input-group mb-3">
        <div class="input-group-prepend">

            <button type="button" class="btn btn-outline-secondary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="sr-only">Toggle Dropdown</span>
            </button>
            <div class="dropdown-menu">
                <span class="dropdown-item" onclick="ptc_na()" id="ptc_na" style="cursor: pointer;">Not Applicable</span>
            </div>
        </div>
        <input class="form-control" type="text" name="ptcCode" id="ptcCode" placeholder="PTC No." />
    </div>
</div>

