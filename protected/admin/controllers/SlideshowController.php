<?php

class SlideshowController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to 'column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	//public $layout='';

	/**
	 * @var CActiveRecord the currently loaded data model instance.
	 */
	private $_model;

	/**
	 * Displays a particular model.
	 */
	public function actionView()
	{
		$this->render('view',array(
			'model'=>$this->loadModel(),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Slideshow;

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['Slideshow']))
		{
		    $model->attributes=$_POST['Slideshow'];
			if($model->save())
            {
                $image = CUploadedFile::getInstance($model,'image');
                if($image)
                {
                    $filename = time() . rand(1000,9999) .'.'. $image->getExtensionName();
                    $filepath = $this->getUploadDir('slideshow') .$filename;
                    if($image->saveAs($filepath)) 
                    {
                        $model->image = $this->getUploadBase('slideshow') . $filename;
                        $model->save();
                    }
                }
                Yii::app()->user->setFlash('success',"幻灯“{$model->title}”已成功添加！");
				$this->redirect(array('view','id'=>$model->id));
            }
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionUpdate()
	{
		$model=$this->loadModel();

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['Slideshow']))
		{
		    unset($_POST['Slideshow']['image']);
			$model->attributes=$_POST['Slideshow'];
            if($model->save())
            {
                $image = CUploadedFile::getInstance($model,'image');
                if($image)
                {
                    $filename = time() . rand(1000,9999) .'.'. $image->getExtensionName();
                    $filepath = $this->getUploadDir('slideshow') .$filename;
                    if($image->saveAs($filepath)) 
                    {
                        @unlink(Yii::app()->basePath . '/../' . $model->image);
                        $model->image = $this->getUploadBase('slideshow') . $filename;
                        $model->save();
                    }
                }
                Yii::app()->user->setFlash('success',"幻灯“{$model->title}”已成功修改！");
				$this->redirect(array('view','id'=>$model->id));
            }
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 */
	public function actionDelete()
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel()->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(array('index'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Manages all models.
	 */
	public function actionIndex()
	{
		$model=new Slideshow('search');
		if(isset($_GET['Slideshow']))
			$model->attributes=$_GET['Slideshow'];

		$this->render('index',array(
			'model'=>$model,
		));
	}
	
    public function actionAutocomplete()
    {
       if(Yii::app()->request->isAjaxRequest && isset($_GET['q']))
       {
            /* q is the default GET variable name that is used by
            / the autocomplete widget to pass in user input
            */
          $token = $_GET['q']; 
                    // this was set with the "max" attribute of the CAutoComplete widget
          $limit = min($_GET['limit'], 50); 
          
          $criteria = new CDbCriteria;
          $criteria->condition = "token LIKE :sterm";
          $criteria->params = array(":sterm"=>"%$token%");
          $criteria->limit = $limit;
          $criteria->distinct = true;
          $criteria->select = array('token');
          $models = Slideshow::model()->findAll($criteria);
          $returnVal = '';
          foreach($models as $model)
          {
             $returnVal .= $model->getAttribute('token').'|'
                                         .$model->getAttribute('id')."\n";
          }
          echo $returnVal;
       }
    }

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 */
	public function loadModel()
	{
		if($this->_model===null)
		{
			if(isset($_GET['id']))
				$this->_model=Slideshow::model()->findbyPk($_GET['id']);
			if($this->_model===null)
				throw new CHttpException(404,'您要浏览的页面不存在，可能是已被删除或者URL地址错误。');
		}
		return $this->_model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='slideshow-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
