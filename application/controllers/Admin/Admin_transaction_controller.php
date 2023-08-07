<?php defined('BASEPATH') OR exit('No direct script access allowed');
include_once 'Admin_controller.php';
/*Powered By: Manaknightdigital Inc. https://manaknightdigital.com/ Year: 2021*/
/**
 * Transaction Controller
 * @copyright 2019 Manaknightdigital Inc.
 * @link https://manaknightdigital.com
 * @license Proprietary Software licensing
 * @author Ryan Wong
 *
 */
class Admin_transaction_controller extends Admin_controller
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
        include_once __DIR__ . '/../../view_models/Transaction_admin_list_paginate_view_model.php';
        $session = $this->get_session();
        $format = $this->input->get('format', TRUE) ?? 'view';
        $order_by = $this->input->get('order_by', TRUE) ?? '';
        $direction = $this->input->get('direction', TRUE) ?? 'ASC';
        $per_page_sort = $this->input->get('per_page_sort', TRUE) ?? 25;

        $this->_data['view_model'] = new Transaction_admin_list_paginate_view_model(
            $this->transaction_model,
            $this->pagination,
            '/admin/transaction/0');
        $this->_data['view_model']->set_heading('Transaction');
        $this->_data['view_model']->set_id(($this->input->get('id', TRUE) != NULL) ? $this->input->get('id', TRUE) : NULL);
		$this->_data['view_model']->set_payment_method(($this->input->get('payment_method', TRUE) != NULL) ? $this->input->get('payment_method', TRUE) : NULL);
		$this->_data['view_model']->set_order_id(($this->input->get('order_id', TRUE) != NULL) ? $this->input->get('order_id', TRUE) : NULL);
		$this->_data['view_model']->set_transaction_date(($this->input->get('transaction_date', TRUE) != NULL) ? $this->input->get('transaction_date', TRUE) : NULL);
		$this->_data['view_model']->set_transaction_time(($this->input->get('transaction_time', TRUE) != NULL) ? $this->input->get('transaction_time', TRUE) : NULL);
		$this->_data['view_model']->set_user_id(($this->input->get('user_id', TRUE) != NULL) ? $this->input->get('user_id', TRUE) : NULL);
		$this->_data['view_model']->set_tax(($this->input->get('tax', TRUE) != NULL) ? $this->input->get('tax', TRUE) : NULL);
		$this->_data['view_model']->set_discount(($this->input->get('discount', TRUE) != NULL) ? $this->input->get('discount', TRUE) : NULL);
		$this->_data['view_model']->set_subtotal(($this->input->get('subtotal', TRUE) != NULL) ? $this->input->get('subtotal', TRUE) : NULL);
		$this->_data['view_model']->set_total(($this->input->get('total', TRUE) != NULL) ? $this->input->get('total', TRUE) : NULL);
		$this->_data['view_model']->set_status(($this->input->get('status', TRUE) != NULL) ? $this->input->get('status', TRUE) : NULL);
		
        $where = [
            'id' => $this->_data['view_model']->get_id(),
			'payment_method' => $this->_data['view_model']->get_payment_method(),
			'order_id' => $this->_data['view_model']->get_order_id(),
			'transaction_date' => $this->_data['view_model']->get_transaction_date(),
			'transaction_time' => $this->_data['view_model']->get_transaction_time(),
			'user_id' => $this->_data['view_model']->get_user_id(),
			'tax' => $this->_data['view_model']->get_tax(),
			'discount' => $this->_data['view_model']->get_discount(),
			'subtotal' => $this->_data['view_model']->get_subtotal(),
			'total' => $this->_data['view_model']->get_total(),
			'status' => $this->_data['view_model']->get_status(),
			
            
        ];

        $this->_data['view_model']->set_total_rows($this->transaction_model->count($where));

        $this->_data['view_model']->set_format_layout($this->_data['layout_clean_mode']);
        $this->_data['view_model']->set_per_page($per_page_sort);
        $this->_data['view_model']->set_order_by($order_by);
        $this->_data['view_model']->set_sort($direction);
        $this->_data['view_model']->set_sort_base_url('/admin/transaction/0');
        $this->_data['view_model']->set_page($page);
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

        return $this->render('Admin/Transaction', $this->_data);
	}

    	public function add()
	{
        include_once __DIR__ . '/../../view_models/Transaction_admin_add_view_model.php';
        $session = $this->get_session();
        $this->form_validation = $this->transaction_model->set_form_validation(
        $this->form_validation, $this->transaction_model->get_all_validation_rule());
        $this->_data['view_model'] = new Transaction_admin_add_view_model($this->transaction_model);
        $this->_data['view_model']->set_heading('Transaction');
        
        
        
        
		if ($this->form_validation->run() === FALSE)
		{
			return $this->render('Admin/TransactionAdd', $this->_data);
        }

        $payment_method = $this->input->post('payment_method', TRUE);
		$order_id = $this->input->post('order_id', TRUE);
		$transaction_date = $this->input->post('transaction_date', TRUE);
		$transaction_time = $this->input->post('transaction_time', TRUE);
		$user_id = $this->input->post('user_id', TRUE);
		$tax = $this->input->post('tax', TRUE);
		$discount = $this->input->post('discount', TRUE);
		$subtotal = $this->input->post('subtotal', TRUE);
		$total = $this->input->post('total', TRUE);
		$status = $this->input->post('status', TRUE);
		
        $result = $this->transaction_model->create([
            'payment_method' => $payment_method,
			'order_id' => $order_id,
			'transaction_date' => $transaction_date,
			'transaction_time' => $transaction_time,
			'user_id' => $user_id,
			'tax' => $tax,
			'discount' => $discount,
			'subtotal' => $subtotal,
			'total' => $total,
			'status' => $status,
			
        ]);

        if ($result)
        {
            
            
            return $this->redirect('/admin/transaction/0', 'refresh');
        }

        $this->_data['error'] = 'Error';
        return $this->render('Admin/TransactionAdd', $this->_data);
	}

    	public function edit($id)
	{
        $model = $this->transaction_model->get($id);
        $session = $this->get_session();
		if (!$model)
		{
			$this->error('Error');
			return redirect('/admin/transaction/0');
        }

        include_once __DIR__ . '/../../view_models/Transaction_admin_edit_view_model.php';
        $this->form_validation = $this->transaction_model->set_form_validation(
        $this->form_validation, $this->transaction_model->get_all_edit_validation_rule());
        $this->_data['view_model'] = new Transaction_admin_edit_view_model($this->transaction_model);
        $this->_data['view_model']->set_model($model);
        $this->_data['view_model']->set_heading('Transaction');
        
        
        
        
		if ($this->form_validation->run() === FALSE)
		{
			return $this->render('Admin/TransactionEdit', $this->_data);
        }

        $payment_method = $this->input->post('payment_method', TRUE);
		$order_id = $this->input->post('order_id', TRUE);
		$transaction_date = $this->input->post('transaction_date', TRUE);
		$transaction_time = $this->input->post('transaction_time', TRUE);
		$user_id = $this->input->post('user_id', TRUE);
		$tax = $this->input->post('tax', TRUE);
		$discount = $this->input->post('discount', TRUE);
		$subtotal = $this->input->post('subtotal', TRUE);
		$total = $this->input->post('total', TRUE);
		$status = $this->input->post('status', TRUE);
		
        $result = $this->transaction_model->edit([
            'payment_method' => $payment_method,
			'order_id' => $order_id,
			'transaction_date' => $transaction_date,
			'transaction_time' => $transaction_time,
			'user_id' => $user_id,
			'tax' => $tax,
			'discount' => $discount,
			'subtotal' => $subtotal,
			'total' => $total,
			'status' => $status,
			
        ], $id);

        if ($result)
        {
            
            
            return $this->redirect('/admin/transaction/0', 'refresh');
        }

        $this->_data['error'] = 'Error';
        return $this->render('Admin/TransactionEdit', $this->_data);
	}

    	public function view($id)
	{
        $model = $this->transaction_model->get($id);

		if (!$model)
		{
			$this->error('Error');
			return redirect('/admin/transaction/0');
		}


        include_once __DIR__ . '/../../view_models/Transaction_admin_view_view_model.php';
		$this->_data['view_model'] = new Transaction_admin_view_view_model($this->transaction_model);
		$this->_data['view_model']->set_heading('Transaction');
        $this->_data['view_model']->set_model($model);
        
        
		return $this->render('Admin/TransactionView', $this->_data);
	}

      public function delete()
	{
    $id = $this->input->post('id', TRUE);

    if (!empty($id))
    {
      $model = $this->transaction_model->get($id);

      if (!$model)
      {
        $output['error']  = TRUE;
        $output['status'] = 404;
        $output['msg']    = 'Error! Data not found.';
        echo json_encode($output);
        exit();
      }
      else
      {
        $result = $this->transaction_model->real_delete($id);

        if ($result)
        {
          $output['success'] = TRUE;
          $output['status']  = 200;
          $output['msg']     = 'Deleted successfully.';
          echo json_encode($output);
          exit();
        }
        else
        {
          $output['error']  = TRUE;
          $output['status'] = 500;
          $output['msg']    = 'Error! Please try again later.';
          echo json_encode($output);
          exit();
        }
      }
    }
    else
    {
      $output['error']  = TRUE;
      $output['status'] = 0;
      $output['msg']    = 'Error! ID not found.';
      echo json_encode($output);
      exit();
    }
	}

    	public function bulk_delete()
	{
        
        $bulk_items = $this->input->post('bulk_items');
        foreach ($bulk_items as $key => $id) {
            $this->transaction_model->real_delete($id);
        }
        echo 'success';
        exit();
	}

    

    

    

    

    
}