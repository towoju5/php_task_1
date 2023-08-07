<?php defined('BASEPATH') OR exit('No direct script access allowed');
/*Powered By: Manaknightdigital Inc. https://manaknightdigital.com/ Year: 2021*/
/**
 * token Migration
 *
 * @copyright 2019 Manaknightdigital Inc.
 * @link https://manaknightdigital.com
 * @license Proprietary Software licensing
 * @author Ryan Wong
 */
class Migration_token extends CI_Migration {

        public function up()
        {
          $this->dbforge->add_field([  'id' => array('type' => 'INT','constraint' => 11,'unsigned' => TRUE,'auto_increment' => TRUE),
'token' => array('type' => 'TEXT', 'null' => TRUE),
'data' => array('type' => 'TEXT', 'null' => TRUE),
'type' => array('type' => 'INT', 'constraint' => 11, 'null' => TRUE),
'user_id' => array('type' => 'INT', 'constraint' => 11, 'null' => TRUE),
'ttl' => array('type' => 'INT', 'constraint' => 11, 'null' => TRUE),
'issue_at' => array('type' => 'DATETIME', 'null' => TRUE),
'expire_at' => array('type' => 'DATETIME', 'null' => TRUE),
'status' => array('type' => 'INT', 'constraint' => 11, 'null' => TRUE)]);
          $this->dbforge->add_key('id', TRUE);
          $this->dbforge->create_table('token');
          
        }

        public function down()
        {
                $this->dbforge->drop_table('token');
        }

}