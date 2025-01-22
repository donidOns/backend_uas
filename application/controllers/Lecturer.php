<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Lecturer extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();

		is_logged_in();

		if ($this->session->userdata('role_id') != 1) {
			redirect('auth/blocked');
		}

		$this->load->model('ModelLecturer');
	}

	public function index()
	{
		$data['title'] = "Lecturer";
		$data['konten'] = "lecturer";

		$data['lecturers'] = $this->ModelLecturer->get_all_lecturers();

		$this->load->view('template/header', $data);
		$this->load->view('pages/lecturer/index', $data);
		$this->load->view('template/footer');
	}

	public function create()
	{
		$data['title'] = "Create Lecturer";
		$data['konten'] = "lecturer";

		$this->load->view('template/header', $data);
		$this->load->view('pages/lecturer/create', $data);
		$this->load->view('template/footer');
	}

	public function store()
	{
		$data = [
			'name' => $this->input->post('name'),
			'email' => $this->input->post('email'),
			'password' => $this->input->post('password'),
			'nidn' => $this->input->post('nidn'),
			'course' => $this->input->post('course'),
		];

		$this->ModelLecturer->create_lecturer($data);

		$this->session->set_flashdata('message', '<div class="alert alert-success" 
		   role="alert"> Data Dosen berhasil ditambahkan </div>');

		redirect('lecturer/index');
	}

	public function edit($id)
	{
		$data['title'] = "Edit Lecturer";
		$data['konten'] = "lecturer";

		$data['lecturer'] = $this->ModelLecturer->get_lecturer_by_id($id);

		$this->load->view('template/header', $data);
		$this->load->view('pages/lecturer/edit', $data);
		$this->load->view('template/footer');
	}

	public function update()
	{
		$id = $this->input->post('id');
		$data = [
			'name' => $this->input->post('name'),
			'email' => $this->input->post('email'),
			'password' => $this->input->post('password'),
			'nidn' => $this->input->post('nidn'),
			'course' => $this->input->post('course'),
		];

		$this->ModelLecturer->update_lecturer($id, $data);

		$this->session->set_flashdata('message', '<div class="alert alert-success" 
		   role="alert"> Data Dosen berhasil diubah </div>');

		redirect('lecturer/index');
	}

	public function delete($id)
	{
		$this->ModelLecturer->delete_lecturer($id);

		$this->session->set_flashdata('message', '<div class="alert alert-success" 
		   role="alert"> Data Dosen berhasil dihapus </div>');

		redirect('lecturer/index');
	}
}
