<?php

class ServiceController extends Controller
{
	public $indexNumber = 5;

	public function actionIndex()
	{
		$this->layout = 'column2';

		$id = isset($_GET['id']) ? intval($_GET['id']) : 51;
		$ids[] = $id;


		$cr = new CDbCriteria;
		$cr->compare('ischecked',1);

		foreach(ArticleCategory::getSubOptions($id) as $cid => $cname)
		{
			$ids[] = $cid;
		}

		$cr->addInCondition('cate_id',$ids);


		$order = 'id DESC';

        $dataProvider = new CActiveDataProvider('Article', array('criteria' => $cr,
            'pagination' => array('pageSize' => 15, 'pageVar' => 'page'),
            'sort' => array('defaultOrder' => $order, 'sortVar' => 'sort')
                )
        );
        
        $data['dataProvider'] = $dataProvider;


		$this->render('index',$data);
	}

	public function actionView($id)
	{

		$model = Article::model()->findByPk($id, 'ischecked = :is_checked', array(':is_checked'=>1));
		
		if( $model === null )
		{
			throw new CHttpException(404,'您要浏览的页面不存在，可能是已被删除或者URL地址错误。');
		}

		$data['model'] = $model;

		Article::model()->updateByPk($model->id, array('views'=>$model->views+1));


		$this->render('view',$data);
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