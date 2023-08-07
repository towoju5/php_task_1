<?php defined('BASEPATH') OR exit('No direct script access allowed');
/*Powered By: Manaknightdigital Inc. https://manaknightdigital.com/ Year: 2021*/
/**
 * payout Migration
 *
 * @copyright 2019 Manaknightdigital Inc.
 * @link https://manaknightdigital.com
 * @license Proprietary Software licensing
 * @author Ryan Wong
 */
class Migration_payout extends CI_Migration {

        public function up()
        {
          $this->dbforge->add_field([  'id' => array('type' => 'INT','constraint' => 11,'unsigned' => TRUE,'auto_increment' => TRUE),
'user_id' => array('type' => 'INT', 'constraint' => 11, 'null' => TRUE),
'order_id' => array('type' => 'INT', 'constraint' => 11, 'null' => TRUE),
'inventory_id' => array('type' => 'INT', 'constraint' => 11, 'null' => TRUE),
'name' => array('type' => 'VARCHAR', 'constraint' => '255'),
'email' => array('type' => 'VARCHAR', 'constraint' => '255'),
'amount' => array('type' => 'VARCHAR', 'constraint' => '255'),
'payout_date' => array('type' => 'DATE', 'null' => TRUE),
'status' => array('type' => 'INT', 'constraint' => 11, 'null' => TRUE),
'created_at' => array('type' => 'DATE', 'null' => TRUE),
'updated_at' => array('type' => 'DATETIME', 'null' => TRUE)]);
          $this->dbforge->add_key('id', TRUE);
          $this->dbforge->create_table('payout');
          
        }

        public function down()
        {
                $this->dbforge->drop_table('payout');
        }

}