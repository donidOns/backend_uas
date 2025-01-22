<?php

class ModelStudent extends CI_Model
{
	public function get_all_students()
	{
		$this->db->select('s.id, u.email, u.name, s.nim, s.class');
		$this->db->from('students s');
		$this->db->join('users u', 's.user_id = u.id');
		$query = $this->db->get();

		return $query->result();
	}

	public function get_student_by_id($id)
	{
		$this->db->select('s.id, s.user_id, u.email, u.name, s.nim, s.class');
		$this->db->from('students s');
		$this->db->join('users u', 's.user_id = u.id');
		$this->db->where('s.id', $id);
		$query = $this->db->get();

		return $query->row();
	}

	public function create_student($data)
	{
		$user_data = [
			'name' => $data['name'],
			'email' => $data['email'],
			'password' => password_hash($data['password'], PASSWORD_DEFAULT),
			'role_id' => 3
		];

		$this->db->insert('users', $user_data);

		$student_data = [
			'user_id' => $this->db->insert_id(),
			'nim' => $data['nim'],
			'class' => $data['class']
		];

		return $this->db->insert('students', $student_data);
	}

	public function update_student($id, $data)
	{
		$student = $this->get_student_by_id($id);

		$user_data = [
			'name' => $data['name'],
			'email' => $data['email'],
			'password' => !empty($data['password']) ? password_hash($data['password'], PASSWORD_DEFAULT) : NULL
		];

		$this->db->where('id', $student->user_id);
		$this->db->update('users', $user_data);

		$student_data = [
			'nim' => $data['nim'],
			'class' => $data['class']
		];

		return $this->db->where('id', $id)->update('students', $student_data);
	}

	public function delete_student($id)
	{
		$this->db->where('id', $id);
		return $this->db->delete('students');
	}
}
