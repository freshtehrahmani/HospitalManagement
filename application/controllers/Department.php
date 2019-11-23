<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Department extends CI_Controller {
	private $body_Data;
	function __construct()
	{
		parent::__construct();
		if(!is_login()){
			redirect(base_url('login'));
		}
		only_access(array("doctor","admin"));

		$lang_post = $this->session->userdata('lang');
        if($lang_post=="persion"){
			$lang['lbl_dp_name'] = "اسم دیپارتمنت";
			$lang['lbl_dp_description'] = "تشریحات دیپارتمنت";
		}else{
			$lang['lbl_dp_name'] = "Department name";
			$lang['lbl_dp_description'] = "Department Description";
		}

		$this->body_Data = array();
		$this->body_Data['title'] = 'Department';
		$this->load->model('Department_model');
		/*
			Form
		*/
		$this->body_Data['inputs'] = array();
		$this->body_Data['inputs']['name'] 	=	array(
									'label' => $lang['lbl_dp_name'],
									'id' => 'name',
									'fn_arg' => array(
											'class' => 'form-control',
											'name' => 'name',
											'value' => set_value('name')
										)
								);
		$this->body_Data['inputs']['description'] 	=	array(
									'label' => $lang['lbl_dp_description'],
									'id' => 'description',
									'fn' => 'form_textarea',
									'fn_arg' => array(
											'class' => 'form-control',
											'name' => 'description',
											'value' => set_value('description')
										)
								);
	}
	public function index()
	{
		$lang = $this->session->userdata('lang');
		if($lang=="persion"){
			$this->body_Data['lang']['title'] = "  دیپارتمنت ها";
			$this->body_Data['lang']['title_header'] = "لیست همه دیپارتمنت ها";
			$this->body_Data['lang']['th_name'] = "اسم";
			$this->body_Data['lang']['th_description'] = "تشریحات";
			$this->body_Data['lang']['th_action'] = "اکشن";
			$this->body_Data['lang']['btn_edit'] = "ایدیت";
			$this->body_Data['lang']['btn_remove'] = "حذف";
			$this->body_Data['lang']['btn_details'] = "جزئیات";
			
		}else{
			$this->body_Data['lang']['title'] = "Departments";
			$this->body_Data['lang']['title_header'] = "List of all depatment";
			$this->body_Data['lang']['th_name'] = "Name";
			$this->body_Data['lang']['th_description'] = "Description";
			$this->body_Data['lang']['th_action'] = "Action";
			$this->body_Data['lang']['btn_edit'] = "Edit";
			$this->body_Data['lang']['btn_remove'] = "Remove";
			$this->body_Data['lang']['btn_details'] = "Details";
			
		}		
		$this->body_Data['title'] = "All Departments";
		$this->body_Data['departments'] = $this->Department_model->Get();
		$this->load->view('header');
		$this->load->view('departments/all_departments',$this->body_Data);
		$this->load->view('footer');
	}
	public function add(){
		$lang = $this->session->userdata('lang');
		if($lang=="persion"){
			$this->body_Data['lang']['btn_submit'] = "ذخیره";
			$this->body_Data['lang']['btn_reset'] = "ریسیت";
			$this->body_Data['lang']['title'] = "اضافه کردن دیپارتمنت";
		}else{
			$this->body_Data['lang']['btn_submit'] = "Submit";
			$this->body_Data['lang']['btn_reset'] = "Reset";
			$this->body_Data['lang']['title'] = "Add department";
		}		

		/*
			Form Validations
		*/
		$this->load->library(array('form_validation'));
		$validations = array();
		$validations[] = array(
					'field' => 'name',
					'label' => 'Department Name',
					'rules' => 'required',
				);
		$this->form_validation->set_rules($validations);
		if($this->form_validation->run()){
			$data = array();
			foreach ($this->input->post() as $key => $value) {
				$data[$key] = $value;
			}
			$this->Department_model->add($data);
			$this->body_Data['message'] = "A department has been added.";
		}
		$this->load->view('header');
		$this->load->view('forms',$this->body_Data);
		$this->load->view('footer');
	}

	public function update($id = null){
		$lang = $this->session->userdata('lang');
		if($lang=="persion"){
			$this->body_Data['lang']['btn_submit'] = "ذخیره";
			$this->body_Data['lang']['btn_reset'] = "ریسیت";
			$this->body_Data['lang']['title'] = "ایدیت کردن دیپارتمنت";
		}else{
			$this->body_Data['lang']['btn_submit'] = "Submit";
			$this->body_Data['lang']['btn_reset'] = "Reset";
			$this->body_Data['lang']['title'] = "Edit department";
		}	
		if(is_null($id))
			return;
		$this->body_Data['title'] = 'Update Department';
		
		/*
			Form Validations
		*/
		$this->load->library(array('form_validation'));
		$validations = array();
		$validations[] = array(
					'field' => 'name',
					'label' => 'Department Name',
					'rules' => 'required',
				);
		$this->form_validation->set_rules($validations);
		if($this->form_validation->run()){
			$data = array();
			foreach ($this->input->post() as $key => $value) {
				$data[$key] = $value;
			}
			$this->Department_model->Update(array('id'=>$id),$data);
			$this->body_Data['message'] = "A department has been Updated.";
		}
		$department = $this->Department_model->Get(array('id'=>$id));
		$this->body_Data['inputs']['name']['fn_arg']['value'] = $department[0]->name; 
		$this->body_Data['inputs']['description']['fn_arg']['value'] = $department[0]->description; 
		$this->load->view('header');
		$this->load->view('forms',$this->body_Data);
		$this->load->view('footer');
	}
	/*
		Delete a department
	*/
	public function delete($id = null){
		if(is_null($id))
			return;
		$this->Department_model->delete(array('id'=> $id));
		$this->index();
	}
	/*
		View all details about a department
	*/
	public function about($id = null){
		if(is_null($id))
			return;
		$this->body_Data['inputs'] = '';
		$this->body_Data['department']= $this->Department_model->Get(array('id'=>$id));
		$this->load->view('header');
		$this->load->view('departments/about',$this->body_Data);
		$this->load->view('footer');
	}
}
