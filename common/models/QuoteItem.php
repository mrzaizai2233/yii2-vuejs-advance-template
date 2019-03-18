<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%quote_item}}".
 *
 * @property int $id
 * @property int $product_id Mã Sản Phẩm
 * @property int $parent_item_id Mã Sản Phẩm Cha
 * @property string $qty Số Lượng
 * @property string $price Đơn Giá
 * @property string $discount_percent Phần Trăm Giảm Giá
 * @property string $discount_amount Số Tiền Giảm Giá
 * @property string $total Tổng Tiền
 * @property int $quote_id Mã Báo Giá
 * @property int $status Trạng Thái
 * @property int $created_at Ngày tạo
 * @property int $updated_at Ngày sửa
 *
 * @property QuoteItem $parentItem
 * @property QuoteItem[] $quoteItems
 * @property Product $product
 * @property Quote $quote
 */
class QuoteItem extends \yii\db\ActiveRecord
{

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%quote_item}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['product_id'], 'required'],
            [['product_id', 'parent_item_id', 'quote_id', 'status'], 'integer'],
            [['qty', 'price', 'discount_percent', 'discount_amount', 'total'], 'number'],
            [[ 'created_at', 'updated_at'], 'safe'],
            [['parent_item_id'], 'exist', 'skipOnError' => true, 'targetClass' => QuoteItem::className(), 'targetAttribute' => ['parent_item_id' => 'id']],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['product_id' => 'id']],
            [['quote_id'], 'exist', 'skipOnError' => true, 'targetClass' => Quote::className(), 'targetAttribute' => ['quote_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'product_id' => Yii::t('app', 'Mã Sản Phẩm'),
            'parent_item_id' => Yii::t('app', 'Mã Sản Phẩm Cha'),
            'qty' => Yii::t('app', 'Số Lượng'),
            'price' => Yii::t('app', 'Đơn Giá'),
            'discount_percent' => Yii::t('app', 'Phần Trăm Giảm Giá'),
            'discount_amount' => Yii::t('app', 'Số Tiền Giảm Giá'),
            'total' => Yii::t('app', 'Tổng Tiền'),
            'quote_id' => Yii::t('app', 'Mã Báo Giá'),
            'status' => Yii::t('app', 'Trạng Thái'),
            'created_at' => Yii::t('app', 'Ngày tạo'),
            'updated_at' => Yii::t('app', 'Ngày sửa'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParentItem()
    {
        return $this->hasOne(QuoteItem::className(), ['id' => 'parent_item_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQuoteItems()
    {
        return $this->hasMany(QuoteItem::className(), ['parent_item_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQuote()
    {
        return $this->hasOne(Quote::className(), ['id' => 'quote_id']);
    }
}
