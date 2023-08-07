<?php defined('BASEPATH') OR exit('No direct script access allowed');
/*Powered By: Manaknightdigital Inc. https://manaknightdigital.com/ Year: 2021*/
/**
 * Refund_model Model
 * @copyright 2019 Manaknightdigital Inc.
 * @link https://manaknightdigital.com
 * @license Proprietary Software licensing
 * @author Ryan Wong
 *
 */
class Refund_model extends Manaknight_Model
{
	protected $_table = 'refund';
	protected $_primary_key = 'id';
	protected $_return_type = 'array';
	protected $_allowed_fields = [
    'id',
		'order_id',
		'user_id',
		'amount',
		'reason',
		'explanation',
		'receipt_url',
		'stripe_charge_id',
		'stripe_invoice_id',
		'status',
		
    ];
	protected $_label_fields = [
    'ID','Order ID','User ID','Amount','Reason','Explanation','Receipt URL','Stripe Charge ID','Stripe Invoice ID','Status',
    ];
	protected $_use_timestamps = TRUE;
	protected $_created_field = 'created_at';
	protected $_updated_field = 'updated_at';
	protected $_validation_rules = [
    ['id', 'ID', ''],
		['order_id', 'Order ID', 'required'],
		['user_id', 'User ID', ''],
		['amount', 'Amount', ''],
		['reason', 'Reason', ''],
		['explanation', 'Explanation', ''],
		['receipt_url', 'Receipt URL', ''],
		['stripe_charge_id', 'Stripe Charge ID', 'required'],
		['stripe_invoice_id', 'Stripe Invoice ID', ''],
		['status', 'Status', ''],
		
    ];
	protected $_validation_edit_rules = [
    ['id', 'ID', ''],
		['order_id', 'Order ID', 'required'],
		['user_id', 'User ID', ''],
		['amount', 'Amount', ''],
		['reason', 'Reason', ''],
		['explanation', 'Explanation', ''],
		['receipt_url', 'Receipt URL', ''],
		['stripe_charge_id', 'Stripe Charge ID', 'required'],
		['stripe_invoice_id', 'Stripe Invoice ID', ''],
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





}