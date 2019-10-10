<?php 
require_once "../controller/Connection.php";
require_once "../controller/Controller.php";
$response=array("error"=>false);
class CardPinUpdate{
    private $connect  , $userId = null ;// $otp=null; 
    function __construct(){
        $con = new Connection();
        $this->connect = $con->getConnect();
    }
    function getCardId($carduid){
        $query = "select card_id from card where card_uid='{$carduid}'";
        $res = mysqli_query($this->connect , $query);
        $data = mysqli_fetch_array($res);
        return $data['card_id'];
    }
    function updatePin($card , $newPin){
        $query = "update card_pin set card_pin_val='{$newPin}' where card_pin_ref='{$card}'";
        $res = mysqli_query($this->connect , $query);
        if($res){
            return true;
        }
        return false;
    }
    function validateOldPin($oldPin , $card){
        $query = "Select * from card_pin where card_pin_ref='{$card}' && card_pin_val='{$oldPin}' ";
        $res = mysqli_query($this->connect , $query);
        $count = mysqli_num_rows($res);
        if($count==1){
            return true ; 
        }
        return false;
    }
}
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $oldPin = $_POST['oldPin'];
    $newPin = $_POST['newPin'];
    $oldPin = md5($oldPin);
    $newPin = md5($newPin);
    $carduid = $_POST['cardUid'];
    $obj = new CardPinUpdate();
    $cardid = $obj->getCardId($carduid);
    if($obj->validateOldPin($oldPin , $cardid) == true){
        if($obj->updatePin($cardid , $newPin)){
            $response['error']=false; 
            $response['msg']="Pin updated successfully";
            echo json_encode($response);
        }
    }else{
        $response['error']=true ; 
        $response['msg']="old pin is not valid";
        echo json_encode($response);
        return;
    }

}
?>