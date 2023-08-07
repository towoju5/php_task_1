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
class Barcode_service
{
    public function generate_png_barcode($barcode,$manual_text = null)
    {
        if($manual_text == null)
        {
            $barcode_image_name = '/uploads/' . $barcode . '-barcode.png';
        }
        else
        {
            $barcode_image_name = '/uploads/' . $barcode . '-' . $manual_text . '-barcode.png';
        }

        $generator = new Picqer\Barcode\BarcodeGeneratorPNG();

        $black_color  = [0, 0, 0];

        $file_name = __DIR__ . '/../../../' . $barcode_image_name;
        $barcode = $generator->getBarcode($barcode, $generator::TYPE_CODE_128 ,3 , 50, $black_color);

        if(file_put_contents($file_name, $barcode))
        {
            return $barcode_image_name;
        }
    }
}