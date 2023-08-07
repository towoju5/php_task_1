<?php defined('BASEPATH') OR exit('No direct script access allowed');
include_once 'Admin_controller.php';
/*Powered By: Manaknightdigital Inc. https://manaknightdigital.com/ Year: 2021*/
/**
 * Marketing Controller
 * @copyright 2019 Manaknightdigital Inc.
 * @link https://manaknightdigital.com
 * @license Proprietary Software licensing
 * @author Ryan Wong
 *
 */
class Admin_marketing_controller extends Admin_controller
{
    protected $_model_file = 'marketing_model';
    public $_page_name = 'Marketing';

    public function __construct()
    {
        parent::__construct();
    }

    public function index($page)
	{
        $this->load->library('pagination');
        include_once __DIR__ . '/../../view_models/Marketing_admin_list_paginate_view_model.php';
        $session = $this->get_session();
        $format = $this->input->get('format', TRUE) ?? 'view';
        $order_by = $this->input->get('order_by', TRUE) ?? '';
        $direction = $this->input->get('direction', TRUE) ?? 'ASC';
        $per_page_sort = $this->input->get('per_page_sort', TRUE) ?? 25;

        $this->_data['view_model'] = new Marketing_admin_list_paginate_view_model(
            $this->marketing_model,
            $this->pagination,
            '/admin/marketing/0');
        $this->_data['view_model']->set_heading('Marketing');
        $this->_data['view_model']->set_publish_date(($this->input->get('publish_date', TRUE) != NULL) ? $this->input->get('publish_date', TRUE) : NULL);
		$this->_data['view_model']->set_status(($this->input->get('status', TRUE) != NULL) ? $this->input->get('status', TRUE) : NULL);
        $this->_data['view_model']->set_user_id(($this->input->get('user_id', TRUE) != NULL) ? $this->input->get('user_id', TRUE) : NULL);
        $this->_data['view_model']->set_title(($this->input->get('title', TRUE) != NULL) ? $this->input->get('title', TRUE) : NULL);

        $where = [
            'publish_date' => $this->_data['view_model']->get_publish_date(),
			'status' => $this->_data['view_model']->get_status(),
            'user_id' => $this->_data['view_model']->get_user_id(),
			'title' => $this->_data['view_model']->get_title(),
        ];

        $this->_data['view_model']->set_total_rows($this->marketing_model->count($where));
        $this->_data['view_model']->set_format_layout($this->_data['layout_clean_mode']);
        $this->_data['view_model']->set_per_page($per_page_sort);
        $this->_data['view_model']->set_order_by($order_by);
        $this->_data['view_model']->set_sort($direction);
        $this->_data['view_model']->set_sort_base_url('/admin/marketing/0');
        $this->_data['view_model']->set_page($page);
		$this->_data['view_model']->set_list($this->marketing_model->get_paginated(
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

        return $this->render('Admin/Marketing', $this->_data);
	}

    public function add()
	{
        include_once __DIR__ . '/../../view_models/Marketing_admin_add_view_model.php';
        $session = $this->get_session();
        $this->form_validation = $this->marketing_model->set_form_validation(
        $this->form_validation, $this->marketing_model->get_all_validation_rule());
        $this->_data['view_model'] = new Marketing_admin_add_view_model($this->marketing_model);
        $this->_data['view_model']->set_heading('Marketing');


		if ($this->form_validation->run() === FALSE)
		{
			return $this->render('Admin/MarketingAdd', $this->_data);
        }

        $title = $this->input->post('title', TRUE);
        $seo_title = $this->input->post('seo_title', TRUE);
        $seo_description = $this->input->post('seo_description', TRUE);
		$content = $this->input->post('content', TRUE);
		$slug = $this->input->post('slug', TRUE);
		$password_protect = $this->input->post('password_protect', TRUE);
		$header_template_path = $this->input->post('header_template_path', TRUE);
		$content_template_path = $this->input->post('content_template_path', TRUE);
		$footer_template_path = $this->input->post('footer_template_path', TRUE);
		$status = $this->input->post('status', TRUE);
		$publish_date = date('y-m-d');
        $slug_path = $this->_data['view_model']->marketing_slug_url();
        $result = $this->marketing_model->create([
            'title' => $title,
            'seo_title' => $seo_title,
            'seo_description' => $seo_description,
			'content' => $content,
			'slug' => $slug_path.$slug,
			'password_protect' => $password_protect,
			'header_template_path' => $header_template_path,
			'content_template_path' => $content_template_path,
			'footer_template_path' => $footer_template_path,
			'status' => $status,
            'publish_date' => $publish_date,
            'user_id' => $session['user_id']

        ]);

        if ($result)
        {
            $this->success('Page added successfully');

            return $this->redirect('/admin/marketing/0', 'refresh');
        }

        $this->_data['error'] = 'Error';
        return $this->render('Admin/MarketingAdd', $this->_data);
	}

    public function edit($id)
	{
        $model = $this->marketing_model->get($id);
        $session = $this->get_session();

		if (!$model)
		{
			$this->error('Error');
			return redirect('/admin/marketing/0');
        }

        include_once __DIR__ . '/../../view_models/Marketing_admin_edit_view_model.php';
        $this->form_validation = $this->marketing_model->set_form_validation(
        $this->form_validation, $this->marketing_model->get_all_edit_validation_rule());
        $this->_data['view_model'] = new Marketing_admin_edit_view_model($this->marketing_model);
        $this->_data['view_model']->set_model($model);
        $this->_data['view_model']->set_heading('Marketing');

		if ($this->form_validation->run() === FALSE)
		{
			return $this->render('Admin/MarketingEdit', $this->_data);
        }

        $title = $this->input->post('title', TRUE);
        $seo_title = $this->input->post('seo_title', TRUE);
        $seo_description = $this->input->post('seo_description', TRUE);
		$content = $this->input->post('content', TRUE);
		$slug = $this->input->post('slug', TRUE);
		$password_protect = $this->input->post('password_protect', TRUE);
		$header_template_path = $this->input->post('header_template_path', TRUE);
		$content_template_path = $this->input->post('content_template_path', TRUE);
		$footer_template_path = $this->input->post('footer_template_path', TRUE);
		$status = $this->input->post('status', TRUE);

        $publish_date = date('y-m-d');
        $slug_path = $this->_data['view_model']->marketing_slug_url();

        $result = $this->marketing_model->edit([
            'title' => $title,
            'seo_title' => $seo_title,
            'seo_description' => $seo_description,
			'content' => $content,
			'slug' => $slug_path.$slug,
			'password_protect' => $password_protect,
			'header_template_path' => $header_template_path,
			'content_template_path' => $content_template_path,
			'footer_template_path' => $footer_template_path,
			'status' => $status,
            'publish_date' => $publish_date,
            'user_id' => $session['user_id']

        ], $id);

        if ($result)
        {
            $this->success('Page Edited successfully');

            return $this->redirect('/admin/marketing/0', 'refresh');
        }

        $this->_data['error'] = 'Error';
        return $this->render('Admin/MarketingEdit', $this->_data);
	}

    public function view($id)
	{
        $model = $this->marketing_model->get($id);

		if (!$model)
		{
			$this->error('Error');
			return redirect('/admin/marketing/0');
		}

        return $this->redirect($model->slug);
	}

    public function delete($id)
	{
        $model = $this->marketing_model->get($id);

		if (!$model)
		{
			$this->error('Error');
			return redirect('/admin/marketing/0');
        }


        $result = $this->marketing_model->real_delete($id);

        if ($result)
        {
            $this->success('Page Deleted successfully');
            return $this->redirect('/admin/marketing/0', 'refresh');
        }

        $this->error('Error');
        return redirect('/admin/marketing/0');
	}

    public function bulk_delete()
	{

        $bulk_items = $this->input->post('bulk_items');
        foreach ($bulk_items as $key => $id) {
            $this->marketing_model->real_delete($id);
        }
        echo 'success';
        exit();
	}









}