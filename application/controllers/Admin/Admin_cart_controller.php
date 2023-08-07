<?php defined('BASEPATH') OR exit('No direct script access allowed');
include_once 'Admin_controller.php';
/*Powered By: Manaknightdigital Inc. https://manaknightdigital.com/ Year: 2021*/
/**
 * Cart Controller
 * @copyright 2019 Manaknightdigital Inc.
 * @link https://manaknightdigital.com
 * @license Proprietary Software licensing
 * @author Ryan Wong
 *
 */
class Admin_cart_controller extends Admin_controller
{
    protected $_model_file = 'cart_model';
    public $_page_name = 'Cart';

    public function __construct()
    {
        parent::__construct();
        
        
        
    }

    

    	public function index($page)
	{
        $this->load->library('pagination');
        include_once __DIR__ . '/../../view_models/Cart_admin_list_paginate_view_model.php';
        $format = $this->input->get('format', TRUE) ?? 'view';
        $order_by = $this->input->get('order_by', TRUE) ?? '';
        $direction = $this->input->get('direction', TRUE) ?? 'ASC';
        $per_page_sort = $this->input->get('per_page_sort', TRUE) ?? 25;
        $session = $this->get_session();
        $where = [];
        $this->_data['view_model'] = new Cart_admin_list_paginate_view_model(
            $this->cart_model,
            $this->pagination,
            '/admin/cart/0');
        $this->_data['view_model']->set_heading('Cart');
        $this->_data['view_model']->set_total_rows($this->cart_model->count($where));

        $this->_data['view_model']->set_per_page($per_page_sort);
        $this->_data['view_model']->set_page($page);
        $this->_data['view_model']->set_order_by($order_by);
        $this->_data['view_model']->set_sort($direction);
        $this->_data['view_model']->set_sort_base_url('/admin/cart/0');
		$this->_data['view_model']->set_list($this->cart_model->get_paginated(
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

        return $this->render('Admin/Cart', $this->_data);
	}

    	public function add()
	{
        include_once __DIR__ . '/../../view_models/Cart_admin_add_view_model.php';
        $session = $this->get_session();
        $this->form_validation = $this->cart_model->set_form_validation(
        $this->form_validation, $this->cart_model->get_all_validation_rule());
        $this->_data['view_model'] = new Cart_admin_add_view_model($this->cart_model);
        $this->_data['view_model']->set_heading('Cart');
        
        
        
        
		if ($this->form_validation->run() === FALSE)
		{
			return $this->render('Admin/CartAdd', $this->_data);
        }

        $product_id = $this->input->post('product_id', TRUE);
		$user_id = $this->input->post('user_id', TRUE);
		$session_id = $this->input->post('session_id', TRUE);
		$subtotal = $this->input->post('subtotal', TRUE);
		$quantity = $this->input->post('quantity', TRUE);
		$total = $this->input->post('total', TRUE);
		
        $result = $this->cart_model->create([
            'product_id' => $product_id,
			'user_id' => $user_id,
			'session_id' => $session_id,
			'subtotal' => $subtotal,
			'quantity' => $quantity,
			'total' => $total,
			
        ]);

        if ($result)
        {
            
            
            return $this->redirect('/admin/cart/0', 'refresh');
        }

        $this->_data['error'] = 'Error';
        return $this->render('Admin/CartAdd', $this->_data);
	}

    	public function edit($id)
	{
        $model = $this->cart_model->get($id);
        $session = $this->get_session();
		if (!$model)
		{
			$this->error('Error');
			return redirect('/admin/cart/0');
        }

        include_once __DIR__ . '/../../view_models/Cart_admin_edit_view_model.php';
        $this->form_validation = $this->cart_model->set_form_validation(
        $this->form_validation, $this->cart_model->get_all_edit_validation_rule());
        $this->_data['view_model'] = new Cart_admin_edit_view_model($this->cart_model);
        $this->_data['view_model']->set_model($model);
        $this->_data['view_model']->set_heading('Cart');
        
        
        
        
		if ($this->form_validation->run() === FALSE)
		{
			return $this->render('Admin/CartEdit', $this->_data);
        }

        $product_id = $this->input->post('product_id', TRUE);
		$user_id = $this->input->post('user_id', TRUE);
		$session_id = $this->input->post('session_id', TRUE);
		$subtotal = $this->input->post('subtotal', TRUE);
		$quantity = $this->input->post('quantity', TRUE);
		$total = $this->input->post('total', TRUE);
		
        $result = $this->cart_model->edit([
            'product_id' => $product_id,
			'user_id' => $user_id,
			'session_id' => $session_id,
			'subtotal' => $subtotal,
			'quantity' => $quantity,
			'total' => $total,
			
        ], $id);

        if ($result)
        {
            
            
            return $this->redirect('/admin/cart/0', 'refresh');
        }

        $this->_data['error'] = 'Error';
        return $this->render('Admin/CartEdit', $this->_data);
	}

    	public function view($id)
	{
        $model = $this->cart_model->get($id);

		if (!$model)
		{
			$this->error('Error');
			return redirect('/admin/cart/0');
		}


        include_once __DIR__ . '/../../view_models/Cart_admin_view_view_model.php';
		$this->_data['view_model'] = new Cart_admin_view_view_model($this->cart_model);
		$this->_data['view_model']->set_heading('Cart');
        $this->_data['view_model']->set_model($model);
        
        
		return $this->render('Admin/CartView', $this->_data);
	}

    	public function delete($id)
	{
        $model = $this->cart_model->get($id);
        $session = $this->get_session();
		if (!$model)
		{
			$this->error('Error');
			return redirect('/admin/cart/0');
        }
        
        $result = $this->cart_model->delete($id);

        if ($result)
        {
            
            return $this->redirect('/admin/cart/0', 'refresh');
        }

        $this->error('Error');
        return redirect('/admin/cart/0');
	}

    

    

    

    

    

    
}