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
	<?php echo $form->label($model,'title'); ?>
</td>
<td>
<?php echo $form->textField($model, 'title', array( 'maxlength' => 255, 'class' => '')); ?>
</td>

<td style="text-align:right;vertical-align:middle;">
    <?php echo $form->label($model,'is_checked'); ?>
</td>
<td>
<?php echo $form->dropdownlist($model, 'is_checked', array('' => '全部','1'=>'是','0'=>'否')); ?>
</td>
<!--
<td style="text-align:right;vertical-align:middle;">
	<?php echo $form->label($model,'updated'); ?>
</td>
<td>
<?php echo $form->textField($model, 'updated', array('class' => 'text_field')); ?>
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

