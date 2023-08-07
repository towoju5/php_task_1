<?php defined('BASEPATH') OR exit('No direct script access allowed');
/*Powered By: Manaknightdigital Inc. https://manaknightdigital.com/ Year: 2021*/
/**
 * Transaction_model Model
 * @copyright 2019 Manaknightdigital Inc.
 * @link https://manaknightdigital.com
 * @license Proprietary Software licensing
 * @author Ryan Wong
 *
 */
class Transaction_model extends Manaknight_Model
{
	protected $_table = 'transaction';
	protected $_primary_key = 'id';
	protected $_return_type = 'array';
	protected $_allowed_fields = [
    'id',
		'order_id',
		'user_id',
		'transaction_date',
		'transaction_time',
		'subtotal',
		'tax',
		'discount',
		'total',
		'stripe_charge_id',
		'payment_method',
		'status',
		
    ];
	protected $_label_fields = [
    'ID','Order ID','User ID','Transaction Date','Transaction Time','Subtotal','Tax','Discount','Total','Stripe Charge ID','Payment Method','Status',
    ];
	protected $_use_timestamps = TRUE;
	protected $_created_field = 'created_at';
	protected $_updated_field = 'updated_at';
	protected $_validation_rules = [
    ['id', 'ID', ''],
		['order_id', 'Order ID', 'required|integer'],
		['user_id', 'User ID', 'required|integer'],
		['transaction_date', 'Transaction Date', 'required|date'],
		['transaction_time', 'Transaction Time', 'required'],
		['subtotal', 'Subtotal', 'required'],
		['tax', 'Tax', 'required'],
		['discount', 'Discount', 'required'],
		['total', 'Total', 'required'],
		['stripe_charge_id', 'Stripe Charge ID', 'required'],
		['payment_method', 'Payment Method', 'required|integer'],
		['status', 'Status', 'required|integer'],
		
    ];
	protected $_validation_edit_rules = [
    ['id', 'ID', ''],
		['order_id', 'Order ID', 'required|integer'],
		['user_id', 'User ID', 'required|integer'],
		['transaction_date', 'Transaction Date', ''],
		['transaction_time', 'Transaction Time', 'required'],
		['subtotal', 'Subtotal', 'required'],
		['tax', 'Tax', 'required'],
		['discount', 'Discount', 'required'],
		['total', 'Total', 'required'],
		['stripe_charge_id', 'Stripe Charge ID', 'required'],
		['payment_method', 'Payment Method', 'required|integer'],
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


	public function payment_method_mapping ()
	{
		return [
			1 => 'Stripe',
			2 => 'Paypal',
		];
	}

	public function status_mapping ()
	{
		return [
			1 => 'Active',
			0 => 'Inactive',
		];
	}




}