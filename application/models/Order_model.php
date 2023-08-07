<?php defined('BASEPATH') OR exit('No direct script access allowed');
/*Powered By: Manaknightdigital Inc. https://manaknightdigital.com/ Year: 2021*/
/**
 * Order_model Model
 * @copyright 2019 Manaknightdigital Inc.
 * @link https://manaknightdigital.com
 * @license Proprietary Software licensing
 * @author Ryan Wong
 *
 */
class Order_model extends Manaknight_Model
{
	protected $_table = 'order';
	protected $_primary_key = 'id';
	protected $_return_type = 'array';
	protected $_allowed_fields = [
    'id',
		'purchase_user_id',
		'sale_user_id',
		'inventory_id',
		'order_date',
		'order_time',
		'subtotal',
		'tax',
		'discount',
		'total',
		'stripe_charge_id',
		'stripe_intent',
		'status',
		
    ];
	protected $_label_fields = [
    'ID','Purchase User ID','Sale User ID','Inventory ID','Order Date','Order Time','Subtotal','Tax','Discount','Total','Stripe Charge ID','xyzstripe_intent','Status',
    ];
	protected $_use_timestamps = TRUE;
	protected $_created_field = 'created_at';
	protected $_updated_field = 'updated_at';
	protected $_validation_rules = [
    ['id', 'ID', ''],
		['purchase_user_id', 'Purchase User ID', 'required|integer'],
		['sale_user_id', 'Sale User ID', 'required|integer'],
		['inventory_id', 'Inventory ID', 'required|integer'],
		['order_date', 'Order Date', 'required|date'],
		['order_time', 'Order Time', 'required'],
		['subtotal', 'Subtotal', 'required'],
		['tax', 'Tax', 'required'],
		['discount', 'Discount', 'required'],
		['total', 'Total', 'required'],
		['stripe_charge_id', 'Stripe Charge ID', 'required'],
		['stripe_intent', 'xyzstripe_intent', 'required'],
		['status', 'Status', 'required|integer'],
		
    ];
	protected $_validation_edit_rules = [
    ['id', 'ID', ''],
		['purchase_user_id', 'Purchase User ID', 'required|integer'],
		['sale_user_id', 'Sale User ID', 'required|integer'],
		['inventory_id', 'Inventory ID', 'required|integer'],
		['order_date', 'Order Date', ''],
		['order_time', 'Order Time', 'required'],
		['subtotal', 'Subtotal', 'required'],
		['tax', 'Tax', 'required'],
		['discount', 'Discount', 'required'],
		['total', 'Total', 'required'],
		['stripe_charge_id', 'Stripe Charge ID', 'required'],
		['stripe_intent', 'xyzstripe_intent', 'required'],
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


	public function status_mapping ()
	{
		return [
			1 => 'Paid',
			2 => 'Refunded',
			3 => 'Disputed',
			4 => 'Canceled',
		];
	}




}