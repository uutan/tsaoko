<?php

/**
 * @version $Id: Flink.php 4123 2012-12-08 15:18:37Z lonestone $
 * 
 * The followings are the available columns in table '{{flink}}':
 * @var integer $id
 * @var string $category
 * @var string $name
 * @var string $url
 * @var string $remote_image
 * @var integer $onindex
 * @var integer $enabled
 * @var integer $created
 */
class Flink extends ActiveRecord
{
    public $modelName = '友链';
    
    const CATEGORY_INDEX = '首页链接';
    const CATEGORY_INNER = '内页链接';

    
    protected function beforeSave()
    {
    	if( !$this->category )
    	{
    		$this->category == Flink::CATEGORY_INDEX;
    	}
    	$this->created = time();

    	return parent::beforeSave();
    }

	protected function afterDelete()
    {
        parent::afterDelete();
        if($this->image) @unlink(Yii::app()->basePath . '/../' . $this->image);
        return true;
    }
    
    public function getSrc()
    {
        return ($this->remote_image ? $this->remote_image : $this->image);
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
		return '{{flink}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, url', 'required'),
			array('enabled', 'numerical', 'integerOnly'=>true),
			array('category', 'length', 'max'=>30),
			array('name', 'length', 'max'=>90),
			array('url, remote_image', 'length', 'max'=>100),
//			array('remote_image', 'length', 'max'=>150),
//			array('remote_image', 'url'),
			array('image', 'file', 'allowEmpty'=>true, 'types'=>'jpg, gif, png', 'maxSize'=>50*1024, 'safe'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, category, name, url, onindex, enabled, created', 'safe', 'on'=>'search'),
			array('created', 'default', 'value' => time (), 'setOnEmpty' => true, 'on' => 'insert' ), 
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
			'category' => '链接类型',
			'name' => '链接名称',
			'url' => '链接地址',
			'image' => '标识图片',
			'remote_image' => '远程标识图片',
			'description'=>'网站描述',
			'enabled' => '有效性',
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

		$criteria->compare('category',$this->category,true);

		$criteria->compare('name',$this->name,true);

		$criteria->compare('url',$this->url,true);
		
		$criteria->compare('enabled',$this->enabled);

		$criteria->compare('created',$this->created);

		return new CActiveDataProvider(get_class($this), array(
                    'criteria'=>$criteria,
                    'pagination'=>array(
                        'pageSize'=>10, 
                    ),
                    'sort' => array(
                        'defaultOrder' => 'id DESC'
                    )
                ));
	}
}