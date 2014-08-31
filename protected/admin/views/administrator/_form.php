

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-form',
	'enableAjaxValidation'=>false,
)); ?>
<style type="text/css">
.info th {width:80px;}
</style>
<table class="tb tb2 " style="width:1050px;">
	<tr >
    <td class="td27" ><?php echo $form->labelEx($model,'username'); ?></td>
  </tr>
  <tr>
    <td><?php echo $form->textField($model,'username',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'username'); ?></td>
  </tr>
  
  <tr >
    <td class="td27" ><?php echo $form->labelEx($model,'password'); ?></td>
  </tr>
  <tr>
    <td><?php echo $form->textField($model,'password',array('value'=>'', 'size'=>60,'maxlength'=>128)); ?> <?php if(!$model->isNewRecord) echo '若不修改密码请留空'; ?>
		<?php echo $form->error($model,'password'); ?></td>
  </tr>
  
  <tr >
    <td class="td27" ><?php echo $form->labelEx($model,'email'); ?></td>
  </tr>
  <tr>
    <td><?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'email'); ?></td>
  </tr>

	<tr>
    <td><button class="btn" type="submit" name="button" id="button">完成提交</button></td>
  </tr>
</table>

<?php $this->endWidget(); ?>

</div><!-- form -->