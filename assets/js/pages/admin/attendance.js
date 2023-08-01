$( function () {

    var t = $('#dataTable').DataTable({
        "dom"       : "lBftipr",
        "processing": true,
        "language": {
            "processing": '<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i><span class="sr-only">Loading...</span>'
        },
        "lengthMenu": [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
        "serverSide": true,
        "order": [],
        "ajax": {
            "url": base_url + "attendance/view",
            "type": "POST"
        },
        "searchDelay": 750,
        "buttons"       : [{
            'extend' : 'excel',
            'text'   : '<i class="fas fa-download fa-sm text-white-50"></i> Export to Excel',
            'attr'   : {
                'class' : 'btn btn-md btn-primary'
            }
        }],
        "columnDefs" : [{
            "targets": [0],
            "orderable": false
        }]
    });

    t.on('click', '.btn-delete', function() {
        var row_id = $(this).data('id');
        $.ajax({
            url: base_url + "attendance/delete",
            type: 'post',
            data: {
                'key': row_id
            },
            dataType: 'json',
            success: function(data) {
                if ( data.type == 'done' ) {
                    window.location.reload();
                }else{
                    alert(data.msg);
                }
            }
        });
    });
	
});