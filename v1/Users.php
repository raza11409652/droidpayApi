<?php 
require_once "../controller/Connection.php";
require_once "../controller/Controller.php";
#require_once "../controller/SendMsg.php";
$response=array("error"=>false);
class Users{
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
    function getUser($userId){
        $query = "select * from user U , card C where U.user_id='{$userId}' && C.card_ref='{$userId}' ";
        $res = mysqli_query($this->connect , $query);
        $data = mysqli_fetch_array($res);
        return $data ; 
    }
}
if($_SERVER['REQUEST_METHOD'] == 'POST' ){
    $user = new Users();
  $mobile = $_POST['mobile'];
  $userId = $user->getUserId($mobile);
  $users = $user->getUser($userId);
  //var_dump($user->getUser($userId));
  $response['error']=false ; 
  $response['card_number']=$users['card_no'];
  $response['card_uid']=$users['card_uid'];
  $response['card_date'] = $users['card_created_at'];
  $response['user_name']=$users['user_name'];
  $response['user_email']=$users['user_email'];
  if($users['card_status']==1){
    $response['card_status']=true;
  }else{
    $response['card_status']=false;
  }

    echo json_encode($response);
}else{

}
?>