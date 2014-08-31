<?php
/* @var $this AnnController */
$this->pageTitle = '技术支持 - '.Yii::app()->name;
$this->breadcrumbs=array(
	'技术支持' => array('/article/index'),
);

$newsArray4 = array();
foreach(ArticleCategory::getSubOptions(50) as $cid => $cname)
{
    $newsArray4[] = array(
        'label' => $cname,
        'url' => array('help/index','id'=>$cid),
        'itemOptions' => array('class' => ''),
    );
}
$this->menu = $newsArray4;

?>

<div class="ui-box">
    <div class="ui-box-head">
        <h3 class="ui-box-head-title">技术支持</h3>
        <span class="ui-box-head-text"></span>
    </div>
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