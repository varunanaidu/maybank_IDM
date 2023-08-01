<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="x-ua-compatible" content="ie=edge">

	<title>SPIN WHEEL PAMERAN</title>

	<!-- Font Awesome Icons -->
	<link rel="stylesheet" href="<?= base_url(); ?>assets/adminlte3/plugins/fontawesome-free/css/all.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="<?= base_url(); ?>assets/adminlte3/dist/css/AdminLTE.min.css">
	<!-- Google Font: Source Sans Pro -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/vendor/sweetalert2/dist/sweetalert2.min.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/vendor/select2/select2.min.css">
	<link rel="stylesheet" href="<?= base_url(); ?>assets/css/style.css">
	<link
	href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;600&display=swap"
	rel="stylesheet"
	/>

	<style>

		.wrapper {
			margin-top: 145px;
			width: 100%;
			max-width: 830px;
			background-image: url("<?= base_url(); ?>assets/images/background.png") !important;
			background-size: cover !important;
			background-position: center center !important;
			background-attachment: fixed !important;
			background-repeat: no-repeat !important;
			z-index: 0 !important;
			width: 100% !important;
			position: absolute;
			transform: translate(-50%, -50%);
			top: 50%;
			left: 50%;
			padding: 3em;
			border-radius: 1em;
			box-shadow: 0 4em 5em rgba(27, 8, 53, 0.2);
		}
		.wrapper h1 {
			color: #000;
		}
		.container {
			position: relative;
			width: 100%;
			height: 100%;
		}
		#wheel {
			max-height: inherit;
			width: inherit;
			margin-top: 20px;
			top: 0;
			padding: 0;
		}
		@keyframes rotate {
			100% {
				transform: rotate(360deg);
			}
		}
		#spin-btn {
			position: absolute;
			transform: translate(-50%, -50%);
			top: 50%;
			margin-top: -20px;
			left: 50%;
			height: 25%;
			width: 28%;
			border-radius: 50%;
			cursor: pointer;
			border: 0;
			background: #d63e4d;
			color: #fff;
			text-transform: uppercase;
			font-size: 1.8em;
			letter-spacing: 0.1em;
			font-weight: 600;
		}
		img {
			position: absolute;
			width: 4em;
			top: 45%;
			right: -4%;
		}
		#final-value {
			font-size: 1.5em;
			text-align: center;
			margin-top: 1.5em;
			color: #202020;
			font-weight: 500;
		}
		@media screen and (max-width: 768px) {
			.wrapper {
				font-size: 12px;
			}
			img {
				right: -5%;
			}
		}
	</style>

</head>
<body class="hold-transition layout-top-nav">
	<div class="wrapper">
		
		
			<div class="content">
				<div class="container">
					<div class="row" style="margin-top:300px">
						<canvas id="wheel"></canvas>
						<button id="spin-btn">Spin</button>
						<img src="spinner-arrow-.svg" alt="spinner-arrow" />
					</div>
					<div id="final-value" style="background-color: #fff;">
						<p>Varuna Dewi - varunadewi@gmail.com</p>
						
					</div>
				</div>
			</div>

			<div class="content">
				<div class="container">
					
					<div class="card2" style="text-align: center;">
						<div class="col-lg-12">
							<div class="card-body form-group">
								<input type="text" class="form-control" id="nip" name="nip" autofocus>
								<button type="button" class="btn btn-info" id="buttonSearch"><i class="fa fa-search"></i></button>
								<button type="button" class="btn-option" id="btn-start" style="display: none;">START</button>
								<button type="button" class="btn-option" id="btn-stop" style="display: none;">STOP</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

		<div class="modal fade" id="default-modal" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<select class="form-control" id="searchContainer" name="searchContainer" style="width: 100%;"></select>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-primary" id="searchEmp">Search</button>
					</div>
				</div>
			</div>
		</div>
	</div>


	<!-- REQUIRED SCRIPTS -->
	<!-- Chart JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
	<!-- Chart JS Plugin for displaying text over chart -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-datalabels/2.1.0/chartjs-plugin-datalabels.min.js"></script>
	<!-- Script -->
	<script src="script.js"></script>
	<script type="text/javascript">
		const wheel = document.getElementById("wheel");
		const spinBtn = document.getElementById("spin-btn");
		const finalValue = document.getElementById("final-value");
//Object that stores values of minimum and maximum angle for a value
		const rotationValues = [
			{ minDegree: 0, maxDegree: 30, value: "Motor" },
			{ minDegree: 31, maxDegree: 90, value: "Sepeda Lipat" },
			{ minDegree: 91, maxDegree: 150, value: "Zonk" },
			{ minDegree: 151, maxDegree: 210, value: "Voucher" },
			{ minDegree: 211, maxDegree: 270, value: "Sepeda Gunung" },
			{ minDegree: 271, maxDegree: 330, value: "Mobil" },
			{ minDegree: 331, maxDegree: 360, value: "Motor" },
			];
//Size of each piece
		const data = [16, 16, 16, 16, 16, 16];
//background color for each piece
		var pieColors = [
			"#FDBB2F",
			"#F47A1F",
			"#377B2B",
			"#7AC142",
			"#007CC3",
			"#00529B",
			];
//Create chart
		let myChart = new Chart(wheel, {
  //Plugin for displaying text on pie chart
			plugins: [ChartDataLabels],
  //Chart Type Pie
			type: "pie",
			data: {
    //Labels(values which are to be displayed on chart)
				labels: ["Sepeda Lipat", "Motor", "Mobil", "Sepeda Gunung", "Voucher", "Zonk"],
    //Settings for dataset/pie
				datasets: [
				{
					backgroundColor: pieColors,
					data: data,
				},
				],
			},
			options: {
    //Responsive chart
				responsive: true,
				animation: { duration: 0 },
				plugins: {
      //hide tooltip and legend
					tooltip: false,
					legend: {
						display: false,
					},
      //display labels inside pie chart
					datalabels: {
						color: "#ffffff",
						formatter: (_, context) => context.chart.data.labels[context.dataIndex],
						font: { size: 24 },
					},
				},
			},
		});
//display value based on the randomAngle
		const valueGenerator = (angleValue) => {
			for (let i of rotationValues) {
    //if the angleValue is between min and max then display it
				if (angleValue >= i.minDegree && angleValue <= i.maxDegree) {
					finalValue.innerHTML = `<p>Hadiah: ${i.value}</p>`;
					spinBtn.disabled = false;
					break;
				}
			}
		};

//Spinner count
		let count = 0;
//100 rotations for animation and last rotation for result
		let resultValue = 101;
//Start spinning
		spinBtn.addEventListener("click", () => {
			spinBtn.disabled = true;
  //Empty final value
			finalValue.innerHTML = `<p>Good Luck!</p>`;
  //Generate random degrees to stop at
			let randomDegree = Math.floor(Math.random() * (355 - 0 + 1) + 0);
  //Interval for rotation animation
			let rotationInterval = window.setInterval(() => {
    //Set rotation for piechart
    /*
    Initially to make the piechart rotate faster we set resultValue to 101 so it rotates 101 degrees at a time and this reduces by 1 with every count. Eventually on last rotation we rotate by 1 degree at a time.
    */
				myChart.options.rotation = myChart.options.rotation + resultValue;
    //Update chart with new value;
				myChart.update();
    //If rotation>360 reset it back to 0
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
			}, 10);
		});
	</script>
	<script>var base_url = "<?php echo base_url()?>";</script>
	<!-- jQuery -->
	<script src="<?= base_url(); ?>assets/adminlte3/plugins/jquery/jquery.min.js"></script>
	<!-- Bootstrap 4 -->
	<script src="<?= base_url(); ?>assets/adminlte3/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
	<!-- AdminLTE App -->
	<script src="<?= base_url(); ?>assets/adminlte3/dist/js/adminlte.min.js"></script>
	<!-- MAIN -->
	<script src="<?= base_url(); ?>assets/vendor/sweetalert2/dist/sweetalert2.min.js"></script>
	<script src="<?= base_url(); ?>assets/vendor/select2/select2.min.js"></script>
	<script src="<?= base_url(); ?>assets/js/pages/undian.js"></script>
</body>
</html>