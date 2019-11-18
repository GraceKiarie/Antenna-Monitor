$(document).ready(function() {

    $('#sitelist_table').DataTable({
        "scrollY": 350,
        "scrollX": true,
        "lengthMenu": [[20, 50, 100, -1], [20, 50, 100, "All"]]
    });

});