<?php

class ArticleController extends Controller
{

	public $indexNumber = 2;

	public function actionIndex()
	{
		$this->layout = 'column2';

		$id = isset($_GET['id']) ? intval($_GET['id']) : '48';
		$ids[] = $id;

		$data['cate'] = ArticleCategory::model()->findByPk($id);


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

}