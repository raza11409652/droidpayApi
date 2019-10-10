<?php
require_once "../controller/Connection.php";
require_once "../controller/Controller.php";
$response=array("error"=>false);
class CardUpdate{
    private $connect  , $userId = null ;// $otp=null; 
    function __construct(){
        $con = new Connection();
        $this->connect = $con->getConnect();
    }
    function update($card , $status){
        $query = "update card set card_status='{$status}' where card_uid='{$card}'";
        $res = mysqli_query($this->connect , $query);
        if($res){
            return true;
        }
        return false;
    }
}
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $card = $_POST['card'];
    $status = $_POST['status'];
    $obj = new CardUpdate();
    $obj->update($card , $status);
}else{

}
?>