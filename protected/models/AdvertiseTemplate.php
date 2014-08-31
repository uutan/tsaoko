<?php

/**
 * @version $Id: AdvertiseTemplate.php 3560 2012-08-22 04:43:50Z lonestone $
 * 
 * This is the model class for table "{{advertise_template}}".
 *
 * The followings are the available columns in table '{{advertise_template}}':
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property string $template
 */
class AdvertiseTemplate extends ActiveRecord
{
	public $modelName = '广告模板';
	
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
	 * Returns the static model of the specified AR class.
	 * @return AdvertiseTemplate the static model class
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
		return '{{advertise_template}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, description, template', 'required'),
			array('id', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>90),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, description, template', 'safe', 'on'=>'search'),
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
			'name' => '模板名称',
			'description' => '模板简介',
			'template' => '模板代码',
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

		$criteria->compare('name',$this->name,true);

		$criteria->compare('description',$this->description,true);

		$criteria->compare('template',$this->template,true);

		return new CActiveDataProvider('AdvertiseTemplate', array(
			'criteria'=>$criteria,
			'pagination'=>array('pageSize'=>10, ),
            'sort' => array('defaultOrder' => 't.id DESC'),
		));
	}
}