<?php session_start(); ?>
<?php
if(!empty($_POST['reply'])) 
{
    $reply = $_POST['reply'];
    $comment_id = $_POST['comment_id'];
    
    date_default_timezone_set("Asia/Taipei"); //設為台灣時間
    $reply_at = date("Y-m-d H:i:s");

    if (!empty($_SESSION['Username'])) {
        $reply_by = $_SESSION['Username'];
    }
    else{
        $reply_by = "guest";
    }

    require_once "config.php"; // use database
    $sql = ' INSERT INTO replies (id,reply,reply_at,reply_by,comment_id) VALUES (NULL,:reply,:reply_at,:reply_by,:comment_id) ';
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':reply', $reply);
    $stmt->bindParam(':reply_at', $reply_at);
    $stmt->bindParam(':reply_by', $reply_by);
    $stmt->bindParam(':comment_id', $comment_id);
    $stmt->execute();
?> 
    <meta http-equiv="refresh" content="0;URL='index.php'"/>
<?php
}
else
{
    echo "<div class='error'>Please fill in all!</div>";
?>
    <meta http-equiv="refresh" content="2;URL='index.php'"/>
<?php
}
?>

