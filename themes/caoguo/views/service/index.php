<?php
/* @var $this AnnController */
$this->pageTitle = '产品服务 - '.Yii::app()->name;
$this->breadcrumbs=array(
	'产品服务' => array('/article/index'),
);
?>


<div class="ui-title" style="margin-bottom:20px;">
产品服务
</div>

<?php
        $this->widget('zii.widgets.CListView', array(
            'id' => 'ui-comment-list',
            'cssFile' => false,
            'ajaxUpdate' => true,
            'emptyText' => '<tr><td colspan="3">还没有内容</td></tr>',
            'dataProvider' => $dataProvider,
            'itemView' => '_li',
            'pager' => array(
                'class' => 'SimplePager',
                'maxButtonCount' => 5,
            ),
            'template' => '
<table class="ui-table ui-table-noborder"> 
{items}
</table>
{pager}',
	));

?>	 