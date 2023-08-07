<?php
class Names_helper_service
{
  private $_user_model;
  private $_school_model;
  private $_professor_model;
  private $_classes_model;
  private $_textbook_model;


  /**
   * setters
   */
  public function set_user_model($user_model)
  {
    $this->_user_model = $user_model;
  }

  public function set_school_model($school_model)
  {
    $this->_school_model = $school_model;
  }

  public function set_professor_model($professor_model)
  {
    $this->_professor_model = $professor_model;
  }

  public function set_textbook_model($textbook_model)
  {
    $this->_textbook_model = $textbook_model;
  }

  public function set_classes_model($classes_model)
  {
    $this->_classes_model = $classes_model;
  }

  /**
   * getters
   */
  
  public function get_user_full_name($id)
  {
    $full_name  = "N/A";
    $check_data = $this->_user_model->get($id);
    if (isset($check_data->first_name))
    {
      $full_name = $check_data->first_name . ' ' . $check_data->last_name;
    }
    return $full_name;
  }

  public function get_school_name($id)
  {
    $name  = "N/A";
    $check_data = $this->_school_model->get($id);
    if (isset($check_data->name))
    {
      $name = $check_data->name;
    }
    return $name;
  }

  public function get_professor_name($id)
  {
    $name  = "N/A";
    $check_data = $this->_professor_model->get($id);
    if (isset($check_data->name))
    {
      $name = $check_data->name;
    }
    return $name;
  }

  public function get_class_name($id)
  {
    $name  = "N/A";
    $check_data = $this->_classes_model->get($id);
    if (isset($check_data->name))
    {
      $name = $check_data->name;
    }
    return $name;
  }

  public function get_textbook_name($id)
  {
    $name  = "N/A";
    $check_data = $this->_textbook_model->get($id);
    if (isset($check_data->name))
    {
      $name = $check_data->name;
    }
    return $name;
  }

}
