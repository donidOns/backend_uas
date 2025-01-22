<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Student extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();

		is_logged_in();

		if ($this->session->userdata('role_id') != 1) {
			redirect('auth/blocked');
		}

		$this->load->model('ModelStudent');
	}

	public function index()
	{
		$data['title'] = "Student";
		$data['konten'] = "student";

		$data['students'] = $this->ModelStudent->get_all_students();

		$this->load->view('template/header', $data);
		$this->load->view('pages/student/index', $data);
		$this->load->view('template/footer');
	}

	public function create()
	{
		$data['title'] = "Create Student";
		$data['konten'] = "student";

		$this->load->view('template/header', $data);
		$this->load->view('pages/student/create', $data);
		$this->load->view('template/footer');
	}

	public function store()
	{
		$data = [
			'name' => $this->input->post('name'),
			'email' => $this->input->post('email'),
			'password' => $this->input->post('password'),
			'nim' => $this->input->post('nim'),
			'class' => $this->input->post('class'),
		];

		$this->ModelStudent->create_student($data);

		$this->session->set_flashdata('message', '<div class="alert alert-success" 
		   role="alert"> Data Mahasiswa berhasil ditambahkan </div>');

		redirect('student/index');
	}

	public function edit($id)
	{
		$data['title'] = "Edit Student";
		$data['konten'] = "student";

		$data['student'] = $this->ModelStudent->get_student_by_id($id);

		$this->load->view('template/header', $data);
		$this->load->view('pages/student/edit', $data);
		$this->load->view('template/footer');
	}

	public function update()
	{
		$id = $this->input->post('id');
		$data = [
			'name' => $this->input->post('name'),
			'email' => $this->input->post('email'),
			'password' => $this->input->post('password'),
			'nim' => $this->input->post('nim'),
			'class' => $this->input->post('class'),
		];

		$this->ModelStudent->update_student($id, $data);

		$this->session->set_flashdata('message', '<div class="alert alert-success" 
		   role="alert"> Data Mahasiswa berhasil diubah </div>');

		redirect('student/index');
	}

	public function delete($id)
	{
		$this->ModelStudent->delete_student($id);

		$this->session->set_flashdata('message', '<div class="alert alert-success" 
		   role="alert"> Data Mahasiswa berhasil dihapus </div>');

		redirect('student/index');
	}
}
