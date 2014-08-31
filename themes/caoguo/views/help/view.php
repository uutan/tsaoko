<?php
/* @var $this ArticleController */
$this->pageTitle = $model->title;


$this->breadcrumbs=array(
	'技术支持'=>array('/article'),
	$model->title,
);
?>


<div class="ui-box">
    <div class="ui-box-head">
        <h3 class="ui-box-head-title"> <?php echo $model->title; ?>	</h3>
        <span class="ui-box-head-text"></span>
    </div>
</div>

<div class="ui-article-view">

<h1 class="h1"><?php echo $model->title; ?></h1>

<p class="desc">发布时间：<?php echo date('Y-m-d H:i:s',$model->created); ?></p>

<div class="ui-article-content">
<?php echo $model->content; ?>
</div>

</div>