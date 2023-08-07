<?php defined('BASEPATH') OR exit('No direct script access allowed');
/*Powered By: Manaknightdigital Inc. https://manaknightdigital.com/ Year: 2021*/
/**
 * View User View Model
 *
 * @copyright 2019 Manaknightdigital Inc.
 * @link https://manaknightdigital.com
 * @license Proprietary Software licensing
 * @author Ryan Wong
 */
class User_admin_view_view_model
{
    protected $_entity;
    protected $_model;
	protected $_id;
	protected $_email;
	protected $_first_name;
	protected $_last_name;
	protected $_image;
	protected $_image_id;
	protected $_phone;
	protected $_role_id;


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
		$this->_email = $model->email;
		$this->_first_name = $model->first_name;
		$this->_last_name = $model->last_name;
		$this->_image = $model->image;
		$this->_phone = $model->phone;
		$this->_role_id = $model->role_id;

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

	public function verify_mapping ()
	{
		return $this->_entity->verify_mapping();

	}

	public function status_mapping ()
	{
		return $this->_entity->status_mapping();

	}

	public function role_id_mapping ()
	{
		return $this->_entity->role_id_mapping();

	}

	public function type_mapping ()
	{
		return $this->_entity->type_mapping();

	}

	public function get_id ()
	{
		return $this->_id;
	}

	public function set_id ($id)
	{
		$this->_id = $id;
	}

	public function get_email ()
	{
		return $this->_email;
	}

	public function set_email ($email)
	{
		$this->_email = $email;
	}

	public function get_first_name ()
	{
		return $this->_first_name;
	}

	public function set_first_name ($first_name)
	{
		$this->_first_name = $first_name;
	}

	public function get_last_name ()
	{
		return $this->_last_name;
	}

	public function set_last_name ($last_name)
	{
		$this->_last_name = $last_name;
	}

	public function get_image ()
	{
		return $this->_image;
	}

	public function set_image ($image)
	{
		$this->_image = $image;
	}

	public function get_image_id ()
	{
		return $this->_image_id;
	}

	public function set_image_id ($image)
	{
		$this->_image_id = $image;
	}

	public function get_phone ()
	{
		return $this->_phone;
	}

	public function set_phone ($phone)
	{
		$this->_phone = $phone;
	}

	public function get_role_id ()
	{
		return $this->_role_id;
	}

	public function set_role_id ($role_id)
	{
		$this->_role_id = $role_id;
	}

	public function to_json ()
	{
		return [
		'id' => $this->get_id(),
		'email' => $this->get_email(),
		'first_name' => $this->get_first_name(),
		'last_name' => $this->get_last_name(),
		'image' => $this->get_image(),
		'phone' => $this->get_phone(),
		'role_id' => $this->get_role_id(),
		];
	}

}