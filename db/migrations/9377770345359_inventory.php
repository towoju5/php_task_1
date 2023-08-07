<?php
use Phinx\Migration\AbstractMigration;
/*Powered By: Manaknightdigital Inc. https://manaknightdigital.com/ Year: 2021*/
/**
 * inventory Migration
 *
 * @copyright 2019 Manaknightdigital Inc.
 * @link https://manaknightdigital.com
 * @license Proprietary Software licensing
 * @author Ryan Wong
 */
class inventory extends AbstractMigration
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
        $exists = $this->hasTable('inventory');
        if (!$exists)
        {
            $table = $this->table('inventory');
            $table->addColumn('user_id','integer')
		->addColumn('title','string',["limit" => 255])
		->addColumn('school_id','integer')
		->addColumn('professor_id','integer')
		->addColumn('class_id','integer')
		->addColumn('textbook_id','integer')
		->addColumn('word_count','integer')
		->addColumn('year','integer')
		->addColumn('isbn','string',["limit" => 255])
		->addColumn('paypal_email','string',["limit" => 255])
		->addColumn('file','text')
		->addColumn('file_id','integer')
		->addColumn('feature_image','text')
		->addColumn('feature_image2','text')
		->addColumn('feature_image3','text')
		->addColumn('feature_image_id','integer')
		->addColumn('note_type','integer')
		->addColumn('description','text')
		->addColumn('inventory_note','text')
		->addColumn('pin_to_top','integer')
		->addColumn('approve','integer')
		->addColumn('status','integer')
		->addColumn('created_at','date')
		->addColumn('updated_at','datetime')
		->create();
        }
    }

    public function down()
    {
        $this->table('inventory')->drop()->save();
    }
}
