<?php defined('BASEPATH') OR exit('No direct script access allowed');
include_once 'Admin_controller.php';

/**
 * Admin Profile Controller
 * @copyright 2019 Manaknightdigital Inc.
 * @link https://manaknightdigital.com
 * @license Proprietary Software licensing
 * @author Ryan Wong
 *
 */
class Admin_profile_controller extends Admin_controller
{
    protected $_model_file = 'user_model';
    public $_page_name = 'Profile';

    public function __construct()
    {
        parent::__construct();
    }

	public function index()
	{
        $this->load->model('credential_model');
        $session = $this->get_session();
        $model = $this->user_model->get($session['user_id']);
        $id = $session['user_id'];

		if (!$model)
		{
			$this->error('Error');
			return redirect('/admin/dashboard');
        }

        $credential = $this->credential_model->get($session['credential_id']);
        $email_validation_rules = 'required|valid_email';

        include_once __DIR__ . '/../../view_models/Admin_profile_view_model.php';

        if ($this->input->post('email') != $credential->email)
		{
			$email_validation_rules .= '|is_unique[credential.email]';
		}

		$this->form_validation->set_rules('email', 'Email', $email_validation_rules);
		$this->form_validation->set_rules('first_name', 'First Name', 'required');
        $this->form_validation->set_rules('last_name', 'Last Name', 'required');

        $this->_data['view_model'] = new Admin_profile_view_model($this->user_model);
        $this->_data['view_model']->set_model($model);
        $this->_data['view_model']->set_email($credential->email);
        $this->_data['view_model']->set_heading('Admin');

		if ($this->form_validation->run() === FALSE)
		{
			return $this->render('Admin/Profile', $this->_data);
        }

		$first_name = $this->input->post('first_name');
		$last_name = $this->input->post('last_name');
		$email = $this->input->post('email');
        $password = $this->input->post('password');

        $payload = [
			'first_name' => $first_name,
			'last_name' => $last_name
        ];

        $result = $this->user_model->edit_raw($payload, $id);

        if ($result)
        {
            $credential_payload = [
                'email' => $email
            ];

            if (strlen($password) > 0)
            {
                $credential_payload['password'] = str_replace('$2y$', '$2b$', password_hash($password, PASSWORD_BCRYPT));
            }

            $result = $this->credential_model->edit_raw($credential_payload, $session['credential_id']);
            $this->success('Saved');
            return $this->redirect('/admin/profile', 'refresh');
        }

        $this->_data['error'] = 'Error';
        return $this->render('Admin/Profile', $this->_data);
    }
}