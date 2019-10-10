<?php 

require_once "../controller/Connection.php";
require_once "../controller/Controller.php";
require_once "../controller/SendMsg.php";
$response=array("error"=>false);
class UpdateProfile{
    private $connect  , $userId = null ;// $otp=null; 
    function __construct(){
        $con = new Connection();
        $this->connect = $con->getConnect();
    }
    function getUserId($mobile){
        $mobile=pureText($mobile);
        $query = "select user_id from user where user_mobile='{$mobile}'";
        $res = mysqli_query($this->connect, $query);
        $data = mysqli_fetch_array($res);
        return $data['user_id'];
    }
    function update($name , $email , $userId){
        $update= "update user set user_name='{$name}' , user_email='{$email}' where user_id='{$userId}'";
        $res = mysqli_query($this->connect  ,  $update);
        if($res){
            return true;
        }
        return false;
    }
}
if($_SERVER['REQUEST_METHOD'] == 'POST' ){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $user = $_POST['user'];
    $obj = new UpdateProfile();
    $userId = $obj->getUserId($user);
  if(validName($name)){
    if(validEmail($email)){
            if($obj->update($name , $email , $userId)){
                $response['name']=$name ; 
                $response['email']=$email ; 
                $response['error']=false;
                $response['msg']="Done";
                echo  json_encode($response);
            }
    }else{
        $response['error']=true;
        $response['msg']="Email invalid";
        echo json_encode($response);
    }
  }else{
    $response['error']=true;
    $response['msg']="Name invalid";
    echo json_encode($response); 
  }
}
?>