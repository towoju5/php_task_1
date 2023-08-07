<?php defined('BASEPATH') OR exit('No direct script access allowed');
include_once 'Member_controller.php';
/*Powered By: Manaknightdigital Inc. https://manaknightdigital.com/ Year: 2021*/
/**
 * Transaction Controller
 * @copyright 2019 Manaknightdigital Inc.
 * @link https://manaknightdigital.com
 * @license Proprietary Software licensing
 * @author Ryan Wong
 *
 */
class Member_transaction_controller extends Member_controller
{
    protected $_model_file = 'transaction_model';
    public $_page_name = 'Transaction';

    public function __construct()
    {
        parent::__construct();
        
        
        
    }

    

    	public function index($page)
	{
        $this->load->library('pagination');
        include_once __DIR__ . '/../../view_models/Transaction_member_list_paginate_view_model.php';
        $format = $this->input->get('format', TRUE) ?? 'view';
        $order_by = $this->input->get('order_by', TRUE) ?? '';
        $direction = $this->input->get('direction', TRUE) ?? 'ASC';
        $per_page_sort = $this->input->get('per_page_sort', TRUE) ?? 25;
        $session = $this->get_session();
        $where = [];
        $this->_data['view_model'] = new Transaction_member_list_paginate_view_model(
            $this->transaction_model,
            $this->pagination,
            '/member/transaction/0');
        $this->_data['view_model']->set_heading('Transaction');
        $this->_data['view_model']->set_total_rows($this->transaction_model->count($where));

        $this->_data['view_model']->set_per_page($per_page_sort);
        $this->_data['view_model']->set_page($page);
        $this->_data['view_model']->set_order_by($order_by);
        $this->_data['view_model']->set_sort($direction);
        $this->_data['view_model']->set_sort_base_url('/member/transaction/0');
		$this->_data['view_model']->set_list($this->transaction_model->get_paginated(
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

        return $this->render('Member/Transaction', $this->_data);
	}

    	public function add()
	{
        include_once __DIR__ . '/../../view_models/Transaction_member_add_view_model.php';
        $session = $this->get_session();
        $this->form_validation = $this->transaction_model->set_form_validation(
        $this->form_validation, $this->transaction_model->get_all_validation_rule());
        $this->_data['view_model'] = new Transaction_member_add_view_model($this->transaction_model);
        $this->_data['view_model']->set_heading('Transaction');
        
        
        
        
		if ($this->form_validation->run() === FALSE)
		{
			return $this->render('Member/TransactionAdd', $this->_data);
        }

        $order_id = $this->input->post('order_id', TRUE);
		$user_id = $this->input->post('user_id', TRUE);
		$transaction_date = $this->input->post('transaction_date', TRUE);
		$transaction_time = $this->input->post('transaction_time', TRUE);
		$subtotal = $this->input->post('subtotal', TRUE);
		$tax = $this->input->post('tax', TRUE);
		$discount = $this->input->post('discount', TRUE);
		$total = $this->input->post('total', TRUE);
		$stripe_charge_id = $this->input->post('stripe_charge_id', TRUE);
		$payment_method = $this->input->post('payment_method', TRUE);
		$status = $this->input->post('status', TRUE);
		
        $result = $this->transaction_model->create([
            'order_id' => $order_id,
			'user_id' => $user_id,
			'transaction_date' => $transaction_date,
			'transaction_time' => $transaction_time,
			'subtotal' => $subtotal,
			'tax' => $tax,
			'discount' => $discount,
			'total' => $total,
			'stripe_charge_id' => $stripe_charge_id,
			'payment_method' => $payment_method,
			'status' => $status,
			
        ]);

        if ($result)
        {
            
            
            return $this->redirect('/member/transaction/0', 'refresh');
        }

        $this->_data['error'] = 'Error';
        return $this->render('Member/TransactionAdd', $this->_data);
	}

    	public function edit($id)
	{
        $model = $this->transaction_model->get($id);
        $session = $this->get_session();
		if (!$model)
		{
			$this->error('Error');
			return redirect('/member/transaction/0');
        }

        include_once __DIR__ . '/../../view_models/Transaction_member_edit_view_model.php';
        $this->form_validation = $this->transaction_model->set_form_validation(
        $this->form_validation, $this->transaction_model->get_all_edit_validation_rule());
        $this->_data['view_model'] = new Transaction_member_edit_view_model($this->transaction_model);
        $this->_data['view_model']->set_model($model);
        $this->_data['view_model']->set_heading('Transaction');
        
        
        
        
		if ($this->form_validation->run() === FALSE)
		{
			return $this->render('Member/TransactionEdit', $this->_data);
        }

        $order_id = $this->input->post('order_id', TRUE);
		$user_id = $this->input->post('user_id', TRUE);
		$transaction_date = $this->input->post('transaction_date', TRUE);
		$transaction_time = $this->input->post('transaction_time', TRUE);
		$subtotal = $this->input->post('subtotal', TRUE);
		$tax = $this->input->post('tax', TRUE);
		$discount = $this->input->post('discount', TRUE);
		$total = $this->input->post('total', TRUE);
		$stripe_charge_id = $this->input->post('stripe_charge_id', TRUE);
		$payment_method = $this->input->post('payment_method', TRUE);
		$status = $this->input->post('status', TRUE);
		
        $result = $this->transaction_model->edit([
            'order_id' => $order_id,
			'user_id' => $user_id,
			'transaction_date' => $transaction_date,
			'transaction_time' => $transaction_time,
			'subtotal' => $subtotal,
			'tax' => $tax,
			'discount' => $discount,
			'total' => $total,
			'stripe_charge_id' => $stripe_charge_id,
			'payment_method' => $payment_method,
			'status' => $status,
			
        ], $id);

        if ($result)
        {
            
            
            return $this->redirect('/member/transaction/0', 'refresh');
        }

        $this->_data['error'] = 'Error';
        return $this->render('Member/TransactionEdit', $this->_data);
	}

    	public function view($id)
	{
        $model = $this->transaction_model->get($id);

		if (!$model)
		{
			$this->error('Error');
			return redirect('/member/transaction/0');
		}


        include_once __DIR__ . '/../../view_models/Transaction_member_view_view_model.php';
		$this->_data['view_model'] = new Transaction_member_view_view_model($this->transaction_model);
		$this->_data['view_model']->set_heading('Transaction');
        $this->_data['view_model']->set_model($model);
        
        
		return $this->render('Member/TransactionView', $this->_data);
	}

    	public function delete($id)
	{
        $model = $this->transaction_model->get($id);
        $session = $this->get_session();
		if (!$model)
		{
			$this->error('Error');
			return redirect('/member/transaction/0');
        }
        
        $result = $this->transaction_model->delete($id);

        if ($result)
        {
            
            return $this->redirect('/member/transaction/0', 'refresh');
        }

        $this->error('Error');
        return redirect('/member/transaction/0');
	}

    

    

    

    

    

    
}