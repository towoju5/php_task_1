<?php


use Phinx\Seed\AbstractSeed;
/*Powered By: Manaknightdigital Inc. https://manaknightdigital.com/ Year: 2021*/
/**
 * professor Seeder
 *
 * @copyright 2019 Manaknightdigital Inc.
 * @link https://manaknightdigital.com
 * @license Proprietary Software licensing
 * @author Ryan Wong
 */
class professorSeeder extends AbstractSeed
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
			'name' => 'Toni Kroos',
			'status' => 1,
			'created_at' => date('Y-m-j'),
			'updated_at' => date('Y-m-j H:i:s'),
		],
		[
			'name' => 'Carlos Casemiro',
			'status' => 1,
			'created_at' => date('Y-m-j'),
			'updated_at' => date('Y-m-j H:i:s'),
		],
		[
			'name' => 'Luka Modric',
			'status' => 1,
			'created_at' => date('Y-m-j'),
			'updated_at' => date('Y-m-j H:i:s'),
		],

        ];
        $model = $this->table('professor');
        $model->truncate();
        $model->insert($data)->save();
    }
}
