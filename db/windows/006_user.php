<?php defined('BASEPATH') OR exit('No direct script access allowed');
/*Powered By: Manaknightdigital Inc. https://manaknightdigital.com/ Year: 2021*/
/**
 * user Migration
 *
 * @copyright 2019 Manaknightdigital Inc.
 * @link https://manaknightdigital.com
 * @license Proprietary Software licensing
 * @author Ryan Wong
 */
class Migration_user extends CI_Migration {

        public function up()
        {
          $this->dbforge->add_field([  'id' => array('type' => 'INT','constraint' => 11,'unsigned' => TRUE,'auto_increment' => TRUE),
'first_name' => array('type' => 'VARCHAR', 'constraint' => '255'),
'last_name' => array('type' => 'VARCHAR', 'constraint' => '255'),
'paypal_email' => array('type' => 'VARCHAR', 'constraint' => '500'),
'phone' => array('type' => 'VARCHAR', 'constraint' => '50'),
'image' => array('type' => 'TEXT', 'null' => TRUE),
'image_id' => array('type' => 'INT', 'constraint' => 11, 'null' => TRUE),
'refer' => array('type' => 'VARCHAR', 'constraint' => '50'),
'profile_id' => array('type' => 'INT', 'constraint' => 11, 'null' => TRUE),
'stripe_id' => array('type' => 'VARCHAR', 'constraint' => '255'),
'created_at' => array('type' => 'DATE', 'null' => TRUE),
'updated_at' => array('type' => 'DATETIME', 'null' => TRUE)]);
          $this->dbforge->add_key('id', TRUE);
          $this->dbforge->create_table('user');
          $this->seed_data();
        }

        public function down()
        {
                $this->dbforge->drop_table('user');
        }
    public function seed_data()
    {
        $data = [
            		[
			'first_name' => 'Admin',
			'last_name' => 'Admin',
			'phone' => '12345678',
			'image' => 'https://i.imgur.com/AzJ7DRw.png',
			'image_id' => 1,
			'refer' => 'admin',
			'profile_id' => 0,
			'stripe_id' => '',
			'created_at' => date('Y-m-j'),
			'updated_at' => date('Y-m-j H:i:s'),
		],
		[
			'first_name' => 'Member',
			'last_name' => 'Member',
			'phone' => '12345678',
			'image' => 'https://i.imgur.com/AzJ7DRw.png',
			'image_id' => 1,
			'refer' => 'member',
			'profile_id' => 0,
			'stripe_id' => '',
			'created_at' => date('Y-m-j'),
			'updated_at' => date('Y-m-j H:i:s'),
		],

        ];

        foreach ($data as $k => $seed )
        {
            foreach ($seed as $key => $value)
            {
                $seed[$key] = '\'' . addslashes($value) . '\'';
            }

            $row = array_values($seed);
            array_unshift($row, (string)($k + 1));
            $sql = 'INSERT INTO user VALUES ' . '(' . implode(',', $row) . ')';
            error_log($sql);
            $this->db->query($sql);
        }
    }

}