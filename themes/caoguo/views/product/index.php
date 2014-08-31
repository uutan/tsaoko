<?php
/* @var $this AnnController */
$this->pageTitle = '项目展示 - '.Yii::app()->name;
$this->breadcrumbs=array(
	'项目展示' => array('/article/index'),
);


$proCateArray = array();
foreach(ProductCategory::getSubOptions(0) as $cid => $cname)
{
    $proCateArray[] = array(
        'label' => $cname,
        'url' => array('/product/index','id'=>$cid),
        'itemOptions' => array('class' => '')
    );
}

$this->menu = $proCateArray;

?>

<div class="ui-title" style="margin-bottom:20px;">
项目展示
</div>


<div class="ui-tipbox ui-tipbox-message mb10">
    <div class="ui-tipbox-icon">
        <i class="iconfont" title="提示">&#xF046;</i>
    </div>
    <div class="ui-tipbox-content">
        <h3 class="ui-tipbox-title"><?php echo Yii::app()->name; ?><?php echo Yii::app()->config->get('contact_linkman'); ?>为您推荐以下内容：</h3>
        <p class="ui-tipbox-explain">拔打这个电话：<?php echo Yii::app()->config->get('contact_tel'); ?> 立即为您解答项目相关问题。</p>
    </div>
</div>

<?php
        $this->widget('zii.widgets.CListView', array(
            'id' => 'ui-product-list',
            'cssFile' => false,
            'ajaxUpdate' => true,
            'emptyText' => '
<div class="ui-tipbox ui-tipbox-wait">
    <div class="ui-tipbox-icon">
        <i class="iconfont" title="等待">&#xF04B;</i>
    </div>
    <div class="ui-tipbox-content">
        <h3 class="ui-tipbox-title">还没有内容</h3>
        <p class="ui-tipbox-explain">还没有内容，等待管理员添加。</p>
    </div>
</div>
            ',
            'dataProvider' => $dataProvider,
            'itemView' => '_li',
            'tagName' => 'ul',
            'pager' => array(
                'class' => 'SimplePager',
                'maxButtonCount' => 5,
            ),
            'template' => '{items}<div class="fn-clear"></div>{pager}',
	));

?>	 