<?php

namespace common\models;

use Yii;
use yii\behaviors\AttributeBehavior;
/**
 * This is the model class for table "author".
 *
 * @property int $id
 * @property string $name
 * @property string $surname
 * @property string|null $phone
 * @property int|null $birthday
 * @property int|null $created_at
 * @property int|null $updated_at
 *
 * @property Books[] $books
 */
class Author extends \yii\db\ActiveRecord
{
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    \yii\db\ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    \yii\db\ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
            ],
            'attribute' => [
                'class' => AttributeBehavior::class,
                'attributes' => [
                    \yii\db\ActiveRecord::EVENT_BEFORE_INSERT => 'birthday',
                    \yii\db\ActiveRecord::EVENT_BEFORE_UPDATE => 'birthday',
                ],
                'value' => function ($event) {
                     return date('Y-m-d', strtotime($this->birthday));
                },
            ],
        ];
    }
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'author';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'surname'], 'required'],
            [['created_at', 'updated_at'], 'integer'],
            ['birthday', 'safe'],
            [['name', 'surname', 'phone'], 'string', 'max' => 32],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'surname' => 'Surname',
            'phone' => 'Phone',
            'birthday' => 'Birthday',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Books]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBooks()
    {
        return $this->hasMany(Books::class, ['author_id' => 'id']);
    }
}
