<?php defined('BASEPATH') OR exit('No direct script access allowed');
/*Powered By: Manaknightdigital Inc. https://manaknightdigital.com/ Year: 2021*/
/**
 * Image_model Model
 * @copyright 2019 Manaknightdigital Inc.
 * @link https://manaknightdigital.com
 * @license Proprietary Software licensing
 * @author Ryan Wong
 *
 */
class Image_model extends Manaknight_Model
{
	protected $_table = 'image';
	protected $_primary_key = 'id';
	protected $_return_type = 'array';
	protected $_allowed_fields = [
    'id',
		'url',
		'caption',
		'user_id',
		'width',
		'height',
		'type',
		
    ];
	protected $_label_fields = [
    'ID','URL','Caption','xUser','Width','Height','Image Type',
    ];
	protected $_use_timestamps = TRUE;
	protected $_created_field = 'created_at';
	protected $_updated_field = 'updated_at';
	protected $_validation_rules = [
    ['id', 'ID', ''],
		['url', 'URL', 'required'],
		['caption', 'Caption', ''],
		['user_id', 'xUser', 'required|integer'],
		['width', 'Width', ''],
		['height', 'Height', ''],
		['type', 'Image Type', ''],
		
    ];
	protected $_validation_edit_rules = [
    ['id', 'ID', ''],
		['url', 'URL', 'required'],
		['caption', 'Caption', ''],
		['user_id', 'xUser', 'required|integer'],
		['width', 'Width', ''],
		['height', 'Height', ''],
		['type', 'Image Type', ''],
		
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
        if(!isset($data['url_id']))
		{
			unset($data['url_id']);
		}
			if(!isset($data['caption']))
		{
			$data['caption'] = '';
		}
			if(!isset($data['width']))
		{
			$data['width'] = 0;
		}
		if(!isset($data['height']))
		{
			$data['height'] = 0;
		}
		if(!isset($data['type']))
		{
			$data['type'] = 0;
		}
		if(!isset($data['user_id']) || $data['user_id'] == 0)
		{
			$data['user_id'] = 1;
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
        if(!isset($data['url_id']))
		{
			unset($data['url_id']);
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


	public function type_mapping ()
	{
		return [
			0 => 'Server Hosted',
			1 => 'External Link',
			2 => 'S3',
			3 => 'Cloudinary',
			4 => 'File',
			5 => 'External File',
			6 => 'Video',
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