<?php


use Phinx\Seed\AbstractSeed;
/*Powered By: Manaknightdigital Inc. https://manaknightdigital.com/ Year: 2021*/
/**
 * email Seeder
 *
 * @copyright 2019 Manaknightdigital Inc.
 * @link https://manaknightdigital.com
 * @license Proprietary Software licensing
 * @author Ryan Wong
 */
class emailSeeder extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     */
    public function run()
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
        $model = $this->table('email');
        $model->truncate();
        $model->insert($data)->save();
    }
}
