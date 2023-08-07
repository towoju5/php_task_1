<?php defined('BASEPATH') OR exit('No direct script access allowed');
/*Powered By: Manaknightdigital Inc. https://manaknightdigital.com/ Year: 2021*/
/**
 * transaction Migration
 *
 * @copyright 2019 Manaknightdigital Inc.
 * @link https://manaknightdigital.com
 * @license Proprietary Software licensing
 * @author Ryan Wong
 */
class Migration_transaction extends CI_Migration {

        public function up()
        {
          $this->dbforge->add_field([  'id' => array('type' => 'INT','constraint' => 11,'unsigned' => TRUE,'auto_increment' => TRUE),
'order_id' => array('type' => 'INT', 'constraint' => 11, 'null' => TRUE),
'user_id' => array('type' => 'INT', 'constraint' => 11, 'null' => TRUE),
'transaction_date' => array('type' => 'DATE', 'null' => TRUE),
'transaction_time' => array('type' => 'VARCHAR', 'constraint' => '255'),
'subtotal' => array('type' => 'VARCHAR', 'constraint' => '255'),
'tax' => array('type' => 'VARCHAR', 'constraint' => '255'),
'discount' => array('type' => 'VARCHAR', 'constraint' => '255'),
'total' => array('type' => 'VARCHAR', 'constraint' => '255'),
'stripe_charge_id' => array('type' => 'VARCHAR', 'constraint' => '255'),
'payment_method' => array('type' => 'INT', 'constraint' => 11, 'null' => TRUE),
'status' => array('type' => 'INT', 'constraint' => 11, 'null' => TRUE),
'created_at' => array('type' => 'DATE', 'null' => TRUE),
'updated_at' => array('type' => 'DATETIME', 'null' => TRUE)]);
          $this->dbforge->add_key('id', TRUE);
          $this->dbforge->create_table('transaction');
          
        }

        public function down()
        {
                $this->dbforge->drop_table('transaction');
        }

}