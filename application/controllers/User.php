<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
	private $body_Data;
	function __construct()
	{
		parent::__construct();
		if(!is_login()){
			redirect(base_url('login'));
		}
		$this->body_Data = array();
		$this->body_Data['title'] = 'Nurse';
		$lang_post = $this->session->userdata('lang');
		if($lang_post=="persion"){

			$lang['btn_submit'] = "ذخیره";
			$lang['btn_reset'] = "ریسیت";

			$lang['lbl_user_name'] = "اسم کاربر";
			$lang['lbl_username'] = "اسم کاربری";
			$lang['lbl_user_email'] = "ایمیل ";
			$lang['lbl_user_photo'] = "عکس";
			$lang['lbl_user_role'] = "رول";
			$lang['lbl_user_pass'] = "پسورد";
			$lang['lbl_user_cpass'] = "تایید پسورد";
		}else{

			$lang['btn_submit'] = "Save";
			$lang['btn_reset'] = "Reset";

			$lang['lbl_user_name'] = "Nmae";
			$lang['lbl_username'] = "Username";
			$lang['lbl_user_email'] = "Email ";
			$lang['lbl_user_photo'] = "Photo";
			$lang['lbl_user_role'] = "Role";
			$lang['lbl_user_pass'] = "Password";
			$lang['lbl_user_cpass'] = "Confirm Password";
		}
		/*
			Form
		*/
		$this->body_Data['inputs'] = array();
		$this->body_Data['lang'] = $lang;
		$this->body_Data['inputs']['full_name'] 	=	array(
									'label' => $lang['lbl_user_name'],
									'id' => 'full_name',
									'fn_arg' => array(
											'class' => 'form-control',
											'name' => 'full_name',
											'id' => 'full_name',
											'value' => set_value('full_name')
										)
								);
		$this->body_Data['inputs']['email'] 	=	array(
									'label' => $lang['lbl_user_email'],
									'id' => 'email',
									'fn_arg' => array(
											'class' => 'form-control',
											'name' => 'email',
											'id' => 'email',
											'value' => set_value('email')
										)
								);
		
		$this->body_Data['inputs']['picture'] 	=	array(
									'label' => $lang['lbl_user_photo'],
									'id' => 'picture',
									'media' => true,
									'fn_arg' => array(
											'class' => 'form-control',
											'name' => 'picture',
											'id' => 'picture',
											'value' => set_value('picture')
										)
								);
		$this->body_Data['inputs']['role'] 	=	array(
									'label' => $lang['lbl_user_role'],
									'id' => 'role',
									'fn' => 'form_dropdown',
									'fn_arg' => array(
											'class' => 'form-control',
											'name' => 'role',
											'options' => $this->config->item('roles'),
											'id' => 'role',
											'value' => set_value('role')
										)
								);
		$this->body_Data['inputs']['user_name'] 	=	array(
									'label' => $lang['lbl_username'],
									'id' => 'user_name',
									'fn_arg' => array(
											'class' => 'form-control',
											'name' => 'user_name',
											'id' => 'user_name',
											'value' => set_value('user_name')
										)
								);
		$this->body_Data['inputs']['password'] 	=	array(
									'label' => $lang['lbl_user_pass'],
									'id' => 'password',
									'fn' => 'form_password',
									'fn_arg' => array(
											'class' => 'form-control',
											'name' => 'password',
											'id' => 'password',
											'value' => set_value('password')
										)
								);
		$this->body_Data['inputs']['password_confirm'] 	=	array(
									'label' => $lang['lbl_user_cpass'],
									'id' => 'password_confirm',
									'fn' => 'form_password',
									'fn_arg' => array(
											'class' => 'form-control',
											'name' => 'password_confirm',
											'id' => 'password_confirm',
											'value' => set_value('password_confirm')
										)
								);
		$this->load->model(array('User_model'));
	}
	public function index()
	{
		$this->page();
	}
	public function page($page= 1)
	{
		$lang = $this->session->userdata('lang');
		if($lang=="persion"){
			$this->body_Data['lang']['title'] = "کاربران";
			$this->body_Data['lang']['title_header'] = "لیست های کاربران";
			$this->body_Data['lang']['th_photo'] = "عکس";
			$this->body_Data['lang']['th_about'] = "درباره";
			$this->body_Data['lang']['th_action'] = "اکشن";
			$this->body_Data['lang']['btn_edit'] = "ایدیت";
			$this->body_Data['lang']['btn_remove'] = "حذف";
		}else{
			$this->body_Data['lang']['title'] = " Users";
			$this->body_Data['lang']['title_header'] = "List Of All Users";
			$this->body_Data['lang']['th_photo'] = "Phone";
			$this->body_Data['lang']['th_about'] = "About";
			$this->body_Data['lang']['th_action'] = "Action";
			$this->body_Data['lang']['btn_edit'] = "Edit";
			$this->body_Data['lang']['btn_remove'] = "Delete";
		}	
		$this->body_Data['title'] = "All Users";
		$this->body_Data['all_user'] = $this->User_model->get();
		$this->load->view('header');
		$this->load->view('user/all_user',$this->body_Data);
		$this->load->view('footer');
	}
	public function add(){
		$lang = $this->session->userdata('lang');
		if($lang=="persion"){
			$this->body_Data['lang']['title'] = "اضافه کردن کاربر";
		}else{
			$this->body_Data['lang']['title'] = "Add User";
		}	
		
		/*
			Form Validations
		*/
		$this->load->library(array('form_validation'));
		$validations = array();
		$validations[] = array(
					'field' => 'full_name',
					'label' => 'User Full Name',
					'rules' => 'required',
				);
		$validations[] = array(
					'field' => 'email',
					'label' => 'Email address',
					'rules' => 'required|valid_email|callback_email_check',
				);
		$validations[] = array(
					'field' => 'user_name',
					'label' => 'User Name',
					'rules' => 'required|callback_user_name_check',
				);
		$validations[] = array(
					'field' => 'password',
					'label' => 'Password',
					'rules' => 'required',
				);
		$validations[] = array(
					'field' => 'password_confirm',
					'label' => 'Confirm Password',
					'rules' => 'required|matches[password]',
				);
		$validations[] = array(
					'field' => 'role',
					'label' => 'User Role',
					'rules' => 'required',
				);
		$validations[] = array(
					'field' => 'picture',
					'label' => 'Picture',
					'rules' => 'required',
				);
		$this->form_validation->set_rules($validations);
		$this->form_validation->set_error_delimiters('<p class="text-red">','</p>');
		if($this->form_validation->run()){
			$newDataField = array('full_name','user_name','email','role','password','picture');
			$newData = array();
			foreach ($newDataField as $key => $value) {
				$newData[$value] = $this->input->post($value);
			}
			$newData['password'] = md5($this->input->post('password'));
			$this->User_model->add($newData);
			$this->body_Data['message'] = "A User has been added.";
		}
		$this->load->view('header');
		$this->load->view('forms',$this->body_Data);
		$this->load->view('footer');
	}

	public function update($id = null){
		$lang = $this->session->userdata('lang');
		if($lang=="persion"){
			$this->body_Data['lang']['title'] = "ایدیت کردن کاربر";
		}else{
			$this->body_Data['lang']['title'] = "Edit User";
		}	
		if(is_null($id))
			return;
			
		unset($this->body_Data['inputs']['user_name']);
		
		/*
			Form Validations
		*/
		$this->load->library(array('form_validation'));
		$validations = array();
		$validations[] = array(
					'field' => 'full_name',
					'label' => 'User Full Name',
					'rules' => 'required',
				);
		$validations[] = array(
					'field' => 'email',
					'label' => 'Email address',
					'rules' => 'required|valid_email',
				);
		$validations[] = array(
					'field' => 'password',
					'label' => 'Password',
					'rules' => 'required',
				);
		$validations[] = array(
					'field' => 'password_confirm',
					'label' => 'Confirm Password',
					'rules' => 'required|matches[password]',
				);
		$validations[] = array(
					'field' => 'role',
					'label' => 'User Role',
					'rules' => 'required',
				);
		$validations[] = array(
					'field' => 'picture',
					'label' => 'Picture',
					'rules' => 'required',
				);
		$this->form_validation->set_rules($validations);
		if($this->form_validation->run()){
			$newData = array();
			$newData["full_name"] = $this->input->post("full_name");
			$newData["email"] = $this->input->post("email");
			$newData["password"] = md5($this->input->post("password"));
			$newData["role"] = $this->input->post("role");
			$newData["picture"] = $this->input->post("picture");
			$this->User_model->update(array("id" => $id), $newData);

			$this->body_Data['message'] = "A User has been updated.";
		}

		$userCurrent = $this->User_model->get(array("id" => $id));
		$this->body_Data['inputs']['full_name']['fn_arg']['value'] = $userCurrent[0]->full_name; 
		$this->body_Data['inputs']['email']['fn_arg']['value'] = $userCurrent[0]->email; 
		$this->body_Data['inputs']['role']['fn_arg']['value'] = $userCurrent[0]->role; 
		$this->body_Data['inputs']['picture']['fn_arg']['value'] = $userCurrent[0]->picture; 

		$this->load->view('header');
		$this->load->view('forms',$this->body_Data);
		$this->load->view('footer');
	}
	public function logout(){
		$userData = array('is_login','login_user');
		$this->session->unset_userdata($userData);
		$this->session->sess_destroy();
		redirect('login');
	}
	/*
		Delete a user
	*/
	public function delete($id = null){
		if(is_null($id))
			return;
		$this->User_model->delete(array('id'=>$id));
		$this->index();
	}
	public function user_name_check($str){
		return $this->check_field_exist('user_name',$str,'User Name Exist.');
	}
	public function email_check($str){
		return $this->check_field_exist('email',$str,'Email Name Exist');
	}
	private function check_field_exist($field,$str,$message){
		$esixt = $this->User_model->is_exist(array($field=>$str));
		if ($esixt){
			$this->form_validation->set_message($field.'_check', $message);
			return FALSE;
		}
		else{
		return TRUE;
		}
	}
}
