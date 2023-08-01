<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
<head>
	<meta charset="utf-8"> 
	<meta name="viewport" content="width=device-width"> 
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="x-apple-disable-message-reformatting">  
	<style>
		body {
			font-family: "Montserrat-Bold", sans-serif;
			font-weight: 600;
			margin-left: -5px;
		}
		.container {
			margin-left: 12px !important;
			position: relative;
			color: #fff;
		}
		.centered {
			position: absolute;
			margin-top: 100px !important;
			top: 50%;
			left: 50%;
			transform: translate(-50%, -50%);
		}
		table { 
			width: 20%; 
		}
		.ticket{
			width: 20%;
		}
		@media 
		only screen and (max-width: 600px),
		{
			.ticket { 
				width: 100%; 
			}
		</style>
	</head>

	<body>
		<center>  

			<div class="container">
				<?php 
				if ( isset($participant) and $participant != 0 ) {
					foreach ($participant as $row) {
						?>
						<img src="<?= base_url(); ?>assets/images/eticket.png" class="ticket">
						<div class="centered">
							<img src="<?= base_url(); ?>assets/public/registran/<?= $row->participant_id ?>/<?= $row->participant_qr ?>" style="margin-top: -100px !important;">
							<h2 style="margin-bottom: 20px !important;"><?= $row->participant_id ?></h2>
							<table>
								<tr>
									<td>Full Name</td>
									<td>:</td>
									<td><?= $row->participant_name ?></td>
								</tr>
								<tr>
									<td>Company Name</td>
									<td>:</td>
									<td><?= $row->company_name ?></td>
								</tr>
								<tr>
									<td>Email</td>
									<td>:</td>
									<td><?= $row->participant_email ?></td>
								</tr>
								<tr>
									<td>Phone Number</td>
									<td>:</td>
									<td><?= $row->participant_wa ?></td>
								</tr>
								
							</table>
						</div>
						<?php 
					}
				}
				?>
			</div>	

		<!-- <div class="ticket">
			<?php 
			if ( isset($participant) and $participant != 0 ) {
				foreach ($participant as $row) {
					?>
					<div class="holes-top"></div>
					<div class="title">
						<div class="logo"><img src="<?= base_url(); ?>assets/images/logoaccorhitam.png"></div>
					</div>
					<div class="poster">
						<img src="<?= base_url(); ?>assets/public/registran/<?= $row->participant_id ?>/<?= $row->participant_qr ?>">
						<h2><?= $row->participant_id ?></h2>
					</div>
					<div class="info">
						<table>
							<tr>
								<td><br/>Tanggal</td>
								<td><br/>:</td>
								<td><br/><br/><?= date('d F Y H:i:s', strtotime($row->addon)) ?></td>
							</tr>
							<tr>
								<td>Name</td>
								<td>:</td>
								<td><?= $row->participant_name ?></td>
							</tr>
							<tr>
								<td>Email</td>
								<td>:</td>
								<td><?= $row->participant_email ?></td>
							</tr>
							<tr>
								<td>WhatsApp</td>
								<td>:</td>
								<td><?= $row->participant_wa ?></td>
							</tr>
						</table>
					</div>
					<div class="holes-lower"></div>
					<div class="serial">
						<img src="<?= base_url(); ?>assets/images/gedung.png">
					</div>
					<?php 
				}
			}
			?>
		</div>
	-->

		<!-- <div class="cardWrap">
			<?php 
			if ( isset($participant) and $participant != 0 ) {
				foreach ($participant as $row) {
					?>
					<div class="card cardLeft">
						<br/><h1>City of ALL</h1>
						<table>
							<tr>
								<td><h2><br/>Tanggal</h2></td>
								<td><h2><br/>:</h2></td>
								<td><h2><br/><?= date('d F Y H:i:s', strtotime($row->addon)) ?></h2></td>
							</tr>
							<tr>
								<td><h2>Name</h2></td>
								<td><h2>:</h2></td>
								<td><h2><?= $row->participant_name ?></h2></td>
							</tr>
							<tr>
								<td><h2>Email</h2></td>
								<td><h2>:</h2></td>
								<td><h2><?= $row->participant_email ?></h2></td>
							</tr>
							<tr>
								<td><h2>WhatsApp</h2></td>
								<td><h2>:</h2></td>
								<td><h2><?= $row->participant_wa ?></h2></td>
							</tr>
						</table>

					</div>
					<div class="card cardRight">
						<div class="logo"><img src="<?= base_url(); ?>assets/images/logoaccordputih.png"></div>
						<div class="qrcode">
							<img src="<?= base_url(); ?>assets/public/registran/<?= $row->participant_id ?>/<?= $row->participant_qr ?>">
							<h2><?= $row->participant_id ?></h2>
						</div>
					</div>

					<?php 
				}
			}
			?>
		</div> -->

	</center>
</body>
</html>