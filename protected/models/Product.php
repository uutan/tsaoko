<?php

/**
 * This is the model class for table "product".
 *
 * The followings are the available columns in table 'product':
 * @property integer $id
 * @property integer $photo_id
 * @property string $unit
 * @property string $market_price
 * @property string $member_price
 * @property integer $number
 * @property integer $status
 * @property integer $created
 * @property integer $updated
 * @property integer $user_id
 * @property integer $category_id
 * @property string $title
 * @property string $type
 * @property string $standard
 * @property string $brand
 * @property string $content
 * @property integer $is_del
 * @property integer $views
 * @property integer $is_rec
 */
class Product extends CActiveRecord
{
	public $modelName = '产品';
	
	public function __toString()
	{
		return $this->title;
	}
	
	protected function beforeSave()
	{
		if($this->isNewRecord)
		{
			$this->created = date('Y-m-d H:i:s');
			$this->updated = date('Y-m-d H:i:s');
		}
		else
		{
			$this->updated = date('Y-m-d H:i:s');
		}
		return parent::beforeSave();
	}
	

    /**
     * 获取首图
     */
    public function getHomeimage()
    {
        return $this->image;
    }	

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'product';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('unit, title, type, standard, brand, content', 'required'),
			array('photo_id, number, status, created, updated, user_id, category_id, is_del, views, is_rec', 'numerical', 'integerOnly'=>true),
			array('unit, market_price, member_price', 'length', 'max'=>10),
			array('title,image', 'length', 'max'=>255),
			array('type, brand', 'length', 'max'=>100),
			array('standard', 'length', 'max'=>200),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, photo_id, unit, market_price, member_price, number, status, created, updated, user_id, category_id, title, type, standard, brand, content, is_del, views, is_rec', 'safe', 'on'=>'search'),
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
			'category' => array(self::BELONGS_TO,'ProductCategory','category_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'photo_id' => '图片ID',
			'unit' => '单位',
			'market_price' => '市场价格',
			'member_price' => '会员价格',
			'number' => '库存',
			'status' => '状态',
			'created' => '添加时间',
			'updated' => '修改时间',
			'user_id' => '添加人',
			'category_id' => '分类',
			'title' => '标题',
			'type' => '型号',
			'standard' => '规格 ',
			'brand' => '品牌',
			'content' => '说明',
			'is_del' => '删除',
			'views' => '查看次数',
			'is_rec' => '推荐',
			'image' => '首图',
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
		$criteria->compare('photo_id',$this->photo_id);
		$criteria->compare('unit',$this->unit,true);
		$criteria->compare('market_price',$this->market_price,true);
		$criteria->compare('member_price',$this->member_price,true);
		$criteria->compare('number',$this->number);
		$criteria->compare('status',$this->status);
		$criteria->compare('created',$this->created);
		$criteria->compare('updated',$this->updated);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('category_id',$this->category_id);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('standard',$this->standard,true);
		$criteria->compare('brand',$this->brand,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('is_del',$this->is_del);
		$criteria->compare('views',$this->views);
		$criteria->compare('is_rec',$this->is_rec);

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
	 * @return Product the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
