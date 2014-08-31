
<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
	'htmlOptions' => array('class'=>'pure-form search-pannel'),
)); ?>

<?php echo $form->label($model,'id'); ?>
<?php echo $form->textField($model, 'id', array('class' => 'text_field')); ?>
<?php echo $form->label($model,'name'); ?>
<?php echo $form->textField($model, 'name', array( 'maxlength' => 200, 'class' => '')); ?>


	<?php echo CHtml::submitButton('搜索', array('class'=>'pure-button pure-button-primary')); ?>
		
<?php $this->endWidget(); ?>
