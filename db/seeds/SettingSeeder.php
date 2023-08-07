<?php


use Phinx\Seed\AbstractSeed;
/*Powered By: Manaknightdigital Inc. https://manaknightdigital.com/ Year: 2021*/
/**
 * setting Seeder
 *
 * @copyright 2019 Manaknightdigital Inc.
 * @link https://manaknightdigital.com
 * @license Proprietary Software licensing
 * @author Ryan Wong
 */
class settingSeeder extends AbstractSeed
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
        $model = $this->table('setting');
        $model->truncate();
        $model->insert($data)->save();
    }
}
