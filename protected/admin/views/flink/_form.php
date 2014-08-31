<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'flink-form',
	'enableAjaxValidation'=>true,
	'htmlOptions'=> array('enctype'=>'multipart/form-data'),
	'clientOptions'=>array('validateOnSubmit'=>true, 'validateOnChange'=>false),
)); ?>

<style type="text/css">
.info th {width:80px;}
</style>
<table class="tb tb2 " style="width:1050px;">

  <tr >
    <td class="td27" ><?php echo $form->labelEx($model,'name'); ?></td>
  </tr>
  <tr>
    <td>
    <?php echo $form->textField($model,'name',array('size'=>30,'maxlength'=>90)); ?>
    <?php echo $form->error($model,'name'); ?>
    </td>
  </tr>
  <tr >
    <td class="td27" ><?php echo $form->labelEx($model,'sortnum'); ?></td>
  </tr>
  <tr>
    <td>
    <?php echo $form->textField($model,'sortnum',array('size'=>10,'maxlength'=>90)); ?> 数字大的靠前显示
    <?php echo $form->error($model,'sortnum'); ?>
    </td>
  </tr>
  
  <tr >
    <td class="td27" ><?php echo $form->labelEx($model,'url'); ?></td>
  </tr>
  <tr>
    <td>
    <?php echo $form->textField($model,'url',array('size'=>60,'maxlength'=>100,'value'=>($model->isNewRecord?'http://':$model->url))); ?>
    <?php echo $form->error($model,'url'); ?>
    </td>
  </tr>
  
  <tr >
    <td class="td27" ><?php echo $form->labelEx($model,'image'); ?></td>
  </tr>
  <tr>
    <td>
    <?php echo $form->fileField($model,'image',array('size'=>30,'maxlength'=>50)); ?> 最佳大小 88*31px <?php echo CHtml::checkBox('delete_image', false); ?> 删除图片
		<?php echo $form->error($model,'image'); ?>
       <br />
		<?php if($model->image): ?><img src="<?php echo Yii::app()->baseUrl . $model->image ?>" /> <?php endif; ?>
    </td>
  </tr>
  
  <tr >
    <td class="td27" ><?php echo $form->labelEx($model,'remote_image'); ?></td>
  </tr>
  <tr>
    <td>
    <?php echo $form->textField($model,'remote_image',array('size'=>60,'maxlength'=>150,'value'=>($model->isNewRecord?'http://':$model->remote_image))); ?>
		<?php echo $form->error($model,'remote_image'); ?>
    </td>
  </tr>
  
  <tr >
    <td class="td27" ><?php echo $form->labelEx($model,'description'); ?></td>
  </tr>
  <tr>
    <td>
    <?php echo $form->textArea($model,'description',array('cols'=>70,'rows'=>6)); ?>
		<?php echo $form->error($model,'remote_image'); ?>
    </td>
  </tr>

  <tr>
    <td>
    <?php echo $form->checkbox($model,'enabled'); ?>
    <?php echo $form->labelEx($model,'enabled'); ?>
		<?php echo $form->error($model,'enabled'); ?>
    </td>
  </tr>
  
	
	<tr>
    <td><button class="btn" type="submit" name="button" id="button">完成提交</button></td>
  </tr>
</table>

<?php $this->endWidget(); ?>

</div><!-- form -->