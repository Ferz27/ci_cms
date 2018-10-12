<?php

class pages_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
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
	//проверка есть ли такая страница в бд
	function valid_slug($sl)
	{
		$slug = mb_strtolower(rus2translit($sl));//приводим slug в нжиний регистор и меняем кирилицу на латиницу
		$query = $this->db->get_where('Pages', array('slug' => $slug));//запрашиваем из бд странци с таким slug
		if(!empty($query->row_array()))
		{
			return FALSE;
		}
		return TRUE;
	}

}