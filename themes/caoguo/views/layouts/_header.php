<header class="navbar" role="banner"><!-- navbar-inverse 深色-->
  <div class="container">
    <div class="navbar-header">
      <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".bs-navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a href="/" class="navbar-brand" style="-webkit-mask: -webkit-gradient(radial, 17 17, 123, 17 17, 138, from(rgb(0, 0, 0)), color-stop(0.5, rgba(0, 0, 0, 0.2)), to(rgb(0, 0, 0)));"><?php echo Yii::app()->name; ?></a>
    </div>
    <nav class="collapse navbar-collapse bs-navbar-collapse" role="navigation">
      <ul class="nav navbar-nav navbar-right">
        <li class="<?php echo $this->id == 'site' ? 'active' : ''; ?>">
          <?php echo CHtml::link('首页',array('/site/index')); ?>
        </li>
        <?php foreach(array('技术服务','技术支持','软件销售') as $number):?>
        <li class="dropdown">
          <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"> <?php echo $number; ?> <b class="caret"></b></a>
          <ul class="dropdown-menu" role="menu">
          <?php foreach($this->pages($number) as $index => $item): ?>
            <li><?php echo CHtml::link($item['title'],array('/page/index','name'=>$item['name'])); ?></li>
          <?php endforeach; ?>
          </ul>
        </li>
      <?php endforeach; ?>
        <li class="<?php echo $this->id == 'site' ? '' : '';  ?>">
            <?php echo CHtml::link('联系我们',array('/site/contact')); ?>
        </li>
      </ul>
    </nav>
  </div>
</header>
