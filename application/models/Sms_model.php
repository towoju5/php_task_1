<?php defined('BASEPATH') OR exit('No direct script access allowed');
/*Powered By: Manaknightdigital Inc. https://manaknightdigital.com/ Year: 2021*/
/**
 * Sms_model Model
 * @copyright 2019 Manaknightdigital Inc.
 * @link https://manaknightdigital.com
 * @license Proprietary Software licensing
 * @author Ryan Wong
 *
 */
class Sms_model extends Manaknight_Model
{
	protected $_table = 'sms';
	protected $_primary_key = 'id';
	protected $_return_type = 'array';
	protected $_allowed_fields = [
    'id',
		'slug',
		'tag',
		'content',
		
    ];
	protected $_label_fields = [
    'ID','xyzSMS Slug','Replacement Tags','SMS Body',
    ];
	protected $_use_timestamps = TRUE;
	protected $_created_field = 'created_at';
	protected $_updated_field = 'updated_at';
	protected $_validation_rules = [
    ['id', 'ID', ''],
		['slug', 'xyzSMS Slug', 'required|is_unique[sms.slug]'],
		['tag', 'Replacement Tags', 'required'],
		['content', 'SMS Body', 'required'],
		
    ];
	protected $_validation_edit_rules = [
    ['id', 'ID', ''],
		['slug', 'xyzSMS Slug', ''],
		['tag', 'Replacement Tags', ''],
		['content', 'SMS Body', 'required'],
		
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
        if(isset($data['slug']))
		{
			unset($data['slug']);
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


	public function get_template($slug,$data)
	{
		$this->db->from('sms');
		$this->db->where('slug',$slug,TRUE);
		$template=$this->db->get()->row();
		if(!$template)
		{
			return FALSE;
		}
		$tags_raw=$template->tags;
		$tags=explode(',',$tags_raw);
		$template->content=$this->inject_substitute($template->content,$tags,$data);
		return $template;
	}

	public function inject_substitute($raw, $tags, $data) 
	{
		foreach ($data as $key => $value) 
		{
			if (in_array($key, $tags))
			{
				$raw = str_replace('{{{' . $key . '}}}', $value, $raw);
			}
		}
		return $raw;
	}



}