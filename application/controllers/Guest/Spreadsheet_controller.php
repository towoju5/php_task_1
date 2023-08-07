<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/*Powered By: Manaknightdigital Inc. https://manaknightdigital.com/ Year: 2021*/
/**
 * Voice Controller
 *
 * @copyright 2019 Manaknightdigital Inc.
 * @link https://manaknightdigital.com
 * @license Proprietary Software licensing
 * @author Ryan Wong
 *
 */
class Spreadsheet_controller extends Manaknight_Controller
{
    public $_data = [
        'error' => '',
        'success' => ''
    ];

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('spreadsheet_model');

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

}