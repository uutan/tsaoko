<?php

class AnnController extends Controller
{

	public $indexNumber = 7;

	public function actionIndex()
	{

		$data = array();
		
		$cr = new CDbCriteria;
		$cr->compare('is_checked',1);

		$order = 'id DESC';

        $dataProvider = new CActiveDataProvider('Ann', array('criteria' => $cr,
            'pagination' => array('pageSize' => 15, 'pageVar' => 'page'),
            'sort' => array('defaultOrder' => $order, 'sortVar' => 'sort')
                )
        );
        $data['dataProvider'] = $dataProvider;


		$this->render('index',$data);
	}



	public function actionView($id)
	{
		$model = Ann::model()->findByPk($id, 'is_checked = :is_checked', array(':is_checked'=>1));
		
		if( $model === null )
		{
			throw new CHttpException(404,'您要浏览的页面不存在，可能是已被删除或者URL地址错误。');
		}

		$data['model'] = $model;

		$this->render('view',$data);
	}

}