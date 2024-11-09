<script>
(function() {
        $(document).on('change', '#same', function(event) {
            console.log("received")
            if ($(this).prop('checked') == true) {
                if ($("#street_name").val() != null && $("#cmid option:selected").val() != "" && $("#provid option:selected").val() != "" && $("#brgyid option:selected").val() != "" && $("#rgnid option:selected").val() != "") {
                    $('#mailingAddress').val(($('#street_number').val() != "" ? $('#street_number').val() : "") + " " + $("#street_name").val() + " " + $("#brgyid option:selected").text().toUpperCase() + " " + $("#cmid option:selected").text().toUpperCase() + " " + $("#provid option:selected").text().toUpperCase() + " " + $("#rgnid option:selected").text().toUpperCase());
                } else {
                    this.checked = false;
                    event.preventDefault();
                    alert('Please select facility address first!');
                }
            } else {
                $('#mailingAddress').val('');
            }
        });
    })

</script>