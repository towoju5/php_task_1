<?php defined('BASEPATH') OR exit('No direct script access allowed');
include_once 'Admin_controller.php';
/*Powered By: Manaknightdigital Inc. https://manaknightdigital.com/ Year: 2021*/
/**
 * Payout Controller
 * @copyright 2019 Manaknightdigital Inc.
 * @link https://manaknightdigital.com
 * @license Proprietary Software licensing
 * @author Ryan Wong
 *
 */
class Admin_payout_controller extends Admin_controller
{
    protected $_model_file = 'payout_model';
    public $_page_name = 'Payout';

    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
        
        
    }

    

    	public function index($page)
	{
        $this->load->library('pagination');
        include_once __DIR__ . '/../../view_models/Payout_admin_list_paginate_view_model.php';
        $session = $this->get_session();
        $format = $this->input->get('format', TRUE) ?? 'view';
        $order_by = $this->input->get('order_by', TRUE) ?? '';
        $direction = $this->input->get('direction', TRUE) ?? 'ASC';
        $per_page_sort = $this->input->get('per_page_sort', TRUE) ?? 25;

        $this->_data['view_model'] = new Payout_admin_list_paginate_view_model(
            $this->payout_model,
            $this->pagination,
            '/admin/payout/0');
        $this->_data['view_model']->set_heading('Payout');
        $this->_data['view_model']->set_id(($this->input->get('id', TRUE) != NULL) ? $this->input->get('id', TRUE) : NULL);
		$this->_data['view_model']->set_order_id(($this->input->get('order_id', TRUE) != NULL) ? $this->input->get('order_id', TRUE) : NULL);
		$this->_data['view_model']->set_user_id(($this->input->get('user_id', TRUE) != NULL) ? $this->input->get('user_id', TRUE) : NULL);
		$this->_data['view_model']->set_amount(($this->input->get('amount', TRUE) != NULL) ? $this->input->get('amount', TRUE) : NULL);
		$this->_data['view_model']->set_status(($this->input->get('status', TRUE) != NULL) ? $this->input->get('status', TRUE) : NULL);
		
        $where = [
            'id' => $this->_data['view_model']->get_id(),
			'order_id' => $this->_data['view_model']->get_order_id(),
			'user_id' => $this->_data['view_model']->get_user_id(),
			'amount' => $this->_data['view_model']->get_amount(),
			'status' => $this->_data['view_model']->get_status(),
			
            
        ];

        $this->_data['view_model']->set_total_rows($this->payout_model->count($where));

        $this->_data['view_model']->set_format_layout($this->_data['layout_clean_mode']);
        $this->_data['view_model']->set_per_page($per_page_sort);
        $this->_data['view_model']->set_order_by($order_by);
        $this->_data['view_model']->set_sort($direction);
        $this->_data['view_model']->set_sort_base_url('/admin/payout/0');
        $this->_data['view_model']->set_page($page);
		$this->_data['view_model']->set_list($this->payout_model->get_paginated(
            $this->_data['view_model']->get_page(),
            $this->_data['view_model']->get_per_page(),
            $where,
            $order_by,
            $direction));

            $user_data = $this->user_model->get_all();
            $this->_data['users'] = $user_data;
            $user_id_array = [];
            $user_email_array = [];
            if($user_data){
                $user_id_array = array_column($user_data,'first_name','id');
                $user_email_array = array_column($user_data,'paypal_email','id');
            }
            // print_r($user_id_array);exit;
            if($this->_data['view_model']->get_list() ){

                foreach ( $this->_data['view_model']->get_list() as $key => &$value) {
                    $value->paypal_email = $user_email_array[$value->user_id] ?? '';
                    $value->user_id = $user_id_array[$value->user_id] ?? '';
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

        return $this->render('Admin/Payout', $this->_data);
	}
    public function paid($id){
        $this->payout_model->update('payout',['status'=>1],['id'=>$id]);
        
        $this->success('User paid successfully');     
        return redirect('admin/payout/0','refresh');
    }
    public function mark_all_paid(){

        if($_GET['id']){
            
            foreach ($_GET['id'] as $key => $value) {
                $this->payout_model->update('payout',['status'=>1],['id'=>$value]);
                
            }
        }
     
        
        $this->success('Bulk paid successfully');     
        return redirect('admin/payout/0','refresh');
    }
    

    

    

    

    

    

    

    

    

    
}