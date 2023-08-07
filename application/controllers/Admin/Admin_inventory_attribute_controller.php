<?php defined('BASEPATH') OR exit('No direct script access allowed');
include_once 'Admin_controller.php';
/*Powered By: Manaknightdigital Inc. https://manaknightdigital.com/ Year: 2021*/
/**
 * Inventory_attribute Controller
 * @copyright 2019 Manaknightdigital Inc.
 * @link https://manaknightdigital.com
 * @license Proprietary Software licensing
 * @author Ryan Wong
 *
 */
class Admin_inventory_attribute_controller extends Admin_controller
{
    protected $_model_file = 'inventory_attribute_model';
    public $_page_name = 'Inventory Attribute';

    public function __construct()
    {
        parent::__construct();
        
        
        
    }

    

    	public function index($page)
	{
        $this->load->library('pagination');
        include_once __DIR__ . '/../../view_models/Inventory_attribute_admin_list_paginate_view_model.php';
        $session = $this->get_session();
        $format = $this->input->get('format', TRUE) ?? 'view';
        $order_by = $this->input->get('order_by', TRUE) ?? '';
        $direction = $this->input->get('direction', TRUE) ?? 'ASC';
        $per_page_sort = $this->input->get('per_page_sort', TRUE) ?? 25;

        $this->_data['view_model'] = new Inventory_attribute_admin_list_paginate_view_model(
            $this->inventory_attribute_model,
            $this->pagination,
            '/admin/inventory_attribute/0');
        $this->_data['view_model']->set_heading('Inventory Attribute');
        $this->_data['view_model']->set_id(($this->input->get('id', TRUE) != NULL) ? $this->input->get('id', TRUE) : NULL);
		$this->_data['view_model']->set_inventory_id(($this->input->get('inventory_id', TRUE) != NULL) ? $this->input->get('inventory_id', TRUE) : NULL);
		$this->_data['view_model']->set_attribute_id(($this->input->get('attribute_id', TRUE) != NULL) ? $this->input->get('attribute_id', TRUE) : NULL);
		$this->_data['view_model']->set_value(($this->input->get('value', TRUE) != NULL) ? $this->input->get('value', TRUE) : NULL);
		
        $where = [
            'id' => $this->_data['view_model']->get_id(),
			'inventory_id' => $this->_data['view_model']->get_inventory_id(),
			'attribute_id' => $this->_data['view_model']->get_attribute_id(),
			'value' => $this->_data['view_model']->get_value(),
			
            
        ];

        $this->_data['view_model']->set_total_rows($this->inventory_attribute_model->count($where));

        $this->_data['view_model']->set_format_layout($this->_data['layout_clean_mode']);
        $this->_data['view_model']->set_per_page($per_page_sort);
        $this->_data['view_model']->set_order_by($order_by);
        $this->_data['view_model']->set_sort($direction);
        $this->_data['view_model']->set_sort_base_url('/admin/inventory_attribute/0');
        $this->_data['view_model']->set_page($page);
		$this->_data['view_model']->set_list($this->inventory_attribute_model->get_paginated(
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

        return $this->render('Admin/Inventory_attribute', $this->_data);
	}

    	public function add()
	{
        include_once __DIR__ . '/../../view_models/Inventory_attribute_admin_add_view_model.php';
        $session = $this->get_session();
        $this->form_validation = $this->inventory_attribute_model->set_form_validation(
        $this->form_validation, $this->inventory_attribute_model->get_all_validation_rule());
        $this->_data['view_model'] = new Inventory_attribute_admin_add_view_model($this->inventory_attribute_model);
        $this->_data['view_model']->set_heading('Inventory Attribute');
        
        
        
        
		if ($this->form_validation->run() === FALSE)
		{
			return $this->render('Admin/Inventory_attributeAdd', $this->_data);
        }

        $inventory_id = $this->input->post('inventory_id', TRUE);
		$attribute_id = $this->input->post('attribute_id', TRUE);
		$value = $this->input->post('value', TRUE);
		
        $result = $this->inventory_attribute_model->create([
            'inventory_id' => $inventory_id,
			'attribute_id' => $attribute_id,
			'value' => $value,
			
        ]);

        if ($result)
        {
            
            
            return $this->redirect('/admin/inventory_attribute/0', 'refresh');
        }

        $this->_data['error'] = 'Error';
        return $this->render('Admin/Inventory_attributeAdd', $this->_data);
	}

    	public function edit($id)
	{
        $model = $this->inventory_attribute_model->get($id);
        $session = $this->get_session();
		if (!$model)
		{
			$this->error('Error');
			return redirect('/admin/inventory_attribute/0');
        }

        include_once __DIR__ . '/../../view_models/Inventory_attribute_admin_edit_view_model.php';
        $this->form_validation = $this->inventory_attribute_model->set_form_validation(
        $this->form_validation, $this->inventory_attribute_model->get_all_edit_validation_rule());
        $this->_data['view_model'] = new Inventory_attribute_admin_edit_view_model($this->inventory_attribute_model);
        $this->_data['view_model']->set_model($model);
        $this->_data['view_model']->set_heading('Inventory Attribute');
        
        
        
        
		if ($this->form_validation->run() === FALSE)
		{
			return $this->render('Admin/Inventory_attributeEdit', $this->_data);
        }

        $inventory_id = $this->input->post('inventory_id', TRUE);
		$attribute_id = $this->input->post('attribute_id', TRUE);
		$value = $this->input->post('value', TRUE);
		
        $result = $this->inventory_attribute_model->edit([
            'inventory_id' => $inventory_id,
			'attribute_id' => $attribute_id,
			'value' => $value,
			
        ], $id);

        if ($result)
        {
            
            
            return $this->redirect('/admin/inventory_attribute/0', 'refresh');
        }

        $this->_data['error'] = 'Error';
        return $this->render('Admin/Inventory_attributeEdit', $this->_data);
	}

    	public function view($id)
	{
        $model = $this->inventory_attribute_model->get($id);

		if (!$model)
		{
			$this->error('Error');
			return redirect('/admin/inventory_attribute/0');
		}


        include_once __DIR__ . '/../../view_models/Inventory_attribute_admin_view_view_model.php';
		$this->_data['view_model'] = new Inventory_attribute_admin_view_view_model($this->inventory_attribute_model);
		$this->_data['view_model']->set_heading('Inventory Attribute');
        $this->_data['view_model']->set_model($model);
        
        
		return $this->render('Admin/Inventory_attributeView', $this->_data);
	}

      public function delete()
	{
    $id = $this->input->post('id', TRUE);

    if (!empty($id))
    {
      $model = $this->inventory_attribute_model->get($id);

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
        $result = $this->inventory_attribute_model->real_delete($id);

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
            $this->inventory_attribute_model->real_delete($id);
        }
        echo 'success';
        exit();
	}

    

    

    

    

    
}