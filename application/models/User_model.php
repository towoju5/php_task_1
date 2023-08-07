<?php defined('BASEPATH') OR exit('No direct script access allowed');
/*Powered By: Manaknightdigital Inc. https://manaknightdigital.com/ Year: 2021*/
/**
 * User_model Model
 * @copyright 2019 Manaknightdigital Inc.
 * @link https://manaknightdigital.com
 * @license Proprietary Software licensing
 * @author Ryan Wong
 *
 */
class User_model extends Manaknight_Model
{
	protected $_table = 'user';
	protected $_primary_key = 'id';
	protected $_return_type = 'array';
	protected $_allowed_fields = [
    'id',
		'first_name',
		'last_name',
		'paypal_email',
		'phone',
		'image',
		'image_id',
		'refer',
		'profile_id',
		'stripe_id',
		
    ];
	protected $_label_fields = [
    'ID','First Name','Last Name','Email #','Phone #','Image','Image ID','Refer Code','Profile','Stripe Id',
    ];
	protected $_use_timestamps = TRUE;
	protected $_created_field = 'created_at';
	protected $_updated_field = 'updated_at';
	protected $_validation_rules = [
    ['id', 'ID', ''],
		['first_name', 'First Name', ''],
		['last_name', 'Last Name', ''],
		['paypal_email', 'Email #', ''],
		['phone', 'Phone #', ''],
		['image', 'Image', ''],
		['image_id', 'Image ID', ''],
		['refer', 'Refer Code', ''],
		['profile_id', 'Profile', ''],
		['stripe_id', 'Stripe Id', ''],
		
    ];
	protected $_validation_edit_rules = [
    ['id', 'ID', ''],
		['first_name', 'First Name', ''],
		['last_name', 'Last Name', ''],
		['paypal_email', 'Email #', ''],
		['phone', 'Phone #', ''],
		['image', 'Image', ''],
		['image_id', 'Image ID', ''],
		['refer', 'Refer Code', ''],
		['profile_id', 'Profile', ''],
		['stripe_id', 'Stripe Id', ''],
		
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
        $data['image'] = 'https://i.imgur.com/AzJ7DRw.png';
		$data['refer'] = uniqid();
		$data['status'] = 1;
		$data['verify'] = 0;
		$data['stripe_id'] = '';

		if(!isset($data['profile_id']))
		{
			$data['profile_id'] = 0;
		}

		if(!isset($data['type']))
		{
			$data['type'] = 'n';
		}
		if (strpos($data['phone'], '1') != 0)
		{
			$data['phone'] = '1' + $data['phone'];
		}

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
        

		if(isset($data['image']) && strlen($data['image']) < 1)
		{
			unset($data['image']);
		}

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
			2 => 'Suspend',
		];
	}




}