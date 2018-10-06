<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_pages extends CI_Migration
{

	public function up()
	{
		$this->dbforge->add_field(array(
			'page_id'          => array(
				'type'           => 'INT',
				'constraint'     => 5,
				'unsigned'       => true,
				'auto_increment' => true
			),
			'page_title'       => array(
				'type'       => 'VARCHAR',
				'constraint' => '100',
			),
			'page_description' => array(
				'type' => 'TEXT',
				'null' => true,
			),
			'page_slug'  =>  array(
				'type'       => 'VARCHAR',
				'constraint' => '100',
				'null' => false,
			),
			'page_text' => array(
				'type' => 'TEXT',
				'null' => false,
			),
		));
		$this->dbforge->add_key('page_id', true);
		$this->dbforge->create_table('Pagesclass');
	}

	public function down()
	{
		$this->dbforge->drop_table('Pagesclass');
	}
}