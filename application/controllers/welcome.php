<?php

class Welcome extends Controller {

	function Welcome()
	{
		parent::Controller();
	}
	
	function index()
	{
		$this->load->helper('url');
		$items = new Item();
		$items->get();
		$data['items'] = $items;
		$this->load->view('welcome_message', $data);
	}
	
	function create_table(){
		$item = new Item();
		$item->create_table();
	}
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */