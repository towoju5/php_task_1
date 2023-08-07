<?php defined('BASEPATH') || exit('No direct script access allowed');
include_once 'Member_controller.php';
/*Powered By: Manaknightdigital Inc. https://manaknightdigital.com/ Year: 2021*/
/**
 * User_card Controller
 * @copyright 2019 Manaknightdigital Inc.
 * @link https://manaknightdigital.com
 * @license Proprietary Software licensing
 * @author Ryan Wong
 *
 */
class Member_user_card_controller extends Member_controller
{
  /**
   * @var string
   */
  protected $_model_file = 'user_card_model';
  /**
   * @var string
   */
  public $_page_name = 'User Card';

  public function __construct()
  {
    parent::__construct();

    $this->load->model('credential_model');
    $this->load->model('user_model');

    $this->load->library('stripe_helper_service');
  }

  /**
   * @param $page
   * @return mixed
   */
  public function index($page)
  {
    $this->load->library('pagination');
    include_once __DIR__ . '/../../view_models/User_card_member_list_paginate_view_model.php';
    $session = $this->get_session();
    $user_id = $this->session->userdata('user_id');

    $format        = $this->input->get('format', TRUE) ?? 'view';
    $order_by      = $this->input->get('order_by', TRUE) ?? '';
    $direction     = $this->input->get('direction', TRUE) ?? 'ASC';
    $per_page_sort = $this->input->get('per_page_sort', TRUE) ?? 25;

    $this->_data['view_model'] = new User_card_member_list_paginate_view_model(
      $this->user_card_model,
      $this->pagination,
      '/member/user_card/0');
    $this->_data['view_model']->set_heading('User Card');
    $this->_data['view_model']->set_is_default(($this->input->get('is_default', TRUE) != NULL) ? $this->input->get('is_default', TRUE) : NULL);
    // $this->_data['view_model']->set_user_id(($this->input->get('user_id', TRUE) != NULL) ? $this->input->get('user_id', TRUE) : NULL);
    $this->_data['view_model']->set_last4(($this->input->get('last4', TRUE) != NULL) ? $this->input->get('last4', TRUE) : NULL);

    $where = [
      'is_default' => $this->_data['view_model']->get_is_default(),
      'user_id'    => $user_id,
      'last4'      => $this->_data['view_model']->get_last4()
    ];

    $this->_data['view_model']->set_total_rows($this->user_card_model->count($where));

    $this->_data['view_model']->set_format_layout($this->_data['layout_clean_mode']);
    $this->_data['view_model']->set_per_page($per_page_sort);
    $this->_data['view_model']->set_order_by($order_by);
    $this->_data['view_model']->set_sort($direction);
    $this->_data['view_model']->set_sort_base_url('/member/user_card/0');
    $this->_data['view_model']->set_page($page);
    $this->_data['view_model']->set_list($this->user_card_model->get_paginated(
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

    return $this->render('Member/User_card', $this->_data);
  }

  /**
   * @return mixed
   */
  public function add()
  {
    include_once __DIR__ . '/../../view_models/User_card_member_add_view_model.php';
    $session = $this->get_session();
    $user_id = $this->session->userdata('user_id');

    $this->form_validation = $this->user_card_model->set_form_validation(
      $this->form_validation, $this->user_card_model->get_all_validation_rule());
    $this->_data['view_model'] = new User_card_member_add_view_model($this->user_card_model);
    $this->_data['view_model']->set_heading('User Card');

    if ($this->form_validation->run() === FALSE)
    {
      return $this->render('Member/User_cardAdd', $this->_data);
    }

    $user_all_card_data = $this->user_card_model->get_all(['user_id' => $user_id]);
    // $user_card_data     = $this->user_card_model->get_by_field('user_id', $user_id);

    $is_default  = $this->input->post('is_default', TRUE);
    $card_name   = $this->input->post('card_name', TRUE);
    $card_number = $this->input->post('card_number', TRUE);
    $exp_month   = $this->input->post('exp_month', TRUE);
    $exp_year    = $this->input->post('exp_year', TRUE);
    $cvc         = $this->input->post('cvc', TRUE);

    $new_card_last4 = substr($card_number, 12);

    if (!empty($user_all_card_data))
    {
      if (!empty($card_number) && !empty($exp_month) && !empty($exp_year) && !empty($cvc))
      {
        // use for each
        foreach ($user_all_card_data as $key1 => $res1)
        {
          if ($res1->last4 == $new_card_last4)
          {
            // throw error
            $this->error('This card last4->(...' . $new_card_last4 . ') is already added. Try again with a new card.');
            return redirect($_SERVER['HTTP_REFERER']);
          }
        }
        // add card
        $this->stripe_helper_service->set_config($this->config);
        $response = $this->stripe_helper_service->create_stripe_token($card_number, $exp_month, $exp_year, $cvc);

        if (isset($response['success']))
        {
          $stripe_token_id = $response['token']->id;

          $this->stripe_helper_service->set_user_model($this->user_model);
          // pass token_id to assign card to user
          $res_card_data = $this->stripe_helper_service->add_new_card($stripe_token_id, $user_id);

          if (isset($res_card_data['success']))
          {
            $stripe_card_id   = $res_card_data['card_data']->id;
            $stripe_brand     = $res_card_data['card_data']->brand;
            $stripe_exp_month = $res_card_data['card_data']->exp_month;
            $stripe_exp_year  = $res_card_data['card_data']->exp_year;
            $stripe_last4     = $res_card_data['card_data']->last4;

            // store the card id with the associated user
            $check_new_card = $this->user_card_model->create([
              'is_default'     => 0,
              'user_id'        => $user_id,
              'stripe_card_id' => $stripe_card_id,
              'last4'          => $stripe_last4,
              'brand'          => $stripe_brand,
              'exp_month'      => $stripe_exp_month,
              'exp_year'       => $stripe_exp_year
            ]);

            if ($check_new_card)
            {
              $this->success('Card added successfully.');
              return $this->redirect('/member/user_card/0', 'refresh');
            }
            else
            {
              $this->error('Card add failed. Try Again.');
              return redirect($_SERVER['HTTP_REFERER']);
            }
          }
          else
          {
            // when user do not have the user->stripe_id
            $this->error($res_card_data['error_msg']);
            return redirect($_SERVER['HTTP_REFERER']);
          }
        }
        else
        {
          // when new card validation failed
          $this->error($response['error_msg']);
          return redirect($_SERVER['HTTP_REFERER']);
        }

      }
      else
      {
        $this->error('Empty Field');
        return redirect($_SERVER['HTTP_REFERER']);
      }
    }
    else
    {
      // create stripe_customer_id and add the new card
      $this->stripe_helper_service->set_config($this->config);
      $response = $this->stripe_helper_service->create_stripe_token($card_number, $exp_month, $exp_year, $cvc);

      if (isset($response['success']))
      {
        $stripe_token_id = $response['token']->id;
        // var_dump($stripe_token_id);
        // die();

        // get user email from credential model
        $customer_email = $this->credential_model->get_by_field('user_id', $user_id);

        $this->stripe_helper_service->set_config($this->config);
        $res_customer = $this->stripe_helper_service->create_stripe_customer_with_card($customer_email, $stripe_token_id);

        if (isset($res_customer['success']))
        {
          $stripe_customer_id = $res_customer['card']->customer;
          $stripe_card_id     = $res_customer['card']->id;
          $stripe_brand       = $res_customer['card']->brand;
          $stripe_exp_month   = $res_customer['card']->exp_month;
          $stripe_exp_year    = $res_customer['card']->exp_year;
          $stripe_last4       = $res_customer['card']->last4;

          // update user->stripe_id
          $update_stripe_id = $this->user_model->edit([
            'stripe_id' => $stripe_customer_id
          ], $user_id);

          // add card on user_card
          if ($update_stripe_id)
          {
            // store the card id with the associated user
            $check_new_card = $this->user_card_model->create([
              'is_default'     => 1,
              'user_id'        => $user_id,
              'stripe_card_id' => $stripe_card_id,
              'last4'          => $stripe_last4,
              'brand'          => $stripe_brand,
              'exp_month'      => $stripe_exp_month,
              'exp_year'       => $stripe_exp_year
            ]);

            if ($check_new_card)
            {
              $this->success('Card added successfully and set to default.');
              return $this->redirect('/member/user_card/0', 'refresh');
            }
            else
            {
              $this->error('Card add failed. Try Again.');
              return redirect($_SERVER['HTTP_REFERER']);
            }
          }
        }
        else
        {
          $this->error($res_customer['error_msg']);
          return redirect($_SERVER['HTTP_REFERER']);
        }
      }
      else
      {
        // when new card validation failed
        $this->error($response['error_msg']);
        return redirect($_SERVER['HTTP_REFERER']);
      }
    }

    $this->_data['error'] = 'Error';
    return $this->render('Member/User_cardAdd', $this->_data);
  }

  public function set_default()
  {
    $user_id = $this->session->userdata('user_id');

    $user_card_id = $this->input->post('user_card_id');

    if (!empty($user_card_id))
    {
      $user_card_data = $this->user_card_model->get($user_card_id);

      if (!empty($user_card_data))
      {
        if ($user_card_data->is_default == 1)
        {
          $output['error']  = TRUE;
          $output['status'] = 0;
          $output['msg']    = 'This card is already set to default.';
          echo json_encode($output);
          exit();
        }
      }

      $this->stripe_helper_service->set_config($this->config);
      $this->stripe_helper_service->set_user_model($this->user_model);
      $response = $this->stripe_helper_service->update_default_card($user_card_data->stripe_card_id, $user_id);

      if (isset($response['success']))
      {
        // make other cards is_default to = 0
        $all_card_data = $this->user_card_model->get_all(['user_id' => $user_id]);
        if (!empty($all_card_data))
        {
          foreach ($all_card_data as $key1 => $res1)
          {
            $this->user_card_model->edit(['is_default' => 0], $res1->id);
          }
        }

        // then only set is_default 1 to the default card
        $result = $this->user_card_model->edit([
          'is_default' => 1
        ], $user_card_id);

        if ($result)
        {
          $output['success'] = TRUE;
          $output['status']  = 200;
          $output['msg']     = 'Card set to default.';
          echo json_encode($output);
          exit();
        }
        else
        {
          $output['error']  = TRUE;
          $output['status'] = 0;
          $output['msg']    = 'Error! Please try again later.';
          echo json_encode($output);
          exit();
        }
      }
      else
      {
        $output['error']  = TRUE;
        $output['status'] = 0;
        $output['msg']    = $response['error_msg'];
        echo json_encode($output);
        exit();
      }
    }
    else
    {
      $output['error']  = TRUE;
      $output['status'] = 0;
      $output['msg']    = 'Error! User card not found.';
      echo json_encode($output);
      exit();
    }
  }

  public function delete()
  {
    $user_id = $this->session->userdata('user_id');

    $user_card_id = $this->input->post('user_card_id');

    if (!empty($user_card_id))
    {
      $user_card_data = $this->user_card_model->get($user_card_id);

      $this->stripe_helper_service->set_config($this->config);
      $this->stripe_helper_service->set_user_model($this->user_model);
      $response = $this->stripe_helper_service->delete_card_from_customer($user_id, $user_card_data->stripe_card_id);

      if (isset($response['success']))
      {
        $result = $this->user_card_model->real_delete($user_card_id);

        if ($result)
        {
          $output['success'] = TRUE;
          $output['status']  = 200;
          $output['msg']     = 'User card deleted successfully.';
          echo json_encode($output);
          exit();
        }
        else
        {
          $output['error']  = TRUE;
          $output['status'] = 0;
          $output['msg']    = 'Error! Please try again later.';
          echo json_encode($output);
          exit();
        }
      }
      else
      {
        $output['error']  = TRUE;
        $output['status'] = 0;
        $output['msg']    = $response['error_msg'];
        echo json_encode($output);
        exit();
      }
    }
    else
    {
      $output['error']  = TRUE;
      $output['status'] = 0;
      $output['msg']    = 'Error! User card not found.';
      echo json_encode($output);
      exit();
    }
  }

}
