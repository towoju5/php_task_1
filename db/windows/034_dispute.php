<?php defined('BASEPATH') OR exit('No direct script access allowed');
/*Powered By: Manaknightdigital Inc. https://manaknightdigital.com/ Year: 2021*/
/**
 * dispute Migration
 *
 * @copyright 2019 Manaknightdigital Inc.
 * @link https://manaknightdigital.com
 * @license Proprietary Software licensing
 * @author Ryan Wong
 */
class Migration_dispute extends CI_Migration {

        public function up()
        {
          $this->dbforge->add_field([  'id' => array('type' => 'INT','constraint' => 11,'unsigned' => TRUE,'auto_increment' => TRUE),
'order_id' => array('type' => 'INT', 'constraint' => 11, 'null' => TRUE),
'user_id' => array('type' => 'INT', 'constraint' => 11, 'null' => TRUE),
'amount' => array('type' => 'VARCHAR', 'constraint' => '255'),
'reason' => array('type' => 'VARCHAR', 'constraint' => '255'),
'explanation' => array('type' => 'TEXT', 'null' => TRUE),
'stripe_charge_id' => array('type' => 'VARCHAR', 'constraint' => '255'),
'stripe_dispute_id' => array('type' => 'VARCHAR', 'constraint' => '255'),
'status' => array('type' => 'VARCHAR', 'constraint' => '255'),
'created_at' => array('type' => 'DATE', 'null' => TRUE),
'updated_at' => array('type' => 'DATETIME', 'null' => TRUE)]);
          $this->dbforge->add_key('id', TRUE);
          $this->dbforge->create_table('dispute');
          
        }

        public function down()
        {
                $this->dbforge->drop_table('dispute');
        }

}