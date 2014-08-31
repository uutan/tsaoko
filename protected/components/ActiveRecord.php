<?php

class ActiveRecord extends CActiveRecord
{
    public $isLocalContent = false;


	protected static function _is_router($router) {
		// 判断路由
		if (isset($_GET['r'])) {
			$arr_r = explode('/', $_GET['r']);
			if (isset($arr_r[1])) {
				return (strtolower($arr_r[1]) === $router);
			} else {
				return FALSE;
			}
		} else {
			return FALSE;
		}
	}

    //删除上传了但没有使用的文件
    protected function afterSave()
    {
        parent::afterSave();
        $this->writeManyManyTables();
    }

    protected function beforeDelete()
    {
        parent::beforeDelete();

        //删除关联数据 HAS_MANY HAS_ONE
        $relations = $this->relations();
        foreach($relations as $name => $relation)
        {
            if($relation[0] == self::HAS_MANY || $relation[0] == self::HAS_ONE)
            {
                $objects = $this->getRelated($name);
                if(is_array($objects))
                {
                    foreach($objects as $object)
                    {
                        $object->delete();
                    }
                }
                elseif(is_object($objects))
                {
                    $objects->delete();
                }
            }
        	if($relation['0'] == CActiveRecord::MANY_MANY) // ['0'] equals relationType
			{
				$this->executeManyManyEntry($this->makeManyManyDeleteCommand(
					$relation[2],
					$this->{$this->tableSchema->primaryKey}));
			}
        }
        
        return true;
    }
    
	private function writeManyManyTables() 
	{
		Yii::trace('writing MANY_MANY data for '.get_class($this),'system.db.ar.CActiveRecord');

		foreach($this->relations() as $key => $relation)
		{
			if($relation['0'] == CActiveRecord::MANY_MANY) // ['0'] equals relationType
			{
				if(isset($this->$key))
				{
					if(is_object($this->$key) || is_numeric($this->$key))
					{
						$this->executeManyManyEntry($this->makeManyManyDeleteCommand(
							$relation[2],
							$this->{$this->tableSchema->primaryKey}));
						$this->executeManyManyEntry($this->makeManyManyInsertCommand(
							$relation[2],
							(is_object($this->$key))
							? $this->$key->{$this->$key->tableSchema->primaryKey}
							: $this->{$key}));
					}
					else if (is_array($this->$key) && $this->$key != array())
					{
						$this->executeManyManyEntry($this->makeManyManyDeleteCommand(
							$relation[2],
							$this->{$this->tableSchema->primaryKey}));
						foreach($this->$key as $foreignobject)
						{
							$this->executeManyManyEntry ($this->makeManyManyInsertCommand(
								$relation[2],
								(is_object($foreignobject))
								? $foreignobject->{$foreignobject->tableSchema->primaryKey}
								: $foreignobject));
						}
					}
					
				}
//				else
//				{
//					$this->executeManyManyEntry($this->makeManyManyDeleteCommand(
//						$relation[2],
//						$this->{$this->tableSchema->primaryKey}));
//				}
			}
		}
	}

	// We can't throw an Exception when this query fails, because it is possible
	// that there is not row available in the MANY_MANY table, thus execute()
	// returns 0 and the error gets thrown falsely.
	private function executeManyManyEntry($query) {
		Yii::app()->db->createCommand($query)->execute();
	}

	// It is important to use insert IGNORE so SQL doesn't throw an foreign key
	// integrity violation
	private function makeManyManyInsertCommand($model, $rel) {
		return sprintf("insert ignore into %s values ('%s', '%s')", $model,	$this->{$this->tableSchema->primaryKey}, $rel);
	}

	private function makeManyManyDeleteCommand($model, $rel) {
		return sprintf("delete ignore from %s where %s = '%s'", $this->getManyManyTable($model), $this->getRelationNameForDeletion($model), $rel);
	}

	private function getManyManyTable($model) {
		if (($ps=strpos($model, '('))!==FALSE)
		{
			return substr($model, 0, $ps);
		}
		else
			return $model;
	}

	private function getRelationNameForDeletion($model) {
		preg_match('/\((.*),/',$model, $matches) ;
		return substr($matches[0], 1, strlen($matches[0]) - 2);
	}
    
    public function getConstOptions($prefix)
    {
        $options = array();

        $rec = new ReflectionClass(get_class($this));
        $consts = $rec->getConstants();
        if(is_array($consts))
        {
            foreach($consts as $name=>$value)
            {
                if(strpos($name, $prefix) === 0) $options[$value] = $value;
            }
        }
        return $options;
    }

    
	/**
	 * 内容外站图片本地化
	 * @param $content
	 */
	public function localContent($content)
	{
		$replaces=array(
			'%<img[^>]*?src="(http://.*?)"[^>]*?>%ie' => "'<a  target=\"_blank\" href=\"'.(\$src=\$this->downremote_image('$1', true,true)).'\"><img src=\"'.\$src.'\" /></a>'"
		);
		
		foreach ($replaces as $regex=>$replace)
		{
			$content=preg_replace($regex,$replace,$content);
		}
		
		return $content;
	}
	
	
	/**
	 * 下载图片
	 **/
	public  function downremote_image($url,$iscutedge,$ismosaic)
	{
		$pathinfo = pathinfo($url);
		if($pathinfo['dirname']=='.')
    	{
    		return 'false1';
    	}
    	$upload_dir = Yii::app()->basePath . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'upload' .DIRECTORY_SEPARATOR . 'article' . DIRECTORY_SEPARATOR;
        if(!file_exists($upload_dir)) FileHelper::mkdirs($upload_dir);
    	
    	$dir = date( 'Y_m');
    	$attach_dir = $upload_dir  .'/'. $dir ;
    	
		if (! is_dir ( $attach_dir )) 
		{
			mkdir( $attach_dir, 0777,true );
			@fclose ( fopen ( $attach_dir . '/index.htm', 'w' ) );
		}
		
		$basename = $pathinfo['basename'];
		//如果发现是脚本重定向，如 /attachment.php?fid=6276 ，则假设为jpg文件，并制作合法文件名
		if(strpos($basename, '?')!==false)
		{
			$basename = str_replace(array('?', '=', '.'), '_', $basename).'.jpg';
		}
		//如果非图片的路径(乱码)，直接跳过图片下载
    	if(!preg_match('/(.jpg)|(.gif)|(.png)|(.jpeg)|(.bmp)/si',$basename))
       	{
       		return 'false2';
       	}
       	$time=time() . rand(1000,9999);
       	$save_to = $attach_dir. '/' . $time .$basename;
       	$fullpath = '/upload/article/'.$dir.'/'.$time.$basename;
        //var_dump($fullpath.'\r\n'.$save_to);
       	if(file_exists($save_to)) return $fullpath; //存在则返回
		if (UtilHelper::getfile ( $url, $save_to, $url)) 
        {
			//处理图像，打马赛克, 水印将在upload完成
// 			$image=ImageHelper::createFromFile ( $save_to);
// 			if ($image != false) {
// 				$size = @getimagesize($save_to);
// 				if(!empty($size) && $size[0] > 300 &$size[1] > 275)
// 				{
// 						if($iscutedge)
// 						{
// 							$image->cutedge(0);
// 						}
// 						if($ismosaic)
// 						{
// 							$image->mosaic(0, 0, 170, 20, 4);//左下角水印文字
// 							$image->mosaic($size[0]-170, 2, $size[0]-2, 20, 4);//右上角水印文字
// 							$image->mosaic(2, $size[1]-20, 170, $size[1]-2, 4);//左下角水印文字
// 							$image->mosaic($size[0]-110, $size[1]-50, $size[0]-2, $size[1]-2, 6); //右下角水印图
// 							$image->mosaic($size[0]-160, $size[1]-20, $size[0]-110, $size[1]-2, 6);
// 						}
// 				}
// 				//水印

// 				$image->waterMark(array('type'=>'text', 'position'=>1, 'minwidth'=>300, 'minheight'=>275, 'text'=>array('shadowx'=>1,'shadowy'=>1)));
// 				$image->waterMark(array('type'=>'gif', 'position'=>9, 'minwidth'=>300, 'minheight'=>275));

// 				$image->save ( $save_to );
// 				$image->destroy ();
// 			}
			
			return $fullpath;
		}
	}
	
}