<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Patient extends CI_Controller {
	private $body_Data;
	function __construct()
	{
		parent::__construct();
		if(!is_login()){
			redirect(base_url('login'));
		}
		$this->load->library('pagination');

		only_access(array("doctor","admin","employee"));
		$this->body_Data = array();
		$this->body_Data['title'] = 'Patient';
		$this->load->model(array('Patient_model','Doctor_model','Department_model'));
		$allDoctors = $this->Doctor_model->get();
		$allDepartment = $this->Department_model->get();
		$dbData = array();
		$dbData['doctors'] = array();
		$dbData['department'] = array();
		foreach ($allDoctors as $key => $value) {
			$dbData['doctors'][$value->id] = $value->name;
		}
		foreach ($allDepartment as $key => $value) {
			$dbData['department'][$value->id] = $value->name;
		}
		/*
			Form
		*/
		$lang_post = $this->session->userdata('lang');
        if($lang_post=="persion"){

			$lang['lbl_patient_phone'] = "شماره تماس";
			$lang['lbl_patient_name'] = "اسم";
			$lang['lbl_patient_department'] = "بخش";
			$lang['lbl_patient_bg'] = "گروپ خون";
			$lang['lbl_patient_bdate'] = "تاریخ تولد";
			$lang['lbl_patient_gender'] = "جنسیت";
			$lang['lbl_patient_email'] = "ایمیل";
			$lang['lbl_patient_country'] = " کشور";
			$lang['lbl_patient_city'] = " شهر";
			$lang['lbl_patient_age'] = " عمر";
			$lang['lbl_patient_address'] = " آدرس";
			$lang['lbl_patient_about'] = " درباره";
			$lang['lbl_patient_gname'] = " اسم ولی";
			$lang['lbl_patient_gphone'] = " شماره تماس ولی";
			$lang['lbl_patient_gdetails'] = " جزئیات ولی";
			$lang['lbl_patient_badno'] = " شماره تخت";
			$lang['lbl_patient_referedby'] = " مراجعت به";
			$lang['lbl_patient_admitdate'] = " تاریخ پذیریش";
			$lang['lbl_patient_description'] = " تشریحات";
			
			
        }else{
			$lang['lbl_patient_phone'] = "Phone";
			$lang['lbl_patient_name'] = "Name";
			$lang['lbl_patient_department'] = "Department";
			$lang['lbl_patient_bg'] = "Blood Group";
			$lang['lbl_patient_bdate'] = "Date of birth";
			$lang['lbl_patient_gender'] = " Gender";
			$lang['lbl_patient_email'] = "Email";
			$lang['lbl_patient_country'] = "Country";
			$lang['lbl_patient_city'] = "City";
			$lang['lbl_patient_age'] = "Age";
			$lang['lbl_patient_address'] = "Address";
			$lang['lbl_patient_about'] = "About";
			$lang['lbl_patient_gname'] = "Guaurdian Name";
			$lang['lbl_patient_gphone'] = "Guardian Phone";
			$lang['lbl_patient_gdetails'] = "Goaurdian Details";
			$lang['lbl_patient_badno'] = "Bad No";
			$lang['lbl_patient_referedby'] = "Refered By";
			$lang['lbl_patient_admitdate'] = "Admit Date";
			$lang['lbl_patient_description'] = "Description";
			
			
		
        }
		$this->body_Data['inputs'] = array();
		$this->body_Data['lang'] = $lang;
		$this->body_Data['inputs']['phone'] 	=	array(
									'label' => $lang['lbl_patient_phone'],
									'id' => 'phone',
									'fn_arg' => array(
											'class' => 'form-control',
											'name' => 'phone',
											'id' => 'phone',
											'value' => set_value('phone')
										)
								);
		$this->body_Data['inputs']['name'] 	=	array(
									'label' => $lang['lbl_patient_name'],
									'id' => 'name',
									'fn_arg' => array(
											'class' => 'form-control',
											'name' => 'name',
											'id' => 'name',
											'value' => set_value('name')
										)
								);

		$this->body_Data['inputs']['department'] 	=	array(
									'label' => $lang['lbl_patient_department'],
									'id' => 'department',
									'fn' => 'form_dropdown',
									'fn_arg' => array(
											'class' => 'form-control',
											'name' => 'department',
											'id' => 'department',
											'options' => $dbData['department'],
											'value' => set_value('department')
										)
								);

		
		$this->body_Data['inputs']['blood_group'] 	=	array(
									'label' => $lang['lbl_patient_bg'],
									'id' => 'blood_group',
									'fn' => 'form_dropdown',
									'fn_arg' => array(
											'class' => 'form-control',
											'name' => 'blood_group',
											'id' => 'blood_group',
											'options' => array('A+','B-','O+','O-','AB+','AB-'),
											'value' => set_value('blood_group')
										)
								);
		$this->body_Data['inputs']['birth_date'] 	=	array(
									'label' => $lang['lbl_patient_bdate'],
									'id' => 'birth_date',
									'fn_arg' => array(
											'class' => 'form-control',
											'name' => 'birth_date',
											'id' => 'birth_date',
											'value' => set_value('birth_date')
										)
								);
		$this->body_Data['inputs']['age'] 	=	array(
									'label' => $lang['lbl_patient_age'],
									'id' => 'age',
									'fn_arg' => array(
											'class' => 'form-control',
											'name' => 'age',
											'id' => 'age',
											'value' => set_value('age')
										)
								);	
		$this->body_Data['inputs']['sex'] 	=	array(
									'label' => $lang['lbl_patient_gender'],
									'id' => 'sex',
									'fn' => 'form_dropdown',
									'fn_arg' => array(
											'class' => 'form-control',
											'id' => 'sex',
											'name' => 'sex',
											'options' => array('Male','Female'),
											'value' => set_value('sex')
										)
								);
		$this->body_Data['inputs']['email'] 	=	array(
									'label' => $lang['lbl_patient_email'],
									'id' => 'email',
									'fn_arg' => array(
											'class' => 'form-control',
											'name' => 'email',
											'id' => 'email',
											'value' => set_value('email')
										)
								);
		
		$this->body_Data['inputs']['county'] 	=	array(
									'label' => $lang['lbl_patient_country'],
									'id' => 'county',
									'fn' => 'form_dropdown',
									'fn_arg' => array(
											'class' => 'form-control',
											'name' => 'county',
											'id' => 'county',
											'options' => get_country(),
											'value' => set_value('county')
										)
								);
		$this->body_Data['inputs']['city'] 	=	array(
									'label' => $lang['lbl_patient_city'],
									'id' => 'city',
									'fn_arg' => array(
											'class' => 'form-control',
											'name' => 'city',
											'id' => 'city',
											'value' => set_value('city')
										)
								);
		$this->body_Data['inputs']['address'] 	=	array(
									'label' => $lang['lbl_patient_address'],
									'id' => 'address',
									'fn_arg' => array(
											'class' => 'form-control',
											'name' => 'address',
											'id' => 'address',
											'value' => set_value('address')
										)
								);
		$this->body_Data['inputs']['about'] 	=	array(
									'label' => $lang['lbl_patient_about'],
									'id' => 'about',
									'fn' => 'form_textarea',
									'fn_arg' => array(
											'class' => 'form-control',
											'name' => 'about',
											'id' => 'about',
											'value' => set_value('about')
										)
								);
		$this->body_Data['inputs']['guardian_name'] 	=	array(
									'label' => $lang['lbl_patient_gname'],
									'id' => 'guardian_name',
									'fn_arg' => array(
											'class' => 'form-control',
											'name' => 'guardian_name',
											'id' => 'guardian_name',
											'value' => set_value('guardian_name')
										)
								);
		$this->body_Data['inputs']['guardian_phone'] 	=	array(
									'label' => $lang['lbl_patient_gphone'],
									'id' => 'guardian_phone',
									'fn_arg' => array(
											'class' => 'form-control',
											'name' => 'guardian_phone',
											'id' => 'guardian_phone',
											'value' => set_value('guardian_phone')
										)
								);
		$this->body_Data['inputs']['guardian_details'] 	=	array(
									'label' => $lang['lbl_patient_gdetails'],
									'id' => 'guardian_details',
									'fn' => 'form_textarea',
									'fn_arg' => array(
											'class' => 'form-control',
											'name' => 'guardian_details',
											'name' => 'guardian_details',
											'id' => 'guardian_details',
											'id' => 'guardian_details',
											'value' => set_value('guardian_details')
										)
								);
		$this->body_Data['inputs']['bad_no'] 	=	array(
									'label' => $lang['lbl_patient_badno'],
									'id' => 'bad_no',
									'fn_arg' => array(
											'class' => 'form-control',
											'name' => 'bad_no',
											'id' => 'bad_no',
											'value' => set_value('bad_no')
										)
								);
		$this->body_Data['inputs']['referred_by'] 	=	array(
									'label' => $lang['lbl_patient_referedby'],
									'id' => 'referred_by',
									'fn' => 'form_dropdown',
									'fn_arg' => array(
											'class' => 'form-control select2_single',
											'name' => 'referred_by',
											'id' => 'referred_by',
											'options' => $dbData['doctors'],
											'value' => set_value('referred_by')
										)
								);
		$this->body_Data['inputs']['reg_date'] 	=	array(
									'label' => $lang['lbl_patient_admitdate'],
									'id' => 'reg_date',
									'fn_arg' => array(
											'class' => 'form-control',
											'name' => 'reg_date',
											'id' => 'reg_date',
											'value' => set_value('reg_date')
										)
								);
		$this->body_Data['inputs']['descriptions'] 	=	array(
									'label' => $lang['lbl_patient_description'],
									'id' => 'descriptions',
									'fn' => 'form_textarea',
									'fn_arg' => array(
											'class' => 'form-control',
											'name' => 'descriptions',
											'id' => 'descriptions',
											'value' => set_value('descriptions')
										)
								);
	}
	public function index()
	{
		$this->page();
	}
	public function page($page = 1)
	{
		$lang = $this->session->userdata('lang');
        if($lang=="persion"){
		
			$this->body_Data['lang']['title'] = " مریضان";
			$this->body_Data['lang']['title_header'] = " لیست همه مریضان";
			$this->body_Data['lang']['th_name'] = " اسم";
			$this->body_Data['lang']['th_phone'] = " شماره تماس";
			$this->body_Data['lang']['th_description'] = " تشریحات";
			$this->body_Data['lang']['th_action'] = " اکشن";
			$this->body_Data['lang']['btn_details'] = " جزئیات";
			$this->body_Data['lang']['btn_edit'] = " ادیت";
			$this->body_Data['lang']['btn_remove'] = " حذف";
			
        }else{
			$this->body_Data['lang']['title'] = "All Patient";
			$this->body_Data['lang']['title_header'] = "List of All patient";
			$this->body_Data['lang']['th_name'] = " Nmae";
			$this->body_Data['lang']['th_phone'] = " Phone";
			$this->body_Data['lang']['th_description'] = "Description";
			$this->body_Data['lang']['th_action'] = "Action";
			$this->body_Data['lang']['btn_details'] = " Details";
			$this->body_Data['lang']['btn_edit'] = " Edit";
			$this->body_Data['lang']['btn_remove'] = " Delete";			
		
        }
		$offset = ($page*10) - 10;


		  // ----------------------Paginations
		  $config = array();
		  $config["base_url"] = base_url("patient/page");
		  $config['first_url']= base_url() . "patient/page/1";
		  $config["total_rows"] = $this->Patient_model->record_count();
		  $config["per_page"] = 5;
		  $config["uri_segment"] = 3;
  
		  $config['full_tag_open'] = "<ul class='pagination'>";
		  $config['full_tag_close'] = '</ul>';
		  $config['num_tag_open'] = '<li>';
		  $config['num_tag_close'] = '</li>';
		  $config['cur_tag_open'] = '<li class="active"><a href="#">';
		  $config['cur_tag_close'] = '</a></li>';
		  $config['prev_tag_open'] = '<li>';
		  $config['prev_tag_close'] = '</li>';
		  $config['first_tag_open'] = '<li>';
		  $config['first_tag_close'] = '</li>';
		  $config['last_tag_open'] = '<li>';
		  $config['last_tag_close'] = '</li>';
	  
	  
	  
		  $config['prev_link'] = '<i class="fa fa-long-arrow-left"></i>';
		  $config['prev_tag_open'] = '<li>';
		  $config['prev_tag_close'] = '</li>';
	  
	  
		  $config['next_link'] = '<i class="fa fa-long-arrow-right"></i>';
		  $config['next_tag_open'] = '<li>';
		  $config['next_tag_close'] = '</li>';
  
		  $this->pagination->initialize($config);
  
		  $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		  // echo $page;
		  // die;
  
		  // echo $last_seg_no;
		//   $data["patients"] = $this->Patient_model->get($config["per_page"], $page);
		  $this->body_Data['patients'] = $this->Patient_model->get_pagination($config["per_page"], $page);
		  $this->body_Data["links"] = $this->pagination->create_links();
		  // ----------------------

		$this->load->view('header');
		$this->load->view('patient/all_patient',$this->body_Data);
		$this->load->view('footer');
	}
	public function add(){
		$lang = $this->session->userdata('lang');
		if($lang=="persion"){
			$this->body_Data['lang']['btn_submit'] = "ذخیره";
			$this->body_Data['lang']['btn_reset'] = "ریسیت";
			$this->body_Data['lang']['title'] = "اضافه کردن مریض";
		}else{
			$this->body_Data['lang']['btn_submit'] = "Submit";
			$this->body_Data['lang']['btn_reset'] = "Reset";
			$this->body_Data['lang']['title'] = "Add New Patient";
		}
		
		/*
			Form Validations
		*/
		$this->load->library(array('form_validation'));
		$validations = array();
		$validations[] = array(
					'field' => 'name',
					'label' => 'Patient Name',
					'rules' => 'required',
				);
		$this->form_validation->set_rules($validations);
		if($this->form_validation->run()){
			$newData = array();
			foreach ($this->input->post() as $key => $value) {
				$newData[$key] = $value;
			}
			$this->Patient_model->add($newData);
			$this->body_Data['message'] = "A patient has been added.";
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
			$this->body_Data['lang']['title'] = "ایدیت کردن مریض";
		}else{
			$this->body_Data['lang']['btn_submit'] = "Submit";
			$this->body_Data['lang']['btn_reset'] = "Reset";
			$this->body_Data['lang']['title'] = "Edit Patient";
		}
		if(is_null($id))
			return;
		$this->body_Data['title'] = 'Update patient';
		$this->body_Data['patient'] = $this->Patient_model->Get(array("id" => $id));
		$formKey = array('phone','name','department','blood_group','birth_date','age','sex','email','county','city','address','about','guardian_name','guardian_phone','guardian_details','bad_no','referred_by','reg_date','descriptions');
		
		if($this->body_Data['patient']){
			foreach ($formKey as $formKeyKey => $formKeyValue) {
				$this->body_Data['inputs'][$formKeyValue]['fn_arg']['value'] =$this->body_Data['patient'][0]->{$formKeyValue};
			}
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
			$newData = array();
			foreach ($formKey as $formKeyKey => $formKeyValue) {
				$newData[$formKeyValue] =$this->input->post($formKeyValue);
				$this->body_Data['inputs'][$formKeyValue]['fn_arg']['value'] =$this->input->post($formKeyValue);
			}
			$this->Patient_model->update(array("id" => $id),$newData);
			$this->body_Data['message'] = "A patient has been updated.";
		}
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
		$this->Patient_model->delete(array('id'=>$id));
		redirect('patient');
		// $this->index();
	}
	/*
		View all details about a department
	*/
	public function about($id = null){
		if(is_null($id))
			return;
		$this->body_Data['inputs'] = '';
		$this->body_Data['patient'] = $this->Patient_model->get(array('id'=>$id));
		$this->load->view('header');
		$this->load->view('patient/about',$this->body_Data);
		$this->load->view('footer');
	}
}
