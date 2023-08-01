<?php if ( !defined('BASEPATH' ) )exit('No direct script access allowed');?>
<center>  

	<div class="container-fluid">
		<?php 
		if ( isset($email['content']) and $email['content'] != 0 ) {
			foreach ($email['content'] as $row) {
				?>
				<div class="col-sm-6 text-right">
					<div class="ticket light">
						<div class="ticket-head text-center" style="background-image: url(<?= base_url(); ?>assets/images/eticket.png)">
							<div class="ticket-body">
								<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
								<img src="<?= base_url(); ?>assets/public/registran/<?= $row->participant_id ?>/<?= $row->participant_qr ?>">
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
						</div>
					</div>
				</div>
				<?php 
			}
		}
		?>
	</div>



</center>
