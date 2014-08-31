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
<?php echo $form->textField($model, 'title', array( 'maxlength' => 10, 'class' => '')); ?>
</td>
<td style="text-align:right;vertical-align:middle;">
	<?php echo $form->label($model,'is_rec'); ?>
</td>
<td>
<?php echo $form->dropdownlist($model, 'is_rec', array( '' => '全部', '0' => '否','1'=>'是')); ?>
</td>
<td style="text-align:right;vertical-align:middle;">
	<?php echo $form->label($model,'is_del'); ?>
</td>
<td>
<?php echo $form->dropdownlist($model, 'is_del', array( '' => '全部', '0' => '否','1'=>'是')); ?>
</td>
<!--
<td style="text-align:right;vertical-align:middle;">
	<?php echo $form->label($model,'member_price'); ?>
</td>
<td>
<?php echo $form->textField($model, 'member_price', array( 'maxlength' => 10, 'class' => '')); ?>
</td>
<td style="text-align:right;vertical-align:middle;">
	<?php echo $form->label($model,'number'); ?>
</td>
<td>
<?php echo $form->textField($model, 'number', array('class' => 'text_field')); ?>
</td>
<td style="text-align:right;vertical-align:middle;">
	<?php echo $form->label($model,'status'); ?>
</td>
<td>
<?php echo $form->textField($model, 'status', array('class' => 'text_field')); ?>
</td>
<td style="text-align:right;vertical-align:middle;">
	<?php echo $form->label($model,'created'); ?>
</td>
<td>
<?php echo $form->textField($model, 'created', array('class' => 'text_field')); ?>
</td>
<td style="text-align:right;vertical-align:middle;">
	<?php echo $form->label($model,'updated'); ?>
</td>
<td>
<?php echo $form->textField($model, 'updated', array('class' => 'text_field')); ?>
</td>
<td style="text-align:right;vertical-align:middle;">
	<?php echo $form->label($model,'user_id'); ?>
</td>
<td>
<?php echo $form->textField($model, 'user_id', array('class' => 'text_field')); ?>
</td>
<td style="text-align:right;vertical-align:middle;">
	<?php echo $form->label($model,'category_id'); ?>
</td>
<td>
<?php echo $form->textField($model, 'category_id', array('class' => 'text_field')); ?>
</td>
<td style="text-align:right;vertical-align:middle;">
	<?php echo $form->label($model,'title'); ?>
</td>
<td>
<?php echo $form->textField($model, 'title', array( 'maxlength' => 255, 'class' => '')); ?>
</td>
<td style="text-align:right;vertical-align:middle;">
	<?php echo $form->label($model,'type'); ?>
</td>
<td>
<?php echo $form->textField($model, 'type', array( 'maxlength' => 100, 'class' => '')); ?>
</td>
<td style="text-align:right;vertical-align:middle;">
	<?php echo $form->label($model,'standard'); ?>
</td>
<td>
<?php echo $form->textField($model, 'standard', array( 'maxlength' => 200, 'class' => '')); ?>
</td>
<td style="text-align:right;vertical-align:middle;">
	<?php echo $form->label($model,'brand'); ?>
</td>
<td>
<?php echo $form->textField($model, 'brand', array( 'maxlength' => 100, 'class' => '')); ?>
</td>
<td style="text-align:right;vertical-align:middle;">
	<?php echo $form->label($model,'content'); ?>
</td>
<td>
<?php echo $form->textArea($model, 'content', array('rows' => 6, 'cols' => 50)); ?>
</td>
<td style="text-align:right;vertical-align:middle;">
	<?php echo $form->label($model,'is_del'); ?>
</td>
<td>
<?php echo $form->textField($model, 'is_del', array('class' => 'text_field')); ?>
</td>
<td style="text-align:right;vertical-align:middle;">
	<?php echo $form->label($model,'views'); ?>
</td>
<td>
<?php echo $form->textField($model, 'views', array('class' => 'text_field')); ?>
</td>
<td style="text-align:right;vertical-align:middle;">
	<?php echo $form->label($model,'is_rec'); ?>
</td>
<td>
<?php echo $form->textField($model, 'is_rec', array('class' => 'text_field')); ?>
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

