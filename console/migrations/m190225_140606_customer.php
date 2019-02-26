<?php

use yii\db\Migration;

/**
 * Class m190225_140606_customer
 */
class m190225_140606_customer extends Migration
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
        echo "m190225_140606_customer cannot be reverted.\n";

        return false;
    }

    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%customer}}', [
            'id' => $this->primaryKey(),
            'code' => $this->string()->notNull()->unique()->comment('Mã'),
            'name' => $this->string(200)->notNull()->comment('Tên Khách Hàng'),
            'address' => $this->string(255)->null()->comment('Địa Chỉ'),
            'phone' => $this->integer(20)->null()->comment('Số Điện Thoại'),
            'status' => $this->smallInteger()->null()->defaultValue(1)->comment('Trạng Thái'),
            'created_at' => $this->integer()->null()->comment('Ngày tạo'),
            'updated_at' => $this->integer()->null()->comment('Ngày sửa'),
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%customer}}');
    }
}
