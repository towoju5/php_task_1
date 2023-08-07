<?php defined('BASEPATH') OR exit('No direct script access allowed');
/*Powered By: Manaknightdigital Inc. https://manaknightdigital.com/ Year: 2021*/
/**
 * Email_model Model
 * @copyright 2019 Manaknightdigital Inc.
 * @link https://manaknightdigital.com
 * @license Proprietary Software licensing
 * @author Ryan Wong
 *
 */
class Email_model extends Manaknight_Model
{
	protected $_table = 'email';
	protected $_primary_key = 'id';
	protected $_return_type = 'array';
	protected $_allowed_fields = [
    'id',
		'slug',
		'email_header',
		'email_footer',
		'subject',
		'tag',
		'html',
		
    ];
	protected $_label_fields = [
    'ID','Email Type','Body Header','Body Footer','Subject','Replacement Tags','Email Body',
    ];
	protected $_use_timestamps = TRUE;
	protected $_created_field = 'created_at';
	protected $_updated_field = 'updated_at';
	protected $_validation_rules = [
    ['id', 'ID', ''],
		['slug', 'Email Type', 'required|is_unique[email.slug]'],
		['email_header', 'Body Header', 'required'],
		['email_footer', 'Body Footer', 'required'],
		['subject', 'Subject', 'required'],
		['tag', 'Replacement Tags', 'required'],
		['html', 'Email Body', 'required'],
		
    ];
	protected $_validation_edit_rules = [
    ['id', 'ID', ''],
		['slug', 'Email Type', ''],
		['email_header', 'Body Header', 'required'],
		['email_footer', 'Body Footer', 'required'],
		['subject', 'Subject', 'required'],
		['tag', 'Replacement Tags', ''],
		['html', 'Email Body', 'required'],
		
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
		$this->db->from('email');
		$this->db->where('slug',$slug,TRUE);
		$template=$this->db->get()->row();
		if(!$template)
		{
			return FALSE;
		}
		$tags_raw=$template->tag;
		$tags=explode(',',$tags_raw);
		$template->subject=$this->inject_substitute($template->subject,$tags,$data);
		 $html  = $template->email_header . $template->html . $template->email_footer;  
		   $template->html     = $this->inject_substitute($html, $tags, $data);
		          
		return $template;
	}

	public function inject_substitute($raw, $tags, $data) 
	{
		foreach ($data as $key => $value) 
		{
			if (in_array($key, $tags) || $key == 'logo')
			{
				if ($key == 'logo') 
				{
					$logo      = base_url('assets/frontend/img/logo.png');
					$new_val   = "<img  src='" . $logo . "' style='width:158px' />";

					$value   = $new_val;
				}
				$raw = str_replace('{{{' . $key . '}}}', $value, $raw);
			}
		}
		return $raw;
	}



}