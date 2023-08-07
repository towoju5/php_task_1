<?php defined('BASEPATH') OR exit('No direct script access allowed');
/*Powered By: Manaknightdigital Inc. https://manaknightdigital.com/ Year: 2021*/
/**
 * Credential_model Model
 * @copyright 2019 Manaknightdigital Inc.
 * @link https://manaknightdigital.com
 * @license Proprietary Software licensing
 * @author Ryan Wong
 *
 */
class Credential_model extends Manaknight_Model
{
	protected $_table = 'credential';
	protected $_primary_key = 'id';
	protected $_return_type = 'array';
	protected $_allowed_fields = [
    'id',
		'email',
		'password',
		'type',
		'verify',
		'role_id',
		'user_id',
		'status',
		
    ];
	protected $_label_fields = [
    'ID','Email','Password','xyzType','Verified','Role','xUser','Status',
    ];
	protected $_use_timestamps = TRUE;
	protected $_created_field = 'created_at';
	protected $_updated_field = 'updated_at';
	protected $_validation_rules = [
    ['id', 'ID', ''],
		['email', 'Email', 'trim|required|valid_email'],
		['password', 'Password', 'required'],
		['type', 'xyzType', ''],
		['verify', 'Verified', ''],
		['role_id', 'Role', ''],
		['user_id', 'xUser', ''],
		['status', 'Status', ''],
		
    ];
	protected $_validation_edit_rules = [
    ['id', 'ID', ''],
		['email', 'Email', 'trim|required|valid_email'],
		['password', 'Password', ''],
		['type', 'xyzType', ''],
		['verify', 'Verified', ''],
		['role_id', 'Role', ''],
		['user_id', 'xUser', ''],
		['status', 'Status', 'required|in_list[0,1,2]'],
		
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


	public function verify_mapping ()
	{
		return [
			0 => 'Not verified',
			1 => 'Verified',
		];
	}

	public function status_mapping ()
	{
		return [
			0 => 'Inactive',
			1 => 'Active',
			2 => 'Suspend',
		];
	}

	public function role_id_mapping ()
	{
		return [
			1 => 'Member',
			2 => 'Admin',
		];
	}

	public function type_mapping ()
	{
		return [
			'n' => 'Normal',
			'f' => 'Facebook',
			'g' => 'Google',
		];
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