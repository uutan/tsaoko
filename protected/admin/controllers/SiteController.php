<?php

/**
 * 
 * 后台首页控制器
 *
 * 验证用户是否拥有权限登录
 */
class SiteController extends Controller
{

    /**
     * 不需要权限即可访问的动作列表
     * 
     * @return [type] [description]
     */
    public function allowedActions()
    {
        return 'error, index, logout';
    }
    

    /**
     * 后台验证码
     * 
     * @return [type] [description]
     */
    public function actions()
    {
        return array(
            'captcha'=>array(
                'class'=>'CCaptchaAction',
                'backColor'=>0xFFFFFF,
                'maxLength'=>4,
                'minLength'=>4,
                'width'=>100,
                'testLimit'=>1,    
            ),
        );
    }    


    /**
     * 后台用户登录页
     *
     * 没有登录时要求登录，已登录时，跳转至后台主界面
     * 
     * @return [type] [description]
     */
    public function actionIndex()
    {
        $this->layout = false;
        
        /**
         * 用户没有登录
         */
        if( Yii::app()->user->isGuest )
        {
            // 登录模型
            $model = new LoginForm;

            if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
            {
                echo CActiveForm::validate($model);
                Yii::app()->end();
            }

            if(isset($_POST['LoginForm']))
            {
                $model->attributes=$_POST['LoginForm'];
                
                if( $model->validate() && $model->login() )
                {
                    $this->redirect(array('site/index'));
                }
            }
            
            $this->render('login',array('model'=>$model));
            Yii::app()->end();
        }


        
        $this->render('index');
        
    }


    /**
     * 欢迎首页
     * 
     * @return [type] [description]
     */
    public function actionWelcome()
    {
        
        $this->render('welcome');   
    }



    /**
     * 退出后台登录
     * 
     * @return [type] [description]
     */
    public function actionLogout()
    {
        Yii::app()->user->logout(false);
        $this->redirect(Yii::app()->homeUrl);
    }



    /**
     * 出错提示
     * 
     * @return [type] [description]
     */
    public function actionError()
    {
        if ($error = Yii::app()->errorHandler->error)
        {
            if (Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }
    }



}