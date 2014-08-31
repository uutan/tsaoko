
<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
	'htmlOptions' => array('class'=>'pure-form search-pannel'),
)); ?>

<?php echo $form->label($model,'id'); ?>
<?php echo $form->textField($model, 'id', array( 'maxlength' => 10, 'class' => '')); ?>
<?php echo $form->label($model,'name'); ?>
<?php echo $form->textField($model, 'name', array( 'maxlength' => 60, 'class' => '')); ?>
<?php echo $form->label($model,'is_check'); ?>
<?php echo $form->dropdownlist($model, 'is_check', array('0' => '未审核','1'=>'已审核'),array('empty'=>'全部')); ?>


	<?php echo CHtml::submitButton('搜索', array('class'=>'pure-button pure-button-primary')); ?>
		
<?php $this->endWidget(); ?>
