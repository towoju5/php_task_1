<?php defined('BASEPATH') OR exit('No direct script access allowed');
/*Powered By: Manaknightdigital Inc. https://manaknightdigital.com/ Year: 2021*/
/**
 * Edit Refund View Model
 *
 * @copyright 2019 Manaknightdigital Inc.
 * @link https://manaknightdigital.com
 * @license Proprietary Software licensing
 * @author Ryan Wong
 */
class Refund_admin_edit_view_model
{
    protected $_entity;
	protected $_id;
	protected $_order_id;
	protected $_user_id;
	protected $_amount;
	protected $_reason;
	protected $_explanation;
	protected $_receipt_url;
	protected $_stripe_charge_id;
	protected $_stripe_invoice_id;
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
		$this->_order_id = $model->order_id;
		$this->_user_id = $model->user_id;
		$this->_amount = $model->amount;
		$this->_reason = $model->reason;
		$this->_explanation = $model->explanation;
		$this->_receipt_url = $model->receipt_url;
		$this->_stripe_charge_id = $model->stripe_charge_id;
		$this->_stripe_invoice_id = $model->stripe_invoice_id;
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


	public function get_order_id ()
	{
		return $this->_order_id;
	}

	public function set_order_id ($order_id)
	{
		$this->_order_id = $order_id;
	}

	public function get_user_id ()
	{
		return $this->_user_id;
	}

	public function set_user_id ($user_id)
	{
		$this->_user_id = $user_id;
	}

	public function get_amount ()
	{
		return $this->_amount;
	}

	public function set_amount ($amount)
	{
		$this->_amount = $amount;
	}

	public function get_reason ()
	{
		return $this->_reason;
	}

	public function set_reason ($reason)
	{
		$this->_reason = $reason;
	}

	public function get_explanation ()
	{
		return $this->_explanation;
	}

	public function set_explanation ($explanation)
	{
		$this->_explanation = $explanation;
	}

	public function get_receipt_url ()
	{
		return $this->_receipt_url;
	}

	public function set_receipt_url ($receipt_url)
	{
		$this->_receipt_url = $receipt_url;
	}

	public function get_stripe_charge_id ()
	{
		return $this->_stripe_charge_id;
	}

	public function set_stripe_charge_id ($stripe_charge_id)
	{
		$this->_stripe_charge_id = $stripe_charge_id;
	}

	public function get_stripe_invoice_id ()
	{
		return $this->_stripe_invoice_id;
	}

	public function set_stripe_invoice_id ($stripe_invoice_id)
	{
		$this->_stripe_invoice_id = $stripe_invoice_id;
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