
<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
	'htmlOptions' => array('class'=>'pure-form search-pannel'),
)); ?>

<?php echo $form->label($model,'id'); ?>
<?php echo $form->textField($model, 'id', array('class' => 'text_field')); ?>
<?php echo $form->label($model,'username'); ?>
<?php echo $form->textField($model, 'username', array( 'maxlength' => 128, 'class' => '')); ?>
<?php echo $form->label($model,'level'); ?>
<?php echo $form->dropdownlist($model, 'level', User::levelOptions(), array('empty' => '全部会员')); ?>
<!--
<?php echo $form->label($model,'role'); ?>
<?php echo $form->textField($model, 'role', array( 'maxlength' => 20, 'class' => '')); ?>
<?php echo $form->label($model,'email'); ?>
<?php echo $form->textField($model, 'email', array( 'maxlength' => 128, 'class' => '')); ?>
<?php echo $form->label($model,'mobile'); ?>
<?php echo $form->textField($model, 'mobile', array( 'maxlength' => 11, 'class' => '')); ?>
<?php echo $form->label($model,'phone'); ?>
<?php echo $form->textField($model, 'phone', array( 'maxlength' => 20, 'class' => '')); ?>
<?php echo $form->label($model,'nickname'); ?>
<?php echo $form->textField($model, 'nickname', array( 'maxlength' => 50, 'class' => '')); ?>
<?php echo $form->label($model,'job'); ?>
<?php echo $form->textField($model, 'job', array( 'maxlength' => 50, 'class' => '')); ?>
<?php echo $form->label($model,'created'); ?>
<?php echo $form->textField($model, 'created', array('class' => 'text_field')); ?>
<?php echo $form->label($model,'last_login_time'); ?>
<?php echo $form->textField($model, 'last_login_time', array('class' => 'text_field')); ?>
<?php echo $form->label($model,'this_login_time'); ?>
<?php echo $form->textField($model, 'this_login_time', array('class' => 'text_field')); ?>
<?php echo $form->label($model,'last_login_ip'); ?>
<?php echo $form->textField($model, 'last_login_ip', array( 'maxlength' => 15, 'class' => '')); ?>
<?php echo $form->label($model,'this_login_ip'); ?>
<?php echo $form->textField($model, 'this_login_ip', array( 'maxlength' => 15, 'class' => '')); ?>
<?php echo $form->label($model,'avatar'); ?>
<?php echo $form->textField($model, 'avatar', array( 'maxlength' => 255, 'class' => '')); ?>
<?php echo $form->label($model,'gender'); ?>
<?php echo $form->textField($model, 'gender', array( 'maxlength' => 10, 'class' => '')); ?>
<?php echo $form->label($model,'both'); ?>
<?php echo $form->textField($model, 'both', array('class' => 'text_field')); ?>
<?php echo $form->label($model,'info'); ?>
<?php echo $form->textArea($model, 'info', array('rows' => 6, 'cols' => 50)); ?>
<?php echo $form->label($model,'credit'); ?>
<?php echo $form->textField($model, 'credit', array('class' => 'text_field')); ?>
<?php echo $form->label($model,'money'); ?>
<?php echo $form->textField($model, 'money', array( 'maxlength' => 10, 'class' => '')); ?>
<?php echo $form->label($model,'active'); ?>
<?php echo $form->textField($model, 'active', array('class' => 'text_field')); ?>
-->


	<?php echo CHtml::submitButton('搜索', array('class'=>'pure-button pure-button-primary')); ?>
		
<?php $this->endWidget(); ?>
