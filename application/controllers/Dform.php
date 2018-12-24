<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dform extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
	}
    public function index()
	{
		$this->load->view('forms');
	}

	public function newform()
	{
		$this->load->model('model_forms');
		// echo "http://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI']; 
		$newformId =	$this->model_forms->generateNewForm();
		if ($newformId != null) {
			redirect('./form/edit/' . $newformId);
			// $this->edit($newform);
		}else {
			echo 'cannot create new form';
		}
	}

    public function view($Id = null)
    {
		$this->load->model('model_forms');
		$data['FormId'] = $Id; //$this->model_forms->getFormDetails($Id);
		// $data['Questions'] = $this->model_forms->getQuestions($Id);
        $this->load->view('view', $data);
    }

    public function edit($Id = null)
    {
		$this->load->model('model_forms');
		$data['Form'] = $this->model_forms->getFormDetails($Id);
		$data['Questions'] = $this->model_forms->getQuestions($Id);
		if (!sizeof($data['Form'])) {
			show_404();
		}
		$this->load->view('edit', $data);
	}

}
