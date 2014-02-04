<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
/*
| Name:			Repairs
| Category:		Core / Controllers
| Author:		N.L.Menke
| 				nick.m@gamersorlando.com
| 				@NLMenke
| Location:		https://github.com/nlmenke/repairs/
| Created:		08/26/2012
| Description:	Keeps track of all system warranty information.
*/

class Repairs extends CI_Controller {
	
	function __construct() {
		parent::__construct();
	}
	
	// -------------------------------------------------------------------
	
	/**
	 * If user is an Admin or Emplyee:
	 * Full list of all consoles taken in for repair and the information
	 * needed to ensure the owner gets the correct system returned to
	 * them.
	 * 
	 * If user is the owner of the console:
	 * Full list of all consoles brought in for repair - owned by
	 * customer.
	 */
	function index() {
		if($this->ion_auth->logged_in()) {
			// user is logged in
			$user = $this->ion_auth->get_user_array();
			$data['user'] = $user;
			
			if($this->ion_auth->is_admin() || $this->ion_auth->is_group('employee')) {
				// user is an admin or employee
				$data['results'] = $this->repair_model->get_all();
				$data['total'] = count($this->repair_model->get_all());
				$data['in_house'] = count($this->repair_model->get_in_house());
				$data['refixes'] = $this->repair_model->get_refix_count();
				$data['unrepairable'] = $this->repair_model->get_unrepairable_count();
				
				$data['page_title'] = 'System Warranty List';
				$data['body_id'] = 'warranty-list';
				$data['content'] = 'warranty_list';
				$this->load->view('template', $data);
			} else {
				// user is not an admin or employee
				$repair_type = array(
					'console',
					'handheld',
					'computer',
					'controller',
					'disc',
					'modification'
				);
				foreach($repair_type as $type) {
					$repairs[$type] = $this->repair_model->get_customer_repairs($user['email'], $type);
				}
				$data['repair_type'] = $repair_type;
				$data['repairs'] = $repairs;
				
				$data['page_title'] = 'Customer Warranties';
				$data['body_id'] = 'warranty-customer';
				$data['content'] = 'warranty_customer';
				$this->load->view('template', $data);
			}
		} else { // user is not logged in
			redirect('auth/login');
		}
	}
	
	// -------------------------------------------------------------------
	
	/**
	 * View systems currently in the store.
	 */
	function in_house() {
		if($this->ion_auth->logged_in()) {
			// user is logged in
			$user = $this->ion_auth->get_user_array();
			$data['user'] = $user;
			
			if($this->ion_auth->is_admin() || $this->ion_auth->is_group('employee')) {
				// user is an admin or employee
				$data['results'] = $this->repair_model->get_in_house();
				$data['total'] = count($this->repair_model->get_all());
				$data['in_house'] = count($this->repair_model->get_in_house());
				$data['refixes'] = $this->repair_model->get_refix_count();
				$data['unrepairable'] = $this->repair_model->get_unrepairable_count();
				
				$data['page_title'] = 'Systems In-House';
				$data['body_id'] = 'warranty-list';
				$data['content'] = 'warranty_list';
				$this->load->view('template', $data);
			} else {
				// user is not an admin or employee
				redirect('auth/login');
			}
		} else {
			// user is not logged in
			redirect('auth/login');
		}
	}
	
	// -------------------------------------------------------------------
	
	/**
	 * View systems that have been picked up and are still under warranty.
	 */
	function under_warranty() {
		if($this->ion_auth->logged_in()) {
			// user is logged in
			$user = $this->ion_auth->get_user_array();
			$data['user'] = $user;
			
			if($this->ion_auth->is_admin() || $this->ion_auth->is_group('employee')) {
				// user is an admin or employee
				$data['results'] = $this->repair_model->get_under_warranty();
				$data['total'] = count($this->repair_model->get_all());
				$data['in_house'] = count($this->repair_model->get_in_house());
				$data['refixes'] = $this->repair_model->get_refix_count();
				$data['unrepairable'] = $this->repair_model->get_unrepairable_count();
				
				$data['page_title'] = 'Systems Under Warranty';
				$data['body_id'] = 'warranty-list';
				$data['content'] = 'warranty_list';
				$this->load->view('template', $data);
			} else {
				// user is not an admin or employee
				redirect('auth/login');
			}
		} else {
			// user is not logged in
			redirect('auth/login');
		}
	}
	
	// -------------------------------------------------------------------
	
	/**
	 * View systems that have ben picked up and the warranty has expired.
	 */
	function expired() {
		if($this->ion_auth->logged_in()) {
			// user is logged in
			$user = $this->ion_auth->get_user_array();
			$data['user'] = $user;
			
			if($this->ion_auth->is_admin() || $this->ion_auth->is_group('employee')) {
				// user is an admin or employee
				$data['results'] = $this->repair_model->get_expired();
				$data['total'] = count($this->repair_model->get_all());
				$data['in_house'] = count($this->repair_model->get_in_house());
				$data['refixes'] = $this->repair_model->get_refix_count();
				$data['unrepairable'] = $this->repair_model->get_unrepairable_count();
				
				$data['page_title'] = 'Expired Warranties';
				$data['body_id'] = 'warranty-list';
				$data['content'] = 'warranty_list';
				$this->load->view('template', $data);
			} else {
				// user is not an admin or employee
				redirect('auth/login');
			}
		} else {
			// user is not logged in
			redirect('auth/login');
		}
	}
	
	// -------------------------------------------------------------------
	
	/**
	 * View a repair in the system to add/edit the information.
	 */
	function view($ticket_id = -1) {
		if($this->ion_auth->logged_in()) {
			// user is logged in
			$user = $this->ion_auth->get_user_array();
			$data['user'] = $user;
			
			if($this->ion_auth->is_admin() || $this->ion_auth->is_group('employee')) {
				// user is an admin or employee
				$repair_info = $this->repair_model->get_item($ticket_id);
				$data['ticket_id'] = $ticket_id;
				$data['repair_info'] = $repair_info;
				$data['repair_type'] = array(
					'console',
					'handheld',
					'computer',
					'controller',
					'disc',
					'modification'
				);
				
				$data['page_title'] = ($ticket_id != -1) ? $repair_info->customer_first.' '.$repair_info->customer_last.'\'s '.ucfirst($repair_info->repair_type).' Repair' : 'New Repair';
				$data['extra_head'] = 'warranty_form_head';
				$data['script'] = 'warranty_form_script';
				$data['body_id'] = 'warranty-form';
				$data['content'] = 'warranty_form';
				$this->load->view('template', $data);
			} else {
				// user is not an admin or employee
				redirect('repairs');
			}
		} else {
			// user is not logged in
			redirect('auth/login');
		}
	}
	
	// -------------------------------------------------------------------
	
	/**
	 * Updates repair information or creates a new entry.
	 * 
	 * This page redirects to a list of all repairs.
	 */
	function save($ticket_id = -1) {
		if($this->ion_auth->logged_in()) {
			// user is logged in
			$user = $this->ion_auth->get_user_array();
			$data['user'] = $user;
			
			if($this->ion_auth->is_admin() || $this->ion_auth->is_group('employee')) {
				// user is an admin or employee
				$data['results'] = $this->repair_model->get_all();
				$row = $this->repair_model->load($ticket_id)->row();
				
				$this->form_validation->set_rules('customer_first', 'First Name', 'required');
				$this->form_validation->set_rules('customer_last', 'Last Name', 'required');
				$this->form_validation->set_rules('phone_number', 'Phone Number', 'required');
				$this->form_validation->set_rules('email_address', 'Email Address', 'required|valid_email');
				$this->form_validation->set_rules('system', 'System', 'required');
				$this->form_validation->set_rules('repair_type', 'Repair Type', 'required');
				
				if($ticket_id == -1) {
					$repair_data = array(
						'warranty_number'	=> $this->input->post('warranty_number') != 0 ? $this->input->post('warranty_number') : NULL,
						'customer_first'	=> ucfirst($this->input->post('customer_first')),
						'customer_last'		=> ucfirst($this->input->post('customer_last')),
						'phone_number'		=> strip_phone($this->input->post('phone_number')),
						'email_address'		=> strtolower($this->input->post('email_address')),
						'system'			=> strtoupper($this->input->post('system')),
						'repair_type'		=> $this->input->post('repair_type'),
						'serial_number'		=> strtoupper($this->input->post('serial_number')),
						'problem'			=> strtoupper($this->input->post('problem')),
						'refix'				=> $this->input->post('refix'),
						'cnbf'				=> $this->input->post('cnbf'),
						'price'				=> is_numeric($this->input->post('price')) ? to_currency_no_money($this->input->post('price')) : $this->input->post('price'),
						'confirmed'			=> $this->input->post('confirmed'),
						'drop_off_employee'	=> $this->input->post('drop_off_employee') ? $this->input->post('drop_off_employee') : $user['first_name'],
						'drop_off_date'		=> $this->input->post('drop_off_date') ? date('Y-m-d', strtotime($this->input->post('drop_off_date'))).' '.date('H:i:s') : date('Y-m-d H:i:s'),
						'repair_employee'	=> $this->input->post('repair_employee') ? $this->input->post('repair_employee') : NULL,
						'repair_date'		=> $this->input->post('repair_date') ? date('Y-m-d', strtotime($this->input->post('repair_date'))) : NULL,
						'test_1_date'		=> $this->input->post('test_1_date') ? date('Y-m-d', strtotime($this->input->post('test_1_date'))) : NULL,
						'test_2_date'		=> $this->input->post('test_2_date') ? date('Y-m-d', strtotime($this->input->post('test_2_date'))) : NULL,
						'called_1_date'		=> $this->input->post('called_1_date') ? date('Y-m-d', strtotime($this->input->post('called_1_date'))) : NULL,
						'called_2_date'		=> $this->input->post('called_2_date') ? date('Y-m-d', strtotime($this->input->post('called_2_date'))) : NULL,
						'called_3_date'		=> $this->input->post('called_3_date') ? date('Y-m-d', strtotime($this->input->post('called_3_date'))) : NULL,
						'pick_up_employee'	=> $this->input->post('pick_up_employee') ? $this->input->post('pick_up_employee') : NULL,
						'pick_up_date'		=> $this->input->post('pick_up_date') ? date('Y-m-d', strtotime($this->input->post('pick_up_date'))) : NULL,
						'expire'			=> $this->input->post('expire') ? date('Y-m-d', strtotime($this->input->post('pick_up_date').'+1 month')) : NULL,
						'notes'				=> $this->input->post('notes') ? $this->input->post('notes') : NULL
					);
				} elseif($this->input->post('repair_employee') != '') {
					$repair_data = array(
						'warranty_number'	=> $this->input->post('warranty_number') != 0 ? $this->input->post('warranty_number') : NULL,
						'customer_first'	=> $this->input->post('customer_first'),
						'customer_last'		=> $this->input->post('customer_last'),
						'phone_number'		=> strip_phone($this->input->post('phone_number')),
						'email_address'		=> strtolower($this->input->post('email_address')),
						'system'			=> strtoupper($this->input->post('system')),
						'repair_type'		=> $this->input->post('repair_type'),
						'serial_number'		=> strtoupper($this->input->post('serial_number')),
						'problem'			=> strtoupper($this->input->post('problem')),
						'refix'				=> $this->input->post('refix'),
						'cnbf'				=> $this->input->post('cnbf'),
						'price'				=> is_numeric($this->input->post('price')) ? to_currency_no_money($this->input->post('price')) : $this->input->post('price'),
						'confirmed'			=> $this->input->post('confirmed'),
						'drop_off_employee'	=> $this->input->post('drop_off_employee'),
						'drop_off_date'		=> date('Y-m-d H:i:s', strtotime($this->input->post('drop_off_date'))),
						'repair_employee'	=> $this->input->post('repair_employee'),
						'repair_date'		=> $this->input->post('repair_date') ? date('Y-m-d', strtotime($this->input->post('repair_date'))) : date('Y-m-d'),
						'test_1_date'		=> $this->input->post('test_1_date') ? date('Y-m-d', strtotime($this->input->post('test_1_date'))) : NULL,
						'test_2_date'		=> $this->input->post('test_2_date') ? date('Y-m-d', strtotime($this->input->post('test_2_date'))) : NULL,
						'called_1_date'		=> $this->input->post('called_1_date') ? date('Y-m-d', strtotime($this->input->post('called_1_date'))) : NULL,
						'called_2_date'		=> $this->input->post('called_2_date') ? date('Y-m-d', strtotime($this->input->post('called_2_date'))) : NULL,
						'called_3_date'		=> $this->input->post('called_3_date') ? date('Y-m-d', strtotime($this->input->post('called_3_date'))) : NULL,
						'pick_up_employee'	=> $this->input->post('pick_up_employee') ? $this->input->post('pick_up_employee') : NULL,
						'pick_up_date'		=> $this->input->post('pick_up_date') ? date('Y-m-d', strtotime($this->input->post('pick_up_date'))) : NULL,
						'expire'			=> $this->input->post('pick_up_date') ? date('Y-m-d', strtotime($this->input->post('pick_up_date').'+1 month')) : NULL,
						'notes'				=> $this->input->post('notes') ? $this->input->post('notes') : NULL
					);
				} elseif($this->input->post('pick_up_employee') != '') {
					$repair_data = array(
						'warranty_number'	=> $this->input->post('warranty_number') != 0 ? $this->input->post('warranty_number') : NULL,
						'customer_first'	=> $this->input->post('customer_first'),
						'customer_last'		=> $this->input->post('customer_last'),
						'phone_number'		=> strip_phone($this->input->post('phone_number')),
						'email_address'		=> strtolower($this->input->post('email_address')),
						'system'			=> strtoupper($this->input->post('system')),
						'repair_type'		=> $this->input->post('repair_type'),
						'serial_number'		=> strtoupper($this->input->post('serial_number')),
						'problem'			=> strtoupper($this->input->post('problem')),
						'refix'				=> $this->input->post('refix'),
						'cnbf'				=> $this->input->post('cnbf'),
						'price'				=> is_numeric($this->input->post('price')) ? to_currency_no_money($this->input->post('price')) : $this->input->post('price'),
						'confirmed'			=> $this->input->post('confirmed'),
						'drop_off_employee'	=> $this->input->post('drop_off_employee'),
						'drop_off_date'		=> date('Y-m-d H:i:s', strtotime($this->input->post('drop_off_date'))),
						'repair_employee'	=> $this->input->post('repair_employee'),
						'repair_date'		=> date('Y-m-d', strtotime($this->input->post('repair_date'))),
						'test_1_date'		=> $this->input->post('test_1_date') ? date('Y-m-d', strtotime($this->input->post('test_1_date'))) : NULL,
						'test_2_date'		=> $this->input->post('test_2_date') ? date('Y-m-d', strtotime($this->input->post('test_2_date'))) : NULL,
						'called_1_date'		=> $this->input->post('called_1_date') ? date('Y-m-d', strtotime($this->input->post('called_1_date'))) : NULL,
						'called_2_date'		=> $this->input->post('called_2_date') ? date('Y-m-d', strtotime($this->input->post('called_2_date'))) : NULL,
						'called_3_date'		=> $this->input->post('called_3_date') ? date('Y-m-d', strtotime($this->input->post('called_3_date'))) : NULL,
						'pick_up_employee'	=> $this->input->post('pick_up_employee'),
						'pick_up_date'		=> $this->input->post('pick_up_date') ? date('Y-m-d', strtotime($this->input->post('pick_up_date'))) : date('Y-m-d'),
						'expire'			=> date('Y-m-d', strtotime($this->input->post('pick_up_date').'+1 month')),
						'notes'				=> $this->input->post('notes') ? $this->input->post('notes') : NULL
					);
				} else {
					$repair_data = array(
						'warranty_number'	=> $this->input->post('warranty_number') != 0 ? $this->input->post('warranty_number') : NULL,
						'customer_first'	=> $this->input->post('customer_first'),
						'customer_last'		=> $this->input->post('customer_last'),
						'phone_number'		=> strip_phone($this->input->post('phone_number')),
						'email_address'		=> strtolower($this->input->post('email_address')),
						'system'			=> strtoupper($this->input->post('system')),
						'repair_type'		=> $this->input->post('repair_type'),
						'serial_number'		=> strtoupper($this->input->post('serial_number')),
						'problem'			=> strtoupper($this->input->post('problem')),
						'refix'				=> $this->input->post('refix'),
						'cnbf'				=> $this->input->post('cnbf'),
						'price'				=> is_numeric($this->input->post('price')) ? to_currency_no_money($this->input->post('price')) : $this->input->post('price'),
						'confirmed'			=> $this->input->post('confirmed'),
						'drop_off_employee'	=> $this->input->post('drop_off_employee'),
						'drop_off_date'		=> date('Y-m-d H:i:s', strtotime($this->input->post('drop_off_date'))),
						'repair_employee'	=> $this->input->post('repair_employee') ? $this->input->post('repair_employee') : NULL,
						'repair_date'		=> $this->input->post('repair_date') ? date('Y-m-d', strtotime($this->input->post('repair_date'))) : NULL,
						'test_1_date'		=> $this->input->post('test_1_date') ? date('Y-m-d', strtotime($this->input->post('test_1_date'))) : NULL,
						'test_2_date'		=> $this->input->post('test_2_date') ? date('Y-m-d', strtotime($this->input->post('test_2_date'))) : NULL,
						'called_1_date'		=> $this->input->post('called_1_date') ? date('Y-m-d', strtotime($this->input->post('called_1_date'))) : NULL,
						'called_2_date'		=> $this->input->post('called_2_date') ? date('Y-m-d', strtotime($this->input->post('called_2_date'))) : NULL,
						'called_3_date'		=> $this->input->post('called_3_date') ? date('Y-m-d', strtotime($this->input->post('called_3_date'))) : NULL,
						'pick_up_employee'	=> $this->input->post('pick_up_employee') ? $this->input->post('pick_up_employee') : NULL,
						'pick_up_date'		=> $this->input->post('pick_up_date') ? date('Y-m-d', strtotime($this->input->post('pick_up_date'))) : NULL,
						'expire'			=> $this->input->post('expire') ? date('Y-m-d', strtotime($this->input->post('pick_up_date').'+1 month')) : NULL,
						'notes'				=> $this->input->post('notes') ? $this->input->post('notes') : NULL
					);
				}
				
				if($this->form_validation->run() == TRUE) {
					$this->repair_model->save($repair_data, $ticket_id);
					$username = url_title($this->input->post('customer_first').' '.$this->input->post('customer_last'), '', TRUE);
					$password = strip_phone($this->input->post('phone_number'));
					$email = $this->input->post('email_address');
					$additional_data = array(
						'first_name'	=> ucfirst($this->input->post('customer_first')),
						'last_name'		=> ucfirst($this->input->post('customer_last')),
						'phone'			=> strip_phone($this->input->post('phone_number'))
					);
					$this->ion_auth->register($username, $password, $email, $additional_data);
					if($ticket_id == -1) {
						redirect('repairs/ticket/'.$this->repair_model->next_id());
					} else {
						redirect('repairs');
					}
				} else {
					redirect('repairs/view/'.$ticket_id);
				}
			} else {
				// user is not an admin or employee
				redirect('repairs');
			}
		} else {
			// user is not logged in
			redirect('auth/login');
		}
	}
	
	// -------------------------------------------------------------------
	
	/**
	 * This repair ticket should be printed and given to the owner of the console.
	 */
	function ticket() {
		if($this->ion_auth->logged_in()) {
			// user is logged in
			$user = $this->ion_auth->get_user_array();
			$data['user'] = $user;
			
			if($this->uri->segment(3) == '') {
				redirect('repairs');
			}
			
			$data['row'] = $this->repair_model->load(urldecode($this->uri->segment(3)))->row();
				
			$data['page_title'] = 'Warranty Ticket';
			$data['body_id'] = 'warranty-ticket';
			$data['content'] = 'warranty_ticket';
			$this->load->view('template', $data);
		} else {
			// user is not logged in
			redirect('auth/login');
		}
	}
}

/* End of file repairs.php */
/* Location: ./application/controllers/repairs.php */