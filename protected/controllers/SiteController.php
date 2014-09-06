<?php

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// cate_id = 48,48,50
		$cates = Yii::app()->cache->get('homecates');
		if( empty( $cates) )
		{
			$cr = new CDbCriteria;
			$cr->addInCondition('id',array(48,49,50));
			$cateModel = ArticleCategory::model()->findAll($cr);
			$cates = array();
			foreach($cateModel as $item)
			{
				$cates[$item->id] = array(
					'name' => $item->name,
					'desc' => $item->keywords,
				);
			}
			Yii::app()->cache->set('homecates',$cates,60*30, new CFileCacheDependency($this->cacheHomeFile));
		}
		$data['cates'] = $cates;


		$data['news'] = $this->getArticleList(48);
		$data['showcases'] = $this->getArticleList(49);
		$data['users'] = $this->getArticleList(50);

		


		$this->render('index',$data);
	}


	/**
	 * 获取数据
	 * 
	 * @param  [type]  $category_id [description]
	 * @param  integer $limit       [description]
	 * @return [type]               [description]
	 */
    public function getArticleList($category_id,$limit = 8)
    {
    	$cacheName = 'article-list-'.$category_id.'-'.$limit;
    	$data = Yii::app()->cache->get($cacheName);
    	if( $data === false ){
    		$data = array();
	    	$cateid[] = $category_id;
	   		$cateModel = ArticleCategory::model()->findAllByAttributes(array('parent_id'=>$category_id));

	   		foreach($cateModel as $item)
	   		{
	   			$cateid[] = $item->id;
	   		}
	   		
	   		$cr  = new CDbCriteria;
	   		$cr->addInCondition('cate_id',$cateid);
	   		$cr->compare('ischecked',1);
	   		$cr->limit = $limit;
	   		$cr->order = 'id DESC';
	   		
	   		$articles = Article::model()->findAll($cr);

	   		foreach($articles as $item)
	   		{
	   			$data[] = array(
	   				'id' => $item->id,
	   				'title' => $item->title,
	   				'time' => $item->updated,
	   				'image' => $item->image,
	   			);
	   		}
	   		Yii::app()->cache->set($cacheName, $data, 60*30, new CFileCacheDependency($this->cacheHomeFile));
   		}
   		return $data;
    }


	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{

		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-Type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
}