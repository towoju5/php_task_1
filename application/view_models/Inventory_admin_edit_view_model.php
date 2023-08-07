<?php defined('BASEPATH') OR exit('No direct script access allowed');
/*Powered By: Manaknightdigital Inc. https://manaknightdigital.com/ Year: 2021*/
/**
 * Edit Inventory View Model
 *
 * @copyright 2019 Manaknightdigital Inc.
 * @link https://manaknightdigital.com
 * @license Proprietary Software licensing
 * @author Ryan Wong
 */
class Inventory_admin_edit_view_model
{
    protected $_entity;
	protected $_id;
	protected $_title;
	protected $_school_id;
	protected $_professor_id;
	protected $_class_id;
	protected $_textbook_id;
	protected $_word_count;
	protected $_year;
	protected $_isbn;
	protected $_paypal_email;
	protected $_file;
	protected $_file_id;
	protected $_feature_image;
	protected $_feature_image_id;
	protected $_feature_image2;
	protected $_feature_image2_id;
	protected $_feature_image3;
	protected $_feature_image3_id;
	protected $_note_type;
	protected $_description;
	protected $_inventory_note;


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
		$this->_school_id = $model->school_id;
		$this->_professor_id = $model->professor_id;
		$this->_class_id = $model->class_id;
		$this->_textbook_id = $model->textbook_id;
		$this->_word_count = $model->word_count;
		$this->_year = $model->year;
		$this->_isbn = $model->isbn;
		$this->_paypal_email = $model->paypal_email;
		$this->_file = $model->file;
		$this->_feature_image = $model->feature_image;
		$this->_feature_image2 = $model->feature_image2;
		$this->_feature_image3 = $model->feature_image3;
		$this->_note_type = $model->note_type;
		$this->_description = $model->description;
		$this->_inventory_note = $model->inventory_note;

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


	public function note_type_mapping ()
	{
		return $this->_entity->note_type_mapping();

	}

	public function pin_to_top_mapping ()
	{
		return $this->_entity->pin_to_top_mapping();

	}

	public function approve_mapping ()
	{
		return $this->_entity->approve_mapping();

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

	public function get_school_id ()
	{
		return $this->_school_id;
	}

	public function set_school_id ($school_id)
	{
		$this->_school_id = $school_id;
	}

	public function get_professor_id ()
	{
		return $this->_professor_id;
	}

	public function set_professor_id ($professor_id)
	{
		$this->_professor_id = $professor_id;
	}

	public function get_class_id ()
	{
		return $this->_class_id;
	}

	public function set_class_id ($class_id)
	{
		$this->_class_id = $class_id;
	}

	public function get_textbook_id ()
	{
		return $this->_textbook_id;
	}

	public function set_textbook_id ($textbook_id)
	{
		$this->_textbook_id = $textbook_id;
	}

	public function get_word_count ()
	{
		return $this->_word_count;
	}

	public function set_word_count ($word_count)
	{
		$this->_word_count = $word_count;
	}

	public function get_year ()
	{
		return $this->_year;
	}

	public function set_year ($year)
	{
		$this->_year = $year;
	}

	public function get_isbn ()
	{
		return $this->_isbn;
	}

	public function set_isbn ($isbn)
	{
		$this->_isbn = $isbn;
	}

	public function get_paypal_email ()
	{
		return $this->_paypal_email;
	}

	public function set_paypal_email ($paypal_email)
	{
		$this->_paypal_email = $paypal_email;
	}

	public function get_file ()
	{
		return $this->_file;
	}

	public function set_file ($file)
	{
		$this->_file = $file;
	}

	public function get_file_id ()
	{
		return $this->_file_id;
	}

	public function set_file_id ($file)
	{
		$this->_file_id = $file;
	}

	public function get_feature_image ()
	{
		return $this->_feature_image;
	}

	public function set_feature_image ($feature_image)
	{
		$this->_feature_image = $feature_image;
	}

	public function get_feature_image_id ()
	{
		return $this->_feature_image_id;
	}

	public function set_feature_image_id ($feature_image)
	{
		$this->_feature_image_id = $feature_image;
	}

	public function get_feature_image2 ()
	{
		return $this->_feature_image2;
	}

	public function set_feature_image2 ($feature_image2)
	{
		$this->_feature_image2 = $feature_image2;
	}

	public function get_feature_image2_id ()
	{
		return $this->_feature_image2_id;
	}

	public function set_feature_image2_id ($feature_image2)
	{
		$this->_feature_image2_id = $feature_image2;
	}

	public function get_feature_image3 ()
	{
		return $this->_feature_image3;
	}

	public function set_feature_image3 ($feature_image3)
	{
		$this->_feature_image3 = $feature_image3;
	}

	public function get_feature_image3_id ()
	{
		return $this->_feature_image3_id;
	}

	public function set_feature_image3_id ($feature_image3)
	{
		$this->_feature_image3_id = $feature_image3;
	}

	public function get_note_type ()
	{
		return $this->_note_type;
	}

	public function set_note_type ($note_type)
	{
		$this->_note_type = $note_type;
	}

	public function get_description ()
	{
		return $this->_description;
	}

	public function set_description ($description)
	{
		$this->_description = $description;
	}

	public function get_inventory_note ()
	{
		return $this->_inventory_note;
	}

	public function set_inventory_note ($inventory_note)
	{
		$this->_inventory_note = $inventory_note;
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