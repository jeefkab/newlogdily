<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity {

    /**
     * Authenticates a user.
     * The example implementation makes sure if the username and password
     * are both 'demo'.
     * In practical applications, this should be changed to authenticate
     * against some persistent user identity storage (e.g. database).
     * @return boolean whether authentication succeeds.
     */
    
    private $_id;
    
    public function authenticate() {
        /*
          $users=array(
          // username => password
          'demo'=>'demo',
          'admin'=>'admin',
          );
         */

        // Users มาจาก ชื่อคลาส ใน model
        
        $u = Users::model()->findAllByAttributes(
            array(),
            $condition = 'username=:username',
            $params = array(':username'=>$this->username)
        );
        
        //$u = Users::model()->findAll();
        $users=array();
        foreach ($u as $v) {
            $users[$v->username] = $v->password;
            $user=$v;
        }
        
//        $test = 'This is a test'; 
//        Yii::trace($test, 'test');
               
        
//        Yii::trace('$users[$this->username]: '.$users[$this->username], 'test');
//        Yii::trace('md5($this->password): '.md5($this->password), 'test');
        
        
        if (!isset($users[$this->username]))
            $this->errorCode = self::ERROR_USERNAME_INVALID;
        elseif ($users[$this->username] !== md5($this->password))
        {
            $this->errorCode = self::ERROR_PASSWORD_INVALID;            
        }
        else
        {        
//            Yii::trace('pass '.$users[$this->username] , 'test');
//            exit;
            $this->_id=$user->id;
            $this->setState('username', $user->username);
            $this->setState('firstname', $user->firstname);
            $this->setState('permission', $user->permission);
            $this->setState('picture', $user->picture);
			
			$friendModel=Friend::model()->findAllBySql(
				" 
				select to_id as id from friend where from_id=:user_id and status_id=2 
				union 
				select from_id as id from friend where to_id=:user_id and status_id=2 
				",
				array( ':user_id'=>Yii::app()->user->id ),
			);		
			$friendlist='';
			foreach( $friendModel as  $v )
			{
				$friendlist = $v->id.',';
			}
			$friendlist=substr($friendlist, 0, -1);
			
            $this->setState('friendlist', $friendlist );
			
            $this->errorCode = self::ERROR_NONE;
        }
        return !$this->errorCode;
    }
    
    public function getId()
    {
        return $this->_id;
    }

}