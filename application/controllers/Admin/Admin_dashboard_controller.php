<?php defined('BASEPATH') OR exit('No direct script access allowed');
include_once 'Admin_controller.php';

/**
 * Admin Dashboard Controller
 * @copyright 2019 Manaknightdigital Inc.
 * @link https://manaknightdigital.com
 * @license Proprietary Software licensing
 * @author Ryan Wong
 *
 */
class Admin_dashboard_controller extends Admin_controller
{
    public $_page_name = 'Dashboard';

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Admin_operation_model');
    }

    public function index ()
    {
        $this->_data['member_accounts'] = $this->Admin_operation_model->getMemberAccountData();
        $this->_data['member_uploads'] = $this->Admin_operation_model->getMemberUploadData();
        $this->_data['top_school_account'] = $this->Admin_operation_model->getAccountsBySchool();
        $this->_data['top_school_upload'] = $this->Admin_operation_model->getUploadsBySchool();
        return $this->render('Admin/Dashboard', $this->_data);
    }
}