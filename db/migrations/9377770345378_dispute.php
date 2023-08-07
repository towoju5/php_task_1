<?php
use Phinx\Migration\AbstractMigration;
/*Powered By: Manaknightdigital Inc. https://manaknightdigital.com/ Year: 2021*/
/**
 * dispute Migration
 *
 * @copyright 2019 Manaknightdigital Inc.
 * @link https://manaknightdigital.com
 * @license Proprietary Software licensing
 * @author Ryan Wong
 */
class dispute extends AbstractMigration
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
        $exists = $this->hasTable('dispute');
        if (!$exists)
        {
            $table = $this->table('dispute');
            $table->addColumn('order_id','integer')
		->addColumn('user_id','integer')
		->addColumn('amount','string',["limit" => 255])
		->addColumn('reason','string',["limit" => 255])
		->addColumn('explanation','text')
		->addColumn('stripe_charge_id','string',["limit" => 255])
		->addColumn('stripe_dispute_id','string',["limit" => 255])
		->addColumn('status','string',["limit" => 255])
		->addColumn('created_at','date')
		->addColumn('updated_at','datetime')
		->create();
        }
    }

    public function down()
    {
        $this->table('dispute')->drop()->save();
    }
}
