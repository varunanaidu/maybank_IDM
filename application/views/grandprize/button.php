<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="x-ua-compatible" content="ie=edge">

	<title>GRANDPRIZE HUT METRO 21</title>

	<!-- Font Awesome Icons -->
	<link rel="stylesheet" href="<?= base_url(); ?>assets/adminlte3/plugins/fontawesome-free/css/all.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="<?= base_url(); ?>assets/adminlte3/dist/css/AdminLTE.min.css">
	<!-- Google Font: Source Sans Pro -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
	<link href="<?= base_url(); ?>assets/vendor/select2/select2.min.css" rel="stylesheet" media="all">

	<link rel="stylesheet" href="<?= base_url(); ?>assets/css/style.css">
</head>
<body class="hold-transition layout-top-nav">
	<div class="wrapper">

		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">

			<!-- Main content -->
			<div class="content">
				<div class="container">
					<div class="row">
						<div class="col-md-12 form-group">
							<select class="form-control" id="gift_id" name="gift_id" >
								<!-- <option value="">-- Pilih Hadiah --</option> -->
								<?php 
								if (isset($gift) and $gift != '0') {
									foreach ($gift as $row) {
										?>
										<option value="<?= $row->gift_id ?>" data-text="<?= $row->gift_name ?>" <?= ( $row->gift_id == 1 ? 'selected' : '' ) ?>><?= $row->gift_name ?></option>
										<?php 
									}
								}
								?>
							</select>
						</div>
						<div class="col-md-12 form-group">
							<button type="button" class="btn btn-success" id="btnStart">START</button>
							<button type="button" class="btn btn-danger" id="btnStop">STOP</button>
						</div>
						<div class="col-md-12 form-group">
							<select class="form-control" id="selectedWinner" name="selectedWinner" style="width: 100%;"></select>
						</div>
						<div class="col-md-12 form-group">
							<button type="button" class="btn btn-secondary" id="btnChoose">CHOOSE</button>
						</div>
					</div>
					<!-- /.row -->
				</div><!-- /.container-fluid -->
			</div>
			<!-- /.content -->
		</div>
		<!-- /.content-wrapper -->
	</div>
	<!-- ./wrapper -->

	<!-- REQUIRED SCRIPTS -->
	<script>var base_url = "<?php echo base_url()?>";</script>
	<!-- jQuery -->
	<script src="<?= base_url(); ?>assets/adminlte3/plugins/jquery/jquery.min.js"></script>
	<!-- Bootstrap 4 -->
	<script src="<?= base_url(); ?>assets/adminlte3/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
	<!-- AdminLTE App -->
	<script src="<?= base_url(); ?>assets/adminlte3/dist/js/adminlte.min.js"></script>
	<script src="<?= base_url(); ?>assets/vendor/select2/select2.min.js"></script>
	<!-- MAIN -->
	<script src="https://js.pusher.com/7.0/pusher.min.js"></script>
	<script src="<?= base_url(); ?>assets/js/pages/button.js"></script>

</body>
</html>
