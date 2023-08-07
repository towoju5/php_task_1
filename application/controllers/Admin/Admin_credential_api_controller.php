<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once 'Admin_api_controller.php';
/*Powered By: Manaknightdigital Inc. https://manaknightdigital.com/ Year: 2021*/
/**
 * User API Controller
 * @copyright 2019 Manaknightdigital Inc.
 * @link https://manaknightdigital.com
 * @license Proprietary Software licensing
 * @author Ryan Wong
 *
 */
class Admin_credential_api_controller extends Admin_api_controller
{
    protected $_model_file = 'credential_model';

    public function __construct()
    {
        parent::__construct();
    }

	public function index($page)
	{
        $this->load->library('pagination');
        include_once __DIR__ . '/../../view_models/User_admin_list_paginate_view_model.php';

        $this->_data['view_model'] = new User_admin_list_paginate_view_model(
            $this->credential_model,
            $this->pagination,
            '/admin/users/0');
        $this->_data['view_model']->set_heading('{{{page_name}}}');
        $this->_data['view_model']->set_id(($this->input->get('id', TRUE) != NULL) ? $this->input->get('id', TRUE) : NULL);
		$this->_data['view_model']->set_email(($this->input->get('email', TRUE) != NULL) ? $this->input->get('email', TRUE) : NULL);
		$this->_data['view_model']->set_first_name(($this->input->get('first_name', TRUE) != NULL) ? $this->input->get('first_name', TRUE) : NULL);
		$this->_data['view_model']->set_last_name(($this->input->get('last_name', TRUE) != NULL) ? $this->input->get('last_name', TRUE) : NULL);
		
        $where = [
            'id' => $this->_data['view_model']->get_id(),
			'email' => $this->_data['view_model']->get_email(),
			'first_name' => $this->_data['view_model']->get_first_name(),
			'last_name' => $this->_data['view_model']->get_last_name(),
			
        ];

        $this->_data['view_model']->set_total_rows($this->credential_model->count_paginated($where));

        $this->_data['view_model']->set_per_page(10);
        $this->_data['view_model']->set_page($page);
		$this->_data['view_model']->set_list($this->credential_model->get_user_paginated(
            $this->_data['view_model']->get_page(),
            $this->_data['view_model']->get_per_page(),
            $where));
        return $this->success($this->_data['view_model']->to_json(), 200);
	}

	public function add()
	{
        $this->form_validation = $this->credential_model->set_form_validation(
        $this->form_validation, $this->credential_model->get_all_validation_rule());
        
		if ($this->form_validation->run() === FALSE)
		{
			return $this->_render_validation_error();
        }

        $email = $this->input->post('email', TRUE);
		$first_name = $this->input->post('first_name', TRUE);
		$last_name = $this->input->post('last_name', TRUE);
		$phone = $this->input->post('phone', TRUE);
		$image = $this->input->post('image', TRUE);
		$image_id = $this->input->post('image_id', TRUE);
		
        $result = $this->credential_model->create([
            'email' => $email,
			'first_name' => $first_name,
			'last_name' => $last_name,
			'phone' => $phone,
			'image' => $image,
			'image_id' => $image_id,
			"password" => str_replace('$2y$', '$2b$', password_hash($password, PASSWORD_BCRYPT)),
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
        $model = $this->credential_model->get($id);

		if (!$model)
		{
            return $this->_render_custom_error([
                'error' => 'Error'
            ]);
        }

        $this->form_validation = $this->credential_model->set_form_validation(
        $this->form_validation, $this->credential_model->get_all_edit_validation_rule());
        
		if ($this->form_validation->run() === FALSE)
		{
			return $this->_render_validation_error();
        }

        $email = $this->input->post('email', TRUE);
		$first_name = $this->input->post('first_name', TRUE);
		$last_name = $this->input->post('last_name', TRUE);
		$phone = $this->input->post('phone', TRUE);
		$role_id = $this->input->post('role_id', TRUE);
		$status = $this->input->post('status', TRUE);
		$image = $this->input->post('image', TRUE);
		$image_id = $this->input->post('image_id', TRUE);
		
        $result = $this->credential_model->edit([
            'email' => $email,
			'first_name' => $first_name,
			'last_name' => $last_name,
			'phone' => $phone,
			'role_id' => $role_id,
			'status' => $status,
			'image' => $image,
			'image_id' => $image_id,
			"password" => str_replace('$2y$', '$2b$', password_hash($password, PASSWORD_BCRYPT)),
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
        $model = $this->credential_model->get($id);
		
		if (!$model)
		{
			return $this->_render_custom_error([
				'error' => 'Error'
			]);
		}


        include_once __DIR__ . '/../../view_models/User_admin_view_view_model.php';
        $this->_data['view_model'] = new User_admin_view_view_model($this->credential_model);
        $this->_data['view_model']->set_model($model);
        return $this->success(['data' => $this->_data['view_model']->to_json()], 200);
	}






}