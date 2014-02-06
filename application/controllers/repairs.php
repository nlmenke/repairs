<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
/*
| Name:			Repairs
| Category:		Core / Controllers
| Author:		N.L.Menke
| 				nick.m@gamersorlando.com
| 				@NLMenke
| Location:		https://github.com/nlmenke/repairs/
| Created:		08/26/2012
| Description:	Keeps track of items currently in the possession of Gamers
| 				inc. Orlando. Also holds information about the owner of
| 				all these items and whether it is still under warranty.
*/

class Repairs extends Security_Controller {
	
	function __construct() {
		parent::__construct();
		
		$this->load->language('repairs');
	}
	
	// -------------------------------------------------------------------
	
	/*
	 * If Admin or Emplyee:
	 * Full list of all items taken in for repair and the information
	 * needed to ensure the owner gets their correct item returned to
	 * them.
	 * 
	 * If item owner:
	 * Full list of all items owned by person brought in for repair.
	 */
	function index() {
		if($this->ion_auth->is_admin() || $this->ion_auth->in_group('employee')) {
			// user is admin or employee
			redirect('repairs/archive');
		} else {
			// user is not admin or employee
			$repair_type = array(
				'computer',
				'console',
				'controller',
				'game',
				'handheld',
				'modification',
				'phone',
				'other'
			);
			foreach($repair_type as $type) {
				$repairs[$type] = $this->repair_model->get_customer_repairs($this->ion_auth->user()->row()->email, $type);
			}
			$data['repair_type'] = $repair_type;
			$data['repairs'] = $repairs;
			
			$data['page_title'] = 'Customer Repairs';
			$data['body_id'] = 'repair-customer';
			$data['content'] = 'repairs/customer';
			$this->load->view('template', $data);
		}
	}
	
	// -------------------------------------------------------------------
	
	/**
	 * /repairs/archive/
	 */
	function archive() {
		if($this->ion_auth->is_admin() || $this->ion_auth->in_group('employee')) {
			// user is admin or employee
			$data['total'] = count($this->repair_model->get_all());
			$data['in_house'] = count($this->repair_model->get_in_house());
			$data['refixes'] = count($this->repair_model->get_type('refix'));
			$data['unrepairable'] = count($this->repair_model->get_type('cnbf'));
			$data['replaced'] = count($this->repair_model->get_type('replaced'));
			
			// pagination
			$this->load->library('pagination');
			$config['base_url'] = base_url().'repairs/archive';
			$config['total_rows'] = $this->db->get('repairs')->num_rows();
			$config['per_page'] = 50;
			$config['uri_segment'] = 3;
			$config['use_page_numbers'] = TRUE;
			$this->pagination->initialize($config);
			
			$data['results'] = $this->repair_model->get_archives($config['per_page'], $this->uri->segment(3, 1));
			
			// view
			$data['page_title'] = 'Repair List';
			$data['body_id'] = 'repair-list';
			$data['content'] = 'repairs/list';
			$this->load->view('template', $data);
		} else {
			// user is not admin or employee
			redirect('repairs');
		}
	}
	
	// -------------------------------------------------------------------
	
	/*
	 * Search for a repair.
	 */
	function search() {
		if($this->ion_auth->is_admin() || $this->ion_auth->in_group('employee')) {
			// user is admin or employee
			$search = $this->input->post('search');
			
			$data['search_total'] = $this->repair_model->search_count($search);
			
			$this->load->library('pagination');
			$config['base_url'] = base_url().'repairs/search';
			$config['total_rows'] = $data['search_total'];
			$config['per_page'] = 50;
			$config['uri_segment'] = 3;
			$config['use_page_numbers'] = TRUE;
			$this->pagination->initialize($config);
			
			$data['results'] = $this->repair_model->search($search, $config['per_page'], $this->uri->segment(3, 1));
			
			// view
			$data['page_title'] = 'Repair List';
			$data['body_id'] = 'repair-list';
			$data['content'] = 'repairs/list';
			$this->load->view('template', $data);
		} else {
			// user is not admin or employee
			redirect('repairs');
		}
	}
	
	// -------------------------------------------------------------------
	
	/*
	 * Edit information about a repair in the system.
	 */
	function edit($ticket_id = -1) {
		if($this->ion_auth->is_admin() || $this->ion_auth->in_group('employee')) {
			// user is admin or employee
			$repair_info = $this->repair_model->get_item($ticket_id);
			$data['ticket_id'] = $ticket_id;
			$data['repair_info'] = $repair_info;
			$data['repair_type'] = array(
				'computer'		=> 'Computer',
				'console'		=> 'Console',
				'controller'	=> 'Controller',
				'game'			=> 'Disc / Cartridge',
				'handheld'		=> 'Handheld',
				'modification'	=> 'Modification',
				'phone'			=> 'Phone / Tablet',
				'other'			=> 'Other'
			);
			$data['employees'] = array('' => '----');
			foreach($this->ion_auth->users(array('1', '2'))->result() as $employee) {
				$data['employees'][$employee->first_name] = $employee->first_name;
			}
			$data['repair_employee'] = $this->repair_model->get_info($ticket_id)->row_array();
			$data['warranty_type'] = array(
				''			=> '----',
				'1 month'	=> '30 Days',
				'2 months'	=> '60 Days',
				'3 months'	=> '90 Days',
			);
			
			$data['form'] = TRUE;
			$data['page_title'] = ($ticket_id != -1) ? $repair_info->customer_first.' '.$repair_info->customer_last.'\'s '.ucfirst($repair_info->repair_type).' Repair' : 'New Repair';
			$data['body_id'] = 'repair-form';
			$data['content'] = 'repairs/form';
			$this->load->view('template', $data);
		} else {
			// user is not admin or employee
			redirect('repairs');
		}
	}
	
	// -------------------------------------------------------------------
	
	/*
	 * View information about a repair in the system.
	 */
	function view($ticket_id) {
		if($this->ion_auth->is_admin() || $this->ion_auth->in_group('employee')) {
			// user is admin or employee
			
		} else {
			// user is not admin or employee
			redirect('repairs');
		}
	}
	
	// -------------------------------------------------------------------
	
	/*
	 * Updates repair information or creates a new entry.
	 * 
	 * This page redirects to a list of all repairs.
	 */
	function save($ticket_id = -1) {
		if($this->ion_auth->is_admin() || $this->ion_auth->in_group('employee')) {
			// user is admin or employee
			$data['results'] = $this->repair_model->get_all();
			$row = $this->repair_model->load($ticket_id)->row();
			
			$this->form_validation->set_rules('customer_first', 'First Name', 'required');
			$this->form_validation->set_rules('customer_last', 'Last Name', 'required');
			$this->form_validation->set_rules('phone_number', 'Phone Number', 'required');
			$this->form_validation->set_rules('item', 'Item', 'required');
			$this->form_validation->set_rules('repair_type', 'Repair Type', 'required');
			
			if($this->input->post('warranty_number') != 0 || $this->input->post('warranty_number') != '') {
				$warranty_number = $this->input->post('warranty_number');
			} else {
				$warranty_number = NULL;
			}
			
			if($this->input->post('warranty')) {
				if($this->input->post('pick_up_date')) {
					$expire = date('Y-m-d', strtotime($this->input->post('pick_up_date').' +'.$this->input->post('warranty_type')));
				} else {
					$expire = date('Y-m-d', strtotime(date('Y-m-d').' +'.$this->input->post('warranty_type')));
				}
			} elseif($this->input->post('pick_up_date')) {
					$expire = date('Y-m-d', strtotime($this->input->post('pick_up_date').' +1 month'));
			} else {
				$expire = NULL;
			}
			
			if($ticket_id == -1) {
				$repair_data = array(
					'warranty_number'		=> $warranty_number,
					'customer_first'		=> ucfirst($this->input->post('customer_first')),
					'customer_last'			=> ucfirst($this->input->post('customer_last')),
					'phone_number'			=> strip_phone($this->input->post('phone_number')),
					'email_address'			=> ($this->input->post('email_address') != '') ? strtolower($this->input->post('email_address')) : NULL,
					'item'					=> strtoupper($this->input->post('item')),
					'repair_type'			=> $this->input->post('repair_type'),
					'serial_number'			=> $this->input->post('serial_number') ? strtoupper($this->input->post('serial_number')) : '--',
					'problem'				=> strtoupper($this->input->post('problem')),
					'price'					=> strtoupper($this->input->post('price')),
					'game_inside'			=> $this->input->post('game_inside'),
					'game_in_system'		=> strtoupper($this->input->post('game_in_system')),
					'refix'					=> $this->input->post('refix'),
					'cnbf'					=> $this->input->post('cnbf'),
					'confirmed'				=> $this->input->post('confirmed'),
					'drop_off_employee'		=> $this->input->post('drop_off_employee') ? $this->input->post('drop_off_employee') : $this->ion_auth->user()->row()->first_name,
					'drop_off_date'			=> date('Y-m-d H:i:s'),
					'repair_employee'		=> $this->input->post('repair_employee') ? $this->input->post('repair_employee') : NULL,
					'repair_date'			=> $this->input->post('repair_date') ? date('Y-m-d', strtotime($this->input->post('repair_date'))) : NULL,
					'last_test_date'		=> $this->input->post('last_test_date') ? date('Y-m-d', strtotime($this->input->post('last_test_date'))) : NULL,
					'times_tested'			=> $this->input->post('last_test_date') ? (date('Y-m-d', strtotime($this->input->post('last_test_date'))) != date('Y-m-d', strtotime($row->last_test_date))) ? $row->times_tested+1 : $row->times_tested : '0',
					'last_called_date'		=> $this->input->post('last_called_date') ? date('Y-m-d', strtotime($this->input->post('last_called_date'))) : NULL,
					'times_called'			=> $this->input->post('last_called_date') ? (date('Y-m-d', strtotime($this->input->post('last_called_date'))) != date('Y-m-d', strtotime($row->last_called_date))) ? $row->times_called+1 : $row->times_called : '0',
					'last_customer_call'	=> $this->input->post('last_customer_call') ? date('Y-m-d', strtotime($this->input->post('last_customer_call'))) : NULL,
					'times_customer_call'	=> $this->input->post('last_customer_call') ? (date('Y-m-d', strtotime($this->input->post('last_customer_call'))) != date('Y-m-d', strtotime($row->last_customer_call))) ? $row->times_customer_call+1 : $row->times_customer_call : '0',
					'pick_up_date'			=> $this->input->post('pick_up_date') ? date('Y-m-d H:i:s', strtotime($this->input->post('pick_up_date'))) : NULL,
					'warranty_type'			=> $this->input->post('warranty_type') ? $this->input->post('warranty_type') : NULL,
					'expire'				=> $expire,
					'tech_notes'			=> $this->input->post('tech_notes'),
					'call_notes'			=> $this->input->post('call_notes'),
					'additional_notes'		=> $this->input->post('additional_notes')
				);
			} elseif($this->input->post('test_failed')) {
				$repair_data = array(
					'warranty_number'		=> $warranty_number,
					'customer_first'		=> ucfirst($this->input->post('customer_first')),
					'customer_last'			=> ucfirst($this->input->post('customer_last')),
					'phone_number'			=> strip_phone($this->input->post('phone_number')),
					'email_address'			=> strtolower($this->input->post('email_address')),
					'item'					=> strtoupper($this->input->post('item')),
					'repair_type'			=> $this->input->post('repair_type'),
					'serial_number'			=> strtoupper($this->input->post('serial_number')),
					'problem'				=> strtoupper($this->input->post('problem')),
					'price'					=> is_numeric($this->input->post('price')) ? $this->input->post('price') : strtoupper($this->input->post('price')),
					'game_inside'			=> $this->input->post('game_inside'),
					'game_in_system'		=> strtoupper($this->input->post('game_in_system')),
					'refix'					=> $this->input->post('refix'),
					'cnbf'					=> $this->input->post('cnbf'),
					'replaced'				=> $this->input->post('replaced'),
					'new_serial'			=> strtoupper($this->input->post('new_serial')),
					'confirmed'				=> $this->input->post('confirmed'),
					'repair_employee'		=> NULL,
					'repair_date'			=> NULL,
					'last_test_date'		=> NULL,
					'times_tested'			=> 0,
					'last_called_date'		=> NULL,
					'times_called'			=> 0,
					'last_customer_call'	=> NULL,
					'times_customer_call'	=> 0,
					'fail_date'				=> date('Y-m-d'),
					'pick_up_date'			=> $this->input->post('pick_up_date') ? date('Y-m-d H:i:s', strtotime($this->input->post('pick_up_date'))) : NULL,
					'warranty_type'			=> $this->input->post('warranty_type') ? $this->input->post('warranty_type') : NULL,
					'expire'				=> $expire,
					'tech_notes'			=> $this->input->post('tech_notes'),
					'call_notes'			=> $this->input->post('call_notes'),
					'additional_notes'		=> $this->input->post('additional_notes').' Failed Testing: '.date('m/d/Y')
				);
			} elseif($this->input->post('repair_employee') != '' || $this->input->post('repair_date') != '') {
				$repair_data = array(
					'warranty_number'		=> $warranty_number,
					'customer_first'		=> $this->input->post('customer_first'),
					'customer_last'			=> $this->input->post('customer_last'),
					'phone_number'			=> strip_phone($this->input->post('phone_number')),
					'email_address'			=> strtolower($this->input->post('email_address')),
					'item'					=> strtoupper($this->input->post('item')),
					'repair_type'			=> $this->input->post('repair_type'),
					'serial_number'			=> strtoupper($this->input->post('serial_number')),
					'problem'				=> strtoupper($this->input->post('problem')),
					'price'					=> is_numeric($this->input->post('price')) ? $this->input->post('price') : strtoupper($this->input->post('price')),
					'game_inside'			=> $this->input->post('game_inside'),
					'game_in_system'		=> strtoupper($this->input->post('game_in_system')),
					'refix'					=> $this->input->post('refix'),
					'cnbf'					=> $this->input->post('cnbf'),
					'replaced'				=> $this->input->post('replaced'),
					'new_serial'			=> strtoupper($this->input->post('new_serial')),
					'confirmed'				=> $this->input->post('confirmed'),
					'repair_employee'		=> $this->input->post('repair_employee') ? $this->input->post('repair_employee') : $this->ion_auth->user()->row()->first_name,
					'repair_date'			=> $this->input->post('repair_date') ? date('Y-m-d', strtotime($this->input->post('repair_date'))) : date('Y-m-d'),
					'last_test_date'		=> $this->input->post('last_test_date') ? date('Y-m-d', strtotime($this->input->post('last_test_date'))) : NULL,
					'times_tested'			=> (date('Y-m-d', strtotime($this->input->post('last_test_date'))) != date('Y-m-d', strtotime($row->last_test_date))) ? $row->times_tested+1 : $row->times_tested,
					'last_called_date'		=> $this->input->post('last_called_date') ? date('Y-m-d', strtotime($this->input->post('last_called_date'))) : NULL,
					'times_called'			=> (date('Y-m-d', strtotime($this->input->post('last_called_date'))) != date('Y-m-d', strtotime($row->last_called_date))) ? $row->times_called+1 : $row->times_called,
					'last_customer_call'	=> $this->input->post('last_customer_call') ? date('Y-m-d', strtotime($this->input->post('last_customer_call'))) : NULL,
					'times_customer_call'	=> (date('Y-m-d', strtotime($this->input->post('last_customer_call'))) != date('Y-m-d', strtotime($row->last_customer_call))) ? $row->times_customer_call+1 : $row->times_customer_call,
					'pick_up_date'			=> $this->input->post('pick_up_date') ? date('Y-m-d H:i:s', strtotime($this->input->post('pick_up_date'))) : NULL,
					'expire'				=> $expire,
					'tech_notes'			=> $this->input->post('tech_notes'),
					'call_notes'			=> $this->input->post('call_notes'),
					'additional_notes'		=> $this->input->post('additional_notes')
				);
			} elseif($this->input->post('pick_up_date') != '') {
				$repair_data = array(
					'warranty_number'		=> $warranty_number,
					'customer_first'		=> $this->input->post('customer_first'),
					'customer_last'			=> $this->input->post('customer_last'),
					'phone_number'			=> strip_phone($this->input->post('phone_number')),
					'email_address'			=> strtolower($this->input->post('email_address')),
					'item'					=> strtoupper($this->input->post('item')),
					'repair_type'			=> $this->input->post('repair_type'),
					'serial_number'			=> strtoupper($this->input->post('serial_number')),
					'problem'				=> strtoupper($this->input->post('problem')),
					'price'					=> is_numeric($this->input->post('price')) ? $this->input->post('price') : strtoupper($this->input->post('price')),
					'game_inside'			=> $this->input->post('game_inside'),
					'game_in_system'		=> strtoupper($this->input->post('game_in_system')),
					'refix'					=> $this->input->post('refix'),
					'cnbf'					=> $this->input->post('cnbf'),
					'replaced'				=> $this->input->post('replaced'),
					'new_serial'			=> strtoupper($this->input->post('new_serial')),
					'confirmed'				=> $this->input->post('confirmed'),
					'repair_employee'		=> $this->input->post('repair_employee'),
					'repair_date'			=> date('Y-m-d', strtotime($this->input->post('repair_date'))),
					'last_test_date'		=> $this->input->post('last_test_date') ? date('Y-m-d', strtotime($this->input->post('last_test_date'))) : NULL,
					'times_tested'			=> (date('Y-m-d', strtotime($this->input->post('last_test_date'))) != date('Y-m-d', strtotime($row->last_test_date))) ? $row->times_tested+1 : $row->times_tested,
					'last_called_date'		=> $this->input->post('last_called_date') ? date('Y-m-d', strtotime($this->input->post('last_called_date'))) : NULL,
					'times_called'			=> (date('Y-m-d', strtotime($this->input->post('last_called_date'))) != date('Y-m-d', strtotime($row->last_called_date))) ? $row->times_called+1 : $row->times_called,
					'last_customer_call'	=> $this->input->post('last_customer_call') ? date('Y-m-d', strtotime($this->input->post('last_customer_call'))) : NULL,
					'times_customer_call'	=> (date('Y-m-d', strtotime($this->input->post('last_customer_call'))) != date('Y-m-d', strtotime($row->last_customer_call))) ? $row->times_customer_call+1 : $row->times_customer_call,
					'pick_up_date'			=> date('Y-m-d H:i:s', strtotime($this->input->post('pick_up_date'))),
					'warranty_type'			=> $this->input->post('warranty_type'),
					'expire'				=> $expire,
					'tech_notes'			=> $this->input->post('tech_notes'),
					'call_notes'			=> $this->input->post('call_notes'),
					'additional_notes'		=> $this->input->post('additional_notes').' Warranty Expires: '.$expire
				);
			} else {
				$repair_data = array(
					'warranty_number'		=> $warranty_number,
					'customer_first'		=> ucfirst($this->input->post('customer_first')),
					'customer_last'			=> ucfirst($this->input->post('customer_last')),
					'phone_number'			=> strip_phone($this->input->post('phone_number')),
					'email_address'			=> strtolower($this->input->post('email_address')),
					'item'					=> strtoupper($this->input->post('item')),
					'repair_type'			=> $this->input->post('repair_type'),
					'serial_number'			=> strtoupper($this->input->post('serial_number')),
					'problem'				=> strtoupper($this->input->post('problem')),
					'price'					=> is_numeric($this->input->post('price')) ? $this->input->post('price') : strtoupper($this->input->post('price')),
					'game_inside'			=> $this->input->post('game_inside'),
					'game_in_system'		=> strtoupper($this->input->post('game_in_system')),
					'refix'					=> $this->input->post('refix'),
					'cnbf'					=> $this->input->post('cnbf'),
					'replaced'				=> $this->input->post('replaced'),
					'new_serial'			=> strtoupper($this->input->post('new_serial')),
					'confirmed'				=> $this->input->post('confirmed'),
					'repair_employee'		=> $this->input->post('repair_employee') ? $this->input->post('repair_employee') : NULL,
					'repair_date'			=> $this->input->post('repair_date') ? date('Y-m-d', strtotime($this->input->post('repair_date'))) : NULL,
					'last_test_date'		=> $this->input->post('last_test_date') ? date('Y-m-d', strtotime($this->input->post('last_test_date'))) : NULL,
					'times_tested'			=> (date('Y-m-d', strtotime($this->input->post('last_test_date'))) != date('Y-m-d', strtotime($row->last_test_date))) ? $row->times_tested+1 : $row->times_tested,
					'last_called_date'		=> $this->input->post('last_called_date') ? date('Y-m-d', strtotime($this->input->post('last_called_date'))) : NULL,
					'times_called'			=> (date('Y-m-d', strtotime($this->input->post('last_called_date'))) != date('Y-m-d', strtotime($row->last_called_date))) ? $row->times_called+1 : $row->times_called,
					'last_customer_call'	=> $this->input->post('last_customer_call') ? date('Y-m-d', strtotime($this->input->post('last_customer_call'))) : NULL,
					'times_customer_call'	=> (date('Y-m-d', strtotime($this->input->post('last_customer_call'))) != date('Y-m-d', strtotime($row->last_customer_call))) ? $row->times_customer_call+1 : $row->times_customer_call,
					'pick_up_date'			=> $this->input->post('pick_up_date') ? date('Y-m-d H:i:s', strtotime($this->input->post('pick_up_date'))) : NULL,
					'warranty_type'			=> $this->input->post('warranty_type') ? $this->input->post('warranty_type') : NULL,
					'expire'				=> $expire,
					'tech_notes'			=> $this->input->post('tech_notes'),
					'call_notes'			=> $this->input->post('call_notes'),
					'additional_notes'		=> $this->input->post('additional_notes')
				);
			}
			
			if($this->form_validation->run() == TRUE) {
				$this->repair_model->save($repair_data, $ticket_id);
				
				if($this->input->post('email_address') != '') {
					$username = url_title($this->input->post('customer_first').' '.$this->input->post('customer_last'), '', TRUE);
					$password = strip_phone($this->input->post('phone_number'));
					$email = $this->input->post('email_address');
					$additional_data = array(
						'first_name'	=> ucfirst($this->input->post('customer_first')),
						'last_name'		=> ucfirst($this->input->post('customer_last')),
						'phone'			=> strip_phone($this->input->post('phone_number'))
					);
					$this->ion_auth->register($username, $password, $email, $additional_data);
				}
				
				if($ticket_id == -1) {
					redirect('repairs/ticket/'.$this->repair_model->next_id());
				} else {
					redirect('');
				}
			} else {
				redirect('repairs/edit/'.$ticket_id);
			}
		} else {
			// user is not admin or employee
			redirect('repairs');
		}
	}
	
	// -------------------------------------------------------------------
	
	/*
	 * Sets status of a repair to fixed.
	 * 
	 * This page redirects to a list of all repairs.
	 */
	function fixed($ticket_id) {
		if($this->ion_auth->is_admin() || $this->ion_auth->in_group('employee')) {
			// user is admin or employee
			$data['results'] = $this->repair_model->get_all();
			$row = $this->repair_model->load($ticket_id)->row();
			
			$repair_data = array(
				'repair_employee'	=> $this->ion_auth->user()->row()->first_name,
				'repair_date'		=> date('Y-m-d')
			);
			
			$this->repair_model->save($repair_data, $ticket_id);
			
			redirect('repairs');
		} else {
			// user is not admin or employee
			redirect('repairs');
		}
	}
	
	// -------------------------------------------------------------------
	
	/*
	 * Sets status of a repair to picked up.
	 * 
	 * This page redirects to a list of all repairs.
	 */
	function pickup($ticket_id) {
		if($this->ion_auth->is_admin() || $this->ion_auth->in_group('employee')) {
			// user is admin or employee
			$data['results'] = $this->repair_model->get_all();
			$row = $this->repair_model->load($ticket_id)->row();
			
			$expire = date('Y-m-d', strtotime(date('Y-m-d').' +1 month'));
			
			if($row->cnbf == 1 || $row->repair_date == NULL) {
				$repair_data = array(
					'pick_up_date'		=> date('Y-m-d H:i:s'),
					'warranty_type'		=> NULL,
					'expire'			=> NULL,
					'additional_notes'	=> $this->input->post('additional_notes').' Picked up with no repair completed.'
				);
			} else {
				$repair_data = array(
					'pick_up_date'		=> date('Y-m-d H:i:s'),
					'warranty_type'		=> '1 month',
					'expire'			=> $expire,
					'additional_notes'	=> $this->input->post('additional_notes').' Warranty Expires: '.date('m/d/Y', strtotime($expire))
				);
			}
			
			$this->repair_model->save($repair_data, $ticket_id);
			
			redirect('repairs');
		} else {
			// user is not admin or employee
			redirect('repairs');
		}
	}
	
	// -------------------------------------------------------------------
	
	/*
	 * This repair ticket should be printed and given to the owner of the
	 * console.
	 */
	function ticket() {
		if($this->uri->segment(3) == '') {
			redirect('repairs');
		}
		
		$data['row'] = $this->repair_model->load(urldecode($this->uri->segment(3)))->row();
		
		$data['page_title'] = 'Repair Ticket';
		$data['body_id'] = 'repair-ticket';
		$data['content'] = 'repairs/ticket';
		$this->load->view('template', $data);
	}
	
	// -------------------------------------------------------------------
	
	/*
	 * This Report should be printed and taped to the bin containing it's
	 * parts.
	 */
	function report() {
		if($this->uri->segment(3) == '') {
			redirect('repairs');
		}
		
		$data['row'] = $this->repair_model->load(urldecode($this->uri->segment(3)))->row();
		
		$data['page_title'] = 'Repair Report';
		$data['body_id'] = 'repair-report';
		$data['content'] = 'repairs/report';
		$this->load->view('template', $data);
	}
}

/* End of file repairs.php */
/* Location: ./application/controllers/repairs.php */