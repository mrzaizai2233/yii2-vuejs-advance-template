<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%unit}}".
 *
 * @property int $id
 * @property string $code Mã
 * @property string $name Tên
 * @property int $status Trạng Thái
 * @property int $created_at Ngày tạo
 * @property int $updated_at Ngày sửa
 *
 * @property Product[] $products
 */
class Unit extends \yii\db\ActiveRecord
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
        return '{{%unit}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['code', 'name'], 'required'],
            [['status', 'created_at', 'updated_at'], 'integer'],
            [['code'], 'string', 'max' => 255],
            [['name'], 'string', 'max' => 32],
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
            'name' => Yii::t('app', 'Tên'),
            'status' => Yii::t('app', 'Trạng Thái'),
            'created_at' => Yii::t('app', 'Ngày tạo'),
            'updated_at' => Yii::t('app', 'Ngày sửa'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['unit_id' => 'id']);
    }
}
