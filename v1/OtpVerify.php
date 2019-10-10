<?php 
require_once "../controller/Connection.php";
require_once "../controller/Controller.php";
require_once "../controller/SendMsg.php";
$response=array("error"=>false);
class OtpVerify{
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
    function verifyToken($token , $id){
        $query = "Select * from user_token where user_token_val='{$token}' && user_token_ref='{$id}'";
        $res = mysqli_query($this->connect , $query);
        $count = mysqli_num_rows($res);
        if($count == 1){
            return true;
        }
        return false;
    }
    function deleteToken($id){
        $query = "delete  from user_token where user_token_ref='{$id}'";
        $res = mysqli_query($this->connect , $query);
    }
}
if($_SERVER['REQUEST_METHOD'] == 'POST' ){
    $token=$_POST['token'];
    $token = md5($token);
    $mobile = $_POST['mobile'] ; 
    //get userID 
    $otpVerifyObject = new OtpVerify();
    $userId = $otpVerifyObject->getUserId($mobile);
    if($otpVerifyObject->verifyToken($token , $userId)){
        //delete the token and send to next activity card details
        $otpVerifyObject->deleteToken($userId);
        //create wallet
        
        $response['error'] = false;
        $response['msg'] = "OTP success"; 
        echo json_encode($response);
    }else{
        $response['error']=true;
        $response['msg']="OTP verification failed , please ensure you have entered correct OTP";
        echo json_encode($response);
    }

}else{

}
?>