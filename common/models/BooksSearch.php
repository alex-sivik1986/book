<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Books;

/**
 * BooksSearch represents the model behind the search form of `app\models\Books`.
 */
class BooksSearch extends Books
{
    public $authorBook;
    public $janrsBook;
    public $datetime_start;
    public $datetime_end;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'author_id', 'created_at', 'updated_at'], 'integer'],
            [['name', 'description', 'release' , 'authorBook', 'janrsBook', 'datetime_start', 'datetime_end'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Books::find()->joinWith(['author','janrs'])->distinct();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 16,
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'books.name', $this->name])
            ->andFilterWhere(['like', 'books.description', $this->description])
            ->andFilterWhere(['=', 'janr.id', $this->janrsBook])
            ->andFilterWhere(['like', 'Concat(author.name," ", author.surname)', $this->authorBook]);

        if(\Yii::$app->request->post('BooksSearch')) {
            $this->datetime_start = \Yii::$app->request->post('BooksSearch')['datetime_start'];
            $this->datetime_end = \Yii::$app->request->post('BooksSearch')['datetime_end'];

            $query->andFilterWhere(['>=', 'release', date('Y-m-d', strtotime($this->datetime_start))])
                ->andFilterWhere(['<=', 'release', date('Y-m-d', strtotime($this->datetime_end))]);
        }

       // print_r($query->createCommand()->getRawSql()); die;
        return $dataProvider;
    }
}
