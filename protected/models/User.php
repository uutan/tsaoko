<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property integer $id
 * @property integer $is_real
 * @property string $username
 * @property integer $level
 * @property string $password
 * @property string $role
 * @property string $email
 * @property string $mobile
 * @property string $phone
 * @property string $nickname
 * @property string $job
 * @property integer $created
 * @property integer $last_login_time
 * @property integer $this_login_time
 * @property string $last_login_ip
 * @property string $this_login_ip
 * @property string $avatar
 * @property string $gender
 * @property string $both
 * @property string $info
 * @property integer $credit
 * @property string $money
 * @property integer $active
 */
class User extends CActiveRecord
{
	public $modelName = '会员';
	
	public function __toString()
	{
		return $this->username;
	}

    
    /**
     * 会员等级
     * 
     * @return multitype:string
     */
    public static function levelOptions()
    {
        return array(
        	'1' => '普通会员',
            '2' => '押金会员',
            '3' => '年费会员',
            '4' => '年费批发会员',
        );
    }
    
    public function getLevelStr()
    {
        $data = User::levelOptions();
    	$level = $this->level ? $this->level : 1;
    	return $data[$level];
    }

    // 用户角色列表
    public static function getRoles($user_id = 0)
    {
        $data = array();
        // 单用户角色
        $roles = Yii::app()->authManager->getRoles($user_id);
        foreach ($roles as $name => $item)
        {
            $data[$name] = $item->name;
        }
        return $data;
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
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('mobile', 'required'),
			array('is_real, level, created, last_login_time, this_login_time, credit, active', 'numerical', 'integerOnly'=>true),
			array('username, password, email', 'length', 'max'=>128),
			array('role, phone', 'length', 'max'=>20),
			array('mobile', 'length', 'max'=>11),
			array('nickname, job', 'length', 'max'=>50),
			array('last_login_ip, this_login_ip', 'length', 'max'=>15),
			array('avatar', 'length', 'max'=>255),
			array('gender, money', 'length', 'max'=>10),
			array('both', 'safe'),
			array('avatar', 'file', 'allowEmpty'=>true, 'types'=>'jpg, gif, png', 'maxSize'=>2048*1024, 'safe'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, is_real, username, level, password, role, email, mobile, phone, nickname, job, created, last_login_time, this_login_time, last_login_ip, this_login_ip, avatar, gender, both, info, credit, money, active', 'safe', 'on'=>'search'),
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
			'is_real' => '是否真实',
			'username' => '用户名',
			'level' => '等级',
			'password' => '密码',
			'role' => '角色',
			'email' => 'Email',
			'mobile' => '手机号',
			'phone' => '电话',
			'nickname' => '昵称',
			'job' => '职务',
			'created' => '添加时间',
			'last_login_time' => '最后登录时间',
			'this_login_time' => '当前登录时间',
			'last_login_ip' => '最后IP',
			'this_login_ip' => '当前IP',
			'avatar' => '头像',
			'gender' => '性别',
			'both' => '生日',
			'info' => '介绍自己',
			'credit' => '积分',
			'money' => '余额',
			'active' => '激活',
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
		$criteria->compare('is_real',$this->is_real);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('level',$this->level);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('role',$this->role,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('mobile',$this->mobile,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('nickname',$this->nickname,true);
		$criteria->compare('job',$this->job,true);
		$criteria->compare('created',$this->created);
		$criteria->compare('last_login_time',$this->last_login_time);
		$criteria->compare('this_login_time',$this->this_login_time);
		$criteria->compare('last_login_ip',$this->last_login_ip,true);
		$criteria->compare('this_login_ip',$this->this_login_ip,true);
		$criteria->compare('avatar',$this->avatar,true);
		$criteria->compare('gender',$this->gender,true);
		$criteria->compare('both',$this->both,true);
		$criteria->compare('info',$this->info,true);
		$criteria->compare('credit',$this->credit);
		$criteria->compare('money',$this->money,true);
		$criteria->compare('active',$this->active);

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
	 * @return User the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
