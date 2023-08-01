var participants = [];
var flag = true;

$(function() {

    get_participant();

    // EVENT TOMBOL START

    $('#btnStart').on('click', function (e) {
        e.preventDefault();

        if ( participants && participants != 0 ) {
            if ( flag === true ) {
                flag = false;
                AniDice();
                $('#email_result').text('');
                $('#btnStart').text('Stop');
                $('#btnNext').data('id', 0);
            }else{
                var registration_id;

                $.ajax({
                    url: base_url + 'grandprize/get_result',
                    type: 'POST',
                    dataType: 'JSON',
                    success: function(data) {
                        stopDice();
                        registration_id = data.result_id;
                        $('#name_result').text(data.result_name.toUpperCase());
                        $('#email_result').text(data.result_email.toUpperCase());
                        $('#wa_result').text(data.result_wa.toUpperCase());
                        flag = true;
                        $('#btnStart').text('Start');
                        $('#btnNext').data('id', registration_id);
                    }
                });
            }
        }

    });

    // #####################################################
    // EVENT TOMBOL NEXT

    $('#btnNext').on('click', function (e) {
        e.preventDefault();

        var registration_id = $(this).data('id');
        console.log(registration_id);

        if ( participants && participants != 0 ) {  
            $.ajax({
                url: base_url + 'grandprize/save_tr',
                data: {
                    'gift_id': $('#gift_id').val(),
                    'registration_id': registration_id
                },
                type: 'POST',
                dataType: 'JSON',
                success: function(data) {
                    console.log(data);
                    $('#name_result').text('');
                    $('#email_result').text('');
                    $('#wa_result').text('');
                    flag = true;
                    $('#btnNext').data('id', 0);
                    get_participant();
                }
            });
        }
    });

    // #####################################################
    // EVENT TOMBOL RESET

    $('#btnReset').on('click', function (e) {
        e.preventDefault();
        $('#name_result').text('');
        $('#email_result').text('');
        $('#wa_result').text('');
        flag = true;
        $('#btnNext').data('id', 0);        
    });

    // #####################################################

    $(document).keydown(function(e) {

        if (e.keyCode == 113) {
            e.preventDefault();
            if (flag === true) {
                flag = false;
                AniDice();
                $('#email_result').text('');
                // $('#email_result2').text('');
                $('#btnStart').text('Stop');
                $('#btnNext').data('id', 0);
            }
        } else if (e.keyCode == 114) {
            e.preventDefault();
            if (flag === false) {

                var registration_id;
                $.ajax({
                    url: base_url + 'grandprize/get_result',
                    type: 'POST',
                    dataType: 'JSON',
                    success: function(data) {
                        stopDice();
                        registration_id = data.result_id;
                        $('#name_result').text(data.result_name.toUpperCase());
                        $('#email_result').text(data.result_nip.toUpperCase());
                        $('#wa_result').text(data.result_wa.toUpperCase());
                        flag = true;
                        $('#btnStart').text('Start');
                        $('#btnNext').data('id', registration_id);
                    },
                    /*complete: function() {
                        $.ajax({
                            url: base_url + 'grandprize/save_tr',
                            data: {
                                'gift_id': $('#gift_id').val(),
                                'registration_id': registration_id
                            },
                            type: 'POST',
                            dataType: 'JSON',
                            success: function(data) {
                                console.log(data);
                            }
                        });
                    }*/
                });

                /*var registration_id2;
                $.ajax({
                    url: base_url + 'grandprize/get_result2',
                    type: 'POST',
                    dataType: 'JSON',
                    success: function(data) {
                        stopDice();
                        registration_id2 = data.result_id;
                        $('#name_result2').text(data.result_name.toUpperCase());
                        $('#email_result2').text(data.result_nip.toUpperCase());
                        $('#reg_result2').text(data.result_reg.toUpperCase());
                    },
                    complete: function() {
                        $.ajax({
                            url: base_url + 'grandprize/save_tr',
                            data: {
                                'gift_id': $('#gift_id').val(),
                                'registration_id': registration_id2
                            },
                            type: 'POST',
                            dataType: 'JSON',
                            success: function(data) {
                                console.log(data);
                            }
                        });
                    }
                });*/

                flag = true
            }
        } else if (e.keyCode == 115) {
            e.preventDefault();
            if (flag === true) {

                $('#gift_id option:selected').prop('selected', false).next().prop('selected', true);
                // $('#giftContainer').attr('src', base_url + 'assets/images/gift/' + $('#gift_id option:selected').data('image') );
                $('.content-wrapper').css('background-image', 'url('+base_url + 'assets/images/' + $('#gift_id option:selected').data('image')+')');

                console.log( $('#gift_id').val() );
            }
        } else if (e.keyCode == 117) {
            e.preventDefault();
            if (flag === true) {

                $('#gift_id option:selected').prop('selected', false).prev().prop('selected', true);
                // $('#giftContainer').attr('src', base_url + 'assets/images/gift/' + $('#gift_id option:selected').data('image') );
                $('.content-wrapper').css('background-image', 'url('+base_url + 'assets/images/' + $('#gift_id option:selected').data('image')+')');

                console.log( $('#gift_id').val() );
            }
        }
    });

    Pusher.logToConsole = true;

    var pusher = new Pusher('57b1c37d7c00671cbe6f', {
        cluster: 'ap1'
    });

    var channel = pusher.subscribe('channel1');
    channel.bind('event', function(data) {

        if (data.message == 'change_gift') {
            $('#gift_id').val(data.gift[0].gift_id);
            // $('#giftContainer').attr('src', base_url + 'assets/images/gift/' + data.gift[0].gift_file);
            $('.content-wrapper').css('background-image', 'url('+base_url + 'assets/images/' + data.gift[0].gift_file +')');
        }

        if (data.message == 'start') {
            AniDice();
            $('#email_result').text('');
            // $('#email_result2').text('');
        }

        if (data.message == 'stop') {

            var registration_id;
            $.ajax({
                url: base_url + 'grandprize/get_result',
                type: 'POST',
                dataType: 'JSON',
                success: function(data) {
                    stopDice();
                    registration_id = data.result_id;
                    $('#name_result').text(data.result_name.toUpperCase());
                    $('#email_result').text(data.result_nip.toUpperCase());
                    $('#wa_result').text(data.result_wa.toUpperCase());
                },
                complete: function() {
                    $.ajax({
                        url: base_url + 'grandprize/save_tr',
                        data: {
                            'gift_id': $('#gift_id').val(),
                            'registration_id': registration_id
                        },
                        type: 'POST',
                        dataType: 'JSON',
                        success: function(data) {
                            console.log(data);
                        }
                    });
                }
            });

            /*var registration_id2;
            $.ajax({
                url: base_url + 'grandprize/get_result2',
                type: 'POST',
                dataType: 'JSON',
                success: function(data) {
                    stopDice();
                    registration_id2 = data.result_id;
                    $('#name_result2').text(data.result_name.toUpperCase());
                    $('#email_result2').text(data.result_nip.toUpperCase());
                    $('#reg_result').text(data.result_reg.toUpperCase());
                },
                complete: function() {
                    $.ajax({
                        url: base_url + 'grandprize/save_tr',
                        data: {
                            'gift_id': $('#gift_id').val(),
                            'registration_id': registration_id2
                        },
                        type: 'POST',
                        dataType: 'JSON',
                        success: function(data) {
                            console.log(data);
                        }
                    });
                }
            });*/

        }

        if (data.message == 'selected_result') {
            var registration_id;
            stopDice();
            registration_id = data.data.result_id;
            $('#name_result').text(data.data.result_name.toUpperCase());
            $('#email_result').text(data.data.result_nip.toUpperCase());
            $('#wa_result').text(data.result_wa.toUpperCase());
            $.ajax({
                url: base_url + 'grandprize/save_tr',
                data: {
                    'gift_id': $('#gift_id').val(),
                    'registration_id': registration_id
                },
                type: 'POST',
                dataType: 'JSON',
                success: function(data) {
                    console.log(data);
                }
            });
        }

    });

    function get_participant() {
        $.ajax({
            url: base_url + 'grandprize/get_participant',
            type: 'POST',
            dataType: 'JSON',
            success: function(data) {
                participants = data;
            }
        });
    }

    function AniDice() {
        MyVar = setInterval(rolldice, 30)
        // MyVar2 = setInterval(rolldice2, 20)
    }

    function rolldice() {
        var ranNum = Math.floor(Math.random() * participants.length);
        $('#name_result').text(participants[ranNum].participant_name.toUpperCase());
        $('#email_result').text(participants[ranNum].participant_email.toUpperCase());
        $('#wa_result').text(participants[ranNum].participant_wa.toUpperCase());
    }

    function rolldice2() {
        var ranNum = Math.floor(Math.random() * participants.length);
        $('#name_result').text(participants[ranNum].participant_name.toUpperCase());
        $('#email_result').text(participants[ranNum].participant_email.toUpperCase());
        $('#wa_result').text(participants[ranNum].participant_wa.toUpperCase());
    }

    function stopDice() {
        clearInterval(MyVar);
        // clearInterval(MyVar2);
    }

});