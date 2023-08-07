<?php
use Phinx\Migration\AbstractMigration;
/*Powered By: Manaknightdigital Inc. https://manaknightdigital.com/ Year: 2021*/
/**
 * transaction Migration
 *
 * @copyright 2019 Manaknightdigital Inc.
 * @link https://manaknightdigital.com
 * @license Proprietary Software licensing
 * @author Ryan Wong
 */
class transaction extends AbstractMigration
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
        $exists = $this->hasTable('transaction');
        if (!$exists)
        {
            $table = $this->table('transaction');
            $table->addColumn('order_id','integer')
		->addColumn('user_id','integer')
		->addColumn('transaction_date','date', ['null' => true])
		->addColumn('transaction_time','string',["limit" => 255])
		->addColumn('subtotal','string',["limit" => 255])
		->addColumn('tax','string',["limit" => 255])
		->addColumn('discount','string',["limit" => 255])
		->addColumn('total','string',["limit" => 255])
		->addColumn('stripe_charge_id','string',["limit" => 255])
		->addColumn('payment_method','integer')
		->addColumn('status','integer')
		->addColumn('created_at','date')
		->addColumn('updated_at','datetime')
		->create();
        }
    }

    public function down()
    {
        $this->table('transaction')->drop()->save();
    }
}
