<?php
$label = CActiveRecord::model('Product')->modelName;

$this->breadcrumbs=array(
	$label.'管理',
    '查看'.$label,
);

$this->menu=array(
	array('label'=>'管理'.$label, 'url'=>array('index')),
	array('label'=>'新增'.$label, 'url'=>array('create')),
	array('label'=>'修改'.$label, 'url'=>array('update','id'=>$model->id)),
	array('label'=>'查看'.$label, 'url'=>array('view','id'=>$model->id), 'active'=>true),
    array('label'=>'删除'.$label, 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'您确定要删除该项目吗？', 'csrf'=>true)),
);
?>

  <table class="tb tb2 nobdb">
    <tr>
      <th colspan="15" class="partition">详细资料</th>
    </tr>
    </table>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'htmlOptions' => array('class'=>'tb tb2 nobdb'),
	'itemCssClass' => array('hover odd', 'hover even'),
	'itemTemplate' => '<tr class="{class}" ><td class="td21">{label}：</td><td>{value}</td></tr>',
	'attributes'=>array(
		'id',
		'photo_id',
		'unit',
		'market_price',
		'member_price',
		'number',
		'status',
		'created',
		'updated',
		'user_id',
		'category_id',
		'title',
		'type',
		'standard',
		'brand',
		'content',
		'is_del:boolean',
		'views',
		'is_rec:boolean',
	),
)); ?>