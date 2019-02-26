<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%quote}}".
 *
 * @property int $id
 * @property string $total Tổng Tiền
 * @property int $customer_id Khách
 * @property int $status Trạng Thái
 * @property string $note Ghi Chú
 * @property int $created_at Ngày tạo
 * @property int $updated_at Ngày sửa
 *
 * @property Customer $customer
 * @property QuoteItem[] $quoteItems
 */
class Quote extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%quote}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['total'], 'number'],
            [['customer_id', 'status'], 'integer'],
            [['note'], 'string'],
            [['created_at', 'updated_at'], 'required'],
            [['customer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Customer::className(), 'targetAttribute' => ['customer_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'total' => Yii::t('app', 'Tổng Tiền'),
            'customer_id' => Yii::t('app', 'Khách'),
            'status' => Yii::t('app', 'Trạng Thái'),
            'note' => Yii::t('app', 'Ghi Chú'),
            'created_at' => Yii::t('app', 'Ngày tạo'),
            'updated_at' => Yii::t('app', 'Ngày sửa'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomer()
    {
        return $this->hasOne(Customer::className(), ['id' => 'customer_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQuoteItems()
    {
        return $this->hasMany(QuoteItem::className(), ['quote_id' => 'id']);
    }
}
