<?php 
$this->pageTitle = '联系我们';


?>

<div class="section-wrap">
  <div class="container">
      <h2 class="main-title">联系我们</h2>
      <p class="main-description main-mb">真实联系地址如下</p>

    
    <div class="col-md-12">
      <table class="table" style="margin:20px 20px;">
          <tr>
              <th>联系人：</th>
              <td><?php echo Yii::app()->config->get('contact_linkman'); ?></td>
          </tr>
          <tr>
              <th>手机号：</th>
              <td><?php echo Yii::app()->config->get('contact_tel'); ?></td>
          </tr>
          <tr>
              <th>联系地址：</th>
              <td><?php echo Yii::app()->config->get('contact_address'); ?></td>
          </tr>
      </table>
    </div>

  </div>
</div>

