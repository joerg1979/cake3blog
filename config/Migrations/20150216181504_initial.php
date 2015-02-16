<?php

use Phinx\Migration\AbstractMigration;

class Initial extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     *
     */
    
    public function change(){
        $articles =     $this->table('articles');
        $articles->addColumn('title', 'string',         ['limit' => 50])
                ->addColumn('body', 'text',             [                   'null' => TRUE, 'default' => NULL])
                ->addColumn('category_id', 'integer',   [                   'null' => TRUE, 'default' => NULL])
                ->addColumn('created', 'datetime')
                ->addColumn('modified', 'datetime',     [                   'null' => TRUE, 'default' => NULL])
                ->save();
    
        $categories =   $this->table('categories');
        $categories->addColumn('parent_id', 'integer',  [                   'null' => TRUE, 'default' => NULL])
                ->addColumn('lft',	 		'integer',  [                   'null' => TRUE, 'default' => NULL])
                ->addColumn('rght', 		'integer',  [                   'null' => TRUE, 'default' => NULL])
                ->addColumn('name', 		'string',   ['limit' => 255])
                ->addColumn('description', 	'string',   ['limit' => 255,    'null' => TRUE, 'default' => NULL])
                ->addColumn('created', 		'datetime')
                ->addColumn('modified',		'datetime', [                   'null' => TRUE, 'default' => NULL])
                ->save();
    }
    
    /**
     * Migrate Up.
     */
    public function up()
    {
    
    }

    /**
     * Migrate Down.
     */
    public function down()
    {

    }
}