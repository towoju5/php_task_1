<?php defined('BASEPATH') OR exit('No direct script access allowed');
/*Powered By: Manaknightdigital Inc. https://manaknightdigital.com/ Year: 2021*/
/**
 * Edit Admin View Model
 *
 * @copyright 2019 Manaknightdigital Inc.
 * @link https://manaknightdigital.com
 * @license Proprietary Software licensing
 * @author Ryan Wong
 */
class Admin_profile_view_model
{
    protected $_entity;
    protected $_id;
	protected $_email;
	protected $_first_name;
    protected $_last_name;

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
		$this->_first_name = $model->first_name;
        $this->_last_name = $model->last_name;
    }

	public function get_first_name ()
	{
		return $this->_first_name;
	}

	public function set_first_name ($first_name)
	{
		$this->_first_name = $first_name;
	}

	public function get_email ()
	{
		return $this->_email;
	}

	public function set_email ($email)
	{
		$this->_email = $email;
	}

	public function get_last_name ()
	{
		return $this->_last_name;
	}

	public function set_last_name ($last_name)
	{
		$this->_last_name = $last_name;
	}
}