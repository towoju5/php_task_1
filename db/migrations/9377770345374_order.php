<?php
use Phinx\Migration\AbstractMigration;
/*Powered By: Manaknightdigital Inc. https://manaknightdigital.com/ Year: 2021*/
/**
 * order Migration
 *
 * @copyright 2019 Manaknightdigital Inc.
 * @link https://manaknightdigital.com
 * @license Proprietary Software licensing
 * @author Ryan Wong
 */
class order extends AbstractMigration
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
        $exists = $this->hasTable('order');
        if (!$exists)
        {
            $table = $this->table('order');
            $table->addColumn('purchase_user_id','integer')
		->addColumn('sale_user_id','integer')
		->addColumn('inventory_id','integer')
		->addColumn('order_date','date', ['null' => true])
		->addColumn('order_time','string',["limit" => 255])
		->addColumn('subtotal','string',["limit" => 255])
		->addColumn('tax','string',["limit" => 255])
		->addColumn('discount','string',["limit" => 255])
		->addColumn('total','string',["limit" => 255])
		->addColumn('stripe_charge_id','string',["limit" => 255])
		->addColumn('stripe_intent','text')
		->addColumn('status','integer')
		->addColumn('created_at','date')
		->addColumn('updated_at','datetime')
		->create();
        }
    }

    public function down()
    {
        $this->table('order')->drop()->save();
    }
}
