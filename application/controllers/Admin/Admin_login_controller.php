<?php defined('BASEPATH') OR exit('No direct script access allowed');
include_once __DIR__ . '/../../services/User_service.php';
include_once 'Admin_controller.php';
/*Powered By: Manaknightdigital Inc. https://manaknightdigital.com/ Year: 2021*/
/**
 * Login Controller
 * @copyright 2019 Manaknightdigital Inc.
 * @link https://manaknightdigital.com
 * @license Proprietary Software licensing
 * @author Ryan Wong
 *
 */
class Admin_login_controller extends Manaknight_Controller
{
	protected $_redirect = '/admin/dashboard';

    public $_valid_roles = [2];

    public function __construct()
    {
        parent::__construct();
    }

	public function index ()
	{
        $this->load->model('credential_model');
        $this->load->model('user_model');
        $this->load->helper('cookie');

        $service = new User_service($this->credential_model);
        if($this->input->cookie('admin_remember_me_token', TRUE) !== null && $this->input->cookie('admin_remember_me_token', TRUE) !== '')
        {
            $this->_remember_me_login();
            exit();
        }

        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->_data['portal'] = 'admin';

        if ($this->form_validation->run() === FALSE)
        {
            echo $this->load->view('Admin/Login', $this->_data, TRUE);
            exit;
        }

        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $redirect = $service->get_redirect($this->input->cookie('redirect', TRUE), $this->_redirect);
        $role = $this->_valid_roles[0];
        $authenticated_user = $service->login_by_role($email, $password, $role);

        if ($authenticated_user)
        {
            delete_cookie('redirect');
            $user_id = $authenticated_user->user_id;

            if(!empty($this->input->post("remember_me"))) {
                $this->load->helper('string');
                $remember_cookie = [
                    'user_id' => $user_id,
                    'name' => 'admin_remember_me_token',
                    'value' => random_string('alnum', 16),
                    'expire' => time()+$this->config->item('cookie_expire'),
                    'domain' => base_url()
                ];
                $this->load->model('cookies_model');
                $check_cookie = $this->cookies_model->get_by_field('user_id', $user_id);
                if($check_cookie)
                {
                    $cookie = $this->cookies_model->edit($remember_cookie, $check_cookie->id);
                }
                else
                {
                    $cookie = $this->cookies_model->create($remember_cookie);
                }
                if($cookie)
                {
                    setcookie($remember_cookie['name'], $remember_cookie['value'], $remember_cookie['expire'], $remember_cookie['domain']);
                }
            }
            $this->set_session('credential_id', (int) $authenticated_user->id);
            $this->set_session('user_id', (int) $user_id);
            $this->set_session('email', (string) $authenticated_user->email);
            $this->set_session('role', (string) $authenticated_user->role_id);
            return $this->redirect($redirect);
        }

        $this->error('Wrong email or password.');
        return $this->redirect('admin/login');
    }


    public function _remember_me_login()
    {
        $this->load->helper('string');
        $this->load->model('user_model');
        $this->load->model('credential_model');
        $this->load->model('cookies_model');
        $token_value = $this->input->cookie('admin_remember_me_token', TRUE);
        $cookie = $this->cookies_model->get_by_fields(['value' => $token_value]);
        $service = new User_service($this->credential_model, $this->user_model);
        $redirect = $service->get_redirect($this->input->cookie('redirect', TRUE), $this->_redirect);
        if($cookie)
        {
            $user_id = $cookie->user_id;
            $credential = $this->credential_model->get_by_field('user_id', $user_id);
            $role = $this->_valid_roles[0];
            if($credential->role_id != $role)
            {
                setcookie('admin_remember_me_token', '', 1, base_url());
                return $this->redirect('admin/login');
            }
            $random_string = random_string('alnum', 30);
            $this->cookies_model->edit(['value' => $random_string, 'expire' => time()+$this->config->item('cookie_expire')], $cookie->id);
            setcookie('admin_remember_me_token', $random_string, time()+$this->config->item('cookie_expire'), base_url());
            $this->set_session('credential_id', (int) $credential->id);
            $this->set_session('user_id', (int) $user_id);
            $this->set_session('email', (string) $credential->email);
            $this->set_session('role', (string) $credential->role_id);
            return $this->redirect($redirect);
        }
        else
        {
            setcookie('admin_remember_me_token', '', 1, base_url());
            return $this->redirect('admin/login');
        }

        $this->error('Wrong email or password.');
        return $this->redirect('admin/login');
    }

    public function logout ()
    {
        $this->load->helper('cookie');
        setcookie('admin_remember_me_token', '', 1, base_url());
        $this->destroy_session();
		return $this->redirect('admin/login');
    }
}