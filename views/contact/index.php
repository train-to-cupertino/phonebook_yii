<?php
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use app\models\Contact;
use app\models\Phone;

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
