<?php

class PageController extends Controller
{


	public function actionIndex()
	{
		$name = isset($_GET['name']) ? $_GET['name'] : '';

		if( $name )
		{
			$model = page::model()->find('name = :name', array(':name'=>$name));
		}else{
			$model = page::model()->find();
		}
		if( $model === null )
		{
			throw new CHttpException(404,'您要浏览的页面不存在，可能是已被删除或者URL地址错误。');
		}

		$data['model'] = $model;
		$data['name'] = $name;


		$this->render('index',$data);
	}



}