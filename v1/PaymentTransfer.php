<?php 
require_once "../controller/Connection.php";
require_once "../controller/Controller.php";
require_once "../controller/SendMsg.php";
$response=array("error"=>false);
class PaymentTransfer{
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
    function createTransaction($userId , $amount , $type , $src  , $uid){
        $date =  date("Y-m-d");;
        $insert = "Insert into transaction (transaction_amount , transaction_type , transaction_ref , 
        transaction_src , 
        transaction_date , transaction_uid , transaction_status ) values('{$amount}' , '{$type}' , '{$userId}'
        ,'{$src}' ,'{$date}' , '{$uid}' , '1' )";
        $res = mysqli_query($this->connect , $insert);
        if($res){
            return true;
        }
        return false;
    }
    function transationUid(){
        return md5(mt_rand(1000 , 9999));
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
    function getUser($userId){
        $query = "select * from user U , card C where U.user_id='{$userId}' && C.card_ref='{$userId}' ";
        $res = mysqli_query($this->connect , $query);
        $data = mysqli_fetch_array($res);
        return $data ; 
    }
   
}
if($_SERVER['REQUEST_METHOD'] == 'POST' ){
    //var_dump($_POST);
    @$sender = $_POST['sender'];
    $receiver = $_POST['receiver'];
    $ref = $_POST['ref'];
    $amount = $_POST['amount'];
    $obj = new PaymentTransfer();
    $senderId = $obj->getUserId($sender);
    $receiverId = $obj->getUserId($receiver);
    $senderWalletAmount = $obj->getWalletAmount($senderId);
    $receiverWalletAmount = $obj->getWalletAmount($receiverId);
    if($amount<=$senderWalletAmount){
        //DEDUCT AMOUNT FROM SENDER ACCOUNT
        $temp = $senderWalletAmount - $amount ; 
        $tempR = $receiverWalletAmount+ $amount;

        //create credit transaction
        $creditSrc = "From:{$sender} Ref : {$ref}";
        $creditTransactionUid = $obj->transationUid(); 
        $obj->createTransaction($receiverId  , $amount , '1' , $creditSrc ,$creditTransactionUid);
        //created debit transaction
        $debitSrc = "To:{$receiver} Ref : {$ref}";
        $debitTransactionUid = $obj->transationUid(); 
        $obj->createTransaction($senderId , $amount , '2' , $debitSrc ,$debitTransactionUid);
        
        if($obj->updateWallet($senderId , $temp) && $obj->updateWallet($receiverId , $tempR)){
            $data = $obj->getUser($receiverId);
            $name = $data['user_name'];
            $response['error']=false;
            $response['msg'] = "Transfer success";
            $response['transactionAmount']="{$obj->getAmount($debitTransactionUid)}";
            $response['transactionUid']="{$debitTransactionUid}";
            $response['reciever']="{$name}";
            $response['ref']="{$debitSrc}";
            $response['sender']="{$sender}";
            $response['date']="{$obj->getdate($debitTransactionUid)}";
            $response['updatedBal']="{$obj->getWalletAmount($senderId)}";
            echo json_encode($response);
        }
    }else{
        $requireMoneyToBeAdded = $amount - $senderWalletAmount ; 
        $response['requiredMoney'] = "{$requireMoneyToBeAdded}";
        $response['error']=true;
        $response['walletError']=true;
        $response['msg']="Not sufficient amount available in your DroidPay wallet";
        echo json_encode($response);
    }
}

?>