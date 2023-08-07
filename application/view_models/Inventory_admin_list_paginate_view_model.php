<?php defined('BASEPATH') OR exit('No direct script access allowed');
/*Powered By: Manaknightdigital Inc. https://manaknightdigital.com/ Year: 2021*/
/**
 * Inventory List Paginate View Model
 *
 * @copyright 2019 Manaknightdigital Inc.
 * @link https://manaknightdigital.com
 * @license Proprietary Software licensing
 * @author Ryan Wong
 */
class Inventory_admin_list_paginate_view_model
{
    protected $_library;
    protected $_base_url = '';
    protected $_heading = 'Inventory';
    protected $_total_rows = 0;
    protected $_format_layout = '';
    protected $_per_page = 10;
    protected $_page;
    protected $_num_links = 5;
    protected $_column = ['Action','ID','Previews','School','Professor','Course','Textbook','User Name','Email','Word Count','Year','Status'];
    protected $_field_column = ['','id','','school_id','professor_id','class_id','isbn','first_name','email','word_count','year','status'];
    protected $_list = [];
    protected $_links = '';
    protected $_sort_base_url = '';
    protected $_order_by = '';
    protected $_sort = '';
    protected $_entity;

    public function __construct($entity, $library, $base_url)
    {
        $this->_entity = $entity;
        $this->_library = $library;
        $this->_base_url = str_replace('/0', '/', $base_url);
    }

    /**
     * set_total_rows function
     *
     * @param integer $total_rows
     * @return void
     */
    public function set_total_rows ($total_rows)
    {
        $this->_total_rows = $total_rows;
    }

    /**
     * set_per_page function
     *
     * @param integer $per_page
     * @return void
     */
    public function set_per_page ($per_page)
    {
        $this->_per_page = $per_page;
    }
    /**
     * format_layout function
     *
     * @param integer $_format_layout
     * @return void
     */
    public function set_format_layout ($_format_layout)
    {
        $this->_format_layout = $_format_layout;
    }

    /**
     * set_order_by function
     *
     * @param string $order_by
     * @return void
     */
    public function set_order_by ($order_by)
    {
        $this->_order_by = $order_by;
    }

    /**
     * set_sort function
     *
     * @param string $sort
     * @return void
     */
    public function set_sort ($sort)
    {
        $this->_sort = $sort;
    }

    /**
     * set_sort_base_url function
     *
     * @param string $sort_base_url
     * @return void
     */
    public function set_sort_base_url ($sort_base_url)
    {
        $this->_sort_base_url = $sort_base_url;
    }

    /**
     * set_page function
     *
     * @param integer $page
     * @return void
     */
    public function set_page ($page)
    {
        $this->_page = $page;
    }

    /**
     * set_list function
     *
     * @param mixed $list
     * @return void
     */
    public function set_list ($list)
    {
        $this->_list = $list;
    }

    /**
     * get_total_rows function
     *
     * @return integer
     */
    public function get_total_rows ()
    {
        return $this->_total_rows;
    }

    /**
     * get_format_layout function
     *
     * @return integer
     */
    public function get_format_layout ()
    {
        return $this->_format_layout;
    }

    /**
     * get_per_page function
     *
     * @return integer
     */
    public function get_per_page ()
    {
        return $this->_per_page;
    }

    /**
     * get_page function
     *
     * @return integer
     */
    public function get_page ()
    {
        return $this->_page;
    }

    /**
     * num_links function
     *
     * @return integer
     */
    public function get_num_links ()
    {
        return $this->_num_links;
    }

    /**
     * set_order_by function
     *
     */
    public function get_order_by ()
    {
        return $this->_order_by;
    }

    /**
     * get_field_column function
     *
     */
    public function get_field_column ()
    {
        return $this->_field_column;
    }

    /**
     * set_sort function
     *
     */
    public function get_sort ()
    {
        return $this->_sort;
    }

    /**
     * set_sort_base_url function
     *
     */
    public function get_sort_base_url ()
    {
        return $this->_sort_base_url;
    }

    /**
     * num_pages function
     *
     * @return integer
     */
    public function get_num_page ()
    {
        $num = ceil($this->_total_rows / $this->_per_page);
        return ($num > 0) ? (int) $num : 1;
    }

    public function image_or_file ($file)
    {
        $images = ['.jpg','.png', '.gif', '.jpeg', '.bmp'];
        $is_image = FALSE;
        if ($this->strposa($file, $images))
        {
            return "<div class='mkd-image-container'><img class='img-fluid' src='{$file}' onerror=\"if (this.src != '/uploads/placeholder.jpg') this.src = '/uploads/placeholder.jpg';\"/></div>";
        }

        return "<a href='{$file}' target='__blank'>{$file}</a>";
    }

    /**
     * Strpos for array
     *
     * @param string $haystack
     * @param array $needle
     * @return boolean
     */
    private function strposa($haystack, $needle)
    {
        foreach($needle as $query)
        {
            if(strpos($haystack, $query) !== FALSE)
            {
                return TRUE;
            }
        }
        return FALSE;
    }

    /**
     * get_list function
     *
     * @return mixed
     */
    public function get_list ()
    {
        $this->_library->initialize([
            'reuse_query_string' => TRUE,
            'base_url' => $this->_base_url,
            'total_rows' => $this->_total_rows,
            'per_page' => $this->_per_page,
            'num_links' => $this->_num_links,
            'full_tag_open' => '<ul class="pagination justify-content-end">',
            'full_tag_close' => '</ul>',
            'attributes' => ['class' => 'page-link'],
            'first_link' => FALSE,
            'last_link' => FALSE,
            'first_tag_open' => '<li class="page-item">',
            'first_tag_close' => '</li>',
            'prev_link' => '&laquo',
            'prev_tag_open' => '<li class="page-item">',
            'prev_tag_close' => '</li>',
            'next_link' => '&raquo',
            'next_tag_open' => '<li class="page-item">',
            'next_tag_close' => '</li>',
            'last_tag_open' => '<li class="page-item">',
            'last_tag_close' => '</li>',
            'cur_tag_open' => '<li class="page-item active"><a href="#" class="page-link">',
            'cur_tag_close' => '<span class="sr-only">(current)</span></a></li>',
            'num_tag_open' => '<li class="page-item">',
            'num_tag_close' => '</li>'
        ]);
        return $this->_list;
    }

    /**
     * get_links function
     *
     * @return mixed
     */
    public function get_links ()
    {
        $this->_links = $this->_library->create_links();
        return $this->_links;
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

    public function set_column ($column)
    {
        $this->_column = $column;
    }

    public function get_column ()
    {
        return $this->_column;
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

    public function get_query_parameter()
    {
        $get_parameter = $_GET;
        $blacklist = array(
            'order_by',
            'direction'
        );
        $query_list = array();
        foreach($get_parameter as $key => $value)
        {
            if(!in_array($key, $blacklist))
            {
                $query_list[] = "$key=$value";
            }
        }
        return "&" . implode("&", $query_list);
    }


    public function get_id ()
    {
        return $this->_id;
    }

    public function set_id ($id)
    {
        $this->_id = $id;
    }

    public $_id = NULL;

    public function get_title ()
    {
        return $this->_title;
    }

    public function set_title ($title)
    {
        $this->_title = $title;
    }

    public $_title = NULL;

    public function get_school_id ()
    {
        return $this->_school_id;
    }

    public function set_school_id ($school_id)
    {
        $this->_school_id = $school_id;
    }

    public $_school_id = NULL;

    public function get_professor_id ()
    {
        return $this->_professor_id;
    }

    public function set_professor_id ($professor_id)
    {
        $this->_professor_id = $professor_id;
    }

    public $_professor_id = NULL;

    public function get_class_id ()
    {
        return $this->_class_id;
    }

    public function set_class_id ($class_id)
    {
        $this->_class_id = $class_id;
    }

    public $_class_id = NULL;

    public function get_textbook_id ()
    {
        return $this->_textbook_id;
    }

    public function set_textbook_id ($textbook_id)
    {
        $this->_textbook_id = $textbook_id;
    }

    public $_textbook_id = NULL;

    public function get_word_count ()
    {
        return $this->_word_count;
    }

    public function set_word_count ($word_count)
    {
        $this->_word_count = $word_count;
    }

    public $_word_count = NULL;

    public function get_year ()
    {
        return $this->_year;
    }

    public function set_year ($year)
    {
        $this->_year = $year;
    }

    public $_year = NULL;

    public function get_status ()
    {
        return $this->_status;
    }

    public function set_status ($status)
    {
        $this->_status = $status;
    }

    public $_status = NULL;

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

    public function to_json ()
    {
        $list = $this->get_list();

        $clean_list = [];

        foreach ($list as $key => $value)
        {
            $list[$key]->note_type = $this->note_type_mapping()[$value->note_type];
            $list[$key]->pin_to_top = $this->pin_to_top_mapping()[$value->pin_to_top];
            $list[$key]->approve = $this->approve_mapping()[$value->approve];
            $list[$key]->status = $this->status_mapping()[$value->status];
            $clean_list_entry = [];
            $clean_list_entry['id'] = $list[$key]->id;
            $clean_list_entry['title'] = $list[$key]->title;
            $clean_list_entry['school_id'] = $list[$key]->school_id;
            $clean_list_entry['professor_id'] = $list[$key]->professor_id;
            $clean_list_entry['class_id'] = $list[$key]->class_id;
            $clean_list_entry['textbook_id'] = $list[$key]->textbook_id;
            $clean_list_entry['word_count'] = $list[$key]->word_count;
            $clean_list_entry['year'] = $list[$key]->year;
            $clean_list_entry['isbn'] = $list[$key]->isbn;
            $clean_list_entry['paypal_email'] = $list[$key]->paypal_email;
            $clean_list_entry['file'] = $list[$key]->file;
            $clean_list_entry['file_id'] = $list[$key]->file_id;
            $clean_list_entry['feature_image'] = $list[$key]->feature_image;
            $clean_list_entry['feature_image_id'] = $list[$key]->feature_image_id;
            $clean_list_entry['note_type'] = $list[$key]->note_type;
            $clean_list_entry['description'] = $list[$key]->description;
            $clean_list_entry['inventory_note'] = $list[$key]->inventory_note;
            $clean_list_entry['pin_to_top'] = $list[$key]->pin_to_top;
            $clean_list_entry['approve'] = $list[$key]->approve;
            $clean_list_entry['status'] = $list[$key]->status;
            $clean_list[] = $clean_list_entry;
        }

        return [
            'page' => $this->get_page(),
            'num_page' => $this->get_num_page(),
            'num_item' => $this->get_total_rows(),
            'item' => $clean_list
        ];
    }

    public function to_csv ()
    {
        $list = $this->get_list();

        $clean_list = [];

        foreach ($list as $key => $value)
        {
            $list[$key]->note_type = $this->note_type_mapping()[$value->note_type];
            $list[$key]->pin_to_top = $this->pin_to_top_mapping()[$value->pin_to_top];
            $list[$key]->approve = $this->approve_mapping()[$value->approve];
            $list[$key]->status = $this->status_mapping()[$value->status];
            $clean_list_entry = [];
            $clean_list_entry['id'] = $list[$key]->id;
            $clean_list_entry['title'] = $list[$key]->title;
            $clean_list_entry['school_id'] = $list[$key]->school_id;
            $clean_list_entry['professor_id'] = $list[$key]->professor_id;
            $clean_list_entry['class_id'] = $list[$key]->class_id;
            $clean_list_entry['textbook_id'] = $list[$key]->textbook_id;
            $clean_list_entry['word_count'] = $list[$key]->word_count;
            $clean_list_entry['year'] = $list[$key]->year;
            $clean_list_entry['isbn'] = $list[$key]->isbn;
            $clean_list_entry['paypal_email'] = $list[$key]->paypal_email;
            $clean_list_entry['file'] = $list[$key]->file;
            $clean_list_entry['file_id'] = $list[$key]->file_id;
            $clean_list_entry['feature_image'] = $list[$key]->feature_image;
            $clean_list_entry['feature_image_id'] = $list[$key]->feature_image_id;
            $clean_list_entry['note_type'] = $list[$key]->note_type;
            $clean_list_entry['description'] = $list[$key]->description;
            $clean_list_entry['inventory_note'] = $list[$key]->inventory_note;
            $clean_list_entry['pin_to_top'] = $list[$key]->pin_to_top;
            $clean_list_entry['approve'] = $list[$key]->approve;
            $clean_list_entry['status'] = $list[$key]->status;
            $clean_list[] = $clean_list_entry;
        }

        $columns = $this->get_column();
        $columns = array_diff($columns,['Action']);
        $csv = implode(",", $columns) . "\n";
        $fields = array_filter($this->get_field_column());
        foreach($clean_list as $row)
        {
            $row_csv = [];
            foreach($row as $key =>$column)
            {
            if (in_array($key, $fields))
            {
                $row_csv[] = '"' . $column . '"';
            }
            }
            $csv = $csv . implode(',', $row_csv) . "\n";
        }
        return $csv;
}

}