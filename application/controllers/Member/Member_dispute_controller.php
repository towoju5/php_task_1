<?php defined('BASEPATH') OR exit('No direct script access allowed');
include_once 'Member_controller.php';
/*Powered By: Manaknightdigital Inc. https://manaknightdigital.com/ Year: 2021*/
/**
 * Dispute Controller
 * @copyright 2019 Manaknightdigital Inc.
 * @link https://manaknightdigital.com
 * @license Proprietary Software licensing
 * @author Ryan Wong
 *
 */
class Member_dispute_controller extends Member_controller
{
    protected $_model_file = 'dispute_model';
    public $_page_name = 'Dispute';

    public function __construct()
    {
        parent::__construct();
        
        
        
    }

    

    	public function index($page)
	{
        $this->load->library('pagination');
        include_once __DIR__ . '/../../view_models/Dispute_member_list_paginate_view_model.php';
        $session = $this->get_session();
        $format = $this->input->get('format', TRUE) ?? 'view';
        $order_by = $this->input->get('order_by', TRUE) ?? '';
        $direction = $this->input->get('direction', TRUE) ?? 'ASC';
        $per_page_sort = $this->input->get('per_page_sort', TRUE) ?? 25;

        $this->_data['view_model'] = new Dispute_member_list_paginate_view_model(
            $this->dispute_model,
            $this->pagination,
            '/member/dispute/0');
        $this->_data['view_model']->set_heading('Dispute');
        $this->_data['view_model']->set_id(($this->input->get('id', TRUE) != NULL) ? $this->input->get('id', TRUE) : NULL);
		$this->_data['view_model']->set_order_id(($this->input->get('order_id', TRUE) != NULL) ? $this->input->get('order_id', TRUE) : NULL);
		$this->_data['view_model']->set_user_id(($this->input->get('user_id', TRUE) != NULL) ? $this->input->get('user_id', TRUE) : NULL);
		$this->_data['view_model']->set_reason(($this->input->get('reason', TRUE) != NULL) ? $this->input->get('reason', TRUE) : NULL);
		$this->_data['view_model']->set_stripe_charge_id(($this->input->get('stripe_charge_id', TRUE) != NULL) ? $this->input->get('stripe_charge_id', TRUE) : NULL);
		$this->_data['view_model']->set_stripe_dispute_id(($this->input->get('stripe_dispute_id', TRUE) != NULL) ? $this->input->get('stripe_dispute_id', TRUE) : NULL);
		$this->_data['view_model']->set_status(($this->input->get('status', TRUE) != NULL) ? $this->input->get('status', TRUE) : NULL);
		
        $where = [
            'id' => $this->_data['view_model']->get_id(),
			'order_id' => $this->_data['view_model']->get_order_id(),
			'user_id' => $this->_data['view_model']->get_user_id(),
			'reason' => $this->_data['view_model']->get_reason(),
			'stripe_charge_id' => $this->_data['view_model']->get_stripe_charge_id(),
			'stripe_dispute_id' => $this->_data['view_model']->get_stripe_dispute_id(),
			'status' => $this->_data['view_model']->get_status(),
			
            
        ];

        $this->_data['view_model']->set_total_rows($this->dispute_model->count($where));

        $this->_data['view_model']->set_format_layout($this->_data['layout_clean_mode']);
        $this->_data['view_model']->set_per_page($per_page_sort);
        $this->_data['view_model']->set_order_by($order_by);
        $this->_data['view_model']->set_sort($direction);
        $this->_data['view_model']->set_sort_base_url('/member/dispute/0');
        $this->_data['view_model']->set_page($page);
		$this->_data['view_model']->set_list($this->dispute_model->get_paginated(
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

        return $this->render('Member/Dispute', $this->_data);
	}

    

    

    	public function view($id)
	{
        $model = $this->dispute_model->get($id);

		if (!$model)
		{
			$this->error('Error');
			return redirect('/member/dispute/0');
		}


        include_once __DIR__ . '/../../view_models/Dispute_member_view_view_model.php';
		$this->_data['view_model'] = new Dispute_member_view_view_model($this->dispute_model);
		$this->_data['view_model']->set_heading('Dispute');
        $this->_data['view_model']->set_model($model);
        
        
		return $this->render('Member/DisputeView', $this->_data);
	}

    

    

    

    

    

    

    
}