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
	<?php echo $form->label($model,'cate_id'); ?>
</td>
<td>
<?php echo $form->dropDownList($model, 'cate_id', array(''=>'全部分类')+ArticleCategory::getAll()); ?>
</td>
<td style="text-align:right;vertical-align:middle;">
	<?php echo $form->label($model,'title'); ?>
</td>
<td>
<?php echo $form->textField($model, 'title', array( 'maxlength' => 180, 'class' => '')); ?>
</td>
<td style="text-align:right;vertical-align:middle;">
	<?php echo $form->label($model,'iscommend'); ?>
</td>
<td>
<?php echo $form->dropDownList($model, 'iscommend', array('' => '全部','1' =>'是','0'=>'否')); ?>
</td>
<td style="text-align:right;vertical-align:middle;">
	<?php echo $form->label($model,'isheadline'); ?>
</td>
<td>
<?php echo $form->dropDownList($model, 'isheadline', array('' => '全部','1' =>'是','0'=>'否')); ?>
</td>
<td style="text-align:right;vertical-align:middle;">
	<?php echo $form->label($model,'ischecked'); ?>
</td>
<td>
<?php echo $form->dropDownList($model, 'ischecked', array('' => '全部','1' =>'是','0'=>'否')); ?>
</td>
<!--
<td style="text-align:right;vertical-align:middle;">
	<?php echo $form->label($model,'views'); ?>
</td>
<td>
<?php echo $form->textField($model, 'views', array('class' => 'text_field')); ?>
</td>
<td style="text-align:right;vertical-align:middle;">
	<?php echo $form->label($model,'writer'); ?>
</td>
<td>
<?php echo $form->textField($model, 'writer', array( 'maxlength' => 45, 'class' => '')); ?>
</td>
<td style="text-align:right;vertical-align:middle;">
	<?php echo $form->label($model,'source'); ?>
</td>
<td>
<?php echo $form->textField($model, 'source', array( 'maxlength' => 45, 'class' => '')); ?>
</td>
<td style="text-align:right;vertical-align:middle;">
	<?php echo $form->label($model,'image'); ?>
</td>
<td>
<?php echo $form->textField($model, 'image', array( 'maxlength' => 100, 'class' => '')); ?>
</td>
<td style="text-align:right;vertical-align:middle;">
	<?php echo $form->label($model,'description'); ?>
</td>
<td>
<?php echo $form->textArea($model, 'description', array('rows' => 6, 'cols' => 50)); ?>
</td>
<td style="text-align:right;vertical-align:middle;">
	<?php echo $form->label($model,'keywords'); ?>
</td>
<td>
<?php echo $form->textField($model, 'keywords', array( 'maxlength' => 1000, 'class' => '')); ?>
</td>
<td style="text-align:right;vertical-align:middle;">
	<?php echo $form->label($model,'content'); ?>
</td>
<td>
<?php echo $form->textArea($model, 'content', array('rows' => 6, 'cols' => 50)); ?>
</td>
<td style="text-align:right;vertical-align:middle;">
	<?php echo $form->label($model,'ischecked'); ?>
</td>
<td>
<?php echo $form->textField($model, 'ischecked', array('class' => 'text_field')); ?>
</td>
<td style="text-align:right;vertical-align:middle;">
	<?php echo $form->label($model,'sortnum'); ?>
</td>
<td>
<?php echo $form->textField($model, 'sortnum', array('class' => 'text_field')); ?>
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
	<?php echo $form->label($model,'comment_count'); ?>
</td>
<td>
<?php echo $form->textField($model, 'comment_count', array('class' => 'text_field')); ?>
</td>
<td style="text-align:right;vertical-align:middle;">
	<?php echo $form->label($model,'sourceurl'); ?>
</td>
<td>
<?php echo $form->textField($model, 'sourceurl', array( 'maxlength' => 250, 'class' => '')); ?>
</td>
<td style="text-align:right;vertical-align:middle;">
	<?php echo $form->label($model,'life_axis_id'); ?>
</td>
<td>
<?php echo $form->textField($model, 'life_axis_id', array('class' => 'text_field')); ?>
</td>
<td style="text-align:right;vertical-align:middle;">
	<?php echo $form->label($model,'istopic'); ?>
</td>
<td>
<?php echo $form->textField($model, 'istopic', array('class' => 'text_field')); ?>
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

