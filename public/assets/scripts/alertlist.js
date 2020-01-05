$(document).ready(function() {

    $('#alerts_table').DataTable({
        "scrollY": 300,
        "scrollX": true,
        dom : "<'row'<'col-md-6'<'row'<'col-md-2 vli'l><'col-md-10'i>>><'col-md-3 vl'f><'col-md-3 apt text-right'B>>" 
            + "<'row'<'col-md-12'tr>>" 
            + "<'row'<'col-md-6'i><'col-md-6'p>>",
        buttons: [
          'csv', 'excel', 'pdf', 'print'
        ],
        "language": {
          "lengthMenu": "_MENU_",
          "info": "Showing _START_ to _END_ of _TOTAL_ alerts",
        },
        "pageLength": 20,
        "order": [[ 5, "asc" ], [ 0, 'desc' ]],
        "lengthMenu": [[10, 20, 50, 100, -1], [10, 20, 50, 100, "All"]]
    });
});