<?php
require_once "../controller/Connection.php";
require_once "../controller/Controller.php";
require_once "../controller/SendMsg.php";
$response=array("error"=>false);
class CardRegistration{
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
    function isCardRegistered($userId){
        $query = "select * from card where card_ref='{$userId}'";
        $res = mysqli_query($this->connect , $query);
        $count = mysqli_num_rows($res);
        if($count ==1){
            return true ; 
        }
        return false;
    }
}
if($_SERVER['REQUEST_METHOD'] == 'POST' ){
    $card = new CardRegistration();
    $mobile = $_POST['mobile'];
    $userId = $card->getUserId($mobile);
    if($card->isCardRegistered($userId)){
        $response['error']=false;
        $response['msg'] = "card found";
     //   $response['carduid']=
        echo json_encode($response);
    }else{
        $response['error']=true;
        $response['msg'] = "No card found";
        echo json_encode($response);
    }
}else{

}
?>