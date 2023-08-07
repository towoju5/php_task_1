<?php defined('BASEPATH') OR exit('No direct script access allowed');
include_once 'Admin_controller.php';
/*Powered By: Manaknightdigital Inc. https://manaknightdigital.com/ Year: 2021*/
/**
 * Category Controller
 * @copyright 2019 Manaknightdigital Inc.
 * @link https://manaknightdigital.com
 * @license Proprietary Software licensing
 * @author Ryan Wong
 *
 */
class Admin_category_controller extends Admin_controller
{
    protected $_model_file = 'category_model';
    public $_page_name = 'Category';

    public function __construct()
    {
        parent::__construct();
        
        
        
    }

    

    	public function index($page)
	{
        $this->load->library('pagination');
        include_once __DIR__ . '/../../view_models/Category_admin_list_paginate_view_model.php';
        $session = $this->get_session();
        $format = $this->input->get('format', TRUE) ?? 'view';
        $order_by = $this->input->get('order_by', TRUE) ?? '';
        $direction = $this->input->get('direction', TRUE) ?? 'ASC';
        $per_page_sort = $this->input->get('per_page_sort', TRUE) ?? 25;

        $this->_data['view_model'] = new Category_admin_list_paginate_view_model(
            $this->category_model,
            $this->pagination,
            '/admin/category/0');
        $this->_data['view_model']->set_heading('Category');
        $this->_data['view_model']->set_id(($this->input->get('id', TRUE) != NULL) ? $this->input->get('id', TRUE) : NULL);
		$this->_data['view_model']->set_name(($this->input->get('name', TRUE) != NULL) ? $this->input->get('name', TRUE) : NULL);
		$this->_data['view_model']->set_status(($this->input->get('status', TRUE) != NULL) ? $this->input->get('status', TRUE) : NULL);
		
        $where = [
            'id' => $this->_data['view_model']->get_id(),
			'name' => $this->_data['view_model']->get_name(),
			'status' => $this->_data['view_model']->get_status(),
			
            
        ];

        $this->_data['view_model']->set_total_rows($this->category_model->count($where));

        $this->_data['view_model']->set_format_layout($this->_data['layout_clean_mode']);
        $this->_data['view_model']->set_per_page($per_page_sort);
        $this->_data['view_model']->set_order_by($order_by);
        $this->_data['view_model']->set_sort($direction);
        $this->_data['view_model']->set_sort_base_url('/admin/category/0');
        $this->_data['view_model']->set_page($page);
		$this->_data['view_model']->set_list($this->category_model->get_paginated(
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

        return $this->render('Admin/Category', $this->_data);
	}

    	public function add()
	{
        include_once __DIR__ . '/../../view_models/Category_admin_add_view_model.php';
        $session = $this->get_session();
        $this->form_validation = $this->category_model->set_form_validation(
        $this->form_validation, $this->category_model->get_all_validation_rule());
        $this->_data['view_model'] = new Category_admin_add_view_model($this->category_model);
        $this->_data['view_model']->set_heading('Category');
        
        
        
        
		if ($this->form_validation->run() === FALSE)
		{
			return $this->render('Admin/CategoryAdd', $this->_data);
        }

        $name = $this->input->post('name', TRUE);
		$status = $this->input->post('status', TRUE);
		
        $result = $this->category_model->create([
            'name' => $name,
			'status' => $status,
			
        ]);

        if ($result)
        {
            $this->success('Category added.');
            
            return $this->redirect('/admin/category/0', 'refresh');
        }

        $this->_data['error'] = 'Error';
        return $this->render('Admin/CategoryAdd', $this->_data);
	}

    	public function edit($id)
	{
        $model = $this->category_model->get($id);
        $session = $this->get_session();
		if (!$model)
		{
			$this->error('Error');
			return redirect('/admin/category/0');
        }

        include_once __DIR__ . '/../../view_models/Category_admin_edit_view_model.php';
        $this->form_validation = $this->category_model->set_form_validation(
        $this->form_validation, $this->category_model->get_all_edit_validation_rule());
        $this->_data['view_model'] = new Category_admin_edit_view_model($this->category_model);
        $this->_data['view_model']->set_model($model);
        $this->_data['view_model']->set_heading('Category');
        
        
        
        
		if ($this->form_validation->run() === FALSE)
		{
			return $this->render('Admin/CategoryEdit', $this->_data);
        }

        $name = $this->input->post('name', TRUE);
		$status = $this->input->post('status', TRUE);
		
        $result = $this->category_model->edit([
            'name' => $name,
			'status' => $status,
			
        ], $id);

        if ($result)
        {
            $this->success('Category updated.');
            
            return $this->redirect('/admin/category/0', 'refresh');
        }

        $this->_data['error'] = 'Error';
        return $this->render('Admin/CategoryEdit', $this->_data);
	}

    

      public function delete()
	{
    $id = $this->input->post('id', TRUE);

    if (!empty($id))
    {
      $model = $this->category_model->get($id);

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
        $result = $this->category_model->real_delete($id);

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