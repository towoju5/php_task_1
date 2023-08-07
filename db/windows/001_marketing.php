<?php defined('BASEPATH') OR exit('No direct script access allowed');
/*Powered By: Manaknightdigital Inc. https://manaknightdigital.com/ Year: 2021*/
/**
 * marketing Migration
 *
 * @copyright 2019 Manaknightdigital Inc.
 * @link https://manaknightdigital.com
 * @license Proprietary Software licensing
 * @author Ryan Wong
 */
class Migration_marketing extends CI_Migration {

        public function up()
        {
          $this->dbforge->add_field([  'id' => array('type' => 'INT','constraint' => 11,'unsigned' => TRUE,'auto_increment' => TRUE),
'user_id' => array('type' => 'INT', 'constraint' => 11, 'null' => TRUE),
'password_protect' => array('type' => 'VARCHAR', 'constraint' => '255'),
'content_template_path' => array('type' => 'TEXT', 'null' => TRUE),
'header_template_path' => array('type' => 'TEXT', 'null' => TRUE),
'footer_template_path' => array('type' => 'TEXT', 'null' => TRUE),
'title' => array('type' => 'TEXT', 'null' => TRUE),
'seo_title' => array('type' => 'TEXT', 'null' => TRUE),
'seo_description' => array('type' => 'TEXT', 'null' => TRUE),
'content' => array('type' => 'TEXT', 'null' => TRUE),
'status' => array('type' => 'INT', 'constraint' => 11, 'null' => TRUE),
'publish_date' => array('type' => 'DATE', 'null' => TRUE),
'slug' => array('type' => 'TEXT', 'null' => TRUE),
'created_at' => array('type' => 'DATE', 'null' => TRUE),
'updated_at' => array('type' => 'DATETIME', 'null' => TRUE)]);
          $this->dbforge->add_key('id', TRUE);
          $this->dbforge->create_table('marketing');
          
        }

        public function down()
        {
                $this->dbforge->drop_table('marketing');
        }

}