

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>
<table class="tb tb2 nobdt search_header">
    <tr>
      <th colspan="15" class="partition">搜索符合条件的友情链接</th>
    </tr>
    <tr>
      <td><table class="noborder">
		<tr>
		<td style="text-align:right;vertical-align:middle;"><?php echo $form->label($model,'id'); ?></td>
		<td><?php echo $form->textField($model,'id',array('size'=>5,'maxlength'=>50)); ?></td>

		<td style="text-align:right;vertical-align:middle;"><?php echo $form->label($model,'name'); ?></td>
		<td><?php echo $form->textField($model,'name',array('size'=>10,'maxlength'=>50)); ?></td>
		
		<td style="text-align:right;vertical-align:middle;"><?php echo $form->label($model,'enabled'); ?></td>
		<td><?php echo $form->dropdownlist($model,'enabled', array('1'=>'是','0'=>'否'),array('empty'=>'全部')); ?></td>

		<td>
		<?php echo CHtml::submitButton('搜索', array('class'=>'btn')); ?>
		</td>

</tr>
</table>
        <style>
            .noborder td{border:none;vertical-align:middle;}
            </style>
</table>
<?php $this->endWidget(); ?>

