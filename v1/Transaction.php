<?php 
require_once "../controller/Connection.php";
require_once "../controller/Controller.php";
require_once "../controller/SendMsg.php";
$response=array("error"=>false);
class Transaction{
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
    function fetchTransaction($userId){
        $query = "Select * from transaction where transaction_ref='{$userId}' && transaction_status='1' order by transaction_created_at DESC";
        $res = mysqli_query($this->connect , $query);
        $count = mysqli_num_rows($res);
        if($count>0){
           $response['records']  = array();
           $response['error']=false;
           $response['count']=$count;
           $response['wallet']=$this->getWalletAmount($userId);
            $item = array();
            while($data=mysqli_fetch_array($res)){
                $item = array("uid" =>$data['transaction_uid'] ,
                    "date"=>$data['transaction_date'] , 
                    "src"=>$data['transaction_src'] , 
                    "amount"=>$data['transaction_amount'],
                    "type"=>$data['transaction_type']
                );
                array_push( $response['records'] , $item   );

            }
            echo json_encode($response);
        }else{
            $response['wallet']=$this->getWalletAmount($userId);
            $response['error']=true ; 
            $response['msg']="No Trasaction";
            echo json_encode($response);
        }
       
    }
    function fetchTransactionByDate($userId , $date){
        $query = "Select * from transaction where transaction_ref='{$userId}' && transaction_date='{$date}' && transaction_status='1' order by transaction_created_at DESC";
      #echo $query;
        $res = mysqli_query($this->connect , $query);
        $count = mysqli_num_rows($res);
        if($count>0){
           $response['records']  = array();
           $response['error']=false;
           $response['count']=$count;
           $response['wallet']=$this->getWalletAmount($userId);
            $item = array();
            while($data=mysqli_fetch_array($res)){
                $item = array("uid" =>$data['transaction_uid'] ,
                    "date"=>$data['transaction_date'] , 
                    "src"=>$data['transaction_src'] , 
                    "amount"=>$data['transaction_amount'],
                    "type"=>$data['transaction_type']
                );
                array_push( $response['records'] , $item   );

            }
            echo json_encode($response);
        }else{
            $response['wallet']=$this->getWalletAmount($userId);
            $response['error']=true ; 
            $response['msg']="No Trasaction";
            echo json_encode($response);
        }
    }
}
if($_SERVER['REQUEST_METHOD'] == 'POST' ){
    $date = null ; 
    $date = $_POST['date'];
    $user = $_POST['user'];
    $obj = new Transaction();
    $userId = $obj->getUserId($user);

   if($date==1){
     $obj->fetchTransaction($userId);
   
   }else{
      $obj->fetchTransactionByDate($userId , $date);
   }
}else{

}
?>