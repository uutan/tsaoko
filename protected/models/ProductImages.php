<?php

/**
 * This is the model class for table "product_images".
 *
 * The followings are the available columns in table 'product_images':
 * @property string $id
 * @property string $product_id
 * @property integer $ishome
 * @property string $image
 * @property string $sortnum
 * @property string $sk
 */
class ProductImages extends CActiveRecord
{
	public $modelName = '名称';
	
	public function __toString()
	{
		throw new Exception("无法将模型转化为字符串");
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
		return 'product_images';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('image, sk', 'required'),
			array('ishome', 'numerical', 'integerOnly'=>true),
			array('product_id, sortnum', 'length', 'max'=>10),
			array('image', 'length', 'max'=>255),
			array('sk', 'length', 'max'=>20),
			array('image', 'file', 'allowEmpty'=>true, 'types'=>'jpg, gif, png', 'maxSize'=>2048*1024, 'safe'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, product_id, ishome, image, sortnum, sk', 'safe', 'on'=>'search'),
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
			'product_id' => '商品',
			'ishome' => '是否为首图',
			'image' => '图片',
			'sortnum' => '排序',
			'sk' => 'Sk',
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

		$criteria->compare('id',$this->id,true);
		$criteria->compare('product_id',$this->product_id,true);
		$criteria->compare('ishome',$this->ishome);
		$criteria->compare('image',$this->image,true);
		$criteria->compare('sortnum',$this->sortnum,true);
		$criteria->compare('sk',$this->sk,true);

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
	 * @return ProductImages the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
