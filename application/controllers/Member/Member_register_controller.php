<?php defined('BASEPATH') || exit('No direct script access allowed');
include_once __DIR__ . '/../../services/User_service.php';
include_once 'Member_controller.php';
/*Powered By: Manaknightdigital Inc. https://manaknightdigital.com/ Year: 2021*/
/**
 * Register Controller
 * @copyright 2019 Manaknightdigital Inc.
 * @link https://manaknightdigital.com
 * @license Proprietary Software licensing
 * @author Ryan Wong
 *
 */
class Member_register_controller extends Manaknight_Controller
{
  protected $_redirect = '/sell';

  public $_valid_roles = [1];

  public function __construct()
  {
    parent::__construct();
    $this->_run_middlewares();
  }

  protected function _middleware()
  {
    return [
      'affilate',
      'maintenance'
    ];
  }

  public function index()
  {
    $this->load->model('user_model');
    $this->load->model('refer_log_model');
    $this->load->helper('cookie');
    $this->load->model('credential_model');
    $this->load->model('member_profile_model');

    $service = new User_service($this->credential_model, $this->user_model, $this->member_profile_model);
    $service->set_refer_log_model($this->refer_log_model);

    $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[credential.email]');
    $this->form_validation->set_rules('password', 'Password', 'trim|required');
    $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'trim|required|matches[password]');
    $this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
    $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');

    // $this->form_validation->set_rules('username', 'Username', 'trim|required|is_unique[member_profile.username]');

    if ($this->form_validation->run() === FALSE)
    {
      echo $this->load->view('Member/Register', $this->_data, TRUE);
      exit;
    }
    

    $email      = $this->input->post('email');
    $password   = $this->input->post('password');
    $first_name = $this->input->post('first_name');
    $last_name  = $this->input->post('last_name');
    // $username   = $this->input->post('username');
    $username   = $first_name;
    // if($email == $username){
    //   $this->_data['error'] = 'Can not Use Email as Username';
    //   echo $this->load->view('Member/Register', $this->_data, TRUE);
    //   exit;
    // }


    $redirect = $service->get_redirect($this->input->cookie('redirect', TRUE), $this->_redirect);
    $session  = $this->get_session();
    $refer    = (isset($session['refer']) && strlen($session['refer']) > 0) ? $session['refer'] : '';
    
    $this->db->trans_begin();

    $created_user = $service->create($email, $password, $first_name, $last_name, $username, 1, $refer);

    if (!$created_user)
    {
      $this->db->trans_rollback();
      $this->_data['error'] = 'User creation failed. Please try again.';
      echo $this->load->view('Member/Register', $this->_data, TRUE);
      exit;
    }

    delete_cookie('redirect');
    $credential = $this->credential_model->get_by_fields([
      'email' => $email,
      'type'  => 'n'
    ]);

    $this->db->trans_commit();

    $this->set_session('credential_id', (int) $credential->id);
    $this->set_session('user_id', (int) $created_user->id);
    $this->set_session('email', (string) $created_user->email);
    $this->set_session('role', (string) $created_user->role_id);
    if(isset($_POST['return_url'] ) && $_POST['return_url'] =='buy'){
      return $this->redirect('buy');
     
    }
    return $this->redirect($redirect);
  }
}
