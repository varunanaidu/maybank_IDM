$( function () {
	
	$('#registrationForm').on('submit', function(event) {
		event.preventDefault();
		

		$.ajax({
			url : base_url + 'registration/save',
			type : 'POST',
			dataType : 'JSON',
			data : $(this).serialize(),
			beforeSend: function () {
				Swal.showLoading();
			},
			success : function (data) {
				if ( data.type == 'done' ) {
					Swal.fire({
						title: 'Success',
						type: 'success',
						html: data.msg
					}).then( function () {
						window.location.href = base_url + 'registration/registered/' + data.id;
					});
				}else{
					Swal.fire("Failed!", data.msg, "error");
				}
			}
		});
	});
});