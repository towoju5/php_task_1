<?php defined('BASEPATH') OR exit('No direct script access allowed');
/*Powered By: Manaknightdigital Inc. https://manaknightdigital.com/ Year: 2021*/
/**
 * cookies Migration
 *
 * @copyright 2019 Manaknightdigital Inc.
 * @link https://manaknightdigital.com
 * @license Proprietary Software licensing
 * @author Ryan Wong
 */
class Migration_cookies extends CI_Migration {

        public function up()
        {
          $this->dbforge->add_field([  'id' => array('type' => 'INT','constraint' => 11,'unsigned' => TRUE,'auto_increment' => TRUE),
'user_id' => array('type' => 'INT', 'constraint' => 11, 'null' => TRUE),
'name' => array('type' => 'VARCHAR', 'constraint' => '255'),
'value' => array('type' => 'VARCHAR', 'constraint' => '255'),
'expire' => array('type' => 'VARCHAR', 'constraint' => '255'),
'domain' => array('type' => 'VARCHAR', 'constraint' => '255'),
'created_at' => array('type' => 'DATE', 'null' => TRUE),
'updated_at' => array('type' => 'DATETIME', 'null' => TRUE)]);
          $this->dbforge->add_key('id', TRUE);
          $this->dbforge->create_table('cookies');
          
        }

        public function down()
        {
                $this->dbforge->drop_table('cookies');
        }

}