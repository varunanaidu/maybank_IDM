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
	<link rel="stylesheet" href="<?= base_url(); ?>assets/winwheel/examples/basic_code_wheel/main.css">
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;600&display=swap" rel="stylesheet"/>

	<style>

		.wrapper {
			margin-top: -5px;
			width: 100%;
			max-width: 1200px;
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
		#canvas {
			max-height: inherit;
			width: inherit;
			margin-top: 200px;
			top: 0;
			padding: 0;
		}
		@keyframes rotate {
			100% {
				transform: rotate(360deg);
			}
		}
		#spin_button {
			position: absolute;
			transform: translate(-50%, -50%);
			top: 50%;
			margin-top: 80px;
			left: 50%;
			height: 20%;
			width: 25%;
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
		#arrow {
			position: absolute;
			width: 4em;
			transform: rotate(-90deg);
			top: 15%;
			left: 47%;
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
				<div class="row" style="margin-top:300px;">
					<div class="col-md-12" align="center">
						<img id="arrow" src="spinner-arrow-.svg" alt="spinner-arrow" />
						<canvas id="canvas" width="434" height="434"></canvas>
						<button id="spin_button">Spin</button>
					</div>
				</div>
				<div id="final-value" style="background-color: #fff;">
					<p id="participant_container"></p>
					<input type="text" class="collapse" name="gift_id" id="gift_id">
					<input type="text" class="collapse" name="registration_id2" id="registration_id2">
				</div>
			</div>
		</div>

		<div class="content">
			<div class="container">

				<div class="card2" style="text-align: center;">
					<div class="col-lg-12">
						<div class="card-body form-group">
							<input type="text" class="form-control" id="registration_id" name="registration_id" autofocus>
							<button type="button" class="btn btn-info" id="buttonSearch"><i class="fa fa-search"></i></button>
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
<script src="<?= base_url(); ?>assets/winwheel/Winwheel.js"></script>
<script src="<?= base_url(); ?>assets/js/TweenMax.min.js"></script>
<script src="<?= base_url(); ?>assets/js/pages/spinwheel2.js"></script>
</body>
</html>
