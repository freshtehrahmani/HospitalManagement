<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Doctors extends CI_Controller {
	private $body_Data;
	function __construct()
	{
		parent::__construct();
		if(!is_login()){
			redirect(base_url('login'));
		}
		only_access(array("doctor","admin"));
		$this->body_Data = array();
		$this->body_Data['title'] = 'Doctors';
		$this->load->model(array('Department_model','Doctor_model'));
		$allDepartments = $this->Department_model->get();
		$departmentArrray = array();
		foreach ($allDepartments as $key => $value) {
			$departmentArrray[$value->id] = $value->name;
		}
		$countries = get_country();
		/*
			Form
		*/
		$lang_post = $this->session->userdata('lang');
        if($lang_post=="persion"){
			$lang['lbl_dc_name'] = "اسم داکتر";
			$lang['lbl_dc_nid'] = "نمبر تذکره";
			$lang['lbl_dc_dp'] = " دیپارتمنت";
			$lang['lbl_dc_bg'] = " گروپ خون";
			$lang['lbl_dc_bdate'] = " تاریخ تولد";
			$lang['lbl_dc_sex'] = " جنسیت";
			$lang['lbl_dc_email'] = " ایمیل";
			$lang['lbl_dc_phone'] = " تماس";
			$lang['lbl_dc_country'] = " کشور";
			$lang['lbl_dc_city'] = " شهر/ناحیه";
			$lang['lbl_dc_address'] = " آدرس";
			$lang['lbl_dc_description'] = " درباره داکتر";
			$lang['lbl_dc_pecture'] = " عکس";
		}else{
			$lang['lbl_dc_name'] = "Doctor Name";
			$lang['lbl_dc_nid'] = "National ID Card Number";
			$lang['lbl_dc_dp'] = "Department ";
			$lang['lbl_dc_bg'] = "Blood Group";
			$lang['lbl_dc_bdate'] = "Date of birth";
			$lang['lbl_dc_sex'] = "Gender";
			$lang['lbl_dc_email'] = "Email";
			$lang['lbl_dc_phone'] = "Phone";
			$lang['lbl_dc_country'] = "Country";
			$lang['lbl_dc_city'] = "District/State";
			$lang['lbl_dc_address'] = "Address";
			$lang['lbl_dc_description'] = "About Doctor";
			$lang['lbl_dc_pecture'] = "Pecture";
			
		}

		$this->body_Data['inputs'] = array();
		$this->body_Data['inputs']['name'] 	=	array(
									'label' => $lang['lbl_dc_name'],
									'id' => 'name',
									'fn_arg' => array(
											'class' => 'form-control',
											'name' => 'name',
											'id' => 'name',
											'value' => set_value('name')
										)
								);
		$this->body_Data['inputs']['nic'] 	=	array(
									'label' => $lang['lbl_dc_nid'],
									'id' => 'nic',
									'fn_arg' => array(
											'class' => 'form-control',
											'name' => 'nic',
											'id' => 'nic',
											'value' => set_value('nic')
										)
								);
		$this->body_Data['inputs']['department'] 	=	array(
									'label' => $lang['lbl_dc_dp'],
									'id' => 'department',
									'fn' => 'form_dropdown',
									'fn_arg' => array(
											'class' => 'form-control',
											'name' => 'department',
											'id' => 'department',
											'options' => $departmentArrray,
											'value' => set_value('department')
										)
								);

		
		$this->body_Data['inputs']['blood_group'] 	=	array(
									'label' => $lang['lbl_dc_bg'],
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
									'label' => $lang['lbl_dc_bdate'],
									'id' => 'birth_date',
									'fn_arg' => array(
											'class' => 'form-control',
											'name' => 'birth_date',
											'id' => 'birth_date',
											'value' => set_value('birth_date')
										)
								);	
		$this->body_Data['inputs']['sex'] 	=	array(
									'label' => $lang['lbl_dc_sex'],
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
									'label' => $lang['lbl_dc_email'],
									'id' => 'email',
									'fn_arg' => array(
											'class' => 'form-control',
											'name' => 'email',
											'id' => 'email',
											'value' => set_value('email')
										)
								);
		$this->body_Data['inputs']['phone'] 	=	array(
									'label' => $lang['lbl_dc_phone'],
									'id' => 'phone',
									'fn_arg' => array(
											'class' => 'form-control',
											'name' => 'phone',
											'id' => 'phone',
											'value' => set_value('phone')
										)
								);
		$this->body_Data['inputs']['country'] 	=	array(
									'label' => $lang['lbl_dc_country'],
									'id' => 'country',
									'fn' => 'form_dropdown',
									'fn_arg' => array(
											'class' => 'form-control rs_country',
											'name' => 'country',
											'id' => 'country',
											'options' => $countries,
											'value' => set_value('country')
										)
								);
		$this->body_Data['inputs']['state'] 	=	array(
									'label' => $lang['lbl_dc_city'],
									'id' => 'state',
									'fn_arg' => array(
											'class' => 'form-control',
											'name' => 'state',
											'id' => 'state',
											'value' => set_value('state')
										)
								);
		$this->body_Data['inputs']['address'] 	=	array(
									'label' => $lang['lbl_dc_address'],
									'id' => 'address',
									'fn_arg' => array(
											'class' => 'form-control',
											'name' => 'address',
											'id' => 'address',
											'value' => set_value('address')
										)
								);
		$this->body_Data['inputs']['about'] 	=	array(
									'label' => $lang['lbl_dc_description'],
									'id' => 'about',
									'fn' => 'form_textarea',
									'fn_arg' => array(
											'class' => 'form-control',
											'name' => 'about',
											'id' => 'about',
											'value' => set_value('about')
										)
								);
		$this->body_Data['inputs']['picture'] 	=	array(
									'label' => $lang['lbl_dc_pecture'],
									'id' => 'picture',
									'media' => true,
									'fn_arg' => array(
											'class' => 'form-control',
											'name' => 'picture',
											'id' => 'picture',
											'value' => set_value('picture')
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
			$this->body_Data['lang']['title'] = " داکتران";
			$this->body_Data['lang']['title_header'] = "همه داکتران";
			$this->body_Data['lang']['th_id'] = "ایدی";
			$this->body_Data['lang']['th_name'] = "اسم ";
			$this->body_Data['lang']['th_department'] = "دیپارتمنت ";
			$this->body_Data['lang']['th_action'] = " اکشن";
			$this->body_Data['lang']['btn_details'] = " جزئیات";
			$this->body_Data['lang']['btn_edit'] = " ایدیت";
			$this->body_Data['lang']['btn_remove'] = " حذف";           
			
        }else{
			$this->body_Data['lang']['title'] = " Doctors";
			$this->body_Data['lang']['title_header'] = "List of All Doctors";
			$this->body_Data['lang']['th_id'] = " ID";
			$this->body_Data['lang']['th_name'] = " Name";
			$this->body_Data['lang']['th_department'] = "Department ";
			$this->body_Data['lang']['th_action'] = "Action";
			$this->body_Data['lang']['btn_details'] = " Details";
			$this->body_Data['lang']['btn_edit'] = " Edit";
			$this->body_Data['lang']['btn_remove'] = " Remove";           
               
        }


		$this->body_Data['all_doctors'] = $this->Doctor_model->get();
		$this->load->view('header');
		$this->load->view('doctors/all_doctors',$this->body_Data);
		$this->load->view('footer');
	}

	public function add(){
		$lang = $this->session->userdata('lang');
		if($lang=="persion"){
			$this->body_Data['lang']['btn_submit'] = "ذخیره";
			$this->body_Data['lang']['btn_reset'] = "ریسیت";
			$this->body_Data['lang']['title'] = "اضافه کردن داکتر";
		}else{
			$this->body_Data['lang']['btn_submit'] = "Submit";
			$this->body_Data['lang']['btn_reset'] = "Reset";
			$this->body_Data['lang']['title'] = "Add Doctor";
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
		$validations[] = array(
					'field' => 'nic',
					'label' => 'National ID Card',
					'rules' => 'required|callback__doctor_check',
				);
		$this->form_validation->set_rules($validations);
		if($this->form_validation->run()){
			$newData = array();
			foreach ($this->input->post() as $key => $value) {
				$newData[$key] = $value;
			}
			$this->Doctor_model->add($newData);
			$this->body_Data['message'] = "A doctor has been added.";
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
			$this->body_Data['lang']['title'] = "ایدیت کردن داکتر";
		}else{
			$this->body_Data['lang']['btn_submit'] = "Submit";
			$this->body_Data['lang']['btn_reset'] = "Reset";
			$this->body_Data['lang']['title'] = "Edit Doctor";
		}	
		if(is_null($id))
			return;
		$this->body_Data['title'] = 'Update Doctor';
		
		/*
			Form Validations
		*/
		$this->load->library(array('form_validation'));
		$this->load->model("Doctor_model");
		$validations = array();
		$validations[] = array(
					'field' => 'name',
					'label' => 'Department Name',
					'rules' => 'required',
				);
		$doctor = $this->Doctor_model->Get(array("id" => $id));

		if(isset($doctor[0]->id)){
			$this->body_Data['inputs']['name']['fn_arg']['value'] 	= $doctor[0]->name;
			$this->body_Data['inputs']['nic']['fn_arg']['value'] 	= $doctor[0]->nic;
			$this->body_Data['inputs']['department']['fn_arg']['value'] 	= $doctor[0]->department;
			$this->body_Data['inputs']['blood_group']['fn_arg']['value'] 	= $doctor[0]->blood_group;
			$this->body_Data['inputs']['birth_date']['fn_arg']['value'] 	= $doctor[0]->birth_date;
			$this->body_Data['inputs']['sex']['fn_arg']['value'] 	= $doctor[0]->sex;
			$this->body_Data['inputs']['email']['fn_arg']['value'] 	= $doctor[0]->email;
			$this->body_Data['inputs']['phone']['fn_arg']['value'] 	= $doctor[0]->phone;
			$this->body_Data['inputs']['country']['fn_arg']['value'] 	= $doctor[0]->country;
			$this->body_Data['inputs']['state']['fn_arg']['value'] 	= $doctor[0]->state;
			$this->body_Data['inputs']['address']['fn_arg']['value'] 	= $doctor[0]->address;
			$this->body_Data['inputs']['about']['fn_arg']['value'] 	= $doctor[0]->about;
			$this->body_Data['inputs']['picture']['fn_arg']['value'] 	= $doctor[0]->picture;
		}
		$this->form_validation->set_rules($validations);
		if($this->form_validation->run()){
			$newData = array();
			$dataNeed = array("name","nic","department","blood_group","birth_date","sex","email","phone","country","state","address","about","picture");
			foreach ($dataNeed as $dataNeedKey => $dataNeedValue) {
				$newData[$dataNeedValue] = $this->input->post($dataNeedValue);
				$this->body_Data['inputs'][$dataNeedValue]['fn_arg']['value'] = $this->input->post($dataNeedValue);
			}
			$this->Doctor_model->Update(array("id" => $id),$newData);
			$this->body_Data['message'] = "A doctor has been updated.";
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
		$this->Doctor_model->delete(array('id'=>$id));
		$this->index();
	}
	/*
		View all details about a department
	*/
	public function about($id = null){
		$lang = $this->session->userdata('lang');
        if($lang=="persion"){
			$this->body_Data['lang']['tb_schedule'] = " تقسیم اوقات";
			$this->body_Data['lang']['tb_profile'] = " پروفایل";
			$this->body_Data['lang']['title_header'] = " همه زمان ها";
			$this->body_Data['lang']['th_day'] = " روز";
			$this->body_Data['lang']['th_time'] = " زمان";
			$this->body_Data['lang']['th_maxp'] = " حد اکثر ملاقات";
			$this->body_Data['lang']['th_fees'] = " فیس";
			$this->body_Data['lang']['th_action'] = " اکشن";
			$this->body_Data['lang']['btn_create_sch'] = "ایجاد تقسیم اوقات ";
			$this->body_Data['lang']['btn_delete'] = " حذف";
			
			$this->body_Data['lang']['lbl_doctor_name'] = "اسم داکتر ";
			$this->body_Data['lang']['lbl_doctor_nid'] = "نمبرتذکره ";
			$this->body_Data['lang']['lbl_doctor_dp'] = " بخش";
			$this->body_Data['lang']['lbl_doctor_bg'] = " گروپ خون";
			$this->body_Data['lang']['lbl_doctor_bdate'] = " تاریخ تولد";
			$this->body_Data['lang']['lbl_doctor_gender'] = " جنسیت";
			$this->body_Data['lang']['lbl_doctor_email'] = " ایمیل";
			$this->body_Data['lang']['lbl_doctor_phone'] = " تماس";
			$this->body_Data['lang']['lbl_doctor_country'] = " کشور";
			$this->body_Data['lang']['lbl_doctor_city'] = " شهر/ناحیه";
			$this->body_Data['lang']['lbl_doctor_address'] = " آدرس";
			
			
        }else{
			$this->body_Data['lang']['tb_schedule'] = " Schedule";
			$this->body_Data['lang']['tb_profile'] = " Profile";
			$this->body_Data['lang']['title_header'] = "All Schedule";
			$this->body_Data['lang']['th_day'] = " day";
			$this->body_Data['lang']['th_time'] = " time";
			$this->body_Data['lang']['th_maxp'] = " Maximum Patients ";
			$this->body_Data['lang']['th_fees'] = " Fees";
			$this->body_Data['lang']['th_action'] = " Action";
			$this->body_Data['lang']['btn_create_sch'] = "Create Schedule ";
			$this->body_Data['lang']['btn_delete'] = " Delete";
			
			$this->body_Data['lang']['lbl_doctor_name'] = "Doctor Name";
			$this->body_Data['lang']['lbl_doctor_nid'] = " National Id Number";
			$this->body_Data['lang']['lbl_doctor_dp'] = " Department";
			$this->body_Data['lang']['lbl_doctor_bg'] = "Glood Group ";
			$this->body_Data['lang']['lbl_doctor_bdate'] = "Birth Day ";
			$this->body_Data['lang']['lbl_doctor_gender'] = " Gender";
			$this->body_Data['lang']['lbl_doctor_email'] = "Email ";
			$this->body_Data['lang']['lbl_doctor_phone'] = "Phone ";
			$this->body_Data['lang']['lbl_doctor_country'] = " Country";
			$this->body_Data['lang']['lbl_doctor_city'] = " Sity/State";
			$this->body_Data['lang']['lbl_doctor_address'] = " Address";
			
		
        }
		if(is_null($id))
			return;
		$this->body_Data['inputs'] = '';
		$this->body_Data['doctor'] = $this->Doctor_model->get(array('id'=>$id));
		$this->body_Data['allSchedule'] = $this->Doctor_model->getSchedule(array("doctor_id" => $id));
		$this->load->view('header');
		$this->load->view('doctors/about',$this->body_Data);
		$this->load->view('footer');
	}
	/*
		Delete a department
	*/
	public function createSchedule($id){
		$lang_post = $this->session->userdata('lang');
		if($lang_post=="persion"){
			$this->body_Data['lang']['btn_submit'] = "ذخیره";
			$this->body_Data['lang']['btn_reset'] = "ریسیت";
			$this->body_Data['lang']['title'] = "اضافه کردن تقسیم اوقات";
			$lang['tf_weekday'] = "روز هفته";
			$lang['tf_str_visit'] = "شروع ملاقات";
			$lang['tf_end_visit'] = "ختم ملاقات";
			$lang['tf_max_visit'] = "حداکثر ملاقات";
			$lang['tf_fees'] = "فیس";
			$lang['tf_comment'] = "کمنت";
		}else{
			$this->body_Data['lang']['btn_submit'] = "Submit";
			$this->body_Data['lang']['btn_reset'] = "Reset";
			$this->body_Data['lang']['title'] = "Add New Schedule";
			$lang['tf_weekday'] = "Day of week ";
			$lang['tf_str_visit'] = "Start Visit Time";
			$lang['tf_end_visit'] = " End Visit Time";
			$lang['tf_max_visit'] = "Max Visit";
			$lang['tf_fees'] = "Visit Fees";
			$lang['tf_comment'] = "Comment";
		}
		$this->body_Data['title'] = 'Create new schedule';
		$this->body_Data['inputs']= array();
		$this->body_Data['inputs']['day_of_week'] 	=	array(
									'label' => $lang['tf_weekday'],
									'id' => 'day_of_week',
									'fn' => 'form_dropdown',
									'fn_arg' => array(
											'class' => 'form-control',
											'name' => 'day_of_week',
											'id' => 'day_of_week',
											'options' => get_days(),
											'value' => set_value('day_of_week')
										)
								);
		$this->body_Data['inputs']['start_time'] 	=	array(
									'label' => $lang['tf_str_visit'],
									'id' => 'start_time',
									'fn_arg' => array(
											'class' => 'form-control',
											'name' => 'start_time',
											'id' => 'start_time',
											'value' => set_value('start_time')
										)
								);
		$this->body_Data['inputs']['end_time'] 	=	array(
									'label' => $lang['tf_end_visit'],
									'id' => 'end_time',
									'fn_arg' => array(
											'class' => 'form-control',
											'name' => 'end_time',
											'id' => 'end_time',
											'value' => set_value('end_time')
										)
								);
		$this->body_Data['inputs']['max_num_of_patients']=	array(
												'label' => $lang['tf_max_visit'],
												'id' => 'max_num_of_patients',
												'fn_arg' => array(
														'class' => 'form-control',
														'name' => 'max_num_of_patients',
														'id' => 'max_num_of_patients',
														'value' => set_value('max_num_of_patients')
													)
											);
		$this->body_Data['inputs']['fees']=	array(
												'label' => $lang['tf_fees'],
												'id' => 'fees',
												'fn_arg' => array(
														'class' => 'form-control',
														'name' => 'fees',
														'id' => 'fees',
														'value' => set_value('fees')
													)
											);
		$this->body_Data['inputs']['comment']=	array(
												'label' => $lang['tf_comment'],
												'id' => 'comment',
												'fn_arg' => array(
														'class' => 'form-control',
														'name' => 'comment',
														'id' => 'comment',
														'value' => set_value('comment')
													)
											);
		if($this->isValidForSchedule()){
			$newData = array();
			$newData['day_of_week'] = $this->input->post("day_of_week");
			$newData['start_time'] = $this->input->post("start_time");
			$newData['end_time'] = $this->input->post("end_time");
			$newData['max_num_of_patients'] = $this->input->post("max_num_of_patients");
			$newData['fees'] = $this->input->post("fees");
			$newData['comment'] = $this->input->post("comment");
			$newData['doctor_id'] = $id;
			$this->Doctor_model->addSchedule($newData);
			$this->body_Data['message'] = "Schedule Added";
			$this->body_Data['type'] = "success";
			redirect(base_url('doctors/about/'.$id));
		}
		$this->load->view('header');
		$this->load->view('forms',$this->body_Data);
		$this->load->view('footer');
	}
	private function isValidForSchedule()
	{
		$this->load->library(array('form_validation'));
		$validationsRules = array();
		$validationsRules[] = array(
						'field'	=> 'day_of_week',
						'label'	=> 'Day Of Week',
						'rules'	=> 'required'
					);
		$validationsRules[] = array(
						'field'	=> 'start_time',
						'label'	=> 'Visiting Time Start',
						'rules'	=> 'required'
					);
		$validationsRules[] = array(
						'field'	=> 'end_time',
						'label'	=> 'Visiting Time End',
						'rules'	=> 'required'
					);
		$validationsRules[] = array(
						'field'	=> 'max_num_of_patients',
						'label'	=> 'Maximum Patients',
						'rules'	=> 'required|integer'
					);
		$validationsRules[] = array(
						'field'	=> 'fees',
						'label'	=> 'Fees',
						'rules'	=> 'required'
					);
		$this->form_validation->set_rules($validationsRules);
		return $this->form_validation->run();
	}
	public function deleteSchedule($doctorId,$scheduleId)
	{
		$this->Doctor_model->deleteSchedule($doctorId,$scheduleId);
		redirect(base_url('doctors/about/'.$doctorId));
	}


	public function _doctor_check($data){
		if ($this->Doctor_model->exist(array('nic'=>$this->input->post('nic'))))
        {
                $this->form_validation->set_message('_doctor_check', 'Doctor Exist');
                return FALSE;
        }
        else
        {
                return TRUE;
        }
	}
}
