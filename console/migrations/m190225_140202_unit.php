<?php

use yii\db\Migration;

/**
 * Class m190225_143202_unit
 */
class m190225_140202_unit extends Migration
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
        echo "m190225_143202_unit cannot be reverted.\n";

        return false;
    }

    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%unit}}', [
            'id' => $this->primaryKey(),
            'code' => $this->string()->notNull()->unique()->comment('Mã'),
            'name' => $this->string(32)->notNull()->comment('Tên'),

            'status' => $this->smallInteger()->null()->defaultValue(1)->comment('Trạng Thái'),
            'created_at' => $this->integer()->null()->comment('Ngày tạo'),
            'updated_at' => $this->integer()->null()->comment('Ngày sửa'),
        ], $tableOptions);
        $this->createIndex(
            'IDX_UNIT_CODE',
            'unit',
            'code'
        );

    }

    public function down()
    {
        $this->dropTable('{{%unit}}');
    }
}
