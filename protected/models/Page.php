<?php

/**
 * This is the model class for table "page".
 *
 * The followings are the available columns in table 'page':
 * @property integer $id
 * @property string $category
 * @property string $title
 * @property string $content
 * @property string $name
 */
class Page extends ActiveRecord
{
	public $modelName = '页面';
	
	const CATEGORY_1 = '关于我们';
	const CATEGORY_2 = '客户支持';
	const CATEGORY_3 = '工单管理';

	const CATEGORY_4 = '技术服务';
	const CATEGORY_5 = '技术支持';
	const CATEGORY_6 = '软件销售';
		
	/**
	 * 动态分类内容
	 * 
	 * @return [type] [description]
	 */
	public static function cates()
	{
		$str = Yii::app()->config->get('page_category');
		$strArray = explode("\n", $str);
		$data = array();
		foreach($strArray as $key)
		{
			$key = trim($key);
			if($key && !in_array($key,$data))
			{
				$data[$key] = $key;
			}
		}
		return $data;
	}
	
	public function __toString()
	{
		return $this->title;
	}
	
	/**
	 * Returns the static model of the specified AR class.
	 * @return Page the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'page';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('category, title, content, name', 'required'),
			array('category', 'length', 'max'=>30),
			array('title', 'length', 'max'=>90),
			array('name', 'length', 'max'=>100),
			array('name', 'match', 'pattern'=>'/^[a-zA-Z0-9]+$/', 'message'=>'{attribute} 必须是字母、数字的组合'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, category, title, content', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'category' => '类别',
			'title' => '页面标题',
			'content' => '页面内容',
			'name' => 'URL名称',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);

		$criteria->compare('category',$this->category,true);

		$criteria->compare('title',$this->title,true);

		$criteria->compare('content',$this->content,true);

		return new CActiveDataProvider('Page', array(
			'criteria'=>$criteria,
			'pagination'=>array('pageSize'=>10, ),
            'sort' => array('defaultOrder' => 't.id DESC'),
		));
	}
}