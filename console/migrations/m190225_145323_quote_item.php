<?php

use yii\db\Migration;

/**
 * Class m190225_145323_quote_item
 */
class m190225_145323_quote_item extends Migration
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
        echo "m190225_145323_quote_item cannot be reverted.\n";

        return false;
    }

    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%quote_item}}', [
            'id' => $this->primaryKey(),
            'product_id' => $this->integer(11)->notNull()->comment('Mã Sản Phẩm'),
            'parent_item_id' => $this->integer(11)->null()->comment('Mã Sản Phẩm Cha'),
            'qty' => $this->decimal(12,4)->notNull()->defaultValue(1)->comment('Số Lượng'),
            'price' => $this->decimal(12,4)->null()->comment('Đơn Giá'),
            'discount_percent' => $this->decimal(12,4)->null()->comment('Phần Trăm Giảm Giá'),
            'discount_amount' => $this->decimal(12,4)->null()->comment('Số Tiền Giảm Giá'),
            'total' => $this->decimal(12,4)->null()->comment('Tổng Tiền'),
            'quote_id'=>$this->integer(11)->null()->comment('Mã Báo Giá'),
            'status' => $this->smallInteger()->null()->defaultValue(1)->comment('Trạng Thái'),
            'created_at' => $this->integer()->null()->comment('Ngày tạo'),
            'updated_at' => $this->integer()->null()->comment('Ngày sửa'),
        ], $tableOptions);
        $this->createIndex(
            'IDX_QUOTE_ITEM',
            'quote_item',
            'quote_id,parent_item_id,product_id'
        );
        $this->addForeignKey('QUOTE_ITEM_QUOTE_ID_QUOTE_ID',
            'quote_item',
            'quote_id',
            'quote',
            'id',
            'CASCADE');
        $this->addForeignKey('QUOTE_ITEM_PARENT_ITEM_ID_QUOTE_ITEM_ITEM_ID',
            'quote_item',
            'parent_item_id',
            'quote_item',
            'id',
            'CASCADE');
        $this->addForeignKey('QUOTE_ITEM_PRODUCT_ID_PRODUCT_ID',
            'quote_item',
            'product_id',
            'product',
            'id',
            'CASCADE');
    }

    public function down()
    {
        $this->dropTable('{{%quote_item}}');
    }
}
