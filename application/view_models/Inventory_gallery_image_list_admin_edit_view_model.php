<?php defined('BASEPATH') OR exit('No direct script access allowed');
/*Powered By: Manaknightdigital Inc. https://manaknightdigital.com/ Year: 2021*/
/**
 * Edit Inventory_gallery_image_list View Model
 *
 * @copyright 2019 Manaknightdigital Inc.
 * @link https://manaknightdigital.com
 * @license Proprietary Software licensing
 * @author Ryan Wong
 */
class Inventory_gallery_image_list_admin_edit_view_model
{
    protected $_entity;
	protected $_id;
	protected $_inventory_id;
	protected $_gallery_image;
	protected $_gallery_image_id;
	protected $_gallery_image_id;
	protected $_gallery_image_id_id;
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
		$this->_inventory_id = $model->inventory_id;
		$this->_gallery_image = $model->gallery_image;
		$this->_gallery_image_id = $model->gallery_image_id;
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

	public function get_inventory_id ()
	{
		return $this->_inventory_id;
	}

	public function set_inventory_id ($inventory_id)
	{
		$this->_inventory_id = $inventory_id;
	}

	public function get_gallery_image ()
	{
		return $this->_gallery_image;
	}

	public function set_gallery_image ($gallery_image)
	{
		$this->_gallery_image = $gallery_image;
	}

	public function get_gallery_image_id ()
	{
		return $this->_gallery_image_id;
	}

	public function set_gallery_image_id ($gallery_image)
	{
		$this->_gallery_image_id = $gallery_image;
	}

	public function get_gallery_image_id ()
	{
		return $this->_gallery_image_id;
	}

	public function set_gallery_image_id ($gallery_image_id)
	{
		$this->_gallery_image_id = $gallery_image_id;
	}

	public function get_gallery_image_id_id ()
	{
		return $this->_gallery_image_id_id;
	}

	public function set_gallery_image_id_id ($gallery_image_id)
	{
		$this->_gallery_image_id_id = $gallery_image_id;
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

}