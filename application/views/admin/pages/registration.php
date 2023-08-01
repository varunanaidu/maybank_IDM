<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!-- Begin Page Content -->
<div class="container-fluid">
	<!-- Page Heading -->
	<h1 class="h3 mb-2 text-gray-800">Pendaftar</h1>
	<!-- DataTales Example -->
	<div class="card shadow mb-4">
		<div class="card-body">
			<div class="row form-group">
				<div class="col-md-4">
					<input type="date" class="form-control" name="start_date" id="start_date">
				</div>
				<div class="col-md-1">
					TO
				</div>
				<div class="col-md-4">
					<input type="date" class="form-control" name="end_date" id="end_date">
				</div>
				<div class="col-md-3">
					<button type="button" class="btn btn-sm btn-primary" id="filter_button">Filter</button>
					<button type="button" class="btn btn-sm btn-danger" id="reset_button">Reset</button>
				</div>
			</div>
			<div class="table-responsive">
				<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th>Verifikasi Kehadiran</th>
							<th>Kirim Ulang Email</th>
							<th>No. Registrasi</th>
							<th>Nama</th>
							<th>Nama Perusahaan</th>
							<th>WhatsApp</th>
							<th>Email</th>
							<th>Nama Relationship Manager/<br/> Contact di Maybank</th>
							<th>Tanggal Pendaftaran</th>
						</tr>
					</thead>
					<tbody></tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<!-- /.container-fluid -->