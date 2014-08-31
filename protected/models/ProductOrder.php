<?php

/**
 * This is the model class for table "product_order".
 *
 * The followings are the available columns in table 'product_order':
 * @property integer $id
 * @property integer $product_id
 * @property string $linkman
 * @property string $phone
 * @property string $email
 * @property string $content
 * @property integer $created
 * @property integer $is_replay
 */
class ProductOrder extends CActiveRecord
{

	public $modelName = '订单表';

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'product_order';
	}


	public function beforeSave()
	{
		
		if( $this->isNewRecord )
		{
			$this->created = time();
		}

		return parent::beforeSave();
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('product_id, linkman, phone, content', 'required'),
			array('product_id, created, is_replay', 'numerical', 'integerOnly'=>true),
			array('linkman, phone', 'length', 'max'=>20),
			array('email', 'length', 'max'=>50),
			array('email','email'),
			array('phone','checkmobile'),

			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, product_id, linkman, phone, email, content, created, is_replay', 'safe', 'on'=>'search'),
		);
	}

    /**
     * 验证手机号
     * 
     * @param type $attribute
     * @param type $params
     */
    public function checkmobile($attribute, $params)
    {

        if ($this->phone && !preg_match("/^13[0-9]{1}[0-9]{8}$|15[0123589]{1}[0-9]{8}$|18[0-9]{1}[0-9]{8}$/", $this->phone))
        {
            $this->addError('phone', '手机号码格式不正确。');
        }
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
			'product_id' => '所属产品',
			'linkman' => '联系人',
			'phone' => '手机号',
			'email' => '邮箱',
			'content' => '内容',
			'created' => '订单时间',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('product_id',$this->product_id);
		$criteria->compare('linkman',$this->linkman,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('created',$this->created);
		$criteria->compare('is_replay',$this->is_replay);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ProductOrder the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
