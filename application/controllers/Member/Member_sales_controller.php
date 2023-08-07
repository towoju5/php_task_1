<?php defined('BASEPATH') OR exit('No direct script access allowed');
include_once 'Member_controller.php';
/*Powered By: Manaknightdigital Inc. https://manaknightdigital.com/ Year: 2021*/
/**
 * Sales Controller
 * @copyright 2019 Manaknightdigital Inc.
 * @link https://manaknightdigital.com
 * @license Proprietary Software licensing
 * @author Ryan Wong
 *
 */
class Member_sales_controller extends Member_controller
{
    protected $_model_file = 'payout_model';
    public $_page_name = 'Sales';

    public function __construct()
    {
        parent::__construct();
        
        
        
    }

    

    	public function index($page)
	{
        $this->load->library('pagination');
        include_once __DIR__ . '/../../view_models/Sales_member_list_paginate_view_model.php';
        $session = $this->get_session();
        $format = $this->input->get('format', TRUE) ?? 'view';
        $order_by = $this->input->get('order_by', TRUE) ?? '';
        $direction = $this->input->get('direction', TRUE) ?? 'ASC';
        $per_page_sort = $this->input->get('per_page_sort', TRUE) ?? 25;

        $this->_data['view_model'] = new Sales_member_list_paginate_view_model(
            $this->payout_model,
            $this->pagination,
            '/member/sales/0');
        $this->_data['view_model']->set_heading('Sales');
        $this->_data['view_model']->set_id(($this->input->get('id', TRUE) != NULL) ? $this->input->get('id', TRUE) : NULL);
		$this->_data['view_model']->set_user_id(($this->input->get('user_id', TRUE) != NULL) ? $this->input->get('user_id', TRUE) : NULL);
		$this->_data['view_model']->set_order_id(($this->input->get('order_id', TRUE) != NULL) ? $this->input->get('order_id', TRUE) : NULL);
		$this->_data['view_model']->set_amount(($this->input->get('amount', TRUE) != NULL) ? $this->input->get('amount', TRUE) : NULL);
		$this->_data['view_model']->set_created_at(($this->input->get('created_at', TRUE) != NULL) ? $this->input->get('created_at', TRUE) : NULL);
		$this->_data['view_model']->set_status(($this->input->get('status', TRUE) != NULL) ? $this->input->get('status', TRUE) : NULL);
		
        $where = [
            'id' => $this->_data['view_model']->get_id(),
			'user_id' => $this->session->userdata('user_id'),
			'order_id' => $this->_data['view_model']->get_order_id(),
			'amount' => $this->_data['view_model']->get_amount(),
			'created_at' => $this->_data['view_model']->get_created_at(),
			'status' => $this->_data['view_model']->get_status(),
			
            
        ];

        $this->_data['view_model']->set_total_rows($this->payout_model->count($where));

        $this->_data['view_model']->set_format_layout($this->_data['layout_clean_mode']);
        $this->_data['view_model']->set_per_page($per_page_sort);
        $this->_data['view_model']->set_order_by($order_by);
        $this->_data['view_model']->set_sort($direction);
        $this->_data['view_model']->set_sort_base_url('/member/sales/0');
        $this->_data['view_model']->set_page($page);
		$this->_data['view_model']->set_list($this->payout_model->get_paginated(
            $this->_data['view_model']->get_page(),
            $this->_data['view_model']->get_per_page(),
            $where,
            $order_by,
            $direction));

        $invetory_data = $this->db->select('i.*,p.name as professor,c.name as class,s.name as school')->from('inventory i ')
            ->join('school s','s.id=i.school_id')
            ->join('professor p','p.id=i.professor_id')
            ->join('classes c','c.id=i.class_id')
            ->get()->result_array();
        
        foreach ( $this->_data['view_model']->get_list() as $key => &$value) {
            $value->school = '';
            $value->professor = '';
            $value->class = '';
            $value->isbn = '';
            foreach ($invetory_data as $k => $v) {
                if($value->inventory_id==$v['id']){
                    $value->school = $v['school'];
                    $value->professor =  $v['professor'];
                    $value->class =  $v['class'];
                    $value->isbn =  $v['isbn'];
                }
            }

        }
            
        

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

        return $this->render('Member/Sales', $this->_data);
	}

    

    

    

    

    

    

    

    

    

    
}