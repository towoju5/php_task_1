<?php defined('BASEPATH') OR exit('No direct script access allowed');
include_once __DIR__ . '/../../services/User_service.php';
/*Powered By: Manaknightdigital Inc. https://manaknightdigital.com/ Year: 2021*/
/**
 * Reset Controller
 * @copyright 2019 Manaknightdigital Inc.
 * @link https://manaknightdigital.com
 * @license Proprietary Software licensing
 * @author Ryan Wong
 *
 */
class Member_reset_controller extends Manaknight_Controller
{
	public function index ($reset_token)
	{
        $this->load->model('user_model');
        $this->load->model('token_model');
        $this->load->model('credential_model');

        $service = new User_service($this->credential_model);
        $service->set_token_model($this->token_model);

        $valid_user = $service->valid_reset_token($reset_token);

        if (!$valid_user)
        {
            $this->error('Email does not exist in our system.');
            return $this->redirect('/member/login');
        }

        $this->_data['reset_token'] = $reset_token;

        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'trim|required|matches[password]');

        if ($this->form_validation->run() === FALSE)
        {
            echo $this->load->view('Member/Reset', $this->_data, TRUE);
            exit;
        }

        $password = $this->input->post('password');
        $password_reseted = $service->reset_password($valid_user->id, $password);

        if ($password_reseted)
        {
            $service->invalidate_token($reset_token, $valid_user->id);
            $credential = $this->credential_model->get_by_field('user_id', $valid_user->id);
            $this->credential_model->edit(['verify' => '1'], $credential->id);
            $this->set_session('credential_id', (int) $credential->id);
            $this->set_session('user_id', (int) $credential->user_id);
            $this->set_session('email', (string) $credential->email);
            $this->set_session('role', (string) $credential->role_id);
            $this->success('Success! You can start using your account now.');
            return $this->redirect('/member/dashboard');
        }

        $this->error('Invalid reset token to reset password.');
        return $this->redirect('/member/login');
	}
}