<?php defined('BASEPATH') OR exit('No direct script access allowed');
/*Powered By: Manaknightdigital Inc. https://manaknightdigital.com/ Year: 2021*/
/**
 * Payout_model Model
 * @copyright 2019 Manaknightdigital Inc.
 * @link https://manaknightdigital.com
 * @license Proprietary Software licensing
 * @author Ryan Wong
 *
 */
class Payout_model extends Manaknight_Model
{
	protected $_table = 'payout';
	protected $_primary_key = 'id';
	protected $_return_type = 'array';
	protected $_allowed_fields = [
    'id',
		'user_id',
		'order_id',
		'inventory_id',
		'name',
		'email',
		'amount',
		'payout_date',
		'status',
		
    ];
	protected $_label_fields = [
    'ID','User ID','Order ID','Order ID','Name','Email','Amount','Expected Payout Date','Status',
    ];
	protected $_use_timestamps = TRUE;
	protected $_created_field = 'created_at';
	protected $_updated_field = 'updated_at';
	protected $_validation_rules = [
    ['id', 'ID', ''],
		['user_id', 'User ID', 'required'],
		['order_id', 'Order ID', 'required'],
		['inventory_id', 'Order ID', ''],
		['name', 'Name', 'required'],
		['email', 'Email', 'required'],
		['amount', 'Amount', 'required'],
		['payout_date', 'Expected Payout Date', 'required'],
		['status', 'Status', ''],
		
    ];
	protected $_validation_edit_rules = [
    ['id', 'ID', ''],
		['user_id', 'User ID', 'required'],
		['order_id', 'Order ID', 'required'],
		['inventory_id', 'Order ID', ''],
		['name', 'Name', 'required'],
		['email', 'Email', 'required'],
		['amount', 'Amount', 'required'],
		['payout_date', 'Expected Payout Date', 'required'],
		['status', 'Status', ''],
		
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


	public function status_mapping ()
	{
		return [
			3 => 'Refunded',
			1 => 'Paid',
			0 => 'Unpaid',
			2 => 'Pending',
		];
	}




}