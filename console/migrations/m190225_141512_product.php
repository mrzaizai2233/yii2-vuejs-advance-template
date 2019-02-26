<?php

use yii\db\Migration;

/**
 * Class m190225_141512_product
 */
class m190225_141512_product extends Migration
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
        echo "m190225_141512_product cannot be reverted.\n";

        return false;
    }

    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%product}}', [
            'id' => $this->primaryKey(),
            'code' => $this->string()->notNull()->unique()->comment('Mã'),
            'name' => $this->string(32)->notNull()->comment('Tên'),
            'price' => $this->float()->notNull()->comment('Đơn Giá'),
            'input_price' => $this->float()->notNull()->comment('Giá Nhập'),
            'unit_id' => $this->integer(11)->notNull()->comment('Đơn Vị Tính'),
            'category_id' => $this->integer(11)->notNull()->comment('Danh Mục'),
            'status' => $this->smallInteger()->null()->defaultValue(1)->comment('Trạng Thái'),
            'created_at' => $this->integer()->null()->comment('Ngày tạo'),
            'updated_at' => $this->integer()->null()->comment('Ngày sửa'),
        ], $tableOptions);
        // creates index for column `category_id`
        $this->createIndex(
            'IDX_PRODUCT_CODE',
            'product',
            'code,unit_id,category_id'
        );
        $this->addForeignKey('PRODUCT_UNIT_ID_UNIT_ID',
            'product',
            'unit_id',
            'unit',
            'id',
            'CASCADE');
        $this->addForeignKey('PRODUCT_CATEGORY_ID_CATEGORY_ID',
            'product',
            'category_id',
            'category',
            'id',
            'CASCADE');
    }

    public function down()
    {
        $this->dropTable('{{%product}}');
    }
}
