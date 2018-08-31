<?php 
namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
//use yii\filters\VerbFilter;
//use app\models\LoginForm;
use app\models\Contact;
use app\models\Phone;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;


class ContactController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'add', 'addphone', 'deletephone', 'delete', 'search', 'ajaxsearchresult'],
                'rules' => [
                    [
                        'actions' => ['index', 'addphone', 'add', 'deletephone', 'delete', 'search', 'ajaxsearchresult'],
                        'allow' => true,
                        //'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }
	
	
    /**
     * Displays phonebook list.
     *
     * @return string
     */
    public function actionIndex()
    {
		$dataProvider = new ActiveDataProvider([

			'query' => Contact::find(),
			
			'pagination' => [
				'pageSize' => 20,
			],
			
			'sort' => [
				'defaultOrder' => [
					'id' => SORT_ASC,
				]
			],
		]);
	
		$this->view->registerJsFile('js/phonebook.js',  ['position' => yii\web\View::POS_END]);
        return $this->render('index', ['dataProvider' => $dataProvider]);
    }	
	

    /**
     * Add contact
     *
     * @return string
     */
    public function actionAdd()
    {
		$request = Yii::$app->request;
		
		if ($request->post('name') && $request->post('phone')) {
			$model = new Contact;
			$model->name = $request->post('name');
			$model->save();
			
			$phone = new Phone;
			$phone->phone = $request->post('phone');
			$phone->contact_id = $model->id;
			$phone->save();
			
			return $this->redirect(['contact/index']);
		}
	
        return $this->render('add');
    }
	
	
    public function actionUpdate($id)
    {
		//echo $id;
		$request = Yii::$app->request;
		$model = Contact::find()->where(['id' => $id])->limit(1)->one();
		if (!$model) {
			throw new NotFoundHttpException('Запрашиваемая страница не найдена!');
		}
		
		if ($request->post('name')) {
			//$model = Contact::find->where(['id' => $id]->limit(1)->one());
			$model->name = $request->post('name');
			$model->save();
			
			return $this->redirect(['contact/index']);
		}
	
        return $this->render('update', ['id' => $id, 'model' => $model]);
    }	
	
	
	public function actionAddphone() {
		$request = Yii::$app->request;
		
		if ($request->post('phone') && $request->post('contact_id')) {
			$phone = new Phone;
			$phone->phone = $request->post('phone');
			$phone->contact_id = $request->post('contact_id');
			$phone->save();
			
			return $this->redirect(['contact/index']);
		}	
	
		return $this->render('add_phone');
	}
	
	public function actionDeletephone($id) {
		if ($id) {
			$model = Phone::find()->where(['id' => $id])->limit(1)->one();
			$model->delete();
		}
		
		return $this->redirect(['contact/index']);
	}
	
	public function actionDelete($id) {
		if ($id) {
			$model = Contact::find()->where(['id' => $id])->limit(1)->one();
			$model->delete();
		}
		
		return $this->redirect(['contact/index']);
	}	
	
	
	public function actionSearch() {
		$this->view->registerJsFile('/js/search.js',  ['position' => yii\web\View::POS_END]);
		return $this->render('search');
	}
	
	
	public function actionAjaxsearchresult() {
		$req = Yii::$app->request;
		$name = $req->post('name');
		$phone = $req->post('phone');
		//$name = '';
		//$phone = '123123123';
		
		if ($name && $phone) {
			$query = Contact::find()->innerJoin('phone', 'contact.id = phone.contact_id')->where(['phone.phone' => $phone, 'contact.name' => $name]);
		} else if (!$name) {
			$query = Contact::find()->innerJoin('phone', 'contact.id = phone.contact_id')->where(['phone.phone' => $phone]);
		} else if (!$phone) {
			$query = Contact::find()->where(['name' => $name]);
		}
	
		$dataProvider = new ActiveDataProvider([

			'query' => $query,
			
			'pagination' => [
				'pageSize' => 20,
			],
			
			'sort' => [
				'defaultOrder' => [
					'id' => SORT_ASC,
				]
			],
		]);
	
	
		echo GridView::widget([
				'dataProvider' => $dataProvider,
				'columns' => [
					['class' => 'yii\grid\SerialColumn'],
					'name:text:Наименование',

					[
						'attribute' => 'add_phone',
						'value' => function($model) {
							return \yii\helpers\Html::a('Доб.тел.',['contact/addphone', 'id' => $model->id]);
						},
						'format'=> 'raw',
					],							
					
					[
						'attribute' => 'phones',
						'value' => function($model) {
							return implode(",<br/>", ArrayHelper::map($model->phones, 'id', 'phone'));
						},
						'format'=> 'raw',
					],					
					
					[
						'class' => 'yii\grid\ActionColumn',
						'template' => '{update} {delete}',
					],
				],
		]);	
	}	
}
