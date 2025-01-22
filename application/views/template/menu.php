<!-- Heading -->
<div class="sidebar-heading">
	Main Menu
</div>

<!-- Nav Item - Pages Collapse Menu -->
<!-- <li class="nav-item active">
				<a class="nav-link" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
					<i class="fas fa-fw fa-folder"></i>
					<span>Pages</span>
				</a>
				<div id="collapsePages" class="collapse show" aria-labelledby="headingPages" data-parent="#accordionSidebar">
					<div class="bg-white py-2 collapse-inner rounded">
						<h6 class="collapse-header">Login Screens:</h6>
						<a class="collapse-item" href="login.html">Login</a>
						<a class="collapse-item" href="register.html">Register</a>
						<a class="collapse-item" href="forgot-password.html">Forgot Password</a>
						<div class="collapse-divider"></div>
						<h6 class="collapse-header">Other Pages:</h6>
						<a class="collapse-item" href="404.html">404 Page</a>
						<a class="collapse-item active" href="blank.html">Blank Page</a>
					</div>
				</div>
			</li> -->

<?php if ($this->session->userdata('role_id') == 1) : ?>
	<li class="nav-item <?= ($this->uri->segment(1) == 'lecturer') ? 'active' : ''; ?>">
		<a class="nav-link" href="<?= base_url(); ?>lecturer/index">
			<i class="fas fa-fw fa-users"></i>
			<span>Data Dosen</span>
		</a>
	</li>
<?php endif; ?>


<?php if ($this->session->userdata('role_id') == 1) : ?>
	<li class="nav-item <?= ($this->uri->segment(1) == 'student') ? 'active' : ''; ?>">
		<a class="nav-link" href="<?= base_url(); ?>student/index">
			<i class="fas fa-fw fa-users"></i>
			<span>Data Mahasiswa</span>
		</a>
	</li>
<?php endif; ?>

<li class="nav-item <?= ($this->uri->segment(1) == 'mark') ? 'active' : ''; ?>">
	<a class="nav-link" href="<?= base_url(); ?>mark/index">
		<i class="fas fa-fw fa-edit"></i>
		<span>Data Nilai</span>
	</a>
</li>

<li class="nav-item <?= ($this->uri->segment(1) == 'mark') ? 'active' : ''; ?>">
	<a class="nav-link" href="<?= base_url(); ?>mark/recap">
		<i class="fas fa-fw fa-edit"></i>
		<span>Rekap Nilai</span>
	</a>
</li>