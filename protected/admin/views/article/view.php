<?php
$label = CActiveRecord::model('Article')->modelName;

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
		'category.name',
	
		'title',
		'iscommend:boolean',
		'isheadline:boolean',
		'views',
		'writer',
		'source',
		'image:image',
		'description',
		'keywords',
		'content',
		'ischecked:boolean',
		'sortnum',
		'created',
		'updated',
		'comment_count',
		'sourceurl:url',
	),
)); ?>