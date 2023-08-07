<?php defined('BASEPATH') OR exit('No direct script access allowed');
/*Powered By: Manaknightdigital Inc. https://manaknightdigital.com/ Year: 2021*/
/**
 * credential Migration
 *
 * @copyright 2019 Manaknightdigital Inc.
 * @link https://manaknightdigital.com
 * @license Proprietary Software licensing
 * @author Ryan Wong
 */
class Migration_credential extends CI_Migration {

        public function up()
        {
          $this->dbforge->add_field([  'id' => array('type' => 'INT','constraint' => 11,'unsigned' => TRUE,'auto_increment' => TRUE),
'email' => array('type' => 'VARCHAR', 'constraint' => '255'),
'password' => array('type' => 'VARCHAR', 'constraint' => '255'),
'type' => array('type' => 'VARCHAR', 'constraint' => '2'),
'verify' => array('type' => 'INT', 'constraint' => 11, 'null' => TRUE),
'role_id' => array('type' => 'INT', 'constraint' => 11, 'null' => TRUE),
'user_id' => array('type' => 'INT', 'constraint' => 11, 'null' => TRUE),
'status' => array('type' => 'INT', 'constraint' => 11, 'null' => TRUE),
'created_at' => array('type' => 'DATE', 'null' => TRUE),
'updated_at' => array('type' => 'DATETIME', 'null' => TRUE)]);
          $this->dbforge->add_key('id', TRUE);
          $this->dbforge->create_table('credential');
          $this->seed_data();
        }

        public function down()
        {
                $this->dbforge->drop_table('credential');
        }
    public function seed_data()
    {
        $data = [
            		[
			'email' => 'admin@manaknight.com',
			'password' => str_replace('$2y$', '$2b$', password_hash('a123456', PASSWORD_BCRYPT)),
			'type' => 'n',
			'verify' => 1,
			'role_id' => 2,
			'user_id' => 1,
			'status' => 1,
			'created_at' => date('Y-m-j'),
			'updated_at' => date('Y-m-j H:i:s'),
		],
		[
			'email' => 'member@manaknight.com',
			'password' => str_replace('$2y$', '$2b$', password_hash('a123456', PASSWORD_BCRYPT)),
			'type' => 'n',
			'verify' => 1,
			'role_id' => 1,
			'user_id' => 2,
			'status' => 1,
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
            $sql = 'INSERT INTO credential VALUES ' . '(' . implode(',', $row) . ')';
            error_log($sql);
            $this->db->query($sql);
        }
    }

}