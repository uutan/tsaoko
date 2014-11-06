<?php
/* @var $this ArticleController */
$this->pageTitle = $model->title;


$this->breadcrumbs=array(
	'行业新闻'=>array('/article'),
	$model->title,
);
?>

<div class="srceen_home section-wrap">
	<div class="container">
      <h2 class="main-title"><?php echo $cates['48']['name']; ?></h2>
      <p class="main-description main-mb"><?php echo $cates['48']['desc']; ?></p>

<div class="ui-title" style="margin-bottom:20px;">
行业新闻 / <?php echo $model->category->name; ?>
</div>

<div class="ui-article-view">

	<h1 class="h1"><?php echo $model->title; ?></h1>

<p class="desc">发布时间：<?php echo date('Y-m-d H:i:s',$model->created); ?></p>

<div class="ui-article-content">
<?php echo $model->content; ?>
</div>

</div>


	</div>
</div>