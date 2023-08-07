<?php defined('BASEPATH') OR exit('No direct script access allowed');
/*Powered By: Manaknightdigital Inc. https://manaknightdigital.com/ Year: 2021*/
/**
 * userCard Migration
 *
 * @copyright 2019 Manaknightdigital Inc.
 * @link https://manaknightdigital.com
 * @license Proprietary Software licensing
 * @author Ryan Wong
 */
class Migration_user_card extends CI_Migration {

        public function up()
        {
          $this->dbforge->add_field([  'id' => array('type' => 'INT','constraint' => 11,'unsigned' => TRUE,'auto_increment' => TRUE),
'is_default' => array('type' => 'INT', 'constraint' => 11, 'null' => TRUE),
'user_id' => array('type' => 'INT', 'constraint' => 11, 'null' => TRUE),
'stripe_card_id' => array('type' => 'TEXT', 'null' => TRUE),
'last4' => array('type' => 'VARCHAR', 'constraint' => '255'),
'brand' => array('type' => 'VARCHAR', 'constraint' => '255'),
'exp_month' => array('type' => 'VARCHAR', 'constraint' => '255'),
'exp_year' => array('type' => 'VARCHAR', 'constraint' => '255'),
'created_at' => array('type' => 'DATE', 'null' => TRUE),
'updated_at' => array('type' => 'DATETIME', 'null' => TRUE)]);
          $this->dbforge->add_key('id', TRUE);
          $this->dbforge->create_table('user_card');
          
        }

        public function down()
        {
                $this->dbforge->drop_table('user_card');
        }

}