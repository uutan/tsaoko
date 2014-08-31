<?php
/**
 * 系统配置
 *
 * 将数据保存在数据库表中的配置
 * 
 */
class ConfigController extends Controller
{

	public function actionIndex()
	{
        if(isset($_POST['config']))
        {
            foreach($_POST['config'] as $key=>$value)
            {
                Yii::app()->config->set($key, $value);
            }
        }
		$this->render('index');
	}

    public function actionPage()
    {
        if(isset($_POST['config']))
        {
            foreach($_POST['config'] as $key=>$value)
            {
                Yii::app()->config->set($key, $value);
            }
        }
        $this->render('page');
    }    

    public function actionContact()
    {
        if(isset($_POST['config']))
        {
            foreach($_POST['config'] as $key=>$value)
            {
                Yii::app()->config->set($key, $value);
            }
        }
        $this->render('contact');
    }        

}