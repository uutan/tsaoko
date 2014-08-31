<?php
/* @var $this AnnController */
$this->pageTitle = '成功案例 - '.Yii::app()->name;
$this->breadcrumbs=array(
	'成功案例' => array('/article/index'),
);

$newsArray2 = array();
foreach(ArticleCategory::getSubOptions(49) as $cid => $cname)
{
    $newsArray2[] = array(
        'label' => $cname,
        'url' => array('showcase/index','id'=>$cid),
        'itemOptions' => array('class' => ''),
    );
}

$this->menu = $newsArray2;
?>

<div class="ui-title" style="margin-bottom:20px;">
成功案例
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