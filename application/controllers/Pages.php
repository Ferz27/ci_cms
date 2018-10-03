<?php

class Pages extends CI_Controller
{
	public function view($page = 'home')
	{
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