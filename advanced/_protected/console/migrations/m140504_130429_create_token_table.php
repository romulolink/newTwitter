<?php

use yii\db\Schema;
use yii\db\Migration;
 
/**
 * @author Dmitry Erofeev <dmeroff@gmail.com>
 */
class m140504_130429_create_token_table extends Migration
{
    public function up()
    {
    	
    	$tableOptions = null;
    	
    	if ($this->db->driverName === 'mysql')
    	{
    		$tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
    	}
    	
        $this->createTable('{{%token}}', [
            'user_id'    => Schema::TYPE_INTEGER . ' NOT NULL',
            'code'       => Schema::TYPE_STRING . '(32) NOT NULL',
            'created_at' => Schema::TYPE_INTEGER . ' NOT NULL',
            'type'       => Schema::TYPE_SMALLINT . ' NOT NULL'
        ], $tableOptions);
 
        $this->createIndex('token_unique', '{{%token}}', ['user_id', 'code', 'type'], true);
        $this->addForeignKey('fk_user_token', '{{%token}}', 'user_id', '{{%user}}', 'id', 'CASCADE', 'RESTRICT');
    }
 
    public function down()
    {
        $this->dropTable('{{%token}}');
    }
}