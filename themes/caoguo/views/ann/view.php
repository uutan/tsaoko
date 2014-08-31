<?php
/* @var $this AnnController */
$this->pagetitle = '网站公告 - '.$model->title.' - '.Yii::app()->name;


$this->breadcrumbs=array(
	'网站公告'=>array('/ann'),
	$model->title,
);
?>


<div class="ui-title" style="margin-bottom:20px;">
网站公告
</div>

<div class="ui-article-view">

<h1 class="h1"><?php  echo $model->title;?></h1>

<p class="desc">发布时间：<?php echo date('Y-m-d H:i:s',$model->created); ?></p>

<div class="ui-article-content">
<?php echo $model->content; ?>
</div>

</div>