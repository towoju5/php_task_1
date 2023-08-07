<?php defined('BASEPATH') OR exit('No direct script access allowed');
/*Powered By: Manaknightdigital Inc. https://manaknightdigital.com/ Year: 2021*/
/**
 * View Transaction View Model
 *
 * @copyright 2019 Manaknightdigital Inc.
 * @link https://manaknightdigital.com
 * @license Proprietary Software licensing
 * @author Ryan Wong
 */
class Transaction_admin_view_view_model
{
    protected $_entity;
    protected $_model;
	protected $_id;
	protected $_payment_method;
	protected $_order_id;
	protected $_transaction_date;
	protected $_transaction_time;
	protected $_user_id;
	protected $_tax;
	protected $_discount;
	protected $_subtotal;
	protected $_total;
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
		$this->_payment_method = $model->payment_method;
		$this->_order_id = $model->order_id;
		$this->_transaction_date = $model->transaction_date;
		$this->_transaction_time = $model->transaction_time;
		$this->_user_id = $model->user_id;
		$this->_tax = $model->tax;
		$this->_discount = $model->discount;
		$this->_subtotal = $model->subtotal;
		$this->_total = $model->total;
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

	public function payment_method_mapping ()
	{
		return $this->_entity->payment_method_mapping();

	}

	public function status_mapping ()
	{
		return $this->_entity->status_mapping();

	}

	public function get_id ()
	{
		return $this->_id;
	}

	public function set_id ($id)
	{
		$this->_id = $id;
	}

	public function get_payment_method ()
	{
		return $this->_payment_method;
	}

	public function set_payment_method ($payment_method)
	{
		$this->_payment_method = $payment_method;
	}

	public function get_order_id ()
	{
		return $this->_order_id;
	}

	public function set_order_id ($order_id)
	{
		$this->_order_id = $order_id;
	}

	public function get_transaction_date ()
	{
		return $this->_transaction_date;
	}

	public function set_transaction_date ($transaction_date)
	{
		$this->_transaction_date = $transaction_date;
	}

	public function get_transaction_time ()
	{
		return $this->_transaction_time;
	}

	public function set_transaction_time ($transaction_time)
	{
		$this->_transaction_time = $transaction_time;
	}

	public function get_user_id ()
	{
		return $this->_user_id;
	}

	public function set_user_id ($user_id)
	{
		$this->_user_id = $user_id;
	}

	public function get_tax ()
	{
		return $this->_tax;
	}

	public function set_tax ($tax)
	{
		$this->_tax = $tax;
	}

	public function get_discount ()
	{
		return $this->_discount;
	}

	public function set_discount ($discount)
	{
		$this->_discount = $discount;
	}

	public function get_subtotal ()
	{
		return $this->_subtotal;
	}

	public function set_subtotal ($subtotal)
	{
		$this->_subtotal = $subtotal;
	}

	public function get_total ()
	{
		return $this->_total;
	}

	public function set_total ($total)
	{
		$this->_total = $total;
	}

	public function get_status ()
	{
		return $this->_status;
	}

	public function set_status ($status)
	{
		$this->_status = $status;
	}

	public function to_json ()
	{
		return [
		'id' => $this->get_id(),
		'payment_method' => $this->get_payment_method(),
		'order_id' => $this->get_order_id(),
		'transaction_date' => $this->get_transaction_date(),
		'transaction_time' => $this->get_transaction_time(),
		'user_id' => $this->get_user_id(),
		'tax' => $this->get_tax(),
		'discount' => $this->get_discount(),
		'subtotal' => $this->get_subtotal(),
		'total' => $this->get_total(),
		'status' => $this->get_status(),
		];
	}

}