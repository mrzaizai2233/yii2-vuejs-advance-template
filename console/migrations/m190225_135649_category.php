<?php

use yii\db\Migration;

/**
 * Class m190225_135649_category
 */
class m190225_135649_category extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190225_135649_category cannot be reverted.\n";

        return false;
    }

    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%category}}', [
            'id' => $this->primaryKey(),
            'code' => $this->string()->notNull()->unique()->comment('Mã'),
            'name' => $this->string(32)->notNull()->comment('Tên'),
            'parent_id' => $this->string()->null()->comment('Danh Mục Cha'),

            'status' => $this->smallInteger()->notNull()->defaultValue(1)->comment('Trạng Thái'),
            'created_at' => $this->integer()->notNull()->comment('Ngày tạo'),
            'updated_at' => $this->integer()->notNull()->comment('Ngày sửa'),
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%category}}');
    }
}
