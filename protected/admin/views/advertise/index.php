<?php
$label = CActiveRecord::model('Advertise')->modelName;
$this->breadcrumbs=array(
	$label.'管理',
);

$this->menu=array(
        array('label'=>'管理'.$label, 'url'=>array('index'), 'active'=>true),
        array('label'=>'新增'.$label, 'url'=>array('create')),
);
?>


<?php $this->widget('GridView', array(
	'id'=>'advertise-grid',
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
		'position.name',
		'template.name',
		'display_count',
		'clickStats:array:点击统计',
		'created',
		array(
			'class'=>'ButtonColumn',
		),
	),
)); ?>
