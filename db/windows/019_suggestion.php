<?php defined('BASEPATH') OR exit('No direct script access allowed');
/*Powered By: Manaknightdigital Inc. https://manaknightdigital.com/ Year: 2021*/
/**
 * suggestion Migration
 *
 * @copyright 2019 Manaknightdigital Inc.
 * @link https://manaknightdigital.com
 * @license Proprietary Software licensing
 * @author Ryan Wong
 */
class Migration_suggestion extends CI_Migration {

        public function up()
        {
          $this->dbforge->add_field([  'id' => array('type' => 'INT','constraint' => 11,'unsigned' => TRUE,'auto_increment' => TRUE),
'seller_id' => array('type' => 'INT', 'constraint' => 11, 'null' => TRUE),
'name' => array('type' => 'VARCHAR', 'constraint' => '255'),
'email' => array('type' => 'VARCHAR', 'constraint' => '255'),
'suggestion_type' => array('type' => 'INT', 'constraint' => 11, 'null' => TRUE),
'additional_notes' => array('type' => 'TEXT', 'null' => TRUE),
'status' => array('type' => 'INT', 'constraint' => 11, 'null' => TRUE),
'created_at' => array('type' => 'DATE', 'null' => TRUE),
'updated_at' => array('type' => 'DATETIME', 'null' => TRUE)]);
          $this->dbforge->add_key('id', TRUE);
          $this->dbforge->create_table('suggestion');
          
        }

        public function down()
        {
                $this->dbforge->drop_table('suggestion');
        }

}