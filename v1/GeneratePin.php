<?php 
require_once "../controller/Connection.php";
require_once "../controller/Controller.php";
require_once "../controller/SendMsg.php";
class GeneratePin{
    private $connect  , $userId = null ;// $otp=null; 
    function __construct(){
        $con = new Connection();
        $this->connect = $con->getConnect();
    }
    function generatePin(){
        return mt_rand(1000 , 9999);
    }
    function getCardId($carduid){
        $query = "select card_id from card where card_uid='{$carduid}'";
        $res = mysqli_query($this->connect , $query);
        $data = mysqli_fetch_array($res);
        return $data['card_id'];
    }
    function updatePin($card , $newPin){
        $query = "update card_pin set card_pin_val='{$newPin}' where card_pin_ref='{$card}' ";
        $res = mysqli_query($this->connect , $query);
        if($res){
            return true ; 
        }
        return false  ; 
    }

}
if($_SERVER['REQUEST_METHOD'] == 'POST' ){
    $card = $_POST['card'];
    $obj = new GeneratePin();
    $cardId = $obj->getCardId($card);
    $newPin = $obj->generatePin();
    $hash = md5($newPin);
    if($obj->updatePin($cardId , $hash)){
        $response['error']=false ; 
        $response['msg'] = "Pin generated";
        $response['newPin'] = "{$newPin}";
        echo json_encode($response);
    }

}else{

}
?>