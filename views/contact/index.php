<?php
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use app\models\Contact;
use app\models\Phone;
/*

$contact = Contact::find()->where(['id' => 3])->limit(1)->one();
//var_dump($contact->phones);
$arr_data = implode(",", ArrayHelper::map($contact->phones, 'id', 'phone'));
var_dump($arr_data);
//echo $arr_data;


return;
*/
$this->title = 'Phonebook';
?>
<div class="site-index">
	  <div id="contacts">
		<?php echo GridView::widget([
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
			]); ?>	  
	  </div>
</div>
