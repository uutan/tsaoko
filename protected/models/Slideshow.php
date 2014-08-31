<?php

class Slideshow extends ActiveRecord
{
    public $modelName = '焦点图';
    
    
    public static function tokenOptions()
    {
    	$cr = new CDbCriteria();
    	$cr->select = 'token';
    	$cr->group = 'token';
    	$cr->order = 'id ASC';
    	return CHtml::listData(self::model()->findAll($cr), 'token','token');
    }
    
    
	/**
	 * The followings are the available columns in table '{{slideshow}}':
	 * @var integer $id
	 * @var string $title
	 * @var string $url
	 * @var string $image
	 * @var string $token
	 * @var string $desc
	 * @var integer $sortnum
	 * @var integer $created
	 */
    protected function beforeDelete()
    {
        parent::beforeDelete();
        if($this->image) @unlink(Yii::app()->basePath . '/../' . $this->image);
        return true;
    }

	/**
	 * Returns the static model of the specified AR class.
	 * @return CActiveRecord the static model class
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
		return '{{slideshow}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, url, token', 'required'),
			array('sortnum, created', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>90),
			array('url', 'length', 'max'=>100),
			array('desc','length','max'=>2000),
			array('token', 'length', 'max'=>50),
			array('background', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id,desc, title,background, url, image, token', 'safe', 'on'=>'search'),
			array('image', 'file', 'allowEmpty'=>true, 'types'=>'jpg, gif, png', 'maxSize'=>2048*1024, 'safe'=>true),
			array('created','default',
              'value'=>time(),
              'setOnEmpty'=>false,'on'=>'insert'),
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
			'url' => '链接地址',
			'image' => '图片',
			'desc' => '描述',
			'background' => '背景色',
			'token' => '识别符',
			'sortnum' => '排序数',
			'created' => '添加时间',
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

		$criteria->compare('title',$this->title,true);

		$criteria->compare('url',$this->url,true);

		$criteria->compare('image',$this->image,true);

		$criteria->compare('token',$this->token,true);

		return new CActiveDataProvider(get_class($this), array(
                    'criteria'=>$criteria,
                    'pagination'=>array(
                        'pageSize'=>5, 
                    ),
                    'sort' => array(
                        'defaultOrder' => 'id DESC'
                    )
                ));
	}
}