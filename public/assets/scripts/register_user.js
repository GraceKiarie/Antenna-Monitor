$(document).ready(function (){
    $("#roles").change(function() {
        if ($(this).val() <= 1) {
            $("#contractorInfo").hide();
            $("#teamInfo").hide();
            $("#cont").prop('required',false);
            $("#tea").prop('required',false);
        }else{
            $('#contractorInfo').show();
            $('#teamInfo').show();
            $("#cont").prop('required',true);
            $("#tea").prop('required',true);
        } 
    });
});