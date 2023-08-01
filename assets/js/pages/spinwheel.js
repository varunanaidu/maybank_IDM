$(function() {
    $.ajax({
        url: base_url + 'spinwheel/get_present',
        type: 'POST',
        dataType: 'JSON',
        success: function(resp) {
            var label = [];

            for (var i = 0; i < resp.length; i++) {
                label.push(resp[i].gift_name);
            }

            // console.log(label);

            const wheel = document.getElementById("wheel");
            const spinBtn = document.getElementById("spin-btn");
            const finalValue = document.getElementById("final-value")

            //Object that stores values of minimum and maximum angle for a value
            const rotationValues = [
                { minDegree: 0, maxDegree: 60, value: "Motor Listrik" },
                { minDegree: 61, maxDegree: 120, value: "Sepeda Gunung" },
                { minDegree: 121, maxDegree: 180, value: "Sepeda Gunung" },
                { minDegree: 181, maxDegree: 240, value: "Sepeda Lipat" },
                { minDegree: 241, maxDegree: 300, value: "Sepeda Lipat" },
                { minDegree: 301, maxDegree: 360, value: "Motor Listrik" },
            ];
            /*const rotationValues = [];
            var divider = (360/label.length);
            for (var i = 0; i < label.length; i++) {
                if ( i == 0 ) {
                    var temp = {
                        minDegree: 0,
                        maxDegree: divider,
                        value: label[i]
                    }
                    rotationValues.push(temp);
                }else{
                    var temp = {
                        minDegree: (rotationValues[i-1].maxDegree+1),
                        maxDegree: (rotationValues[i-1].maxDegree+divider),
                        value: label[i]
                    }
                    rotationValues.push(temp);
                }
            }*/

            var labels = [];

            for (var i = 0; i < rotationValues.length; i++) {
                labels.push(rotationValues[i].value);
            }

            //Size of each piece
            const data = [16, 16, 16];
            //Background color for each piece
            var pieColors = [
                "#28299f",
                "#a03e8a",
                "#c49bb6",
                ];

            //Create chart
            let myChart = new Chart(wheel, {
                //Plugin for displaying text on pie chart
                plugins: [ChartDataLabels],
                //Chart Type Pie
                type: "pie",
                data: {
                //Labels (values which are to be displayed on chart)
                    labels: label,
                    // labels: [ 'Sepeda Gunung', 'Motor Listrik', 'Sepeda Lipat'],
                    datasets: [
                        {
                            backgroundColor: pieColors,
                            data: data,
                        },
                    ],
                },
                options: {
                    responsive: true,
                    animation: { duration: 0 },
                    plugins: {
                        tooltip: false,
                        legend: {
                            display: false,
                        },
                        datalabels: {
                            color: "#ffffff",
                            formatter: (_, context) => context.chart.data.labels[context.dataIndex],
                            font: { size: 24 },
                        },
                    },
                },
            });

            // Display value based on the randomAngle
            const valueGenerator = (angleValue) => {
                for (let i of rotationValues) {
                    if (angleValue >= i.minDegree && angleValue <= i.maxDegree) {
                        finalValue.innerHTML = `<p>Hadiah: ${i.value}</p>`;
                        spinBtn.disabled = false;
                        break;
                    }
                }
            };

            let count = 0;
            let resultValue = 101;
            spinBtn.addEventListener("click", () => {
                console.log(rotationValues);
                spinBtn.disabled = true;
                finalValue.innerHTML = '<p>Good Luck!</p>';
                let randomDegree = Math.floor(Math.random() * (355 - 0 + 1) + 0);
                let rotationInterval = window.setInterval(() => {
                    myChart.options.rotation = myChart.options.rotation + resultValue;
                    myChart.update();
                    if (myChart.options.rotation >= 360) {
                        count += 1;
                        resultValue -= 5;
                        myChart.options.rotation = 0;
                    } else if (count > 15 && myChart.options.rotation == randomDegree) {
                        valueGenerator(randomDegree);
                        clearInterval(rotationInterval);
                        count = 0;
                        resultValue = 101;
                    }
                }, 15);
            });
        }
    });
});