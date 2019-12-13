$(document).ready(function() {
    $('#celllist_table').DataTable({
        "scrollY": 300,
        "scrollX": true,
        dom: 'Bfrtlip',
        buttons: [
            'csv', 'excel', 'pdf', 'print'
        ],
        "order": [[ 3, "desc" ], [ 2, 'asc' ]],
        "lengthMenu": [[10, 20, 50, 100, -1], [10, 20, 50, 100, "All"]],
        "columnDefs": [{
                "targets": [ 0 ],
                "visible": false,
                "searchable": true
            }, {
                "targets": [ 1 ],
                "visible": true,
                "searchable": true
            }]
    });
});