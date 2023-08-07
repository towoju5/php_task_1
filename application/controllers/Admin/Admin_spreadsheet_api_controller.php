<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once 'Admin_api_controller.php';
/*Powered By: Manaknightdigital Inc. https://manaknightdigital.com/ Year: 2021*/
/**
 * Spreadsheet API Controller
 * @copyright 2019 Manaknightdigital Inc.
 * @link https://manaknightdigital.com
 * @license Proprietary Software licensing
 * @author Ryan Wong
 *
 */
class Admin_spreadsheet_api_controller extends Admin_api_controller
{
    protected $_model_file = 'spreadsheet_model';

    public function __construct()
    {
        parent::__construct();
    }

	public function index($page)
	{
        $this->load->library('pagination');
        include_once __DIR__ . '/../../view_models/Spreadsheet_admin_list_paginate_view_model.php';

        $this->_data['view_model'] = new Spreadsheet_admin_list_paginate_view_model(
            $this->spreadsheet_model,
            $this->pagination,
            '/admin/spreadsheet/0');
        $this->_data['view_model']->set_heading('{{{page_name}}}');
        $this->_data['view_model']->set_id(($this->input->get('id', TRUE) != NULL) ? $this->input->get('id', TRUE) : NULL);
		$this->_data['view_model']->set_name(($this->input->get('name', TRUE) != NULL) ? $this->input->get('name', TRUE) : NULL);
		$this->_data['view_model']->set_user_id(($this->input->get('user_id', TRUE) != NULL) ? $this->input->get('user_id', TRUE) : NULL);
		$this->_data['view_model']->set_status(($this->input->get('status', TRUE) != NULL) ? $this->input->get('status', TRUE) : NULL);
		$this->_data['view_model']->set_created_at(($this->input->get('created_at', TRUE) != NULL) ? $this->input->get('created_at', TRUE) : NULL);
		
        $where = [
            'id' => $this->_data['view_model']->get_id(),
			'name' => $this->_data['view_model']->get_name(),
			'user_id' => $this->_data['view_model']->get_user_id(),
			'status' => $this->_data['view_model']->get_status(),
			'created_at' => $this->_data['view_model']->get_created_at(),
			
        ];

        $this->_data['view_model']->set_total_rows($this->spreadsheet_model->count($where));

        $this->_data['view_model']->set_per_page(10);
        $this->_data['view_model']->set_page($page);
		$this->_data['view_model']->set_list($this->spreadsheet_model->get_paginated(
            $this->_data['view_model']->get_page(),
            $this->_data['view_model']->get_per_page(),
            $where));
        return $this->success($this->_data['view_model']->to_json(), 200);
	}

	public function add()
	{
        $this->form_validation = $this->spreadsheet_model->set_form_validation(
        $this->form_validation, $this->spreadsheet_model->get_all_validation_rule());
        
		if ($this->form_validation->run() === FALSE)
		{
			return $this->_render_validation_error();
        }

        $name = $this->input->post('name', TRUE);
		$value = $this->input->post('value', TRUE);
		$status = $this->input->post('status', TRUE);
		
        $result = $this->spreadsheet_model->create([
            'name' => $name,
			'value' => $value,
			'status' => $status,
			
        ]);

        if ($result)
        {
            $this->success('Spreadsheet added.');
            
            return $this->success([], 200);
        }

        return $this->_render_custom_error([
            'error' => 'Error'
        ]);
	}

	public function edit($id)
	{
        $model = $this->spreadsheet_model->get($id);

		if (!$model)
		{
            return $this->_render_custom_error([
                'error' => 'Error'
            ]);
        }

        $this->form_validation = $this->spreadsheet_model->set_form_validation(
        $this->form_validation, $this->spreadsheet_model->get_all_edit_validation_rule());
        
		if ($this->form_validation->run() === FALSE)
		{
			return $this->_render_validation_error();
        }

        $name = $this->input->post('name', TRUE);
		$value = $this->input->post('value', TRUE);
		$status = $this->input->post('status', TRUE);
		
        $result = $this->spreadsheet_model->edit([
            'name' => $name,
			'value' => $value,
			'status' => $status,
			
        ], $id);

        if ($result)
        {
            $this->success('Spreadsheet updated.');
            
            return $this->success([], 200);
        }

        return $this->_render_custom_error([
            'error' => 'Error'
        ]);
	}








}