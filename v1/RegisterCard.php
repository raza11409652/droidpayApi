<?php 
require_once "../controller/Connection.php";
#require_once "../controller/Controller.php";
#require_once "../controller/SendMsg.php";
class RegisterCard{
    private $connect  , $userId = null ;// $otp=null; 
    function __construct(){
        $con = new Connection();
        $this->connect = $con->getConnect();
    }
    function getLastUser(){
        $query  = "select max(user_id) as max_id from user";
        $res = mysqli_query($this->connect , $query);
        $data = mysqli_fetch_array($res);
        return $data['max_id'];
    }
    function insertCard($cardUid , $cardNo , $userId){
        $date = date('Y-m-d');
        $query = "insert into card (card_uid , card_no , card_ref , card_created_at) values
        ('{$cardUid}' , '{$cardNo}' , '{$userId}' , '$date' )";
        $res = mysqli_query($this->connect , $query);
       // echo $query;
       // var_dump($res);
       if($res){
           echo "done";
       }
    }

}
if($_SERVER['REQUEST_METHOD'] == 'GET' ){
    $obj = new RegisterCard();
    @$card = $_GET['card'];
    if(!empty($card)){
        $id = $obj->getLastUser();
        $temp1 = mt_rand(1000 , 9999);
        $temp2 = mt_rand(1000 , 9999);
        $temp3 = mt_rand(1000 , 9999);
        $cardNo = $temp1."-".$temp2 ."-".$temp3;
        $obj->insertCard($card , $cardNo , $id);
    }
    
}else{

}

?>