<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Admin Controller
 *
 * @copyright 2019 Manaknightdigital Inc.
 * @link https://manaknightdigital.com
 * @license Proprietary Software licensing
 * @author Ryan Wong
 *
 */
class Admin_controller extends Manaknight_Controller
{

    public $_page_name ='dashboard';

    public $_valid_roles = [2];

    public function __construct()
    {
        parent::__construct();

        $this->_data['page_name'] = $this->_page_name;
        $this->_data['setting'] = $this->_setting;
        $this->_data['layout_clean_mode'] = FALSE;
        $this->_run_middlewares();
        $layout_mode = $this->input->get('layout_clean_mode', TRUE);
        if (isset($layout_mode) && $layout_mode === '1')
        {
            $this->_data['layout_clean_mode'] = TRUE;
        }
    }

    protected function _middleware()
    {
        return [
            'auth', 'acl'
        ];
    }

    public function render($template, $data)
    {
        return (!$this->_test_mode) ? $this->_render($template, $data) : $this->_render_test($template, $data);
    }

    protected function _render_test($template, $data)
    {
        return [
            'header' => $this->load->view('Layout/AdminHeader', $data, TRUE),
            'body' => $this->load->view($template, $data, TRUE),
            'footer' => $this->load->view('Layout/AdminFooter', $data, TRUE),
            'data' => $data,
        ];
    }
    /**
     * Function to return the images for media gallery
     */
    public function get_all_images()
    {
        $this->load->model('image_model');
        $images = $this->image_model->get_all();
        return $images;
    }

    protected function _render($template, $data)
    {
        $data['images'] = $this->get_all_images();
        $data['page_section'] = $template;
        $this->load->view('Layout/AdminHeader', $data);
        $this->load->view($template, $data);
        $this->load->view('Layout/AdminFooter',$data);
    }

    /**
     * User token invalid
     *
     * @return string
     */
    public function unauthorize_error_message()
    {
        return $this->output->set_content_type('application/json')
        ->set_status_header(401)
        ->set_output(json_encode([
            'code' => 401,
            'success' => FALSE,
            'message' => 'invalid credentials'
        ]));
    }

    /**
     * User Role invalid
     *
     * @return string
     */
    public function unauthorize_resource_error_message()
    {
        return $this->output->set_content_type('application/json')
            ->set_status_header(406)
            ->set_output(json_encode([
                'code' => 406,
                'success' => FALSE,
                'message' => 'cannot access resource'
            ]));
    }

    /**
     * Success API Call
     *
     * @return string
     */
    public function success2($success)
    {
        $success['code'] = 200;
        $success['success'] = TRUE;
        return $this->output->set_content_type('application/json')
            ->set_status_header(200)
            ->set_output(json_encode($success));
    }

    /**
     * Invalid form input
     *
     * @return string
     */
    protected function _render_validation_error ()
	{
        $data = [];
        $data['code'] = 403;
        $data['success'] = FALSE;
        $data['error'] = $this->form_validation->error_array();
        return $this->output->set_content_type('application/json')
            ->set_status_header(403)
            ->set_output(json_encode($data));
    }

    /**
     * Render Custom Error
     *
     * @return string
     */
    protected function _render_custom_error ($errors)
	{
        $data = [];
        $data['code'] = 403;
        $data['success'] = FALSE;
        $data['error'] = $errors;
        return $this->output->set_content_type('application/json')
            ->set_status_header(403)
            ->set_output(json_encode($data));
    }
}