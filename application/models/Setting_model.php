<?php defined('BASEPATH') OR exit('No direct script access allowed');
/*Powered By: Manaknightdigital Inc. https://manaknightdigital.com/ Year: 2021*/
/**
 * Setting_model Model
 * @copyright 2019 Manaknightdigital Inc.
 * @link https://manaknightdigital.com
 * @license Proprietary Software licensing
 * @author Ryan Wong
 *
 */
class Setting_model extends Manaknight_Model
{
	protected $_table = 'setting';
	protected $_primary_key = 'id';
	protected $_return_type = 'array';
	protected $_allowed_fields = [
    'id',
		'key',
		'type',
		'value',
		
    ];
	protected $_label_fields = [
    'ID','Setting Field','Setting Type','Setting Value',
    ];
	protected $_use_timestamps = TRUE;
	protected $_created_field = 'created_at';
	protected $_updated_field = 'updated_at';
	protected $_validation_rules = [
    ['id', 'ID', ''],
		['key', 'Setting Field', 'required'],
		['type', 'Setting Type', 'required'],
		['value', 'Setting Value', 'required'],
		
    ];
	protected $_validation_edit_rules = [
    ['id', 'ID', ''],
		['key', 'Setting Field', ''],
		['type', 'Setting Type', ''],
		['value', 'Setting Value', 'required'],
		
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
        if(isset($data['key']))
		{
			unset($data['key']);
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
			0 => 'text',
			1 => 'select',
			2 => 'number',
			3 => 'image',
			4 => 'read_only',
		];
	}

	public function maintenance_mapping ()
	{
		return [
			0 => 'No',
			1 => 'Yes',
		];
	}

	public function get_config_settings()
	{
		$this->db->from('setting');
		$results = $this->db->get()->result();
		$data = [];
		foreach ($results as $key => $value)
		{
			$data[$value->key] = $value->value;
		}
		return $data;
	}



}