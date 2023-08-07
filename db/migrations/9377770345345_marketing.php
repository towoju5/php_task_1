<?php
use Phinx\Migration\AbstractMigration;
/*Powered By: Manaknightdigital Inc. https://manaknightdigital.com/ Year: 2021*/
/**
 * marketing Migration
 *
 * @copyright 2019 Manaknightdigital Inc.
 * @link https://manaknightdigital.com
 * @license Proprietary Software licensing
 * @author Ryan Wong
 */
class marketing extends AbstractMigration
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
        $exists = $this->hasTable('marketing');
        if (!$exists)
        {
            $table = $this->table('marketing');
            $table->addColumn('user_id','integer')
		->addColumn('password_protect','string',["limit" => 255])
		->addColumn('content_template_path','text')
		->addColumn('header_template_path','text')
		->addColumn('footer_template_path','text')
		->addColumn('title','text')
		->addColumn('seo_title','text')
		->addColumn('seo_description','text')
		->addColumn('content','text')
		->addColumn('status','integer')
		->addColumn('publish_date','date', ['null' => true])
		->addColumn('slug','text')
		->addColumn('created_at','date')
		->addColumn('updated_at','datetime')
		->addIndex(["slug"], ['unique' => true])
		->create();
        }
    }

    public function down()
    {
        $this->table('marketing')->drop()->save();
    }
}
