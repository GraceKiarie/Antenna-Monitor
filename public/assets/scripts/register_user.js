$(document).ready(function (){
    $("#roles").change(function() {
        if ($(this).val() == 1 || $(this).val() == "") {
            $("#contractorInfo").hide();
            $("#teamInfo").hide();
        }else{
            $("#contractorInfo").show();
            $("#teamInfo").show();
        } 
    });
});