<div class="info">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'slideshow-form',
	'enableAjaxValidation'=>true,
    'htmlOptions'=> array('enctype'=>'multipart/form-data'),
)); ?>
<style type="text/css">
.info th {width:80px;}
</style>
<table class="tb tb2 " style="width:1050px;">
	<tr>
         <tr >
    <td class="td27" ><?php echo $form->labelEx($model,'title'); ?></td>
  </tr>
  <tr>
    <td>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>90)); ?>
		<?php echo $form->error($model,'title'); ?>
        </td>
    </tr>
	<tr>
        <tr >
    <td class="td27" ><?php echo $form->labelEx($model,'url'); ?></td>
  </tr>
  <tr>
    <td>
		<?php echo $form->textField($model,'url',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'url'); ?>
        </td>
    </tr>
	<tr>
         <tr >
    <td class="td27" ><?php echo $form->labelEx($model,'image'); ?></td>
  </tr>
  <tr>
    <td>
		<?php echo $form->fileField($model,'image',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'image'); ?>
       <br />
<?php if($model->image): ?><img src="<?php echo Yii::app()->baseUrl . $model->image ?>" height="100"/> <?php endif; ?>
        </td>
    </tr>
	<tr>
        <tr >
    <td class="td27" ><?php echo $form->labelEx($model,'token'); ?></td>
  </tr>
  <tr>
    <td>
        <?php $this->widget('system.web.widgets.CAutoComplete',
              array(
               //'name'=>CHtml::activeName($model, 'name'), 
                 'model'=> $model,
                 'attribute'=>'token',
                         //replace controller/action with real ids
                 'url'=>array('autocomplete'), 
                 'max'=>50, //specifies the max number of items to display
     
                             //specifies the number of chars that must be entered 
                             //before autocomplete initiates a lookup
                 'minChars'=>0, 
                 'delay'=>500, //number of milliseconds before lookup occurs
                 'matchCase'=>false, //match case when performing a lookup?
     
                             //any additional html attributes that go inside of 
                             //the input field can be defined here
                 'htmlOptions'=>array('size'=>'20'), 
     
                 //'methodChain'=>".result(function(event,item){\$(\"#user_id\").val(item[1]);})",
              )
       ); ?>
		<?php echo $form->error($model,'token'); ?>
        </td>
    </tr>
	 <tr >
    <td class="td27" ><?php echo $form->labelEx($model,'sortnum'); ?></td>
  </tr>
  <tr>
    <td>
		<?php echo $form->textField($model,'sortnum'); ?>
		<?php echo $form->error($model,'sortnum'); ?>
        </td>
    </tr>
	<tr>
    <td><button class="btn" type="submit" name="button" id="button">完成提交</button></td>
  </tr>
</table>


<?php $this->endWidget(); ?>
