<?php
use Phinx\Migration\AbstractMigration;
/*Powered By: Manaknightdigital Inc. https://manaknightdigital.com/ Year: 2021*/
/**
 * user Migration
 *
 * @copyright 2019 Manaknightdigital Inc.
 * @link https://manaknightdigital.com
 * @license Proprietary Software licensing
 * @author Ryan Wong
 */
class user extends AbstractMigration
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
        $exists = $this->hasTable('user');
        if (!$exists)
        {
            $table = $this->table('user');
            $table->addColumn('first_name','string',["limit" => 255])
		->addColumn('last_name','string',["limit" => 255])
		->addColumn('paypal_email','string',["limit" => 500])
		->addColumn('phone','string',["limit" => 50])
		->addColumn('image','text')
		->addColumn('image_id','integer')
		->addColumn('refer','string',["limit" => 50])
		->addColumn('profile_id','integer')
		->addColumn('stripe_id','string',["limit" => 255])
		->addColumn('created_at','date')
		->addColumn('updated_at','datetime')
		->create();
        }
    }

    public function down()
    {
        $this->table('user')->drop()->save();
    }
}
