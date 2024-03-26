<div class="card-body">
    Upload Attachment

    <form action="{{ route('file.store') }}" method="post" enctype="multipart/form-data">
		{{csrf_field()}}
        <input type="file" name="upload" id="upload"> <br> <br>
        <button typpe="submit">Submit File</button>
    </form>
</div>