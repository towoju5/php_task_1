<?php defined('BASEPATH') OR exit('No direct script access allowed');
/*Powered By: Manaknightdigital Inc. https://manaknightdigital.com/ Year: 2021*/
/**
 * email Migration
 *
 * @copyright 2019 Manaknightdigital Inc.
 * @link https://manaknightdigital.com
 * @license Proprietary Software licensing
 * @author Ryan Wong
 */
class Migration_email extends CI_Migration {

        public function up()
        {
          $this->dbforge->add_field([  'id' => array('type' => 'INT','constraint' => 11,'unsigned' => TRUE,'auto_increment' => TRUE),
'slug' => array('type' => 'VARCHAR', 'constraint' => '50'),
'email_header' => array('type' => 'TEXT', 'null' => TRUE),
'email_footer' => array('type' => 'TEXT', 'null' => TRUE),
'subject' => array('type' => 'TEXT', 'null' => TRUE),
'tag' => array('type' => 'TEXT', 'null' => TRUE),
'html' => array('type' => 'TEXT', 'null' => TRUE),
'created_at' => array('type' => 'DATE', 'null' => TRUE),
'updated_at' => array('type' => 'DATETIME', 'null' => TRUE)]);
          $this->dbforge->add_key('id', TRUE);
          $this->dbforge->create_table('email');
          $this->seed_data();
        }

        public function down()
        {
                $this->dbforge->drop_table('email');
        }
    public function seed_data()
    {
        $data = [
            		[
			'slug' => 'reset-password',
			'subject' => 'Reset your password',
			'tag' => 'email,reset_token,link',
			'html' => 'Hi {{{email}}},<br/>You have requested to reset your password. Please click the link below to reset it.<br/><a href="{{{link}}}/{{{reset_token}}}">Link</a>. <br/>Thanks,<br/> Admin',
			'created_at' => date('Y-m-j'),
			'updated_at' => date('Y-m-j H:i:s'),
		],
		[
			'slug' => 'register',
			'subject' => 'Register',
			'tag' => 'email',
			'html' => 'Hi {{{email}}},<br/>Thanks for registering on our platform. <br/>Thanks,<br/> Admin',
			'created_at' => date('Y-m-j'),
			'updated_at' => date('Y-m-j H:i:s'),
		],
		[
			'slug' => 'confirm-password',
			'subject' => 'Confirm your account',
			'tag' => 'email,confirm_token,link',
			'html' => 'Hi {{{email}}},<br/>Please click the link below to confirm your account.<br/><a href="{{{link}}}/{{{confirm_token}}}">Link</a>Thanks,<br/> Admin',
			'created_at' => date('Y-m-j'),
			'updated_at' => date('Y-m-j H:i:s'),
		],
		[
			'slug' => 'verify',
			'subject' => 'verify your account',
			'tag' => 'code',
			'html' => 'Your verification # is {{{code}}}',
			'created_at' => date('Y-m-j'),
			'updated_at' => date('Y-m-j H:i:s'),
		],
		[
			'slug' => 'contact',
			'subject' => 'contact form message',
			'tag' => 'name,email,message',
			'html' => 'Sent by {{{name}}} {{{email}}}<br>  {{{message}}}',
			'created_at' => date('Y-m-j'),
			'updated_at' => date('Y-m-j H:i:s'),
		],
		[
			'slug' => 'give_review',
			'subject' => 'Leave a Review',
			'tag' => 'email,link',
			'html' => 'Hi {{{email}}}, <br> Thankyou from purchasing from OutlineGurus. Please Leave a review for the document or have any complaint tell us. {{{link}}}',
			'created_at' => date('Y-m-j'),
			'updated_at' => date('Y-m-j H:i:s'),
		],
		[
			'slug' => 'dispute_added',
			'subject' => 'A Dispute is Added',
			'tag' => 'email,order_id',
			'html' => 'Hi Admin OutlineGurus,<br> User {{{email}}} has opened a dispute for Order# {{{order_id}}}  ',
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
            $sql = 'INSERT INTO email VALUES ' . '(' . implode(',', $row) . ')';
            error_log($sql);
            $this->db->query($sql);
        }
    }

}