<?php defined('BASEPATH') OR exit('No direct script access allowed');
include_once 'Member_controller.php';

/**
 * Member Profile Controller
 * @copyright 2019 Manaknightdigital Inc.
 * @link https://manaknightdigital.com
 * @license Proprietary Software licensing
 * @author Ryan Wong
 *
 */
class Member_profile_credential_controller extends Member_controller
{
    protected $_model_file = 'credential_model';
    public $_page_name = 'Credentials';

    public function __construct()
    {
        parent::__construct();
    }

	public function index()
	{
        $this->load->model('user_model');
        $session = $this->get_session();
        $user_obj = $this->user_model->get($session['user_id']);
        $session = $this->get_session();
        $this->load->model($this->_model_file);
        $model = $this->credential_model->get($user_obj->credential_id ?? 0);
        $id = $user_obj->credential_id ?? 0;

		if (!$model)
		{
			die();
        }

        include_once __DIR__ . '/../../view_models/Member_profile_credential_view_model.php';
        $email_validation_rules = 'required|valid_email';
        
        if ($this->input->post('email') != $session['email'])
		{
			$email_validation_rules .= '|is_unique[credential.email]';
		}

		$this->form_validation->set_rules('email', 'Email', $email_validation_rules);

        $this->_data['view_model'] = new Member_profile_credential_view_model($model);
        $this->_data['view_model']->set_model($model);
        $this->_data['view_model']->set_heading('Member');

		if ($this->form_validation->run() === FALSE)
		{
            return $this->render('Member/Credential', $this->_data);
        }

        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $payload = [
            'email' => $email,
        ];

        if (strlen($password) > 0)
        {
            $payload['password'] = str_replace('$2y$', '$2b$', password_hash($password, PASSWORD_BCRYPT));
        }

        $result = $this->credential_model->edit_raw($payload, $id);

        if ($result)
        {
            $this->success('Saved');
            return $this->redirect('/member/credential?layout_clean_mode=1', 'refresh');
        }

        $this->_data['error'] = 'Error';
        return $this->render('Member/Credential', $this->_data);
	}
}