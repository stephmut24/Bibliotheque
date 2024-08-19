<?php 
session_start();
include_once("main.php");
if(!empty($_GET["id"])){
    $query="delete from abonne where numAb=:id";
    $objstmt=$pdo->prepare($query);
    $objstmt->execute(["id"=>$_GET["id"]]);
    $objstmt->closeCursor();
    //$pdo= null;
    $_SESSION['success_message'] = "L'abonné a été supprimé avec succès.";

    //header("Location:abonne.php");
    //exit();
}
header("Location:abonne.php");
exit();
//ob_end_flush();

?> 

