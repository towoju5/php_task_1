<?php


use Phinx\Seed\AbstractSeed;
/*Powered By: Manaknightdigital Inc. https://manaknightdigital.com/ Year: 2021*/
/**
 * school Seeder
 *
 * @copyright 2019 Manaknightdigital Inc.
 * @link https://manaknightdigital.com
 * @license Proprietary Software licensing
 * @author Ryan Wong
 */
class schoolSeeder extends AbstractSeed
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
			'name' => 'Test School',
			'status' => 1,
			'created_at' => date('Y-m-j'),
			'updated_at' => date('Y-m-j H:i:s'),
		],
		[
			'name' => 'ABC School',
			'status' => 1,
			'created_at' => date('Y-m-j'),
			'updated_at' => date('Y-m-j H:i:s'),
		],
		[
			'name' => 'PQR School',
			'status' => 1,
			'created_at' => date('Y-m-j'),
			'updated_at' => date('Y-m-j H:i:s'),
		],

        ];
        $model = $this->table('school');
        $model->truncate();
        $model->insert($data)->save();
    }
}
