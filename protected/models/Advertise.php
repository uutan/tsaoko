<?php

/**
 * @version $Id: Advertise.php 3894 2012-10-31 14:42:54Z lonestone $
 * 
 * This is the model class for table "{{advertise}}".
 *
 * The followings are the available columns in table '{{advertise}}':
 * @property integer $id
 * @property integer $position_id
 * @property integer $template_id
 * @property string $name
 * @property string $template
 * @property string $data
 * @property integer $display_count
 * @property integer $enabled
 * @property string $created
 * @property date $valid_start
 * @property date $valid_end
 */
class Advertise extends ActiveRecord
{
	public $modelName = '广告';
	
	const ENABLED_YES = '启用';
	const ENABLED_NO = '禁用';
	
	public function __toString()
	{
		return $this->name;
	}
	
	protected function beforeSave()
	{
		if($this->isNewRecord)
		{
			$this->created = date('Y-m-d H:i:s');
		}
		else
		{
		}
		return parent::beforeSave();
	}
	
	/**
	 * Returns the static model of the specified AR class.
	 * @return Advertise the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	protected function afterFind()
	{
		$this->data = unserialize($this->data);
		parent::afterFind();
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{advertise}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('position_id, template_id, name, data, valid_start, valid_end', 'required'),
			array('position_id,template_id,brand_id, display_count', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>90),
			array('enabled', 'length', 'max'=>30),
			array('valid_start, valid_end', 'type', 'type'=>'date', 'dateFormat'=>'yyyy-MM-dd', 'message'=>'{attribute} 必须是日期.'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, position_id, name, data, display_count, enabled, created', 'safe', 'on'=>'search'),
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
			'template'=>array(self::BELONGS_TO, 'AdvertiseTemplate', 'template_id'),
			'position'=>array(self::BELONGS_TO, 'AdvertisePosition', 'position_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'position_id' => '广告位',
			'template_id' => '广告模板',
			'name' => '广告名称',
			'data' => '模板数据',
			'display_count' => '显示次数',
			'enabled' => '是否有效',
			'created' => '发布时间',
			'valid_start' => '有效期始',
			'valid_end' => '有效期止',
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

		$criteria->compare('position_id',$this->position_id);
		
		$criteria->compare('template_id',$this->template_id);

		$criteria->compare('name',$this->name,true);

		$criteria->compare('data',$this->data,true);

		$criteria->compare('display_count',$this->display_count);

		$criteria->compare('enabled',$this->enabled);

		$criteria->compare('created',$this->created,true);

		return new CActiveDataProvider('Advertise', array(
			'criteria'=>$criteria,
			'pagination'=>array('pageSize'=>10, ),
            'sort' => array('defaultOrder' => 't.id DESC'),
		));
	}
	
	public function getClickStats()
	{
	    $stats = array();
	    if(is_array($this->data))
	    {
    		foreach($this->data as $name=>$value)
    		{
    			if(strpos($name, '跳转地址') !== false)
    			{
    				$adv = AdvertiseClick::model()->findByAttributes(array('url'=>$value));
    				if($adv!==null) 
    					$click = $adv->click_count;
    				else
    					$click = 0;
    					
    				$stats[$value] = "点击 $click 次";
    			}
    		}
	    }
		return $stats;
	}
}