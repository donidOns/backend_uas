<div class="container-fluid">
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">Nilai</h1>
	</div>

	<?= $this->session->flashdata('message'); ?>

	<div class="card shadow mb-4">
		<div class="card-header d-flex flex-row align-items-center justify-content-between py-3">
			<h6 class="m-0 font-weight-bold text-primary">Data Nilai</h6>


			<?php if ($this->session->userdata('role_id') != 3) { ?>
				<a href="<?= base_url('mark/create') ?>" class="btn btn-primary btn-sm">
					<i class="fas fa-plus"></i> Tambah
				</a>
			<?php } ?>
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th>No</th>
							<th>Lecturer</th>
							<th>Student</th>
							<th>Nilai</th>
							<?php if ($this->session->userdata('role_id') != 3) { ?>
								<th>Aksi</th>
							<?php } ?>
						</tr>
					</thead>
					<tbody>
						<?php $no = 1;
						foreach ($marks as $mark) : ?>
							<tr>
								<td><?= $no++ ?></td>
								<td><?= $mark->lecturer_name ?></td>
								<td><?= $mark->student_name ?></td>
								<td><?= $mark->mark ?></td>
								<?php if ($this->session->userdata('role_id') != 3) { ?>
									<td>
										<a href="<?= base_url('mark/edit/') . $mark->id ?>" class="btn btn-warning">
											Edit
										</a>

										<a href="<?= base_url('mark/delete/') . $mark->id ?>" class="btn btn-danger">
											Hapus
										</a>
									</td>
								<?php } ?>

							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>