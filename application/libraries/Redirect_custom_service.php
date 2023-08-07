<?php
/*Powered By: Manaknightdigital Inc. https://manaknightdigital.com/ Year: 2021*/
/**
 * Barcode_service
 *
 * @copyright 2021 Manaknightdigital Inc.
 * @link https://manaknightdigital.com
 * @license Proprietary Software licensing
 * @author Ryan Wong
 */
class Redirect_custom_service
{
    private $_url_redirect_model;

    public function set_url_redirect_model($url_redirect_model)
    {
        $this->_url_redirect_model = $url_redirect_model;
    }

    public function check_redirect()
    {
        $current_url = current_url();
        $params = $_SERVER['QUERY_STRING'];

        if(!empty($params))
        {
            $full_url = $current_url . '?' . $params;
        }
        else
        {
            $full_url = $current_url;
        }

        $check_data =$this->_url_redirect_model->get_by_fields([
            'url' => $full_url
        ]);

        if(!empty($check_data))
        {
            $rewrite_url = $this->add_http($check_data->rewrite_url);
            return redirect($rewrite_url);
        }
    }

    public function add_http($url)
    {
        if (!preg_match("~^(?:f|ht)tps?://~i", $url))
        {
            $url = 'https://' . $url;
        }

        return $url;
    }
}