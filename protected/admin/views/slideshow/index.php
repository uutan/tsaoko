<?php
$this->breadcrumbs=array(
	'幻灯管理',
);

$this->menu=array(
	array('label'=>'管理幻灯', 'url'=>array('slideshow/index')),
	array('label'=>'添加幻灯', 'url'=>array('slideshow/create')),
);

?>

<table class="tb tb2 " id="tips">
  <tr>
    <th  class="partition">技巧提示</th>
  </tr>
  <tr >
    <td class="tipsblock" ><ul id="tipslis">
        <li>您可在此发布、删除、管理幻灯展示。</li>
      </ul></td>
  </tr>
</table>

<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>

<?php $this->widget('GridView', array(
	'id'=>'slideshow-grid',
	'dataProvider'=>$model->search(),
	'selectableRows' => 2,
	'itemsCssClass' => 'tb2',
	'cssFile'=>false,
    'pager' => array('class'=>'CombPager'),
	'columns'=>array(
		'id',
		'title',
		'url',
		array( 
            'class'=>'EImageColumn',
            'name' => 'image',
            'pathPrefix'=>'',
            'htmlOptions' => array('style'=>'width:100px'),
        ),
		'token',
		'sortnum',
		'created:datetime',
		array(
			'class'=>'ButtonColumn',
			'template' => '{update}&nbsp;{delete}',
		),
	),
)); ?>

