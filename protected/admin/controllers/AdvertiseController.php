<?php
/**
 * @version $Id: AdvertiseController.php 4123 2012-12-08 15:18:37Z lonestone $
 */

class AdvertiseController extends Controller
{
	/**
	 * @var CActiveRecord the currently loaded data model instance.
	 */
	private $_model;
	
	public function actionIndex()
	{
		$model=new Advertise('search');
		$model->unsetAttributes();
		if(isset($_GET['Advertise']))
			$model->attributes=$_GET['Advertise'];

		$this->render('index',array(
			'model'=>$model,
		));
	}
	
	public function actionCreate()
	{
		$model=new Advertise();
		
		$this->performAjaxValidation($model);
		
		if(isset($_POST['Advertise']))
		{
			$model->attributes = $_POST['Advertise'];
			$model->data = serialize($_POST['data']);
			if($model->save())
			{
				Yii::app()->user->setFlash('success', "广告已成功添加！");
				$this->redirect(array('view','id'=>$model->id));
			}
			else
				print_r($model->errors);
		}
		
		$this->render('create',array(
			'model'=>$model, 
		));
	}
	
	public function actionUpdate()
	{
		$model=$this->loadModel();
		
		$this->performAjaxValidation($model);
		
		if(isset($_POST['Advertise']))
		{
			$model->attributes = $_POST['Advertise'];
			$model->data = serialize($_POST['data']);
			if($model->save())
			{
				Yii::app()->user->setFlash('success', "广告已成功修改！");
				$this->redirect(array('view','id'=>$model->id));
			}
			else
				print_r($model->errors);
		}
		
		$this->render('update',array(
			'model'=>$model, 
		));
	}
	
	/**
	 * Displays a particular model.
	 */
	public function actionView()
	{
		$this->render('view',array(
			'model'=>$this->loadModel(),
		));
	}
	
	public function actionTemplate_description()
	{
		$this->layout = 'none';
		$temp = AdvertiseTemplate::model()->findByPk($_POST['template_id']);
		if($temp !== null)
			echo $temp->description;
	}
	
	public function actionTemplate_data()
	{
		$this->layout = 'none';
		$temp = AdvertiseTemplate::model()->findByPk($_POST['template_id']);
		
		if(isset($_POST['id']) && $_POST['id']) 
		{
			$advertise = Advertise::model()->findByPk($_POST['id']);
			$data = $advertise->data;
		}
		
		if($temp !== null)
		{
			//分析模板中的占位符
			$matches = array();
			$mc = preg_match_all('/<\{(.+?)\}>/', $temp->template, $matches);
			if(!$mc)
			{
				echo '此模板不需要任何数据';
				Yii::app()->end();
			}
			echo '<table width="100%">';
			foreach(array_unique($matches[1]) as $index=>$token)
			{
				echo '<tr>';
				echo '<td>';
					echo $token . '：'.CHtml::textField("data[$token]", isset($data) ? $data[$token] : '', array('size'=>40, 'id'=>'data_filed_'.$index));
					if(strpos($token, '文件')!==false) echo '&nbsp;'.CHtml::link('上传新文件', array('advertise/uploadfile', 'target'=>'data_filed_'.$index), array('rel'=>'fancybox', 'class'=>'iframe'));
				echo '</td>';
				echo '</tr>';
			}
			echo '</table>';
		}
	}
	
	public function actionUploadfile()
	{
		$this->layout = 'none';
		$viewdata = array();
		
		if(Yii::app()->request->isPostRequest)
		{
			try
			{
				$file = CUploadedFile::getInstanceByName('attach');
				if($file)
				{
					$ext_arr = array('gif', 'jpg', 'png', 'swf');
					$max_size = 400*1024;
					
					if($file->size > $max_size)
						throw new CException('文件超过了允许的大小');
					
					if(!in_array(strtolower($file->extensionName), $ext_arr))
						throw new CException('文件格式不允许');
					
					$dir = '/static/adfiles/'.date('Y-m').'/';
					
					if(!is_dir($truedir = Yii::app()->basePath.'/..'. $dir))
						FileHelper::mkdirs($truedir);
		
					$filepath = $dir .time() . rand(1000,9999) .'.'. $file->extensionName;
					$filename = Yii::app()->basePath. '/..' . $filepath;
					$file->saveAs($filename);
					
					$viewdata['filepath'] = $filepath;
					$viewdata['target'] = $_POST['target'];
					$viewdata['success'] = true;
				}
			}
			catch(CException $ex)
			{
				$viewdata['message'] = $ex->getMessage();
			}
		}
		
		$this->render('uploadfile', $viewdata);
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
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 */
	public function loadModel()
	{
		if($this->_model===null)
		{
			if(isset($_GET['id']))
				$this->_model=Advertise::model()->findbyPk($_GET['id']);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='advertise-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}