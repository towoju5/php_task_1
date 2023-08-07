<?php defined('BASEPATH') OR exit('No direct script access allowed');
include_once 'Admin_controller.php';
/*Powered By: Manaknightdigital Inc. https://manaknightdigital.com/ Year: 2021*/
/**
 * Suggestion Controller
 * @copyright 2019 Manaknightdigital Inc.
 * @link https://manaknightdigital.com
 * @license Proprietary Software licensing
 * @author Ryan Wong
 *
 */
class Admin_suggestion_controller extends Admin_controller
{
    protected $_model_file = 'suggestion_model';
    public $_page_name = 'Suggestion';

    public function __construct()
    {
        parent::__construct();
        
        
        
    }

    

    	public function index($page)
	{
        $this->load->library('pagination');
        include_once __DIR__ . '/../../view_models/Suggestion_admin_list_paginate_view_model.php';
        $session = $this->get_session();
        $format = $this->input->get('format', TRUE) ?? 'view';
        $order_by = $this->input->get('order_by', TRUE) ?? '';
        $direction = $this->input->get('direction', TRUE) ?? 'ASC';
        $per_page_sort = $this->input->get('per_page_sort', TRUE) ?? 25;

        $this->_data['view_model'] = new Suggestion_admin_list_paginate_view_model(
            $this->suggestion_model,
            $this->pagination,
            '/admin/suggestion/0');
        $this->_data['view_model']->set_heading('Suggestion');
        $this->_data['view_model']->set_id(($this->input->get('id', TRUE) != NULL) ? $this->input->get('id', TRUE) : NULL);
		$this->_data['view_model']->set_name(($this->input->get('name', TRUE) != NULL) ? $this->input->get('name', TRUE) : NULL);
		$this->_data['view_model']->set_email(($this->input->get('email', TRUE) != NULL) ? $this->input->get('email', TRUE) : NULL);
		$this->_data['view_model']->set_suggestion_type(($this->input->get('suggestion_type', TRUE) != NULL) ? $this->input->get('suggestion_type', TRUE) : NULL);
		$this->_data['view_model']->set_additional_notes(($this->input->get('additional_notes', TRUE) != NULL) ? $this->input->get('additional_notes', TRUE) : NULL);
		$this->_data['view_model']->set_created_at(($this->input->get('created_at', TRUE) != NULL) ? $this->input->get('created_at', TRUE) : NULL);
		$this->_data['view_model']->set_status(($this->input->get('status', TRUE) != NULL) ? $this->input->get('status', TRUE) : NULL);
		
        $where = [
            'id' => $this->_data['view_model']->get_id(),
			'name' => $this->_data['view_model']->get_name(),
			'email' => $this->_data['view_model']->get_email(),
			'suggestion_type' => $this->_data['view_model']->get_suggestion_type(),
			'additional_notes' => $this->_data['view_model']->get_additional_notes(),
			'created_at' => $this->_data['view_model']->get_created_at(),
			'status' => $this->_data['view_model']->get_status(),
			
            
        ];

        $this->_data['view_model']->set_total_rows($this->suggestion_model->count($where));

        $this->_data['view_model']->set_format_layout($this->_data['layout_clean_mode']);
        $this->_data['view_model']->set_per_page($per_page_sort);
        $this->_data['view_model']->set_order_by($order_by);
        $this->_data['view_model']->set_sort($direction);
        $this->_data['view_model']->set_sort_base_url('/admin/suggestion/0');
        $this->_data['view_model']->set_page($page);
		$this->_data['view_model']->set_list($this->suggestion_model->get_paginated(
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

        return $this->render('Admin/Suggestion', $this->_data);
	}

    

    

    	public function view($id)
	{
        $model = $this->suggestion_model->get($id);

		if (!$model)
		{
			$this->error('Error');
			return redirect('/admin/suggestion/0');
		}


        include_once __DIR__ . '/../../view_models/Suggestion_admin_view_view_model.php';
		$this->_data['view_model'] = new Suggestion_admin_view_view_model($this->suggestion_model);
		$this->_data['view_model']->set_heading('Suggestion');
        $this->_data['view_model']->set_model($model);
        
        
		return $this->render('Admin/SuggestionView', $this->_data);
	}

    	public function delete($id)
	{
        $model = $this->suggestion_model->get($id);
       
		if (!$model)
		{
			// $this->error('Error');
			// return redirect('/admin/suggestion/0');
        }
        
        $result = $this->suggestion_model->real_delete($id);

        if ($result)
        {
            
            return $this->redirect('/admin/suggestion/0', 'refresh');
        }

        $this->error('Error');
        return redirect('/admin/suggestion/0');
	}

    

    

    

    

    

    
}