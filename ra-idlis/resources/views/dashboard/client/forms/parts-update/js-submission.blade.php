
<script type="text/javascript">
        $(document).ready(function(){ $('[data-toggle="tooltip"]').tooltip();});
        function toggleModal(test){
            if (test) { // Tr
                $('#keyWord').empty();
                $('#keyWord').append('recommend');

                $('#descRmk1').hide();
                $('#desc_rmk').removeAttr('required');
                $('#desc_rmk').removeAttr('data-parsley-required-message');

                $('#desc_isAppr').removeAttr('value');
                $('#desc_isAppr').attr('value','1');
                // $('#MODALBTN').attr('onclick','AcceptNow(true);');
            } else { // Fa
                $('#keyWord').empty();
                $('#keyWord').append('not recommend');

                $('#descRmk1').show();
                $('#desc_rmk').removeAttr('required');
                $('#desc_rmk').removeAttr('data-parsley-required-message');
                $('#desc_rmk').attr('required', '');
                $('#desc_rmk').attr('data-parsley-required-message', '<strong>Remarks</strong> required');

                $('#desc_isAppr').removeAttr('value');
                $('#desc_isAppr').attr('value','0');
                // $('#MODALBTN').attr('onclick','AcceptNow(false);');
            }
        }
    $('#AppFormFinal').on('submit',function(event){
            event.preventDefault();
            var form = $(this);
            form.parsley().validate();
            if (form.parsley().isValid()){	
                $.ajax({
                  method : 'POST',
                  data : {
                        _token : $('#token').val(),
                        isOk : $('#desc_isAppr').val(),
                        desc : $('#desc_rmk').val(),
                        id : $('#APPID').val(),

                  }, success : function(data){
                      if (data == 'DONE') {
                          $("#AccepttGodModal").modal('toggle');
                          Swal.fire({
                            type: 'success',
                            title: 'Success',
                            text: 'Successfully Recommended this application to approval.',
                          }).then(() => {
                            window.location.href = '{{ asset('employee/dashboard/processflow/recommendation') }}';
                          });
                      } 
                      else if (data == 'DISAPPROVED') {
                          $("#AccepttGodModal").modal('toggle');
                          Swal.fire({
                            type: 'error',
                            title: 'Disapproved',
                            text: 'This application is successfully disapproved for recommendation of final approval.',
                          }).then(() => {
                            window.location.href = '{{ asset('employee/dashboard/processflow/recommendation') }}';
                          });
                      } else if (data == 'ERROR'){
                        $('#AccErrorAlert').show(100);  
                      }
                  }, error : function(a,b,c){ 
                      console.log(c);
                      $('#AccErrorAlert').show(100);
                  },

                });
            }
        });
</script>