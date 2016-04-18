<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property integer $user_id
 * @property string $username
 * @property string $password
 * @property string $user_type
 * @property string $fname
 * @property string $lname
 * @property string $mname
 * @property string $birthdate
 * @property integer $position_id
 * @property integer $created_by
 * @property string $created_date
 * @property integer $updated_by
 * @property string $updated_date
 * @property integer $disabled
 * @property string $authKey
 * @property string $accessToken
 *
 * @property AuditLogs[] $auditLogs
 * @property Comments[] $comments
 * @property Tasks[] $tasks
 * @property Positions $position
 */
class Users extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'password', 'position_id', 'created_by'], 'required'],
            [['user_type'], 'string'],
            [['position_id', 'created_by', 'updated_by', 'disabled'], 'integer'],
            [['created_date', 'updated_date'], 'safe'],
            [['username', 'password', 'fname', 'lname', 'mname', 'birthdate'], 'string', 'max' => 45],
            [['authKey'], 'string', 'max' => 100],
            [['accessToken'], 'string', 'max' => 256]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'username' => 'Username',
            'password' => 'Password',
            'user_type' => 'User Type',
            'fname' => 'Fname',
            'lname' => 'Lname',
            'mname' => 'Mname',
            'birthdate' => 'Birthdate',
            'position_id' => 'Position ID',
            'created_by' => 'Created By',
            'created_date' => 'Created Date',
            'updated_by' => 'Updated By',
            'updated_date' => 'Updated Date',
            'disabled' => 'Disabled',
            'authKey' => 'Auth Key',
            'accessToken' => 'Access Token',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuditLogs()
    {
        return $this->hasMany(AuditLogs::className(), ['audit_user' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comments::className(), ['user_id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTasks()
    {
        return $this->hasMany(Tasks::className(), ['assignee' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosition()
    {
        return $this->hasOne(Positions::className(), ['position_id' => 'position_id']);
    }

    /**
     * @inheritdoc
     * @return UsersQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UsersQuery(get_called_class());
    }
    
    
    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        foreach (self::$users as $user) {
            if ($user['accessToken'] === $token) {
                return new static($user);
            }
        }

        return null;
    }

    /**
     * Finds user by username
     *
     * @param  string      $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        foreach (self::$users as $user) {
            if (strcasecmp($user['username'], $username) === 0) {
                return new static($user);
            }
        }

        return null;
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->user_id;
    }


    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }
    
    /**
     * Finds user by username
     *
     * @param  string      $username
     * @return static|null
     */
    public static function checkLogin($username, $password)
    {
        // find a user identity with the specified username.
		// note that you may want to check the password if needed
		$hasLogin = static::findOne(['username' => $username, 'password' => $password]);
		
		if($hasLogin){
			return true;
		}
		
		return false;
    }
    
    /*Convenience methods*/
    
    public function is_admin(){
		if($this->user_type=="admin"){
			return true;
		}
		return false;
	}

    public function getFullname(){
        return $this->fname.' , '.$this->lname;
    }
       
    
}
