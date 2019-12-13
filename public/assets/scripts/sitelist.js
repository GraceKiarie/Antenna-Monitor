$(document).ready(function() {

    $('#sitelist_table').DataTable({
        "scrollY": 300,
        dom: 'Bfrtlip',
        buttons: [
            'csv', 'excel', 'pdf', 'print'
        ],
        "scrollX": true,
        "lengthMenu": [[10, 20, 50, 100, -1], [10, 20, 50, 100, "All"]]
    });

});