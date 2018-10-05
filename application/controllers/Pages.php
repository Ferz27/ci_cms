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
		$data['page'] = $this->pages_model->get_page($page);
		$data['title'] = $data['page']['page_title'];

		$this->load->view('templates/header', $data);
		$this->load->view('pages/page', $data);
		$this->load->view('templates/footer', $data);
	}

	public function view($page = 'home')
	{
		$this->load->helper('url');
		//проверка существования файла страницы
		if (!file_exists(APPPATH.'/views/pages/'.$page.'.php'))
		{   //выводим 404 ошбку если страницы нет
			show_404();
		}

		$data['title'] = ucfirst($page);    //Первая буква с большой буквы

		$this->load->view('templates/header', $data);
		$this->load->view('pages/'.$page, $data);
		$this->load->view('templates/footer', $data);
	}
}