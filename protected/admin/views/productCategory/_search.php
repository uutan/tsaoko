<table class="tb tb2 nobdt search_header">
    <tr>
        <th colspan="15" class="partition">搜索符合条件的数据</th>
    </tr>
    <tr>
        <td>
      


<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
	'htmlOptions' => array('class'=>'pure-form search-pannel'),
)); ?>

<table class="noborder">
<td style="text-align:right;vertical-align:middle;">
	<?php echo $form->label($model,'id'); ?>
</td>
<td>
<?php echo $form->textField($model, 'id', array('class' => 'text_field')); ?>
</td>
<td style="text-align:right;vertical-align:middle;">
	<?php echo $form->label($model,'parent_id'); ?>
</td>
<td>
<?php echo $form->dropdownlist($model, 'parent_id', array('' => '全部')+ProductCategory::getAll()); ?>
</td>
<td style="text-align:right;vertical-align:middle;">
	<?php echo $form->label($model,'name'); ?>
</td>
<td>
<?php echo $form->textField($model, 'name', array( 'maxlength' => 256, 'class' => '')); ?>
</td>
<!--
<td style="text-align:right;vertical-align:middle;">
	<?php echo $form->label($model,'ultimate'); ?>
</td>
<td>
<?php echo $form->dropdownlist($model, 'ultimate', array( 'maxlength' => 30, 'class' => '')); ?>
</td>

<td style="text-align:right;vertical-align:middle;">
	<?php echo $form->label($model,'keywords'); ?>
</td>
<td>
<?php echo $form->textArea($model, 'keywords', array('rows' => 6, 'cols' => 50)); ?>
</td>
<td style="text-align:right;vertical-align:middle;">
	<?php echo $form->label($model,'description'); ?>
</td>
<td>
<?php echo $form->textArea($model, 'description', array('rows' => 6, 'cols' => 50)); ?>
</td>
<td style="text-align:right;vertical-align:middle;">
	<?php echo $form->label($model,'sortnum'); ?>
</td>
<td>
<?php echo $form->textField($model, 'sortnum', array('class' => 'text_field')); ?>
</td>
-->
        <td>
        <input class="btn" type="submit" name="yt0" value="搜索" />        </td>
    </tr>
</table>
<?php $this->endWidget(); ?>    
        </td>
    </tr>
</table>

