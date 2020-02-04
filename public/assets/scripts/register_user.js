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

    var allOptions = $('#tea option')
    $('#cont').change(function () {
        $('#tea option').remove()
        var classN = $('#cont option:selected').prop('class');
        var opts = allOptions.filter('.' + classN);
        $.each(opts, function (i, j) {
            $(j).appendTo('#tea');
        });
    });

});