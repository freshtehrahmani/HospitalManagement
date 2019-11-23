<?php
/**
* 
*/
class Patient_model extends Hospital_model
{
	private $table;
	function __construct()
	{
		parent::__construct();
		$this->table = 'patient';
		parent::set_table($this->table);
	}
	public function add($data){
		return parent::New_Data($data);
	}
	public function record_count()
    {
        return $this->db->count_all('patient');
    }
	public function Get_pagination($limit, $start){
		$this->db->limit($limit, $start);
		$this->db->select('*');
		return parent::Get_Data();
		return $result;
	}
	public function Get($data = array(),$offset = 0){
		return parent::Get_Data($data);
	}
	public function Update($options=array(),$data = array()){
		return parent::Update_Data($options,$data);
	}
	public function Delete($options=array()){
		return parent::Delete_Data($options);
	}
}