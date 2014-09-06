<?php
/**
 * 
 * 内容模型
 * @author lonestone
 * The followings are the available columns in table '{{article}}':
 * @var integer $id
 * @var integer $cate_id
 * @var string $title
 * @var integer $iscommend
 * @var integer $views
 * @var string $writer
 * @var string $source
 * @var string $image
 * @var string $description
 * @var string $keywords
 * @var string $content
 * @var integer $ischecked
 * @var integer $sortnum
 * @var integer $created
 * @var integer $updated
 * @property string $related_brand_ids
 * @property string $related_product_ids
 * @package int $istopic
 */
class Article extends ActiveRecord
{
    public $modelName = '资讯';
    
	private $index=0;
	
	public $clear_out_link = false;
	
	public $link_content = false;
	
	public $remote_image = '';
	
    public $blackwords = array();
    
    public $product_category_ids = array();


    public $isLocalContent = true;
    

    public function __toString()
    {
    	return $this->title;
    }
    
    public function getParentid()
    {
        $cate = ArticleCategory::model()->findByPk($this->cate_id);
        if($cate)
        {
            return $cate->parent_id;
        }
        else{
            return '0';
        }
    }

    protected function beforeSave()
    {
        parent::beforeSave();
//        require_once(Yii::getPathOfAlias('system.vendors.htmlpurifier').DIRECTORY_SEPARATOR.'HTMLPurifier.standalone.php');
//		HTMLPurifier_Bootstrap::registerAutoload();
//		
//		$purifier=new HTMLPurifier(array(
//            'HTML.TidyLevel' => 'medium',
//            'HTML.ForbiddenElements'=>array('pre'),
//            'HTML.SafeEmbed' => true,
//            'HTML.SafeObject' => true,
//            'Output.FlashCompat' => true,
//            ));
//		$purifier->config->set('Cache.SerializerPath',Yii::app()->getRuntimePath());
//		
//        $this->content = $purifier->purify($this->content);
		
        if($this->clear_out_link) $this->clearContent_outlink();
		
		if($this->isLocalContent)  $this->content=$this->localContent($this->content);//图片本地化
		
		if($this->remote_image) $this->setImage();
		
		$this->extractImage();

        $this->content = preg_replace('%<hr.+?class="ke\-pagebreak".+?/>%s', '[PageNext]', $this->content);
        
        return true;
    }

    protected function afterDelete()
    {
        parent::afterDelete();
        if($this->image) @unlink(Yii::app()->basePath . '/../' . $this->image);
        return true;
    }
    
    public function getPage($page = 1)
    {
    	$pages = explode('[PageNext]', $this->content);
    	return $pages[$page - 1];
    }
    
    public function getPageSize()
    {
    	return count(explode('[PageNext]', $this->content));
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
		return '{{article}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, keywords, description', 'required'),
			array('cate_id,store_id,istopic, parent_id, iscommend, views, ischecked, sortnum, updated,isheadline,life_axis_id', 'numerical', 'integerOnly'=>true),
            //array('created, updated', 'type', 'type'=>'datetime','datetimeFormat'=>'Y-m-d H:i:s'),
			array('title', 'length', 'max'=>180),
			//array('title', 'unique','caseSensitive'=>false,'className'=>'Article','message'=>'内容"{value}"已经发布，请仔细查看','on'=>'insert, promotion'),
            array('cate_id', 'numerical', 'min'=>1),
			array('writer, source', 'length', 'max'=>45),
			array('keywords', 'length', 'max'=>1000),
			array('sourceurl', 'length', 'max'=>250),
			array('content', 'length', 'max'=>999999),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id,istopic, cate_id, title, iscommend, views, writer, source, image, description, keywords, content, ischecked, sortnum, created, updated', 'safe', 'on'=>'search'),
            array('image', 'file', 'allowEmpty'=>true, 'types'=>'jpg, gif, png, bmp', 'maxSize'=>2048*1024),
            array('updated', 'default', 'value' => time (), 'setOnEmpty' => true, 'on' => 'update' ), 
            array ('created, updated', 'default', 'value' => time (), 'setOnEmpty' => true, 'on' => 'insert, promotion' ),
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
            'category' => array(self::BELONGS_TO, 'ArticleCategory', 'cate_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id'=>'ID',
			'cate_id' => '所属栏目',
            'category.name' =>'所属栏目',
            'category_sub.name' =>'所属子栏目',
			'title' => '标题',
			'iscommend' => '推荐',
			'isheadline' => '头条',
			'isvideo'=>'视频',
			'views' => '点击',
			'color' => '标题色彩',
			'writer' => '作者',
			'source' => '来源',
			'image' => '标题图',
			'keywords' => '关键词',
			'description' => '摘要',
			'content' => '内容',
			'ischecked' => '审核',
			'sortnum' => '排序数',
			'created' => '发布时间',
			'updated' => '修改时间',
			'sourceurl' => '来源URL',
                    'istopic' => '是否为专题',
	        'life_axis_id' => '关联生命轴阶段',
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
		
		$criteria->with = 'category';

		$criteria->compare('t.id',$this->id);
		$criteria->compare('t.parent_id',$this->parent_id);
		$criteria->compare('t.life_axis_id',$this->life_axis_id);
		
		if($this->cate_id>0) $criteria->compare('cate_id',$this->cate_id);

		$criteria->compare('title',$this->title,true);

		if(isset($_GET['Article']['ischecked'])) $criteria->compare('ischecked',$_GET['Article']['ischecked']);
		if(isset($_GET['Article']['iscommend'])) $criteria->compare('iscommend',$_GET['Article']['iscommend']);
		if(isset($_GET['Article']['isheadline'])) $criteria->compare('isheadline',$_GET['Article']['isheadline']);
		if(isset($_GET['Article']['isvideo'])) $criteria->compare('isvideo',$_GET['Article']['isvideo']);

		$criteria->compare('content',$this->content,true);

     	//$criteria->compare('ischecked',$this->ischecked);
        $data = new CActiveDataProvider('Article', array(
                    'criteria'=>$criteria,
                    'pagination'=>array(
                        'pageSize'=>12, 
                    ),
                    'sort' => array(
                        'defaultOrder' => 't.id DESC'
                    )
                ));
		return $data;
	}
	
	public function extractImage()
	{
		//提取标题图
    	$filename = realpath ( Yii::app ()->basePath . '/..' . $this->image );
    	
    	if(empty($this->image) || !file_exists($filename))
    	{
    		$regex = '%<img[^>]*?src="(.+?)".+?>%s';
    		$mcount = preg_match_all($regex, $this->content, $matches);
			if($mcount > 0)
			{
				foreach($matches[1] as $mt)
				{
					if(file_exists(Yii::app()->basePath . '/../' . $mt))
					{
						$this->image = $mt;
						break;
					}
				}
			}
    	}
	}
	
	public function setImage()
	{
		$data = array();
		//$data['upload_token']=$this->upload_token;
		$data['created']=$this->created;
		$image=$this->downremote_image($this->remote_image,$data,'true','true');
		$this->image = $image;
	}

	public function clearContent_outlink()
	{
		$this->content=preg_replace('%<a[^>]*?href="([^"]*?)"[^>]*?>(.*?)</a>%ie','$this->clearMethod("$0","$1","$2")',$this->content);
	}
	
	public function clearMethod($doc,$url,$text)
	{
		if(strpos($url, '/')===0 || preg_match_all('/[^"]*hange360\.com[^"]*/s',$url,$umt1)>0)
		{
			return $doc;
		}
		else 
		{
			return $text;
		}
	}

	public function getRelatedArticles($limit = 4)
	{
		$tags = preg_split('/[\s,]+/',$this->keywords,-1,PREG_SPLIT_NO_EMPTY);
		
		$criteria = new CDbCriteria();
		foreach($tags as $tag)
		{
			$criteria->addSearchCondition('keywords', $tag, true, 'OR');
		}
		$criteria->limit = $limit;
		$criteria->order = 'id DESC';
		
		$ret = self::model()->findAll($criteria);
		if(count($ret)==0)
			$ret = self::model()->findAll(array('order'=>'id DESC', 'limit'=>$limit));
			
		return $ret;
	}
	
}