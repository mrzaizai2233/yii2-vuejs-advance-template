<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%customer}}".
 *
 * @property int $id
 * @property string $code Mã
 * @property string $name Tên Khách Hàng
 * @property string $address Địa Chỉ
 * @property int $phone Số Điện Thoại
 * @property int $status Trạng Thái
 * @property int $created_at Ngày tạo
 * @property int $updated_at Ngày sửa
 *
 * @property Quote[] $quotes
 */
class Customer extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%customer}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['code', 'name', 'created_at', 'updated_at'], 'required'],
            [['phone', 'status', 'created_at', 'updated_at'], 'integer'],
            [['code', 'address'], 'string', 'max' => 255],
            [['name'], 'string', 'max' => 200],
            [['code'], 'unique'],
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
            'name' => Yii::t('app', 'Tên Khách Hàng'),
            'address' => Yii::t('app', 'Địa Chỉ'),
            'phone' => Yii::t('app', 'Số Điện Thoại'),
            'status' => Yii::t('app', 'Trạng Thái'),
            'created_at' => Yii::t('app', 'Ngày tạo'),
            'updated_at' => Yii::t('app', 'Ngày sửa'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQuotes()
    {
        return $this->hasMany(Quote::className(), ['customer_id' => 'id']);
    }
}
