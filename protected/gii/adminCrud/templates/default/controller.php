<?php
/**
 * Author: UUTAN(uutan@qq.com)
 * 
 * 后台生成的控制器
 * 
 * - $this: the CrudCode object
 */

if ( false === function_exists('lcfirst') ): 
    function lcfirst( $str ) 
    { return (string)(strtolower(substr($str,0,1)).substr($str,1));} 
endif; 

$files = array();
foreach($this->tableSchema->columns as $column)
{
	if($column->type==='string' && $this->checkExists($column->name, $this->image_fields))
		$files[] = $column->name;
	if($column->type==='string' && $this->checkExists($column->name, $this->file_fields))
		$files[] = $column->name;
}

?>
<?php echo "<?php\n"; ?>

/**
 * Author: UUTAN(uutan@qq.com)
 * 
 * 后台生成的控制器
 * 
 * - $this: the CrudCode object
 * - $time: <?php echo date('Y-m-d H:i:s')."\n"; ?>
 *
 */

class <?php echo $this->controllerClass; ?> extends Controller
{

	/**
	 * @var CActiveRecord the currently loaded data model instance.
	 */
	private $_model;

	public $pageTitle = "XX管理";


    /**
     * 查看单条记录
     * 
     * @return [type] [description]
     */
	public function actionView()
	{
		$this->render('view',array(
			'model'=>$this->loadModel(),
		));
	}

	/**
	 * 添加数据
	 * 
	 * @return [type] [description]
	 */
	public function actionCreate()
	{
		$form = new Form('backend.views.<?php echo lcfirst($this->modelClass); ?>.formConfig');
	    $form->model = new <?php echo $this->modelClass; ?>;
	    
		if(isset($_POST['ajax']) && $_POST['ajax']==='edit-form')
		{
			echo CActiveForm::validate($form->model);
			Yii::app()->end();
		}
		
	    if($form->submitted('btnsubmit'))
	    {
<?php if(empty($files)) echo "\t\t\t/**\n"; ?>
			$images = array ('<?php echo implode("','", $files); ?>');
			
			foreach ( $images as $name ) 
			{
				$image = CUploadedFile::getInstance ( $form->model, $name );
				if ($image) {
					$filename = time () . rand ( 1000, 9999 ) . '.' . $image->getExtensionName ();
					
					$dir = '/upload/' . $name . '/' . date ( 'Ym' ) . '/';
					if (! file_exists ( Yii::app ()->basePath . '/..' . $dir ))
						FileHelper::mkdirs ( Yii::app ()->basePath . '/..' . $dir );
					
					$filepath = Yii::app ()->basePath . '/..' . $dir . $filename;
					if ($image->saveAs ( $filepath )) {
						$form->model->$name = $dir . $filename;
					
					}
				}
				unset ( $_POST [get_class ( $form->model )] [$name] );
			}
<?php if(empty($files)) echo "\t\t\t*/\n"; ?>
			
	    	if($form->validate())
	    	{
		        $model = $form->model; 
		        if($model->save(false))
		        {
		        	Yii::app()->user->setFlash('success', <?php echo $this->modelClass; ?>::model()->modelName."“{$model}”已成功添加！");
					$this->redirect(array('view','id'=>$model->id));
				}
	    	}
<?php if(empty($files)) echo "\t\t\t/**\n"; ?>
	    	else 
	    	{
	    		//表单验证失败，则删除已上传的文件
	    		foreach ( $images as $name ) 
	    		{
	    			@unlink(Yii::app ()->basePath . '/..' .$form->model->$name);
	    		}
	    	}
<?php if(empty($files)) echo "\t\t\t*/\n"; ?>
	    }

		$this->render('create',array(
			'form'=>$form,
		));
	}


	/**
	 * 更新数据
	 * 
	 * @return [type] [description]
	 */

	public function actionUpdate()
	{
		$form = new Form('backend.views.<?php echo lcfirst($this->modelClass); ?>.formConfig');
	    $form->model = $this->loadModel();
	    
		if(isset($_POST['ajax']) && $_POST['ajax']==='edit-form')
		{
			echo CActiveForm::validate($form->model);
			Yii::app()->end();
		}
		
<?php if(empty($files)) echo "\t\t\t/**\n"; ?>
		$images = array ('<?php echo implode("','", $files); ?>');//要上传的文件
		//必须在 submitted 方法之前 unset掉，否则如果不上传新文件，老文件将丢失
		foreach($images as $name) unset ( $_POST [get_class ( $form->model )] [$name] );
<?php if(empty($files)) echo "\t\t\t*/\n"; ?>
		
		if($form->submitted('btnsubmit'))
	    {
<?php if(empty($files)) echo "\t\t\t\t/**\n"; ?>
			$old_images = array();//记录旧文件
			foreach ( $images as $name ) 
			{
				$image = CUploadedFile::getInstance ( $form->model, $name );
				if ($image) {
					$filename = time () . rand ( 1000, 9999 ) . '.' . $image->getExtensionName ();
					
					$dir = '/upload/' . $name . '/' . date ( 'Ym' ) . '/';
					if (! file_exists ( Yii::app ()->basePath . '/..' . $dir ))
						FileHelper::mkdirs ( Yii::app ()->basePath . '/..' . $dir );
					
					$filepath = Yii::app ()->basePath . '/..' . $dir . $filename;
					if ($image->saveAs ( $filepath )) {
						$old_images[] = $form->model->$name;
						$form->model->$name = $dir . $filename;
					}
				}
			}
<?php if(empty($files)) echo "\t\t\t\t*/\n"; ?>
			
	    	if($form->validate())
	    	{
		        $model = $form->model; 
		        if($model->save(false))
		        {
<?php if(empty($files)) echo "\t\t\t\t/**\n"; ?>
		        	//删除掉旧文件
		        	foreach($old_images as $oldimg)
		        	{
		        		@unlink(Yii::app ()->basePath . '/..' .$oldimg);
		        	}
		        	<?php if(empty($files)) echo '*/'; ?>
		        	
		        	Yii::app()->user->setFlash('success',<?php echo $this->modelClass; ?>::model()->modelName."“{$model}”已成功修改！");
					$this->redirect(array('view','id'=>$model->id));
				}
	    	}
<?php if(empty($files)) echo "\t\t\t/**\n"; ?>
	    	else 
	    	{
	    		//表单验证失败，则删除已上传的新文件
	    		foreach ( $images as $name ) 
	    		{
	    			@unlink(Yii::app ()->basePath . '/..' .$form->model->$name);
	    		}
	    	}
<?php if(empty($files)) echo "\t\t\t*/\n"; ?>
	    }

		$this->render('update',array(
			'form'=>$form,
		));
	}


	/**
	 * 删除数据
	 * 
	 * @return [type] [description]
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
	 * 数据列表管理
	 * 
	 * @return [type] [description]
	 */
	public function actionIndex()
	{
		$model=new <?php echo $this->modelClass; ?>('search');
		$model->unsetAttributes();
		if(isset($_GET['<?php echo $this->modelClass; ?>']))
			$model->attributes=$_GET['<?php echo $this->modelClass; ?>'];

		$this->render('index',array(
			'model'=>$model,
		));
	}
    

	/**
	 * 多元条件数据扩展操作
	 * 
	 * @return [type] [description]
	 */    
	public function actionOperate()
	{
		if(Yii::app()->request->isAjaxRequest && !empty($_POST['id']))
		{
			if($_POST['operation'] == 'delete')
			{
				$objs = <?php echo $this->modelClass; ?>::model()->findAllByPk($_POST['id']);
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


	/**
	 * 接收指定数据
	 * 
	 * @return [type] [description]
	 */
	public function loadModel()
	{
		if($this->_model===null)
		{
			if(isset($_GET['id']))
				$this->_model=<?php echo $this->modelClass; ?>::model()->findbyPk($_GET['id']);
			if($this->_model===null)
				throw new CHttpException(404,'您要浏览的页面不存在，可能是已被删除或者URL地址错误。');
		}
		return $this->_model;
	}


	/**
	 * 添加/更新时验证数据
	 * 
	 * @return [type] [description]
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='<?php echo $this->class2id($this->modelClass); ?>-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

}

