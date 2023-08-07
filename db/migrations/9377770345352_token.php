<?php
use Phinx\Migration\AbstractMigration;
/*Powered By: Manaknightdigital Inc. https://manaknightdigital.com/ Year: 2021*/
/**
 * token Migration
 *
 * @copyright 2019 Manaknightdigital Inc.
 * @link https://manaknightdigital.com
 * @license Proprietary Software licensing
 * @author Ryan Wong
 */
class token extends AbstractMigration
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
        $exists = $this->hasTable('token');
        if (!$exists)
        {
            $table = $this->table('token');
            $table->addColumn('token','text')
		->addColumn('data','text')
		->addColumn('type','integer')
		->addColumn('user_id','integer')
		->addColumn('ttl','integer')
		->addColumn('issue_at','datetime', ['null' => true])
		->addColumn('expire_at','datetime', ['null' => true])
		->addColumn('status','integer')
		->create();
        }
    }

    public function down()
    {
        $this->table('token')->drop()->save();
    }
}
