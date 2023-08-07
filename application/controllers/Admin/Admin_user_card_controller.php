<?php defined('BASEPATH') OR exit('No direct script access allowed');
include_once 'Admin_controller.php';
/*Powered By: Manaknightdigital Inc. https://manaknightdigital.com/ Year: 2021*/
/**
 * User_card Controller
 * @copyright 2019 Manaknightdigital Inc.
 * @link https://manaknightdigital.com
 * @license Proprietary Software licensing
 * @author Ryan Wong
 *
 */
class Admin_user_card_controller extends Admin_controller
{
    protected $_model_file = 'user_card_model';
    public $_page_name = 'User Card';

    public function __construct()
    {
        parent::__construct();
        
        
        
    }

    

    	public function index($page)
	{
        $this->load->library('pagination');
        include_once __DIR__ . '/../../view_models/User_card_admin_list_paginate_view_model.php';
        $session = $this->get_session();
        $format = $this->input->get('format', TRUE) ?? 'view';
        $order_by = $this->input->get('order_by', TRUE) ?? '';
        $direction = $this->input->get('direction', TRUE) ?? 'ASC';
        $per_page_sort = $this->input->get('per_page_sort', TRUE) ?? 25;

        $this->_data['view_model'] = new User_card_admin_list_paginate_view_model(
            $this->user_card_model,
            $this->pagination,
            '/admin/user_card/0');
        $this->_data['view_model']->set_heading('User Card');
        $this->_data['view_model']->set_user_id(($this->input->get('user_id', TRUE) != NULL) ? $this->input->get('user_id', TRUE) : NULL);
		$this->_data['view_model']->set_last4(($this->input->get('last4', TRUE) != NULL) ? $this->input->get('last4', TRUE) : NULL);
		$this->_data['view_model']->set_is_default(($this->input->get('is_default', TRUE) != NULL) ? $this->input->get('is_default', TRUE) : NULL);
		
        $where = [
            'user_id' => $this->_data['view_model']->get_user_id(),
			'last4' => $this->_data['view_model']->get_last4(),
			'is_default' => $this->_data['view_model']->get_is_default(),
			
            
        ];

        $this->_data['view_model']->set_total_rows($this->user_card_model->count($where));

        $this->_data['view_model']->set_format_layout($this->_data['layout_clean_mode']);
        $this->_data['view_model']->set_per_page($per_page_sort);
        $this->_data['view_model']->set_order_by($order_by);
        $this->_data['view_model']->set_sort($direction);
        $this->_data['view_model']->set_sort_base_url('/admin/user_card/0');
        $this->_data['view_model']->set_page($page);
		$this->_data['view_model']->set_list($this->user_card_model->get_paginated(
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

        return $this->render('Admin/User_card', $this->_data);
	}

    

    

    

    

    

    

    

    

    

    
}