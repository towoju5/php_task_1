<?php defined('BASEPATH') OR exit('No direct script access allowed');
include_once 'Member_controller.php';

/**
 * Member Dashboard Controller
 * @copyright 2019 Manaknightdigital Inc.
 * @link https://manaknightdigital.com
 * @license Proprietary Software licensing
 * @author Ryan Wong
 *
 */
class Member_dashboard_controller extends Member_controller
{
    public $_page_name = 'Dashboard';

    public function __construct()
    {
        parent::__construct();
    }

    public function index ()
    {
        return $this->render('Member/Dashboard', $this->_data);
    }
}