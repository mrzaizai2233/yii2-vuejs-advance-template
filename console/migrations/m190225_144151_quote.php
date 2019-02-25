<?php

use yii\db\Migration;

/**
 * Class m190225_144151_order
 */
class m190225_144151_quote extends Migration
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
        echo "m190225_144151_order cannot be reverted.\n";

        return false;
    }

    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%quote}}', [
            'id' => $this->primaryKey(),
            'total' => $this->decimal(12,4)->null()->comment('Tổng Tiền'),
            'customer_id'=>$this->integer(11)->null()->comment('Khách'),
            'status' => $this->smallInteger()->notNull()->defaultValue(1)->comment('Trạng Thái'),
            'created_at' => $this->integer()->notNull()->comment('Ngày tạo'),
            'updated_at' => $this->integer()->notNull()->comment('Ngày sửa'),
        ], $tableOptions);
        $this->addForeignKey('QUOTE_CUSTOMER_ID_CUSTOMER_ID',
            'quote',
            'customer_id',
            'customer',
            'id',
            'CASCADE');
    }

    public function down()
    {
        $this->dropTable('{{%quote}}');
    }
}
