<?php

/**
 * This is the model class for table "{{article_category}}".
 *
 * The followings are the available columns in table '{{article_category}}':
 * @property integer $id
 * @property integer $parent_id
 * @property string $name
 * @property string $ultimate
 * @property string $keywords
 * @property string $description
 * @property integer $sortnum
 * @property integer $product_category_id
 */
class ArticleCategory extends CActiveRecord
{
	public $modelName = '分类';
	
	const COMMENT_ON = '开启评论';
	const COMMENT_OFF = '关闭评论';
	
	const ULTIMATE_YES = '是';
	const ULTIMATE_NO = '否';
	
	public function __toString()
	{
		return $this->name;
	}
	
	protected function beforeSave()
	{
		if($this->isNewRecord)
		{
		}
		else
		{
		}
		return parent::beforeSave();
	}
	
	
	/**
	 * 获取子分类列表
	 * @param unknown_type $parent_id
	 */
	public static function getSubOptions($parent_id = 0,$isArray = true)
	{
		$cr = new CDbCriteria();
		$cr->compare('parent_id', $parent_id);
		$cr->order = 'sortnum DESC,id ASC';
		$models = self::model()->findAll($cr);
		if($isArray)
		{
		return CHtml::listData($models, 'id','name');
		}
		else{
			return $models;
		}
	}

	public static function getAll()
	{
		$cr = new CDbCriteria();
		$cr->compare('parent_id',0);
		$cr->order = 'sortnum DESC';
		$models = self::model()->findAll($cr);
		$data = array();
		foreach($models as $item)
		{
			$data[$item->id] = $item->name;
			foreach($item->subsCategory as $sub)
			{
				$data[$sub->id] = $item->name.' / '.$sub->name;
				foreach($sub->subsCategory as $sub2)
				{
					$data[$sub2->id] = $item->name.' / '.$sub->name.' / '.$sub2->name;
				}
			}
		}
		return $data;
	}
	
	
	/**
	 * Returns the static model of the specified AR class.
	 * @return ArticleCategory the static model class
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
		return '{{article_category}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('parent_id, name, keywords, description, sortnum', 'required'),
			array('parent_id,product_category_id, sortnum', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>256),
			array('ultimate', 'length', 'max'=>30),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id,product_category_id, parent_id, name, keywords, description, sortnum', 'safe', 'on'=>'search'),
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
			'parent' => array(self::BELONGS_TO, 'ArticleCategory', 'parent_id'),
            'subsCategory' => array(self::HAS_MANY,'ArticleCategory','parent_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'parent_id' => '父类ID',
			'name' => '栏目名称',
			'ultimate' => '是否终极栏目',
			'keywords' => '列表页关键字',
			'description' => '栏目描述',
			'sortnum' => '排序数字',
			'product_category_id' => '关联商品分类',
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

		$criteria->compare('parent_id',$this->parent_id);

		$criteria->compare('name',$this->name,true);

		$criteria->compare('keywords',$this->keywords,true);

		$criteria->compare('description',$this->description,true);

		$criteria->compare('sortnum',$this->sortnum);

		return new CActiveDataProvider('ArticleCategory', array(
			'criteria'=>$criteria,
			'pagination'=>array('pageSize'=>10, ),
            'sort' => array('defaultOrder' => 't.parent_id ASC,t.sortnum ASC'),
		));
	}
	
	public function getHasChildren()
	{
		return self::model()->countByAttributes(array('parent_id'=>$this->id)) > 0 ? true : false;
	}
	
	public function getChildren()
	{
		return self::model()->findAllByAttributes(array('parent_id'=>$this->id));
	}
}