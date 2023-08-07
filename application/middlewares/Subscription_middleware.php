<?php defined('BASEPATH') or exit('No direct script access allowed');
/*Powered By: Manaknightdigital Inc. https://manaknightdigital.com/ Year: 2021*/
/**
 * ACL Middleware
 *
 * @copyright 2019 Manaknightdigital Inc.
 * @link https://manaknightdigital.com
 * @license Proprietary Software licensing
 * @author Ryan Wong
 */
class Subscription_middleware
{

    private $_controller;
    private $_ci;

    public function __construct(&$controller, &$ci)
    {
        $this->_controller = $controller;
        $this->_ci = $ci;
        $this->_controller->load->database();
    }

    public function run()
    {
        $session = $this->_controller->get_session();
        $this->_controller->load->model('stripe_subscriptions_model');
        $this->_controller->load->model('stripe_feature_model');
        $this->_controller->load->model('controllers_features_model');

        if (!empty($session)) {
            $user_id = $session['user_id'];
            $role_id = $session['role'];
            $user_sub = $this->_controller->stripe_subscriptions_model->get_last_active_subscription([
                'user_id' => $user_id,
                'role_id' => $role_id,
            ]);

            $portal = $this->_controller->uri->segment(1);

            //if user is not subscriped to anything get all features for plan -1 which is free plan (always should be like this)
            //if user is not subscriped to anything get all features for plan 0 which is access all (always should be like this)
            if (!$user_sub) {
                $features = $this->_controller->stripe_feature_model->get_all(['plan_id' => -1]);
            } else {
                $features = $this->_controller->stripe_feature_model->get_all(['plan_id' => $user_sub->plan_id]);
                if (!$features) {
                    $features = $this->_controller->stripe_feature_model->get_all(['plan_id' => -1]);
                }
            }

            //check if a plan has "all" feature
            $found = false;

            foreach ($features as $feature) {
                // if ($feature->slug == 'all' || $feature->controller_name == 'all') {
                //     $found = true;
                //     break;
                // }
                $feature = $this->_controller->controllers_features_model->get($feature->controller_feature_id);
                if (strcmp($this->_controller->uri->rsegments[1], $feature->controller_name) == 0) {
                    $found = true;
                }
            }

            if ($found == false) {
                $this->_controller->error('Your current subscription doesn\'t have access to that page. Upgrade your subscription.');
                $this->_controller->redirect("/{$portal}/stripe_subscriptions/0", 'refresh');
            }

            return false;

        }
        $this->_controller->error('Subscription required to access page');
        return $this->_controller->redirect("/{$portal}/stripe_subscriptions/0", 'refresh');
    }

}