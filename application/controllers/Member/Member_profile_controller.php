<?php defined('BASEPATH') || exit('No direct script access allowed');
include_once 'Member_controller.php';

/**
 * Member Profile Controller
 * @copyright 2019 Manaknightdigital Inc.
 * @link https://manaknightdigital.com
 * @license Proprietary Software licensing
 * @author Ryan Wong
 *
 */
class Member_profile_controller extends Member_controller
{
  protected $_model_file = 'user_model';
  public $_page_name     = 'Profile';

  public function __construct()
  {
    parent::__construct();
  }


  public function index()
	{
        $this->load->model('credential_model'); 
    $this->load->model('member_profile_model');
    $this->load->model('school_model');
        $session = $this->get_session();
        $model = $this->user_model->get($session['user_id']);
        $id = $session['user_id'];

             // load data
    $schools    = $this->school_model->get_all();

    
    if (!empty($schools))
    {
      $this->_data['schools'] = $schools;
    }

		if (!$model)
		{
			$this->error('Error');
			return redirect('/member/dashboard');
        }

        $credential = $this->credential_model->get($session['credential_id']);
        $email_validation_rules = 'required|valid_email';

        include_once __DIR__ . '/../../view_models/Member_profile_view_model.php';

        if ($this->input->post('email') != $credential->email)
		{
			$email_validation_rules .= '|is_unique[credential.email]';
		}

      $member_profile_data = $this->db->select('*')->from('member_profile')->where('user_id',$id)->get()->row_array();
      $user_data = $this->db->select('*')->from('user')->where('id',$id)->get()->row_array();

    $this->_data['phone']  = $user_data['phone'];
    $this->_data['username']  = $member_profile_data['username'];
    $this->_data['school_id'] = $member_profile_data['school_id'];

		$this->form_validation->set_rules('email', 'Email', $email_validation_rules);
		$this->form_validation->set_rules('first_name', 'First Name', 'required');
        $this->form_validation->set_rules('last_name', 'Last Name', 'required');

        $this->_data['view_model'] = new Member_profile_view_model($this->user_model);
        $this->_data['view_model']->set_model($model);
        $this->_data['view_model']->set_email($credential->email);
        $this->_data['view_model']->set_heading('Member');

		if ($this->form_validation->run() === FALSE)
		{
			return $this->render('Member/Profile', $this->_data);
        }

    

		$first_name = $this->input->post('first_name');
		$last_name = $this->input->post('last_name');
		$email = $this->input->post('email');
        $password = $this->input->post('password');

      // $username = $this->input->post('username');
      $school_id = $this->input->post('school_id');

        $payload = [
			'first_name' => $first_name,
			'last_name' => $last_name
        ];
        
    $payload_2 = [
      // 'username'  => $username,
      'school_id' => $school_id
    ];

        $result = $this->user_model->edit_raw($payload, $id);

        if ($result)
        {
          $this->db->set($payload_2)->where('id',$member_profile_data['id'])->update('member_profile');
          $this->db->set(['phone'=>$this->input->post('phone')])->where('id',$id)->update('user');
            $credential_payload = [
                'email' => $email
            ];

            if (strlen($password) > 0)
            {
                $credential_payload['password'] = str_replace('$2y$', '$2b$', password_hash($password, PASSWORD_BCRYPT));
            }

            $result = $this->credential_model->edit_raw($credential_payload, $session['credential_id']);
            $this->success('Saved');
            return $this->redirect('/member/profile', 'refresh');
        }

        $this->_data['error'] = 'Error';
        return $this->render('Member/Profile', $this->_data);
    }
}
