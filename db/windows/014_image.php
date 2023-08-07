<?php defined('BASEPATH') OR exit('No direct script access allowed');
/*Powered By: Manaknightdigital Inc. https://manaknightdigital.com/ Year: 2021*/
/**
 * image Migration
 *
 * @copyright 2019 Manaknightdigital Inc.
 * @link https://manaknightdigital.com
 * @license Proprietary Software licensing
 * @author Ryan Wong
 */
class Migration_image extends CI_Migration {

        public function up()
        {
          $this->dbforge->add_field([  'id' => array('type' => 'INT','constraint' => 11,'unsigned' => TRUE,'auto_increment' => TRUE),
'url' => array('type' => 'TEXT', 'null' => TRUE),
'caption' => array('type' => 'TEXT', 'null' => TRUE),
'user_id' => array('type' => 'INT', 'constraint' => 11, 'null' => TRUE),
'width' => array('type' => 'INT', 'constraint' => 11, 'null' => TRUE),
'height' => array('type' => 'INT', 'constraint' => 11, 'null' => TRUE),
'type' => array('type' => 'INT', 'constraint' => 11, 'null' => TRUE),
'created_at' => array('type' => 'DATE', 'null' => TRUE),
'updated_at' => array('type' => 'DATETIME', 'null' => TRUE)]);
          $this->dbforge->add_key('id', TRUE);
          $this->dbforge->create_table('image');
          $this->seed_data();
        }

        public function down()
        {
                $this->dbforge->drop_table('image');
        }
    public function seed_data()
    {
        $data = [
            		[
			'url' => 'https://i.imgur.com/AzJ7DRw.png',
			'caption' => '',
			'user_id' => 1,
			'width' => 581,
			'height' => 581,
			'type' => 1,
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
            $sql = 'INSERT INTO image VALUES ' . '(' . implode(',', $row) . ')';
            error_log($sql);
            $this->db->query($sql);
        }
    }

}