<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('pages_model');
	}

	public function index($page = 'home')
	{
		$this->output->enable_profiler(TRUE);

		$data = $this->pages_model->get_page($page);
		if ($data == null){
			show_404();
		}
		$this->load->view('templates/header', $data);
		$this->load->view('pages/page', $data);
		$this->load->view('templates/footer', $data);
	}

	public function create()
	{
		$this->load->helper('rus2translit');
		$this->output->enable_profiler(TRUE);

		$this->load->helper('form');
		$this->load->library('form_validation');

		$data['title'] = 'Создание новой страницы';

		$this->form_validation->set_rules('title', 'Title', 'required');
		$this->form_validation->set_rules('text', 'text', 'required');

		if ($this->form_validation->run() === FALSE)
		{
			$this->load->view('templates/header', $data);
			$this->load->view('pages/create');
			$this->load->view('templates/footer');

		}
		else
		{
			$this->pages_model->set_pages();

			$data['text'] = 'Страница успешна создана';

			$this->load->view('templates/header', $data);
			$this->load->view('pages/page', $data);
			$this->load->view('templates/footer');
		}
	}
}