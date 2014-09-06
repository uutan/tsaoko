<?php
$this->pageTitle=Yii::app()->name;
?>


<!-- 灯片 -->
<div class="slide_home section-wrap">
	<div class="container">
		
          <div id="home-slide" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
              <li data-target="#home-slide" data-slide-to="0"></li>
              <li data-target="#home-slide" data-slide-to="1" class="active"></li>
              <li data-target="#home-slide" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
              <div class="item" style="background:url(<?php echo Yii::app()->theme->baseUrl; ?>/images/person-man.png) no-repeat 10% center;background-size:642px 400px;">

                <div class="carousel-caption" style="display:none;">
                  <h3>我是第一张幻灯片</h3>
                  <p>:)</p>
                </div>
              </div>
              <div class="item active" style="background:url(<?php echo Yii::app()->theme->baseUrl; ?>/images/multi-screen.png) no-repeat 10% center;">
                <div class="carousel-caption">
                  <h1>专攻多终端数据显示</h1>
                  <p>&nbsp;</p>
                  <p>我们有能力将您需要的数据显示在多终端，</p>
                  <p>其中包括，电脑，平板，手机，电视</p>
                  <p> 真正做到无屏不显。</p>
                  <p>  </p>
                </div>
              </div>
              <div class="item" style="background:url(<?php echo Yii::app()->theme->baseUrl; ?>/images/video_mail.png) no-repeat 10% center;">
                <div class="carousel-caption" style="display:none;">
                  <h3>我是第三张幻灯片</h3>
                  <p>最后一张咯~</p>
                </div>
              </div>
      
            </div>
          </div>


	</div>
</div>



<!-- 新闻资讯 -->
<div class="srceen_home section-wrap">
	<div class="container">
      <h2 class="main-title"><?php echo $cates['48']['name']; ?></h2>
      <p class="main-description main-mb"><?php echo $cates['48']['desc']; ?></p>

		
		<div class="col-md-12 report-card-items clearfix">
<?php if($this->beginCache('home_news', array('dependency'=>array(
        'class'=>'system.caching.dependencies.CDbCacheDependency',
        'sql'=>'SELECT count(id) FROM article WHERE parent_id = 48')
        ))) { ?>
<?php foreach($news as $item): ?>
    <div class="col-md-3">
            <div class="report-card-item">
        <div class="frontcover">
          <a href="<?php echo $this->createUrl('article/view',array('id'=>$item['id'])) ?>" target="_blank">
          <img src="http://img.36tr.com/poster/2014820/o_18vol43721ahg168tpr1kog1kde7?imageView/1/w/450/h/240" height="160" alt="Syntun">
          </a>
        </div>
        <div class="info">
          <div class="datetime">
            <?php echo date('Y',$item['time']); ?><br>
            <?php echo date('m.d',$item['time']); ?>
          </div>
          <div class="text">
            <?php echo CHtml::link($item['title'],array('article/view','id'=>$item['id'])); ?>
          </div>
        </div>
      </div>
      </div>
<?php endforeach; ?>
<?php $this->endCache(); } ?>
		</div>
	</div>
</div>


<!-- 客户案例 -->
<div class="users_home section-wrap">
	<div class="container">
      <h2 class="main-title"><?php echo $cates['49']['name']; ?></h2>
      <p class="main-description main-mb"><?php echo $cates['49']['desc']; ?></p>

    <div class="col-md-12 report-card-items clearfix">
 <?php if($this->beginCache('home_showcases', array('dependency'=>array(
        'class'=>'system.caching.dependencies.CDbCacheDependency',
        'sql'=>'SELECT count(id) FROM article WHERE parent_id = 49')
        ))) { ?>
<?php foreach($showcases as $item): ?>
    <div class="col-md-3">
            <div class="report-card-item">
        <div class="frontcover">
          <a href="<?php echo $this->createUrl('article/view',array('id'=>$item['id'])) ?>" target="_blank">
          <img src="http://img.36tr.com/poster/2014820/o_18vol43721ahg168tpr1kog1kde7?imageView/1/w/450/h/240" height="160" alt="Syntun">
          </a>
        </div>
        <div class="info">
          <div class="text">
            <?php echo CHtml::link($item['title'],array('article/view','id'=>$item['id'])); ?>
          </div>
        </div>
      </div>
      </div>
<?php endforeach; ?>
<?php $this->endCache(); } ?>
    </div>
		
	</div>
</div>


<!-- 客户评价 -->
<div class="section-wrap">
  <div class="container">
      <h2 class="main-title"><?php echo $cates['50']['name']; ?></h2>
      <p class="main-description main-mb"><?php echo $cates['50']['desc']; ?></p>

    
    <div class="col-md-12 report-card-items clearfix">
 <?php if($this->beginCache('home_users', array('dependency'=>array(
        'class'=>'system.caching.dependencies.CDbCacheDependency',
        'sql'=>'SELECT count(id) FROM article WHERE parent_id = 50')
        ))) { ?>
<?php foreach($users as $item): ?>
    <div class="col-md-3">
            <div class="report-card-item">
        <div class="frontcover">
          <a href="<?php echo $this->createUrl('article/view',array('id'=>$item['id'])) ?>" target="_blank">
          <img src="http://img.36tr.com/poster/2014820/o_18vol43721ahg168tpr1kog1kde7?imageView/1/w/450/h/240" height="160" alt="Syntun">
          </a>
        </div>
        <div class="info">
          <div class="text">
            <?php echo CHtml::link($item['title'],array('article/view','id'=>$item['id'])); ?>
          </div>
        </div>
      </div>
      </div>
<?php endforeach; ?>
<?php $this->endCache(); } ?>
    </div>

  </div>
</div>
