<?php
/* @var $this ArticleController */
$this->pageTitle = $model->title;


$this->breadcrumbs=array(
	'项目展示'=>array('/product'),
	$model->title,
);
?>

<div class="ui-title" style="margin-bottom:20px;">
项目展示 - <?php echo $model->title; ?>
</div>


<table class="ui-table ui-table-noborder mb10 ui-product-view">
	<tr>
		<td rowspan="6" width="230">
<?php $this->widget('ext.CacheThumbImageWidget',array('path'=>$model->getHomeimage(),'width'=>220,'height'=>220)) ?>
		</td>
		<th width="80">项目名称</th>
		<td><?php echo $model->title; ?></td>
	</tr>
	<tr>
		<th>型号</th>
		<td><?php echo $model->type; ?></td>
	</tr>
	<tr>
		<th>规格</th>
		<td><?php echo $model->standard; ?></td>
	</tr>
	<tr>
		<th>品牌</th>
		<td><?php echo $model->brand; ?></td>
	</tr>	
	<tr>
		<th>所属分类</th>
		<td><?php echo $model->category->name; ?></td>
	</tr>
</table>

<div class="ui-title" style="margin-bottom:20px;">
在线订购&咨询
</div>


<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'order-form',
    'enableClientValidation'=>true,
    'clientOptions'=>array(
        'validateOnSubmit'=>true,
    ),
    'htmlOptions' => array('class' => 'ui-form'),
)); ?>
    <fieldset style="margin-top:20px;">

        <div class="ui-form-item">
            <label for="" class="ui-label">订购/咨询内容</label>
            <input class="ui-input ui-input-disable" type="text" value="<?php echo $model->title; ?>" disable>
            <?php echo $form->hiddenField($order,'product_id'); ?>
        </div>

        <div class="ui-form-item">
            <?php echo $form->label($order,'linkman',array('class'=>'ui-label')); ?>
            <?php echo $form->textField($order,'linkman',array('class'=>'ui-input')); ?>
            <?php echo $form->error($order,'linkman'); ?>
        </div>

        <div class="ui-form-item">
            <?php echo $form->label($order,'phone',array('class'=>'ui-label')); ?>
            <?php echo $form->textField($order,'phone',array('class'=>'ui-input')); ?>
            <?php echo $form->error($order,'phone'); ?>
        </div>

        <div class="ui-form-item">
            <?php echo $form->label($order,'email',array('class'=>'ui-label')); ?>
            <?php echo $form->textField($order,'email',array('class'=>'ui-input')); ?>
            <?php echo $form->error($order,'email'); ?>
        </div>


        <div class="ui-form-item">
            <?php echo $form->label($order,'content',array('class'=>'ui-label')); ?>
            <?php echo $form->textArea($order,'content',array('class'=>'ui-input','style'=>'width:400px;height:120px;')); ?>
            <?php echo $form->error($order,'content'); ?>
        </div>


        <div class="ui-form-item">
            <input type="submit" class="ui-button ui-button-morange" value="确定">
        </div>
    </fieldset>
<?php $this->endWidget(); ?>
