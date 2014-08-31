<?php

class FlinkController extends Controller
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
        $model=new Flink;

        // Uncomment the following line if AJAX validation is needed
        $this->performAjaxValidation($model);

        if(isset($_POST['Flink']))
        {
        	unset($_POST['Flink']['image']);
            $model->attributes=$_POST['Flink'];
            $model->indexed = 1;
            if($model->save())
            {
                $image = CUploadedFile::getInstance($model,'image');
                if($image)
                {
                    $filename = time() . rand(1000,9999) .'.'. $image->getExtensionName();
                    $filepath = $this->getUploadDir('flink') .$filename;
                    if($image->saveAs($filepath))
                    {
                        $model->image = $this->getUploadBase('flink') . $filename;
                        $model->save();
                    }
                }
                Yii::app()->user->setFlash('success',"友情链接“{$model->name}”已成功添加！");
                $this->redirect(array('index'));
            }else{
            	var_dump($model->getErrors());
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

        if(isset($_POST['Flink']))
        {
            unset($_POST['Flink']['image']);
			$model->attributes=$_POST['Flink'];
			
			if(isset($_POST['delete_image']) && $_POST['delete_image'])
			{
				if($model->image) @unlink(Yii::app()->basePath . '/../' . $model->image);
				$model->image = null;
			}
			
            if($model->save())
            {
                $image = CUploadedFile::getInstance($model,'image');
                if($image)
                {
                    $filename = time() . rand(1000,9999) .'.'. $image->getExtensionName();
                    $filepath = $this->getUploadDir('flink') .$filename;
                    if($image->saveAs($filepath)) 
                    {
                        @unlink(Yii::app()->basePath . '/../' . $model->image);
                        $model->image = $this->getUploadBase('flink') . $filename;
                        $model->save();
                    }
                }
                Yii::app()->user->setFlash('success',"友情链接“{$model->name}”已成功修改！");
				$this->redirect(array('index'));
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
		$model=new Flink('search');
		if(isset($_GET['Flink']))
			$model->attributes=$_GET['Flink'];

		$this->render('index',array(
			'model'=>$model,
		));
	}
	
	public function actionOperate()
	{
		if(Yii::app()->request->isAjaxRequest && !empty($_POST['id']))
		{
			if($_POST['operation'] == 'check')
			{
				Flink::model()->updateByPk($_POST['id'], array('enabled'=>$_POST['opcheck']));
			}
			if($_POST['operation'] == 'index')
			{
				Flink::model()->updateByPk($_POST['id'], array('indexed'=>$_POST['opindex']));
			}
			elseif($_POST['operation'] == 'delete')
			{
				$objs = Flink::model()->findAllByPk($_POST['id']);
				if($objs)
				{
					foreach($objs as $obj)
					{
						$obj->delete();
					}
				}
			}

			echo '操作成功！';
		}
	}
	
	public function actionCheck()
	{
		$start = isset($_GET['start']) ? intval($_GET['start']) : 0;
		$link = Flink::model()->find(array('order'=>'id ASC', 'condition'=>"id > $start"));
		$this->showHead();
		if($link !== null)
		{
			$this->showmsg('检查友情链接 '.$link->name. ' ...');
			$this->showmsg('下载页面 '.$link->url .'...');
			$html = UtilHelper::getpage($link->url);
			$this->showmsg('下载页面 '.(stripos($html, '<title>') !== false ? '成功':'失败').'!');
			
			if(preg_match('%<a[^>]*href="http://www\.steelzx\.com"[^>]*>.*?</a>%si', $html))
			{
				$link->enabled = 1;
				$link->save();
				$this->showmsg('发现有效链接 ...');
			}
			else
			{
				$link->enabled = 0;
				$link->save();
				$this->showmsg('没有发现有效链接 ...');
			}
			$this->showmsg('<script>setTimeout(\'window.location.href="'.$this->createUrl('check', array('start'=>$link->id)).'";\', 2000);</script>');
		}
		else
		{
			$this->showmsg('完成检查！');
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
				$this->_model=Flink::model()->findbyPk($_GET['id']);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='flink-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	protected function showmsg($msg, $exit = false)
    {
        echo '<br />'.$msg;
        echo '<script type="text/javascript">document.documentElement.scrollTop=document.documentElement.scrollHeight</script>';
        flush();
        if($exit) exit();
    }
    
    protected function showHead()
    {
        echo '
        <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>检查友情链接投放</title>
<style type="text/css">
    body { background: none repeat scroll 0 0 #F0F7FF; font-size:12px; line-height:200%;}
</style>
</head>

<body>
        ';
    }
}
