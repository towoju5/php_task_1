<?php defined('BASEPATH') OR exit('No direct script access allowed');
/*Powered By: Manaknightdigital Inc. https://manaknightdigital.com/ Year: 2021*/
/**
 * Token_model Model
 * @copyright 2019 Manaknightdigital Inc.
 * @link https://manaknightdigital.com
 * @license Proprietary Software licensing
 * @author Ryan Wong
 *
 */
class Token_model extends Manaknight_Model
{
	protected $_table = 'token';
	protected $_primary_key = 'id';
	protected $_return_type = 'array';
	protected $_allowed_fields = [
    'id',
		'token',
		'data',
		'type',
		'user_id',
		'ttl',
		'issue_at',
		'expire_at',
		'status',
		
    ];
	protected $_label_fields = [
    'ID','xyzToken','Data','Token Type','xUser','Time To Live','Issue at','Expire at','Status',
    ];
	protected $_use_timestamps = FALSE;
	protected $_created_field = 'created_at';
	protected $_updated_field = 'updated_at';
	protected $_validation_rules = [
    ['id', 'ID', ''],
		['token', 'xyzToken', 'required'],
		['data', 'Data', 'required'],
		['type', 'Token Type', 'required|integer'],
		['user_id', 'xUser', 'required|integer'],
		['ttl', 'Time To Live', 'required|integer'],
		['issue_at', 'Issue at', 'required'],
		['expire_at', 'Expire at', 'required'],
		['status', 'Status', 'required|integer'],
		
    ];
	protected $_validation_edit_rules = [
    ['id', 'ID', ''],
		['token', 'xyzToken', 'required'],
		['data', 'Data', 'required'],
		['type', 'Token Type', 'required|integer'],
		['user_id', 'xUser', 'required|integer'],
		['ttl', 'Time To Live', 'required|integer'],
		['issue_at', 'Issue at', 'required'],
		['expire_at', 'Expire at', 'required'],
		['status', 'Status', 'required|integer'],
		
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
        $data['status'] = 1;

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


	public function status_mapping ()
	{
		return [
			0 => 'Inactive',
			1 => 'Active',
		];
	}

	public function type_mapping ()
	{
		return [
			0 => 'Forgot_token',
			1 => 'Access token',
			2 => 'Refresh_token',
			3 => 'Other',
			4 => 'Api Key',
			5 => 'Api Secret',
			6 => 'Verify',
		];
	}

	const NOT_FOUND = 0;

	const EXPIRED = 1;

	const FOUND = 2;

	public function create_verify_token ($user_id, $phone)
	{
		$code = rand(100000,999999);
		$expire_at = date('Y-m-j H:i:s', time() + 60 * 5);
		$token = $this->create([
			'token' => $code,
			'data' => json_encode([
				'code' => $code,
				'phone' => $phone
			]),
			'type' => 6,
			'user_id' => $user_id,
			'ttl' => 5 * 60,
			'issue_at' => date('Y-m-j H:i:s'),
			'expire_at' => $expire_at,
			'status' => 1
		]);
		return $code;
	}

	public function check_verify_token ($code)
	{
		$exist = $this->get_by_field('token', $code);
		if (!$exist)
		{
			return NOT_FOUND;
		}
		$expire_at = strtotime($exist->expire_at);

		if ($expire_at < time())
		{
			return EXPIRED;
		}
		return json_decode($exist->data, TRUE);
	}

	public function get_user ($where)
	{
		return $this->_join ('user', 'user_id', $where, []);
	}

	public function get_user_paginated ($page, $limit, $where, $order_by, $direction)
	{
		return $this->_join_paginate ('user', 'user_id', $where, $page, $limit, $order_by, $direction, []);
	}

	public function count_paginated ($where)
	{
		return count($this->_join ('user', 'user_id', $where, []));
	}



}