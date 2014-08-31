<?php

/**
 * This is the model class for table "about".
 *
 * The followings are the available columns in table 'about':
 * @property integer $id
 * @property string $name
 * @property string $cate
 * @property string $title
 * @property string $content
 */
class About extends CActiveRecord
{
	public $modelName = '关于我们';
	
	public function __toString()
	{
		return $this->name;
	}


	/**
	 * 分类
	 * 
	 * @return Ambigous <multitype:, multitype:unknown mixed , mixed, multitype:unknown , string, unknown>
	 */
	public static function cateOptions()
	{
		$cr = new CDbCriteria();
		$cr->select = 'cate';
		$cr->group = 'cate';
		$cr->order = 'id ASC';
		return CHtml::listData(self::model()->findAll($cr), 'cate','cate');
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
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'about';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, cate, title, content', 'required'),
			array('name, cate', 'length', 'max'=>50),
			array('title', 'length', 'max'=>90),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, cate, title, content', 'safe', 'on'=>'search'),
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
			'name' => 'URI名称',
			'cate' => '分类',
			'title' => '标题',
			'content' => '内容',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('cate',$this->cate,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('content',$this->content,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array('pageVar'=>'page', 'pageSize'=>10),
			'sort'=>array('defaultOrder'=>'id DESC'),
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return About the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
