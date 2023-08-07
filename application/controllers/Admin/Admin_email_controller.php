<?php defined('BASEPATH') OR exit('No direct script access allowed');
include_once 'Admin_controller.php';
/*Powered By: Manaknightdigital Inc. https://manaknightdigital.com/ Year: 2021*/
/**
 * Email Controller
 * @copyright 2019 Manaknightdigital Inc.
 * @link https://manaknightdigital.com
 * @license Proprietary Software licensing
 * @author Ryan Wong
 *
 */
class Admin_email_controller extends Admin_controller
{
    protected $_model_file = 'email_model';
    public $_page_name = 'Emails';

    public function __construct()
    {
        parent::__construct();
        
        
        
    }

    

    	public function index($page)
	{
        $this->load->library('pagination');
        include_once __DIR__ . '/../../view_models/Email_admin_list_paginate_view_model.php';
        $session = $this->get_session();
        $format = $this->input->get('format', TRUE) ?? 'view';
        $order_by = $this->input->get('order_by', TRUE) ?? '';
        $direction = $this->input->get('direction', TRUE) ?? 'ASC';
        $per_page_sort = $this->input->get('per_page_sort', TRUE) ?? 25;

        $this->_data['view_model'] = new Email_admin_list_paginate_view_model(
            $this->email_model,
            $this->pagination,
            '/admin/emails/0');
        $this->_data['view_model']->set_heading('Emails');
        $this->_data['view_model']->set_slug(($this->input->get('slug', TRUE) != NULL) ? $this->input->get('slug', TRUE) : NULL);
		$this->_data['view_model']->set_subject(($this->input->get('subject', TRUE) != NULL) ? $this->input->get('subject', TRUE) : NULL);
		$this->_data['view_model']->set_tag(($this->input->get('tag', TRUE) != NULL) ? $this->input->get('tag', TRUE) : NULL);
		
        $where = [
            'slug' => $this->_data['view_model']->get_slug(),
			'subject' => $this->_data['view_model']->get_subject(),
			'tag' => $this->_data['view_model']->get_tag(),
			
            
        ];

        $this->_data['view_model']->set_total_rows($this->email_model->count($where));

        $this->_data['view_model']->set_format_layout($this->_data['layout_clean_mode']);
        $this->_data['view_model']->set_per_page($per_page_sort);
        $this->_data['view_model']->set_order_by($order_by);
        $this->_data['view_model']->set_sort($direction);
        $this->_data['view_model']->set_sort_base_url('/admin/emails/0');
        $this->_data['view_model']->set_page($page);
		$this->_data['view_model']->set_list($this->email_model->get_paginated(
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

        return $this->render('Admin/Email', $this->_data);
	}

    	public function add()
	{
        include_once __DIR__ . '/../../view_models/Email_admin_add_view_model.php';
        $session = $this->get_session();
        $this->form_validation = $this->email_model->set_form_validation(
        $this->form_validation, $this->email_model->get_all_validation_rule());
        $this->_data['view_model'] = new Email_admin_add_view_model($this->email_model);
        $this->_data['view_model']->set_heading('Emails');
        
        
        
        
		if ($this->form_validation->run() === FALSE)
		{
			return $this->render('Admin/EmailAdd', $this->_data);
        }

        $slug = $this->input->post('slug', TRUE);
		$subject = $this->input->post('subject', TRUE);
		$email_header = $this->input->post('email_header', TRUE);
		$email_footer = $this->input->post('email_footer', TRUE);
		$subject = $this->input->post('subject', TRUE);
		$tag = $this->input->post('tag', TRUE);
		$html = $this->input->post('html', TRUE);
		
        $result = $this->email_model->create([
            'slug' => $slug,
			'subject' => $subject,
			'email_header' => $email_header,
			'email_footer' => $email_footer,
			'subject' => $subject,
			'tag' => $tag,
			'html' => $html,
			
        ]);

        if ($result)
        {
            
            
            return $this->redirect('/admin/emails/0', 'refresh');
        }

        $this->_data['error'] = 'Error';
        return $this->render('Admin/EmailAdd', $this->_data);
	}

    	public function edit($id)
	{
        $model = $this->email_model->get($id);
        $session = $this->get_session();
		if (!$model)
		{
			$this->error('Error');
			return redirect('/admin/emails/0');
        }

        include_once __DIR__ . '/../../view_models/Email_admin_edit_view_model.php';
        $this->form_validation = $this->email_model->set_form_validation(
        $this->form_validation, $this->email_model->get_all_edit_validation_rule());
        $this->_data['view_model'] = new Email_admin_edit_view_model($this->email_model);
        $this->_data['view_model']->set_model($model);
        $this->_data['view_model']->set_heading('Emails');
        
        
        
        
		if ($this->form_validation->run() === FALSE)
		{
			return $this->render('Admin/EmailEdit', $this->_data);
        }

        $subject = $this->input->post('subject', TRUE);
		$email_header = $this->input->post('email_header', TRUE);
		$html = $this->input->post('html', TRUE);
		$email_footer = $this->input->post('email_footer', TRUE);
		$tag = $this->input->post('tag', TRUE);
		
        $result = $this->email_model->edit([
            'subject' => $subject,
			'email_header' => $email_header,
			'html' => $html,
			'email_footer' => $email_footer,
			'tag' => $tag,
			
        ], $id);

        if ($result)
        {
            
            
            return $this->redirect('/admin/emails/0', 'refresh');
        }

        $this->_data['error'] = 'Error';
        return $this->render('Admin/EmailEdit', $this->_data);
	}

    	public function view($id)
	{
        $model = $this->email_model->get($id);

		if (!$model)
		{
			$this->error('Error');
			return redirect('/admin/emails/0');
		}


        include_once __DIR__ . '/../../view_models/Email_admin_view_view_model.php';
		$this->_data['view_model'] = new Email_admin_view_view_model($this->email_model);
		$this->_data['view_model']->set_heading('Emails');
        $this->_data['view_model']->set_model($model);
        
        
		return $this->render('Admin/EmailView', $this->_data);
	}

    

    

    

    

    

    

    
}