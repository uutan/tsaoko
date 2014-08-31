<?php

class ProductController extends Controller
{
	public $indexNumber = 3;
	public $layout = 'column2';

	public function actionIndex()
	{
		$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
		$ids[] = $id;


		$cr = new CDbCriteria;

		foreach(ProductCategory::getSubOptions($id) as $cid => $cname)
		{
			$ids[] = $cid;
			foreach(ProductCategory::getSubOptions($cid) as $csid => $csname)
			{
				$ids[] = $csid;
			}
		}

		$cr->addInCondition('category_id',$ids);


		$order = 'id DESC';

        $dataProvider = new CActiveDataProvider('Product', array('criteria' => $cr,
            'pagination' => array('pageSize' => 15, 'pageVar' => 'page'),
            'sort' => array('defaultOrder' => $order, 'sortVar' => 'sort')
                )
        );
        
        $data['dataProvider'] = $dataProvider;


		$this->render('index',$data);
	}

	public function actionView($id)
	{
		$this->layout = 'main';
		$model = Product::model()->findByPk($id);
		
		if( $model === null )
		{
			throw new CHttpException(404,'您要浏览的页面不存在，可能是已被删除或者URL地址错误。');
		}

		$data['model'] = $model;

		Product::model()->updateByPk($model->id, array('views'=>$model->views+1));

		// 相关产品列表
		$cr = new CDbCriteria;
		$cr->compare('category_id', $model->category_id);
		$cr->addNotInCondition('id',array($model->id));
		$cr->limit = 4;
		$data['products'] = Product::model()->findAll($cr);


		$this->render('view',$data);
	}


	/**
	 * 订单
	 * 
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
	public function actionOrder($id)
	{
		$this->layout = 'main';
		$model = Product::model()->findByPk($id);
		
		if( $model === null )
		{
			throw new CHttpException(404,'您要浏览的页面不存在，可能是已被删除或者URL地址错误。');
		}

		$data['model'] = $model;

		$order = new ProductOrder;
		$order->product_id = $model->id;

		if( isset($_POST['ProductOrder']) )
		{
			$order->attributes = $_POST['ProductOrder'];

			if( $order->save() )
			{

		        $this->render('//site/flash_message', array(
		            'message' => '添加成功，等待工程师与您联系。',
		            'redirect_url' => array('/site/index'),
		            'timeout' => '3000',
		        ));
		        Yii::app()->end();
			}
		}

		$data['order'] = $order;


		$this->render('order',$data);
	}

}