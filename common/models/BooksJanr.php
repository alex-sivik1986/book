<?php

namespace common\models;

use common\models\Janr;
use Yii;

/**
 * This is the model class for table "books_janr".
 *
 * @property int $books_id
 * @property int $janr_id
 *
 * @property Books $books
 * @property Janr $janr
 */
class BooksJanr extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'books_janr';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['books_id', 'janr_id'], 'required'],
            [['books_id', 'janr_id'], 'integer'],
            [['books_id', 'janr_id'], 'unique', 'targetAttribute' => ['books_id', 'janr_id']],
            [['books_id'], 'exist', 'skipOnError' => true, 'targetClass' => Books::class, 'targetAttribute' => ['books_id' => 'id']],
            [['janr_id'], 'exist', 'skipOnError' => true, 'targetClass' => Janr::class, 'targetAttribute' => ['janr_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'books_id' => 'Books ID',
            'janr_id' => 'Janr ID',
        ];
    }

    /**
     * Gets query for [[Books]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBooks()
    {
        return $this->hasOne(Books::class, ['id' => 'books_id']);
    }

    /**
     * Gets query for [[Janr]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getJanr()
    {
        return $this->hasOne(Janr::class, ['id' => 'janr_id']);
    }
}
