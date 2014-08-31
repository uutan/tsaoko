<?php
$label = CActiveRecord::model('AdvertisePosition')->modelName;
$this->breadcrumbs=array(
	$label.'管理',
);

$this->menu=array(
        array('label'=>'管理'.$label, 'url'=>array('index'), 'active'=>true),
        array('label'=>'新增'.$label, 'url'=>array('create')),
);
?>


<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>
<table class="tb tb2 nobdt search_header">
    <tr>
        <th colspan="15" class="partition">搜索符合条件的数据</th>
    </tr>
    <tr>
        <td>
      
    <table class="noborder">
		<tr>
            <td style="text-align:right;vertical-align:middle;"><?php echo $form->label($model,'id'); ?></td>
            <td><?php echo $form->textField($model,'id', array('size'=>10)); ?></td>
            <td style="text-align:right;vertical-align:middle;"><?php echo $form->label($model,'name'); ?></td>
            <td><?php echo $form->textField($model,'name', array('size'=>10)); ?></td>
            <td style="text-align:right;vertical-align:middle;"><?php echo $form->label($model,'type'); ?></td>
            <td><?php echo $form->textField($model,'type',array('size'=>30,'maxlength'=>30)); ?></td>
            <td style="text-align:right;vertical-align:middle;"><?php echo $form->label($model,'width'); ?></td>
            <td><?php echo $form->textField($model,'width', array('size'=>10)); ?></td>
<!--            <td style="text-align:right;vertical-align:middle;"><?php echo $form->label($model,'height'); ?></td>
            <td><?php echo $form->textField($model,'height', array('size'=>10)); ?></td>
            <td style="text-align:right;vertical-align:middle;"><?php echo $form->label($model,'price'); ?></td>
            <td><?php echo $form->textField($model,'price', array('size'=>10)); ?></td>
		-->
            <td>
            <?php echo CHtml::submitButton('搜索', array('class'=>'btn')); ?>
            </td>
        </tr>
    </table>
    </div>
        </td>
    </tr>
</table>
<?php $this->endWidget(); ?>
<!-- search-form -->


<?php $this->widget('GridView', array(
	'id'=>'advertise-position-grid',
	'dataProvider'=>$model->search(),
    'itemsCssClass' => 'tb2',
    'selectableRows' => 2,
    'cssFile'=>false,
	'pager' => array('class'=>'CombPager'),
	'columns'=>array(
		array(
			'class'=>'CCheckBoxColumn',
			'name'=>'id',
			'id' => 'id',
			'headerHtmlOptions' => array('style'=>'width:40px'),
			'checkBoxHtmlOptions'=>array('class'=>'checkbox'),
		),
		'id',
		'name',
		'type',
		'width',
		'height',
		//'price',
		array(
			'class'=>'ButtonColumn',
			'viewButtonOptions' => array('target'=>'_self'),
		),
	),
)); ?>

<?php $form=$this->beginWidget('CActiveForm', array(
        'action'=>array('operate'),
        'id'=>'operateForm',
        'method'=>'post',
)); ?>
  <table class="tb tb2 nobdb">
    <tr>
      <th colspan="15" class="partition">操作</th>
    </tr>
    <tr class="header">
      <th></th>
      <th>操作</th>
      <th>选项</th>
    </tr>
    <tr class="hover" >
      <td class="td25"><input class="radio" type="radio" name="operation" value="delete"></td>
      <td class="td24">批量删除</td>
      <td class="rowform" style="width:auto;"></td>
    </tr>
    <tr>
      <td colspan="15"><div class="fixsel">
          <div id="ajax_status_display"></div>
          <input type="submit" class="btn" id="submit_listsubmit" name="listsubmit" title="按 Enter 键可随时提交您的修改" value="提交" />
        </div></td>
    </tr>
  </table>
<?php $this->endWidget(); ?>
