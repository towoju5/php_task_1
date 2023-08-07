<?php


use Phinx\Seed\AbstractSeed;
/*Powered By: Manaknightdigital Inc. https://manaknightdigital.com/ Year: 2021*/
/**
 * credential Seeder
 *
 * @copyright 2019 Manaknightdigital Inc.
 * @link https://manaknightdigital.com
 * @license Proprietary Software licensing
 * @author Ryan Wong
 */
class credentialSeeder extends AbstractSeed
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
        $model = $this->table('credential');
        $model->truncate();
        $model->insert($data)->save();
    }
}
