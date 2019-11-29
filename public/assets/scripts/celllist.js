$(document).ready(function() {

    $('#celllist_table').DataTable({
        "scrollY": 300,
        "scrollX": true,
        "lengthMenu": [[10, 20, 50, 100, -1], [10, 20, 50, 100, "All"]],
        "columnDefs": [
            {
                "targets": [ 0 ],
                "visible": false,
                "searchable": true
            },
            {
                "targets": [ 1 ],
                "visible": false,
                "searchable": true
            }
        ]
    });

});