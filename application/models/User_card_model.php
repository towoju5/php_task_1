<?php defined('BASEPATH') OR exit('No direct script access allowed');
/*Powered By: Manaknightdigital Inc. https://manaknightdigital.com/ Year: 2021*/
/**
 * User_card_model Model
 * @copyright 2019 Manaknightdigital Inc.
 * @link https://manaknightdigital.com
 * @license Proprietary Software licensing
 * @author Ryan Wong
 *
 */
class User_card_model extends Manaknight_Model
{
	protected $_table = 'user_card';
	protected $_primary_key = 'id';
	protected $_return_type = 'array';
	protected $_allowed_fields = [
    'id',
		'is_default',
		'user_id',
		'stripe_card_id',
		'last4',
		'brand',
		'exp_month',
		'exp_year',
		
    ];
	protected $_label_fields = [
    'ID','Is Default','User ID','Stripe Card ID','Last4','Brand','Expire month','Expire year',
    ];
	protected $_use_timestamps = TRUE;
	protected $_created_field = 'created_at';
	protected $_updated_field = 'updated_at';
	protected $_validation_rules = [
    ['id', 'ID', ''],
		['is_default', 'Is Default', 'required|integer'],
		['user_id', 'User ID', ''],
		['stripe_card_id', 'Stripe Card ID', ''],
		['last4', 'Last4', ''],
		['brand', 'Brand', ''],
		['exp_month', 'Expire month', ''],
		['exp_year', 'Expire year', ''],
		
    ];
	protected $_validation_edit_rules = [
    ['id', 'ID', ''],
		['is_default', 'Is Default', 'required|integer'],
		['user_id', 'User ID', ''],
		['stripe_card_id', 'Stripe Card ID', ''],
		['last4', 'Last4', ''],
		['brand', 'Brand', ''],
		['exp_month', 'Expire month', ''],
		['exp_year', 'Expire year', ''],
		
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


	public function is_default_mapping ()
	{
		return [
			0 => 'No',
			1 => 'Yes',
		];
	}




}