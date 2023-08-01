<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="x-ua-compatible" content="ie=edge">

	<title>DOORPRIZE HUT METRO 21</title>

	<!-- Font Awesome Icons -->
	<link rel="stylesheet" href="<?= base_url(); ?>assets/adminlte3/plugins/fontawesome-free/css/all.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="<?= base_url(); ?>assets/adminlte3/dist/css/AdminLTE.min.css">
	<!-- Google Font: Source Sans Pro -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/vendor/sweetalert2/dist/sweetalert2.min.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/vendor/select2/select2.min.css">
	<link rel="stylesheet" href="<?= base_url(); ?>assets/css/style.css">

	<style>
		.content-wrapper{
			background-image: url('<?= base_url(); ?>assets/images/undianhut.jpg');
			background-size: 100% 100%;
			background-repeat: no-repeat;
			position: center;
			margin: 0 auto !important;
		}

		#nip{
			text-align: center;
		}
	</style>

</head>
<body class="hold-transition layout-top-nav">
	<div class="wrapper">
		<div class="content-wrapper">
			<div class="content">
				<div class="container">
					<div class="row">
						<div class="col-lg-12">
							<div class="card" id="result-container" style="margin-top: 220px;text-align: center;">
								<div class="card-body">
									<img id="gift_file" src="" style="width: 300px;">
									<h1 style="font-size: 45pt;"><span id="gift_name"></span></h1><br>
									<input type="text" class="collapse" name="gift_id" id="gift_id">
									<input type="text" class="collapse" name="registration_id2" id="registration_id2">
								</div>
								<div class="card-footer">
									<h1><span id="name_result"></span></h1><br>
									<h2><span id="information_result"></span></h2><br>
								</div>
							</div>
						</div>
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
								<button type="button" class="btn-option" id="btn-start" style="display: none;">START</button>
								<button type="button" class="btn-option" id="btn-stop" style="display: none;">STOP</button>
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
	<script src="<?= base_url(); ?>assets/js/pages/undian.js"></script>
</body>
</html>