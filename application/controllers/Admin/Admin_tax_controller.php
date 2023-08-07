<?php defined('BASEPATH') OR exit('No direct script access allowed');
include_once 'Admin_controller.php';
/*Powered By: Manaknightdigital Inc. https://manaknightdigital.com/ Year: 2021*/
/**
 * Tax Controller
 * @copyright 2019 Manaknightdigital Inc.
 * @link https://manaknightdigital.com
 * @license Proprietary Software licensing
 * @author Ryan Wong
 *
 */
class Admin_tax_controller extends Admin_controller
{
    protected $_model_file = 'tax_model';
    public $_page_name = 'Tax';

    public function __construct()
    {
        parent::__construct();
        
        
        
    }

    

    	public function index($page)
	{
        $this->load->library('pagination');
        include_once __DIR__ . '/../../view_models/Tax_admin_list_paginate_view_model.php';
        $format = $this->input->get('format', TRUE) ?? 'view';
        $order_by = $this->input->get('order_by', TRUE) ?? '';
        $direction = $this->input->get('direction', TRUE) ?? 'ASC';
        $per_page_sort = $this->input->get('per_page_sort', TRUE) ?? 25;
        $session = $this->get_session();
        $where = [];
        $this->_data['view_model'] = new Tax_admin_list_paginate_view_model(
            $this->tax_model,
            $this->pagination,
            '/admin/tax/0');
        $this->_data['view_model']->set_heading('Tax');
        $this->_data['view_model']->set_total_rows($this->tax_model->count($where));

        $this->_data['view_model']->set_per_page($per_page_sort);
        $this->_data['view_model']->set_page($page);
        $this->_data['view_model']->set_order_by($order_by);
        $this->_data['view_model']->set_sort($direction);
        $this->_data['view_model']->set_sort_base_url('/admin/tax/0');
		$this->_data['view_model']->set_list($this->tax_model->get_paginated(
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

        return $this->render('Admin/Tax', $this->_data);
	}

    	public function add()
	{
        include_once __DIR__ . '/../../view_models/Tax_admin_add_view_model.php';
        $session = $this->get_session();
        $this->form_validation = $this->tax_model->set_form_validation(
        $this->form_validation, $this->tax_model->get_all_validation_rule());
        $this->_data['view_model'] = new Tax_admin_add_view_model($this->tax_model);
        $this->_data['view_model']->set_heading('Tax');
        
        
        
        
		if ($this->form_validation->run() === FALSE)
		{
			return $this->render('Admin/TaxAdd', $this->_data);
        }

        $tax = $this->input->post('tax', TRUE);
		
        $result = $this->tax_model->create([
            'tax' => $tax,
			
        ]);

        if ($result)
        {
            
            
            return $this->redirect('/admin/tax/0', 'refresh');
        }

        $this->_data['error'] = 'Error';
        return $this->render('Admin/TaxAdd', $this->_data);
	}

    	public function edit($id)
	{
        $model = $this->tax_model->get($id);
        $session = $this->get_session();
		if (!$model)
		{
			$this->error('Error');
			return redirect('/admin/tax/0');
        }

        include_once __DIR__ . '/../../view_models/Tax_admin_edit_view_model.php';
        $this->form_validation = $this->tax_model->set_form_validation(
        $this->form_validation, $this->tax_model->get_all_edit_validation_rule());
        $this->_data['view_model'] = new Tax_admin_edit_view_model($this->tax_model);
        $this->_data['view_model']->set_model($model);
        $this->_data['view_model']->set_heading('Tax');
        
        
        
        
		if ($this->form_validation->run() === FALSE)
		{
			return $this->render('Admin/TaxEdit', $this->_data);
        }

        $tax = $this->input->post('tax', TRUE);
		
        $result = $this->tax_model->edit([
            'tax' => $tax,
			
        ], $id);

        if ($result)
        {
            
            
            return $this->redirect('/admin/tax/0', 'refresh');
        }

        $this->_data['error'] = 'Error';
        return $this->render('Admin/TaxEdit', $this->_data);
	}

    	public function view($id)
	{
        $model = $this->tax_model->get($id);

		if (!$model)
		{
			$this->error('Error');
			return redirect('/admin/tax/0');
		}


        include_once __DIR__ . '/../../view_models/Tax_admin_view_view_model.php';
		$this->_data['view_model'] = new Tax_admin_view_view_model($this->tax_model);
		$this->_data['view_model']->set_heading('Tax');
        $this->_data['view_model']->set_model($model);
        
        
		return $this->render('Admin/TaxView', $this->_data);
	}

      public function delete()
	{
    $id = $this->input->post('id', TRUE);

    if (!empty($id))
    {
      $model = $this->tax_model->get($id);

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
        $result = $this->tax_model->real_delete($id);

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

    

    

    

    

    

    
}