<?php

/**
 * @version $Id: AdvertiseClick.php 3560 2012-08-22 04:43:50Z lonestone $
 * 
 * This is the model class for table "{{advertise_click}}".
 *
 * The followings are the available columns in table '{{advertise_click}}':
 * @property integer $id
 * @property string $url
 * @property integer $click_count
 */
class AdvertiseClick extends ActiveRecord
{
	public $modelName = '广告点击记录';
	
	public function __toString()
	{
		return $this->url;
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
	 * @return AdvertiseClick the static model class
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
		return '{{advertise_click}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('url, click_count', 'required'),
			array('click_count', 'numerical', 'integerOnly'=>true),
			array('url', 'length', 'max'=>300),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, url, click_count', 'safe', 'on'=>'search'),
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
			'url' => '广告跳转地址',
			'click_count' => '点击次数',
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

		$criteria->compare('url',$this->url,true);

		$criteria->compare('click_count',$this->click_count);

		return new CActiveDataProvider('AdvertiseClick', array(
			'criteria'=>$criteria,
			'pagination'=>array('pageSize'=>10, ),
            'sort' => array('defaultOrder' => 't.id DESC'),
		));
	}
}