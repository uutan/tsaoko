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
	<?php echo $form->label($model,'user_id'); ?>
</td>
<td>
<?php echo $form->textField($model, 'user_id', array('class' => 'text_field')); ?>
</td>
<td style="text-align:right;vertical-align:middle;">
	<?php echo $form->label($model,'article_id'); ?>
</td>
<td>
<?php echo $form->textField($model, 'article_id', array('class' => 'text_field')); ?>
</td>
<!--
<td style="text-align:right;vertical-align:middle;">
	<?php echo $form->label($model,'content'); ?>
</td>
<td>
<?php echo $form->textArea($model, 'content', array('rows' => 6, 'cols' => 50)); ?>
</td>

<td style="text-align:right;vertical-align:middle;">
	<?php echo $form->label($model,'created'); ?>
</td>
<td>
<?php echo $form->textField($model, 'created', array('class' => 'text_field')); ?>
</td>
<td style="text-align:right;vertical-align:middle;">
	<?php echo $form->label($model,'ischecked'); ?>
</td>
<td>
<?php echo $form->textField($model, 'ischecked', array('class' => 'text_field')); ?>
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

