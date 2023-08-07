<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once 'Admin_api_controller.php';
/*Powered By: Manaknightdigital Inc. https://manaknightdigital.com/ Year: 2021*/
/**
 * Sms API Controller
 * @copyright 2019 Manaknightdigital Inc.
 * @link https://manaknightdigital.com
 * @license Proprietary Software licensing
 * @author Ryan Wong
 *
 */
class Admin_sms_api_controller extends Admin_api_controller
{
    protected $_model_file = 'sms_model';

    public function __construct()
    {
        parent::__construct();
    }

	public function index()
	{
        $this->load->library('pagination');
        include_once __DIR__ . '/../../view_models/Sms_admin_list_view_model.php';
        $this->_data['view_model'] = new Sms_admin_list_view_model($this->sms_model);
		$this->_data['view_model']->set_list($this->sms_model->get_all());
		$this->_data['view_model']->set_heading('Sms');
		return $this->success($this->_data['view_model']->to_json(), 200);
	}

	public function add()
	{
        $this->form_validation = $this->sms_model->set_form_validation(
        $this->form_validation, $this->sms_model->get_all_validation_rule());
        
		if ($this->form_validation->run() === FALSE)
		{
			return $this->_render_validation_error();
        }

        $slug = $this->input->post('slug', TRUE);
		$content = $this->input->post('content', TRUE);
		$tag = $this->input->post('tag', TRUE);
		
        $result = $this->sms_model->create([
            'slug' => $slug,
			'content' => $content,
			'tag' => $tag,
			
        ]);

        if ($result)
        {
            
            
            return $this->success([], 200);
        }

        return $this->_render_custom_error([
            'error' => 'Error'
        ]);
	}

	public function edit($id)
	{
        $model = $this->sms_model->get($id);

		if (!$model)
		{
            return $this->_render_custom_error([
                'error' => 'Error'
            ]);
        }

        $this->form_validation = $this->sms_model->set_form_validation(
        $this->form_validation, $this->sms_model->get_all_edit_validation_rule());
        
		if ($this->form_validation->run() === FALSE)
		{
			return $this->_render_validation_error();
        }

        $content = $this->input->post('content', TRUE);
		$tag = $this->input->post('tag', TRUE);
		$slug = $this->input->post('slug', TRUE);
		
        $result = $this->sms_model->edit([
            'content' => $content,
			'tag' => $tag,
			'slug' => $slug,
			
        ], $id);

        if ($result)
        {
            
            
            return $this->success([], 200);
        }

        return $this->_render_custom_error([
            'error' => 'Error'
        ]);
	}

	public function view($id)
	{
        $model = $this->sms_model->get($id);
		
		if (!$model)
		{
			return $this->_render_custom_error([
				'error' => 'Error'
			]);
		}


        include_once __DIR__ . '/../../view_models/Sms_admin_view_view_model.php';
        $this->_data['view_model'] = new Sms_admin_view_view_model($this->sms_model);
        $this->_data['view_model']->set_model($model);
        return $this->success(['data' => $this->_data['view_model']->to_json()], 200);
	}






}