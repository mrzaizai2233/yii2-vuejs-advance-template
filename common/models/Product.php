<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%product}}".
 *
 * @property int $id
 * @property string $code Mã
 * @property string $name Tên
 * @property double $price Đơn Giá
 * @property double $input_price Giá Nhập
 * @property int $unit_id Đơn Vị Tính
 * @property int $category_id Danh Mục
 * @property int $status Trạng Thái
 * @property int $created_at Ngày tạo
 * @property int $updated_at Ngày sửa
 *
 * @property Category $category
 * @property Unit $unit
 * @property QuoteItem[] $quoteItems
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%product}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['code', 'name', 'price', 'input_price', 'unit_id', 'category_id', 'created_at', 'updated_at'], 'required'],
            [['price', 'input_price'], 'number'],
            [['unit_id', 'category_id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['code'], 'string', 'max' => 255],
            [['name'], 'string', 'max' => 32],
            [['code'], 'unique'],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
            [['unit_id'], 'exist', 'skipOnError' => true, 'targetClass' => Unit::className(), 'targetAttribute' => ['unit_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'code' => Yii::t('app', 'Mã'),
            'name' => Yii::t('app', 'Tên'),
            'price' => Yii::t('app', 'Đơn Giá'),
            'input_price' => Yii::t('app', 'Giá Nhập'),
            'unit_id' => Yii::t('app', 'Đơn Vị Tính'),
            'category_id' => Yii::t('app', 'Danh Mục'),
            'status' => Yii::t('app', 'Trạng Thái'),
            'created_at' => Yii::t('app', 'Ngày tạo'),
            'updated_at' => Yii::t('app', 'Ngày sửa'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUnit()
    {
        return $this->hasOne(Unit::className(), ['id' => 'unit_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQuoteItems()
    {
        return $this->hasMany(QuoteItem::className(), ['product_id' => 'id']);
    }
}
