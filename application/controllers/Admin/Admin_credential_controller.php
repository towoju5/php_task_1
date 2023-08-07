<?php defined('BASEPATH') || exit('No direct script access allowed');
include_once 'Admin_controller.php';
include_once __DIR__ . '/../../services/User_service.php';
/*Powered By: Manaknightdigital Inc. https://manaknightdigital.com/ Year: 2021*/
/**
 * User Controller
 * @copyright 2019 Manaknightdigital Inc.
 * @link https://manaknightdigital.com
 * @license Proprietary Software licensing
 * @author Ryan Wong
 *
 */
class Admin_credential_controller extends Admin_controller
{
  protected $_model_file = 'credential_model';
  public $_page_name     = 'Users';

  public function __construct()
  {
    parent::__construct();

    $this->load->model('admin_operation_model');
    $this->load->model('credential_model');
  }

  public function index($page)
  {
    $this->load->library('pagination');
    include_once __DIR__ . '/../../view_models/User_admin_list_paginate_view_model.php';
    $session   = $this->get_session();
    $format    = $this->input->get('format', TRUE) ?? 'view';
    $order_by  = $this->input->get('order_by', TRUE) ?? '';
    $direction = $this->input->get('direction', TRUE) ?? 'ASC';

    if ($order_by == "id") 
    {
      $order_by = 'b_id';
    }
    $this->_data['view_model'] = new User_admin_list_paginate_view_model(
      $this->credential_model,
      $this->pagination,
      '/admin/users/0');
    $this->_data['view_model']->set_heading('Users');
    $this->_data['view_model']->set_id(($this->input->get('id', TRUE) != NULL) ? $this->input->get('id', TRUE) : NULL);
    $this->_data['view_model']->set_email(($this->input->get('email', TRUE) != NULL) ? $this->input->get('email', TRUE) : NULL);
    $this->_data['view_model']->set_first_name(($this->input->get('first_name', TRUE) != NULL) ? $this->input->get('first_name', TRUE) : NULL);
    $this->_data['view_model']->set_last_name(($this->input->get('last_name', TRUE) != NULL) ? $this->input->get('last_name', TRUE) : NULL);

    $where = [
      'user_id'    => $this->_data['view_model']->get_id(),
      'email'      => $this->_data['view_model']->get_email(),
      'first_name' => $this->_data['view_model']->get_first_name(),
      'last_name'  => $this->_data['view_model']->get_last_name()

    ];

    $this->_data['view_model']->set_total_rows($this->credential_model->count($where));

    $this->_data['view_model']->set_format_layout($this->_data['layout_clean_mode']);
    $this->_data['view_model']->set_per_page(25);
    $this->_data['view_model']->set_order_by($order_by);
    $this->_data['view_model']->set_sort($direction);
    $this->_data['view_model']->set_sort_base_url('/admin/users/0');
    $this->_data['view_model']->set_page($page);
    $this->_data['view_model']->set_list($this->credential_model->get_user_paginated(
      $this->_data['view_model']->get_page(),
      $this->_data['view_model']->get_per_page(),
      $where,
      $order_by,
      $direction));

    if ($format == 'csv')
    {
      header('Content-Type: text/csv');
      header('Content-Disposition: attachment; filename="export.csv"');

      echo $this->_data['view_model']->to_csv();
      exit();
    }

    if ($format != 'view')
    {
      return $this->output->set_content_type('application/json')
        ->set_status_header(200)
        ->set_output(json_encode($this->_data['view_model']->to_json()));
    }

    return $this->render('Admin/User', $this->_data);
  }

  public function add()
  {
    $this->load->model('user_model');
    include_once __DIR__ . '/../../view_models/User_admin_add_view_model.php';
    $session           = $this->get_session();
    $custom_validation = [
      ['email', 'Email', 'trim|required|valid_email|is_unique[credential.email]'],
      ['password', 'Password', 'required']
    ];

    $custom_validation = array_merge($custom_validation, $this->user_model->get_all_validation_rule());

    $this->form_validation     = $this->user_model->set_form_validation($this->form_validation, $custom_validation);
    $this->_data['view_model'] = new User_admin_add_view_model($this->credential_model);
    $this->_data['view_model']->set_heading('Users');
    $this->_data['view_data']['roles'] = $this->credential_model->role_id_mapping();
    $this->load->model('image_model');
    $gallery_images = $this->image_model->get_all();
    foreach ($gallery_images as $key => $image)
    {
      if ($image->type == 4)
      {
        $image->show_url =  $image->url;
      }
      else
      {
        $image->show_url = $image->url;
      }
      $image->type = $this->image_model->type_mapping()[$image->type];
    }
    $this->_data['gallery_images'] = $gallery_images;

    $service = new User_service($this->credential_model, $this->user_model);

    if ($this->form_validation->run() === FALSE)
    {
      return $this->render('Admin/UserAdd', $this->_data);
    }

    $email      = $this->input->post('email', TRUE);
    $first_name = $this->input->post('first_name', TRUE);
    $last_name  = $this->input->post('last_name', TRUE);
    $phone      = $this->input->post('phone', TRUE);
    $image      = $this->input->post('image', TRUE);
    $image_id   = $this->input->post('image_id', TRUE);
    $password   = $this->input->post('password');
    $role_id    = $this->input->post('role_id');

    $created_user = $service->create($email, $password, $first_name, $last_name, $role_id, '');

    if ($created_user)
    {
      $params = [
        'image'    => $image,
        'phone'    => $phone,
        'image_id' => $image_id
      ];
      $this->user_model->edit($params, $created_user->id);

      return $this->redirect('/admin/users/0', 'refresh');
    }

    $this->_data['error'] = 'Error';
    return $this->render('Admin/UserAdd', $this->_data);
  }

  public function edit($id)
  {
    $this->load->model('user_model');
    $model   = $this->credential_model->get($id);
    $session = $this->get_session();
    if (!$model)
    {
      $this->error('Error');
      return redirect('/admin/users/0');
    }

    $user = $this->user_model->get($model->user_id);
    include_once __DIR__ . '/../../view_models/User_credentials_admin_edit_view_model.php';
    $custom_validation = [
      ['role_id', 'Role', 'required']
    ];

    $custom_validation         = array_merge($custom_validation, $this->user_model->get_all_validation_rule());
    $this->form_validation     = $this->user_model->set_form_validation($this->form_validation, $custom_validation);
    $this->_data['view_model'] = new User_credentials_admin_edit_view_model($this->credential_model);
    $this->_data['view_model']->set_model($model);
    $this->_data['view_model']->set_heading('Users');
    $this->_data['view_model']->set_first_name($user->first_name);
    $this->_data['view_model']->set_last_name($user->last_name);
    $this->_data['view_model']->set_phone($user->phone);
    $this->_data['view_model']->set_image($user->image);
    $this->_data['view_model']->set_image_id($user->image_id);
    $this->_data['view_data']['roles']  = $this->credential_model->role_id_mapping();
    $this->_data['view_data']['status'] = $this->credential_model->status_mapping();
    $this->load->model('image_model');
    $gallery_images = $this->image_model->get_all();
    foreach ($gallery_images as $key => $image)
    {
      if ($image->type == 4)
      {
        $image->show_url =  $image->url;
      }
      else
      {
        $image->show_url = $image->url;
      }
      $image->type = $this->image_model->type_mapping()[$image->type];
    }
    $this->_data['gallery_images'] = $gallery_images;

    if ($this->form_validation->run() === FALSE)
    {
      return $this->render('Admin/UserEdit', $this->_data);
    }

    $email      = $this->input->post('email', TRUE);
    $first_name = $this->input->post('first_name', TRUE);
    $last_name  = $this->input->post('last_name', TRUE);
    $phone      = $this->input->post('phone', TRUE);
    $role_id    = $this->input->post('role_id', TRUE);
    $status     = $this->input->post('status', TRUE);
    $image      = $this->input->post('image', TRUE);
    $image_id   = $this->input->post('image_id', TRUE);
    $password   = $this->input->post('password', TRUE);

    $credential_params = [
      'email'   => $email,
      'role_id' => $role_id,
      'status'  => $status
    ];

    if (strlen($password) > 2)
    {
      $credential_params['password'] = str_replace('$2y$', '$2b$', password_hash($password, PASSWORD_BCRYPT));
    }

    $params = [
      'first_name' => $first_name,
      'last_name'  => $last_name,
      'phone'      => $phone,
      'image'      => $image,
      'image_id'   => $image_id
    ];
    $credential_obj    = $this->credential_model->get_by_field('user_id', $model->user_id);
    $credential_result = $this->credential_model->edit($credential_params, $credential_obj->id);
    $result            = $this->user_model->edit($params, $model->id);
    if ($result && $credential_result)
    {
      $this->success('Saved');
      return $this->redirect('/admin/users/0', 'refresh');
    }
    $this->_data['error'] = 'Error';
    return $this->render('Admin/UserEdit', $this->_data);
  }

  public function view($id)
  {
    $model = $this->credential_model->get($id);
    $this->load->model('user_model');
    $user              = $this->user_model->get_by_field('id', $model->user_id);
    $model->first_name = $user->first_name ? $user->first_name : 'N/A';
    $model->last_name  = $user->last_name ? $user->last_name : 'N/A';
    $model->image      = $user->image ? $user->image : '';
    $model->image_id   = $user->image_id ? $user->image_id : '0';
    $model->phone      = $user->phone ? $user->phone : 'N/A';

    if (!$model)
    {
      $this->error('Error');
      return redirect('/admin/users/0');
    }

    include_once __DIR__ . '/../../view_models/User_admin_view_view_model.php';
    $this->_data['view_model'] = new User_admin_view_view_model($this->credential_model);
    $this->_data['view_model']->set_heading('Users');
    $this->_data['view_model']->set_model($model);
    $this->_data['view_model']->set_first_name($user->first_name);
    $this->_data['view_model']->set_last_name($user->last_name);
    $this->_data['view_model']->set_phone($user->phone);
    $this->_data['view_model']->set_role_id($model->role_id);
    $this->_data['view_model']->set_image($user->image);
    $this->_data['view_model']->set_image_id($user->image_id);

    $this->_data['view_model']->set_id($model->user_id);

    return $this->render('Admin/UserView', $this->_data);
  }

}
