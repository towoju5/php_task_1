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
class Slug_service
{
    function create_slug($string)
    {
        $slug = trim($string);
        $slug = strtolower($slug);
        $slug = str_replace(' ', '-', $slug);
        return $slug;
    }
}