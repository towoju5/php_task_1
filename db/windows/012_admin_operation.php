<?php defined('BASEPATH') OR exit('No direct script access allowed');
/*Powered By: Manaknightdigital Inc. https://manaknightdigital.com/ Year: 2021*/
/**
 * adminOperation Migration
 *
 * @copyright 2019 Manaknightdigital Inc.
 * @link https://manaknightdigital.com
 * @license Proprietary Software licensing
 * @author Ryan Wong
 */
class Migration_admin_operation extends CI_Migration {

        public function up()
        {
          $this->dbforge->add_field([  'id' => array('type' => 'INT','constraint' => 11,'unsigned' => TRUE,'auto_increment' => TRUE),
'user_id' => array('type' => 'INT', 'constraint' => 11, 'null' => TRUE),
'action' => array('type' => 'VARCHAR', 'constraint' => '50'),
'detail' => array('type' => 'TEXT', 'null' => TRUE),
'last_ip' => array('type' => 'VARCHAR', 'constraint' => '25'),
'user_agent' => array('type' => 'VARCHAR', 'constraint' => '100'),
'created_at' => array('type' => 'DATE', 'null' => TRUE),
'updated_at' => array('type' => 'DATETIME', 'null' => TRUE)]);
          $this->dbforge->add_key('id', TRUE);
          $this->dbforge->create_table('admin_operation');
          
        }

        public function down()
        {
                $this->dbforge->drop_table('admin_operation');
        }

}