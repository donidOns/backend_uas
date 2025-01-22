<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mark extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();

		is_logged_in();

		$this->load->model('ModelMark');
		$this->load->model('ModelLecturer');
		$this->load->model('ModelStudent');
	}

	public function index()
	{
		$data['title'] = "Mark";
		$data['konten'] = "mark";

		$data['marks'] = $this->ModelMark->get_all_marks();

		$this->load->view('template/header', $data);
		$this->load->view('pages/mark/index', $data);
		$this->load->view('template/footer');
	}

	public function create()
	{
		if ($this->session->userdata('role_id') == 3) {
			redirect('auth/blocked');
		}

		$data['title'] = "Create Mark";
		$data['konten'] = "mark";

		$data['lecturers'] = $this->ModelLecturer->get_all_lecturers();
		$data['students'] = $this->ModelStudent->get_all_students();

		$this->load->view('template/header', $data);
		$this->load->view('pages/mark/create', $data);
		$this->load->view('template/footer');
	}

	public function store()
	{
		if ($this->session->userdata('role_id') == 3) {
			redirect('auth/blocked');
		}

		$data = [
			'lecturer_id' => $this->input->post('lecturer_id'),
			'student_id' => $this->input->post('student_id'),
			'mark' => $this->input->post('mark')
		];

		$this->ModelMark->create_mark($data);

		$this->session->set_flashdata('message', '<div class="alert alert-success" 
		   role="alert"> Nilai berhasil ditambahkan </div>');

		redirect('mark/index');
	}

	public function edit($id)
	{
		if ($this->session->userdata('role_id') == 3) {
			redirect('auth/blocked');
		}

		$data['title'] = "Edit Mark";
		$data['konten'] = "mark";

		$data['mark'] = $this->ModelMark->get_mark_by_id($id);

		$data['lecturers'] = $this->ModelLecturer->get_all_lecturers();
		$data['students'] = $this->ModelStudent->get_all_students();

		$this->load->view('template/header', $data);
		$this->load->view('pages/mark/edit', $data);
		$this->load->view('template/footer');
	}

	public function update()
	{
		if ($this->session->userdata('role_id') == 3) {
			redirect('auth/blocked');
		}

		$id = $this->input->post('id');
		$data = [
			'lecturer_id' => $this->input->post('lecturer_id'),
			'student_id' => $this->input->post('student_id'),
			'mark' => $this->input->post('mark')
		];

		$this->ModelMark->update_mark($id, $data);

		$this->session->set_flashdata('message', '<div class="alert alert-success" 
		   role="alert"> Nilai berhasil diubah </div>');

		redirect('mark/index');
	}

	public function delete($id)
	{
		if ($this->session->userdata('role_id') == 3) {
			redirect('auth/blocked');
		}

		$this->ModelMark->delete_mark($id);

		$this->session->set_flashdata('message', '<div class="alert alert-success" 
		   role="alert"> Nilai berhasil dihapus </div>');

		redirect('mark/index');
	}

	public function recap()
	{
		$data['title'] = "Recap Mark";
		$data['konten'] = "mark";

		$data['marks'] = $this->ModelMark->get_all_mark_recaps();

		$this->load->view('template/header', $data);
		$this->load->view('pages/mark/recap', $data);
		$this->load->view('template/footer');
	}

	public function recap_detail($id)
	{
		$data['title'] = "Recap Mark";
		$data['konten'] = "mark";

		$data['marks'] = $this->ModelMark->get_marks_by_student_id($id);

		$this->load->view('template/header', $data);
		$this->load->view('pages/mark/recap_detail', $data);
		$this->load->view('template/footer');
	}
}
