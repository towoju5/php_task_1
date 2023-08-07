<?php defined('BASEPATH') OR exit('No direct script access allowed');
include_once 'Admin_controller.php';
/*Powered By: Manaknightdigital Inc. https://manaknightdigital.com/ Year: 2021*/
/**
 * Contact_us Controller
 * @copyright 2019 Manaknightdigital Inc.
 * @link https://manaknightdigital.com
 * @license Proprietary Software licensing
 * @author Ryan Wong
 *
 */
class Admin_contact_us_controller extends Admin_controller
{
    protected $_model_file = 'contact_us_model';
    public $_page_name = 'Contact';

    public function __construct()
    {
        parent::__construct();
        
        
        
    }

    

    	public function index($page)
	{
        $this->load->library('pagination');
        include_once __DIR__ . '/../../view_models/Contact_us_admin_list_paginate_view_model.php';
        $session = $this->get_session();
        $format = $this->input->get('format', TRUE) ?? 'view';
        $order_by = $this->input->get('order_by', TRUE) ?? '';
        $direction = $this->input->get('direction', TRUE) ?? 'ASC';
        $per_page_sort = $this->input->get('per_page_sort', TRUE) ?? 25;

        $this->_data['view_model'] = new Contact_us_admin_list_paginate_view_model(
            $this->contact_us_model,
            $this->pagination,
            '/admin/contact_us/0');
        $this->_data['view_model']->set_heading('Contact');
        $this->_data['view_model']->set_id(($this->input->get('id', TRUE) != NULL) ? $this->input->get('id', TRUE) : NULL);
		$this->_data['view_model']->set_name(($this->input->get('name', TRUE) != NULL) ? $this->input->get('name', TRUE) : NULL);
		$this->_data['view_model']->set_email(($this->input->get('email', TRUE) != NULL) ? $this->input->get('email', TRUE) : NULL);
		$this->_data['view_model']->set_message(($this->input->get('message', TRUE) != NULL) ? $this->input->get('message', TRUE) : NULL);
		$this->_data['view_model']->set_created_at(($this->input->get('created_at', TRUE) != NULL) ? $this->input->get('created_at', TRUE) : NULL);
		
        $where = [
            'id' => $this->_data['view_model']->get_id(),
			'name' => $this->_data['view_model']->get_name(),
			'email' => $this->_data['view_model']->get_email(),
			'message' => $this->_data['view_model']->get_message(),
			'created_at' => $this->_data['view_model']->get_created_at(),
			
            
        ];

        $this->_data['view_model']->set_total_rows($this->contact_us_model->count($where));

        $this->_data['view_model']->set_format_layout($this->_data['layout_clean_mode']);
        $this->_data['view_model']->set_per_page($per_page_sort);
        $this->_data['view_model']->set_order_by($order_by);
        $this->_data['view_model']->set_sort($direction);
        $this->_data['view_model']->set_sort_base_url('/admin/contact_us/0');
        $this->_data['view_model']->set_page($page);
		$this->_data['view_model']->set_list($this->contact_us_model->get_paginated(
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

        return $this->render('Admin/Contact_us', $this->_data);
	}

    

    

    	public function view($id)
	{
        $model = $this->contact_us_model->get($id);

		if (!$model)
		{
			$this->error('Error');
			return redirect('/admin/contact_us/0');
		}


        include_once __DIR__ . '/../../view_models/Contact_us_admin_view_view_model.php';
		$this->_data['view_model'] = new Contact_us_admin_view_view_model($this->contact_us_model);
		$this->_data['view_model']->set_heading('Contact');
        $this->_data['view_model']->set_model($model);
        
        
		return $this->render('Admin/Contact_usView', $this->_data);
	}

    

    

    

    

    

    

    
}