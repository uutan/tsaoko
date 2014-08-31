<?php

/**
 * @version $Id: AdvertisePosition.php 3560 2012-08-22 04:43:50Z lonestone $
 * 
 * This is the model class for table "{{advertise_position}}".
 *
 * The followings are the available columns in table '{{advertise_position}}':
 * @property integer $id
 * @property integer $name
 * @property string $type
 * @property integer $width
 * @property integer $height
 * @property integer $price
 * @property string $intro
 */
class AdvertisePosition extends ActiveRecord
{
	public $modelName = '广告位';
	
	const TYPE_SINGLE = '独占广告';
	const TYPE_MULTIPLE = '共存广告';
	
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
	 * @return AdvertisePosition the static model class
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
		return '{{advertise_position}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, type, width, height', 'required'),
			array('width, height, price', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>90),
			array('type', 'length', 'max'=>30),
			array('intro', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, type, width, height, price', 'safe', 'on'=>'search'),
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
			'name' => '广告位名称',
			'type' => '广告类型',
			'width' => '宽度',
			'height' => '高度',
			'price' => '价格',
			'intro' => '介绍',
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

		$criteria->compare('type',$this->type);

		$criteria->compare('width',$this->width);

		$criteria->compare('height',$this->height);

		$criteria->compare('price',$this->price);

		return new CActiveDataProvider('AdvertisePosition', array(
			'criteria'=>$criteria,
			'pagination'=>array('pageSize'=>10, ),
            'sort' => array('defaultOrder' => 't.id DESC'),
		));
	}
	
	public function getLabel()
	{
		return "{$this->name}（{$this->type}，尺寸{$this->width}×{$this->height}）";
	}
}