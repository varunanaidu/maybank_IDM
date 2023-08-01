<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="x-ua-compatible" content="ie=edge">

	<title>GRANDPRIZE City of ALL</title>

	<!-- Font Awesome Icons -->
	<link rel="stylesheet" href="<?= base_url(); ?>assets/adminlte3/plugins/fontawesome-free/css/all.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="<?= base_url(); ?>assets/adminlte3/dist/css/AdminLTE.min.css">
	<!-- Google Font: Source Sans Pro -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

	<style>
		.content-wrapper{
			background-image: url('<?= base_url(); ?>assets/images/backgroundgpz.jpg');
			background-size: 100% 100%;
			background-repeat: no-repeat;
			width: 100%;
			height: auto;
			position: center;
			margin: 0 auto !important;
		}
		
		.card-footer{
			background-color: #032c61;
			border-radius: 20px;
			max-width: 1020px;
			margin: 0 auto;
			font-size: 12pt !important;
		}

		.buttonnext {
			background-color: #4CAF50 !important; /* Green */
			border: none;
			color: white;
			padding: 15px 32px;
			text-align: center;
			text-decoration: none;
			display: inline-block;
			font-size: 16px;
			margin: 4px 2px;
			cursor: pointer;
		}

		.buttonstart {
			cursor:pointer;
			display:inline-block;
			padding:30px;
			background: #032c61;
			border-radius: 20px;
			color: #fff;
			text-transform:uppercase;
			line-height:20px;
			@include transition(box-shadow .25s ease);
			&:after{
				content:'';
				display:inline-block;
				color: #94a657;
				background:#fff;
				font-family: 'FontAwesome';
				padding:3px;
				border-radius: 50%;
				height:20px;
				width:20px;
				margin-left:8px;
				padding-left: 4.5px;
				padding-right:1.5px;
			}
			&.playing{
				&:after{
					padding:3px;
					content:'';
				}
			}

		}

		.buttonreset {
			background-color: #f44336 !important; /* Red */
			border: none;
			color: white;
			padding: 15px 32px;
			text-align: center;
			text-decoration: none;
			display: inline-block;
			font-size: 16px;
			margin: 4px 2px;
			cursor: pointer;
		}

	</style>

	<link rel="stylesheet" href="<?= base_url(); ?>assets/css/style.css">
</head>
<body class="hold-transition layout-top-nav">
	<div class="wrapper">

		
		<div class="content-wrapper">
			<div class="content">
				<div class="container">
					<div class="row">
						<div class="col-lg-12">
							<div class="card" id="result-container" style="margin-top: 310px;text-align: center;">
								
								<div class="row">
									<div class="card-footer" style="margin-top:300px">
										<h1><span id="name_result"></span></h1><br><br>
										
									</div>
								</div>
								<br/>
								<audio id="nyan" src="<?= base_url(); ?>assets/sounds/drumroll.mp3" preload="metadata" type="audio/mpeg">
									Your browser does not support the audio element.
								</audio>
								<button type="button" class="buttonstart" id="btnStart">Start</button>
								<div class="row">
									<div class="card-footer">
										<button type="button" class="buttonreset" id="btnReset">Reset</button>
									</div>
									<div class="card-footer">
										<button type="button" class="buttonnext" id="btnNext" data-id="">Save</button>
									</div>
								</div>

							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row collapse">
				<div class="form-group col-lg-2">
					<select class="form-control" id="gift_id" name="gift_id" >

						<?php 
						if (isset($gift) and $gift != '0') {
							foreach ($gift as $row) {
								?>
								<option value="<?= $row->gift_id ?>" data-text="<?= $row->gift_name ?>" data-image="<?= $row->gift_file ?>" <?= ( $row->gift_id == 1 ? 'selected' : '' ) ?> ><?= $row->gift_name ?></option>
								<?php 
							}
						}
						?>
					</select>
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
<script src="https://js.pusher.com/7.0/pusher.min.js"></script>
<script src="<?= base_url(); ?>assets/js/pages/grandprize2.js"></script>
<script type="text/javascript">
	var nyan = document.getElementById('nyan');
	var nyanBtn = document.getElementById('btnStart');

function playPause(song){
   if (song.paused && song.currentTime >= 0 && !song.ended) {
      song.play();
   } else {
      song.pause();
   }
}

function reset(btn, song){
   if(btn.classList.contains('playing')){
      btn.classList.toggle('playing');
   }
   song.pause();
   song.currentTime = 0;
}

function progress(btn, song){
   setTimeout(function(){
      var end = song.duration; 
      var current = song.currentTime;
      var percent = current/(end/100);
      //check if song is at the end
      if(current==end){
         reset(btn, song);
      }
      //set inset box shadow
      //btn.style.boxShadow = "inset " + btn.offsetWidth * (percent/100) + "px 0px 0px 0px rgba(0,0,0,0.125)"
      //call function again
      progress(btn, song);     
   }, 1000);
}

nyanBtn.addEventListener('click', function(){
   nyanBtn.classList.toggle('playing');
   playPause(nyan);
   progress(nyanBtn, nyan);
});


</script>

</body>
</html>