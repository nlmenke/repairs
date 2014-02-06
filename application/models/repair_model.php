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
		$this->db->order_by('last_called_date', 'ASC');
		$this->db->order_by('last_test_date', 'ASC');
		$this->db->order_by('repair_date', 'ASC');
		$this->db->order_by('drop_off_date', 'ASC');
		
		$query = $this->db->get('repairs');
		return $query->result();
	}
	
	function get_archives($num, $offset) {
		$this->db->limit($num, ($offset-1)*$num);
		$this->db->order_by('pick_up_date', 'ASC');
		$this->db->order_by('last_called_date', 'ASC');
		$this->db->order_by('last_test_date', 'ASC');
		$this->db->order_by('repair_date', 'ASC');
		$this->db->order_by('drop_off_date', 'ASC');
		
		$query = $this->db->get('repairs');
		return $query->result();
	}
	
	function get_in_house() {
		$this->db->where('pick_up_date', NULL);
		$this->db->order_by('last_called_date', 'ASC');
		$this->db->order_by('last_test_date', 'ASC');
		$this->db->order_by('repair_date', 'ASC');
		$this->db->order_by('drop_off_date', 'ASC');
		
		$query = $this->db->get('repairs');
		return $query->result();
	}
	
	function get_type($type) {
		$this->db->where($type, 1);
		
		$query = $this->db->get('repairs');
		return $query->result();
	}
	
	function get_info($ticket_id) {
		$this->db->from('repairs');
		$this->db->where('ticket_id', $ticket_id);
		return $this->db->get();
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
		$this->db->order_by('last_called_date', 'ASC');
		$this->db->order_by('last_test_date', 'ASC');
		$this->db->order_by('repair_date', 'ASC');
		$this->db->order_by('drop_off_date', 'ASC');
		
		$query = $this->db->get('repairs');
		return $query->result();
	}
	
	function get_customer_repairs($customer_email, $repair_type) {
		$this->db->where('email_address', $customer_email);
		$this->db->where('repair_type', $repair_type);
		$this->db->order_by('pick_up_date', 'ASC');
		$this->db->order_by('last_called_date', 'ASC');
		$this->db->order_by('last_test_date', 'ASC');
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
	
	/*
	 * Performs search.
	 */
	function search($search, $limit = 50, $offset) {
		$search_terms_array = explode(' ', $this->db->escape_like_str($search));
		
		// to keep track of which search term of the array we're looking at now
		$search_name_criteria_counter = 0;
		$sql_search_name_criteria = '';
		// loop through array of search terms
		foreach($search_terms_array as $x) {
			$sql_search_name_criteria .= ($search_name_criteria_counter > 0 ? ' AND ' : '').'customer_first LIKE "%'.$this->db->escape_like_str($x).'%"';
			
			$search_name_criteria_counter++;
		}
		
		$this->db->where('(('.$sql_search_name_criteria.') or
		customer_last LIKE "%'.$this->db->escape_like_str($search).'%" or
		phone_number LIKE "%'.$this->db->escape_like_str($search).'%" or
		serial_number LIKE "%'.$this->db->escape_like_str($search).'%" or
		new_serial LIKE "%'.$this->db->escape_like_str($search).'%" or
		item LIKE "%'.$this->db->escape_like_str($search).'%" or
		problem LIKE "%'.$this->db->escape_like_str($search).'%")');
		$this->db->order_by('pick_up_date', 'ASC');
		$this->db->order_by('last_called_date', 'ASC');
		$this->db->order_by('last_test_date', 'ASC');
		$this->db->order_by('repair_date', 'ASC');
		$this->db->order_by('drop_off_date', 'ASC');
		$this->db->limit($limit, ($offset-1)*$limit);
		
		$query = $this->db->get('repairs');
		return $query->result();
	}
	
	function search_count($search) {
		$this->db->where('(customer_first LIKE "%'.$this->db->escape_like_str($search).'%" or
		customer_last LIKE "%'.$this->db->escape_like_str($search).'%" or
		phone_number LIKE "%'.$this->db->escape_like_str($search).'%" or
		serial_number LIKE "%'.$this->db->escape_like_str($search).'%" or
		new_serial LIKE "%'.$this->db->escape_like_str($search).'%" or
		item LIKE "%'.$this->db->escape_like_str($search).'%" or
		problem LIKE "%'.$this->db->escape_like_str($search).'%")');
		
		$result = $this->db->get('repairs');
		return $result->num_rows();
	}
}

/* End of file repair_model.php */
/* Location: ./application/models/repair_model.php */