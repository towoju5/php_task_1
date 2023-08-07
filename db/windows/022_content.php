<?php defined('BASEPATH') OR exit('No direct script access allowed');
/*Powered By: Manaknightdigital Inc. https://manaknightdigital.com/ Year: 2021*/
/**
 * content Migration
 *
 * @copyright 2019 Manaknightdigital Inc.
 * @link https://manaknightdigital.com
 * @license Proprietary Software licensing
 * @author Ryan Wong
 */
class Migration_content extends CI_Migration {

        public function up()
        {
          $this->dbforge->add_field([  'id' => array('type' => 'INT','constraint' => 11,'unsigned' => TRUE,'auto_increment' => TRUE),
'content_name' => array('type' => 'VARCHAR', 'constraint' => '255'),
'content_type' => array('type' => 'INT', 'constraint' => 11, 'null' => TRUE),
'content' => array('type' => 'TEXT', 'null' => TRUE),
'status' => array('type' => 'INT', 'constraint' => 11, 'null' => TRUE),
'created_at' => array('type' => 'DATE', 'null' => TRUE),
'updated_at' => array('type' => 'DATETIME', 'null' => TRUE)]);
          $this->dbforge->add_key('id', TRUE);
          $this->dbforge->create_table('content');
          $this->seed_data();
        }

        public function down()
        {
                $this->dbforge->drop_table('content');
        }
    public function seed_data()
    {
        $data = [
            		[
			'content_name' => 'home_page_meta_title',
			'content_type' => '1',
			'content' => 'Outline Gurus',
			'status' => 1,
			'created_at' => '2021-08-18',
			'created_at' => date('Y-m-j'),
			'updated_at' => date('Y-m-j H:i:s'),
		],
		[
			'content_name' => 'buy_page_meta_title',
			'content_type' => '1',
			'content' => 'Outline Gurus',
			'status' => 1,
			'created_at' => '2021-08-18',
			'created_at' => date('Y-m-j'),
			'updated_at' => date('Y-m-j H:i:s'),
		],
		[
			'content_name' => 'buy_page_meta_description',
			'content_type' => '1',
			'content' => 'Outline Gurus',
			'status' => 1,
			'created_at' => '2021-08-18',
			'created_at' => date('Y-m-j'),
			'updated_at' => date('Y-m-j H:i:s'),
		],
		[
			'content_name' => 'home_page_meta_description',
			'content_type' => '1',
			'content' => 'Outline Gurus',
			'status' => 1,
			'created_at' => '2021-08-18',
			'created_at' => date('Y-m-j'),
			'updated_at' => date('Y-m-j H:i:s'),
		],
		[
			'content_name' => 'sell_page_meta_title',
			'content_type' => '1',
			'content' => 'Outline Gurus',
			'status' => 1,
			'created_at' => '2021-08-18',
			'created_at' => date('Y-m-j'),
			'updated_at' => date('Y-m-j H:i:s'),
		],
		[
			'content_name' => 'sell_page_meta_description',
			'content_type' => '1',
			'content' => 'Outline Gurus',
			'status' => 1,
			'created_at' => '2021-08-18',
			'created_at' => date('Y-m-j'),
			'updated_at' => date('Y-m-j H:i:s'),
		],
		[
			'content_name' => 'contact_page_meta_title',
			'content_type' => '1',
			'content' => 'Outline Gurus',
			'status' => 1,
			'created_at' => '2021-08-18',
			'created_at' => date('Y-m-j'),
			'updated_at' => date('Y-m-j H:i:s'),
		],
		[
			'content_name' => 'contact_page_meta_description',
			'content_type' => '1',
			'content' => 'Outline Gurus',
			'status' => 1,
			'created_at' => '2021-08-18',
			'created_at' => date('Y-m-j'),
			'updated_at' => date('Y-m-j H:i:s'),
		],
		[
			'content_name' => 'sell_page_main_heading',
			'content_type' => '1',
			'content' => 'Sell Outlines and Lecture Notes',
			'status' => 1,
			'created_at' => '2021-08-18',
			'created_at' => date('Y-m-j'),
			'updated_at' => date('Y-m-j H:i:s'),
		],
		[
			'content_name' => 'terms_conditon',
			'content_type' => '1',
			'content' => 'Terms and Condition',
			'status' => 1,
			'created_at' => '2021-08-18',
			'created_at' => date('Y-m-j'),
			'updated_at' => date('Y-m-j H:i:s'),
		],
		[
			'content_name' => 'privacy_policy',
			'content_type' => '1',
			'content' => 'Privacy Policy',
			'status' => 1,
			'created_at' => '2021-08-18',
			'created_at' => date('Y-m-j'),
			'updated_at' => date('Y-m-j H:i:s'),
		],
		[
			'content_name' => 'sell_page_sub_heading',
			'content_type' => '1',
			'content' => '',
			'status' => 1,
			'created_at' => '2021-08-18',
			'created_at' => date('Y-m-j'),
			'updated_at' => date('Y-m-j H:i:s'),
		],
		[
			'content_name' => 'main_page_sub_heading',
			'content_type' => '1',
			'content' => 'Law School Outlines and Lecture Notes Written by Students for Students',
			'status' => 1,
			'created_at' => '2021-08-18',
			'created_at' => date('Y-m-j'),
			'updated_at' => date('Y-m-j H:i:s'),
		],
		[
			'content_name' => 'main_page_left_heading',
			'content_type' => '1',
			'content' => 'Search by school, professor, course, & year',
			'status' => 1,
			'created_at' => '2021-08-18',
			'created_at' => date('Y-m-j'),
			'updated_at' => date('Y-m-j H:i:s'),
		],
		[
			'content_name' => 'main_page_left_sub_heading',
			'content_type' => '1',
			'content' => '<p>Preview, Word Count, Ratings and reviews</p><p>Satisfaction Guaranteed</p>',
			'status' => 1,
			'created_at' => '2021-08-18',
			'created_at' => date('Y-m-j'),
			'updated_at' => date('Y-m-j H:i:s'),
		],
		[
			'content_name' => 'main_page_right_heading',
			'content_type' => '1',
			'content' => 'Sell Your Outlines & Lecture Notes',
			'status' => 1,
			'created_at' => '2021-08-18',
			'created_at' => date('Y-m-j'),
			'updated_at' => date('Y-m-j H:i:s'),
		],
		[
			'content_name' => 'main_page_right_sub_heading',
			'content_type' => '1',
			'content' => '<p>Make money selling your Outlines and Lecture Notes!</p><p>Get 20% of Sales Forever!</p>',
			'status' => 1,
			'created_at' => '2021-08-18',
			'created_at' => date('Y-m-j'),
			'updated_at' => date('Y-m-j H:i:s'),
		],
		[
			'content_name' => 'main_page_imag1_heading',
			'content_type' => '1',
			'content' => 'About Us',
			'status' => 1,
			'created_at' => '2021-08-18',
			'created_at' => date('Y-m-j'),
			'updated_at' => date('Y-m-j H:i:s'),
		],
		[
			'content_name' => 'main_page_imag1_description',
			'content_type' => '1',
			'content' => 'We aim to be the go-to destination for law school students to get the very best outlines and lecture notes for an affordable price. Our platform gives authors an incentive to create and post the very best outlines while giving buyers the most information possible before making a purchase.',
			'status' => 1,
			'created_at' => '2021-08-18',
			'created_at' => date('Y-m-j'),
			'updated_at' => date('Y-m-j H:i:s'),
		],
		[
			'content_name' => 'main_page_imag2_heading',
			'content_type' => '1',
			'content' => 'Are you an Author?',
			'status' => 1,
			'created_at' => '2021-08-18',
			'created_at' => date('Y-m-j'),
			'updated_at' => date('Y-m-j H:i:s'),
		],
		[
			'content_name' => 'main_page_imag2_description',
			'content_type' => '1',
			'content' => 'We value your work and believe you should have ownership over your content. For uploading your document you are entitled to 20% of all proceeds from the sale of your outline into perpetuity. Meaning forever!!        Additionally, we guarantee your outline and lecture notes will be automatically accepted on to our platform. We are not the gatekeepers to your work, the buying community will be. We will notify authors if any of the work they have submitted have been marked by buyers for violating our terms and conditions. Otherwise buyers can expect immediate acceptance of their documents and 20% of sales as soon as they click submit.',
			'status' => 1,
			'created_at' => '2021-08-18',
			'created_at' => date('Y-m-j'),
			'updated_at' => date('Y-m-j H:i:s'),
		],
		[
			'content_name' => 'main_page_imag3_heading',
			'content_type' => '1',
			'content' => 'Thinking about buying?',
			'status' => 1,
			'created_at' => '2021-08-18',
			'created_at' => date('Y-m-j'),
			'updated_at' => date('Y-m-j H:i:s'),
		],
		[
			'content_name' => 'main_page_imag3_description',
			'content_type' => '1',
			'content' => 'You deserve to know what you are buying before you buy it. Outlines and lecture notes are an essential tool during your semester of studies as well as a tool during exam prep. There's nothing worse than buying an outline without knowing how long it is, what year it was created or if it's and good. Buyers will be able to clearly see the word count and the year it was created prior to purchasing an outline. In addition buyers will be able to see how prior buyers have rated and reviewed the outlines, ensuring you are buying a great outline. If that's not enough, we ensure any buyer who purchases an outline and is not satisfied will be able to download another similar outline for free. Buyers can buy with confidence with ZERO regrets.',
			'status' => 1,
			'created_at' => '2021-08-18',
			'created_at' => date('Y-m-j'),
			'updated_at' => date('Y-m-j H:i:s'),
		],
		[
			'content_name' => 'circle_icon_1_heading',
			'content_type' => '1',
			'content' => 'Made for Your Course & Professor',
			'status' => 1,
			'created_at' => '2021-08-18',
			'created_at' => date('Y-m-j'),
			'updated_at' => date('Y-m-j H:i:s'),
		],
		[
			'content_name' => 'circle_icon_1_sub_heading',
			'content_type' => '1',
			'content' => 'Tailored to your needs for optimal exam preparation',
			'status' => 1,
			'created_at' => '2021-08-18',
			'created_at' => date('Y-m-j'),
			'updated_at' => date('Y-m-j H:i:s'),
		],
		[
			'content_name' => 'circle_icon_2_heading',
			'content_type' => '1',
			'content' => 'Word Count',
			'status' => 1,
			'created_at' => '2021-08-18',
			'created_at' => date('Y-m-j'),
			'updated_at' => date('Y-m-j H:i:s'),
		],
		[
			'content_name' => 'circle_icon_2_sub_heading',
			'content_type' => '1',
			'content' => 'Longer is not always better but it doesn't hurt!',
			'status' => 1,
			'created_at' => '2021-08-18',
			'created_at' => date('Y-m-j'),
			'updated_at' => date('Y-m-j H:i:s'),
		],
		[
			'content_name' => 'circle_icon_3_heading',
			'content_type' => '1',
			'content' => 'Ratings & reviews',
			'status' => 1,
			'created_at' => '2021-08-18',
			'created_at' => date('Y-m-j'),
			'updated_at' => date('Y-m-j H:i:s'),
		],
		[
			'content_name' => 'circle_icon_3_sub_heading',
			'content_type' => '1',
			'content' => 'See prior buyers ratings and reviews',
			'status' => 1,
			'created_at' => '2021-08-18',
			'created_at' => date('Y-m-j'),
			'updated_at' => date('Y-m-j H:i:s'),
		],
		[
			'content_name' => 'circle_icon_4_heading',
			'content_type' => '1',
			'content' => 'Satisfaction Guaranteed',
			'status' => 1,
			'created_at' => '2021-08-18',
			'created_at' => date('Y-m-j'),
			'updated_at' => date('Y-m-j H:i:s'),
		],
		[
			'content_name' => 'circle_icon_4_sub_heading',
			'content_type' => '1',
			'content' => 'Not Satisfied? <br> Let us know within 24 hours and you will be able to download a similar outline for free',
			'status' => 1,
			'created_at' => '2021-08-18',
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
            $sql = 'INSERT INTO content VALUES ' . '(' . implode(',', $row) . ')';
            error_log($sql);
            $this->db->query($sql);
        }
    }

}