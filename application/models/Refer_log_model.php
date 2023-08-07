<?php defined('BASEPATH') || exit('No direct script access allowed');
/*Powered By: Manaknightdigital Inc. https://manaknightdigital.com/ Year: 2021*/
/**
 * Refer_log_model Model
 * @copyright 2019 Manaknightdigital Inc.
 * @link https://manaknightdigital.com
 * @license Proprietary Software licensing
 * @author Ryan Wong
 *
 */
class Refer_log_model extends Manaknight_Model
{
  protected $_table          = 'refer_log';
  protected $_primary_key    = 'id';
  protected $_return_type    = 'array';
  protected $_allowed_fields = [
    'id',
    'user_id',
    'referrer_user_id',
    'type',
    'status'

  ];
  protected $_label_fields = [
    'ID', 'Referree User', 'Referrer User', 'Type', 'Status'
  ];
  protected $_use_timestamps   = TRUE;
  protected $_created_field    = 'created_at';
  protected $_updated_field    = 'updated_at';
  protected $_validation_rules = [
    ['id', 'ID', ''],
    ['user_id', 'Referree User', 'required|integer'],
    ['referrer_user_id', 'Referrer User', 'required|integer'],
    ['type', 'Type', 'required|integer'],
    ['status', 'Status', 'required|integer']

  ];
  protected $_validation_edit_rules = [
    ['id', 'ID', ''],
    ['user_id', 'Referree User', ''],
    ['referrer_user_id', 'Referrer User', ''],
    ['type', 'Type', 'required|integer'],
    ['status', 'Status', '']

  ];
  protected $_validation_messages = [

  ];

  public function __construct()
  {
    parent::__construct();
  }

  /**
   * If you need to modify payload before create, overload this function
   *
   * @param mixed $data
   * @return mixed
   */
  protected function _pre_create_processing($data)
  {
    $data['status'] = 0;

    return $data;
  }

  /**
   * If you need to modify payload before edit, overload this function
   *
   * @param mixed $data
   * @return mixed
   */
  protected function _post_edit_processing($data)
  {

    return $data;
  }

  /**
   * Allow user to add extra counting condition so user don't have to change main function
   *
   * @param mixed $parameters
   * @return $db
   */
  protected function _custom_counting_conditions(&$db)
  {

    return $db;
  }

  public function status_mapping()
  {
    return [
      0 => 'Pending',
      1 => 'Confirmed',
      2 => 'Paid'
    ];
  }

  public function type_mapping()
  {
    return [
      0 => 'user'
    ];
  }

  public function get_user($where)
  {
    return $this->_join('user', 'user_id', $where, []);
  }

  public function get_user_paginated($page, $limit, $where, $order_by, $direction)
  {
    return $this->_join_paginate('user', 'user_id', $where, $page, $limit, $order_by, $direction, []);
  }

  public function count_paginated($where)
  {
    return count($this->_join('user', 'user_id', $where, []));
  }

  public function get_referrer($where)
  {
    return $this->_join('referrer', 'referrer_user_id', $where, []);
  }

  public function get_referrer_paginated($page, $limit, $where, $order_by, $direction)
  {
    return $this->_join_paginate('referrer', 'referrer_user_id', $where, $page, $limit, $order_by, $direction, []);
  }

}
