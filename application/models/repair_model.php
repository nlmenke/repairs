<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
/*
| Name:			Repairs
| Category:		Models
| Author:		N.L.Menke
| 				nick.m@gamersorlando.com
| 				@NLMenke
| Location:		https://github.com/nlmenke/repairs/
| Created:		08/26/2012
| Description:	Gathers information about repairs from the database.
*/

class Repair_model extends CI_Model {
	
	function __construct() {
		parent::__construct();
	}
	
	function get_all() {
		$this->db->order_by('pick_up_date', 'ASC');
		$this->db->order_by('called_3_date', 'ASC');
		$this->db->order_by('called_2_date', 'ASC');
		$this->db->order_by('called_1_date', 'ASC');
		$this->db->order_by('test_2_date', 'ASC');
		$this->db->order_by('test_1_date', 'ASC');
		$this->db->order_by('repair_date', 'ASC');
		$this->db->order_by('drop_off_date', 'ASC');
		
		$query = $this->db->get('repairs');
		return $query->result();
	}
	
	function get_in_house() {
		$this->db->where('pick_up_date', NULL);
		$this->db->order_by('called_3_date', 'ASC');
		$this->db->order_by('called_2_date', 'ASC');
		$this->db->order_by('called_1_date', 'ASC');
		$this->db->order_by('test_2_date', 'ASC');
		$this->db->order_by('test_1_date', 'ASC');
		$this->db->order_by('repair_date', 'ASC');
		$this->db->order_by('drop_off_date', 'ASC');
		
		$query = $this->db->get('repairs');
		return $query->result();
	}
	
	function get_under_warranty() {
		$this->db->where('expire >', date('Y-m-d'));
		$this->db->order_by('pick_up_date', 'ASC');
		$this->db->order_by('called_3_date', 'ASC');
		$this->db->order_by('called_2_date', 'ASC');
		$this->db->order_by('called_1_date', 'ASC');
		$this->db->order_by('test_2_date', 'ASC');
		$this->db->order_by('test_1_date', 'ASC');
		$this->db->order_by('repair_date', 'ASC');
		$this->db->order_by('drop_off_date', 'ASC');
		
		$query = $this->db->get('repairs');
		return $query->result();
	}
	
	function get_expired() {
		$this->db->where('expire <', date('Y-m-d'));
		$this->db->order_by('pick_up_date', 'ASC');
		$this->db->order_by('called_3_date', 'ASC');
		$this->db->order_by('called_2_date', 'ASC');
		$this->db->order_by('called_1_date', 'ASC');
		$this->db->order_by('test_2_date', 'ASC');
		$this->db->order_by('test_1_date', 'ASC');
		$this->db->order_by('repair_date', 'ASC');
		$this->db->order_by('drop_off_date', 'ASC');
		
		$query = $this->db->get('repairs');
		return $query->result();
	}
	
	function get_refix_count() {
		$this->db->where('refix', 1);
		
		$query = $this->db->get('repairs');
		return count($query->result());
	}
	
	function get_unrepairable_count() {
		$this->db->where('cnbf', 1);
		
		$query = $this->db->get('repairs');
		return count($query->result());
	}
	
	function get_item($ticket_id) {
		$this->db->from('repairs');
		$this->db->where('ticket_id', $ticket_id);
		
		$query = $this->db->get();
		
		if($query->num_rows() == 1) {
			return $query->row();
		} else {
			$item_obj = new stdClass();
			
			$fields = $this->db->list_fields('repairs');
			
			foreach($fields as $field) {
				$item_obj->$field = '';
			}
			
			return $item_obj;
		}
	}
	
	function get_customer_info($customer) {
		$this->db->where('customer_name', $customer);
		$this->db->order_by('pick_up_date', 'ASC');
		$this->db->order_by('called_3_date', 'ASC');
		$this->db->order_by('called_2_date', 'ASC');
		$this->db->order_by('called_1_date', 'ASC');
		$this->db->order_by('test_2_date', 'ASC');
		$this->db->order_by('test_1_date', 'ASC');
		$this->db->order_by('repair_date', 'ASC');
		$this->db->order_by('drop_off_date', 'ASC');
		
		$query = $this->db->get('repairs');
		return $query->result();
	}
	
	function get_customer_repairs($customer_email, $repair_type) {
		$this->db->where('email_address', $customer_email);
		$this->db->where('repair_type', $repair_type);
		$this->db->order_by('pick_up_date', 'ASC');
		$this->db->order_by('called_3_date', 'ASC');
		$this->db->order_by('called_2_date', 'ASC');
		$this->db->order_by('called_1_date', 'ASC');
		$this->db->order_by('test_2_date', 'ASC');
		$this->db->order_by('test_1_date', 'ASC');
		$this->db->order_by('repair_date', 'ASC');
		$this->db->order_by('drop_off_date', 'ASC');
		
		$query = $this->db->get('repairs');
		return $query->result();
	}
	
	function save(&$repair_data, $ticket_id = FALSE) {
		if(!$ticket_id or !$this->exists($ticket_id)) {
			if($this->db->insert('repairs', $repair_data)) {
				$repair_data['ticket_id'] = $this->db->insert_id();
				return TRUE;
			}
			return FALSE;
		}
		
		$this->db->where('ticket_id', $ticket_id);
		return $this->db->update('repairs', $repair_data);
	}
	
	function exists($ticket_id) {
		$this->db->from('repairs');
		$this->db->where('ticket_id', $ticket_id);
		$query = $this->db->get();
		
		return ($query->num_rows() == 1);
	}
	
	function load($id) {
		$this->db->where('ticket_id', $id);
		return $this->db->get('repairs');
	}
	
	function next_id() {
		$this->db->select_max('ticket_id');
		$query = $this->db->get('repairs');
		return $query->row()->ticket_id;
	}
}

/* End of file repair_model.php */
/* Location: ./application/models/repair_model.php */