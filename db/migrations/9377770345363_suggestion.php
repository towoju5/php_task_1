<?php
use Phinx\Migration\AbstractMigration;
/*Powered By: Manaknightdigital Inc. https://manaknightdigital.com/ Year: 2021*/
/**
 * suggestion Migration
 *
 * @copyright 2019 Manaknightdigital Inc.
 * @link https://manaknightdigital.com
 * @license Proprietary Software licensing
 * @author Ryan Wong
 */
class suggestion extends AbstractMigration
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
        $exists = $this->hasTable('suggestion');
        if (!$exists)
        {
            $table = $this->table('suggestion');
            $table->addColumn('seller_id','integer')
		->addColumn('name','string',["limit" => 255])
		->addColumn('email','string',["limit" => 255])
		->addColumn('suggestion_type','integer')
		->addColumn('additional_notes','text')
		->addColumn('status','integer')
		->addColumn('created_at','date')
		->addColumn('updated_at','datetime')
		->create();
        }
    }

    public function down()
    {
        $this->table('suggestion')->drop()->save();
    }
}
