<?php defined('BASEPATH') OR exit('No direct script access allowed');
/*Powered By: Manaknightdigital Inc. https://manaknightdigital.com/ Year: 2021*/
/**
 * Edit Email View Model
 *
 * @copyright 2019 Manaknightdigital Inc.
 * @link https://manaknightdigital.com
 * @license Proprietary Software licensing
 * @author Ryan Wong
 */
class Email_admin_edit_view_model
{
    protected $_entity;
	protected $_id;
	protected $_subject;
	protected $_email_header;
	protected $_html;
	protected $_email_footer;
	protected $_tag;


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
		$this->_subject = $model->subject;
		$this->_email_header = $model->email_header;
		$this->_html = $model->html;
		$this->_email_footer = $model->email_footer;
		$this->_tag = $model->tag;

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


	public function get_subject ()
	{
		return $this->_subject;
	}

	public function set_subject ($subject)
	{
		$this->_subject = $subject;
	}

	public function get_email_header ()
	{
		return $this->_email_header;
	}

	public function set_email_header ($email_header)
	{
		$this->_email_header = $email_header;
	}

	public function get_html ()
	{
		return $this->_html;
	}

	public function set_html ($html)
	{
		$this->_html = $html;
	}

	public function get_email_footer ()
	{
		return $this->_email_footer;
	}

	public function set_email_footer ($email_footer)
	{
		$this->_email_footer = $email_footer;
	}

	public function get_tag ()
	{
		return $this->_tag;
	}

	public function set_tag ($tag)
	{
		$this->_tag = $tag;
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