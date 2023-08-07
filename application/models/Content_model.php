<?php defined('BASEPATH') OR exit('No direct script access allowed');
/*Powered By: Manaknightdigital Inc. https://manaknightdigital.com/ Year: 2021*/
/**
 * Content_model Model
 * @copyright 2019 Manaknightdigital Inc.
 * @link https://manaknightdigital.com
 * @license Proprietary Software licensing
 * @author Ryan Wong
 *
 */
class Content_model extends Manaknight_Model
{
	protected $_table = 'content';
	protected $_primary_key = 'id';
	protected $_return_type = 'array';
	protected $_allowed_fields = [
    'id',
		'content_name',
		'content_type',
		'content',
		'status',
		
    ];
	protected $_label_fields = [
    'ID','Content Name','Content Type','Content','Status',
    ];
	protected $_use_timestamps = TRUE;
	protected $_created_field = 'created_at';
	protected $_updated_field = 'updated_at';
	protected $_validation_rules = [
    ['id', 'ID', ''],
		['content_name', 'Content Name', 'required'],
		['content_type', 'Content Type', 'required|integer'],
		['content', 'Content', 'required'],
		['status', 'Status', 'required'],
		
    ];
	protected $_validation_edit_rules = [
    ['id', 'ID', ''],
		['content_name', 'Content Name', 'required'],
		['content_type', 'Content Type', 'required|integer'],
		['content', 'Content', 'required'],
		['status', 'Status', 'required'],
		
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


	public function content_type_mapping ()
	{
		return [
			1 => 'Text',
			2 => 'Image',
			3 => 'Link',
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