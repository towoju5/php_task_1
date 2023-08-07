<?php defined('BASEPATH') OR exit('No direct script access allowed');
/*Powered By: Manaknightdigital Inc. https://manaknightdigital.com/ Year: 2021*/
/**
 * Ticket_model Model
 * @copyright 2019 Manaknightdigital Inc.
 * @link https://manaknightdigital.com
 * @license Proprietary Software licensing
 * @author Ryan Wong
 *
 */
class Ticket_model extends Manaknight_Model
{
	protected $_table = 'ticket';
	protected $_primary_key = 'id';
	protected $_return_type = 'array';
	protected $_allowed_fields = [
    'id',
		'user_id',
		'order_id',
		'message',
		'receive_status',
		'status',
		
    ];
	protected $_label_fields = [
    'Id','User ID','Order ID','Reason','Admin Received','Status',
    ];
	protected $_use_timestamps = TRUE;
	protected $_created_field = 'created_at';
	protected $_updated_field = 'updated_at';
	protected $_validation_rules = [
    ['id', 'Id', ''],
		['user_id', 'User ID', 'required|integer'],
		['order_id', 'Order ID', 'required|integer'],
		['message', 'Reason', 'required'],
		['receive_status', 'Admin Received', 'required|integer'],
		['status', 'Status', 'required|integer'],
		
    ];
	protected $_validation_edit_rules = [
    ['id', 'Id', ''],
		['user_id', 'User ID', 'required|integer'],
		['order_id', 'Order ID', 'required|integer'],
		['message', 'Reason', 'required'],
		['receive_status', 'Admin Received', 'required|integer'],
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


	public function receive_status_mapping ()
	{
		return [
			1 => 'Yes',
			0 => 'No',
		];
	}

	public function status_mapping ()
	{
		return [
			1 => 'Resolved',
			0 => 'Unsolved',
		];
	}




}