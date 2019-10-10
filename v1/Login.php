<?php
require_once "../controller/Connection.php";
require_once "../controller/Controller.php";
require_once "../controller/SendMsg.php";
$response=array("error"=>false);
 class Login { 
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
    function loginCheck($userId , $password){
        $query = "select * from user where user_id='{$userId}' && user_password='{$password}' 
        && user_status='1'";
      //  echo $query;
        $res = mysqli_query($this->connect , $query);
        $count = mysqli_num_rows($res) ; 
        if($count==1){
            return true ; 
        }
        return false;
    }
    function getWallet($userId){
        $query = "select wallet_amount from wallet where wallet_ref='{$userId}'";
        $res = mysqli_query($this->connect , $query);
        $data = mysqli_fetch_array($res);
        return $data['wallet_amount'];
    }
    function getUser($userId){
        $query = "select * from user U , card C where U.user_id='{$userId}' && C.card_ref='{$userId}' ";
        $res = mysqli_query($this->connect , $query);
        $data = mysqli_fetch_array($res);
        return $data ; 
    }

 }
if($_SERVER['REQUEST_METHOD'] == 'POST' ){
    //  var_dump($_POST);
    $mobile = $_POST['mobile']; 
    $password = $_POST['password'];
    $password = md5($password);
    $loginObj = new Login();
    if(validMobile($mobile)){
        if($loginObj->isUserExist($mobile)){
            $userId = $loginObj->getUserId($mobile);
           // $r = $loginObj->loginCheck($userId , $password);
            //var_dump($r);
            if($loginObj->loginCheck($userId , $password)){
                $response['error']=false;
                $user = $loginObj->getUser($userId);
               // var_dump($user);
                $response['userName'] = $user['user_name'];
                $response['userMobile']=$user['user_mobile'];
                $response['userEmail'] = $user['user_email'];
                $response['cardUid']=$user['card_uid'];
                $response['cardNo']=$user['card_no'];
                $response['walletAmount']="{$loginObj->getWallet($userId)}";
                if($user['card_status']==1){
                    $response['cardStatus']=true;
                }else{
                    $response['cardStatus']=false;
                }
                $response['cardCretedAt']=$user['card_created_at'];
               // var_dump($loginObj->getUser($userId));
                $response['msg']="Login Success";
                echo json_encode($response);
                return ; 
            }else{
                $response['error']=true ; 
                $response['msg']="Login Failed";
                echo json_encode($response) ; 
            }
        }else{
            $response['error']=true ; 
            $response['msg']="No user found for {$mobile}";
            echo json_encode($response) ; 
        }
    }else{
        $response['error']=true ; 
        $response['msg']="Not valid indian mobile number" ; 
        echo json_encode($response) ; 
    }
}else{

}
?>