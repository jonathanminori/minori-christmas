<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->helper('url');
	}

	public function index() {
		$this->load->database();
		$this->load->model('GiftsModel');
		$this->load->helper('form');
		$this->load->library('form_validation');
		
		if ($this->input->method() == 'post') {
			if ($this->input->post('type') == 'add') {
				$this->form_validation->set_rules('name', 'Name', 'required');
				$this->GiftsModel->add_gift();
			} else if ($this->input->post('type') == 'spin') {
				$this->GiftsModel->add_giftees();
			} else if ($this->input->post('type') == 'remove') {
				$this->GiftsModel->remove_gift();
			} 
		}
		
		$url_id = $this->uri->segment('1');
		$data['person_info']= $this->GiftsModel->get_person_by_publicid($url_id);

		if ($data['person_info']->shopping_for != NULL) {
			$data['shopping_for'] = $this->GiftsModel->get_person_by_publicid($data['person_info']->shopping_for);
			$data['shopping_for_gifts'] = $this->GiftsModel->get_gifts($data['person_info']->shopping_for);
		}
		$data['my_gifts'] = $this->GiftsModel->get_gifts($url_id);

		$this->form_validation->set_rules('name', 'Name', 'required');

		$this->load->view('header');
		$this->load->view('view_main', $data);
	}

	public function landing() {
		$this->load->view('header');
		$this->load->view('view_empty');
	}
}
?>