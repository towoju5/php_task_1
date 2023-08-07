<?php defined('BASEPATH') || exit('No direct script access allowed');
/*Powered By: Manaknightdigital Inc. https://manaknightdigital.com/ Year: 2021*/
/**
 * User Factory
 *
 * @copyright 2019 Manaknightdigital Inc.
 * @link https://manaknightdigital.com
 * @license Proprietary Software licensing
 * @author Ryan Wong
 */
class User_factory
{
  private $_user_model;
  private $_credential_model;
  private $_member_profile_model;

  public function __construct($credential_model = NULL, $user_model = NULL, $member_profile_model = NULL)
  {
    $this->_user_model           = $user_model;
    $this->_credential_model     = $credential_model;
    $this->_member_profile_model = $member_profile_model;
  }

  /**
   * @param object $user_model
   */
  public function set_user_model($user_model)
  {
    $this->_user_model = $user_model;
  }

  /**
   * @param object $credential_model
   */
  public function set_credential_model($credential_model)
  {
    $this->_credential_model = $credential_model;
  }

  /**
   * @param object member_profile_model
   */
  public function set_member_profile_model($member_profile_model)
  {
    $this->_member_profile_model = $member_profile_model;
  }

  /**
   * Create User
   *
   * @param mixed $user_model
   * @param string $email
   * @param string $password
   * @param integer $role
   * @param string $type
   * @return mixed
   */
  public function create($user_model, $email, $password, $role, $type = 'n')
  {
    $credential_params = [
      'email'    => $email,
      'password' => str_replace('$2y$', '$2b$', password_hash($password, PASSWORD_BCRYPT)),
      'type'     => $type ?? 'n',
      'verify'   => 0,
      'role_id'  => $role,
      'user_id'  => 0,
      'status'   => 1
    ];

    $credential_id    = $this->_credential_model->create($credential_params);
    $existing_user_id = isset($_SESSION) && isset($_SESSION['user_id']) && $_SESSION['user_id'] > 0;

    if ($type != 'n' && $existing_user_id)
    {
      $this->_credential_model->edit([
        'user_id' => $_SESSION['user_id']
      ], $credential_id);

      return $_SESSION['user_id'];
    }

    if ($credential_id)
    {
      $user_id = $this->_user_model->create([
        'first_name' => '',
        'last_name'  => '',
        'phone'      => '',
        'image'      => 'https://i.imgur.com/AzJ7DRw.png',
        'image_id'   => 1,
        'refer'      => uniqid(),
        'profile_id' => 0,
        'stripe_id'  => ''
      ]);

      $this->_credential_model->edit([
        'user_id' => $user_id
      ], $credential_id);

      return $user_id;
    }

    return FALSE;
  }

  public function create_full_user($user_model, $email, $password, $first_name, $last_name, $username, $role, $type = 'n')
  {
    $credential_params = [
      'email'    => $email,
      'password' => str_replace('$2y$', '$2b$', password_hash($password, PASSWORD_BCRYPT)),
      'type'     => $type ?? 'n',
      'verify'   => 0,
      'role_id'  => $role,
      'user_id'  => 0,
      'status'   => 1
    ];

    $credential_id = $this->_credential_model->create($credential_params);

    if ($credential_id)
    {
      $user_id = $this->_user_model->create([
        'first_name' => $first_name,
        'last_name'  => $last_name,
        'phone'      => '',
        'image'      => 'https://i.imgur.com/AzJ7DRw.png',
        'image_id'   => 1,
        'refer'      => uniqid(),
        'profile_id' => 0,
        'stripe_id'  => ''
      ]);

      $this->_credential_model->edit([
        'user_id' => $user_id
      ], $credential_id);

      $this->_member_profile_model->create([
        'user_id'   => $user_id,
        'username'  => $username,
        'school_id' => 0
      ]);

      return $user_id;
    }
    return FALSE;
  }
}
