<?php defined('BASEPATH') OR exit('No direct script access allowed');
/*Powered By: Manaknightdigital Inc. https://manaknightdigital.com/ Year: 2021*/
/**
 * inventoryGalleryImageList Migration
 *
 * @copyright 2019 Manaknightdigital Inc.
 * @link https://manaknightdigital.com
 * @license Proprietary Software licensing
 * @author Ryan Wong
 */
class Migration_inventory_gallery_image_list extends CI_Migration {

        public function up()
        {
          $this->dbforge->add_field([  'id' => array('type' => 'INT','constraint' => 11,'unsigned' => TRUE,'auto_increment' => TRUE),
'inventory_id' => array('type' => 'INT', 'constraint' => 11, 'null' => TRUE),
'gallery_image' => array('type' => 'TEXT', 'null' => TRUE),
'gallery_image_id' => array('type' => 'INT', 'constraint' => 11, 'null' => TRUE),
'status' => array('type' => 'INT', 'constraint' => 11, 'null' => TRUE),
'created_at' => array('type' => 'DATE', 'null' => TRUE),
'updated_at' => array('type' => 'DATETIME', 'null' => TRUE)]);
          $this->dbforge->add_key('id', TRUE);
          $this->dbforge->create_table('inventory_gallery_image_list');
          
        }

        public function down()
        {
                $this->dbforge->drop_table('inventory_gallery_image_list');
        }

}