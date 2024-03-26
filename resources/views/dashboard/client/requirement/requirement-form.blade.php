<div class="container mt-5 mb-5">
    <table class="table table-striped">
        <thead class="thead-dark">
            <tr>
                <th>Description</th>
                <th>Upload</th>
                <th>Remarks</th>
                <th>View Uploaded</th>
            </tr>
        </thead>
        <tr>
            <td colspan="4">
                No requirement(s) to Upload
            </td>
        </tr>
    </table>

    <div class="container mt-5 text-danger">
        {{-- <p class="text-danger">Note:</p> --}}
        <ul class = "list-unstyled">
            <li><span class="text-danger">REFERENCE AND GUIDANCE:</span><br> Incomplete Attachment shall be a ground for the denial of this application</li>
        </ul>
    </div>
</div>

<div class="form-group row col-md-12 mt-5">
    <div class="col-lg-3 col-md-3 col-xs-12"></div>
        <div class="col-lg-3 col-md-3 col-xs-12 mb-5">
            <a class="btn btn-danger btn-block" href="{{URL::to('/client1/apply')}}">
                <i class="fa fa-times" aria-hidden="true"></i> Cancel
            </a>
        </div>
    <div class="col-lg-3 col-md-3 col-xs-12 mb-5">
        <button 
            class="btn btn-info btn-block" 
            type="button" 
            value="submit" 
            name="submit"
            data-toggle="modal" 
            data-target="#confirmSubmitModal"
        >
            <i class="fa fa-paper-plane" aria-hidden="true"></i>
            Submit Requirement
        </button>
</div>