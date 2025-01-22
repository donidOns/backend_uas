<div class="container-fluid">
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">Student</h1>
	</div>

	<?= $this->session->flashdata('message'); ?>

	<div class="card shadow mb-4">
		<div class="card-header d-flex flex-row align-items-center justify-content-between py-3">
			<h6 class="m-0 font-weight-bold text-primary">Data Mahasiswa</h6>

			<a href="<?= base_url('student/create') ?>" class="btn btn-primary btn-sm">
				<i class="fas fa-plus"></i> Tambah
			</a>
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th>No</th>
							<th>Email</th>
							<th>NIM</th>
							<th>Nama</th>
							<th>Kelas</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php $no = 1;
						foreach ($students as $student) : ?>
							<tr>
								<td><?= $no++ ?></td>
								<td><?= $student->email ?></td>
								<td><?= $student->nim ?></td>
								<td><?= $student->name ?></td>
								<td><?= $student->class ?></td>
								<td>
									<a href="<?= base_url('student/edit/') . $student->id ?>" class="btn btn-warning">
										Edit
									</a>

									<a href="<?= base_url('student/delete/') . $student->id ?>" class="btn btn-danger">
										Hapus
									</a>
								</td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>