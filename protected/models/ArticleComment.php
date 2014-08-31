<?php

class ArticleComment extends CActiveRecord
{
    public $modelName = '资讯评论';

    const STATUS_PENDING=1;
    const STATUS_APPROVED=2;
    
	/**
	 * The followings are the available columns in table '{{acomment}}':
	 * @var integer $id
	 * @var integer $user_id
	 * @var integer $article_id
	 * @var string $content
	 * @var integer $created
	 * @var boolean $ischecked
	 */
    
	protected function beforeSave()
    {
        parent::beforeSave();
        $purifier = new CHtmlPurifier();
        $purifier->options = array(
            'HTML.TidyLevel' => 'medium',
            'HTML.ForbiddenElements'=>array('pre'),
            'HTML.SafeEmbed' => true,
            'HTML.SafeObject' => true,
            'Output.FlashCompat' => true,
            );
        $this->content = $purifier->purify($this->content);
        return true;
    }
    
    protected function afterDelete()
    {
        parent::afterDelete();
        $this->updateCount();
    }
    
    protected function afterSave()
    {
        parent::afterSave();
    	if($this->isNewRecord) //创建feed
        {

        }
        $this->updateCount();
    }

    private function updateCount()
    {
        if(is_object($this->article))
        {
            $this->article->comment_count = self::model()->count('article_id = '.$this->article_id);
            $this->article->save();
        }
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
		return '{{article_comment}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, article_id, content', 'required'),
			array('user_id, article_id, ischecked', 'numerical', 'integerOnly'=>true),
			array('created', 'default','value' => time(), 'setOnEmpty' => false, 'on' => 'insert'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, user_id, article_id, content, created', 'safe', 'on'=>'search'),
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
			'article' => array(self::BELONGS_TO, 'article', 'article_id'),
			'user' => array(self::BELONGS_TO, 'User', 'user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'user_id' => '所属用户ID',
			'article_id' => '所属资讯ID',
			'content' => '评论内容',
			'created' => '发表时间',
			'ischecked' => '是否审核',
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

		$criteria->compare('user_id',$this->user_id);

		$criteria->compare('article_id',$this->article_id);

		$criteria->compare('content',$this->content,true);

		$criteria->compare('created',$this->created);
		
		if($this->ischecked !== null) $criteria->compare('ischecked',$this->ischecked);

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