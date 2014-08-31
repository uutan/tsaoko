<?php
$this->breadcrumbs=array(
	'友情链接管理',
);

$this->menu=array(
	array('label'=>'管理友链', 'url'=>array('flink/index')),
	array('label'=>'添加友链', 'url'=>array('flink/create')),
	array('label'=>'自动检查', 'url'=>array('flink/check')),
);

?>


<?php 
/*
$this->renderPartial('_search',array(
	'model'=>$model,
)); 
*/
?>



<?php $this->widget('GridView', array(
	'id'=>'flink-grid',
	'dataProvider'=>$model->search(),
	'selectableRows' => 2,
	'itemsCssClass' => 'tb2',
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
		'url:url',
    'sortnum',
		array('name'=>'image', 'value'=>'str_replace("http://", "", $data->remote_image) ? $data->remote_image : $data->image;', 'type'=>'image'),
		'enabled:boolean',
		'created:datetime',
		array(
			'class'=>'ButtonColumn',
			//'template' => '{update}&nbsp;{delete}',
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
      <td class="td25"><input class="radio" type="radio" name="operation" value="check"></td>
      <td class="td24">批量有效性</td>
      <td class="rowform" style="width:auto;">&nbsp;
        <input class="radio" type="radio" name="opcheck" value="1" checked="checked">
        设为有效 &nbsp;&nbsp;
        <input class="radio" type="radio" name="opcheck" value="0">
        设为无效 &nbsp;&nbsp;
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