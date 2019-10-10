<?php 
require_once "../controller/Connection.php";
require_once "../controller/Controller.php";
require_once "../controller/SendMsg.php";
$response=array("error"=>false);
class Register{
    private $connect  , $userId = null ;// $otp=null; 
    function __construct(){
        $con = new Connection();
        $this->connect = $con->getConnect();
    }
    function generateUserID($name){
      $temp = mt_rand(10000 , 99999);
      $name = $name .  $temp  ; 
      return md5($name);
    }
    function getuserid(){
        $query = "select max(user_id) as max_id from user";
        $res = mysqli_query($this->connect , $query);
        $data = mysqli_fetch_assoc($res);
        return $data['max_id']+1;
    }
    function registerUser($name , $email , $mobile , $password){
        $this->userId = $this->getuserid();
        $insert = "Insert into user (user_id ,user_name , user_email , user_mobile , user_password , user_uid) 
        values ( '{$this->userId}','{$name}' ,'{$email}' ,'{$mobile}' ,'{$password}' , '{$this->generateUserID($name)}')";
        $res = mysqli_query($this->connect , $insert);
        if($res){
            return true ; 
        }
        return false;
    }
    function isEmailUsed($email){
        $query = "select * from user where user_email='{$email}'";
        $res = mysqli_query($this->connect , $query);
        $count = mysqli_num_rows($res);
        if($count>0){
            return true;
        }
        return false;
    }
    function isMobileUsed($mobile){
        $query = "select * from user where user_mobile='{$mobile}'";
        $res = mysqli_query($this->connect , $query);
        $count = mysqli_num_rows($res);
        if($count>0){
            return true;
        }
        return false;
    }
    function isStatusNotOk($email , $mobile){
        $query = "select * from user where user_email='{$email}' && user_mobile='{$mobile}' &&
        user_status='0'";
        $res = mysqli_query($this->connect , $query);
        $count = mysqli_num_rows($res);
        if($count >0){
            return true ; 
        }
        return false;
    }
    function insertToken($otp){
        $otp = md5($otp);
        $insert = "insert into user_token(user_token_val , user_token_ref) values('{$otp}'  ,
         '{$this->userId}')";
       //  echo $insert;
        $res = mysqli_query($this->connect , $insert);
        if($res){
            return true;
        }
        //var_dump($res);
    }
    function insertTokenWithId($otp , $id){
        $otp = md5($otp);
        $insert = "insert into user_token(user_token_val , user_token_ref) values('{$otp}'  ,
         '{$id}')";
       //  echo $insert;
        $res = mysqli_query($this->connect , $insert);
        if($res){
            return true;
        }
        //var_dump($res);
    }
    function isTokenExist($id){
        $query = "select * from user_token where user_token_ref='{$id}'";
        $res = mysqli_query($this->connect , $query);
        $count = mysqli_num_rows($res);
        if($count>0){
            return true;
        }
        return false;
    }
    function generateOTP(){
        return mt_rand(10000 , 99999);
    }
    function updateToken($otp , $id){
        $otp = md5($otp);
        $update = "update user_token set user_token_val='{$otp}' where user_token_ref='{$id}'";
        $res = mysqli_query($this->connect , $update);
        if($res){
            return true;
        }
        return false;
    }
    function getuserIdfromMobileEmail($mobile , $email){
        $query = "select user_id from user where user_email='{$email}' && user_mobile='{$mobile}'";
        $res = mysqli_query($this->connect , $query);
        $data = mysqli_fetch_array($res);
        return $data['user_id'];
    }
    function updateProfile($name ,$password  , $userId){
        $update = "update user set user_name='{$name}' , user_password='{$password}' where user_id='{$userId}'";
        $res = mysqli_query($this->connect , $update);
        if($res){
            return true ; 
        }

    }
    
}

if($_SERVER['REQUEST_METHOD'] == 'POST' ){
    //create object 
    $register = new Register();
   # var_dump($_POST);
   
    $name = $_POST['name'];
    $email = $_POST['email']; 
    $password = $_POST['password']; 
    $mobile = $_POST['mobile'];
    $password = md5($password);
   if(validName($name)){
    if(validEmail($email)){
        if(validMobile($mobile)){
            if($register->isStatusNotOk($email , $mobile)){
                //user is registered already but not verified
                $userId = $register->getuserIdfromMobileEmail($mobile , $email);
                $register->updateProfile($name , $password, $userId);
                $otp = $register->generateOTP();
                if($register->isTokenExist($userId)){
                    $register->updateToken($otp , $userId);
                }else{
                    $register->insertTokenWithId($otp , $userId);
                }
                $msg = "Your otp is {$otp}";
                sendTextMsg($mobile , $msg);
                  //
                  $response['error']=false;
                  $response['msg'] = "OTP has been send to {$mobile}";
                  echo json_encode($response);
            }else{
                if($register->isEmailUsed($email) == false){
                    if($register->isMobileUsed($mobile)==false){
                            //register user and send OTP 
                        if($register->registerUser($name , $email , $mobile , $password)){
                            //send OTP and generate Token
                            $otp = $register->generateOTP();
                            $register->insertToken($otp);
                            $msg = "Your otp is {$otp}";
                            sendTextMsg($mobile , $msg);

                            //
                            $response['error']=false;
                            $response['msg'] = "OTP has been send to {$mobile}";
                            echo json_encode($response);

                        }
                    }else{
                        //mobile is already used
                        $response['error']=true ; 
                        $response['msg'] = "{$mobile} is already used";
                        echo json_encode($response);
                    }
               }else{
                   //email is alreday used ;
                   $response['error']=true ; 
                   $response['msg'] = "{$email} is already used";
                   echo json_encode($response);
               }
            }
           
        }else{
            $response['error']=true ; 
            $response ['msg']="Not valid indian mobile";
            echo json_encode($response);
            return;
        }
    }else{
        $response['error']=true ; 
        $response ['msg']="Not valid email : {$email}";
        echo json_encode($response);
        return;  
    }
   }else{
    $response['error']=true ; 
    $response ['msg']="Not valid name";
    echo json_encode($response);
    return;  
   }
  

}else{
  $response['error']=true;
  $response['msg']="Request failed Status Error 101";
  echo json_encode($response);
}
?>