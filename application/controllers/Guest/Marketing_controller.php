<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/*Powered By: Manaknightdigital Inc. https://manaknightdigital.com/ Year: 2021*/
/**
 * Marketing Controller
 *
 * @copyright 2021 Manaknightdigital Inc.
 * @link https://manaknightdigital.com
 * @license Proprietary Software licensing
 * @author Ryan Wong
 *
 */
class Marketing_controller extends Manaknight_Controller
{
    public $_data = [
        'error' => '',
        'success' => ''
    ];

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('marketing_model');

    }

    /**
     * Debug Controller to error_log and turn off in production
     *
     * @param mixed $data
     * @return void
     */
    public function dl($key, $data)
    {
        if (ENVIRONMENT == 'development')
        {
            error_log($key . ' CONTROLLER : <pre>' . print_r($data, TRUE) . '</pre>');
        }
    }

    /**
     * Debug json Controller to error_log and turn off in production
     *
     * @param mixed $data
     * @return void
     */
    public function dj($key, $data)
    {
        if (ENVIRONMENT == 'development')
        {
            error_log($key . ' CONTROLLER : ' . json_encode($data));
        }
    }

    public function get_session()
    {
        if (!$this->_test_mode)
        {
            return $_SESSION;
        }

        $session = $this->config->item('session_test');

        if (!$session)
        {
            $session = [];
        }

        return $session;
    }

    public function set_session($field, $value)
    {
        if (!$this->_test_mode)
        {
            $_SESSION[$field] = $value;
        }
        else
        {
            $session = $this->config->item('session_test');
            if (!$session)
            {
                $session = [];
            }
            $session[$field] = $value;
            $this->config->set_item('session_test', $session);
        }
    }

    public function destroy_session()
    {
        if (!$this->_test_mode)
        {
            unset($_SESSION);
        }
        else
        {
            $this->config->set_item('session_test', []);
        }
    }

    public function get_setting()
    {
        return $this->_setting;
    }

    /**
     * Function to generate a slug
     */
    public function generate_marketing_slug($str)
    {

        $delimiter = '-';
        $slug = strtolower(trim(preg_replace('/[\s-]+/', $delimiter, preg_replace('/[^A-Za-z0-9-]+/', $delimiter, preg_replace('/[&]/', 'and', preg_replace('/[\']/', '', iconv('UTF-8', 'ASCII//TRANSLIT', $str))))), $delimiter));
        $full_path = base_url() . 'a/';

        $row = $this->marketing_model->get_by_field('slug', $full_path . $slug);

        if (empty($row))
        {
            $output['slug'] = $slug;
			echo json_encode($output);
			exit;
        }
        else
        {
            $i = 1;
            $check_me_again = TRUE;
            while ($check_me_again)
            {
                $slug = $slug . '-' . $i;
                $row = $this->marketing_model->get_by_field('slug', $full_path . $slug);

                if (empty($row))
                {
                    $check_me_again = FALSE;
                }
                $i++;
            }

            $output['slug'] = $slug;
			echo json_encode($output);
			exit;
        }
    }

    /**
     * Function to return the generated page
     */
    public function generate_custom_marketing_page($slug)
    {
        $slug_url = base_url() . 'a/';
        $slug = $slug_url.$slug;
        $marketing_data = $this->marketing_model->get_by_field('slug',$slug);
        $this->_data['header'] = '';
        $this->_data['footer'] =  '';
        $this->_data['content_template'] = '';
        $this->_data['content'] = '';
        $this->_data['success'] = '';
        $this->_data['error'] = '';
        $this->_data['layout_clean_mode'] = TRUE;
        $this->_data['reuse_query_string'] = TRUE;
        $this->_data['base_url'] = base_url();
        $this->_data['total_rows'] = 25;
        $this->_data['per_page'] = 25;
        $this->_data['num_links'] = '';
        $this->_data['full_tag_open'] = '<ul class="pagination justify-content-end">';
        $this->_data['full_tag_close'] = '</ul>';
        $this->_data['attributes'] = ['class' => 'page-link'];
        $this->_data['first_link'] = FALSE ;
        $this->_data['last_link'] =  FALSE;
        $this->_data['first_tag_open'] = '<li class="page-item">';
        $this->_data['first_tag_close'] = '</li>';
        $this->_data['prev_link'] = '&laquo';
        $this->_data['setting'] = $this->get_setting();
        $this->_data['list'] = [];

        if($marketing_data)
        {
            if($marketing_data->header_template_path != '')
            {
                $this->_data['header'] = $marketing_data->header_template_path ? $marketing_data->header_template_path : '';
            }

            if($marketing_data->footer_template_path != '')
            {
                $this->_data['footer'] = $marketing_data->footer_template_path ? $marketing_data->footer_template_path : '';
            }

            $this->_data['content'] = $marketing_data->content ? $marketing_data->content : '';
            $this->_data['content_template'] =  $marketing_data->content_template_path ? $marketing_data->content_template_path : '';

            if($marketing_data->status == 0)
            {
                if ($marketing_data->password_protect == '')
                {
                    return $this->generate_marketing_template($this->_data);
                }
                else
                {
                    $valid_passwords = [
                        'guest' => $marketing_data->password_protect
                    ];
                    $valid_users = array_keys($valid_passwords);

                    $user = $_SERVER['PHP_AUTH_USER'];
                    $pass = $_SERVER['PHP_AUTH_PW'];

                    $validated = (in_array($user, $valid_users)) && ($pass == $valid_passwords[$user]);

                    if (!$validated)
                    {
                      header('WWW-Authenticate: Basic realm="My Realm"');
                      header('HTTP/1.0 401 Unauthorized');
                      die ('Not authorized');
                    }

                    return $this->generate_marketing_template($this->_data);

                }
            }
            else
            {
                $this->output->set_status_header('404');
                $data['heading'] = '404 Page Not Found';
                $data['message'] = 'The page you requested was not found';
                $this->load->view('errors/html/error_404',$data);
                exit();
            }

        }
        $this->output->set_status_header('404');
		$data['heading'] = '404 Page Not Found';
		$data['message'] = 'The page you requested was not found';
		$this->load->view('errors/html/error_404', $data);
        exit();
    }

    /**
     * Function to generate marketing template
     */

    public function generate_marketing_template($marketing_data)
    {
        if($marketing_data['header'] != '')
        {
            $this->load->view($marketing_data['header'], $marketing_data);
        }

        if($marketing_data['content_template'] == '')
        {
            echo $marketing_data['content_template'];
        }
        else
        {
           $this->load->view('Guest/Template_page', $marketing_data);
        }

        if($marketing_data['footer'] != '')
        {
           $this->load->view($marketing_data['footer'], $marketing_data);
        }
    }
}