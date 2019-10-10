<?php 
require_once "../controller/Connection.php";
require_once "../controller/Controller.php";
require_once "../controller/SendMsg.php";
$response=array("error"=>false);
class PaymentInit{
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
    function isUserExist($mobile){
        $mobile=pureText($mobile);
        $query = "select user_id from user where user_mobile='{$mobile}'";
        $res = mysqli_query($this->connect, $query);
        $count = mysqli_num_rows($res);
        if($count==1){
            return true ;
        }
        return false ; 
    }
    function getUser($userId){
        $query = "select * from user U , card C where U.user_id='{$userId}' && C.card_ref='{$userId}' ";
        $res = mysqli_query($this->connect , $query);
        $data = mysqli_fetch_array($res);
        return $data ; 
    }
    
}
if($_SERVER['REQUEST_METHOD'] == 'POST' ){
#var_dump($_POST);
    $receiver = $_POST['receiver'];
    $obj = new PaymentInit();
    if(validMobile($receiver)){
        //check whether no is registered or not
        if($obj->isUserExist($receiver)){
            $userId = $obj->getUserId($receiver);
            $users = $obj->getUser($userId);
            $response['error']=false;
            $response['msg'] = "user found";
            $response['name'] = $users['user_name'];
            echo json_encode($response);
            return;
        }else{
            $response['error']=true;
            $response['msg']=" DroidPay wallet not found for {$receiver}";
            echo json_encode($response);   
        }
    }else{
        $response['error']=true;
        $response['msg']="Not valid user";
        echo json_encode($response);
    }
}else{

}
?>