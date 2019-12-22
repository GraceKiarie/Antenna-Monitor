$(document).ready(function() {

    $('#alerts_table').DataTable({
        "scrollY": 300,
        "scrollX": true,
        dom: 'Bfrtlip',
        "order": [[ 5, "asc" ], [ 0, 'desc' ]],
        buttons: [
            'csv', 'excel', 'pdf', 'print'
        ],
        "lengthMenu": [[10, 20, 50, 100, -1], [10, 20, 50, 100, "All"]]
    });
});