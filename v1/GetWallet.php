<?php 
require_once "../controller/Connection.php";
require_once "../controller/Controller.php";
require_once "../controller/SendMsg.php";
$response=array("error"=>false);
class GetWallet{
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
    function getWallet($userId){
        $query = "select wallet_amount from wallet where wallet_ref='{$userId}'";
        $res = mysqli_query($this->connect , $query);
        $data = mysqli_fetch_array($res);
        return $data['wallet_amount'];
    }
}
if($_SERVER['REQUEST_METHOD'] == 'POST' ){
    $user = $_POST['user'];
    $object = new GetWallet();
    $userId = $object->getUserId($user);
    $amt  = $object->getWallet($userId);
    $response['error']=false ; 
    $response['amount'] = $amt;
    echo json_encode($response);

}

?>