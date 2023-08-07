<?php defined('BASEPATH') OR exit('No direct script access allowed');
include_once 'Admin_controller.php';
/*Powered By: Manaknightdigital Inc. https://manaknightdigital.com/ Year: 2021*/
/**
 * Spreadsheet Controller
 * @copyright 2019 Manaknightdigital Inc.
 * @link https://manaknightdigital.com
 * @license Proprietary Software licensing
 * @author Ryan Wong
 *
 */
class Admin_spreadsheet_controller extends Admin_controller
{
    protected $_model_file = 'spreadsheet_model';
    public $_page_name = 'Spreadsheet';

    public function __construct()
    {
        parent::__construct();



    }



    	public function index($page)
	{
        $this->load->library('pagination');
        include_once __DIR__ . '/../../view_models/Spreadsheet_admin_list_paginate_view_model.php';
        $session = $this->get_session();
        $format = $this->input->get('format', TRUE) ?? 'view';
        $order_by = $this->input->get('order_by', TRUE) ?? '';
        $direction = $this->input->get('direction', TRUE) ?? 'ASC';
        $per_page_sort = $this->input->get('per_page_sort', TRUE) ?? 25;

        $this->_data['view_model'] = new Spreadsheet_admin_list_paginate_view_model(
            $this->spreadsheet_model,
            $this->pagination,
            '/admin/spreadsheet/0');
        $this->_data['view_model']->set_heading('Spreadsheet');
        $this->_data['view_model']->set_id(($this->input->get('id', TRUE) != NULL) ? $this->input->get('id', TRUE) : NULL);
		$this->_data['view_model']->set_name(($this->input->get('name', TRUE) != NULL) ? $this->input->get('name', TRUE) : NULL);
		$this->_data['view_model']->set_user_id(($this->input->get('user_id', TRUE) != NULL) ? $this->input->get('user_id', TRUE) : NULL);
		$this->_data['view_model']->set_status(($this->input->get('status', TRUE) != NULL) ? $this->input->get('status', TRUE) : NULL);
		$this->_data['view_model']->set_created_at(($this->input->get('created_at', TRUE) != NULL) ? $this->input->get('created_at', TRUE) : NULL);

        $where = [
            'id' => $this->_data['view_model']->get_id(),
			'name' => $this->_data['view_model']->get_name(),
			'user_id' => $this->_data['view_model']->get_user_id(),
			'status' => $this->_data['view_model']->get_status(),
			'created_at' => $this->_data['view_model']->get_created_at(),


        ];

        $this->_data['view_model']->set_total_rows($this->spreadsheet_model->count($where));

        $this->_data['view_model']->set_format_layout($this->_data['layout_clean_mode']);
        $this->_data['view_model']->set_per_page($per_page_sort);
        $this->_data['view_model']->set_order_by($order_by);
        $this->_data['view_model']->set_sort($direction);
        $this->_data['view_model']->set_sort_base_url('/admin/spreadsheet/0');
        $this->_data['view_model']->set_page($page);
		$this->_data['view_model']->set_list($this->spreadsheet_model->get_paginated(
            $this->_data['view_model']->get_page(),
            $this->_data['view_model']->get_per_page(),
            $where,
            $order_by,
            $direction));


        if ($format == 'csv')
        {
            header('Content-Type: text/csv');
            header('Content-Disposition: attachment; filename="export.csv"');

            echo $this->_data['view_model']->to_csv();
            exit();
        }

        if ($format != 'view')
        {
            return $this->output->set_content_type('application/json')
                ->set_status_header(200)
                ->set_output(json_encode($this->_data['view_model']->to_json()));
        }

        return $this->render('Admin/Spreadsheet', $this->_data);
	}

    	public function add()
	{
        include_once __DIR__ . '/../../view_models/Spreadsheet_admin_add_view_model.php';
        $session = $this->get_session();
        $this->form_validation = $this->spreadsheet_model->set_form_validation(
        $this->form_validation, $this->spreadsheet_model->get_all_validation_rule());
        $this->_data['view_model'] = new Spreadsheet_admin_add_view_model($this->spreadsheet_model);
        $this->_data['view_model']->set_heading('Spreadsheet');


		if ($this->form_validation->run() === FALSE)
		{
			return $this->render('Admin/SpreadsheetAdd', $this->_data);
        }

        $name = $this->input->post('name', TRUE);
		$value = $this->input->post('value', TRUE);
		$status = $this->input->post('status', TRUE);

        $final_value = "";
        $luckysheet_order = "";

        $file_name = $_FILES['value']['name'];

        if($file_name != "")
        {

            $original_name = "";
            $original_name = explode('.' , $file_name);
            if(is_array($original_name) && count($original_name) > 1)
            {
                $original_name = $original_name[0];
            }



            $value_file = fopen($_FILES['value']['tmp_name'], "r");
            if($_FILES['value']['type'] == 'text/csv')
            {
                $default_delimeter = ";";
                $headers = fgetcsv($value_file, 10000, $default_delimeter);
                /**
                 * Condition for checking and setting up the delimeter for the csv
                 */
                if(is_array($headers) && count($headers) <= 1)
                {
                    $headers = fgetcsv($value_file, 10000, ',');
                    if(is_array($headers) && count($headers)>1)
                    {
                        $default_delimeter = ",";
                    }
                }

                if(!empty($headers) && is_array($headers))
                {

                    $temp_array[] = array();
                    for( $x = 0 ; $x < count($headers); $x++)
                    {
                       $header_array = array(
                            'r' => 0,
                            'c' => $x,
                            'v' => array(
                                'ct' =>  array(
                                    'fa' => 'General',
                                    't' => 'g'
                                ),
                                'm'  => $headers[$x],
                                'v'  => $headers[$x]
                            )
                            );
                            $temp_array[$x] = $header_array;
                    }
                    $ro = 1 ; //count of rows
                    while (($data = fgetcsv($value_file, 1000,$default_delimeter)) !== FALSE)
                    {

                        if(!empty($data) && is_array($data))
                        {
                            foreach($data as $data_key => $values)
                            {

                                $body_data = array(
                                    'r' => $ro,
                                    'c' => $data_key,
                                    'v' => array(
                                        'ct' =>  array(
                                            'fa' => 'General',
                                            't' => 'g'
                                        ),
                                        'm'  => $values,
                                        'v'  => $values
                                    )
                                    );
                                    $temp_array[] = $body_data;
                            }


                        }
                        $ro++;
                    }


                    $luckysheet_format =
                    array(
                        array(
                            'name'  => $original_name, //Worksheet name
                            'color' => '', //Worksheet color
                            'index' => '0', //Worksheet index
                            'status' => 1, //Worksheet active status
                            'order' => 0, //The order of the worksheet
                            'hide' => 0,//Whether worksheet hide
                            'row' => 100, //the number of rows in a sheet
                            'column' => 36, //the number of columns in a sheet
                            'defaultRowHeight' => 19, //Customized default row height
                            'defaultColWidth' => 73, //Customized default column width
                            'celldata' => $temp_array,//Initial the cell data
                            'config' => array(
                                'merge' => new ArrayObject(), //merged cells
                                'rowlen' => new ArrayObject(), //Table row height
                                'columnlen' => new ArrayObject(), //Table column width
                                'rowhidden' => new ArrayObject(), //hidden rows
                                'colhidden' => new ArrayObject(), //hidden columns
                                'borderInfo'=> new ArrayObject(), //borders
                                'authority' => new ArrayObject(), //Worksheet protection
                            ),
                            'scrollLeft' => 0, //Left and right scroll bar position
                            'scrollTop' => 315, //Up and down scroll bar position
                            'luckysheet_select_save' => [], //selected area
                            'calcChain' => [],//Formula chain
                            'isPivotTable' => false,//Whether is pivot table
                            'pivotTable' => new ArrayObject(),//Pivot table settings
                            'filter_select' => new ArrayObject(),//Filter range
                            'filter' => null,//Filter configuration
                            'luckysheet_alternateformat_save' => array(), //Alternate colors
                            'luckysheet_alternateformat_save_modelCustom' => [], //Customize alternate colors
                            'luckysheet_conditionformat_save' => new ArrayObject(),//condition format
                            'frozen' => new ArrayObject(), //freeze row and column configuration
                            'chart' => [], //Chart configuration
                            'zoomRatio' => 1, // zoom ratio
                            'image' => [], //image
                            'showGridLines' => 1, //Whether to show grid lines
                        )
                    );

                    $luckysheet_order =  json_encode($luckysheet_format);

                }
                fclose($value_file);
            }
        }
        else
        {

            $luckysheet_format =
                    array(
                        array(
                            'name'  => $name, //Worksheet name
                            'color' => '', //Worksheet color
                            'index' => '0', //Worksheet index
                            'status' => 1, //Worksheet active status
                            'order' => 0, //The order of the worksheet
                            'hide' => 0,//Whether worksheet hide
                            'row' => 100, //the number of rows in a sheet
                            'column' => 36, //the number of columns in a sheet
                            'defaultRowHeight' => 19, //Customized default row height
                            'defaultColWidth' => 73, //Customized default column width
                            'celldata' => [],//Initial the cell data
                            'config' => array(
                                'merge' => new ArrayObject(), //merged cells
                                'rowlen' => new ArrayObject(), //Table row height
                                'columnlen' => new ArrayObject(), //Table column width
                                'rowhidden' => new ArrayObject(), //hidden rows
                                'colhidden' => new ArrayObject(), //hidden columns
                                'borderInfo'=> new ArrayObject(), //borders
                                'authority' => new ArrayObject(), //Worksheet protection
                            ),
                            'scrollLeft' => 0, //Left and right scroll bar position
                            'scrollTop' => 315, //Up and down scroll bar position
                            'luckysheet_select_save' => [], //selected area
                            'calcChain' => [],//Formula chain
                            'isPivotTable' => false,//Whether is pivot table
                            'pivotTable' => new ArrayObject(),//Pivot table settings
                            'filter_select' => new ArrayObject(),//Filter range
                            'filter' => null,//Filter configuration
                            'luckysheet_alternateformat_save' => array(), //Alternate colors
                            'luckysheet_alternateformat_save_modelCustom' => [], //Customize alternate colors
                            'luckysheet_conditionformat_save' => new ArrayObject(),//condition format
                            'frozen' => new ArrayObject(), //freeze row and column configuration
                            'chart' => [], //Chart configuration
                            'zoomRatio' => 1, // zoom ratio
                            'image' => [], //image
                            'showGridLines' => 1, //Whether to show grid lines
                        )
                    );

                    $luckysheet_order =  json_encode($luckysheet_format);

        }

        $result = $this->spreadsheet_model->create([
            'name' => $name,
			'value' => $luckysheet_order,
			'status' => $status,
            'user_id' => $session['user_id']

        ]);

        if ($result)
        {
            $this->success('Spreadsheet added.');

            return $this->redirect('/admin/spreadsheet/0', 'refresh');
        }

        $this->_data['error'] = 'Error';
        return $this->render('Admin/SpreadsheetAdd', $this->_data);
	}

    	public function edit($id)
	{
        $model = $this->spreadsheet_model->get($id);
        $session = $this->get_session();
		if (!$model)
		{
			$this->error('Error');
			return redirect('/admin/spreadsheet/0');
        }

        include_once __DIR__ . '/../../view_models/Spreadsheet_admin_edit_view_model.php';
        $this->form_validation = $this->spreadsheet_model->set_form_validation(
        $this->form_validation, $this->spreadsheet_model->get_all_edit_validation_rule());
        $this->_data['view_model'] = new Spreadsheet_admin_edit_view_model($this->spreadsheet_model);
        $this->_data['view_model']->set_model($model);
        $this->_data['view_model']->set_heading('Spreadsheet');


		if ($this->form_validation->run() === FALSE)
		{
			return $this->render('Admin/SpreadsheetEdit', $this->_data);
        }

        $name = $this->input->post('name', TRUE);
		$status = $this->input->post('status', TRUE);

        $result = $this->spreadsheet_model->edit([
            'name' => $name,
			'status' => $status,

        ], $id);

        if ($result)
        {
            $this->success('Spreadsheet updated.');

            return $this->redirect('/admin/spreadsheet/0', 'refresh');
        }

        $this->_data['error'] = 'Error';
        return $this->render('Admin/SpreadsheetEdit', $this->_data);
	}

    public function bulk_delete()
	{

        $bulk_items = $this->input->post('bulk_items');
        foreach ($bulk_items as $key => $id) {
            $this->spreadsheet_model->real_delete($id);
        }
        echo 'success';
        exit();
	}
    /**
     * Function to return spreadsheet data only
     */
    public function spreadsheet_data($id)
    {
        $model = $this->spreadsheet_model->get($id);
        $session = $this->get_session();
		if (!$model)
		{
			$this->error('Error');
			return redirect('/admin/spreadsheet/0');
        }

        include_once __DIR__ . '/../../view_models/Spreadsheet_admin_edit_view_model.php';
        $this->form_validation = $this->spreadsheet_model->set_form_validation(
        $this->form_validation, $this->spreadsheet_model->get_all_edit_validation_rule());
        $this->_data['view_model'] = new Spreadsheet_admin_edit_view_model($this->spreadsheet_model);
        $this->_data['view_model']->set_model($model);
        $this->_data['view_model']->set_heading('Spreadsheet');

        return $this->render('Admin/Spreadsheet_view_only', $this->_data);


    }

    /**
     * function to update the sheet
     */

     public function update_sheet($id)
     {
        $model = $this->spreadsheet_model->get($id);
        $session = $this->get_session();
		if (!$model)
		{
            $this->error('Error');
			echo json_encode(['error'=> 'error']);
            exit();
        }
        $data = file_get_contents("php://input",TRUE);
        if($data)
        {
            $result = $this->spreadsheet_model->edit([
                'value' => $data,

            ], $id);

            if ($result)
            {
                $this->success('Spreadsheet Updated Successfully.');
                echo json_encode(['success'=> 'updated']);
                exit();
            }


        }
        $this->error('Error');
        echo json_encode(['error'=> 'error']);
        exit();
     }








}