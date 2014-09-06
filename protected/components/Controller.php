<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/main';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();

    public $indexNumber = 0;

    public $cacheHomeFile = 'cachehome.lock';

    public function __construct($id,$module=null)
    {
        parent::__construct($id, $module);
        $this->cacheHomeFile = Yii::app()->runtimePath.'/'.$this->cacheHomeFile;
    }

    /**
     * 单页页管理
     * 
     * @param  [type] $category [description]
     * @return [type]           [description]
     */
    public function pages( $category )
    {
        
        $data = Yii::app()->cache->get($category);
        if( empty($data) )
        {
            $data = array();
            $models = Page::model()->findAllByAttributes(array('category'=>$category), array('order'=>'sortnum ASC,id ASC'));
            foreach($models as $item)
            {
                $data[] = array('name'=>$item->name,'title'=>$item->title,'id'=>$item->id); 
            }
            Yii::app()->cache->set($category,$data,60*30, new CFileCacheDependency($this->cacheHomeFile));
        }
        return $data;
    }


    /**
     * 公告列表
     * 
     * @return [type] [description]
     */
    public function anns()
    {
        $criteria = new CDbCriteria;
        $criteria->compare('is_checked',1);
        $criteria->order = 'id DESC';
        return Ann::model()->findAll($criteria);
    }

    /**
     * 友情链接
     * @param unknown_type $category
     * @param unknown_type $limit
     * @param unknown_type $type
     */
    public function getFlinks($category = '', $limit = 0, $type = '')
    {
        $criteria = new CDbCriteria;
        if ($category != '')
            $criteria->compare('category', $category);
        if ($type != '')
        {
            if ($type == 'image')
                $criteria->addCondition("(image IS NOT NULL AND image <> '') OR (remote_image IS NOT NULL AND remote_image <> '')");
            elseif ($type == 'text')
                $criteria->addCondition("(image IS NULL OR image = '') AND (remote_image IS NULL OR remote_image = '')");
        }
        $criteria->compare('enabled', 1);
        if ($limit > 0)
            $criteria->limit = $limit;

        return Flink::model()
                        //->hasCache()
                        ->findAll($criteria);
    }	



    /**
     * 获取关于我们信息
     * @return [type] [description]
     */
    public function getAboutPages()
    {
        return About::model()->findAll(array('order'=>'id ASC'));    
    }

    	
}