<?php

/**
 * This is the model class for table "adv".
 *
 * The followings are the available columns in table 'adv':
 * @property string $id
 * @property string $name
 * @property string $gender
 * @property string $mobile
 * @property string $content
 * @property string $email
 * @property string $created
 * @property string $updated
 * @property string $replay
 * @property integer $is_replay
 */
class Adv extends ActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'adv';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, gender, mobile, content, email, replay', 'required'),
			array('is_replay', 'numerical', 'integerOnly'=>true),
			array('name, gender, created, updated', 'length', 'max'=>10),
			array('mobile', 'length', 'max'=>11),
			array('email', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, gender, mobile, content, email, created, updated, replay, is_replay', 'safe', 'on'=>'search'),
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
			'name' => '用户名',
			'gender' => '姓别',
			'mobile' => '手机号',
			'content' => '咨询内容',
			'email' => '邮箱',
			'created' => '添加时间',
			'updated' => '回复时间',
			'replay' => '回复内容',
			'is_replay' => '是否回复',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('gender',$this->gender,true);
		$criteria->compare('mobile',$this->mobile,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('updated',$this->updated,true);
		$criteria->compare('replay',$this->replay,true);
		$criteria->compare('is_replay',$this->is_replay);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Adv the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
