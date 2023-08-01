$( function () {

    $('#filter_button').on('click', function (event) {
        event.preventDefault();

        var start_date = $('#start_date').val();
        var end_date = $('#end_date').val();
        $('#dataTable').DataTable().destroy();
        datatable(start_date, end_date);
    });

    $('#reset_button').on('click', function (event) {
        event.preventDefault();

        $('#start_date').val('');
        $('#end_date').val('');

        $('#dataTable').DataTable().destroy();
        datatable();
    });

    datatable();

    function datatable(start_date="", end_date="") {
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
                "url": base_url + "booth/view",
                "type": "POST",
                "data": {
                	"flag"		 : 9,
                    "start_date" : start_date,
                    "end_date"   : end_date,
                },
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
            }],
            "createdRow" : function (row, data, idx) {
                if ( data[6] == 1 ) {
                    $(row).addClass('choosenRow');
                }
            }
        });

        /*t.on('click', '.btn-delete', function() {
            var row_id = $(this).data('id');
            $.ajax({
                url: base_url + "booth/delete",
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
        });*/
    }

});