<?php
require_once "../controller/Connection.php";
require_once "../controller/Controller.php";
$response=array("error"=>false);
class AddWalletInit{
    private $connect  , $userId = null ;// $otp=null; 
    function __construct(){
        $con = new Connection();
        $this->connect = $con->getConnect();
    }
    function getUserId($mobile){
        $query = "select user_id from user where user_mobile='{$mobile}'";
        $res = mysqli_query($this->connect , $query);
        $data = mysqli_fetch_array($res);
        return $data['user_id'];
    }
    function transactionInit($userId , $amount , $uid){
        //trasaction type 1 credit
        //transaction status = 2 failed
        $date =  date("Y-m-d");;
    
        $insert = "insert into transaction (transaction_amount , transaction_type ,transaction_ref 
         , transaction_date , transaction_uid  , transaction_status) values
        ('{$amount}' , '1' ,'{$userId}' ,'{$date}' ,'{$uid}' , '2'
        )";
        $res = mysqli_query($this->connect , $insert);
        if($res){
            return true;
        }
        return false;
    }
} 
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $userMobile = $_POST['user'];
    $amount = $_POST['amount'];
    $obj = new AddWalletInit();
    $userId = $obj->getUserId($userMobile);
    $transactionUid = mt_rand(1000000 , 9999999);
    $temp = mt_rand(1000 , 9999);

    $transactionUid =md5($transactionUid).$temp; 
    if($obj->transactionInit($userId , $amount , $transactionUid)){
        $response['error']=false ; 
        $response['msg']= "Transaction Init";
        $response['uid']=$transactionUid;
        echo json_encode($response);
    }
}else{

}
?>