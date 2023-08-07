<?php defined('BASEPATH') OR exit('No direct script access allowed');
include_once 'Member_controller.php';
/*Powered By: Manaknightdigital Inc. https://manaknightdigital.com/ Year: 2021*/
/**
 * Ticket Controller
 * @copyright 2019 Manaknightdigital Inc.
 * @link https://manaknightdigital.com
 * @license Proprietary Software licensing
 * @author Ryan Wong
 *
 */
class Member_ticket_controller extends Member_controller
{
    protected $_model_file = 'ticket_model';
    public $_page_name = 'Ticket';

    public function __construct()
    {
        parent::__construct();



    }



    	public function index($page)
	{
        $this->load->library('pagination');
        include_once __DIR__ . '/../../view_models/Ticket_member_list_paginate_view_model.php';
        $session = $this->get_session();
        $format = $this->input->get('format', TRUE) ?? 'view';
        $order_by = $this->input->get('order_by', TRUE) ?? '';
        $direction = $this->input->get('direction', TRUE) ?? 'ASC';
        $per_page_sort = $this->input->get('per_page_sort', TRUE) ?? 25;

        $this->_data['view_model'] = new Ticket_member_list_paginate_view_model(
            $this->ticket_model,
            $this->pagination,
            '/member/ticket/0');
        $this->_data['view_model']->set_heading('Ticket');
        $this->_data['view_model']->set_order_id(($this->input->get('order_id', TRUE) != NULL) ? $this->input->get('order_id', TRUE) : NULL);
		$this->_data['view_model']->set_message(($this->input->get('message', TRUE) != NULL) ? $this->input->get('message', TRUE) : NULL);
		$this->_data['view_model']->set_receive_status(($this->input->get('receive_status', TRUE) != NULL) ? $this->input->get('receive_status', TRUE) : NULL);


        $where = [
            'order_id' => $this->_data['view_model']->get_order_id(),
			'message' => $this->_data['view_model']->get_message(),
			'receive_status' => $this->_data['view_model']->get_receive_status(),
		    'user_id' => $this->session->userdata('user_id'),
        ];


        $this->_data['view_model']->set_total_rows($this->ticket_model->count($where));

        $this->_data['view_model']->set_format_layout($this->_data['layout_clean_mode']);
        $this->_data['view_model']->set_per_page($per_page_sort);
        $this->_data['view_model']->set_order_by($order_by);
        $this->_data['view_model']->set_sort($direction);
        $this->_data['view_model']->set_sort_base_url('/member/ticket/0');
        $this->_data['view_model']->set_page($page);
		$this->_data['view_model']->set_list($this->ticket_model->get_paginated(
            $this->_data['view_model']->get_page(),
            $this->_data['view_model']->get_per_page(),
            $where,
            $order_by,
            $direction));




        if ($format == 'csv')
        {
            header('Content-Type: text/csv');
            header('Content-Disposition: attachment; filename="export.csv"');

            echo $this->_data['view_model']->to_csv();
            exit();
        }

        if ($format != 'view')
        {
            return $this->output->set_content_type('application/json')
                ->set_status_header(200)
                ->set_output(json_encode($this->_data['view_model']->to_json()));
        }

        return $this->render('Member/Ticket', $this->_data);
	}




















}