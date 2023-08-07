<?php defined('BASEPATH') OR exit('No direct script access allowed');
include_once 'Member_controller.php';
/*Powered By: Manaknightdigital Inc. https://manaknightdigital.com/ Year: 2021*/
/**
 * Credential Controller
 * @copyright 2019 Manaknightdigital Inc.
 * @link https://manaknightdigital.com
 * @license Proprietary Software licensing
 * @author Ryan Wong
 *
 */
class Member_me_controller extends Member_controller
{
    protected $_model_file = 'credential_model';
    public $_page_name = 'Change Password';

    public function __construct()
    {
        parent::__construct();
    }

    public function me()
	{
        $session = $this->get_session();
        $model = $this->credential_model->get($session['credential_id']);
        $this->_data['email'] = $model->email;
        $this->_data['password'] = '';

        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'Password', '');

		if ($this->form_validation->run() === FALSE)
		{
			return $this->render('Member/Mes', $this->_data);
        }

        $email = $this->input->post('email');
		$password = $this->input->post('password');

        $payload = [
            'email' => $email,
        ];

        if (strlen($password) > 1)
        {
            $payload['password'] = str_replace('$2y$', '$2b$', password_hash($password, PASSWORD_BCRYPT));
        }

        $result = $this->credential_model->edit($payload, $session['credential_id']);

        if ($result)
        {
            $this->success('Saved');
            return $this->redirect('/member/me', 'refresh');
        }

        $this->_data['error'] = 'Error';
        return $this->render('Member/Mes', $this->_data);
	}
}