<?php


class navigations_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function getNav()
	{
		$nav = ['home' => '', 'create' => 'pages/create'];
		return $nav;
	}
}
