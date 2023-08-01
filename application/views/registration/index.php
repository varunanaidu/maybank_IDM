<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Maybank Indonesia Economic Outlook 2023</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="<?= base_url(); ?>assets/images/icons/favicon.ico"/>
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/vendor/bootstrap/css/bootstrap.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/fonts/iconic/css/material-design-iconic-font.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/vendor/animate/animate.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/vendor/css-hamburgers/hamburgers.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/vendor/animsition/css/animsition.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/vendor/select2/select2.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/vendor/daterangepicker/daterangepicker.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/vendor/sweetalert2/dist/sweetalert2.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/css/util.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/css/main.css">
	<!--===============================================================================================-->
	<style type="text/css">
		small {
			font-size: 70% !important;
		}
		.container-contact100{			
			background-image: url("<?= base_url(); ?>assets/images/maybankland.jpg") !important;
			background-size: cover;
			background-position: center;
			background-repeat: no-repeat !important;
			z-index: 0 !important;
		}
		@media only screen and (max-width: 600px) {
			.container-contact100 {
				background-image: url("<?= base_url(); ?>assets/images/maybank.jpg") !important;
			}
		}
		.wrap-contact100 {
			margin-top: 300px !important;
			background: rgba(255,255,255,0.55);
			box-shadow: 0 0 10px 8px rgb(0 0 0 / 30%);
			border-radius: 0.5em;
			transition: all 0.3s ease;

		}
		.wrap-contact100:hover {
			background:rgba(255,255,255,0.95);
			box-shadow:0 0 20px 20px rgba(0,0,0,0.5);
		}
		
	</style>

</head>
<body>

	<div class="container-contact100">
		
		<div class="wrap-contact100">
			<form class="contact100-form validate-form" id="registrationForm" method="POST">
				<span class="contact100-form-title">
					Please Complete Below Details 
				</span>

				<div class="wrap-input100 validate-input">
					<input class="input100" type="text" name="participant_name" placeholder="Full Name" required>
					<span class="focus-input100"></span>
				</div>

				<div class="wrap-input100 validate-input">
					<input class="input100" type="text" name="company_name" placeholder="Company Name" required>
					<span class="focus-input100"></span>
				</div>

				<div class="wrap-input100 validate-input">
					<input class="input100" type="email" name="participant_email" placeholder="Email" required>
					<small style="padding: 1em;">
						Your registration confirmation will be sent to this email, Please ensure 
						you enter a valid email address
					</small>
					<span class="focus-input100"></span>
				</div>

				<div class="wrap-input100 validate-input">
					<input class="input100" type="text" name="participant_wa" placeholder="Phone Number" required>
					<span class="focus-input100"></span>
				</div>

				<div class="wrap-input100 validate-input">
					<input class="input100" type="text" name="participant_manager" placeholder="Your Relationship Manager or Contact's Name in Maybank" required>
					<span class="focus-input100"></span>
				</div>

				
				<div class="container-contact100-form-btn">
					<button class="contact100-form-btn" type="submit" id="btnSubmit">
						REGISTER
					</button>
				</div>
			</form>

			
		</div>
	</div>



	<div id="dropDownSelect1"></div>
	<script type="text/javascript">var base_url = "<?= base_url(); ?>" </script>
	<!--===============================================================================================-->
	<script src="<?= base_url(); ?>assets/vendor/jquery/jquery-3.2.1.min.js"></script>
	<!--===============================================================================================-->
	<script src="<?= base_url(); ?>assets/vendor/animsition/js/animsition.min.js"></script>
	<!--===============================================================================================-->
	<script src="<?= base_url(); ?>assets/vendor/bootstrap/js/popper.js"></script>
	<script src="<?= base_url(); ?>assets/vendor/bootstrap/js/bootstrap.min.js"></script>
	<!--===============================================================================================-->
	<script src="<?= base_url(); ?>assets/vendor/select2/select2.min.js"></script>
	<!--===============================================================================================-->
	<script src="<?= base_url(); ?>assets/vendor/daterangepicker/moment.min.js"></script>
	<script src="<?= base_url(); ?>assets/vendor/daterangepicker/daterangepicker.js"></script>
	<script src="<?= base_url(); ?>assets/vendor/sweetalert2/dist/sweetalert2.min.js"></script>
	<!--===============================================================================================-->
	<script src="<?= base_url(); ?>assets/vendor/countdowntime/countdowntime.js"></script>
	<!--===============================================================================================-->
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAKFWBqlKAGCeS1rMVoaNlwyayu0e0YRes"></script>
	<script src="<?= base_url(); ?>assets/js/map-custom.js"></script>
	<!--===============================================================================================-->
	<script src="<?= base_url(); ?>assets/js/main.js"></script>
	<script src="<?= base_url(); ?>assets/js/pages/registration.js"></script>

	<!-- Global site tag (gtag.js) - Google Analytics -->

</body>
</html>
