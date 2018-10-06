<?php

class pages_model extends CI_Model
{
	public function __construct()
	{
		$this->load->database();
	}

	public function get_page($slug = FALSE)
	{
		if ($slug === FALSE)
		{
			$query = $this->db->get('Pages');
			return $query->result_array();
		}

		$query = $this->db->get_where('Pages', array('slug' => $slug));
		return $query->row_array();
	}
	public function set_pages()
	{
		$slug = url_title($this->input->post('title'), 'dash', TRUE);

		$data = array(
			'title' => $this->input->post('title'),
			'slug' => mb_strtolower(rus2translit($slug)),
			'text' => $this->input->post('text')
		);

		return $this->db->insert('pages', $data);
	}

}