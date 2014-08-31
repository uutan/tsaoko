<?php
/* @var $this AnnController */
$this->pageTitle = $cate->name.' - '.Yii::app()->name;
$this->breadcrumbs=array(
    $cate->name
);

$newsArray = array();
foreach(ArticleCategory::getSubOptions(48) as $cid => $cname)
{
    $newsArray[] = array(
        'label' => $cname,
        'url' => array('article/index','id'=>$cid),
        'itemOptions' => array('class' => ''),
    );
}
$this->menu = $newsArray;

?>

<div class="ui-title" style="margin-bottom:20px;">
行业新闻 / <?php echo $cate->name; ?>
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