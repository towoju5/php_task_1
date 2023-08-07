<?php defined('BASEPATH') OR exit('No direct script access allowed');
/*Powered By: Manaknightdigital Inc. https://manaknightdigital.com/ Year: 2021*/
/**
 * Marketing_model Model
 * @copyright 2019 Manaknightdigital Inc.
 * @link https://manaknightdigital.com
 * @license Proprietary Software licensing
 * @author Ryan Wong
 *
 */
class Marketing_model extends Manaknight_Model
{
	protected $_table = 'marketing';
	protected $_primary_key = 'id';
	protected $_return_type = 'array';
	protected $_allowed_fields = [
    'id',
		'user_id',
		'password_protect',
		'content_template_path',
		'header_template_path',
		'footer_template_path',
		'title',
		'seo_title',
		'seo_description',
		'content',
		'status',
		'publish_date',
		'slug',
		
    ];
	protected $_label_fields = [
    'ID','User Id','Page Password','Template','Header Template','Footer Template','Title','SEO Title','SEO Description','Content','Status','Published Date','URL',
    ];
	protected $_use_timestamps = TRUE;
	protected $_created_field = 'created_at';
	protected $_updated_field = 'updated_at';
	protected $_validation_rules = [
    ['id', 'ID', ''],
		['user_id', 'User Id', ''],
		['password_protect', 'Page Password', ''],
		['content_template_path', 'Template', ''],
		['header_template_path', 'Header Template', ''],
		['footer_template_path', 'Footer Template', ''],
		['title', 'Title', 'required'],
		['seo_title', 'SEO Title', 'required'],
		['seo_description', 'SEO Description', 'required'],
		['content', 'Content', 'required'],
		['status', 'Status', ''],
		['publish_date', 'Published Date', ''],
		['slug', 'URL', ''],
		
    ];
	protected $_validation_edit_rules = [
    ['id', 'ID', ''],
		['user_id', 'User Id', ''],
		['password_protect', 'Page Password', ''],
		['content_template_path', 'Template', ''],
		['header_template_path', 'Header Template', ''],
		['footer_template_path', 'Footer Template', ''],
		['title', 'Title', 'required'],
		['seo_title', 'SEO Title', 'required'],
		['seo_description', 'SEO Description', 'required'],
		['content', 'Content', 'required'],
		['status', 'Status', ''],
		['publish_date', 'Published Date', ''],
		['slug', 'URL', ''],
		
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
			0 => 'Public',
			1 => 'Private',
			2 => 'Inactive',
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