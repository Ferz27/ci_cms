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
			$query = $this->db->get('pages');
			return $query->result_array();
		}

		$query = $this->db->get_where('page', array('slug' => $slug));
		return $query->row_array();
	}

}