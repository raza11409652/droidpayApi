<?php 
require_once "../controller/Connection.php";
require_once "../controller/Controller.php";
#require_once "../controller/SendMsg.php";
$response=array("error"=>false);
class ActivateUser{
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
    function activate($userId){
        $update = "update user set user_status='1' where user_id='{$userId}'";
        $res = mysqli_query($this->connect , $update);
        if($res){
            return true ; 
        }
        return false;
    }

}
if($_SERVER['REQUEST_METHOD'] == 'POST' ){
    $activate = new ActivateUser();
    $mobile = $_POST['mobile'];
    $userId = $activate->getUserId($mobile);
    if($activate->activate($userId)){
        $response['error'] = false ; 
        $response['msg']  = 'Profile created'; 
        echo json_encode($response) ; 
    }else{
        $response['error'] = true; 
        $response['msg']  = 'Profile creation failed'; 
        echo json_encode($response) ;  
    }
}else{

}
?>