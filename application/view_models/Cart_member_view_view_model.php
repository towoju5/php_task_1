<?php defined('BASEPATH') OR exit('No direct script access allowed');
/*Powered By: Manaknightdigital Inc. https://manaknightdigital.com/ Year: 2021*/
/**
 * View Cart View Model
 *
 * @copyright 2019 Manaknightdigital Inc.
 * @link https://manaknightdigital.com
 * @license Proprietary Software licensing
 * @author Ryan Wong
 */
class Cart_member_view_view_model
{
    protected $_entity;
    protected $_model;
	protected $_id;
	protected $_product_id;
	protected $_user_id;
	protected $_session_id;
	protected $_subtotal;
	protected $_quantity;
	protected $_total;


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
		$this->_product_id = $model->product_id;
		$this->_user_id = $model->user_id;
		$this->_session_id = $model->session_id;
		$this->_subtotal = $model->subtotal;
		$this->_quantity = $model->quantity;
		$this->_total = $model->total;

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

	public function get_id ()
	{
		return $this->_id;
	}

	public function set_id ($id)
	{
		$this->_id = $id;
	}

	public function get_product_id ()
	{
		return $this->_product_id;
	}

	public function set_product_id ($product_id)
	{
		$this->_product_id = $product_id;
	}

	public function get_user_id ()
	{
		return $this->_user_id;
	}

	public function set_user_id ($user_id)
	{
		$this->_user_id = $user_id;
	}

	public function get_session_id ()
	{
		return $this->_session_id;
	}

	public function set_session_id ($session_id)
	{
		$this->_session_id = $session_id;
	}

	public function get_subtotal ()
	{
		return $this->_subtotal;
	}

	public function set_subtotal ($subtotal)
	{
		$this->_subtotal = $subtotal;
	}

	public function get_quantity ()
	{
		return $this->_quantity;
	}

	public function set_quantity ($quantity)
	{
		$this->_quantity = $quantity;
	}

	public function get_total ()
	{
		return $this->_total;
	}

	public function set_total ($total)
	{
		$this->_total = $total;
	}

	public function to_json ()
	{
		return [
		'id' => $this->get_id(),
		'product_id' => $this->get_product_id(),
		'user_id' => $this->get_user_id(),
		'session_id' => $this->get_session_id(),
		'subtotal' => $this->get_subtotal(),
		'quantity' => $this->get_quantity(),
		'total' => $this->get_total(),
		];
	}

}