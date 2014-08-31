<?php

class AboutController extends Controller
{

	public $layout = 'column2';

	public function actionIndex()
	{
		$name = isset($_GET['name']) ? $_GET['name'] : '';

		if( $name )
		{
			$model = About::model()->find('name = :name', array(':name'=>$name));
		}else{
			$model = About::model()->find();
		}
		if( $model === null )
		{
			throw new CHttpException(404,'您要浏览的页面不存在，可能是已被删除或者URL地址错误。');
		}

		$data['model'] = $model;


		$this->render('index',$data);
	}

	public function actionView()
	{
		$this->render('view');
	}

	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}