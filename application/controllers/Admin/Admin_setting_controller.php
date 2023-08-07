<?php defined('BASEPATH') OR exit('No direct script access allowed');
include_once 'Admin_controller.php';
/*Powered By: Manaknightdigital Inc. https://manaknightdigital.com/ Year: 2021*/
/**
 * Setting Controller
 * @copyright 2019 Manaknightdigital Inc.
 * @link https://manaknightdigital.com
 * @license Proprietary Software licensing
 * @author Ryan Wong
 *
 */
class Admin_setting_controller extends Admin_controller
{
    protected $_model_file = 'setting_model';
    public $_page_name = 'Setting';

    public function __construct()
    {
        parent::__construct();
        
        
        
    }

    

    	public function index($page)
	{
        $this->load->library('pagination');
        include_once __DIR__ . '/../../view_models/Setting_admin_list_paginate_view_model.php';
        $session = $this->get_session();
        $format = $this->input->get('format', TRUE) ?? 'view';
        $order_by = $this->input->get('order_by', TRUE) ?? '';
        $direction = $this->input->get('direction', TRUE) ?? 'ASC';
        $per_page_sort = $this->input->get('per_page_sort', TRUE) ?? 25;

        $this->_data['view_model'] = new Setting_admin_list_paginate_view_model(
            $this->setting_model,
            $this->pagination,
            '/admin/setting/0');
        $this->_data['view_model']->set_heading('Setting');
        $this->_data['view_model']->set_id(($this->input->get('id', TRUE) != NULL) ? $this->input->get('id', TRUE) : NULL);
		$this->_data['view_model']->set_key(($this->input->get('key', TRUE) != NULL) ? $this->input->get('key', TRUE) : NULL);
		$this->_data['view_model']->set_value(($this->input->get('value', TRUE) != NULL) ? $this->input->get('value', TRUE) : NULL);
		
        $where = [
            'id' => $this->_data['view_model']->get_id(),
			'key' => $this->_data['view_model']->get_key(),
			'value' => $this->_data['view_model']->get_value(),
			
            
        ];

        $this->_data['view_model']->set_total_rows($this->setting_model->count($where));

        $this->_data['view_model']->set_format_layout($this->_data['layout_clean_mode']);
        $this->_data['view_model']->set_per_page($per_page_sort);
        $this->_data['view_model']->set_order_by($order_by);
        $this->_data['view_model']->set_sort($direction);
        $this->_data['view_model']->set_sort_base_url('/admin/setting/0');
        $this->_data['view_model']->set_page($page);
		$this->_data['view_model']->set_list($this->setting_model->get_paginated(
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

        return $this->render('Admin/Setting', $this->_data);
	}

    

    	public function edit($id)
	{
        $model = $this->setting_model->get($id);
        $session = $this->get_session();
		if (!$model)
		{
			$this->error('Error');
			return redirect('/admin/setting/0');
        }

        include_once __DIR__ . '/../../view_models/Setting_admin_edit_view_model.php';
        $this->form_validation = $this->setting_model->set_form_validation(
        $this->form_validation, $this->setting_model->get_all_edit_validation_rule());
        $this->_data['view_model'] = new Setting_admin_edit_view_model($this->setting_model);
        $this->_data['view_model']->set_model($model);
        $this->_data['view_model']->set_heading('Setting');
        
        
        
        
		if ($this->form_validation->run() === FALSE)
		{
			return $this->render('Admin/SettingEdit', $this->_data);
        }

        $value = $this->input->post('value', TRUE);
		
        $result = $this->setting_model->edit([
            'value' => $value,
			
        ], $id);

        if ($result)
        {
            
            
            return $this->redirect('/admin/setting/0', 'refresh');
        }

        $this->_data['error'] = 'Error';
        return $this->render('Admin/SettingEdit', $this->_data);
	}

    

    

    

    

    

    

    

    
}