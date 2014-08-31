<?php
$label = CActiveRecord::model('Suppliers')->modelName;

$this->breadcrumbs=array(
        $label.'管理',
);

$this->menu=array(
        array('label'=>'管理'.$label, 'url'=>array('index'), 'active'=>true),
        array('label'=>'新增'.$label, 'url'=>array('create')),
);
?>


<?php $this->renderPartial('_search',array('model'=>$model)); ?>
<!-- search-form -->



<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'administrator-grid',
    'dataProvider'=>$model->search(),
    'selectableRows' => 2,
    'itemsCssClass' => 'pure-table list-table',
    'rowCssClass' => array('','pure-table-odd'),
    'pager' => array('header'=>' ','htmlOptions'=>array('class'=>'pure-paginator'),'internalPageCssClass'=>'pure-button','lastPageCssClass'=>'pure-button','nextPageCssClass'=>'pure-button','previousPageCssClass'=>'pure-button','firstPageCssClass'=>'pure-button','selectedPageCssClass'=>'pure-button-active',),
    'template' => '{items} <div class="pure-g"><div class="pure-u-2-3">{pager}</div><div class="pure-u-1-3">{summary}</div></div>',
    'cssFile'=>false,
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
			'is_check:boolean',
        array(
            'header' => '操作',
            'class'=>'CButtonColumn',
        ),
    ),
)); ?>


<?php $form=$this->beginWidget('CActiveForm', array(
        'action'=>array('operate'),
        'id'=>'operateForm',
        'method'=>'post',
        'htmlOptions' => array('style'=>'display:none','id'=>'list_operation')
)); ?>
  <table class="pure-table" style="width:auto;">
    <thead>
    <tr>
      <th></th>
      <th>操作</th>
      <th>选项</th>
    </tr>
    </thead>
    <tbody>
    <tr class="hover" >
      <td class="td25"><input class="radio" type="radio" name="operation" value="delete"></td>
      <td class="td24">批量删除</td>
      <td class="rowform" style="width:auto;"></td>
    </tr>
    </tbody>
  </table>
  <input type="submit" class="pure-button pure-button-primary" id="submit_listsubmit" name="listsubmit" title="按 Enter 键可随时提交您的修改" value="提交" />
<?php $this->endWidget(); ?>
