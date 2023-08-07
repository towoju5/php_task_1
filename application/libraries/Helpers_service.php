<?php
class Helpers_service
{
  private $_inventory_model;

  /**
   * setters
   */
  public function set_inventory_model($inventory_model)
  {
    $this->_inventory_model = $inventory_model;
  }
  
	
	 
  /**
   * getters
   */
  public function get_word_count($id)
  {
    $word_count  = "N/A";
    $check_data = $this->_inventory_model->get($id);
    if (isset($check_data->word_count))
    {
      $word_count = $check_data->word_count;
    }
    return $word_count;
  }

  public function get_year($id)
  {
    $year  = "N/A";
    $check_data = $this->_inventory_model->get($id);
    if (isset($check_data->year))
    {
      $year = $check_data->year;
    }
    return $year;
  }
  
}
