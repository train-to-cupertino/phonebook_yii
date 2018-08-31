<?php
use yii\grid\GridView;

$this->title = 'Phonebook';
?>
<div class="site-index">
	  <div id="contacts">
		<?php echo GridView::widget([
				'dataProvider' => $dataProvider,
				'columns' => [
					['class' => 'yii\grid\SerialColumn'],
					'name',
					'name:ntext',
					['class' => 'yii\grid\ActionColumn'],
				],
			]); ?>	  
	  </div>
</div>
