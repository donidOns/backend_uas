<div class="container-fluid">
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">Nilai</h1>
	</div>

	<?= $this->session->flashdata('message'); ?>

	<div class="card shadow mb-4">
		<div class="card-header d-flex flex-row align-items-center justify-content-between py-3">
			<h6 class="m-0 font-weight-bold text-primary">Data Rekap Nilai</h6>
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th>No</th>
							<th>Student</th>
							<th>Lecturer</th>
							<th>Course Name</th>
							<th>Nilai</th>
							<th>Grade</th>
						</tr>
					</thead>
					<tbody>
						<?php $no = 1;
						foreach ($marks as $mark) : ?>
							<tr>
								<td><?= $no++ ?></td>
								<td><?= $mark->student_name ?></td>
								<td><?= $mark->lecturer_name ?></td>
								<td><?= $mark->course_name ?></td>
								<td><?= $mark->mark ?></td>
								<td>
									<?php if ($mark->mark >= 90) {
										echo 'A';
									} elseif ($mark->mark >= 80) {
										echo 'B';
									} elseif ($mark->mark >= 70) {
										echo 'C';
									} elseif ($mark->mark >= 60) {
										echo 'D';
									} else {
										echo 'E';
									} ?>
								</td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>