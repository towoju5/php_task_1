<?php defined('BASEPATH') OR exit('No direct script access allowed');
/*Powered By: Manaknightdigital Inc. https://manaknightdigital.com/ Year: 2021*/
/**
 * Edit Marketing View Model
 *
 * @copyright 2019 Manaknightdigital Inc.
 * @link https://manaknightdigital.com
 * @license Proprietary Software licensing
 * @author Ryan Wong
 */
class Marketing_admin_edit_view_model
{
	protected $_entity;
	protected $_id;
	protected $_title;
	protected $_seo_title;
	protected $_seo_description;
	protected $_content;
	protected $_slug;
	protected $_password_protect;
	protected $_header_template_path;
	protected $_content_template_path;
	protected $_footer_template_path;
	protected $_status;


    public function __construct($entity)
    {
        $this->_entity = $entity;
    }

    public function get_entity ()
    {
        return $this->_entity;
    }

    /**
     * set_heading function
     *
     * @param string $heading
     * @return void
     */
    public function set_heading ($heading)
    {
        $this->_heading = $heading;
    }

    /**
     * get_heading function
     *
     * @return string
     */
    public function get_heading ()
    {
        return $this->_heading;
    }

    public function set_model ($model)
    {
			$this->_model = $model;
			$this->_id = $model->id;
			$this->_title = $model->title;
			$this->_seo_title = $model->seo_title;
			$this->_seo_description = $model->seo_description;
			$this->_content = $model->content;
			$this->_slug = $model->slug;
			$this->_password_protect = $model->password_protect;
			$this->_header_template_path = $model->header_template_path;
			$this->_content_template_path = $model->content_template_path;
			$this->_footer_template_path = $model->footer_template_path;
			$this->_status = $model->status;

    }

    public function timeago($date)
    {
        $timestamp = strtotime($date);

        $strTime = array('second', 'minute', 'hour', 'day', 'month', 'year');
        $length = array('60', '60', '24', '30', '12', '10');

        $currentTime = time();
        if($currentTime >= $timestamp)
        {
             $diff  = time() - $timestamp;

             for($i = 0; $diff >= $length[$i] && $i < count($length)-1; $i++)
             {
                $diff = $diff / $length[$i];
             }

             $diff = round($diff);
             return $diff . ' ' . $strTime[$i] . '(s) ago ';
        }
    }

    public function time_default_mapping ()
    {
        $results = [];
        for ($i=0; $i < 24; $i++)
        {
            for ($j=0; $j < 60; $j++)
            {
                $hour = ($i < 10) ? '0' . $i : $i;
                $min = ($j < 10) ? '0' . $j : $j;
                $results[($i * 60) + $j] = "$hour:$min";
            }
        }
        return $results;
    }


	public function status_mapping ()
	{
		return $this->_entity->status_mapping();

	}

	public function get_title ()
	{
		return $this->_title;
	}

	public function set_title ($title)
	{
		$this->_title = $title;
	}

	public function get_seo_title ()
	{
		return $this->_seo_title;
	}

	public function set_seo_title ($seo_title)
	{
		$this->_seo_title = $seo_title;
	}

	public function get_seo_description ()
	{
		return $this->_seo_description;
	}

	public function set_seo_description ($seo_description)
	{
		$this->_seo_description = $seo_description;
	}

	public function get_content ()
	{
		return $this->_content;
	}

	public function set_content ($content)
	{
		$this->_content = $content;
	}

	public function get_slug ()
	{
		if($this->_slug)
		{
			$this->_slug = explode('a/',$this->_slug);
			if(count($this->_slug) == 2)
			{
				$this->_slug = $this->_slug[1];
			}
		}

		return $this->_slug;
	}

	public function set_slug ($slug)
	{

		$this->_slug = $slug;
	}

	public function get_password_protect ()
	{
		return $this->_password_protect;
	}

	public function set_password_protect ($password_protect)
	{
		$this->_password_protect = $password_protect;
	}

	public function get_header_template_path ()
	{
		return $this->_header_template_path;
	}

	public function set_header_template_path ($header_template_path)
	{
		$this->_header_template_path = $header_template_path;
	}

	public function get_content_template_path ()
	{
		return $this->_content_template_path;
	}

	public function set_content_template_path ($content_template_path)
	{
		$this->_content_template_path = $content_template_path;
	}

	public function get_footer_template_path ()
	{
		return $this->_footer_template_path;
	}

	public function set_footer_template_path ($footer_template_path)
	{
		$this->_footer_template_path = $footer_template_path;
	}

	public function get_status ()
	{
		return $this->_status;
	}

	public function set_status ($status)
	{
		$this->_status = $status;
	}

	public function get_id ()
	{
		return $this->_id;
	}

	public function set_id ($id)
	{
		$this->_id = $id;
	}

	/**
	 * Custom functions below
	 * for portal views
	 * function to return the slug
	 */
	public function marketing_slug_url()
	{
		$slug_url = base_url() . 'a/';
		return $slug_url;
	}

	public function get_header_templates ()
	{
		$mydir = __DIR__ . '/../views/Layout';
		$dir_name = 'Layout';
		$myfiles = array_diff(scandir($mydir), ['.', '..']);
		$header_file = [];

		if(!empty($myfiles) && is_array($myfiles))
		{
			$header_file[''] = 'None';
			$word = $word ? $word : 'Header';

			foreach ($myfiles as $value)
			{
				if (strpos($value,$word) !== FALSE)
				{
					$header_file[$dir_name .'/' . $value] = $value;
				}
			}
		}

		return $header_file;
	}

	public function get_content_templates ()
	{
		$mydir = __DIR__ . '/../views';

		$myfiles = array_diff(scandir($mydir), ['.', '..']);

		$header_file = [];
		$main_dir = [];

		if(!empty($myfiles) && is_array($myfiles))
		{
			$word = '.php';
			$exception_dir_1 = 'Layout';
			$exception_dir_2 = 'errors';
			$main_dir[''] = [ '' => 'None'];

			foreach($myfiles as $value)
			{
				switch ($value)
				{
					case $exception_dir_1:
						break;

					case $exception_dir_2 :
						break;

					default:

						$my_dynamicdir = __DIR__ . '/../views/' . $value;

						if(is_dir($my_dynamicdir))
						{
							$files = [];
							$mydynamicfiles = array_diff(scandir($my_dynamicdir), ['.', '..']);

							if(!empty($mydynamicfiles) && is_array($mydynamicfiles))
							{
								foreach($mydynamicfiles as $name)
								{
									if(strpos($name,$word))
									{
										$files[$value . "/" . $name] = $name;
									}
								}
							}

							$main_dir[$value] = $files;
						}
						break;
					}
			}
		}
		return $main_dir;
	}

  public function get_footer_templates ()
	{
		return $this->get_header_templates('Footer');
	}
}