<?php defined('BASEPATH') OR exit('No direct script access allowed');
/*Powered By: Manaknightdigital Inc. https://manaknightdigital.com/ Year: 2021*/
/**
 * inventory Migration
 *
 * @copyright 2019 Manaknightdigital Inc.
 * @link https://manaknightdigital.com
 * @license Proprietary Software licensing
 * @author Ryan Wong
 */
class Migration_inventory extends CI_Migration {

        public function up()
        {
          $this->dbforge->add_field([  'id' => array('type' => 'INT','constraint' => 11,'unsigned' => TRUE,'auto_increment' => TRUE),
'user_id' => array('type' => 'INT', 'constraint' => 11, 'null' => TRUE),
'title' => array('type' => 'VARCHAR', 'constraint' => '255'),
'school_id' => array('type' => 'INT', 'constraint' => 11, 'null' => TRUE),
'professor_id' => array('type' => 'INT', 'constraint' => 11, 'null' => TRUE),
'class_id' => array('type' => 'INT', 'constraint' => 11, 'null' => TRUE),
'textbook_id' => array('type' => 'INT', 'constraint' => 11, 'null' => TRUE),
'word_count' => array('type' => 'INT', 'constraint' => 11, 'null' => TRUE),
'year' => array('type' => 'INT', 'constraint' => 11, 'null' => TRUE),
'isbn' => array('type' => 'VARCHAR', 'constraint' => '255'),
'paypal_email' => array('type' => 'VARCHAR', 'constraint' => '255'),
'file' => array('type' => 'TEXT', 'null' => TRUE),
'file_id' => array('type' => 'INT', 'constraint' => 11, 'null' => TRUE),
'feature_image' => array('type' => 'TEXT', 'null' => TRUE),
'feature_image2' => array('type' => 'TEXT', 'null' => TRUE),
'feature_image3' => array('type' => 'TEXT', 'null' => TRUE),
'feature_image_id' => array('type' => 'INT', 'constraint' => 11, 'null' => TRUE),
'note_type' => array('type' => 'INT', 'constraint' => 11, 'null' => TRUE),
'description' => array('type' => 'TEXT', 'null' => TRUE),
'inventory_note' => array('type' => 'TEXT', 'null' => TRUE),
'pin_to_top' => array('type' => 'INT', 'constraint' => 11, 'null' => TRUE),
'approve' => array('type' => 'INT', 'constraint' => 11, 'null' => TRUE),
'status' => array('type' => 'INT', 'constraint' => 11, 'null' => TRUE),
'created_at' => array('type' => 'DATE', 'null' => TRUE),
'updated_at' => array('type' => 'DATETIME', 'null' => TRUE)]);
          $this->dbforge->add_key('id', TRUE);
          $this->dbforge->create_table('inventory');
          
        }

        public function down()
        {
                $this->dbforge->drop_table('inventory');
        }

}