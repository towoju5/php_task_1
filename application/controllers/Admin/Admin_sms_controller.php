<?php defined('BASEPATH') OR exit('No direct script access allowed');
include_once 'Admin_controller.php';
/*Powered By: Manaknightdigital Inc. https://manaknightdigital.com/ Year: 2021*/
/**
 * Sms Controller
 * @copyright 2019 Manaknightdigital Inc.
 * @link https://manaknightdigital.com
 * @license Proprietary Software licensing
 * @author Ryan Wong
 *
 */
class Admin_sms_controller extends Admin_controller
{
    protected $_model_file = 'sms_model';
    public $_page_name = 'SMS';

    public function __construct()
    {
        parent::__construct();
        
        
        
    }

    

    	public function index()
	{
		$this->load->library('pagination');
		$session = $this->get_session();
        include_once __DIR__ . '/../../view_models/Sms_admin_list_view_model.php';
        $this->_data['view_model'] = new Sms_admin_list_view_model($this->sms_model);
		$this->_data['view_model']->set_list($this->sms_model->get_all());
		$this->_data['view_model']->set_heading('SMS');
		
        
        return $this->render('Admin/Sms', $this->_data);
	}

    	public function add()
	{
        include_once __DIR__ . '/../../view_models/Sms_admin_add_view_model.php';
        $session = $this->get_session();
        $this->form_validation = $this->sms_model->set_form_validation(
        $this->form_validation, $this->sms_model->get_all_validation_rule());
        $this->_data['view_model'] = new Sms_admin_add_view_model($this->sms_model);
        $this->_data['view_model']->set_heading('SMS');
        
        
        
        
		if ($this->form_validation->run() === FALSE)
		{
			return $this->render('Admin/SmsAdd', $this->_data);
        }

        $slug = $this->input->post('slug', TRUE);
		$content = $this->input->post('content', TRUE);
		$tag = $this->input->post('tag', TRUE);
		
        $result = $this->sms_model->create([
            'slug' => $slug,
			'content' => $content,
			'tag' => $tag,
			
        ]);

        if ($result)
        {
            
            
            return $this->redirect('/admin/sms', 'refresh');
        }

        $this->_data['error'] = 'Error';
        return $this->render('Admin/SmsAdd', $this->_data);
	}

    	public function edit($id)
	{
        $model = $this->sms_model->get($id);
        $session = $this->get_session();
		if (!$model)
		{
			$this->error('Error');
			return redirect('/admin/sms');
        }

        include_once __DIR__ . '/../../view_models/Sms_admin_edit_view_model.php';
        $this->form_validation = $this->sms_model->set_form_validation(
        $this->form_validation, $this->sms_model->get_all_edit_validation_rule());
        $this->_data['view_model'] = new Sms_admin_edit_view_model($this->sms_model);
        $this->_data['view_model']->set_model($model);
        $this->_data['view_model']->set_heading('SMS');
        
        
        
        
		if ($this->form_validation->run() === FALSE)
		{
			return $this->render('Admin/SmsEdit', $this->_data);
        }

        $content = $this->input->post('content', TRUE);
		$tag = $this->input->post('tag', TRUE);
		$slug = $this->input->post('slug', TRUE);
		
        $result = $this->sms_model->edit([
            'content' => $content,
			'tag' => $tag,
			'slug' => $slug,
			
        ], $id);

        if ($result)
        {
            
            
            return $this->redirect('/admin/sms', 'refresh');
        }

        $this->_data['error'] = 'Error';
        return $this->render('Admin/SmsEdit', $this->_data);
	}

    	public function view($id)
	{
        $model = $this->sms_model->get($id);

		if (!$model)
		{
			$this->error('Error');
			return redirect('/admin/sms');
		}


        include_once __DIR__ . '/../../view_models/Sms_admin_view_view_model.php';
		$this->_data['view_model'] = new Sms_admin_view_view_model($this->sms_model);
		$this->_data['view_model']->set_heading('SMS');
        $this->_data['view_model']->set_model($model);
        
        
		return $this->render('Admin/SmsView', $this->_data);
	}

    

    

    

    

    

    

    
}