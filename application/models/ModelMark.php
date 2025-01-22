<?php

class ModelMark extends CI_Model
{
	public function get_all_marks()
	{
		$this->db->select('m.id, l.id as lecturer_id, s.id as student_id, l.user_id as lecturer_user_id, s.user_id as student_user_id, lu.name as lecturer_name, su.name as student_name, m.mark');
		$this->db->from('marks m');
		$this->db->join('lecturers l', 'm.lecturer_id = l.id');
		$this->db->join('students s', 'm.student_id = s.id');
		$this->db->join('users lu', 'l.user_id = lu.id');
		$this->db->join('users su', 's.user_id = su.id');

		if ($this->session->userdata('role_id') == 3) {
			$this->db->where('s.user_id', $this->session->userdata('id'));
		}

		$query = $this->db->get();

		return $query->result();
	}

	public function get_mark_by_id($id)
	{
		$this->db->select('m.id, l.id as lecturer_id, s.id as student_id, l.user_id as lecturer_user_id, s.user_id as student_user_id, lu.name as lecturer_name, su.name as student_name, m.mark');
		$this->db->from('marks m');
		$this->db->join('lecturers l', 'm.lecturer_id = l.id');
		$this->db->join('students s', 'm.student_id = s.id');
		$this->db->join('users lu', 'l.user_id = lu.id');
		$this->db->join('users su', 's.user_id = su.id');
		$this->db->where('m.id', $id);
		$query = $this->db->get();

		return $query->row();
	}

	public function get_all_mark_recaps()
	{
		$this->db->select('
			s.id as student_id, 
			su.name as student_name, 
			SUM(m.mark) as total_mark
		');
		$this->db->from('marks m');
		$this->db->join('students s', 'm.student_id = s.id');
		$this->db->join('users su', 's.user_id = su.id');
		$this->db->group_by('s.id');

		if ($this->session->userdata('role_id') == 3) {
			$this->db->where('s.user_id', $this->session->userdata('id'));
		}

		$query = $this->db->get();

		return $query->result();
	}

	public function get_marks_by_student_id($student_id)
	{
		$this->db->select('
        m.id as mark_id,
        su.name as student_name,
        lu.name as lecturer_name,
        l.course as course_name,
        m.mark as mark
    ');
		$this->db->from('marks m');
		$this->db->join('students s', 'm.student_id = s.id');
		$this->db->join('users su', 's.user_id = su.id');
		$this->db->join('lecturers l', 'm.lecturer_id = l.id');
		$this->db->join('users lu', 'l.user_id = lu.id');
		$this->db->where('s.id', $student_id);
		$query = $this->db->get();

		return $query->result();
	}


	public function create_mark($data)
	{
		$mark_data = [
			'lecturer_id' => $data['lecturer_id'],
			'student_id' => $data['student_id'],
			'mark' => $data['mark']
		];

		return $this->db->insert('marks', $mark_data);
	}

	public function update_mark($id, $data)
	{
		$mark_data = [
			'lecturer_id' => $data['lecturer_id'],
			'student_id' => $data['student_id'],
			'mark' => $data['mark']
		];

		return $this->db->where('id', $id)->update('marks', $mark_data);
	}

	public function delete_mark($id)
	{
		$this->db->where('id', $id);
		return $this->db->delete('marks');
	}
}
