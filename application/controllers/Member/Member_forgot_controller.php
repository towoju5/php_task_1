<?php defined('BASEPATH') OR exit('No direct script access allowed');
include_once __DIR__ . '/../../services/User_service.php';
/*Powered By: Manaknightdigital Inc. https://manaknightdigital.com/ Year: 2021*/
/**
 * Forgot Controller
 * @copyright 2019 Manaknightdigital Inc.
 * @link https://manaknightdigital.com
 * @license Proprietary Software licensing
 * @author Ryan Wong
 *
 */
class Member_forgot_controller extends Manaknight_Controller
{
	public function index ()
	{
        $this->load->model('user_model');
        $this->load->model('credential_model');
        $this->load->model('email_model');
        $this->load->model('token_model');
        $this->load->library('mail_service');

        $service = new User_service($this->credential_model);

        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');

        if ($this->form_validation->run() === FALSE)
        {
            echo $this->load->view('Member/Forgot', $this->_data, TRUE);
            exit;
        }

        $email = $this->input->post('email');
        $from_email = $this->config->item('from_email');
        $base_url = $this->config->item('base_url');

        $this->mail_service->set_adapter('smtp');
        $service->set_email_model($this->email_model);
        $service->set_token_model($this->token_model);
        $service->set_email_service($this->mail_service);

        $reset = $service->forgot_password($email, $from_email, $base_url . '/member/reset', 1);

        if ($reset)
        {
            $this->success('Your Reset email was sent. Check your email.');
            return $this->redirect('/member/login');
        }

        $this->_data['error'] = 'Email does not exist in our system.';
        echo $this->load->view('Member/Forgot', $this->_data, TRUE);
        exit;
	}
}