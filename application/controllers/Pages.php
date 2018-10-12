<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('pages_model');
		$this->load->model('navigations_model');
	}

	public function index($page = 'home')
	{
		$this->output->enable_profiler(TRUE);


		$data = $this->pages_model->get_page($page);
		$data['nav'] = $this->navigations_model->getNav();
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
		$data['nav'] = $this->navigations_model->getNav();

		$this->form_validation->set_rules('title', 'Title', 'required|callback_slug_check');
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

			$data['nav'] = $this->navigations_model->getNav();

			$this->load->view('templates/header', $data);
			$this->load->view('pages/page', $data);
			$this->load->view('templates/footer');
		}
	}

	public function slug_check($slug)
	{
		$this->load->helper('rus2translit');
		if ($this->pages_model->valid_slug($slug) == FALSE)
		{
			$this->form_validation->set_message('slug_check', 'Заголовок с названием "{field}" уже существует, пожалуйста введите другое');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
}