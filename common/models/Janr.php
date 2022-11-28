<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "janr".
 *
 * @property int $id
 * @property string|null $name
 * @property int|null $created_at
 * @property int|null $updated_at
 *
 * @property Books[] $books
 * @property BooksJanr[] $booksJanrs
 */
class Janr extends \yii\db\ActiveRecord
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
        ];
    }
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'janr';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['created_at', 'updated_at'], 'integer'],
            [['name'], 'string', 'max' => 32],
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
        return $this->hasMany(Books::class, ['id' => 'books_id'])->viaTable('books_janr', ['janr_id' => 'id']);
    }

    /**
     * Gets query for [[BooksJanrs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBooksJanrs()
    {
        return $this->hasMany(BooksJanr::class, ['janr_id' => 'id']);
    }
}
