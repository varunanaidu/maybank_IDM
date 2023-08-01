function docReady(fn) {
    console.log(document.readyState);
    // see if DOM is already available
    if (document.readyState === "complete" ||
        document.readyState === "interactive") {
        // call on next available tick
        setTimeout(fn, 1);
    } else {
        document.addEventListener("DOMContentLoaded", fn);
    }
}

docReady(function() {
    var resultContainer = document.getElementById('qr-reader-results');
    var nipContainer = document.getElementById('participant_nip');
    var lastResult, countResults = 0;

    function onScanSuccess(decodedText, decodedResult) {
        if (decodedText !== lastResult || nipContainer) {
            ++countResults;
            lastResult = decodedText;
            // Handle on success condition with the decoded message.
            $('#participant_nip').val(decodedText);

            $.ajax({
            	url : base_url + 'attendance/find',
            	type : 'POST',
            	dataType : 'JSON',
            	data : {'key':decodedText},
            	success : function (data) {
            		if ( data.type == 'done' ) {
            			$('#participant_name').val(data.msg[0].participant_name);
                        $('#participant_unit_bisnis').val(data.msg[0].participant_unit_bisnis);
                        $('#participant_divisi').val(data.msg[0].participant_divisi);
                        $('#participant_department').val(data.msg[0].participant_department);
            			$('#registration_id').val(data.msg[0].registration_id);
            		}
            	}
            });

        }
    }

    var html5QrcodeScanner = new Html5QrcodeScanner(
        "qr-reader", {
            fps: 10,
            qrbox: 250
        });
    html5QrcodeScanner.render(onScanSuccess);
});

$(function() {

	$('#doorprizeForm').on('submit', function(event) {
		event.preventDefault();
		

		$.ajax({
			url : base_url + 'doorprize/save_doorprize',
			type : 'POST',
			dataType : 'JSON',
			data : $(this).serialize(),
			success : function (data) {
                if ( data.type == 'done' ) {
                    Swal.fire('Success', 'Data tersimpan', 'success');
                }else{
                    Swal.fire('Failed !', data.msg, 'error');
                }

                $('#participant_nip').val('');
                $('#participant_name').val('');
                $('#participant_unit_bisnis').val('');
                $('#participant_department').val('');
                $('#participant_divisi').val('');
			}
		});
	});
});