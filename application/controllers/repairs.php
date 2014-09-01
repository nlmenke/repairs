<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
/*
| Name:         Repairs
| Category:     Controllers
| Author:       N.L.Menke
|               n.menke@ubreakifix.com
|               @NLMenke
| Location:     https://github.com/nlmenke/repairs/
| Created:      08/26/2012
| Description:  Keeps track of items currently in the possession of the
|               store. Also holds information about the owner of all these
|               items and whether it is still under warranty.
*/

class Repairs extends Security_Controller {

    function __construct() {
        parent::__construct();

        $this->load->language('repairs');
    }

    // -------------------------------------------------------------------

    /**
     * If Admin or Emplyee:
     *  Full list of all items taken in for repair and the information
     *  needed to ensure the owner gets their correct item returned to
     *  them.
     *
     * If item owner:
     *  Full list of all items owned by person brought in for repair.
     *
     * /repairs/
     */
    function index() {
        if(!$this->ion_auth->logged_in()) {
            // user is not logged in
            redirect('auth/login');
        } else if(!$this->ion_auth->is_admin() && !$this->ion_auth->in_group('employee')) {
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
            $data['repairs']     = $repairs;

            $data['page_title'] = 'Customer Repairs';
            $this->load->view('repairs/customer', $data);
        } else {
            // user is admin or employee
            redirect('repairs/archive');
        }
    }

    // -------------------------------------------------------------------

    /**
     * Full list of all repairs in the system.
     *
     * /repairs/archive/
     */
    function archive() {
        if(!$this->ion_auth->logged_in()) {
            // user is not logged in
            redirect('auth/login');
        } else if(!$this->ion_auth->is_admin() && !$this->ion_auth->in_group('employee')) {
            // user is not admin or employee
            redirect('repairs');
        } else {
            // user is admin or employee
            $data['total']        = count($this->repair_model->get_all());
            $data['in_house']     = count($this->repair_model->get_in_house());
            $data['refixes']      = count($this->repair_model->get_type('refix'));
            $data['unrepairable'] = count($this->repair_model->get_type('cnbf'));
            $data['replaced']     = count($this->repair_model->get_type('replaced'));

            // pagination
            $this->load->library('pagination');
            $config['base_url']         = base_url().'repairs/archive';
            $config['total_rows']       = $this->db->get('repairs')->num_rows();
            $config['per_page']         = config_item('repairs_per_page');
            $config['uri_segment']      = 3;
            $config['use_page_numbers'] = true;
            $this->pagination->initialize($config);

            $data['results'] = $this->repair_model->get_archives($config['per_page'], $this->uri->segment(3, 1));

            // breadcrumbs
            $this->breadcrumb->append_crumb('<i class="fa fa-home"></i> '.config_item('company'), base_url());
            $this->breadcrumb->append_crumb(lang('repairs'), 'repairs');
            $this->breadcrumb->append_crumb(lang('repairs_archive'), 'repairs/archive');

            // view
            $data['page_title'] = lang('repairs_repair_archive');
            $this->load->view('repairs/list', $data);
        }
    }

    // -------------------------------------------------------------------

    /**
     * View systems currently in the store.
     *
     * /repairs/in_house/
     */
    function in_house() {
        if(!$this->ion_auth->logged_in()) {
            // user is not logged in
            redirect('auth/login');
        } else if(!$this->ion_auth->is_admin() && !$this->ion_auth->in_group('employee')) {
            // user is not admin or employee
            redirect('repairs');
        } else {
            // user is admin or employee
            $data['results']      = $this->repair_model->get_in_house();
            $data['total']        = count($this->repair_model->get_all());
            $data['in_house']     = count($this->repair_model->get_in_house());
            $data['refixes']      = $this->repair_model->get_refix_count();
            $data['unrepairable'] = $this->repair_model->get_unrepairable_count();

            $data['page_title'] = 'Systems In-House';
            $this->load->view('repairs/list', $data);
        }
    }

    // -------------------------------------------------------------------

    /**
     * View systems that have been picked up and are still under warranty.
     *
     * /repairs/under_warranty/
     */
    function under_warranty() {
        if(!$this->ion_auth->logged_in()) {
            // user is not logged in
            redirect('auth/login');
        } else if(!$this->ion_auth->is_admin() && !$this->ion_auth->in_group('employee')) {
            // user is not admin or employee
            redirect('repairs');
        } else {
            // user is admin or employee
            $data['results']      = $this->repair_model->get_under_warranty();
            $data['total']        = count($this->repair_model->get_all());
            $data['in_house']     = count($this->repair_model->get_in_house());
            $data['refixes']      = $this->repair_model->get_refix_count();
            $data['unrepairable'] = $this->repair_model->get_unrepairable_count();

            $data['page_title'] = 'Systems Under Warranty';
            $this->load->view('template', $data);
        }
    }

    // -------------------------------------------------------------------

    /**
     * View systems that have ben picked up and the warranty has expired.
     *
     * /repairs/expired/
     */
    function expired() {
        if(!$this->ion_auth->logged_in()) {
            // user is not logged in
            redirect('auth/login');
        } else if(!$this->ion_auth->is_admin() && !$this->ion_auth->in_group('employee')) {
            // user is not admin or employee
            redirect('repairs');
        } else {
            // user is admin or employee
            $data['results']      = $this->repair_model->get_expired();
            $data['total']        = count($this->repair_model->get_all());
            $data['in_house']     = count($this->repair_model->get_in_house());
            $data['refixes']      = $this->repair_model->get_refix_count();
            $data['unrepairable'] = $this->repair_model->get_unrepairable_count();

            $data['page_title'] = 'Expired Warranties';
            $this->load->view('template', $data);
        }
    }

    // -------------------------------------------------------------------

    /**
     * Search for a repair.
     *
     * /repairs/search/
     */
    function search() {
        if(!$this->ion_auth->logged_in()) {
            // user is not logged in
            redirect('auth/login');
        } else if(!$this->ion_auth->is_admin() && !$this->ion_auth->in_group('employee')) {
            // user is not admin or employee
            redirect('repairs');
        } else {
            // user is admin or employee
            $search = $this->input->post('search');

            $data['search_total'] = $this->repair_model->search_count($search);

            $this->load->library('pagination');
            $config['base_url']         = base_url().'repairs/search';
            $config['total_rows']       = $data['search_total'];
            $config['per_page']         = 50;
            $config['uri_segment']      = 3;
            $config['use_page_numbers'] = true;
            $this->pagination->initialize($config);

            $data['results'] = $this->repair_model->search($search, $config['per_page'], $this->uri->segment(3, 1));

            // view
            $data['page_title'] = 'Repair List';
            $data['content']    = 'repairs/list';
            $this->load->view('template', $data);
        }
    }

    // -------------------------------------------------------------------

    /**
     * Edit information about a repair in the system.
     *
     * /repairs/edit/<$ticket_id>
     *
     * @param $ticket_id
     */
    function edit($ticket_id = -1) {
        if(!$this->ion_auth->logged_in()) {
            // user is not logged in
            redirect('auth/login');
        } else if(!$this->ion_auth->is_admin() && !$this->ion_auth->in_group('employee')) {
            // user is not admin or employee
            redirect('repairs');
        } else {
            if($this->uri->segment(3) == '') {
                $data['page_title'] = 'Edit Repair';
                $this->load->view('repairs/form', $data);
            }
            // user is admin or employee
            $repair_info         = $this->repair_model->get_item($ticket_id);
            $data['ticket_id']   = $ticket_id;
            $data['repair_info'] = $repair_info;
            $data['repair_type'] = array(
                'computer'     => 'Computer',
                'console'      => 'Console',
                'controller'   => 'Controller',
                'game'         => 'Disc / Cartridge',
                'handheld'     => 'Handheld',
                'modification' => 'Modification',
                'phone'        => 'Phone / Tablet',
                'other'        => 'Other'
            );
            $data['employees']   = array('' => '----');
            foreach($this->ion_auth->users(array('1', '2'))->result() as $employee) {
                $data['employees'][$employee->first_name] = $employee->first_name;
            }
            $data['repair_employee'] = $this->repair_model->get_info($ticket_id)->row_array();

            // breadcrumbs
            $this->breadcrumb->append_crumb('<i class="fa fa-home"></i> '.config_item('company'), base_url());
            $this->breadcrumb->append_crumb(lang('repairs'), 'repairs');
            if($ticket_id == -1) {
                $this->breadcrumb->append_crumb(lang('repairs_new'), 'repairs/edit');
            } else {
                $this->breadcrumb->append_crumb(lang('repairs_edit'), 'repairs/edit');
                $this->breadcrumb->append_crumb('Ticket '.$ticket_id, 'repairs/edit/'.$ticket_id);
            }

            // view
            $data['page_title'] = ($ticket_id != -1) ? $repair_info->customer_first.' '.$repair_info->customer_last.'\'s '.ucfirst($repair_info->repair_type).' Repair' : 'New Repair';
            $this->load->view('repairs/form', $data);
        }
    }

    // -------------------------------------------------------------------

    /**
     * View information about a repair in the system.
     *
     * /repairs/view/<$ticket_id>
     *
     * @param $ticket_id
     */
    function view($ticket_id) {
        if(!$this->ion_auth->logged_in()) {
            // user is not logged in
            redirect('auth/login');
        } else if(!$this->ion_auth->is_admin() && !$this->ion_auth->in_group('employee')) {
            // user is not admin or employee
            redirect('repairs');
        } else {
            // user is admin or employee

        }
    }

    // -------------------------------------------------------------------

    /**
     * Update repair information or creates a new entry.
     *  - This page redirects to a list of all repairs.
     *
     * @param $ticket_id
     *
     * @todo  update 'times_tested', 'times_called', 'times_customer_call'
     *        fields
     * @todo  condense?
     */
    function save($ticket_id = -1) {
        if(!$this->ion_auth->logged_in()) {
            // user is not logged in
            redirect('auth/login');
        } else if(!$this->ion_auth->is_admin() && !$this->ion_auth->in_group('employee')) {
            // user is not admin or employee
            redirect('repairs');
        } else {
            // user is admin or employee
            $data['results'] = $this->repair_model->get_all();
            $row             = $this->repair_model->load($ticket_id)->row();

            $this->form_validation->set_rules('customer_first', 'First Name', 'required|trim|xss_clean');
            $this->form_validation->set_rules('customer_last', 'Last Name', 'required|trim|xss_clean');
            $this->form_validation->set_rules('phone_number', 'Phone Number', 'required|trim|xss_clean');
            $this->form_validation->set_rules('item', 'Item', 'required|trim|xss_clean');
            $this->form_validation->set_rules('problem', 'Problem', 'required|trim|xss_clean');
            $this->form_validation->set_rules('price', 'Price', 'required|trim|xss_clean');
            $this->form_validation->set_rules('serial_number', 'Serial Number', 'required|trim|xss_clean');

            if($this->input->post('warranty_number') != 0 || $this->input->post('warranty_number') != '') {
                $warranty_number = $this->input->post('warranty_number');
            } else {
                $warranty_number = null;
            }

            if($this->input->post('pick_up_date')) {
                $expire = date('Y-m-d', strtotime($this->input->post('pick_up_date').' +'.config_item('warranty_type')));
            } else {
                $expire = null;
            }

            if($ticket_id == -1) {
                $repair_data = array(
                    // customer info
                    'customer_first'      => ucfirst($this->input->post('customer_first')),
                    'customer_last'       => ucfirst($this->input->post('customer_last')),
                    'phone_number'        => strip_phone($this->input->post('phone_number')),
                    'email_address'       => ($this->input->post('email_address') != '') ? strtolower($this->input->post('email_address')) : null,
                    // reported problem
                    'repair_type'         => $this->input->post('repair_type'),
                    'item'                => strtoupper($this->input->post('item')),
                    'serial_number'       => $this->input->post('serial_number') ? strtoupper($this->input->post('serial_number')) : '--',
                    'problem'             => strtoupper($this->input->post('problem')),
                    'price'               => strtoupper($this->input->post('price')),
                    'game_inside'         => $this->input->post('game_inside'),
                    'game_in_system'      => strtoupper($this->input->post('game_in_system')),
                    // repair info
                    'confirmed'           => $this->input->post('confirmed'),
                    'refix'               => $this->input->post('refix'),
                    'cnbf'                => $this->input->post('cnbf'),
                    'replaced'            => $this->input->post('replaced'),
                    'new_serial'          => strtoupper($this->input->post('new_serial')),
                    'repair_employee'     => $this->input->post('repair_employee') ? $this->input->post('repair_employee') : null,
                    'repair_date'         => $this->input->post('repair_date') ? date('Y-m-d', strtotime($this->input->post('repair_date'))) : null,
                    // drop off info
                    'drop_off_employee'   => $this->input->post('drop_off_employee') ? $this->input->post('drop_off_employee') : $this->ion_auth->user()->row()->first_name,
                    'drop_off_date'       => date('Y-m-d H:i:s'),
                    // test info
                    'last_test_date'      => $this->input->post('date_tested') ? date('Y-m-d', strtotime($this->input->post('date_tested'))) : null,
                    'times_tested'        => $this->input->post('date_tested') ? 1 : null,
                    // call info
                    'last_called_date'    => $this->input->post('date_called') ? date('Y-m-d', strtotime($this->input->post('date_called'))) : null,
                    'times_called'        => $this->input->post('date_called') ? 1 : null,
                    'last_customer_call'  => $this->input->post('date_they_called') ? date('Y-m-d', strtotime($this->input->post('date_they_called'))) : null,
                    'times_customer_call' => $this->input->post('date_they_called') ? 1 : null,
                    // warranty info
                    'pick_up_date'        => $this->input->post('pick_up_date') ? date('Y-m-d H:i:s', strtotime($this->input->post('pick_up_date'))) : null,
                    'expire'              => $expire,
                    'warranty_number'     => $warranty_number,
                    // notes
                    'tech_notes'          => $this->input->post('tech_notes'),
                    'call_notes'          => $this->input->post('call_notes'),
                    'additional_notes'    => $this->input->post('additional_notes')
                );
            } elseif($this->input->post('test_failed')) {
                $repair_data = array(
                    // customer info
                    'customer_first'      => ucfirst($this->input->post('customer_first')),
                    'customer_last'       => ucfirst($this->input->post('customer_last')),
                    'phone_number'        => strip_phone($this->input->post('phone_number')),
                    'email_address'       => strtolower($this->input->post('email_address')),
                    // reported problem
                    'repair_type'         => $this->input->post('repair_type'),
                    'item'                => strtoupper($this->input->post('item')),
                    'serial_number'       => strtoupper($this->input->post('serial_number')),
                    'problem'             => strtoupper($this->input->post('problem')),
                    'price'               => is_numeric($this->input->post('price')) ? $this->input->post('price') : strtoupper($this->input->post('price')),
                    'game_inside'         => $this->input->post('game_inside'),
                    'game_in_system'      => strtoupper($this->input->post('game_in_system')),
                    // repair info
                    'confirmed'           => $this->input->post('confirmed'),
                    'refix'               => $this->input->post('refix'),
                    'cnbf'                => $this->input->post('cnbf'),
                    'replaced'            => $this->input->post('replaced'),
                    'new_serial'          => strtoupper($this->input->post('new_serial')),
                    'repair_employee'     => null,
                    'repair_date'         => null,
                    // test info
                    'fail_date'           => date('Y-m-d'),
                    'last_test_date'      => null,
                    'times_tested'        => null,
                    // call info
                    'last_called_date'    => $this->input->post('date_called') ? date('Y-m-d', strtotime($this->input->post('date_called'))) : null,
                    'times_called'        => $this->input->post('date_called') ? /**/ : null, // todo
                    'last_customer_call'  => $this->input->post('date_they_called') ? date('Y-m-d', strtotime($this->input->post('date_they_called'))) : null,
                    'times_customer_call' => $this->input->post('date_they_called') ? /**/ : null, // todo
                    // warranty info
                    'pick_up_date'        => $this->input->post('pick_up_date') ? date('Y-m-d H:i:s', strtotime($this->input->post('pick_up_date'))) : null,
                    'expire'              => $expire,
                    'warranty_number'     => $warranty_number,
                    // notes
                    'tech_notes'          => $this->input->post('tech_notes'),
                    'call_notes'          => $this->input->post('call_notes'),
                    'additional_notes'    => $this->input->post('additional_notes').' Failed Testing: '.date('m/d/Y')
                );
            } elseif($this->input->post('repair_employee') != '' || $this->input->post('repair_date') != '') {
                $repair_data = array(
                    // customer info
                    'customer_first'      => $this->input->post('customer_first'),
                    'customer_last'       => $this->input->post('customer_last'),
                    'phone_number'        => strip_phone($this->input->post('phone_number')),
                    'email_address'       => strtolower($this->input->post('email_address')),
                    // reported problem
                    'repair_type'         => $this->input->post('repair_type'),
                    'item'                => strtoupper($this->input->post('item')),
                    'serial_number'       => strtoupper($this->input->post('serial_number')),
                    'problem'             => strtoupper($this->input->post('problem')),
                    'price'               => is_numeric($this->input->post('price')) ? $this->input->post('price') : strtoupper($this->input->post('price')),
                    'game_inside'         => $this->input->post('game_inside'),
                    'game_in_system'      => strtoupper($this->input->post('game_in_system')),
                    // repair info
                    'confirmed'           => $this->input->post('confirmed'),
                    'refix'               => $this->input->post('refix'),
                    'cnbf'                => $this->input->post('cnbf'),
                    'replaced'            => $this->input->post('replaced'),
                    'new_serial'          => strtoupper($this->input->post('new_serial')),
                    'repair_employee'     => $this->input->post('repair_employee') ? $this->input->post('repair_employee') : $this->ion_auth->user()->row()->first_name,
                    'repair_date'         => $this->input->post('repair_date') ? date('Y-m-d', strtotime($this->input->post('repair_date'))) : date('Y-m-d'),
                    // test info
                    'last_test_date'      => $this->input->post('date_tested') ? date('Y-m-d', strtotime($this->input->post('date_tested'))) : null,
                    'times_tested'        => $this->input->post('date_tested') ? /**/ : null, // todo
                    // call info
                    'last_called_date'    => $this->input->post('date_called') ? date('Y-m-d', strtotime($this->input->post('date_called'))) : null,
                    'times_called'        => $this->input->post('date_called') ? /**/ : null, // todo
                    'last_customer_call'  => $this->input->post('date_they_called') ? date('Y-m-d', strtotime($this->input->post('date_they_called'))) : null,
                    'times_customer_call' => $this->input->post('date_they_called') ? /**/ : null, // todo
                    // warranty info
                    'pick_up_date'        => $this->input->post('pick_up_date') ? date('Y-m-d H:i:s', strtotime($this->input->post('pick_up_date'))) : null,
                    'expire'              => $expire,
                    'warranty_number'     => $warranty_number,
                    // notes
                    'tech_notes'          => $this->input->post('tech_notes'),
                    'call_notes'          => $this->input->post('call_notes'),
                    'additional_notes'    => $this->input->post('additional_notes')
                );
            } elseif($this->input->post('pick_up_date') != '') {
                $repair_data = array(
                    // customer info
                    'customer_first'      => $this->input->post('customer_first'),
                    'customer_last'       => $this->input->post('customer_last'),
                    'phone_number'        => strip_phone($this->input->post('phone_number')),
                    'email_address'       => strtolower($this->input->post('email_address')),
                    // reported problem
                    'repair_type'         => $this->input->post('repair_type'),
                    'item'                => strtoupper($this->input->post('item')),
                    'serial_number'       => strtoupper($this->input->post('serial_number')),
                    'problem'             => strtoupper($this->input->post('problem')),
                    'price'               => is_numeric($this->input->post('price')) ? $this->input->post('price') : strtoupper($this->input->post('price')),
                    'game_inside'         => $this->input->post('game_inside'),
                    'game_in_system'      => strtoupper($this->input->post('game_in_system')),
                    // repair info
                    'confirmed'           => $this->input->post('confirmed'),
                    'refix'               => $this->input->post('refix'),
                    'cnbf'                => $this->input->post('cnbf'),
                    'replaced'            => $this->input->post('replaced'),
                    'new_serial'          => strtoupper($this->input->post('new_serial')),
                    'repair_employee'     => $this->input->post('repair_employee'),
                    'repair_date'         => date('Y-m-d', strtotime($this->input->post('repair_date'))),
                    // test info
                    'last_test_date'      => $this->input->post('date_tested') ? date('Y-m-d', strtotime($this->input->post('date_tested'))) : null,
                    'times_tested'        => $this->input->post('date_tested') ? /**/ : null, // todo
                    // call info
                    'last_called_date'    => $this->input->post('date_called') ? date('Y-m-d', strtotime($this->input->post('date_called'))) : null,
                    'times_called'        => $this->input->post('date_called') ? /**/ : null, // todo
                    'last_customer_call'  => $this->input->post('date_they_called') ? date('Y-m-d', strtotime($this->input->post('date_they_called'))) : null,
                    'times_customer_call' => $this->input->post('date_they_called') ? /**/ : null, // todo
                    // warranty info
                    'pick_up_date'        => date('Y-m-d H:i:s', strtotime($this->input->post('pick_up_date'))),
                    'expire'              => $expire,
                    'warranty_number'     => $warranty_number,
                    // notes
                    'tech_notes'          => $this->input->post('tech_notes'),
                    'call_notes'          => $this->input->post('call_notes'),
                    'additional_notes'    => $this->input->post('additional_notes').' Warranty Expires: '.$expire
                );
            } else {
                $repair_data = array(
                    // customer info
                    'customer_first'      => ucfirst($this->input->post('customer_first')),
                    'customer_last'       => ucfirst($this->input->post('customer_last')),
                    'phone_number'        => strip_phone($this->input->post('phone_number')),
                    'email_address'       => strtolower($this->input->post('email_address')),
                    // reported problem
                    'repair_type'         => $this->input->post('repair_type'),
                    'item'                => strtoupper($this->input->post('item')),
                    'serial_number'       => strtoupper($this->input->post('serial_number')),
                    'problem'             => strtoupper($this->input->post('problem')),
                    'price'               => is_numeric($this->input->post('price')) ? $this->input->post('price') : strtoupper($this->input->post('price')),
                    'game_inside'         => $this->input->post('game_inside'),
                    'game_in_system'      => strtoupper($this->input->post('game_in_system')),
                    // repair info
                    'confirmed'           => $this->input->post('confirmed'),
                    'refix'               => $this->input->post('refix'),
                    'cnbf'                => $this->input->post('cnbf'),
                    'replaced'            => $this->input->post('replaced'),
                    'new_serial'          => strtoupper($this->input->post('new_serial')),
                    'repair_employee'     => $this->input->post('repair_employee') ? $this->input->post('repair_employee') : null,
                    'repair_date'         => $this->input->post('repair_date') ? date('Y-m-d', strtotime($this->input->post('repair_date'))) : null,
                    // test info
                    'last_test_date'      => $this->input->post('date_tested') ? date('Y-m-d', strtotime($this->input->post('date_tested'))) : null,
                    'times_tested'        => $this->input->post('date_tested') ? /**/ : null, // todo
                    // call info
                    'last_called_date'    => $this->input->post('date_called') ? date('Y-m-d', strtotime($this->input->post('date_called'))) : null,
                    'times_called'        => $this->input->post('date_called') ? /**/ : null, // todo
                    'last_customer_call'  => $this->input->post('date_they_called') ? date('Y-m-d', strtotime($this->input->post('date_they_called'))) : null,
                    'times_customer_call' => $this->input->post('date_they_called') ? /**/ : null, // todo
                    // warranty info
                    'pick_up_date'        => $this->input->post('pick_up_date') ? date('Y-m-d H:i:s', strtotime($this->input->post('pick_up_date'))) : null,
                    'expire'              => $expire,
                    'warranty_number'     => $warranty_number,
                    // notes
                    'tech_notes'          => $this->input->post('tech_notes'),
                    'call_notes'          => $this->input->post('call_notes'),
                    'additional_notes'    => $this->input->post('additional_notes')
                );
            }

            if($this->form_validation->run() == true) {
                $this->repair_model->save($repair_data, $ticket_id);

                if($this->input->post('email_address') != '') {
                    $username        = url_title($this->input->post('customer_first').' '.$this->input->post('customer_last'), '', true);
                    $pass            = explode('/', strip_phone($this->input->post('phone_number')));
                    $password        = $pass[0];
                    $email           = $this->input->post('email_address');
                    $additional_data = array(
                        'first_name' => ucfirst($this->input->post('customer_first')),
                        'last_name'  => ucfirst($this->input->post('customer_last')),
                        'phone'      => strip_phone($this->input->post('phone_number'))
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
        }
    }

    // -------------------------------------------------------------------

    /**
     * Sets status of a repair to fixed.
     *  - This page redirects to a list of all repairs.
     *
     * @param $ticket_id
     */
    function fixed($ticket_id) {
        if(!$this->ion_auth->logged_in()) {
            // user is not logged in
            redirect('auth/login');
        } else if(!$this->ion_auth->is_admin() && !$this->ion_auth->in_group('employee')) {
            // user is not admin or employee
            redirect('repairs');
        } else {
            // user is admin or employee
            $data['results'] = $this->repair_model->get_all();
            $row             = $this->repair_model->load($ticket_id)->row();

            $repair_data = array(
                'repair_employee' => $this->ion_auth->user()->row()->first_name,
                'repair_date'     => date('Y-m-d')
            );

            $this->repair_model->save($repair_data, $ticket_id);

            redirect('repairs');
        }
    }

    // -------------------------------------------------------------------

    /**
     * Sets status of a repair to picked up.
     *  - This page redirects to a list of all repairs.
     *
     * @param $ticket_id
     */
    function pickup($ticket_id) {
        if(!$this->ion_auth->logged_in()) {
            // user is not logged in
            redirect('auth/login');
        } else if(!$this->ion_auth->is_admin() && !$this->ion_auth->in_group('employee')) {
            // user is not admin or employee
            redirect('repairs');
        } else {
            // user is admin or employee
            $data['results'] = $this->repair_model->get_all();
            $row             = $this->repair_model->load($ticket_id)->row();

            $expire = date('Y-m-d', strtotime(date('Y-m-d').' +'.config_item('warranty_type')));

            if($row->cnbf == 1 || $row->repair_date == null || $row->repair_date == '') {
                $repair_data = array(
                    'pick_up_date'     => date('Y-m-d H:i:s'),
                    'expire'           => null,
                    'additional_notes' => $this->input->post('additional_notes').' Picked up with no repair completed.'
                );
            } else {
                $repair_data = array(
                    'pick_up_date'     => date('Y-m-d H:i:s'),
                    'expire'           => $expire,
                    'additional_notes' => $this->input->post('additional_notes')."\r\n".'Warranty Expires: '.date('m/d/Y', strtotime($expire))
                );
            }

            $this->repair_model->save($repair_data, $ticket_id);

            redirect('repairs');
        }
    }

    // -------------------------------------------------------------------

    /**
     * This repair ticket should be printed and given to the owner of the
     * console to sign. A second copy should also be given tot he console
     * owner.
     *
     * /repairs/ticket/<$ticket_id>/
     *
     * @param $ticket_id
     */
    function ticket($ticket_id) {
        if(!$this->ion_auth->logged_in()) {
            // user is not logged in
            redirect('auth/login');
        } else {
            if($ticket_id == '') {
                redirect('repairs');
            }

            $data['row'] = $this->repair_model->load($ticket_id)->row();

            $data['page_title'] = 'Repair Ticket';
            $this->load->view('repairs/ticket', $data);
        }
    }

    // -------------------------------------------------------------------

    /**
     * This stub should be printed and attached to the device.
     *
     * /repairs/stub/<$ticket_id>/
     *
     * @param $ticket_id
     */
    function stub($ticket_id) {
        if(!$this->ion_auth->logged_in()) {
            // user is not logged in
            redirect('auth/login');
        } else {
            if($ticket_id == '') {
                redirect('repairs');
            }

            $data['row'] = $this->repair_model->load($ticket_id)->row();

            $data['page_title'] = 'Repair Stub';
            $this->load->view('repairs/stub', $data);
        }
    }
}

/* End of file repairs.php */
/* Location: ./application/controllers/repairs.php */