@if (session()->has('system_error'))
    <div class="alert alert-danger alert-dismissible fade show" id="ERROR_MSG" role="alert">
        <strong><i class="fas fa-exclamation"></i></strong>&nbsp;An <strong>error</strong> has occured. Please contact the system administrator.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
    </div>
@endif
<div class="alert alert-danger alert-dismissible fade show" style="display: none" id="ERROR_MSG2" role="alert">
    <strong><i class="fas fa-exclamation"></i></strong>&nbsp;An <strong>error</strong> has occured. Please contact the system administrator.
        <button type="button" class="close" onclick="$('#ERROR_MSG2').hide(1000);">
            <span aria-hidden="true">&times;</span>
        </button>
</div>