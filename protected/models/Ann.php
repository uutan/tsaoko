<?php

/**
 * This is the model class for table "ann".
 *
 * The followings are the available columns in table 'ann':
 * @property integer $id
 * @property string $title
 * @property string $content
 * @property integer $created
 * @property integer $updated
 * @property integer $is_checked
 */
class Ann extends CActiveRecord
{
	public $modelName = '公告';
	
	public function __toString()
	{
		return $this->title;
	}
	
	protected function beforeSave()
	{
		if($this->isNewRecord)
		{
			$this->created = time();
			$this->updated = time();
		}
		else
		{
			$this->updated = time();
		}
		return parent::beforeSave();
	}
	

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'ann';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, content', 'required'),
			array('created, updated, is_checked', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, title, content, created, updated, is_checked', 'safe', 'on'=>'search'),
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
			'title' => '标题',
			'content' => '内容',
			'created' => '添加时间',
			'updated' => '更新时间',
			'is_checked' => '审核状态',
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
		$criteria->compare('title',$this->title,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('created',$this->created);
		$criteria->compare('updated',$this->updated);
		$criteria->compare('is_checked',$this->is_checked);

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
	 * @return Ann the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
