<?php

class ModelLecturer extends CI_Model
{
	public function get_all_lecturers()
	{
		$this->db->select('l.id, u.email, u.name, l.nidn, l.course');
		$this->db->from('lecturers l');
		$this->db->join('users u', 'l.user_id = u.id');
		$query = $this->db->get();

		return $query->result();
	}

	public function get_lecturer_by_id($id)
	{
		$this->db->select('l.id, l.user_id, u.email, u.name, l.nidn, l.course');
		$this->db->from('lecturers l');
		$this->db->join('users u', 'l.user_id = u.id');
		$this->db->where('l.id', $id);
		$query = $this->db->get();

		return $query->row();
	}

	public function create_lecturer($data)
	{
		$user_data = [
			'name' => $data['name'],
			'email' => $data['email'],
			'password' => password_hash($data['password'], PASSWORD_DEFAULT),
			'role_id' => 2
		];

		$this->db->insert('users', $user_data);

		$lecturer_data = [
			'user_id' => $this->db->insert_id(),
			'nidn' => $data['nidn'],
			'course' => $data['course']
		];

		return $this->db->insert('lecturers', $lecturer_data);
	}

	public function update_lecturer($id, $data)
	{
		$lecturer = $this->get_lecturer_by_id($id);

		$user_data = [
			'name' => $data['name'],
			'email' => $data['email'],
			'password' => !empty($data['password']) ? password_hash($data['password'], PASSWORD_DEFAULT) : NULL
		];

		$this->db->where('id', $lecturer->user_id);
		$this->db->update('users', $user_data);

		$lecturer_data = [
			'nidn' => $data['nidn'],
			'course' => $data['course']
		];

		return $this->db->where('id', $id)->update('lecturers', $lecturer_data);
	}

	public function delete_lecturer($id)
	{
		$this->db->where('id', $id);
		return $this->db->delete('lecturers');
	}
}
