$(function() {
    $.ajax({
        url: base_url + 'spinwheel/get_present',
        type: 'POST',
        dataType: 'JSON',
        success: function(resp) {
            var segments = [];
            var label = [];

            for (var i = 0; i < resp.length; i++) {
                label.push(resp[i].gift_name);
            }

            for (var i = 0; i < resp.length; i++) {
                label.push(resp[i].gift_name);
            }

            var pieColors = [
                "#28299f",
                "#a03e8a",
                "#c49bb6",
                "#4394e0",
                "#28299f",
                "#a03e8a",
                "#c49bb6",
                "#4394e0",
                "#28299f",
                "#a03e8a",
                "#c49bb6",
                "#4394e0",
                ];

            for (var i = 0; i < label.length; i++) {
                var tempSegments = {
                    fillStyle : pieColors[i],
                    text : label[i]
                }

                segments.push(tempSegments);
            }

            $("#spin_button").on('click', function() {

                startSpin();
            });

            let theWheel = new Winwheel({
                'numSegments'  : segments.length,     // Specify number of segments.
                'outerRadius'  : 212,   // Set outer radius so wheel fits inside the background.
                'innerRadius'  : 40,   
                'textFontSize' : 15,    // Set font size as desired.
                /*'segments'     :        // Define segments including colour and text.
                [
                   {'fillStyle' : '#eae56f', 'text' : 'Prize 1'},
                   {'fillStyle' : '#89f26e', 'text' : 'Prize 2'},
                   {'fillStyle' : '#7de6ef', 'text' : 'Prize 3'},
                   {'fillStyle' : '#e7706f', 'text' : 'Prize 4'},
                   {'fillStyle' : '#eae56f', 'text' : 'Prize 5'},
                   {'fillStyle' : '#89f26e', 'text' : 'Prize 6'},
                   {'fillStyle' : '#7de6ef', 'text' : 'Prize 7'},
                   {'fillStyle' : '#e7706f', 'text' : 'Prize 8'}
                ],*/
                'segments'     : segments,
                'animation' :           // Specify the animation to use.
                {
                    'type'     : 'spinToStop',
                    'duration' : 5,     // Duration in seconds.
                    'spins'    : 100,     // Number of complete spins.
                    'callbackFinished' : alertPrize
                }
            });

            // Vars used by the code in this page to do power controls.
            let wheelSpinning = false;

            // -------------------------------------------------------
            // Click handler for spin button.
            // -------------------------------------------------------
            function startSpin()
            {
                // Ensure that spinning can't be clicked again while already running.
                if (wheelSpinning == false) {
                    // Disable the spin button so can't click again while wheel is spinning.
                    // document.getElementById('spin_button').src       = base_url + "assets/winwheel/examples/basic_code_wheel/spin_off.png";
                    document.getElementById('spin_button').className = "";

                    // Begin the spin animation by calling startAnimation on the wheel object.
                    theWheel.startAnimation();

                    // Set to true so that power can't be changed and spin button re-enabled during
                    // the current animation. The user will have to reset before spinning again.
                    wheelSpinning = true;
                }
            }

            // -------------------------------------------------------
            // Called when the spin animation has finished by the callback feature of the wheel because I specified callback in the parameters
            // note the indicated segment is passed in as a parmeter as 99% of the time you will want to know this to inform the user of their prize.
            // -------------------------------------------------------

            function alertPrize(indicatedSegment)
            {
                // Do basic alert of the segment text. You would probably want to do something more interesting with this information.
                console.log("You have won " + indicatedSegment.text);

                for (var i = 0; i < resp.length; i++) {
                    if (resp[i].gift_name == indicatedSegment.text) {
                        $('#gift_id').val(resp[i].gift_id);

                        var registration_id = $('#registration_id2').val();
                        var gift_id = $('#gift_id').val();

                        $.ajax({
                            url: base_url + 'spinwheel/save_doorprize',
                            type: 'POST',
                            dataType: 'JSON',
                            data: {
                                'registration_id': registration_id,
                                'gift_id': gift_id
                            },
                            success: function(data) {
                                $('#gift_id').val('');
                                $('#registration_id2').val('');

                                $('#registration_id').val('');
                                $('#registration_id').removeAttr('style');
                                $('#registration_id').focus();

                                $('#buttonSearch').removeAttr('style');
                            },
                            complete: function () {
                                theWheel.stopAnimation(false);  // Stop the animation, false as param so does not call callback function.
                                /* 
                                theWheel.rotationAngle = 0;     // Re-set the wheel angle to 0 degrees.
                                theWheel.draw();                // Call draw to render changes to the wheel.

                                wheelSpinning = false;          // Reset to false to power buttons and spin can be clicked again.
                                */
                            }
                        });
                    }
                }
            }

            $('#buttonSearch').on('click', function() {
                $('#default-modal').modal('show');

            });

            $("#searchContainer").select2({
                dropdownParent : $('#default-modal'),
                minimumInputLength: 2,
                ajax: {
                    url: base_url + "spinwheel/search_participant",
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
                    url: base_url + 'spinwheel/search_emp',
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

                            $('#registration_id2').val(data.data.result_id);
                            $('#participant_container').text(data.data.result_name.toUpperCase() + ' - ' + data.data.result_email);
                                
                            theWheel.rotationAngle = 0;     // Re-set the wheel angle to 0 degrees.
                            theWheel.draw();                // Call draw to render changes to the wheel.

                            wheelSpinning = false;          // Reset to false to power buttons and spin can be clicked again.

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

            // EVENT MASUKIN VIA SCAN QR DISINI
            $('#registration_id').keydown(function(event) {
                console.log(event);

                if (typeof event != undefined && event.keyCode == 13) {
                    event.preventDefault();

                    var registration_id = $('#registration_id').val();

                    $.ajax({
                        url: base_url + 'spinwheel/search_emp',
                        type: 'POST',
                        dataType: 'JSON',
                        data: {
                            'registration_id': registration_id
                        },
                        success: function(data) {
                            if (data.type == 'done') {
                                $('#registration_id').css('display', 'none');
                                $('#buttonSearch').css('display', 'none');
                                $('#registration_id2').val(data.data.result_id);
                                $('#participant_container').text(data.data.result_name.toUpperCase() + ' - ' + data.data.result_email);

                                
                                theWheel.rotationAngle = 0;     // Re-set the wheel angle to 0 degrees.
                                theWheel.draw();                // Call draw to render changes to the wheel.

                                wheelSpinning = false;          // Reset to false to power buttons and spin can be clicked again.
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

        }
    });
});