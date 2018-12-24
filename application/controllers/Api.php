<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use DForms\Libraries\REST_Controller;

require(APPPATH.'./libraries/REST_Controller.php');
require(APPPATH.'./libraries/Format.php');
class Api extends REST_Controller {
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
    public function form_get($Id = null)
    {
		$this->load->model('model_forms');
		$data['Form'] = $this->model_forms->getFormDetails($Id);
		$data['Questions'] = $this->model_forms->getQuestions($Id);
        if(sizeof($data['Form']) > 0 && sizeof($data['Questions']) > 0 )
        {
            $this->response($data, 200); // 200 being the HTTP response code
        } 
        else
        {
            $this->response(NULL, 204);
        }
    }

    public function forms_get(){
		$this->load->model('model_forms');        
        $formsList = $this->model_forms->getFormsList();
        if ($formsList != NULL) {
            $this->response($formsList,200);
        }else {
            $this->response(NULL, 204);
        }
    }
    
	public function update_post(){
		$this->load->model('model_forms');
        $form = $this->post('FORM');
        $Status = $this->model_forms->updateForm($form);
		$this->response($Status,200);
	}

    public function save_post(){
        if ($this->post('Response') != null) {
            $this->load->model('model_response');
            $saveStatus = $this->model_response->saveResponse($this->post('Response'));
            if ($saveStatus != null) {
                $this->response($saveStatus, 200);
            }else {
                $this->response(null, 500);
            }
        }else{
            $this->response(NULL, 404);
        }
    }

}
