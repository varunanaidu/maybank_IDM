$(function() {

    $('#buttonSearch').on('click', function() {
        $('#default-modal').modal('show');

    });
    $("#searchContainer").select2({
    	dropdownParent : $('#default-modal'),
        minimumInputLength: 2,
        ajax: {
            url: base_url + "undian/search_participant",
            dataType: "json",
            delay: 250,
            processResults: function(data) {
                return {
                    results: data
                };
            },
            cache: true
        },
        allowClear: true
    });

    $('#searchContainer').on('change', function(event) {
        event.preventDefault();

        var registration_id = $(this).val();
        $.ajax({
            url: base_url + 'undian/search_emp',
            type: 'POST',
            dataType: 'JSON',
            data: {
                'registration_id': registration_id
            },
            success: function(data) {
                console.log(data);
                if (data.type == 'done') {
                    $('#registration_id').css('display', 'none');

                    $('#buttonSearch').css('display', 'none');
                    $('#default-modal').modal('hide');

                    $('#btn-start').removeAttr('style');
                    $('#registration_id2').val(data.data.result_id);
                    $('#name_result').text(data.data.result_name.toUpperCase());
                    $('#information_result').text(data.data.result_email.toUpperCase() + ' (' + data.data.result_wa.toUpperCase() + ')');

                    $('#gift_name').text('');
                    $('#gift_file').data('src', '');
                    $('#gift_file').attr('src', '');
                } else {
                    Swal.fire({
                        title: 'Failed !',
                        html: data.msg,
                        type: 'error',
                        timer: 1500,
                        showCancelButton: false,
                        showConfirmButton: false,
                    }).then(function() {
                        $('#registration_id').val('');
                        $('#registration_id').focus();
                    });
                }
            }
        });
    });

    var present = [];
    var flag = true;
    $('#registration_id').focus();
    refresh_present();

    // EVENT MASUKIN VIA SCAN QR DISINI
    $('#registration_id').keydown(function(event) {

        // console.log(event);return;

        if (event.keyCode == 13) {
            event.preventDefault();

            var registration_id = $('#registration_id').val();

            $.ajax({
                url: base_url + 'undian/search_emp',
                type: 'POST',
                dataType: 'JSON',
                data: {
                    'registration_id': registration_id
                },
                success: function(data) {
                    if (data.type == 'done') {
                        $('#registration_id').css('display', 'none');
                    	$('#buttonSearch').css('display', 'none');
                        $('#btn-start').removeAttr('style');
                        $('#registration_id2').val(data.data.result_id);
                        $('#name_result').text(data.data.result_name.toUpperCase());
                        $('#information_result').text(data.data.result_email.toUpperCase() + ' (' + data.data.result_wa.toUpperCase() + ')');

                        $('#gift_name').text('');
                        $('#gift_file').data('src', '');
                        $('#gift_file').attr('src', '');
                    } else {
                        Swal.fire({
                            title: 'Failed !',
                            html: data.msg,
                            type: 'error',
                            timer: 1500,
                            showCancelButton: false,
                            showConfirmButton: false,
                        }).then(function() {
                            $('#registration_id').val('');
                            $('#registration_id').focus();
                        });
                    }
                }
            });

        }

    });

    $('#btn-start').on('click', function(event) {
        event.preventDefault();

        if (flag === true) {
            $('#btn-start').css('display', 'none');
            $('#btn-stop').removeAttr('style');
            flag = false;
            AniDice();
        }

    });

    $('#btn-stop').on('click', function(event) {
        event.preventDefault();

        if (flag === false) {

            var gift_id;
            var registration_id = $('#registration_id2').val();

            // return;

            $.ajax({
                url: base_url + 'undian/get_result',
                type: 'POST',
                dataType: 'JSON',
                data: {
                    'registration_id': registration_id
                },
                success: function(data) {
                    stopDice();
                    $('#gift_name').text(data.result_name);
                    $('#gift_file').attr('src', base_url + 'assets/images/prize/' + data.result_file);
                    gift_id = data.result_id;
                },
                complete: function() {
                    $.ajax({
                        url: base_url + 'undian/save_doorprize',
                        type: 'POST',
                        dataType: 'JSON',
                        data: {
                            'registration_id': registration_id,
                            'gift_id': gift_id
                        },
                        success: function(data) {
                            refresh_present();

                            $('#btn-start').css('display', 'none');
                            $('#btn-stop').css('display', 'none');

                            $('#gift_id').val('');
                            $('#registration_id2').val('');

                            $('#registration_id').val('');
                            $('#registration_id').removeAttr('style');
                            $('#registration_id').focus();

                            $('#buttonSearch').removeAttr('style');
                        },
                    });
                }
            });

            flag = true;
        }

    });

    function refresh_present() {
        $.ajax({
            url: base_url + 'undian/get_present',
            type: 'POST',
            dataType: 'JSON',
            success: function(data) {
                present = data;
                console.log(present);
            }
        });
    }

    function AniDice() {
        MyVar = setInterval(rolldice, 15)
    }

    function rolldice() {
        var ranNum = Math.floor(Math.random() * present.length);
        $('#gift_id').val(present[ranNum].gift_id);
        $('#gift_name').text(present[ranNum].gift_name.toUpperCase());
    }

    function stopDice() {
        clearInterval(MyVar);
    }
});