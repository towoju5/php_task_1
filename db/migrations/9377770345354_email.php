<?php
use Phinx\Migration\AbstractMigration;
/*Powered By: Manaknightdigital Inc. https://manaknightdigital.com/ Year: 2021*/
/**
 * email Migration
 *
 * @copyright 2019 Manaknightdigital Inc.
 * @link https://manaknightdigital.com
 * @license Proprietary Software licensing
 * @author Ryan Wong
 */
class email extends AbstractMigration
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
        $exists = $this->hasTable('email');
        if (!$exists)
        {
            $table = $this->table('email');
            $table->addColumn('slug','string',["limit" => 50])
		->addColumn('email_header','text')
		->addColumn('email_footer','text')
		->addColumn('subject','text')
		->addColumn('tag','text')
		->addColumn('html','text')
		->addColumn('created_at','date')
		->addColumn('updated_at','datetime')
		->addIndex(["slug"], ['unique' => true])
		->create();
        }
    }

    public function down()
    {
        $this->table('email')->drop()->save();
    }
}
