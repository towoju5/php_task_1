<?php
use Phinx\Migration\AbstractMigration;
/*Powered By: Manaknightdigital Inc. https://manaknightdigital.com/ Year: 2021*/
/**
 * setting Migration
 *
 * @copyright 2019 Manaknightdigital Inc.
 * @link https://manaknightdigital.com
 * @license Proprietary Software licensing
 * @author Ryan Wong
 */
class setting extends AbstractMigration
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
        $exists = $this->hasTable('setting');
        if (!$exists)
        {
            $table = $this->table('setting');
            $table->addColumn('key','string',["limit" => 50])
		->addColumn('type','integer')
		->addColumn('value','text')
		->addColumn('created_at','date')
		->addColumn('updated_at','datetime')
		->addIndex(["key"], ['unique' => true])
		->create();
        }
    }

    public function down()
    {
        $this->table('setting')->drop()->save();
    }
}
