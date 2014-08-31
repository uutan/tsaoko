<?php
/* @var $this ArticleController */
$this->pageTitle = $model->title;


$this->breadcrumbs=array(
	'产品服务'=>array('/article'),
	$model->title,
);
?>



<div class="ui-title" style="margin-bottom:20px;">
产品服务
</div>


<div class="ui-article-view">

<h1 class="h1"><?php echo $model->title; ?></h1>

<p class="desc">发布时间：<?php echo date('Y-m-d H:i:s',$model->created); ?></p>

<div class="ui-article-content">
<?php echo $model->content; ?>
</div>

</div>