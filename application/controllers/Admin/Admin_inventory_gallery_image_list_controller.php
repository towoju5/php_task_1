<?php defined('BASEPATH') OR exit('No direct script access allowed');
include_once 'Admin_controller.php';
/*Powered By: Manaknightdigital Inc. https://manaknightdigital.com/ Year: 2021*/
/**
 * Inventory_gallery_image_list Controller
 * @copyright 2019 Manaknightdigital Inc.
 * @link https://manaknightdigital.com
 * @license Proprietary Software licensing
 * @author Ryan Wong
 *
 */
class Admin_inventory_gallery_image_list_controller extends Admin_controller
{
    protected $_model_file = 'inventory_gallery_image_list_model';
    public $_page_name = 'Inventory_gallery_image_list';

    public function __construct()
    {
        parent::__construct();
        
        
        
    }

    

    	public function index($page)
	{
        $this->load->library('pagination');
        include_once __DIR__ . '/../../view_models/Inventory_gallery_image_list_admin_list_paginate_view_model.php';
        $format = $this->input->get('format', TRUE) ?? 'view';
        $order_by = $this->input->get('order_by', TRUE) ?? '';
        $direction = $this->input->get('direction', TRUE) ?? 'ASC';
        $per_page_sort = $this->input->get('per_page_sort', TRUE) ?? 25;
        $session = $this->get_session();
        $where = [];
        $this->_data['view_model'] = new Inventory_gallery_image_list_admin_list_paginate_view_model(
            $this->inventory_gallery_image_list_model,
            $this->pagination,
            '/admin/inventory_gallery_image_list/0');
        $this->_data['view_model']->set_heading('Inventory_gallery_image_list');
        $this->_data['view_model']->set_total_rows($this->inventory_gallery_image_list_model->count($where));

        $this->_data['view_model']->set_per_page($per_page_sort);
        $this->_data['view_model']->set_page($page);
        $this->_data['view_model']->set_order_by($order_by);
        $this->_data['view_model']->set_sort($direction);
        $this->_data['view_model']->set_sort_base_url('/admin/inventory_gallery_image_list/0');
		$this->_data['view_model']->set_list($this->inventory_gallery_image_list_model->get_paginated(
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

        return $this->render('Admin/Inventory_gallery_image_list', $this->_data);
	}

    	public function add()
	{
        include_once __DIR__ . '/../../view_models/Inventory_gallery_image_list_admin_add_view_model.php';
        $session = $this->get_session();
        $this->form_validation = $this->inventory_gallery_image_list_model->set_form_validation(
        $this->form_validation, $this->inventory_gallery_image_list_model->get_all_validation_rule());
        $this->_data['view_model'] = new Inventory_gallery_image_list_admin_add_view_model($this->inventory_gallery_image_list_model);
        $this->_data['view_model']->set_heading('Inventory_gallery_image_list');
        
		$this->load->model('image_model');
		$gallery_images = $this->image_model->get_all();
		foreach ($gallery_images as $key => $image) {
			if($image->type == 4){
				$image->show_url = base_url().$image->url;
			}else
		{
			$image->show_url = $image->url;
		}$image->type = $this->image_model->type_mapping()[$image->type];
		}
		$this->_data['gallery_images'] = $gallery_images;
		
        
        
        
		if ($this->form_validation->run() === FALSE)
		{
			return $this->render('Admin/Inventory_gallery_image_listAdd', $this->_data);
        }

        $inventory_id = $this->input->post('inventory_id', TRUE);
		$gallery_image = $this->input->post('gallery_image', TRUE);
		$gallery_image_id = $this->input->post('gallery_image_id', TRUE);
		$gallery_image_id = $this->input->post('gallery_image_id', TRUE);
		$gallery_image_id_id = $this->input->post('gallery_image_id_id', TRUE);
		$status = $this->input->post('status', TRUE);
		
        $result = $this->inventory_gallery_image_list_model->create([
            'inventory_id' => $inventory_id,
			'gallery_image' => $gallery_image,
			'gallery_image_id' => $gallery_image_id,
			'gallery_image_id' => $gallery_image_id,
			'gallery_image_id_id' => $gallery_image_id_id,
			'status' => $status,
			
        ]);

        if ($result)
        {
            
            
            return $this->redirect('/admin/inventory_gallery_image_list/0', 'refresh');
        }

        $this->_data['error'] = 'Error';
        return $this->render('Admin/Inventory_gallery_image_listAdd', $this->_data);
	}

    	public function edit($id)
	{
        $model = $this->inventory_gallery_image_list_model->get($id);
        $session = $this->get_session();
		if (!$model)
		{
			$this->error('Error');
			return redirect('/admin/inventory_gallery_image_list/0');
        }

        include_once __DIR__ . '/../../view_models/Inventory_gallery_image_list_admin_edit_view_model.php';
        $this->form_validation = $this->inventory_gallery_image_list_model->set_form_validation(
        $this->form_validation, $this->inventory_gallery_image_list_model->get_all_edit_validation_rule());
        $this->_data['view_model'] = new Inventory_gallery_image_list_admin_edit_view_model($this->inventory_gallery_image_list_model);
        $this->_data['view_model']->set_model($model);
        $this->_data['view_model']->set_heading('Inventory_gallery_image_list');
        
		$this->load->model('image_model');
		$gallery_images = $this->image_model->get_all();
		foreach ($gallery_images as $key => $image) {
			if($image->type == 4){
				$image->show_url = base_url().$image->url;
			}else
		{
			$image->show_url = $image->url;
		}$image->type = $this->image_model->type_mapping()[$image->type];
		}
		$this->_data['gallery_images'] = $gallery_images;
		
        
        
        
		if ($this->form_validation->run() === FALSE)
		{
			return $this->render('Admin/Inventory_gallery_image_listEdit', $this->_data);
        }

        $inventory_id = $this->input->post('inventory_id', TRUE);
		$gallery_image = $this->input->post('gallery_image', TRUE);
		$gallery_image_id = $this->input->post('gallery_image_id', TRUE);
		$gallery_image_id = $this->input->post('gallery_image_id', TRUE);
		$gallery_image_id_id = $this->input->post('gallery_image_id_id', TRUE);
		$status = $this->input->post('status', TRUE);
		
        $result = $this->inventory_gallery_image_list_model->edit([
            'inventory_id' => $inventory_id,
			'gallery_image' => $gallery_image,
			'gallery_image_id' => $gallery_image_id,
			'gallery_image_id' => $gallery_image_id,
			'gallery_image_id_id' => $gallery_image_id_id,
			'status' => $status,
			
        ], $id);

        if ($result)
        {
            
            
            return $this->redirect('/admin/inventory_gallery_image_list/0', 'refresh');
        }

        $this->_data['error'] = 'Error';
        return $this->render('Admin/Inventory_gallery_image_listEdit', $this->_data);
	}

    	public function view($id)
	{
        $model = $this->inventory_gallery_image_list_model->get($id);

		if (!$model)
		{
			$this->error('Error');
			return redirect('/admin/inventory_gallery_image_list/0');
		}


        include_once __DIR__ . '/../../view_models/Inventory_gallery_image_list_admin_view_view_model.php';
		$this->_data['view_model'] = new Inventory_gallery_image_list_admin_view_view_model($this->inventory_gallery_image_list_model);
		$this->_data['view_model']->set_heading('Inventory_gallery_image_list');
        $this->_data['view_model']->set_model($model);
        
        
		return $this->render('Admin/Inventory_gallery_image_listView', $this->_data);
	}

    	public function delete($id)
	{
        $model = $this->inventory_gallery_image_list_model->get($id);
        $session = $this->get_session();
		if (!$model)
		{
			$this->error('Error');
			return redirect('/admin/inventory_gallery_image_list/0');
        }
        
        $result = $this->inventory_gallery_image_list_model->delete($id);

        if ($result)
        {
            
            return $this->redirect('/admin/inventory_gallery_image_list/0', 'refresh');
        }

        $this->error('Error');
        return redirect('/admin/inventory_gallery_image_list/0');
	}

    

    

    

    

    

    
}