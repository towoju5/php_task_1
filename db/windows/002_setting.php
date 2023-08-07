<?php defined('BASEPATH') OR exit('No direct script access allowed');
/*Powered By: Manaknightdigital Inc. https://manaknightdigital.com/ Year: 2021*/
/**
 * setting Migration
 *
 * @copyright 2019 Manaknightdigital Inc.
 * @link https://manaknightdigital.com
 * @license Proprietary Software licensing
 * @author Ryan Wong
 */
class Migration_setting extends CI_Migration {

        public function up()
        {
          $this->dbforge->add_field([  'id' => array('type' => 'INT','constraint' => 11,'unsigned' => TRUE,'auto_increment' => TRUE),
'key' => array('type' => 'VARCHAR', 'constraint' => '50'),
'type' => array('type' => 'INT', 'constraint' => 11, 'null' => TRUE),
'value' => array('type' => 'TEXT', 'null' => TRUE),
'created_at' => array('type' => 'DATE', 'null' => TRUE),
'updated_at' => array('type' => 'DATETIME', 'null' => TRUE)]);
          $this->dbforge->add_key('id', TRUE);
          $this->dbforge->create_table('setting');
          $this->seed_data();
        }

        public function down()
        {
                $this->dbforge->drop_table('setting');
        }
    public function seed_data()
    {
        $data = [
            		[
			'key' => 'fixed_paper_amount',
			'type' => 0,
			'value' => '50',
			'created_at' => date('Y-m-j'),
			'updated_at' => date('Y-m-j H:i:s'),
		],
		[
			'key' => 'payout_percentage_seller',
			'type' => 0,
			'value' => '20',
			'created_at' => date('Y-m-j'),
			'updated_at' => date('Y-m-j H:i:s'),
		],
		[
			'key' => 'maintenance',
			'type' => 1,
			'value' => '0',
			'created_at' => date('Y-m-j'),
			'updated_at' => date('Y-m-j H:i:s'),
		],
		[
			'key' => 'version',
			'type' => 0,
			'value' => '1.0.0',
			'created_at' => date('Y-m-j'),
			'updated_at' => date('Y-m-j H:i:s'),
		],
		[
			'key' => 'copyright',
			'type' => 0,
			'value' => 'Copyright © 2021 Manaknightdigital Inc. All rights reserved.',
			'created_at' => date('Y-m-j'),
			'updated_at' => date('Y-m-j H:i:s'),
		],
		[
			'key' => 'license_key',
			'type' => 4,
			'value' => '',
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
            $sql = 'INSERT INTO setting VALUES ' . '(' . implode(',', $row) . ')';
            error_log($sql);
            $this->db->query($sql);
        }
    }

}