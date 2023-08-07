<?php defined('BASEPATH') OR exit('No direct script access allowed');
include_once 'Admin_controller.php';
/*Powered By: Manaknightdigital Inc. https://manaknightdigital.com/ Year: 2021*/
/**
 * Test_image Controller
 * @copyright 2019 Manaknightdigital Inc.
 * @link https://manaknightdigital.com
 * @license Proprietary Software licensing
 * @author Ryan Wong
 *
 */
class Admin_test_image_controller extends Admin_controller
{
    protected $_model_file = 'test_image_model';
    public $_page_name = 'Test image';

    public function __construct()
    {
        parent::__construct();
        
        
        
    }

    

    	public function index($page)
	{
        $this->load->library('pagination');
        include_once __DIR__ . '/../../view_models/Test_image_admin_list_paginate_view_model.php';
        $session = $this->get_session();
        $format = $this->input->get('format', TRUE) ?? 'view';
        $order_by = $this->input->get('order_by', TRUE) ?? '';
        $direction = $this->input->get('direction', TRUE) ?? 'ASC';
        $per_page_sort = $this->input->get('per_page_sort', TRUE) ?? 25;

        $this->_data['view_model'] = new Test_image_admin_list_paginate_view_model(
            $this->test_image_model,
            $this->pagination,
            '/admin/test_image/0');
        $this->_data['view_model']->set_heading('Test image');
        $this->_data['view_model']->set_id(($this->input->get('id', TRUE) != NULL) ? $this->input->get('id', TRUE) : NULL);
		$this->_data['view_model']->set_created_at(($this->input->get('created_at', TRUE) != NULL) ? $this->input->get('created_at', TRUE) : NULL);
		
        $where = [
            'id' => $this->_data['view_model']->get_id(),
			'created_at' => $this->_data['view_model']->get_created_at(),
			
            
        ];

        $this->_data['view_model']->set_total_rows($this->test_image_model->count($where));

        $this->_data['view_model']->set_format_layout($this->_data['layout_clean_mode']);
        $this->_data['view_model']->set_per_page($per_page_sort);
        $this->_data['view_model']->set_order_by($order_by);
        $this->_data['view_model']->set_sort($direction);
        $this->_data['view_model']->set_sort_base_url('/admin/test_image/0');
        $this->_data['view_model']->set_page($page);
		$this->_data['view_model']->set_list($this->test_image_model->get_paginated(
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

        return $this->render('Admin/Test_image', $this->_data);
	}

    	public function add()
	{
        include_once __DIR__ . '/../../view_models/Test_image_admin_add_view_model.php';
        $session = $this->get_session();
        $this->form_validation = $this->test_image_model->set_form_validation(
        $this->form_validation, $this->test_image_model->get_all_validation_rule());
        $this->_data['view_model'] = new Test_image_admin_add_view_model($this->test_image_model);
        $this->_data['view_model']->set_heading('Test image');
        
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
			return $this->render('Admin/Test_imageAdd', $this->_data);
        }

        $image = $this->input->post('image', TRUE);
		$image_id = $this->input->post('image_id', TRUE);
		
        $result = $this->test_image_model->create([
            'image' => $image,
			'image_id' => $image_id,
			
        ]);

        if ($result)
        {
            $this->success('image added.');
            
            return $this->redirect('/admin/test_image/0', 'refresh');
        }

        $this->_data['error'] = 'Error';
        return $this->render('Admin/Test_imageAdd', $this->_data);
	}

    	public function edit($id)
	{
        $model = $this->test_image_model->get($id);
        $session = $this->get_session();
		if (!$model)
		{
			$this->error('Error');
			return redirect('/admin/test_image/0');
        }

        include_once __DIR__ . '/../../view_models/Test_image_admin_edit_view_model.php';
        $this->form_validation = $this->test_image_model->set_form_validation(
        $this->form_validation, $this->test_image_model->get_all_edit_validation_rule());
        $this->_data['view_model'] = new Test_image_admin_edit_view_model($this->test_image_model);
        $this->_data['view_model']->set_model($model);
        $this->_data['view_model']->set_heading('Test image');
        
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
			return $this->render('Admin/Test_imageEdit', $this->_data);
        }

        $image = $this->input->post('image', TRUE);
		$image_id = $this->input->post('image_id', TRUE);
		
        $result = $this->test_image_model->edit([
            'image' => $image,
			'image_id' => $image_id,
			
        ], $id);

        if ($result)
        {
            $this->success('image updated.');
            
            return $this->redirect('/admin/test_image/0', 'refresh');
        }

        $this->_data['error'] = 'Error';
        return $this->render('Admin/Test_imageEdit', $this->_data);
	}

    

    

    	public function bulk_delete()
	{
        
        $bulk_items = $this->input->post('bulk_items');
        foreach ($bulk_items as $key => $id) {
            $this->test_image_model->real_delete($id);
        }
        echo 'success';
        exit();
	}

    

    

    

    

    
}