<?php 
require_once "../controller/Connection.php";
require_once "../controller/Controller.php";
require_once "../controller/SendMsg.php";
$response=array("error"=>false);
 class AddWalletConfirm{
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
    function updateTransaction ($uid , $src){
        $query = "update transaction set transaction_src='{$src}' , transaction_status='1' 
         where transaction_uid='{$uid}'";
        #echo $query;
        $res = mysqli_query($this->connect , $query);
        if($res){
            return true;
        }
        return false;
    }
    function getAmount($uid){
        $query = "select transaction_amount from transaction where transaction_uid='{$uid}'";
        $res = mysqli_query($this->connect , $query);
        $data = mysqli_fetch_assoc($res);
        return $data['transaction_amount'];
    }
    function getdate($uid){
        $query = "select transaction_created_at from transaction where transaction_uid='{$uid}'";
        $res = mysqli_query($this->connect , $query);
        $data = mysqli_fetch_assoc($res);
        return $data['transaction_created_at'];
    }
    function getWalletAmount($userId){
        $query = "select wallet_amount from wallet where wallet_ref='{$userId}'";
        #echo $query;
        $res = mysqli_query($this->connect , $query);
        $data = mysqli_fetch_array($res);
        return $data['wallet_amount'];
    }
     
  function updateWallet($userId , $amount){
        $query = "update wallet set wallet_amount='{$amount}' where wallet_ref='{$userId}'";
        #echo $query;
        $res = mysqli_query($this->connect , $query);
        if($res){
            return true;
        }    
        return false;
    }

 }
 if($_SERVER['REQUEST_METHOD'] == 'POST'){
    #var_dump($_POST);

    $userMobile = $_POST['user'];
    $transactionUid = $_POST['uid'];
    $transactionSrc= $_POST['src'];
    $obj = new AddWalletConfirm();
    $userId = $obj->getUserId($userMobile);
    if($obj->updateTransaction($transactionUid , $transactionSrc)){
      $transactionAmount  = $obj->getAmount($transactionUid);
      $walletAmount = $obj->getWalletAmount($userId);
     # echo $transactionAmount . $walletAmount;
      $newAmount = $transactionAmount + $walletAmount;
       if($obj->updateWallet($userId , $newAmount)){
           $response['updatedBalance']=$newAmount;
           $response['error']=false;
           $response['msg']="success";
           $response['amountAdded'] = $transactionAmount;
           $response['uid']=$transactionUid ; 
           $response['date']=$obj->getdate($transactionUid);
           $msg = "Dear customer, your DroidPay Wallet is credited with 
           Rs. {$transactionAmount}
           Your updated Balance is {$newAmount} ";
           sendTextMsg(9835555982 , $msg);
           echo json_encode($response);
       } 
    }
}
?>