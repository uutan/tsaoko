
<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
	'htmlOptions' => array('class'=>'pure-form search-pannel'),
)); ?>

<?php echo $form->label($model,'id'); ?>
<?php echo $form->textField($model, 'id', array( 'maxlength' => 10, 'class' => '')); ?>
<?php echo $form->label($model,'name'); ?>
<?php echo $form->textField($model, 'name', array( 'maxlength' => 60, 'class' => '')); ?>
<!--
<?php echo $form->label($model,'image'); ?>
<?php echo $form->textField($model, 'image', array( 'maxlength' => 255, 'class' => '')); ?>
<?php echo $form->label($model,'desc'); ?>
<?php echo $form->textArea($model, 'desc', array('rows' => 6, 'cols' => 50)); ?>
<?php echo $form->label($model,'url'); ?>
<?php echo $form->textField($model, 'url', array( 'maxlength' => 255, 'class' => '')); ?>
<?php echo $form->label($model,'sort_order'); ?>
<?php echo $form->textField($model, 'sort_order', array('class' => 'text_field')); ?>
<?php echo $form->label($model,'is_show'); ?>
<?php echo $form->textField($model, 'is_show', array('class' => 'text_field')); ?>
-->


	<?php echo CHtml::submitButton('搜索', array('class'=>'pure-button pure-button-primary')); ?>
		
<?php $this->endWidget(); ?>
