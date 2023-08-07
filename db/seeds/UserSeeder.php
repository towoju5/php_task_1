<?php


use Phinx\Seed\AbstractSeed;
/*Powered By: Manaknightdigital Inc. https://manaknightdigital.com/ Year: 2021*/
/**
 * user Seeder
 *
 * @copyright 2019 Manaknightdigital Inc.
 * @link https://manaknightdigital.com
 * @license Proprietary Software licensing
 * @author Ryan Wong
 */
class userSeeder extends AbstractSeed
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
        $model = $this->table('user');
        $model->truncate();
        $model->insert($data)->save();
    }
}
