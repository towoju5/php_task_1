<?php
use Phinx\Migration\AbstractMigration;
/*Powered By: Manaknightdigital Inc. https://manaknightdigital.com/ Year: 2021*/
/**
 * credential Migration
 *
 * @copyright 2019 Manaknightdigital Inc.
 * @link https://manaknightdigital.com
 * @license Proprietary Software licensing
 * @author Ryan Wong
 */
class credential extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     *
     * The following commands can be used in this method and Phinx will
     * automatically reverse them when rolling back:
     *
     *    createTable
     *    renameTable
     *    addColumn
     *    renameColumn
     *    addIndex
     *    addForeignKey
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function up()
    {
        $exists = $this->hasTable('credential');
        if (!$exists)
        {
            $table = $this->table('credential');
            $table->addColumn('email','string',["limit" => 255])
		->addColumn('password','string',["limit" => 255])
		->addColumn('type','string',["limit" => 2])
		->addColumn('verify','integer')
		->addColumn('role_id','integer')
		->addColumn('user_id','integer')
		->addColumn('status','integer')
		->addColumn('created_at','date')
		->addColumn('updated_at','datetime')
		->create();
        }
    }

    public function down()
    {
        $this->table('credential')->drop()->save();
    }
}
