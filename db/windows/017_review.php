<?php defined('BASEPATH') OR exit('No direct script access allowed');
/*Powered By: Manaknightdigital Inc. https://manaknightdigital.com/ Year: 2021*/
/**
 * review Migration
 *
 * @copyright 2019 Manaknightdigital Inc.
 * @link https://manaknightdigital.com
 * @license Proprietary Software licensing
 * @author Ryan Wong
 */
class Migration_review extends CI_Migration {

        public function up()
        {
          $this->dbforge->add_field([  'id' => array('type' => 'INT','constraint' => 11,'unsigned' => TRUE,'auto_increment' => TRUE),
'user_id' => array('type' => 'INT', 'constraint' => 11, 'null' => TRUE),
'inventory_id' => array('type' => 'INT', 'constraint' => 11, 'null' => TRUE),
'order_id' => array('type' => 'INT', 'constraint' => 11, 'null' => TRUE),
'status' => array('type' => 'INT', 'constraint' => 11, 'null' => TRUE),
'comment' => array('type' => 'TEXT', 'null' => TRUE),
'rating' => array('type' => 'INT', 'constraint' => 11, 'null' => TRUE),
'created_at' => array('type' => 'DATE', 'null' => TRUE),
'updated_at' => array('type' => 'DATETIME', 'null' => TRUE)]);
          $this->dbforge->add_key('id', TRUE);
          $this->dbforge->create_table('review');
          
        }

        public function down()
        {
                $this->dbforge->drop_table('review');
        }

}